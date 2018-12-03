<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/TestCaseSimple.php';
require_once __DIR__ . '/SimpleTest.php';
require_once __DIR__ . '/../../Eloquent/Controller/Crud/Validated.php';

use Itmcdev\Folium\Tests\Eloquent\Controller\Crud\Validated;
use Itmcdev\Folium\Tests\Laravel\Crud\SimpleTest;
use Itmcdev\Folium\Tests\Laravel\Crud\TestCaseSimple;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class ValidatedTest extends SimpleTest
    {
        public function setUp()
        {
            parent::setUp();
            $this->controller = new Validated();
        }
    }

} else {

    class ValidatedTest extends TestCaseSimple
    { }

}