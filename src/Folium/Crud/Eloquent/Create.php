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

namespace Itmcdev\Folium\Crud\Eloquent;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Itmcdev\Folium\Crud\Create as CreateInterface;
use Itmcdev\Folium\Crud\Exception\CreateException;
use Itmcdev\Folium\Crud\Exception\ValidationException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException;
use Itmcdev\Folium\Util\ArrayUtils;

/**
 * Trait proposal for CRUD Create method implementation on Laravel's Eloquent
 */
trait Create {

    /**
     * @see CreateInterface::create()
     * @throws CreateException
     * @throws ValidationException
     * @throws UnspecifiedModelException
     */
    public function create(array $items, array $criteria = [])
    {
        // delete method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            throw new UnspecifiedModelException($this, 'create');
        }
        $modelClass = $this->_modelClass;

        // define primary key name
        $pKey = !empty($options['p_key']) ? $options['p_key'] : 'id';
        
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [ $items ];
        }

        // if there is a validation method, try and validate data
        if (method_exists($modelClass, 'rules')) {
            foreach ($items as $item) {
                $validator = Validator::make($item, $modelClass::rules());
                if ($validator->fails()) {
                    throw new ValidationException($validator->errors());
                }
            }
        }

        // attempt creating items or log failure
        try {
            if (method_exists($this, 'insertItems')) {
                return $this->inserItems($items);
            }
            // map Model::create responses
            return array_map(function($item) use ($modelClass, $pKey) {
                return $modelClass::create($item)->$pKey;
            }, $items);
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        
        throw new CreateException();
    }
}
