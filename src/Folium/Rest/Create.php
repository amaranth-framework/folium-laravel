<?php

namespace Folium\Rest;

use Folium\Rest\Utils;

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
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $id
     * @return Response
     */
    public function create(Request $request) {
        // create method functions only for HTTP POST method
        if (!$request->isMethod(Request::METHOD_POST)) {
            return new InvalidRequestResponse();
        }
        // create method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            return new ErrorResponse('Rest method is missing model class.');
        }
        
        $data = $request->request->all();
        
        // if POST data is not an array of models
        if (!$this->isAssoc($data)) {
            $data = [ $data ];
        }
    }

}