<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface GetInterface {

    /**
     * Retrieve a single resource from the service.
     * 
     * GET /messages/1
     * 
     * Will return 
     * - new JsonResponse($foundObject, Response::HTTP_OK) when data is found
     * - new JsonResponse({ error: 'Entity not found' }, HTTP_NOT_FOUND)
     * - new 
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#get
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     * 
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function get(Request $request, $id);

}