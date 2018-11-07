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
use Itmcdev\Folium\Util\ArrayUtils;
use Itmcdev\Folium\Util\CrudUtils;

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
            $query = $modelClass::query();
            foreach ($criteria as $item) {
                if (!is_array($item) || !ArrayUtils::isNumeric($item)) {
                    throw new InvalidArgument('$criteria must be an array of numeric arrays. i.e. [[\'id\', 1]].');
                }
                list($action, $$item) = CrudUtils::parseCriteriaItem($item);
                $query = call_user_func_array([$query, $action], $item);
            }
            if (!empty($options['count'])) {
                return $query->count();
            } else {
                $models = $query->get();
                if (empty($fields)) {
                    return $models->toArray();
                }
                return $models->map(function($model) use ($fields) {
                    return array_intersect_key(
                        $model->toArray(),
                        array_combine($fields, $fields)
                    );
                })->toArray();
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }

        throw new ReadException();
    }
}
