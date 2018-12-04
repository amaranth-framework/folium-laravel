<?php

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/../Model/Simple.php';

use Itmcdev\Folium\Tests\Laravel\Model\Simple as SimpleModel;

class Controller
{
    use \Itmcdev\Folium\Controller\Crud\Controller;

    /**
     * @var \Itmcdev\Folium\Operation\Eloquent\Crud\Create
     */
    private $create = null;
}