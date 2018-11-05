<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/LaravelTestCase.php';
require_once __DIR__ . '/eloquent/SimpleCrudController.php';

use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleCrudController;
use Itmcdev\Folium\Tests\Crud\LaravelTestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelExceptionTest extends LaravelTestCase
    {

        /***********************************************************************
         * Unit Tests
         ***********************************************************************/

        // /**
        //  * @expectedException \Itmcdev\Folium\Crud\Exception\CreateException
        //  */
        // function testCreateExceptionViaConnection()
        // {
        //     $simpleModel = $this->newModelData();
        //     $simpleModel['id'] = 'test';
        //     $this->controller->create($simpleModel);
        //     $this->assertTrue(true);
        // }

        // /**
        //  * @expectedException \Itmcdev\Folium\Crud\Exception\ReadException
        //  */
        // function testReadExceptionViaConnection()
        // {
        //     $this->controller->read([['id', 1]]);
        //     $this->assertTrue(true);
        // }

        // /**
        //  * @expectedException \Itmcdev\Folium\Crud\Exception\ReadException
        //  */
        // function testReadExceptionViaInvalidArgument()
        // {
        //     $this->controller->read(['id', 1]);
        //     $this->assertTrue(true);
        // }

        /***********************************************************************
         * Setup
         ***********************************************************************/

        protected $controller;
        
        public function setUp()
        {
            parent::setUp();
            self::stopDbConnection();
            $this->controller = new SimpleCrudController();
        }

    }

} else {

    class LaravelExceptionTest extends LaravelTest
    {
        
    }

}