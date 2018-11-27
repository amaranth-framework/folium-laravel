<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/TestCaseSimple.php';
require_once __DIR__ . '/CreateSimpleTest.php';
require_once __DIR__ . '/../../Eloquent/Controller/Crud/Validated.php';

use Itmcdev\Folium\Tests\Eloquent\Controller\Crud\Validated;
use Itmcdev\Folium\Tests\Laravel\Crud\CreateSimpleTest;
use Itmcdev\Folium\Tests\Laravel\Crud\TestCaseSimple;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class CreateValidatedTest extends CreateSimpleTest
    {
        public function setUp()
        {
            parent::setUp();
            $this->controller = new Validated();
        }
    }

} else {

    class CreateValidatedTest extends TestCaseSimple
    { }

}