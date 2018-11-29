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

use Itmcdev\Folium\Crud\Exception\DeleteException as CrudDeleteException;
use Itmcdev\Folium\Crud\Eloquent\Delete as CrudDelete;
use Itmcdev\Folium\Rest\Delete as DeleteInterface;
use Itmcdev\Folium\Rest\Exception\DeleteException;

/**
 * Trait proposal for CRUD Delete method implementation on Laravel's Eloquent
 */
trait Delete {

    use CrudDelete {
        CrudDelete::delete as crudDelete;
    }

    /**
     * @see DeleteInterface::delete()
     * @throws DeleteException
     * @throws ValidationException
     * @throws UnspecifiedModelException
     */
    public function delete(array $items = [], array $criteria = [], array $options = [])
    {
        try {
            return $this->crudDelete($items, $criteria, $options);
        } catch (CrudDeleteException $e) {}

        throw new DeleteException();
    }

}
