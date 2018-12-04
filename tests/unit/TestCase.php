<?php

namespace Itmcdev\Folium\Illuminate\Tests;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase as TestCaseDefault;

$app = [
    \Psr\Log\LoggerInterface::class =>
        new \Illuminate\Log\Logger(new \Itmcdev\Folium\Illuminate\Tests\Logger()),
    'validator' =>
        new \Illuminate\Validation\Factory(
            new \Illuminate\Translation\Translator(
                new \Illuminate\Translation\ArrayLoader(),
                'us'
            )
        )
];
\Illuminate\Support\Facades\Log::setFacadeApplication($app);

class TestCase extends TestCaseDefault
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    protected static $capsule;

    public static function setUpBeforeClass()
    {
        self::startDbConnection();
        self::schema();
        self::stopDbConnection();
    }

    public function setUp()
    {
        self::startDbConnection();
        $this->initCI();
    }

    public function tearDown()
    {
        self::stopDbConnection();
    }

    public static function tearDownAfterClass()
    {
    }

    /***********************************************************************
     * Additional Functionality
     ***********************************************************************/
    
    protected function initCI()
    {
        $this->container = new Container();
        Container::setInstance($this->container);
    }

    protected static function startDbConnection()
    {
        self::$capsule = new Capsule();
        self::$capsule->addConnection([
            "driver" => "mysql",
            "host" => DATABASE_HOST,
            "database" => DATABASE_NAME,
            "username" => DATABASE_USER,
            "password" => DATABASE_PASS
        ]);
        self::$capsule->setAsGlobal();
        self::$capsule->bootEloquent();
    }

    protected static function stopDbConnection()
    {
        Capsule::disconnect();
        self::$capsule->addConnection([]);
    }

    protected static function schema()
    {
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
                $table
                    ->string('api_key')
                    ->nullable()
                    ->unique();
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    function newModelData()
    {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => password_hash("dsfdsafdsafasd", PASSWORD_BCRYPT)
        ];
    }
}
