<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud\Exception;

require_once __DIR__ . '/../../TestCase.php';
require_once __DIR__ . '/../../../Eloquent/Controller/Crud/Simple.php';

use Itmcdev\Folium\Tests\Eloquent\Controller\Crud\Simple;
use Itmcdev\Folium\Tests\Laravel\TestCase as TestCaseDefault;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    /**
     * @runTestsInSeparateProcesses
     */
    class TestCase extends TestCaseDefault
    {

        function testMock()
        {
            $this->assertTrue(true);
        }

        /***********************************************************************
         * Setup
         ***********************************************************************/

        protected $controller;
        
        public function setUp()
        {
            parent::setUp();
            self::stopDbConnection();
            $this->controller = new Simple();
        }

    }

} else {

    class TestCase extends TestCaseDefault
    {
        
    }

}