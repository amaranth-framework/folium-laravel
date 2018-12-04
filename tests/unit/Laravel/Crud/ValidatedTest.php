<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel\Crud;

require_once __DIR__ . '/../Model/Validated.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/SimpleTest.php';

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class ValidatedTest extends \Itmcdev\Folium\Tests\Laravel\Crud\SimpleTest
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
                ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Validated::class);

            foreach (['Create'/*, 'Read', 'Update', 'Delete'*/] as $operation) {
                $container
                    ->add(str_replace('Create', $operation, \Itmcdev\Folium\Operation\Eloquent\Crud\Create::class))
                    ->addArgument(\Itmcdev\Folium\Tests\Laravel\Model\Validated::class);
            }

            $this->controller = $container->get(\Itmcdev\Folium\Tests\Laravel\Crud\Controller::class);
        }
    }

} else {

    class ValidatedTest extends \Itmcdev\Folium\Tests\Laravel\Crud\SimpleTest
    { }

}