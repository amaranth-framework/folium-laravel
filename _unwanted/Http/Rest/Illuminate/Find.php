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

namespace Itmcdev\Folium\Rest\Illuminate;

use Itmcdev\Folium\Crud\Eloquent\Read as CrudRead;
use Itmcdev\Folium\Crud\Exception\ReadException as CrudReadException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException as CrudUnspecifiedModelException;
use Itmcdev\Folium\Crud\Exception\ValidationException as CrudValidationError;
use Itmcdev\Folium\Util\Rest\RestUtils;

/**
 * Trait proposal for REST Find method implementation on Laravel's Eloquent
 */
trait Find
{

    use CrudRead {
        CrudRead::read as crudRead;
    }


    /**
     * @see FindInterface::find()
     *
     * @param Request $request
     */
    public function find(Request $request)
    {
        // create method functions only for HTTP GET method
        if (!$request->isMethod(Request::METHOD_GET)) {
            return RestUtils::respondWithInvalidMethod();
        }

        try {
            return $this->crudRead(
                // @see RequestUtils::requestToCriteria
                method_exists($this, 'requestToCriteria') ? $this->requestToCriteria($request) : [], 
                [], 
                [ 'count' => $request->query->has('__count') ]
            );
        } catch (CrudUnspecifiedModelException $e) {
            return RestUtils::respondWithUnspecifiedModel();
        } catch (CrudReadException $e) {
            return RestUtils::respondWithError($e->getMessage());
        } finally {
            return RestUtils::respondWithUnknownError();
        }
    }
}
