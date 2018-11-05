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

use Itmcdev\Folium\Crud\Update as UpdateInterface;
use Itmcdev\Folium\Crud\Exception\UpdateException;
use Itmcdev\Folium\Crud\Exception\ValidationException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException;
use Itmcdev\Folium\Util\ArrayUtils;

/**
 * Trait proposal for CRUD Update method implementation on Laravel's Eloquent
     * @throws UpdateException
     * @throws ValidationException
     * @throws UnspecifiedModelException
 */
trait Update
{
    /**
     * @see UpdateInterface::update()
     */
    public function update(array $items, array $criteria = [], array $options = [])
    {
        // delete method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            throw new UnspecifiedModelException($this, 'create');
        }
        $modelClass = $this->_modelClass;
        
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [ $items ];
        }

        if (empty($criteria)) {
            // if there is a validation method, try and validate data
            if (method_exists($modelClass, 'validate')) {
                foreach ($items as $item) {
                    $validator = $modelClass::validate($item);
                    if ($validator->fails()) {
                        throw new ValidationException($validator->errors());
                    }
                }
            }

            // define primary key name
            $pKey = !empty($options['p_key']) ? $options['p_key'] : 'id';

            $itemsToCreate = array_filter($items, function ($item) use ($pKey) {
                return empty($item[$pKey]);
            });
            $itemsToUpdate = array_filter($items, function ($item) use ($pKey) {
                return !empty($item[$pKey]);
            });

            try {
                // run update on the items having primary key
                foreach ($itemsToUpdate as $item) {
                    $modelClass::find($item[$pKey])->update($item);
                }
                // run create on the items not having primary key
                if (count($itemsToCreate)) {
                    if (method_exists($this, 'create')) {
                        $this->create($itemsToCreate);
                    } else {
                        foreach ($itemsToCreate as $item) {
                            $createdItems = $modelClass::create($item);
                        }
                    }
                } else {
                    $createdItems = [];
                }
                return array_merge(
                    array_map(function($item) use ($pKey) {
                        return $item[$pKey];
                    }, $itemsToUpdate),
                    array_map(function($item) use ($pKey) {
                        return $item[$pKey];
                    }, $createdItems)
                );
            } catch (\Exception $e) {
                Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
            }
        } else {
            $item = $items[0];

            // if there is a validation method, try and validate data (but only the keys that are present)
            if (method_exists("$modelClass::validate")) {
                foreach ($items as $item) {
                    $validator = $modelClass::validate($item, array_keys($item));
                    if ($validator->fails()) {
                        throw new ValidationException($validator->errors());
                    }
                }
            }
            // build a query based on the criteria
            $query = $modelClass::query();
            foreach ($criteria as $item) {
                $query = call_user_func_array([$query, 'where'], $item);
            }
            $query->update(array('under_18' => 1));

            $query = $modelClass::query();
            foreach ($criteria as $item) {
                $query = call_user_func_array([$query, 'where'], $item);
            }
            return array_map(function ($item) use ($pKey) { return $items[$pKey]; }, $query->get());
        }

        throw new UpdateException();
    }
}
