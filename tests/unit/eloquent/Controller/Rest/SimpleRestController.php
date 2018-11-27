<?php

namespace Itmcdev\Folium\Tests\Eloquent;

require_once __DIR__ . '/SimpleModel.php';

use Itmcdev\Folium\Rest\Eloquent\Create;
use Itmcdev\Folium\Rest\Eloquent\List;
use Itmcdev\Folium\Rest\Eloquent\Retreive;
use Itmcdev\Folium\Rest\Eloquent\Replace;
use Itmcdev\Folium\Rest\Eloquent\Update;
use Itmcdev\Folium\Rest\Eloquent\Delete;

use Itmcdev\Folium\Tests\Rest\Eloquent\SimpleModel;

class SimpleRestController
{

    private $_modelClass = SimpleModel::class;

    use Create;
    use List;
    use Retreive;
    use Replace;
    use Update;
    use Delete;
}