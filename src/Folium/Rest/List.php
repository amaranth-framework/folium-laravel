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

namespace Itmcdev\Folium\Rest;

/**
 * Inteface for impelenting REST List method.
 * 
 * @link https://en.wikipedia.org/wiki/Representational_state_transfer
 */
interface List
{
    /**
     * If no field is passed, all resource fields should be presented to output.
     * Read resource data from the database according to a set of criteria and based on a set of fields to be retreived.
     * 
     * list([ [ 'id', '>', '10' ] ])
     * 
     * or 
     * 
     * list(
     *   [ [ 'id', '>', '10' ] ],
     *   [ 'id', 'name', 'email' ]
     * )
     * 
     * or
     * 
     * list([], [], [ '__count' => true ])
     *
     * @param array      $criteria Criteria to filter database data.
     * @param array      $fields   Fields to obtain.
     * @param array      $options  Fields to obtain.
     * @return array|int           Array of items matching the criteria and having only the fields required or their count.
     */
    public function list(array $criteria = [], array $fields = [], array $options = []);
}
