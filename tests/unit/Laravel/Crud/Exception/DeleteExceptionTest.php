<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud\Exception;

require_once __DIR__ . '/TestCase.php';

use Itmcdev\Folium\Tests\Crud\Exception\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    /**
     * @runTestsInSeparateProcesses
     */
    class DeleteExceptionTest extends TestCase
    {
        /**
         * @expectedException \Itmcdev\Folium\Crud\Exception\DeleteException
         */
        function testDeleteExceptionViaInvalidArgument()
        {
            $this->controller->delete();
            $this->assertTrue(true);
        }
    }

} else {

    class DeleteExceptionTest extends TestCase
    { }

}