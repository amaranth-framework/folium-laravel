<?php
declare(strict_types=1);

require_once __DIR__ . '/eloquent/CrudController.php';

namespace Itmcdev\Folium\Tests\Crud;

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

    /**
     * Test creation of one entity.
     */
    function testCreateOne()
    {
        $user = null;
        try {
            $user = $this->controller->create($this->newUserData());
        } catch (\Exception $e) {
            var_dump($e);
        }
        $this->assertTrue($user !== null);
        return $user->id;
    }
    
    // /**
    //  * Test creation of one entity (from array)
    //  */
    // function testCreateOneFromArray()
    // {
    //     $user = null;
    //     try {
    //         $user = $this->controller()->create([$this->newUserData()]);
    //     } catch (\Exception $e) {
    //         var_dump($e);
    //     }
    //     $this->assertTrue($user !== null);
    //     return $user->id;
    // }
    // }
    
    // /**
    //  * Test creation of one entity (from array)
    //  */
    // function testCreateOneFromArray()
    // {
    //     $models = [
    //         $this->newUserData(),
    //         $this->newUserData()
    //     ];
    //     $users = [];
    //     try {
    //         $users = $this->controller()->create($models);
    //     } catch (\Exception $e) {
    //         var_dump($e);
    //     }
    //     $this->assertTrue(count($users), count($models));
    //     return array_map(
    //         function ($user) { return $user->id },
    //         $users
    //     );
    // }
}