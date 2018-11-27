<?php

namespace Itmcdev\Folium\Tests\Eloquent;

require_once __DIR__ . '/SimpleRestController.php';
require_once __DIR__ . '/ValidatedModel.php';

use Itmcdev\Folium\Rest\Eloquent\Create;
use Itmcdev\Folium\Rest\Eloquent\List;
use Itmcdev\Folium\Rest\Eloquent\Retreive;
use Itmcdev\Folium\Rest\Eloquent\Replace;
use Itmcdev\Folium\Rest\Eloquent\Update;
use Itmcdev\Folium\Rest\Eloquent\Delete;

use Itmcdev\Folium\Tests\Rest\Eloquent\ValidatedModel;
use Itmcdev\Folium\Tests\Rest\Eloquent\ValidatedModel;

class ValidatedRestController
{

    private $_modelClass = ValidatedModel::class;

    use Create;
    use List;
    use Retreive;
    use Replace;
    use Update;
    use Delete;
}