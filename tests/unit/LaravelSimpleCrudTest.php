<?php
// declare(strict_types=1);

// namespace Itmcdev\Folium\Tests\Crud;

// require_once __DIR__ . '/eloquent/SimpleCrudController.php';

// use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleCrudController;

// use PHPUnit\Framework\TestCase;

// class LaravelSimpleCrudTest extends TestCase
// {

//     protected $controller;
    
//     public function setUp()
//     {
//         parent::setUp();
//         $this->controller = new SimpleCrudController();
//     }

//     function newSimpleModelData() {
//         $faker = \Faker\Factory::create();
//         return [
//             'name' => $faker->name,
//             'email' => $faker->email,
//             'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT)
//         ];
//     }

//     function testCreateMethoExists() {
//         $this->assertTrue(method_exists($this->controller, 'create'));
//     }

//     /**
//      * Test creation of one entity.
//      */
//     function testCreateOne()
//     {
//         $models = [
//             $this->newSimpleModelData()
//         ];
//         $result = [];
//         try {
//             $result = $this->controller->create($models[0]);
//         } catch (\Exception $e) {
//             var_dump($e->getMessage(), $e->getTraceAsString(), $models[0]);
//         }
//         $this->assertTrue(count($result) > 0);
//         $this->assertEquals(count($result), 1);
//         return $result;
//     }
    
//     /**
//      * Test creation of one entity (from array)
//      */
//     function testCreateOneFromArray()
//     {
//         $models = [
//             $this->newSimpleModelData()
//         ];
//         $result = [];
//         try {
//             $result = $this->controller->create($models);
//         } catch (\Exception $e) {
//             var_dump($e->getMessage(), $e->getTraceAsString(), $models);
//         }
//         $this->assertTrue(count($result) > 0);
//         $this->assertEquals(count($result), 1);
//         return $result;
//     }
    
//     /**
//      * Test creation of one entity (from array)
//      */
//     function testCreateOneFromArrayMultiple()
//     {
//         $models = [
//             $this->newSimpleModelData(),
//             $this->newSimpleModelData()
//         ];
//         $result = [];
//         try {
//             $result = $this->controller->create($models);
//         } catch (\Exception $e) {
//             var_dump($e->getMessage(), $e->getTraceAsString(), $models);
//         }
//         $this->assertTrue(count($result) > 0);
//         $this->assertEquals(count($result), 2);
//         return $result;
//     }

//     /**
//      * @expectedException \Itmcdev\Folium\Crud\Exception\CreateException
//      */
//     function testCreateWithCreateException() {
//         $simpleModel = $this->newSimpleModelData();
//         $simpleModel['id'] = 'test';
//         $this->controller->create($simpleModel);
//         $this->assertTrue(true);
//     }
// }