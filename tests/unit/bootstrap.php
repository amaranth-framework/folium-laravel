<?php

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
 
$capsule = new Capsule;
 
$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"folium-mysql-test",
    // "host" =>"localhost",
    "database" => "dummy",
    "username" => "dummy",
    "password" => "dummy"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$schema = Capsule::schema();
if ($schema->hasTable('users')) {
    $schema->drop('users');
}
$schema->create('users', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('userimage')->nullable();
    $table->string('api_key')->nullable()->unique();
    $table->rememberToken();
    $table->timestamps();
});