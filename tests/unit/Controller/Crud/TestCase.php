<?php

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Crud;

class TestCase extends \Itmcdev\Folium\Illuminate\Tests\TestCase
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->container->make(
            \Itmcdev\Folium\Illuminate\Tests\Controller\Crud\Controller::class
        );
    }
}
