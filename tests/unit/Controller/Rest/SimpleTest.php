<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Rest;

use Itmcdev\Folium\Illuminate\Tests\Controller\Rest\TestCase;
// use Itmcdev\Folium\Util\RestUtils;

class SimpleTest extends TestCase
{
    /***********************************************************************
     * Unit Tests (Create)
     ***********************************************************************/

    // /**
    //  * Test creation of one entity.
    //  */
    // public function testCreateOne()
    // {
    //     $items = [$this->newModelData()];

    //     $models = $this->controller->create($items[0]);

    //     // test method is returning array and not Laravel class instances
    //     $this->assertFalse(is_object($models));
    //     $this->assertTrue(is_array($models));
    //     // test method has created and returning one item array
    //     $this->assertCount(1, $models);
    //     // test method is returning only arrays with model ids (numeric)
    //     $this->assertTrue(is_numeric($models[0]));

    //     return $models;
    // }

    // /**
    //  * Test creation of one entity (from array)
    //  */
    // public function testCreateOneFromArray()
    // {
    //     $items = [$this->newModelData()];

    //     $models = [];
    //     try {
    //         $models = $this->controller->create($items);
    //     } catch (\Exception $e) {
    //         var_dump($e->getMessage(), $e->getTraceAsString(), $items);
    //     }

    //     // test method is returning array and not Laravel class instances
    //     $this->assertFalse(is_object($models));
    //     $this->assertTrue(is_array($models));
    //     // test method has created and returning one item array
    //     $this->assertCount(1, $models);
    //     // test method is returning only arrays with model ids (numeric)
    //     $this->assertTrue(is_numeric($models[0]));

    //     return $models;
    // }

    // /**
    //  * Test creation of multiple entities (from array)
    //  */
    // public function testCreateMultiple()
    // {
    //     $items = [$this->newModelData(), $this->newModelData()];

    //     $models = [];
    //     try {
    //         $models = $this->controller->create($items);
    //     } catch (\Exception $e) {
    //         var_dump($e->getMessage(), $e->getTraceAsString(), $items);
    //     }

    //     // test method is returning array and not Laravel class instances
    //     $this->assertFalse(is_object($models));
    //     $this->assertTrue(is_array($models));
    //     // test method has created and returning two item array
    //     $this->assertCount(2, $models);
    //     // test method is returning only arrays with model ids (numeric)
    //     $this->assertTrue(is_numeric($models[0]));

    //     return $models;
    // }

    // /***********************************************************************
    //  * Unit Tests (Read)
    //  ***********************************************************************/

    // /**
    //  * Test reading one entity by it's ID
    //  *
    //  * @depends testCreateOne
    //  */
    // public function testReadOne()
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
    //  * Test reading one entity by it's ID, but obtain only certain fields
    //  *
    //  * @depends testCreateOne
    //  */
    // public function testReadOneWithFields()
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
    //  * Test reading one entity by it's ID, but obtain count only
    //  *
    //  * @depends testCreateOne
    //  */
    // public function testReadOneCount()
    // {
    //     $ids = func_get_args()[0];

    //     $count = 0;
    //     try {
    //         $count = $this->controller->read([['id', '=', $ids[0]]], [], [RestUtils::countProperty() => true]);
    //     } catch (\Exception $e) {
    //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
    //     }

    //     // test method is returning number (as per count option)
    //     $this->assertTrue(is_numeric($count));
    //     // test count option works
    //     $this->assertEquals(1, $count);
    // }

    // /**
    //  * Test reading multiple entities
    //  *
    //  * @depends testCreateMultiple
    //  */
    // public function testReadMultiple()
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
    //  * Test reading multiple entities (using OR)
    //  *
    //  * @depends testCreateMultiple
    //  */
    // public function testReadMultipleOr()
    // {
    //     $ids = func_get_args()[0];

    //     $models = [];
    //     try {
    //         $models = $this->controller->read([['id', $ids[0]], ['id', $ids[1], 'or']]);
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

    // /**
    //  * Test reading all items
    //  */
    // public function testReadAll()
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

    // //     /***********************************************************************
    // //      * Unit Tests (Update)
    // //      ***********************************************************************/

    // //     /**
    // //      * Test whether create method exists or not.
    // //      */
    // //     function testUpdateMethoExists() {
    // //         $this->assertTrue(method_exists($this->controller, 'update'));
    // //     }

    // /**
    //  * Test updating one entity by it's ID
    //  *
    //  * @depends testReadOne
    //  */
    // public function testUpdateOne()
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

    // /**
    //  * Test updating an item that doesn't actually exist
    //  */
    // public function testUpdateByCreate()
    // {
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
    //     // test items are numeric ids
    //     $this->assertTrue(is_numeric($models[0]));
    // }

    // /**
    //  * Test updating (replacing) multiple items at once
    //  *
    //  * @depends testReadMultiple
    //  */
    // public function testUpdateMultiple()
    // {
    //     $items = array_map(function ($item) {
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
    //  * Test updating (patching) multiple entities
    //  *
    //  * @depends testReadMultiple
    //  */
    // public function testUpdateByCriteria()
    // {
    //     $ids = array_map(function ($model) {
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

    // //     /**
    // //      * Test whether create method exists or not.
    // //      */
    // //     function testDeleteMethoExists() {
    // //         $this->assertTrue(method_exists($this->controller, 'delete'));
    // //     }

    // /**
    //  * Test deleting one item
    //  *
    //  * @depends testReadOne
    //  */
    // public function testDeleteOne()
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
    //  * Test deleting multiple items
    //  *
    //  * @depends testReadMultiple
    //  */
    // public function testDeleteMultiple()
    // {
    //     $items = func_get_args()[0];
    //     $ids = array_map(function ($item) {
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

    // /**
    //  * Test deleting multiple items by criteria
    //  */
    // public function testDeleteByCriteria()
    // {
    //     $items = [$this->newModelData(), $this->newModelData()];

    //     try {
    //         $items = $this->controller->create($items);
    //     } catch (\Exception $e) {
    //         var_dump($e->getMessage(), $e->getTraceAsString(), $items);
    //     }

    //     $models = [];
    //     try {
    //         $this->controller->delete([], [['id', $items]]);
    //         $models = $this->controller->read([['id', $items]]);
    //     } catch (\Exception $e) {
    //         var_dump($e->getMessage(), $e->getTraceAsString(), $ids);
    //     }

    //     // test method is returning array and not Laravel class instances
    //     $this->assertTrue(is_array($models));
    //     $this->assertTrue(empty($models));
    // }

    // /**
    //  * Test deleting all items
    //  */
    // public function testDeleteAll()
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
}
