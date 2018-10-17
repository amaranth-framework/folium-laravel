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

use Itmcdev\Folium\Crud\Read as ReadInterface;
use Itmcdev\Folium\Crud\Exception\ReadException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException;

/**
 * Trait proposal for CRUD Read method implementation on Laravel's Eloquent
 */
trait Read
{
    /**
     * @see ReadInterface::read()
     */
    public function read(array $criteria = [], array $fields = [], array $options = [])
    {
        // delete method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            throw new UnspecifiedModelException($this, 'create');
        }
        $modelClass = $this->_modelClass;

        try {
            $query = (new $modelClass())->newQuery();
            foreach ($criteria as $item) {
                $query = call_user_func_array([$query, 'where'], $item);
            }
            if (!empty($options['count'])) {
                return $query->count()->get();
            } else {
                $models = $query->get();
                if (empty($fields)) {
                    return $models;
                }
                return array_map(function($model) use ($fields) {
                    return array_intersect_key(
                        $model,
                        array_combine($fields, $fields)
                    );
                }, $models);
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }

        throw new ReadException();
    }
}
