<?php

namespace Itmcdev\Folium\Rest;

use Itmcdev\Folium\Exception\UnidentifiableModelType;
use Itmcdev\Folium\Http\Response\BadRequestErrorResponse;
use Itmcdev\Folium\Http\Response\CreatedResponse;
use Itmcdev\Folium\Http\Response\ErrorResponse;
use Itmcdev\Folium\Http\Response\InvalidModelErrorResponse;
use Itmcdev\Folium\Rest\Utils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

trait Create {

    use Utils;

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
     * 
     * @link https://laravel.com/api/5.3/Illuminate/Http/Request.html
     * @link https://github.com/illuminate/http/blob/master/Request.php
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/Request.html
     * @link https://github.com/symfony/http-foundation/blob/master/Request.php
     *
     * @throws UnidentifiableModelType
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) {
        // create method functions only for HTTP POST method
        if (!$request->isMethod(Request::METHOD_POST)) {
            return new BadRequestErrorResponse();
        }
        // create method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            return new InvalidModelErrorResponse();
        }
        
        $dataArray = $request->request->all();
        
        // if POST data is not an array of models
        if (!$this->isAssoc($dataArray)) {
            $dataArray = [ $dataArray ];
        }

        $modelClass = $this->modelClass;

        // 
        // If using Laravel Eloquent model types
        // 
        if ($this->isLaravelModel($modelClass))  {
            // if there is a validation method, try and validate data
            if (method_exists("$modelClass::validate")) {
                foreach ($dataArray as $data) {
                    $validator = $modelClass::validate($data);
                    if ($validator->fails()) {
                        return new ValidationErrorResponse($validator->errors());
                    }
                }
            }
            // attempt and save all data. if attempt fails, delete all saved data and return error.
            $models = [];
            try {
                foreach ($dataArray as $data) {
                    // check if there is any transform before save option
                    $data = method_exists($this, 'beforeCreateTransform') ? $this->beforeCreateTransform($data) : $data;
                    // attempt save
                    $models[] = $modelClass::create($data);
                }
                return new CreatedResponse($models);
            } catch (\Exception $e) {
                if (count($models)) {
                    try {
                        foreach ($models as $model) {
                            $model->delete();
                        }
                    } catch (\Exception $e2) {
                        Log::error(sprintf('%s => %s', $e2->__toString(), $e2->getTraceAsString()));
                        return new ErrorResponse('Could not create entity (entities). Rollback process failed, please address administrator.');
                    }
                }
                Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
                return new ErrorResponse('Could not create entity (entities).');
            }
        }

        // 
        // If using Doctrine model types
        // 
        // TODO:

        throw new UnidentifiableModelType();
    }
}
