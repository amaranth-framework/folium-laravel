<?php
// declare(strict_types=1);

// namespace Itmcdev\Folium\Tests\Crud;

// require_once __DIR__ . '/eloquent/SimpleModel.php';

// use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleModel;

// use PHPUnit\Framework\TestCase;

// final class LaravelDatabaseTest extends TestCase
// {

//     function newModelData() {
//         $faker = \Faker\Factory::create();
//         return [
//             'name' => $faker->name,
//             'email' => $faker->email,
//             'password' => password_hash("dsfdsafdsafasd",PASSWORD_BCRYPT)
//         ];
//     }

//     function testCreate()
//     {
//         $simpleModel = null;
//         try {
//             $simpleModel = SimpleModel::create($this->newModelData());
//         } catch (\Exception $e) {
//             var_dump($e);
//         }
//         $this->assertTrue($simpleModel !== null);
//     }
// }