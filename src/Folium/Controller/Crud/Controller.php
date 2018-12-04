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

namespace Itmcdev\Folium\Controller\Crud;

use Itmcdev\Folium\Controller\Controller as DefaultController;
use Itmcdev\Folium\Operation\Crud\Create;
use Itmcdev\Folium\Operation\Crud\Read;
use Itmcdev\Folium\Operation\Crud\Update;
use Itmcdev\Folium\Operation\Crud\Delete;

/**
 * CRUD Controller trait.
 */
trait Controller
{
    /**
     * Default Controller trait
     */
    use DefaultController;

    /**
     * Set CRUD Create method
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
     * Set CRUD Read method
     * 
     * @param Create $create
     * @return self
     */
    public function setRead(Read $read)
    {
        $this->read = $read;
        return $this;
    }

    /**
     * Set CRUD Update method
     * 
     * @param Create $create
     * @return self
     */
    public function setUpdate(Update $update)
    {
        $this->update = $update;
        return $this;
    }

    /**
     * Set CRUD Delete method
     * 
     * @param Create $create
     * @return self
     */
    public function setDelete(Delete $delete)
    {
        $this->delete = $delete;
        return $this;
    }
}