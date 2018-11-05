<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/LaravelTestCase.php';
require_once __DIR__ . '/eloquent/SimpleCrudController.php';

use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleCrudController;
use Itmcdev\Folium\Tests\Crud\LaravelTestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelSimpleCrudTest extends LaravelTestCase
    {

        /***********************************************************************
         * Unit Tests (Create)
         ***********************************************************************/

        /**
         * Test whether create method exists or not.
         */
        function testCreateMethoExists() {
            $this->assertTrue(method_exists($this->controller, 'create'));
        }

        /**
         * Test creation of one entity.
         */
        function testCreateOne()
        {
            $models = [
                $this->newModelData()
            ];
            $result = [];
            try {
                $result = $this->controller->create($models[0]);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $models[0]);
            }
            $this->assertTrue(count($result) > 0);
            $this->assertEquals(count($result), 1);
            return $result;
        }
        
        /**
         * Test creation of one entity (from array)
         */
        function testCreateOneFromArray()
        {
            $models = [
                $this->newModelData()
            ];
            $result = [];
            try {
                $result = $this->controller->create($models);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $models);
            }
            $this->assertTrue(count($result) > 0);
            $this->assertEquals(count($result), 1);
            return $result;
        }
        
        /**
         * Test creation of one entity (from array)
         */
        function testCreateMultiple()
        {
            $models = [
                $this->newModelData(),
                $this->newModelData()
            ];
            $result = [];
            try {
                $result = $this->controller->create($models);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $models);
            }
            $this->assertTrue(count($result) > 0);
            $this->assertEquals(count($result), 2);
            return $result;
        }

        /***********************************************************************
         * Unit Tests (Create)
         ***********************************************************************/

        /**
         * Test whether create method exists or not.
         */
        function testReadMethoExists() {
            $this->assertTrue(method_exists($this->controller, 'read'));
        }

        /**
         * @depends testCreateOne
         */
        function testReadOne()
        {
            $ids = func_get_args()[0];
            $models = [];
            try {
                $models = $this->controller->read([['id', '=', $ids[0]]]);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
            }
            $this->assertCount(1, $models);
            $this->assertEquals($ids[0], $models[0]->id);
        }

        /**
         * @depends testCreateOne
         */
        function testReadOneWithFields()
        {
            $ids = func_get_args()[0];
            $models = [];
            try {
                $models = $this->controller->read([['id', '=', $ids[0]]], ['id', 'name']);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
            }
            $this->assertCount(1, $models);
            $this->assertEquals($ids[0], $models[0]->id);
            $this->assertFalse(defined($models[0]->email));
            $this->assertTrue(defined($models[0]->name));
        }

        /**
         * @depends testCreateOne
         */
        function testReadOneCount()
        {
            $ids = func_get_args()[0];
            $count = 0;
            try {
                $count = $this->controller->read([['id', '=', $ids[0]]], [], ['count' => true]);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
            }
            $this->assertEquals(1, $count);
        }

        /**
         * @depends testCreateMultiple
         */
        function testReadMultiple()
        {
            $ids = func_get_args()[0];
            $models = [];
            try {
                $models = $this->controller->read([['id', $ids]]);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
            }
            $this->assertCount(count($ids), $models);
            $this->assertEquals($ids[0], $models[0]->id);
        }

        /***********************************************************************
         * Setup
         ***********************************************************************/

        protected $controller;
        
        public function setUp()
        {
            parent::setUp();
            $this->controller = new SimpleCrudController();
        }
    }

} else {

    class LaravelValidatedCrudTest extends LaravelTest
    {
        
    }

}