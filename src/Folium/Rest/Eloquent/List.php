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

use Itmcdev\Folium\Crud\Exception\ListException as CrudReadException;
use Itmcdev\Folium\Crud\Eloquent\List as CrudRead;
use Itmcdev\Folium\Rest\List as ListInterface;
use Itmcdev\Folium\Rest\Exception\ListException;

/**
 * Trait proposal for CRUD List method implementation on Laravel's Eloquent
 */
trait List {

    use CrudRead {
        CrudRead::read as crudRead;
    }

    /**
     * @see ListInterface::list()
     * @throws ListException
     * @throws ValidationException
     * @throws UnspecifiedModelException
     */
    public function list(array $criteria = [], array $fields = [], array $options = [])
    {
        try {
            return $this->crudRead($criteria, $fields, $options);
        } catch (CrudReadException $e) {}

        throw new ListException();
    }

}
