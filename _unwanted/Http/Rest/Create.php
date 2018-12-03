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
 * Inteface for impelenting REST Create method.
 */
interface Create {

    /**
     * Create a new resource with data which may also be an array.
     * 
     * POST /messages
     * { "text": "I really have to iron" }
     * 
     * POST /messages
     * [
     *   { "text": "I really have to iron" },
     *   { "text": "Do laundry" }
     * ]
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#create
     * -link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * -link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $id
     * @return Response
     */
    public function create(Request $request);

}
