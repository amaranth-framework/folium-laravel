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
 * Trait proposal for REST Find method implementation on Laravel's Eloquent
 */
trait Find
{
    use Utils;

    /**
     * @see FindInterface::find()
     *
     * @param Request $request
     */
    public function find(Request $request)
    {
        // create method functions only for HTTP GET method
        if (!$request->isMethod(Request::METHOD_GET)) {
            return new BadRequestErrorResponse();
        }
        // create method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            return new InvalidModelErrorResponse();
        }

        $modelClass = $this->_modelClass;

        $getQuery = $request->request->all();

        try {
            $filters = $this->parseFilters($getQuery);
        } catch (UnknownOperan $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
            return new InvalidRequestErrorResponse('Invalid filter content.');
        }

        try {
            /**
             * @var \Illuminate\Database\Query\Builder
             */
            $query = (new $modelClass())->newQuery();
            foreach ($filters as $filter) {
                $query = call_user_func_array([empty($query) ? $model : $query, 'where'], $filter);
            }
            $response = [];
            if (array_key_exists('_count', $getQuery)) {
                $response['count'] = $query->count()->get();
            } else {
                $response['data'] = $query->get();
                $response['count'] = count($response['data']);
            }
            return new Response($response);
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        return new ErrorResponse('Could not fetch entitites.');
    }
}
