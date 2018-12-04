<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../TestCase.php';

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class TestCase extends \Itmcdev\Folium\Tests\Laravel\TestCase
    {
        /***********************************************************************
         * Setup
         ***********************************************************************/

        public function setUp() {
            parent::setUp();

            $container = new \League\Container\Container;
            $container
                ->add(\Itmcdev\Folium\Tests\Laravel\Crud\Controller::class)
                ->addArgument(\Itmcdev\Folium\Operation\Eloquent\Crud\Create::class)
                ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Simple::class);

            foreach (['Create'/*, 'Read', 'Update', 'Delete'*/] as $operation) {
                $container
                    ->add(str_replace('Create', $operation, \Itmcdev\Folium\Operation\Eloquent\Crud\Create::class))
                    ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Simple::class);
            }

            $this->controller = $container->get(\Itmcdev\Folium\Tests\Laravel\Crud\Controller::class);
        }
    }

} else {

    class TestCase extends \Itmcdev\Folium\Tests\Laravel\TestCase
    {
        public function testOne() {
            $this->assertTrue(!class_exists('\Illuminate\Database\Capsule\Manager'));
        }
    }

}