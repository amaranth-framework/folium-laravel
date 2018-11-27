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

use Itmcdev\Folium\Crud\Eloquent\Delete as CrudDelete;
use Itmcdev\Folium\Crud\Exception\RemoveException as CrudRemoveException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException as CrudUnspecifiedModelException;
use Itmcdev\Folium\Crud\Exception\ValidationException as CrudValidationError;
use Itmcdev\Folium\Rest\Illuminate\Remove as RemoveInterface;
use Itmcdev\Folium\Util\Rest\RestUtils;

/**
 * Trait proposal for REST Remove method implementation on Laravel's Eloquent
 */
trait Remove {

    use CrudDelete {
        CrudDelete::remove as crudDelete;
    }

    /**
     * @see RemoveInterface::remove()
     */
    public function remove(Request $request)
    {
        // Remove method functions only for HTTP DELETE method
        if (!$request->isMethod(Request::METHOD_DELETE)) {
            return RestUtils::respondWithInvalidMethod();
        }

        if (!$this->_modelClass) {
            return RestUtils::respondWithUnspecifiedModel();
        }
        $modelClass = $this->_modelClass;
        
        $pKey = (new $modelClass)->getKey();
        $id = $request->query->get('id', null);

        try {
            return RestUtils::respondWithSuccess($this->crudDelete(
                [],
                $id ? 
                    [ $pKey => $id ] : 
                    // @see RequestUtils::requestToCriteria
                    method_exists($this, 'requestToCriteria') ? $this->requestToCriteria($request) : [],
                $request->query->has(__permanent) ? 
                    [ 'p_key' => $pKey, 'permanent' => true ] :
                    [ 'p_key' => $pKey ]
            ));
        } catch (CrudUnspecifiedModelException $e) {
            return RestUtils::respondWithUnspecifiedModel();
        }/* catch (CrudUnspecifiedModelException $e) { // no need to check this anymore
            return RestUtils::respondWithUnspecifiedModel();
        }*/ catch (RemoveException $e) {
            return RestUtils::respondWithError($e->getMessage());
        } finally {
            return RestUtils::respondWithUnknownError();
        }
    }
}
