<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Crud;

use Itmcdev\Folium\Illuminate\Tests\Controller\Crud\SimpleTest;

final class ValidatedTest extends SimpleTest
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Controller\Crud\Controller::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Validated::class
        ]);
    }
}
