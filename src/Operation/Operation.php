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

namespace Itmcdev\Folium\Illuminate\Operation;


use Itmcdev\Folium\Exception\InvalidArgument;
use Itmcdev\Folium\Exception\UnspecifiedModel;
use Itmcdev\Folium\Exception\UnspecifiedModelKey;
use Itmcdev\Folium\Exception\Validation as ValidationException;
use Itmcdev\Folium\Util\ArrayUtils;

use Illuminate\Support\Facades\Validator;

class Operation extends \Itmcdev\Folium\Operation\Operation
{
    /**
     * @TODO Document method.
     *
     * @param string $modelClass
     * @param array $criteria
     * @return void
     */
    protected function buildQueryFromCriteria(string $modelClass, array $criteria = [])
    {
        $query = $modelClass::query();
        foreach ($criteria as $item) {
            if (!is_array($item) || !ArrayUtils::isNumeric($item)) {
                throw new InvalidArgument('$criteria must be an array of numeric arrays. i.e. [[\'id\', 1]].');
            }
            list($action, $$item) = $this->parseCriteriaItem($item);
            $query = call_user_func_array([$query, $action], $item);
        }
        return $query;
    }

    /**
     * Obtain Model Class Name and Model Primary Key
     *
     * @param boolean $pKeyRequired
     * @return [string, string]
     */
    protected function getModelData($pKeyRequired = true)
    {
        // create method requires ::modelClass variable to be able to init the model
        if (!$this->modelClass) {
            throw new UnspecifiedModel($this, 'create');
        }
        $modelClass = $this->modelClass;

        $pKey = null;
        if ($pKeyRequired) {
            // define primary key name
            $pKey = (new $modelClass())->getKeyName();
            if (!$pKey) {
                throw new UnspecifiedModelKey($modelClass, $this, 'create');
            }
        }

        return [$this->modelClass, $pKey];
    }

    /**
     * Parse criteria array item into [string, array] array where the string
     * represents the query called method (where/whereIn/orWhere/orWhereIn)
     * and the array represents its arguments.
     *
     * @param array $item
     * @return array(string, array)
     */
    protected function parseCriteriaItem($item)
    {
        // by default, use where*
        $where = 'where';
        $whereIn = 'whereIn';

        $or = array_values(array_slice($item, -1))[0];
        // if or found, use orWhere*
        if (is_string($or) && strtolower($or) === 'or') {
            $where = 'orWhere';
            $whereIn = 'orWhereIn';
            $item = array_slice($item, 0, -1);
        }

        $value = array_values(array_slice($item, -1))[0];
        // if value added to condition use where*
        if (!is_array($value)) {
            return [$where, $item];
        } else {
            return [$whereIn, $item];
        }
    }

    /**
     * Filter validation rules by a set of keys.
     *
     * @param array $rules
     * @param array $keys
     * @return array
     */
    protected function patchValidateRules(array $rules, array $keys)
    {
        return array_intersect_key($rules, array_flip(array_intersect(array_keys($rules), $keys)));
    }

    /**
     * Validate items through model validate rules.
     *
     * @param string $modelClass
     * @param array $items
     * @param bool $partial
     * @throws ValidateException
     */
    protected function validate(string $modelClass, array $items, bool $partial = false)
    {
        // if there is a validation method, try and validate data
        if (method_exists($modelClass, 'rules')) {
            foreach ($items as $item) {
                $rules = (!$partial)
                    ? $modelClass::rules()
                    : $this->patchValidateRules($modelClass::rules(), array_keys($item));
                $validator = Validator::make($item, $rules);
                if ($validator->fails()) {
                    throw new ValidationException($validator->errors());
                }
            }
        }
    }
}
