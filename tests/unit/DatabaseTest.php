<?php
namespace Itmcdev\Folium\Illuminate\Tests;

use Itmcdev\Folium\Illuminate\Tests\Model\Simple;
use Itmcdev\Folium\Illuminate\Tests\Model\Validated;
use Itmcdev\Folium\Illuminate\Tests\TestCase;

class DatabaseTest extends TestCase
{
    /***********************************************************************
     * Unit Tests
     ***********************************************************************/

    function testCreateSimple()
    {
        $model = null;
        try {
            $model = Simple::create($this->newModelData());
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());
        }
        $this->assertTrue($model !== null);
    }

    function testCreateValidted()
    {
        $model = null;
        try {
            $model = Validated::create($this->newModelData());
        } catch (\Exception $e) {
            var_dump($e->getMessage(), $e->getTraceAsString());
        }
        $this->assertTrue($model !== null);
    }
}
