<?php
declare(strict_types=1);

require_once __DIR__ . '/eloquent/User.php';

use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{

    function newUserData() {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => password_hash("ahmedkhan",PASSWORD_BCRYPT)
        ];
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
}