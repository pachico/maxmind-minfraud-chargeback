<?php

namespace Pachico\MaxMind\MinFraudChargeback\Exception;

class ServiceUnavailableExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testException()
    {
        // Arrange
        $exception = new ServiceUnavailableException();

        // Act
        $message = $exception->getMessage();

        // Arrange
        $this->assertSame('There was a problem with the service. Try again.', $message);
    }
}
