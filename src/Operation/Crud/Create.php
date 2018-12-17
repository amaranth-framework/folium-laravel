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

namespace Itmcdev\Folium\Illuminate\Operation\Crud;

use Illuminate\Support\Facades\Log;

use Itmcdev\Folium\Exception\UnspecifiedModel;
use Itmcdev\Folium\Exception\UnspecifiedModelKey;
use Itmcdev\Folium\Exception\Validation as ValidationException;
use Itmcdev\Folium\Operation\Crud\Create as CreateInterface;
use Itmcdev\Folium\Operation\Exception\Create as CreateException;
use Itmcdev\Folium\Operation\Operation;
use Itmcdev\Folium\Util\ArrayUtils;

/**
 * Class proposal for CRUD Create operation implementation on Laravel's Eloquent
 */
class Create extends Operation implements CreateInterface
{
    
    use \Itmcdev\Folium\Illuminate\Util\Crud;

    /**
     * @see CreateInterfacee::create()
     * @throws \Itmcdev\Folium\Operation\Exception\Create
     * @throws ValidationException
     * @throws UnspecifiedModel
     * @throws UnspecifiedModelKey
     */
    public function create(array $items, array $criteria = [])
    {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass, $pKey) = $this->getModelData();
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [$items];
        }
        // attempt validation (if necesary)
        $this->validate($modelClass, $items);
        // attempt creating items or log failure
        try {
            // map Model::create responses
            return array_map(function ($item) use ($modelClass, $pKey) {
                return $modelClass::create($item)->$pKey;
            }, $items);
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        throw new CreateException();
    }
}
