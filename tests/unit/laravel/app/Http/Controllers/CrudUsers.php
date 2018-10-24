<?php

require "../../bootstrap.php";

namespace App\Http\Controllers;

use Itmcdev\Folium\Crud\Create;
use Itmcdev\Folium\Crud\Read;
use Itmcdev\Folium\Crud\Update;
use Itmcdev\Folium\Crud\Delete;

use Illuminate\Routing\Controller;

class RestController extends Controller
{
    use Create;
    use Read;
    use Update;
    use Delete;
}