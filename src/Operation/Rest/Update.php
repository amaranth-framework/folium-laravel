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
 * Inteface for impelenting REST Update method.
 *
 * @link https://en.wikipedia.org/wiki/Representational_state_transfer
 */
interface Update
{
    /**
     * Update/patch a resource in the database.
     * If multiple items are given, all patches will be applied in the given order.
     *
     * update($id, [ "text" => "I really have to iron" ])
     *
     * @param  any   $id       ID of the resource to update/patch.
     * @param  array $items    Can be a single element or an array of elements.
     * @param  array $options  To be defined.
     * @return array           Resource data.
     */
    public function update($id, array $items, array $options = []);
}
