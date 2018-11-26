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

use Itmcdev\Folium\Http\Response\BadRequestErrorResponse;
use Itmcdev\Folium\Http\Response\InvalidRequestErrorResponse;
use Itmcdev\Folium\Http\Response\Response;
use Itmcdev\Folium\Http\Response\ErrorResponse;
use Itmcdev\Folium\Http\Response\InvalidModelErrorResponse;
use Itmcdev\Folium\Rest\FindInterface;
use Itmcdev\Folium\Rest\Utils;

/**
 * Trait proposal for REST Get method implementation on Laravel's Eloquent
 */
trait Get
{
    use Utils;

    /**
     * @see FindInterface::get()
     *
     * @param integer $request
     */
    public function get($id)
    {
        // create method functions only for HTTP GET method
        if (!$request->isMethod(Request::METHOD_GET)) {
            return new BadRequestErrorResponse();
        }
        // test param to be int
        // TODO: Not happy with this type of type check.
        if (!intval($id)) {
            return new ErrorResponse('Parameter must be a number.');
        }
        // create method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            return new InvalidModelErrorResponse();
        }

        $modelClass = $this->_modelClass;

        // attempt data fetch from db
        try {
            // retreive data
            return new Response($modelClass::find($id));
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }

        return new ErrorResponse('Could not fetch entitity.');
    }
}
