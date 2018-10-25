<?php

require "../bootstrap.php";

namespace FoliumTest\Eloquent;

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Illuminate\Routing\Controller;

class CrudController extends Controller
{

    private $_modelClass = '\FoliumTest\Eloquent\User';

    use Create;
    use Read;
    use Update;
    use Delete;
}