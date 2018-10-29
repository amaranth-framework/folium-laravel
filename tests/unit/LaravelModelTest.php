<?php
declare(strict_types=1);

require_once 'eloquent/User.php';

use PHPUnit\Framework\TestCase;

final class LaravelModelTest extends TestCase
{

    function newUserData() {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT)
        ]
    }

    function testCreate()
    {
        $user = null;
        try {
            $user = User::create($this->newUserData());
        } catch (\Exception $e) {
            var_dump($e);
        }
        $this->assertTrue($user !== null);
    }

    function testFind()
    {
        $createdUser = User::create($this->newUserData());
        $foundUser = null;
        try {
            $foundUser = User::where('id', $createdUser->id)->get()[0];
        } catch (\Exception $e) {
            var_dump($e);
        }
        $this->assertTrue(!empty($foundUser->id));
        $this->assertEquals($foundUser->id, $createdUser->id);
    }
}