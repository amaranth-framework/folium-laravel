<?php

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Rest;

use Itmcdev\Folium\Illuminate\Operation\Rest\Create;
use Itmcdev\Folium\Illuminate\Operation\Rest\Fetch;
use Itmcdev\Folium\Illuminate\Operation\Rest\Retreive;
use Itmcdev\Folium\Illuminate\Operation\Rest\Update;
use Itmcdev\Folium\Illuminate\Operation\Rest\Replace;
use Itmcdev\Folium\Illuminate\Operation\Rest\Delete;

class Controller extends \Itmcdev\Folium\Controller\Controller
{

   /**
     * Default Controller trait
     */
    use \Itmcdev\Folium\Controller\Rest\Controller;

    /**
     * REST Controller Constructor
     *
     * @param Create $create
     * @param Fetch $fetch
     * @param Retreive $retreive
     * @param Update $update
     * @param Replace $replace
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __constructor(
        Create $create,
        Fetch $fetch,
        Retreive $retreive,
        Update $update,
        Replace $replace,
        Delete $delete,
        string $modelClass
    ) {
        $this->setCreate($create)
            ->setFetch($fetch)
            ->setRetreive($retreive)
            ->setUpdate($update)
            ->setReplace($replace)
            ->setDelete($delete)
            ->setModelClass($modelClass);
    }
}