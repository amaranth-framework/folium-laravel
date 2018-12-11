<?php
/**
 * Copyright 2018 IT Media Connect
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Itmcdev\Folium\Crud\Eloquent;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Itmcdev\Folium\Exception\InvalidArgument;
use Itmcdev\Folium\Exception\InvalidOperation;
use Itmcdev\Folium\Exception\UnspecifiedModel;
use Itmcdev\Folium\Illuminate\Operation\Crud\Create;
use Itmcdev\Folium\Operation\Crud\Update as UpdateInterface;
use Itmcdev\Folium\Operation\Exception\Update as UpdateException;
use Itmcdev\Folium\Operation\Exception\Validation as ValidationException;
use Itmcdev\Folium\Operation\Operation;
use Itmcdev\Folium\Util\ArrayUtils;
use Itmcdev\Folium\Util\CrudUtils;

/**
 * Class proposal for CRUD Update operation implementation on Laravel's Eloquent
 */
class Update extends Operation implements UpdateInterface
{
    /**
     * @var Create|null $create
     */
    protected $create = null;

    /**
     * Constructor
     *
     * @param string $modelClass Class name used for model.
     */
    public function __construct(
        string $modelClass = null,
        Create $create = null
    ) {
        super::__construct($modelClass);

        $this->create = $create;
        $this->create->setModelClass($modelClass);
    }

    /**
     * @see UpdateInterface::update()
     * @throws InvalidArgument
     * @throws InvalidOperation
     * @throws UnspecifiedModel
     * @throws UpdateException
     * @throws ValidationException
     */
    public function update(
        array $items,
        array $criteria = [],
        array $options = []
    ) {
        // update method requires ::modelClass variable to be able to init the model
        if (!$this->modelClass) {
            throw new UnspecifiedModel($this, 'update');
        }
        $modelClass = $this->modelClass;
        // define primary key name
        $pKey = (new $modelClass())->getKeyName();
        if (!$pKey) {
            throw new UnspecifiedModelKey($modelClass, $this, 'update');
        }
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [$items];
        }
        if (empty($criteria)) {
            // if there is a validation method, try and validate data
            if (method_exists($modelClass, 'rules')) {
                foreach ($items as $item) {
                    $validator = Validator::make($item, $modelClass::rules());
                    if ($validator->fails()) {
                        throw new ValidationException($validator->errors());
                    }
                }
            }
            // obtain the items we need to create (do not have primary key)
            $itemsToCreate = array_filter($items, function ($item) use ($pKey) {
                return empty($item[$pKey]);
            });
            // obtain the items we need to replace
            $itemsToUpdate = array_filter($items, function ($item) use ($pKey) {
                return !empty($item[$pKey]);
            });
            try {
                // run update on the items having primary key
                $updatedItems = array_map(function ($item) use (
                    $modelClass,
                    $pKey
                ) {
                    $modelClass::find($item[$pKey])->update($item);
                    return $item[$pKey];
                },
                $itemsToUpdate);
                // run create on the items not having primary key
                $createdItems = [];
                if (count($itemsToCreate)) {
                    if (
                        !empty($this->create) &&
                        $this->create instanceof Create
                    ) {
                        // seems array filter keps old ids, so array_values will get rid of them
                        $createdItems = $this->create->create(
                            array_values($itemsToCreate)
                        );
                    } else {
                        throw InvalidOperation(
                            'Update operation cannot function witout a create operation attached.'
                        );
                    }
                }
                return array_merge($updatedItems, $createdItems);
            } catch (\Exception $e) {
                Log::error(
                    sprintf(
                        '%s => %s',
                        $e->__toString(),
                        $e->getTraceAsString()
                    )
                );
            }
        } else {
            // if there is a validation method, try and validate data
            if (method_exists($modelClass, 'rules')) {
                foreach ($items as $item) {
                    $validator = Validator::make(
                        $item,
                        CrudUtils::patchRules(
                            $modelClass::rules(),
                            array_keys($item)
                        )
                    );
                    if ($validator->fails()) {
                        throw new ValidationException($validator->errors());
                    }
                }
            }
            try {
                // build a query based on the criteria
                $query = $modelClass::query();
                foreach ($criteria as $item) {
                    if (!is_array($item) || !ArrayUtils::isNumeric($item)) {
                        throw new InvalidArgument(
                            '$criteria must be an array of numeric arrays. i.e. [[\'id\', 1]].'
                        );
                    }
                    list($action, $$item) = CrudUtils::parseCriteriaItem($item);
                    $query = call_user_func_array([$query, $action], $item);
                }
                // apply all updates
                foreach ($items as $item) {
                    $query->update($item);
                }
                // return list of primary key values
                return array_map(function ($model) use ($pKey) {
                    return $model[$pKey];
                }, $query->get()->toArray());
            } catch (\Exception $e) {
                Log::error(
                    sprintf(
                        '%s => %s',
                        $e->__toString(),
                        $e->getTraceAsString()
                    )
                );
            }
        }
        throw new UpdateException();
    }
}
