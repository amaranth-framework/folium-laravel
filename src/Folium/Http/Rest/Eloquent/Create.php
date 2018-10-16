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

use Itmcdev\Folium\Exception\UnidentifiableModelType;
use Itmcdev\Folium\Http\Response\BadRequestErrorResponse;
use Itmcdev\Folium\Http\Response\CreatedResponse;
use Itmcdev\Folium\Http\Response\ErrorResponse;
use Itmcdev\Folium\Http\Response\InvalidModelErrorResponse;
use Itmcdev\Folium\Rest\CreateInterface;
use Itmcdev\Folium\Rest\Utils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait proposal for REST Create method implementation on Laravel's Eloquent
 */
trait Create {

    use Utils;

    /**
     * @see CreateInterface::create()
     */
    public function create(Request $request)
    {
        // create method functions only for HTTP POST method
        if (!$request->isMethod(Request::METHOD_POST)) {
            return new BadRequestErrorResponse();
        }
        // create method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            return new InvalidModelErrorResponse();
        }
        
        $dataArray = $request->request->all();
        
        // if POST data is not an array of models
        if (!$this->isAssoc($dataArray)) {
            $dataArray = [ $dataArray ];
        }

        $modelClass = $this->modelClass;

        // if there is a validation method, try and validate data
        if (method_exists("$modelClass::validate")) {
            foreach ($dataArray as $data) {
                $validator = $modelClass::validate($data);
                if ($validator->fails()) {
                    return new ValidationErrorResponse($validator->errors());
                }
            }
        }

        // attempt and save all data. if attempt fails, delete all saved data and return error.
        $models = [];
        try {
            foreach ($dataArray as $data) {
                // check if there is any transform before save option
                $data = method_exists($this, 'beforeCreateTransform') ? $this->beforeCreateTransform($data) : $data;
                // attempt save
                $models[] = $modelClass::create($data);
            }
            return new CreatedResponse($models);
        } catch (\Exception $e) {
            if (count($models)) {
                try {
                    foreach ($models as $model) {
                        $model->delete();
                    }
                } catch (\Exception $e2) {
                    Log::error(sprintf('%s => %s', $e2->__toString(), $e2->getTraceAsString()));
                    return new ErrorResponse('Could not create entity (entities). Rollback process failed, please address administrator.');
                }
            }
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        return new ErrorResponse('Could not create entity (entities).');
    }
}
