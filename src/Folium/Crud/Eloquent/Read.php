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

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

use Itmcdev\Folium\Crud\Read as ReadInterface;
use Itmcdev\Folium\Crud\Exception\ReadException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException;
use Itmcdev\Folium\Exception\InvalidArgument;

/**
 * Trait proposal for CRUD Read method implementation on Laravel's Eloquent
 */
trait Read
{
    /**
     * @see ReadInterface::read()
     * @throws InvalidArgument
     * @throws ReadException
     * @throws UnspecifiedModelException
     */
    public function read(array $criteria = [], array $fields = [], array $options = [])
    {
        // delete method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            throw new UnspecifiedModelException($this, 'create');
        }
        $modelClass = $this->_modelClass;

        try {
            // $query = (new $modelClass())->newQuery();
            $query = $modelClass::query();
            foreach ($criteria as $item) {
                if (!is_array($item) || !\Itmcdev\Folium\Util\ArrayUtils::isNumeric($item)) {
                    throw new InvalidArgument('$criteria must be an array of numeric arrays. i.e. [[\'id\', 1]].');
                }
                list($where, $whereIn, $item) = $this->readCriteriaParams($item);
                $value = array_values(array_slice($item, -1))[0];
                if (!is_array($value)) {
                    $query = call_user_func_array([$query, 'where'], $item);
                } else {
                    $query = call_user_func_array([$query, 'whereIn'], $item);
                }
            }
            if (!empty($options['count'])) {
                return $query->count();
            } else {
                $models = $query->get();
                if (empty($fields)) {
                    return $models;
                }
                $mappedModels = array_map(function($model) use ($fields) {
                    return array_intersect_key(
                        $model->toArray(),
                        array_combine($fields, $fields)
                    );
                }, $models->all());
                return new Collection($mappedModels);
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }

        throw new ReadException();
    }

    /**
     * Undocumented function
     *
     * @param array $item
     * @return array(string, string, array)
     */
    protected function readCriteriaParams($item) {
        $where = 'where';
        $whereIn = 'orWhere';
        $or = array_values(array_slice($item, -1))[0];
        if (is_string($or) && strtolower($or) === 'or') {
            $where = 'orWhere';
            $whereIn = 'orWhereIn';
            $item = array_slice($item, 0, -1);
        }
        return [$where, $whereIn, $item];
    }
}
