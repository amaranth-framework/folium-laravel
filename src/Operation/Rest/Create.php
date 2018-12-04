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

use Itmcdev\Folium\Crud\Exception\CreateException as CrudCreateException;
use Itmcdev\Folium\Crud\Eloquent\Create as CrudCreate;
use Itmcdev\Folium\Exception\UnspecifiedModelException;
use Itmcdev\Folium\Exception\ValidationException;
use Itmcdev\Folium\Rest\Create as CreateInterface;
use Itmcdev\Folium\Rest\Exception\CreateException;

/**
 * Trait proposal for CRUD Create method implementation on Laravel's Eloquent
 */
class Create extends CrudCreate implements CreateInterface
{

}
