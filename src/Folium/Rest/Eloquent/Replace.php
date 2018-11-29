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

namespace Itmcdev\Folium\Rest\Eloquent;

use Itmcdev\Folium\Crud\Exception\ReplaceException as CrudUpdateException;
use Itmcdev\Folium\Crud\Eloquent\Replace as CrudUpdate;
use Itmcdev\Folium\Rest\Replace as ReplaceInterface;
use Itmcdev\Folium\Rest\Exception\ReplaceException;

/**
 * Trait proposal for REST Replace method implementation on Laravel's Eloquent
 */
trait Replace {

    use CrudUpdate {
        CrudUpdate::update as crudUpdate;
    }

    /**
     * @see ReplaceInterface::replace()
     * @throws ReplaceException
     * @throws ValidationException
     * @throws UnspecifiedModelException
     */
    public function replace(array $items, array $options = []);
    {
        try {
            return $this->crudUpdate($items, [], $options);
        } catch (CrudUpdateException $e) {}

        throw new ReplaceException();
    }

}
