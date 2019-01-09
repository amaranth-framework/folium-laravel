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

namespace Itmcdev\Folium\Illuminate\Operation\Rest;

use Itmcdev\Folium\Operation\Rest\Replace as ReplaceInterface;
use Itmcdev\Folium\Operation\Exception\Update as UpdateException;
use Itmcdev\Folium\Operation\Exception\Replace as ReplaceException;
use Itmcdev\Folium\Util\ArrayUtils;

/**
 * Inteface for impelenting CRUD Replace method.
 */
class Replace extends \Itmcdev\Folium\Illuminate\Operation\Crud\Update implements ReplaceInterface
{
    /**
     * Replace a resource or set of resources in the database.
     * If a resource does not exists when passed to the update method, it will be created.
     *
     * replace([
     *   [ "text" => "I really have to iron", "id" => 10 ], // this item will be replaced
     *   [ "text" => "Do laundry" ] // this item will be created
     * ])
     *
     * @param  array $items    Can be a single element or an array of elements.
     * @param  array $options  To be defined.
     * @return array           Will return the ids of the elements updated.
     */
    public function replace(array $items, array $options = []) {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass, $pKey) = $this->getModelData();
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [$items];
        }

        try {
            $updated = array_map(function($item) use ($pKey, $options) {
                $criteria = empty($item[$pKey]) ? [] : [ [$pKey, $item[$pKey]] ];
                return array_pop($this->update($item, $criteria, $options));
            }, $items);

            return $updated;
        } catch (UpdateException $e) {}

        throw new ReplaceException();
    }
}
