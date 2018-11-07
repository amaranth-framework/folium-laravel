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

namespace Itmcdev\Folium\Crud;
/**
 * Inteface for impelenting CRUD Update method.
 */
interface Update
{
    /**
     * Update a resource or set of resources in the database.
     * Update should behave more as a 'replace' and not as a 'resource patch' method.
     * If a resource does not exists when passed to the update method, it will be created.
     * If $criteria is given, method will then function as a 'resource patch' handler, not as a 'replace' one.
     * If $criteria is given and $items are multiple, function will apply all all items as patch.
     * 
     * update(
     *   {"text": "I really have to iron" }
     * )
     * 
     * or
     * 
     * update([
     *   { "text": "I really have to iron" },
     *   { "text": "Do laundry" }
     * ])
     *
     * @param  array $items    Can be a single element or an array of elements.
     * @param  array $criteria To be defined.
     * @param  array $options  To be defined.
     * @return array           Will return the ids of the elements updated.
     */
    public function update(array $items, array $criteria = [], array $options = []);
}
