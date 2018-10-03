<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface CreateInterface {

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
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $id
     * @return Response
     */
    public function create(Request $request);

}