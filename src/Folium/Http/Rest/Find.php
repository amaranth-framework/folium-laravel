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

namespace Itmcdev\Folium\Rest;

use Itmcdev\Folium\Http\Request;
use Itmcdev\Folium\Http\Response;

/**
 * Inteface for impelenting REST Find method.
 */
interface Find {

    /**
     * Retrieves a list of all matching resources from the service
     *
     * GET /messages?status=read&user=10
     *
     * If you want to use any of the built-in find operands ($le, $lt, $ne, $eq, $in, etc.) the general format is as follows:
     * 
     * GET /messages?field[$operand]=value&field[$operand]=value2
     * 
     * For example, to find the records where field status is not equal to active you could do
     *
     * GET /messages?status[$ne]=active
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#find
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $id
     * @return Response
     */
    public function find(Request $request);

}
