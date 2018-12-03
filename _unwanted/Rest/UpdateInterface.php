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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface UpdateInterface {

    /**
     * Merge the existing data of a single or multiple resources with the new data.
     * 
     * PATCH /messages/2
     * { "read": true }
     * Will call messages.patch(2, { "read": true }, {}) on the server. When no id is given by sending the request directly to the endpoint something like:
     * 
     * PATCH /messages?complete=false
     * { "complete": true }
     * Will call messages.patch(null, { complete: true }, { query: { complete: 'false' } }) on the server to change the status for all read messages.
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#update
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function update(Request $request, $id);

}
