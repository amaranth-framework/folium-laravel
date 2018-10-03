<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface UpdateInterface {

    /**
     * Remove a single or multiple resources:
     * 
     * DELETE /messages/2?cascade=true
     * Will call messages.remove(2, { query: { cascade: 'true' } }).
     * 
     * When no id is given by sending the request directly to the endpoint something like:
     * 
     * DELETE /messages?read=true
     * Will call messages.remove(null, { query: { read: 'true' } }) to delete all read messages.
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#remove
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function remove(Request $request, $id);

}