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

namespace Itmcdev\Folium\Illuminate\Controller\Crud;


use Itmcdev\Folium\Illuminate\Operation\Crud\Create;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Read;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Update;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Delete;

/**
 * CRUD Controller trait.
 */
trait Controller
{
    /**
     * Default Controller trait
     */
    use \Itmcdev\Folium\Controller\Crud\Controller;

    /**
     * CRUD Controller Constructor
     *
     * @param Create $create
     * @param Read $read
     * @param Update $update
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __construct(
        Create $create,
        // Read $read,
        // Update $update,
        // Delete $delete,
        string $modelClass
    ) {
        $this->create = $create;
        // $this->read = $read;
        // $this->update = $update;
        // $this->delete = $delete;
        $this->modelClass = $modelClass;
    }
}
