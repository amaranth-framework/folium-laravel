<?php
// declare(strict_types=1);

namespace Itmcdev\Folium\Tests\Crud\Exception;

require_once __DIR__ . '/TestCase.php';

use Itmcdev\Folium\Tests\Crud\Exception\TestCase;

if (class_exists('\Illuminate\Database\Capsule\Manager')) {

    /**
     * @runTestsInSeparateProcesses
     */
    class ReadExceptionTest extends TestCase
    {
        /**
         * @expectedException \Itmcdev\Folium\Crud\Exception\ReadException
         */
        function testReadExceptionViaConnection()
        {
            $this->controller->read([['id', 1]]);
            $this->assertTrue(true);
        }
    }

} else {

    class ReadExceptionTest extends TestCase
    { }

}