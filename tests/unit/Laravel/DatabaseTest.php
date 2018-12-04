<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Laravel;

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/../Laravel/Model/Simple.php';
require_once __DIR__ . '/../Laravel/Model/Validated.php';

use Itmcdev\Folium\Tests\Laravel\Model\Simple;
use Itmcdev\Folium\Tests\Laravel\Model\Validated;
use Itmcdev\Folium\Tests\Laravel\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

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
            var_dump($this->controller);
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

} else {

    class DatabaseTest extends TestCase
    {
        
    }

}