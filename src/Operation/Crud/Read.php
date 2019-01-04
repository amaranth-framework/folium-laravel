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

use Itmcdev\Folium\Exception\InvalidArgument;
use Itmcdev\Folium\Exception\UnspecifiedModel;
use Itmcdev\Folium\Illuminate\Operation\Operation;
use Itmcdev\Folium\Operation\Crud\Read as ReadInterface;
use Itmcdev\Folium\Operation\Exception\Read as ReadException;
use Itmcdev\Folium\Util\ArrayUtils;
use Itmcdev\Folium\Util\CrudUtils;

/**
 * Class proposal for CRUD Read operation implementation on Laravel's Eloquent
 */
class Read extends Operation implements ReadInterface
{
    /**
     * @see ReadInterface::read()
     * @throws InvalidArgument
     * @throws ReadException
     * @throws UnspecifiedModel
     */
    public function read(array $criteria = [], array $fields = [], array $options = [])
    {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass) = $this->getModelData(false);
        try {
            // attempt to query by criteria (convert criteria into callable code)
            $query = $this->buildQueryFromCriteria($modelClass, $criteria);
            // if count required, return only count
            if (!empty($options[CrudUtils::countProperty()])) {
                return $query->count();
            } else {
                // otherwise all available data filtered by the $fields array
                $models = $query->get();
                // if no $fields array is provided, return all available data from query
                if (empty($fields)) {
                    return $models->toArray();
                }
                // otherwise return only selected fields
                return $models
                    ->map(function ($model) use ($fields) {
                        return array_intersect_key($model->toArray(), array_combine($fields, $fields));
                    })
                    ->toArray();
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        throw new ReadException();
    }
}
