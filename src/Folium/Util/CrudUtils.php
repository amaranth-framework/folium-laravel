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

namespace Itmcdev\Folium\Util;

use Illuminate\Database\Eloquent\Model;

class CrudUtils
{
    /**
     * Parse criteria array
     *
     * @param array $item
     * @return array(string, array)
     */
    static public function parseCriteriaItem($item) {
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

    static public function patchRules($rules, $keys)
    {
        return array_intersect_key(
            $rules, 
            array_flip(array_intersect(
                array_keys($rules),
                $keys
            ))
        );
    }

    /**
     * @param string $model
     * @return boolean
     */
    static public function canSoftDelete($modelClass) {
        return method_exists($modelClass, 'canSoftDelete') && $modelClass::canSoftDelete();
    }
}
