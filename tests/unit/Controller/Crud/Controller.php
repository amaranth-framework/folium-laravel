<?php

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Crud;

use Itmcdev\Folium\Controller\Controller as AbstractController;
use Itmcdev\Folium\Illuminate\Operation\Crud\Create;
use Itmcdev\Folium\Illuminate\Operation\Crud\Read;
use Itmcdev\Folium\Illuminate\Operation\Crud\Update;
use Itmcdev\Folium\Illuminate\Operation\Crud\Delete;

class Controller extends AbstractController
{
    use \Itmcdev\Folium\Controller\Crud\Controller;

    /**
     * CRUD Controller Constructor
     *
     * @param Create $create
     * @param Read $read
     * @param Update $update
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __construct(
        Create $create,
        Read $read,
        Update $update,
        Delete $delete,
        string $modelClass = null
    ) {
        $this->setCreate($create)
            ->setRead($read)
            ->setUpdate($update)
            ->setDelete($delete)
            ->setModelClass($modelClass);
    }
}
