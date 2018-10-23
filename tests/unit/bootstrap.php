<?php

require __DIR__ . '/../../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
 
$capsule = new Capsule;
 
$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"folium-mysql-test",
    "database" => "dummy",
    "username" => "dummy",
    "password" => "dummy"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();