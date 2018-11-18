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

use Itmcdev\Folium\Util\Rest\EloquentUtils;

// use Itmcdev\Folium\Exception\UnidentifiableModelType;
// use Itmcdev\Folium\Http\Response\BadRequestErrorResponse;
// use Itmcdev\Folium\Http\Response\CreatedResponse;
// use Itmcdev\Folium\Http\Response\ErrorResponse;
// use Itmcdev\Folium\Http\Response\InvalidModelErrorResponse;
// use Itmcdev\Folium\Rest\CreateInterface;
// use Itmcdev\Folium\Rest\Utils;

swtich (true) {
    case class_exists('\Illuminate\Http\Request'):
        class_alias('\Illuminate\Http\Request', 'Request');
        class_alias('\Illuminate\Http\Response', 'Response');
        break;
    default:
        class_alias('\Symfony\Component\HttpFoundation\Request', 'Request');
        class_alias('\Symfony\Component\HttpFoundation\Response', 'Response');
}

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
            return EloquentUtils::respondWithInvalidMethod();
        }

        $data = [];

        try {
            $this->crudCreate($request->all());
        } catch (CrudUnspecifiedModelException $e) {
            return EloquentUtils::respondWithInvalidModel();
        } catch (CreateException $e) {

        }

        return new JsonResponse([
            'status' => RestUtils::STATUS_SUCCESS,
            'data' => $this->crudCeate($request->all())
        ]);

        // // create method requires ::_modelClass variable to be able to init the model
        // if (!$this->_modelClass) {
        //     return new InvalidModelErrorResponse();
        // }
        
        // $dataArray = $request->request->all();
        
        // // if POST data is not an array of models
        // if (!$this->isAssoc($dataArray)) {
        //     $dataArray = [ $dataArray ];
        // }

        // $modelClass = $this->modelClass;

        // // if there is a validation method, try and validate data
        // if (method_exists("$modelClass::validate")) {
        //     foreach ($dataArray as $data) {
        //         $validator = $modelClass::validate($data);
        //         if ($validator->fails()) {
        //             return new ValidationErrorResponse($validator->errors());
        //         }
        //     }
        // }

        // // attempt and save all data. if attempt fails, delete all saved data and return error.
        // $models = [];
        // try {
        //     foreach ($dataArray as $data) {
        //         // check if there is any transform before save option
        //         $data = method_exists($this, 'beforeCreateTransform') ? $this->beforeCreateTransform($data) : $data;
        //         // attempt save
        //         $models[] = $modelClass::create($data);
        //     }
        //     return new CreatedResponse($models);
        // } catch (\Exception $e) {
        //     if (count($models)) {
        //         try {
        //             foreach ($models as $model) {
        //                 $model->delete();
        //             }
        //         } catch (\Exception $e2) {
        //             Log::error(sprintf('%s => %s', $e2->__toString(), $e2->getTraceAsString()));
        //             return new ErrorResponse('Could not create entity (entities). Rollback process failed, please address administrator.');
        //         }
        //     }
        //     Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        // }
        // return new ErrorResponse('Could not create entity (entities).');
    }
}
