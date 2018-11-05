<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud;

require_once __DIR__ . '/LaravelTestCase.php';
require_once __DIR__ . '/eloquent/SimpleModel.php';
require_once __DIR__ . '/eloquent/ValidatedModel.php';

use Itmcdev\Folium\Tests\Crud\LaravelTestCase;
use Itmcdev\Folium\Tests\Crud\Eloquent\SimpleModel;
use Itmcdev\Folium\Tests\Crud\Eloquent\ValidatedModel;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    class LaravelDatabaseTest extends LaravelTestCase
    {

        /***********************************************************************
         * Unit Tests
         ***********************************************************************/

        function testCreateSimple()
        {
            $simpleModel = null;
            try {
                $simpleModel = SimpleModel::create($this->newModelData());
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString());
            }
            $this->assertTrue($simpleModel !== null);
        }

        function testCreateValidted()
        {
            $simpleModel = null;
            try {
                $simpleModel = ValidatedModel::create($this->newModelData());
            } catch (\Exception $e) {
                var_dump($e->getMessage(), $e->getTraceAsString());
            }
            $this->assertTrue($simpleModel !== null);
        }
    }

} else {

    class LaravelDatabaseTest extends LaravelTest
    {
        
    }

}