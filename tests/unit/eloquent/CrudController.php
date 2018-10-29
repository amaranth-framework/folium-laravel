<?php

require_once  __DIR__ . '/User.php';

use Itmcdev\Folium\Crud\Eloquent\Create;
use Itmcdev\Folium\Crud\Eloquent\Read;
use Itmcdev\Folium\Crud\Eloquent\Update;
use Itmcdev\Folium\Crud\Eloquent\Delete;

use Illuminate\Routing\Controller;

class CrudController extends Controller
{

    private $_modelClass = '\User';

    use Create;
    use Read;
    use Update;
    use Delete;

    function testCreate()
    {
        $user = null;
        try {
            $user = User::create($this->newUserData());
        } catch (\Exception $e) {
            var_dump($e);
        }
        $this->assertTrue($user !== null);
    }
}