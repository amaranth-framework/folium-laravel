<?php

namespace Itmcdev\Folium\Tests\Eloquent\Controller\Crud;

require_once __DIR__ . '/Simple.php';
require_once __DIR__ . '/../../Model/Validated.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Itmcdev\Folium\Tests\Eloquent\Controller\Crud\Simple;
use Itmcdev\Folium\Tests\Eloquent\Model\Validated as ValidatedModel;

class Validated extends Simple
{
    private $_modelClass = ValidatedModel::class;
}