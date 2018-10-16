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
 * Inteface for impelenting CRUD Create method.
 * 
 * @link https://en.wikipedia.org/wiki/Create,_read,_update_and_delete
 */
interface Create
{
    /**
     * Create new resource(s).
     * Can receive a item or a set of items to create.
     * 
     * create(
     *   {"text": "I really have to iron" }
     * )
     * 
     * or
     * 
     * create([
     *   { "text": "I really have to iron" },
     *   { "text": "Do laundry" }
     * ])
     *
     * @param  array $items    Can be a single element or an array of elements
     * @param  array $criteria To be defined.
     * @return array           Will return an array of models that have been saved in the database.
     */
    public function create(array $items, array $criteria = []);
}
