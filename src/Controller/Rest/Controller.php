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
use Itmcdev\Folium\Operation\Rest\Retreive;
use Itmcdev\Folium\Operation\Rest\Update;
use Itmcdev\Folium\Operation\Rest\Replace;
use Itmcdev\Folium\Operation\Rest\Delete;

/**
 * REST Controller trait.
 */
trait Controller
{
    use DefaultController;

    protected static function operations()
    {
        return ['create', 'fetch', 'retreive', 'update', 'replace', 'delete'];
    }

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
        $this->create = $create;
        $this->fetch = $fetch;
        $this->retreive = $retreive;
        $this->update = $update;
        $this->replace = $replace;
        $this->delete = $delete;
        $this->modelClass = $modelClass;
    }

    /**
     * Set REST Create method
     *
     * @param Create $create
     * @return self
     */
    public function setCreate(Create $create)
    {
        $this->create = $create;
        return $this;
    }

    /**
     * Set REST Fetch method
     *
     * @param Fetch $fetch
     * @return self
     */
    public function setFetch(Fetch $fetch)
    {
        $this->fetch = $fetch;
        return $this;
    }

    /**
     * Set REST Retreive method
     *
     * @param Retreive $retreive
     * @return self
     */
    public function setRetreive(Retreive $retreive)
    {
        $this->retreive = $retreive;
        return $this;
    }

    /**
     * Set REST Update method
     *
     * @param Update $update
     * @return self
     */
    public function setUpdate(Update $update)
    {
        $this->update = $update;
        return $this;
    }

    /**
     * Set REST Create method
     *
     * @param Replace $create
     * @return self
     */
    public function setReplace(Replace $replace)
    {
        $this->replace = $replace;
        return $this;
    }

    /**
     * Set REST Delete method
     *
     * @param Delete $delete
     * @return self
     */
    public function setDelete(Delete $delete)
    {
        $this->delete = $delete;
        return $this;
    }
}
