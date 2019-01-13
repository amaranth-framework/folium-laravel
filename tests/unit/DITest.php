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

        $instance = $this->container->make(\Itmcdev\Folium\Illuminate\Operation\Crud\Create::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        ]);

        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Operation\Crud\Create);
        $this->assertEquals(\Itmcdev\Folium\Illuminate\Tests\Model\Simple::class, $instance->getModelClass());
    }

    /**
     * Testing DI for \Itmcdev\Folium\Illuminate\Operation\Crud\Create with no model class
     */
    public function testOperationCrudCreateNoModelClass()
    {
        $instance = new \Itmcdev\Folium\Illuminate\Operation\Crud\Create(
            \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        );
        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Operation\Crud\Create);

        $instance = $this->container->make(\Itmcdev\Folium\Illuminate\Operation\Crud\Create::class);

        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Operation\Crud\Create);
        $this->assertEquals(null, $instance->getModelClass());
    }

    /**
     * Testing DI for \Itmcdev\Folium\Illuminate\Tests\Group\Crud\Group
     */
    public function testTestsLaravelGroupCrudSimple()
    {
        $instance = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Group\Crud\Group::class, [
            /*'create' => $this->container->make(
                    \Itmcdev\Folium\Illuminate\Operation\Crud\Create::class,
                    [
                        'modelClass' =>
                            \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
                    ]
                ),*/
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        ]);

        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Tests\Group\Crud\Group);
        $this->assertEquals(\Itmcdev\Folium\Illuminate\Tests\Model\Simple::class, $instance->getModelClass());
    }

    /**
     * Testing DI for \Itmcdev\Folium\Illuminate\Tests\Group\Rest\Group
     */
    public function testTestsLaravelGroupRestSimple()
    {
        $instance = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Group\Rest\Group::class, [
            /*'create' => $this->container->make(
                    \Itmcdev\Folium\Illuminate\Operation\Crud\Create::class,
                    [
                        'modelClass' =>
                            \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
                    ]
                ),*/
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        ]);

        $this->assertTrue($instance instanceof \Itmcdev\Folium\Illuminate\Tests\Group\Rest\Group);
        $this->assertEquals(\Itmcdev\Folium\Illuminate\Tests\Model\Simple::class, $instance->getModelClass());
    }
}
