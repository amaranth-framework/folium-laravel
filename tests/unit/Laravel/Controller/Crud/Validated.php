<?php

namespace Itmcdev\Folium\Tests\Eloquent\Controller\Crud;

require_once __DIR__ . '/Simple.php';
require_once __DIR__ . '/../../Model/Validated.php';

use Itmcdev\Folium\Tests\Laravel\Controller\Crud\Simple;
use Itmcdev\Folium\Tests\Laravel\Model\Validated as ValidatedModel;

class Validated extends Simple
{
    /**
     * Undocumented function
     *
     * @param Create $create
     * @param Read $read
     * @param Update $update
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __constructor(Create $create, Read $read, Update $update, Delete $delete, string $modelClass = ValidatedModel::class)
    {
        super::__constructor($create, $read, $update, $delete, $modelClass);
    }
}