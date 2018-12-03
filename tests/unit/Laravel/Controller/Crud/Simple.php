<?php

namespace Itmcdev\Folium\Tests\Eloquent\Controller\Crud;

require_once __DIR__ . '/../../Model/Simple.php';

use Itmcdev\Folium\Tests\Laravel\Model\Simple as SimpleModel;

use Itmcdev\Folium\Controller\Crud\Controller;

class Simple
{
    use Controller;

    /**
     * CRUD Controller Constructor
     *
     * @param Create $create
     * @param Read $read
     * @param Update $update
     * @param Delete $delete
     */
    public function __constructor(Create $create, Read $read, Update $update, Delete $delete, string $modelClass = SimpleModel::class)
    {
        $this->create = $create;
        $this->read = $read;
        $this->update = $update;
        $this->delete = $delete;
        $this->modelClass = $modelClass;
    }
}