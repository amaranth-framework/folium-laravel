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

/**
 * Inteface for impelenting CRUD Replace method.
 */
interface Replace
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
    public function replace(array $items, array $options = []);
}
