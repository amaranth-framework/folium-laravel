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

use Itmcdev\Folium\Crud\Exception\RetreiveException as CrudReadException;
use Itmcdev\Folium\Crud\Eloquent\Retreive as CrudRead;
use Itmcdev\Folium\Rest\Retreive as RetreiveInterface;
use Itmcdev\Folium\Rest\Exception\RetreiveException;

/**
 * Trait proposal for CRUD Retreive method implementation on Laravel's Eloquent
 */
trait Retreive {

    use CrudRead {
        CrudRead::read as crudRead;
    }

    /**
     * @see RetreiveInterface::retreive()
     * @throws RetreiveException
     * @throws ValidationException
     * @throws UnspecifiedModelException
     */
    public function retreive($id, array $fields = [], $options = [])
    {
        $pKey = 'id';
        if (!empty($options['p_key'])) {
            $pKey = $options['p_key'];
            unset($options['p_key']);
        }
        
        try {
            return $this->crudRead([$pKey, $id], $fields, $options);
        } catch (CrudReadException $e) {}

        throw new RetreiveException();
    }

}
