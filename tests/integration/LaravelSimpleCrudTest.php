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

        // /***********************************************************************
        //  * Unit Tests (Read)
        //  ***********************************************************************/

        // /**
        //  * Test whether create method exists or not.
        //  */
        // function testReadMethoExists() {
        //     $this->assertTrue(method_exists($this->controller, 'read'));
        // }

        // /**
        //  * @depends testCreateOne
        //  */
        // function testReadOne()
        // {
        //     $ids = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $models = $this->controller->read([['id', '=', $ids[0]]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test method is returning one item array
        //     $this->assertCount(1, $models);
        //     // test to return the expected model as array
        //     $this->assertEquals($ids[0], $models[0]['id']);

        //     return $models[0];
        // }

        // /**
        //  * @depends testCreateOne
        //  */
        // function testReadOneWithFields()
        // {
        //     $ids = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $models = $this->controller->read([['id', '=', $ids[0]]], ['id', 'name']);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test method is returning one item array
        //     $this->assertCount(1, $models);
        //     // test to return the expected model as array
        //     $this->assertEquals($ids[0], $models[0]['id']);
        //     // test other fields should not be included
        //     $this->assertEmpty($models[0]['email']);
        //     // test requested fields should exist
        //     $this->assertTrue(!empty($models[0]['name']));
        // }

        // /**
        //  * @depends testCreateOne
        //  */
        // function testReadOneCount()
        // {
        //     $ids = func_get_args()[0];

        //     $count = 0;
        //     try {
        //         $count = $this->controller->read([['id', '=', $ids[0]]], [], ['count' => true]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning number (as per count option)
        //     $this->assertTrue(is_numeric($count));
        //     // test count option works
        //     $this->assertEquals(1, $count);
        // }

        // /**
        //  * @depends testCreateMultiple
        //  */
        // function testReadMultiple()
        // {
        //     $ids = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $models = $this->controller->read([['id', $ids]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(count($ids), $models);
        //     // test getting correct items
        //     $this->assertEquals($ids[0], $models[0]['id']);

        //     return $models;
        // }

        // /**
        //  * @depends testCreateMultiple
        //  */
        // function testReadMultipleOr()
        // {
        //     $ids = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $models = $this->controller->read([
        //             ['id', $ids[0]],
        //             ['id', $ids[1], 'or']
        //         ]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(count($ids), $models);
        //     // test getting correct items
        //     $this->assertEquals($ids[0], $models[0]['id']);
        // }

        // function testReadAll()
        // {
        //     $ids = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $models = $this->controller->read([]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertTrue(count($models) > 0);
        // }

        // /***********************************************************************
        //  * Unit Tests (Update)
        //  ***********************************************************************/

        // /**
        //  * Test whether create method exists or not.
        //  */
        // function testUpdateMethoExists() {
        //     $this->assertTrue(method_exists($this->controller, 'update'));
        // }

        // /**
        //  * @depends testReadOne
        //  */
        // function testUpdateOne()
        // {
        //     $item = func_get_args()[0];
        //     $item['password'] = $this->newModelData()['password'];

        //     $models = [];
        //     try {
        //         $models = $this->controller->update($item);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $item);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(1, $models);
        //     // test getting correct items
        //     $this->assertEquals($item['id'], $models[0]);
        // }

        // function testUpdateByCreate() {
        //     $item = $this->newModelData();

        //     $models = [];
        //     try {
        //         $models = $this->controller->update($item);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $model);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(1, $models);
        //     // test items ar numeric ids
        //     $this->assertTrue(is_numeric($models[0]));
        // }

        // /**
        //  * @depends testReadMultiple
        //  */
        // function testUpdateMultiple() {
        //     $items = array_map(function($item) {
        //         $item['password'] = $this->newModelData()['password'];
        //         return $item;
        //     }, func_get_args()[0]);
        //     $items[] = $this->newModelData();

        //     $models = [];
        //     try {
        //         $models = $this->controller->update($items);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $items);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(count($items), $models);
        //     // test getting correct items
        //     $this->assertEquals($items[0]['id'], $models[0]);
        // }

        // /**
        //  * @depends testReadMultiple
        //  */
        // function testUpdateByCriteria() {
        //     $ids = array_map(function($model) {
        //         return $model['id'];
        //     }, func_get_args()[0]);
            
        //     $models = [];
        //     try {
        //         $models = $this->controller->update(['name' => 'Jack'], [['id', $ids]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertFalse(is_object($models));
        //     $this->assertTrue(is_array($models));
        //     // test reading multiple
        //     $this->assertCount(count($ids), $models);
        //     // test getting correct items
        //     $this->assertEquals($ids[0], $models[0]);
        // }

        // /***********************************************************************
        //  * Unit Tests (Delete)
        //  ***********************************************************************/

        // /**
        //  * Test whether create method exists or not.
        //  */
        // function testDeleteMethoExists() {
        //     $this->assertTrue(method_exists($this->controller, 'delete'));
        // }

        // /**
        //  * @depends testReadOne
        //  */
        // function testDeleteOne()
        // {
        //     $item = func_get_args()[0];

        //     $models = [];
        //     try {
        //         $this->controller->delete([$item]);
        //         $models = $this->controller->read([['id', '=', $item['id']]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $item);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertTrue(is_array($models));
        //     $this->assertTrue(empty($models));
        // }

        // /**
        //  * @depends testReadMultiple
        //  */
        // function testDeleteMultiple()
        // {
        //     $items = func_get_args()[0];
        //     $ids = array_map(function($item) {
        //         return $item;
        //     }, $items);

        //     $models = [];
        //     try {
        //         $this->controller->delete($items);
        //         $models = $this->controller->read([['id', $ids]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertTrue(is_array($models));
        //     $this->assertTrue(empty($models));
        // }

        // function testDeleteByCriteria()
        // {
        //     $items = [
        //         $this->newModelData(),
        //         $this->newModelData()
        //     ];

        //     try {
        //         $items = $this->controller->create($items);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $items);
        //     }

        //     $ids = array_map(function($item) {
        //         return $item['id'];
        //     }, $items);

        //     $models = [];
        //     try {
        //         $this->controller->delete([], [['id', $ids]]);
        //         $models = $this->controller->read([['id', $ids]]);
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertTrue(is_array($models));
        //     $this->assertTrue(empty($models));
        // }

        // function testDeleteAll()
        // {
        //     $models = [];
        //     try {
        //         $this->controller->delete();
        //         $models = $this->controller->read();
        //     } catch (\Exception $e) {
        //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
        //     }

        //     // test method is returning array and not Laravel class instances
        //     $this->assertTrue(is_array($models));
        //     $this->assertTrue(empty($models));
        // }


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