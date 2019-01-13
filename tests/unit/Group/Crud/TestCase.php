<?php

namespace Itmcdev\Folium\Illuminate\Tests\Group\Crud;

class TestCase extends \Itmcdev\Folium\Illuminate\Tests\TestCase
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Group\Crud\Group::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Simple::class
        ]);
    }
}
