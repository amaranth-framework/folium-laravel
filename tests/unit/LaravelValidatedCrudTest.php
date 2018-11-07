<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/eloquent/ValidatedCrudController.php';
require_once __DIR__ . '/LaravelSimpleCrudTest.php';

use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedCrudController;
use Itmcdev\Folium\Tests\Crud\LaravelSimpleCrudTest;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelValidatedCrudTest extends LaravelSimpleCrudTest
    {   
        public function setUp()
        {
            parent::setUp();
            $this->controller = new ValidatedCrudController();
        }
    }

} else {

    class LaravelValidatedCrudTest extends LaravelSimpleCrudTest
    {
        
    }

}