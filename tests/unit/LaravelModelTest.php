<?php
declare(strict_types=1);

require_once 'eloquent/User.php';

use PHPUnit\Framework\TestCase;

final class LaravelModelTest extends TestCase
{

    function testCreate()
    {
        $user = null;
        try {
            $faker = \Faker\Factory::create();

            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT)
            ]);
        } catch (\Exception $e) {}
        $this->assertTrue($user !== null);
    }

    function testFind()
    {
        $user = null;
        try {
            $user = User::where('id', 1)->get()[0];
        } catch (\Exception $e) {}
        $this->assertTrue(!empty($user->id));
        $this->assertEquals($user->id, 1);
    }
}