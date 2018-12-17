<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Illuminate\Tests;

use Itmcdev\Folium\Illuminate\Tests\TestCase;

final class DITest extends TestCase
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    /**
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /***********************************************************************
     * Unit Tests
     ***********************************************************************/

    public function testContainer()
    {
        $this->assertTrue($this->container instanceof \Illuminate\Container\Container);
    }

    /**
     * Testing DI for \Itmcdev\Folium\Illuminate\Operation\Crud\Create
     */
    public function testOperationCrudCreate()
    {
        $instance = new \Itmcdev\Folium\Illuminate\Operation\Crud\Create(
            \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        );
        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Operation\Crud\Create);

        $instance = $this->container->make(
            \Itmcdev\Folium\Illuminate\Operation\Crud\Create
                ::class /*,
            [
                'modelClass' =>
                    \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
            ]*/
        );
        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Operation\Crud\Create);
    }

    /**
     * Testing DI for \Itmcdev\Folium\Illuminate\Tests\Controller\Crud\Controller
     */
    public function testTestsLaravelControllerCrudSimple()
    {
        $instance = $this->container->make(
            \Itmcdev\Folium\Illuminate\Tests\Controller\Crud\Controller
                ::class /*,
            [
                'create' => $this->container->make(
                    \Itmcdev\Folium\Illuminate\Operation\Crud\Create::class,
                    [
                        'modelClass' =>
                            \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
                    ]
                ),
                'modelClass' =>
                    \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
            ]*/
        );

        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Tests\Controller\Crud\Controller);
    }
}
