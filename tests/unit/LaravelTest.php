<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/eloquent/SimpleModel.php';

use Illuminate\Database\Capsule\Manager as Capsule;

use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleModel;

use PHPUnit\Framework\TestCase;

if (class_exists('\Illuminate\Support\Facades\Log')) {
    $app = [
        \Psr\Log\LoggerInterface::class => new \Illuminate\Log\Logger(new \Itmcdev\Folium\Tests\Crud\Logger()),
        'validator' => new \Illuminate\Validation\Factory(new \Illuminate\Translation\Translator(new \Illuminate\Translation\ArrayLoader(), 'us'))
    ];
    \Illuminate\Support\Facades\Log::setFacadeApplication($app);
}

final class LaravelDatabaseTest extends TestCase
{
    protected $capsule; 

    protected function startDbConnection() {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            "driver"   => "mysql",
            "host"     => "folium-mysql-test",
            "database" => "dummy",
            "username" => "dummy",
            "password" => "dummy"
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    protected function stopDbConnection() {
        $this->capsule->getConnection('default')->disconnect();
    }

    protected function schema() {
        $schema = Capsule::schema();
        foreach (['simple_models', 'validated_models'] as $t) {
            if ($schema->hasTable($t)) {
                $schema->drop($t);
            }
            $schema->create($t, function ($table) {
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
    }

    public function setUp() {
        $this->startDbConnection();
        $this->schema();
    }

    public function tearDown()
    {
        $this->stopDbConnection();
    }
    

    function newModelData() {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => password_hash("dsfdsafdsafasd",PASSWORD_BCRYPT)
        ];
    }

    function testCreate()
    {
        $simpleModel = null;
        try {
            $simpleModel = SimpleModel::create($this->newModelData());
        } catch (\Exception $e) {
            var_dump($e);
        }
        $this->assertTrue($simpleModel !== null);
    }
}