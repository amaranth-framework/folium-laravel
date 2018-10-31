<?php

namespace Itmcdev\Folium\Tests\Crud\Eloquent;

require_once __DIR__ . '/ValidatedModel.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedModel;

class ValidatedCrudController
{

    private $_modelClass = ValidatedModel::class;

    use Create;
    use Read;
    use Update;
    use Delete;
}