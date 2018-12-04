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

namespace Itmcdev\Folium\Controller;

use Itmcdev\Folium\Operation\Exception\UndefinedOperation;

trait Controller
{
    /**
     * Magic function for calling methods
     *
     * @throws UndefinedOperation
     *
     * @param  string $method
     * @param  array  $arguments
     * @return any
     */
    public function __call(string $method, array $arguments)
    {
        if (array_search($method, self::operations()) !== false) {
            return call_user_func_array(
                array($this->$method, $method),
                $arguments
            );
        }

        throw new UndefinedOperation($this, $method, $arguments);
    }

    /**
     * Setter for controller's model class
     *
     * @param  string $modelClass Class name used for model
     * @return self
     */
    public function setModelClass(string $modelClass)
    {
        $this->modelClass = $modelClass;
        return $this;
    }
}
