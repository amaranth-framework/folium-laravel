<?php

namespace Itmcdev\Folium\Illuminate\Tests\Group\Crud;

use Itmcdev\Folium\Illuminate\Operation\Crud\Create;
use Itmcdev\Folium\Illuminate\Operation\Crud\Read;
use Itmcdev\Folium\Illuminate\Operation\Crud\Update;
use Itmcdev\Folium\Illuminate\Operation\Crud\Delete;

class Group extends \Itmcdev\Folium\Operation\Group\Crud
{
    /**
     * CRUD Group Constructor
     *
     * @param Create $create
     * @param Read $read
     * @param Update $update
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __construct(Create $create, Read $read, Update $update, Delete $delete, string $modelClass = null)
    {
        $this->setCreate($create)
            ->setRead($read)
            ->setUpdate($update)
            ->setDelete($delete)
            ->setModelClass($modelClass);
    }
}
