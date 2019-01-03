<?php

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Rest;

class TestCase extends \Itmcdev\Folium\Illuminate\Tests\TestCase
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Controller\Rest\Controller::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        ]);
    }
}
