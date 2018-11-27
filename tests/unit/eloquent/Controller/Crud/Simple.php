<?php

namespace Itmcdev\Folium\Tests\Eloquent\Controller\Crud;

require_once __DIR__ . '/../../Model/Simple.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Itmcdev\Folium\Tests\Eloquent\Model\Simple as SimpleModel;

class Simple
{

    private $_modelClass = SimpleModel::class;

    use Create;
    use Read;
    use Update;
    use Delete;
}