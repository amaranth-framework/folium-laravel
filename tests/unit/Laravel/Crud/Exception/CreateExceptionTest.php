<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud\Exception;

require_once __DIR__ . '/TestCase.php';

use Itmcdev\Folium\Tests\Crud\Exception\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    /**
     * @runTestsInSeparateProcesses
     */
    class CreateExceptionTest extends TestCase
    {
        /**
         * @expectedException \Itmcdev\Folium\Crud\Exception\CreateException
         */
        function testCreateExceptionViaConnection()
        {
            $simpleModel = $this->newModelData();
            $simpleModel['id'] = 'test';
            $this->controller->create($simpleModel);
            $this->assertTrue(true);
        }
    }

} else {

    class CreateExceptionTest extends TestCase
    { }

}