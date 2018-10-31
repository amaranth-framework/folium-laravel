<?php

namespace Itmcdev\Folium\Tests\Crud\Eloquent;

require_once __DIR__ . '/SimpleModel.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleModel;

class SimpleCrudController
{

    private $_modelClass = SimpleModel::class;

    use Create;
    use Read;
    use Update;
    use Delete;
}