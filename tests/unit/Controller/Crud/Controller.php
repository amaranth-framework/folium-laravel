<?php

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Crud;

use Itmcdev\Folium\Illuminate\Operation\Crud\Create;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Read;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Update;
// use Itmcdev\Folium\Illuminate\Operation\Crud\Delete;
use Itmcdev\Folium\Illuminate\Tests\Model\Simple;

class Controller
{
    use \Itmcdev\Folium\Illuminate\Controller\Crud\Controller;

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
        // Read $read,
        // Update $update,
        // Delete $delete,
        string $modelClass = Simple::class
    ) {
        $this->create = $create;
        // $this->read = $read;
        // $this->update = $update;
        // $this->delete = $delete;
        $this->setModelClass($modelClass);
    }
}
