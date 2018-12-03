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

namespace Itmcdev\Folium\Controller\Rest;

use Itmcdev\Folium\Controller\Controller as DefaultController;
use Itmcdev\Folium\Operation\Rest\Create;
use Itmcdev\Folium\Operation\Rest\Fetch;
use Itmcdev\Folium\Operation\Rest\FetchOne;
use Itmcdev\Folium\Operation\Rest\Update;
use Itmcdev\Folium\Operation\Rest\Replace;
use Itmcdev\Folium\Operation\Rest\Delete;

/**
 * REST Controller trait.
 */
trait Controller
{

    use DefaultController;

    /**
     * REST Controller Constructor
     *
     * @param Create $create
     * @param Fetch $fetch
     * @param FetchOne $fetchOne
     * @param Update $update
     * @param Replace $replace
     * @param Delete $delete
     */
    public function __constructor(Create $create, Fetch $fetch, FetchOne $fetchOne, Update $update, Replace $replace, Delete $delete)
    {
        $this->create = $create;
        $this->fetch = $fetch;
        $this->fetchOne = $fetchOne;
        $this->update = $update;
        $this->replace = $replace;
        $this->delete = $delete;
    }
}