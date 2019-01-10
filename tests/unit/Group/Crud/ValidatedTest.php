<?php
declare(strict_types=1);

namespace Itmcdev\Folium\Illuminate\Tests\Group\Crud;

use Itmcdev\Folium\Illuminate\Tests\Group\Crud\SimpleTest;

final class ValidatedTest extends SimpleTest
{
    /***********************************************************************
     * Setup
     ***********************************************************************/

    public function setUp()
    {
        parent::setUp();

        $this->group = $this->container->make(\Itmcdev\Folium\Illuminate\Tests\Group\Crud\Group::class, [
            'modelClass' => \Itmcdev\Folium\Illuminate\Tests\Model\Validated::class
        ]);
    }
}
