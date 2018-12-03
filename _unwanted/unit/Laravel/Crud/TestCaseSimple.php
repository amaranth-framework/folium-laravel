<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/../TestCase.php';
require_once __DIR__ . '/../../Eloquent/Controller/Crud/Simple.php';

use Itmcdev\Folium\Tests\Eloquent\Controller\Crud\Simple;
use Itmcdev\Folium\Tests\Laravel\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class TestCaseSimple extends TestCase
    {

        /***********************************************************************
         * Setup
         ***********************************************************************/

        protected $controller;
        
        public function setUp()
        {
            parent::setUp();
            $this->controller = new Simple();
        }
    }

} else {

    class TestCaseSimple extends TestCase
    {
        
    }

}