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

namespace Itmcdev\Folium\Illuminate\Operation\Crud;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Itmcdev\Folium\Exception\InvalidArgument;
use Itmcdev\Folium\Exception\InvalidOperation;
use Itmcdev\Folium\Exception\UnspecifiedModel;
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
    use \Itmcdev\Folium\Illuminate\Util\Crud;

    /**
     * @see UpdateInterface::update()
     * @throws InvalidArgument
     * @throws InvalidOperation
     * @throws UnspecifiedModel
     * @throws UpdateException
     * @throws ValidationException
     */
    public function update(array $items, array $criteria = [], array $options = [])
    {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass, $pKey) = $this->getModelData();
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [$items];
        }

        if (empty($criteria)) {
            // attempt validation (if necesary)
            $this->validate($modelClass, $items);
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
                $updatedItems = array_map(function ($item) use ($modelClass, $pKey) {
                    $modelClass::find($item[$pKey])->update($item);
                    return $item[$pKey];
                }, $itemsToUpdate);
                // run create on the items not having primary key
                $createdItems = [];
                if (count($itemsToCreate)) {
                    $createdItems = array_map(function ($item) use ($modelClass, $pKey) {
                        return $modelClass::create($item)->$pKey;
                    }, $itemsToCreate);
                }
                return array_merge($updatedItems, $createdItems);
            } catch (\Exception $e) {
                Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
            }
        } else {
            // attempt validation (if necesary)
            $this->validate($modelClass, $items, true);
            try {
                // attempt to query by criteria (convert criteria into callable code)
                $query = $this->buildQueryFromCriteria($modelClass, $criteria);
                // apply all updates
                foreach ($items as $item) {
                    $query->update($item);
                }
                // return list of primary key values
                return array_map(function ($model) use ($pKey) {
                    return $model[$pKey];
                }, $query->get()->toArray());
            } catch (\Exception $e) {
                Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
            }
        }
        throw new UpdateException();
    }
}
