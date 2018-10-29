<?php

require_once __DIR__ . '/../bootstrap.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

class CrudController
{

    private $_modelClass = '\User';

    use Create;
    use Read;
    use Update;
    use Delete;
}