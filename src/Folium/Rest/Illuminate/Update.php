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

use Itmcdev\Folium\Crud\Eloquent\Update as CrudUpdate;
use Itmcdev\Folium\Crud\Exception\UpdateException as CrudUpdateException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException as CrudUnspecifiedModelException;
use Itmcdev\Folium\Crud\Exception\ValidationException as CrudValidationError;
use Itmcdev\Folium\Rest\Illuminate\Update as UpdateInterface;
use Itmcdev\Folium\Util\Rest\RestUtils;

/**
 * Trait proposal for REST Update method implementation on Laravel's Eloquent
 */
trait Update {

    use CrudUpdate {
        CrudUpdate::update as crudUpdate;
    }

    /**
     * @see UpdateInterface::update()
     */
    public function update(Request $request)
    {
        // Update method functions only for HTTP PUT method
        if (!$request->isMethod(Request::METHOD_PUT)) {
            return RestUtils::respondWithInvalidMethod();
        }

        if (!$this->_modelClass) {
            return RestUtils::respondWithUnspecifiedModel();
        }
        $modelClass = $this->_modelClass;
        
        $pKey = (new $modelClass)->getKey();

        try {
            return RestUtils::respondWithSuccess($this->crudUpdate(
                $request->all(),
                [],
                [ 'p_key' => $key ]
            ));
        } catch (CrudUnspecifiedModelException $e) {
            return RestUtils::respondWithUnspecifiedModel();
        }/* catch (CrudUnspecifiedModelException $e) { // no need to check this anymore
            return RestUtils::respondWithUnspecifiedModel();
        }*/ catch (UpdateException $e) {
            return RestUtils::respondWithError($e->getMessage());
        } finally {
            return RestUtils::respondWithUnknownError();
        }
    }
}
