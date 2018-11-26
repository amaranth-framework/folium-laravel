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

use Itmcdev\Folium\Crud\Create as CrudCreate;
use Itmcdev\Folium\Crud\Exception\CreateException as CrudCreateException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException as CrudUnspecifiedModelException;
use Itmcdev\Folium\Crud\Exception\ValidationException as CrudValidationError;
use Itmcdev\Folium\Util\Rest\RestUtils;

/**
 * Trait proposal for REST Create method implementation on Laravel's Eloquent
 */
trait Create {

    use CrudCreate {
        CrudCreate::create as crudCreate;
    }

    /**
     * @see CreateInterface::create()
     */
    public function create(Request $request)
    {
        // create method functions only for HTTP POST method
        if (!$request->isMethod(Request::METHOD_POST)) {
            return RestUtils::respondWithInvalidMethod();
        }

        try {
            return new RestUtils::respondWithSuccess($this->crudCeate($request->all()));
        } catch (CrudUnspecifiedModelException $e) {
            return RestUtils::respondWithUnspecifiedModel();
        } catch (CrudValidationError $e) {
            return RestUtils::respondWithValidationError($e->getMessage());
        } catch (CreateException $e) {
            return RestUtils::respondWithError($e->getMessage());
        } finally {
            return RestUtils::respondWithUnknownError();
        }
    }
}
