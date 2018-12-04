<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel;

require_once __DIR__ . '/Controller/Crud/Simple.php';

use Itmcdev\Folium\Tests\Laravel\Controller\Crud\Simple as SimpleController;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase as TestCaseDefault;

if (class_exists('\Illuminate\Support\Facades\Log')) {
    $app = [
        \Psr\Log\LoggerInterface::class => new \Illuminate\Log\Logger(new \Itmcdev\Folium\Tests\Logger()),
        'validator' => new \Illuminate\Validation\Factory(new \Illuminate\Translation\Translator(new \Illuminate\Translation\ArrayLoader(), 'us'))
    ];
    \Illuminate\Support\Facades\Log::setFacadeApplication($app);
}

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class TestCase extends TestCaseDefault
    {

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

            $container = new \League\Container\Container;
            $container
                ->add(SimpleController::class)
                ->addArgument(\Itmcdev\Folium\Operation\Laravel\Crud\Create::class);
                // ->addArgument(\Itmcdev\Folium\Operation\Laravel\Crud\Read::class)
                // ->addArgument(\Itmcdev\Folium\Operation\Laravel\Crud\Update::class)
                // ->addArgument(\Itmcdev\Folium\Operation\Laravel\Crud\Delete::class)
                // ->addArgument(SimpleModel::class);

            foreach (['Create'/*, 'Read', 'Update', 'Delete'*/] as $key) {
                $container
                    ->add(str_replace('Create', $key, \Itmcdev\Folium\Operation\Laravel\Crud\Create::class))
                    ->addArgument(SimpleModel::class);
            }

            $this->controller = $container->get(\Itmcdev\Folium\Operation\Laravel\Crud\Create::class);
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
                "host"     => DATABASE_HOST,
                "database" => DATABASE_NAME,
                "username" => DATABASE_USER,
                "password" => DATABASE_PASS
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
            foreach (['simples', 'validateds'] as $t) {
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

    class TestCase extends TestCaseDefault
    {
        public function testOne() {
            $this->assertTrue(!class_exists('\Illuminate\Database\Capsule\Manager'));
        }
    }

}