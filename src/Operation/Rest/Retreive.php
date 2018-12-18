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
 * Inteface for impelenting REST Retreive method.
 *
 * @link https://en.wikipedia.org/wiki/Representational_state_transfer
 */
interface Retreive
{
    /**
     * Retreive resource from the database based on its ID and on a set of fields to be retreived.
     *
     * retreive(10)
     *
     * or
     *
     * retreive(
     *   10,
     *   [ 'id', 'name', 'email' ]
     * )
     *
     * @param  array $id       ID of the resource to retreive.
     * @param  array $fields   Fields to obtain.
     * @param  array $options  Options sent ot the method, like primary key of the model.
     * @return array              Resource data.
     */
    public function retreive($id, array $fields = [], $options = []);
}
