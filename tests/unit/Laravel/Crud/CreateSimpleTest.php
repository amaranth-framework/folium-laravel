<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/TestCaseSimple.php';

use Itmcdev\Folium\Tests\Laravel\Crud\TestCaseSimple;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class CreateSimpleTest extends TestCaseSimple
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
            $items = [
                $this->newModelData()
            ];

            $models = [];
            try {
                $models = $this->controller->create($items[0]);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $items[0]);
            }

            // test method is returning array and not Laravel class instances
            $this->assertFalse(is_object($models));
            $this->assertTrue(is_array($models));
            // test method has created and returning one item array
            $this->assertCount(1, $models);
            // test method is returning only arrays with model ids (numeric)
            $this->assertTrue(is_numeric($models[0]));

            return $models;
        }
        
        /**
         * Test creation of one entity (from array)
         */
        function testCreateOneFromArray()
        {
            $items = [
                $this->newModelData()
            ];

            $models = [];
            try {
                $models = $this->controller->create($items);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $items);
            }

            // test method is returning array and not Laravel class instances
            $this->assertFalse(is_object($models));
            $this->assertTrue(is_array($models));
            // test method has created and returning one item array
            $this->assertCount(1, $models);
            // test method is returning only arrays with model ids (numeric)
            $this->assertTrue(is_numeric($models[0]));

            return $models;
        }
        
        /**
         * Test creation of one entity (from array)
         */
        function testCreateMultiple()
        {
            $items = [
                $this->newModelData(),
                $this->newModelData()
            ];

            $models = [];
            try {
                $models = $this->controller->create($items);
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString(), $items);
            }

            // test method is returning array and not Laravel class instances
            $this->assertFalse(is_object($models));
            $this->assertTrue(is_array($models));
            // test method has created and returning two item array
            $this->assertCount(2, $models);
            // test method is returning only arrays with model ids (numeric)
            $this->assertTrue(is_numeric($models[0]));

            return $models;
        }
    }

} else {

    class CreateSimpleTest extends TestCaseSimple
    {
        
    }

}