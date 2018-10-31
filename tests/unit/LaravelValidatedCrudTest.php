<?php
// declare(strict_types=1);

// namespace Itmcdev\Folium\Tests\Crud;

// require_once __DIR__ . '/eloquent/ValidatedCrudController.php';
// require_once __DIR__ . '/LaravelSimpleCrudTest.php';

// use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedCrudController;
// use Itmcdev\Folium\Tests\Crud\LaravelSimpleCrudTest;

// class LaravelValidatedCrudTest extends LaravelSimpleCrudTest
// {   
//     public function setUp()
//     {
//         parent::setUp();
//         $this->controller = new ValidatedCrudController();
//     }

//     /**
//      * @expectedException \Itmcdev\Folium\Crud\Exception\ValidationException
//      */
//     function testCreateWithValidationException() {
//         $this->controller->create(['id' => 'test']);
//         $this->assertTrue(true);
//     }
// }