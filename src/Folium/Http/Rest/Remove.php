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

interface Remove {

    /**
     * Remove a single or multiple resources:
     * 
     * DELETE /messages/2?cascade=true
     * Will call messages.remove(2, { query: { cascade: 'true' } }).
     * 
     * When no id is given by sending the request directly to the endpoint something like:
     * 
     * DELETE /messages?read=true
     * Will call messages.remove(null, { query: { read: 'true' } }) to delete all read messages.
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#remove
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function remove(Request $request, $id);

}
