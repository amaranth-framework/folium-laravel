<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/eloquent/CrudController.php';

use Itmcdev\Folium\Tests\Crud\Eloquent\CrudController;

use PHPUnit\Framework\TestCase;

final class CrudTest extends TestCase
{

    private $controller;
    
    public function setUp()
    {
        parent::setUp();
        $this->controller = new CrudController();
    }

    function newUserData() {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT)
        ];
    }

    function testCreateMethoExists() {
        $this->assertTrue(method_exists($this->controller, 'create'));
    }

    /**
     * Test creation of one entity.
     */
    function testCreateOne()
    {
        $result = null;
        try {
            $result = $this->controller->create($this->newUserData());
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());
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
        $result = null;
        try {
            $result = $this->controller->create([ $this->newUserData() ]);
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());
        }
        $this->assertTrue(count($result) > 0);
        $this->assertEquals(count($result), 1);
        return $result;
    }
    
    /**
     * Test creation of one entity (from array)
     */
    function testCreateOneFromArrayMultiple()
    {
        $models = [
            $this->newUserData(),
            $this->newUserData()
        ];
        $result = null;
        try {
            $result = $this->controller->create($models);
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());
        }
        $this->assertTrue(count($result) > 0);
        $this->assertEquals(count($result), 2);
        return $result;
    }
}