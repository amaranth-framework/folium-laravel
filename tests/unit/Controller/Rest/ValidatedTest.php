<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Illuminate\Tests\Controller\Rest;

use Itmcdev\Folium\Illuminate\Tests\Controller\Rest\SimpleTest;

final class ValidatedTest extends SimpleTest
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Controller\Rest\Controller::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Validated::class
        ]);
    }
}
