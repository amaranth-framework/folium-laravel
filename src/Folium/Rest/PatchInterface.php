<?php

namespace Folium\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface PatchInterface {

    /**
     * Completely replace a single or multiple resources.
     * 
     * PUT /messages/2
     * { "text": "I really have to do laundry" }
     * Will update `text` property for element with { id: 2 }
     * 
     * PUT /messages?complete=false
     * { "complete": true }
     * Will update with { "complete": true } all elements which have { "complete": false }.
     * 
     * @link https://docs.feathersjs.com/api/client/rest.html#patch
     * @link https://laravel.com/api/5.3/Illuminate/Http/JsonResponse.html
     * @link https://api.symfony.com/4.1/Symfony/Component/HttpFoundation/JsonResponse.html
     *
     * @param Request $request
     * @param number $id
     * @return Response
     */
    public function update(Request $request, $id);

}