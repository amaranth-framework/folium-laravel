<?php

namespace Itmcdev\Folium\Tests\Crud\Eloquent;

require_once __DIR__ . '/User.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Itmcdev\Folium\Tests\Crud\Eloquent\User;

class CrudController
{

    private $_modelClass = User::class;

    use Create;
    use Read;
    use Update;
    use Delete;
}