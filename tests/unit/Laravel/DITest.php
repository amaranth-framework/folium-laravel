<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel;

require_once __DIR__ . '/Crud/Controller.php';
require_once __DIR__ . '/Model/Simple.php';

use PHPUnit\Framework\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    final class DITest extends TestCase
    {

        /***********************************************************************
         * Setup
         ***********************************************************************/

        /**
         * @var \League\Container\Container
         */
        protected $container;

        public function setUp() {

            $this->container = new \League\Container\Container;
        }

        /***********************************************************************
         * Unit Tests
         ***********************************************************************/

        /**
         * Testing DI for \Itmcdev\Folium\Operation\Eloquent\Crud\Create
         */
        function testOperationEloquentCrudCreate()
        {
            $this->container
                ->add(\Itmcdev\Folium\Operation\Eloquent\Crud\Create::class)
                ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Simple::class);

            $instance = $this->container->get(\Itmcdev\Folium\Operation\Eloquent\Crud\Create::class);

            $this->assertTrue($instance instanceof \Itmcdev\Folium\Operation\Eloquent\Crud\Create);
        }

        /**
         * Testing DI for \Itmcdev\Folium\Tests\Laravel\Crud\Controller
         */
        function testTestsLaravelControllerCrudSimple()
        {

            $this->container
                ->add(\Itmcdev\Folium\Tests\Laravel\Crud\Controller::class)
                ->addArgument(\Itmcdev\Folium\Operation\Eloquent\Crud\Create::class)
                ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Simple::class);

            $this->container
                ->add(\Itmcdev\Folium\Operation\Eloquent\Crud\Create::class)
                ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Simple::class);

            $instance = $this->container->get(\Itmcdev\Folium\Tests\Laravel\Crud\Controller::class);

            $this->assertTrue($instance instanceof \Itmcdev\Folium\Tests\Laravel\Crud\Controller);
        }
    }

} else {

    final class DITest extends TestCase
    {
        
    }

}