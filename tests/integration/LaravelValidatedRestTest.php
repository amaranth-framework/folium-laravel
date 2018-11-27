<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Rest;

require_once __DIR__ . '/eloquent/ValidatedCrudController.php';
require_once __DIR__ . '/LaravelSimpleRestTest.php';

use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedCrudController;
use Itmcdev\Folium\Tests\Crud\LaravelSimpleRestTest;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelValidatedRestTest extends LaravelSimpleRestTest
    {   
        public function setUp()
        {
            parent::setUp();
            $this->controller = new ValidatedCrudController();
        }
    }

} else {

    class LaravelValidatedRestTest extends LaravelSimpleRestTest
    {
        
    }

}