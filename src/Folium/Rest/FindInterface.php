<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface FindInterface {

    /**
     * Retrieves a list of all matching resources from the service
     *
     * GET /messages?status=read&user=10
     * 
     * Will call messages.find({ query: { status: 'read', user: '10' } }) on the server.
     *
     * If you want to use any of the built-in find operands ($le, $lt, $ne, $eq, $in, etc.) the general format is as follows:
     * 
     * GET /messages?field[$operand]=value&field[$operand]=value2
     * 
     * For example, to find the records where field status is not equal to active you could do
     *
     * GET /messages?status[$ne]=active
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#find
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $id
     * @return Response
     */
    public function find(Request $request);

}