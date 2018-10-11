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

namespace Itmcdev\Folium\Http\Response;

use Itmcdev\Folium\Http\Response\ErrorResponse;

use Symfony\Component\HttpFoundation\Response as BasicResponse;

/**
 * Basic 405 HTTP Response, used for cases where a certain method can be implemented, system is aware of it, 
 * but it shouldn't be implemented.
 */
class MethodNotAllowedErrorResponse extends ErrorResponse
{
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct('Invalid request type.', BasicResponse::HTTP_METHOD_NOT_ALLOWED);
    }
}
