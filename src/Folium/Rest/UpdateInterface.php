<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface UpdateInterface {

    /**
     * Merge the existing data of a single or multiple resources with the new data.
     * 
     * PATCH /messages/2
     * { "read": true }
     * Will call messages.patch(2, { "read": true }, {}) on the server. When no id is given by sending the request directly to the endpoint something like:
     * 
     * PATCH /messages?complete=false
     * { "complete": true }
     * Will call messages.patch(null, { complete: true }, { query: { complete: 'false' } }) on the server to change the status for all read messages.
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#update
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function update(Request $request, $id);

}