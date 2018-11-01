<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/eloquent/SimpleModel.php';
require_once __DIR__ . '/eloquent/ValidatedModel.php';

use Illuminate\Database\Capsule\Manager as Capsule;

use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleModel;
use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedModel;

use PHPUnit\Framework\TestCase;

if (class_exists('\Illuminate\Support\Facades\Log')) {
    $app = [
        \Psr\Log\LoggerInterface::class => new \Illuminate\Log\Logger(new \Itmcdev\Folium\Tests\Crud\Logger()),
        'validator' => new \Illuminate\Validation\Factory(new \Illuminate\Translation\Translator(new \Illuminate\Translation\ArrayLoader(), 'us'))
    ];
    \Illuminate\Support\Facades\Log::setFacadeApplication($app);
}

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelTest extends TestCase
    {

        /***********************************************************************
         * Unit Tests
         ***********************************************************************/

        function testCreateSimple()
        {
            $simpleModel = null;
            try {
                $simpleModel = SimpleModel::create($this->newModelData());
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString());
            }
            $this->assertTrue($simpleModel !== null);
        }

        function testCreateValidted()
        {
            $simpleModel = null;
            try {
                $simpleModel = ValidatedModel::create($this->newModelData());
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString());
            }
            $this->assertTrue($simpleModel !== null);
        }

        /***********************************************************************
         * Setup
         ***********************************************************************/

        protected static $capsule; 

        public static function setUpBeforeClass() {
            self::startDbConnection();
            self::schema();
            self::stopDbConnection();
        }

        public function setUp() {
            self::startDbConnection();
        }

        public function tearDown()
        {
            self::stopDbConnection();
        }

        public static function tearDownAfterClass() {

        }

        /***********************************************************************
         * Additional Functionality
         ***********************************************************************/

        protected static function startDbConnection() {
            self::$capsule = new Capsule;
            self::$capsule->addConnection([
                "driver"   => "mysql",
                "host"     => "folium-mysql-test",
                "database" => "dummy",
                "username" => "dummy",
                "password" => "dummy"
            ]);
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }

        protected static function stopDbConnection() {
            Capsule::disconnect();
            self::$capsule->addConnection([]);
        }

        protected static function schema() {
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

        function newModelData() {
            $faker = \Faker\Factory::create();
            return [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash("dsfdsafdsafasd",PASSWORD_BCRYPT)
            ];
        }
    }

} else {

    class LaravelTest extends TestCase
    {
        public function testOne() {
            $this->assertTrue(!class_exists('\Illuminate\Database\Capsule\Manager'));
        }
    }

}