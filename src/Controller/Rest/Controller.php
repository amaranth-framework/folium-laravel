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

namespace Itmcdev\Folium\Illuminate\Controller\Rest;

use Itmcdev\Folium\Illuminate\Operation\Rest\Create;
use Itmcdev\Folium\Illuminate\Operation\Rest\Fetch;
use Itmcdev\Folium\Illuminate\Operation\Rest\Retreive;
use Itmcdev\Folium\Illuminate\Operation\Rest\Update;
use Itmcdev\Folium\Illuminate\Operation\Rest\Replace;
use Itmcdev\Folium\Illuminate\Operation\Rest\Delete;

/**
 * REST Controller trait.
 */
trait Controller
{
    /**
     * Default Controller trait
     */
    use \Itmcdev\Folium\Controller\Rest\Controller;

    /**
     * REST Controller Constructor
     *
     * @param Create $create
     * @param Fetch $fetch
     * @param Retreive $retreive
     * @param Update $update
     * @param Replace $replace
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __constructor(
        Create $create,
        Fetch $fetch,
        Retreive $retreive,
        Update $update,
        Replace $replace,
        Delete $delete,
        string $modelClass
    ) {
        $this->setCreate($create)
            ->setFetch($fetch)
            ->setRetreive($retreive)
            ->setUpdate($update)
            ->setReplace($replace)
            ->setDelete($delete)
            ->setModelClass($modelClass);
    }
}
