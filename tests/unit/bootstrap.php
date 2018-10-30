<?php

require __DIR__ . '/../../vendor/autoload.php';

require __DIR__ . '/Logger.php';

if (class_exists('\Illuminate\Database\Capsule\Manager')) {
    $app = [
        \Psr\Log\LoggerInterface::class => new \Illuminate\Log\Logger(new \Itmcdev\Folium\Tests\Crud\Logger())
    ];
    \Illuminate\Support\Facades\Log::setFacadeApplication($app);
 
    $capsule = new \Illuminate\Database\Capsule\Manager;
    
    $capsule->addConnection([
        "driver"   => "mysql",
        "host"     => "folium-mysql-test",
        // "host"     => "localhost",
        "database" => "dummy",
        "username" => "dummy",
        "password" => "dummy"
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $schema = \Illuminate\Database\Capsule\Manager::schema();
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

}