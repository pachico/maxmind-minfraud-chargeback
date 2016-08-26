<?php

namespace Pachico\MaxMind\MinFraudChargeback\Http;

use Pachico\MaxMind\MinFraudChargeback\Chargeback;
use Pachico\MaxMind\MinFraudChargeback\Exception\ExceptionAbstract;

class CurlClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $curlMock;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $credentialMock;
    /**
     * @var CurlClient
     */
    protected $curlClient;
    /**
     * @var Chargeback
     */
    protected $chargeback;

    public function setUp()
    {
        $this->curlMock = $this->getMock('\Curl\Curl');
        $credentialMockBuilder = $this->getMockBuilder('Pachico\MaxMind\MinFraudChargeback\Auth\Credential');
        $credentialMockBuilder->disableOriginalConstructor();
        $this->credentialMock = $credentialMockBuilder->getMock();
        $this->chargeback = new Chargeback('77.77.77.77');

        $this->curlClient = new CurlClient($this->credentialMock, $this->curlMock);
    }

    public function testSetConnectTimeout()
    {
        // Arrange
        $this->curlMock->expects($this->once())->method('setConnectTimeout');
        // Act
        $returned = $this->curlClient->setConnectTimeout(1);
        // Assert
        $this->assertSame($this->curlClient, $returned);
    }

    public function testSetTimeout()
    {
        // Arrange
        $this->curlMock->expects($this->once())->method('setTimeout');
        // Act
        $returned = $this->curlClient->setTimeout(1);
        // Assert
        $this->assertSame($this->curlClient, $returned);
    }

    public function testSetHostname()
    {
        // Act
        $returned = $this->curlClient->setHostname(CurlClient::HOSTNAME_DEFAULT);
        // Assert
        $this->assertSame($this->curlClient, $returned);
    }

    public function testSetHostnameException()
    {
        // Arrange
        $this->setExpectedException('\InvalidArgumentException');
        // Act
        $this->curlClient->setHostname('not a valid hostname');
    }

    public function testSuccessfulReporting()
    {
        // Arrange
        $this->curlMock->expects($this->once())->method('setBasicAuthentication');
        $this->curlMock->expects($this->once())->method('setHeader');
        $this->curlMock->expects($this->once())->method('post');
        $this->curlMock->httpStatusCode = 204;

        $this->credentialMock->expects($this->once())->method('getUser');
        $this->credentialMock->expects($this->once())->method('getPassword');

        // Act
        $result = $this->curlClient->report($this->chargeback);

        // Assert
        $this->assertTrue($result);
    }

    public function testUnsuccessfulReportingUnexpected()
    {
        // Arrange
        $this->setExpectedException('\RuntimeException');
        $this->curlMock->expects($this->once())->method('setBasicAuthentication');
        $this->curlMock->expects($this->once())->method('setHeader');
        $this->curlMock->expects($this->once())->method('post');
        $this->curlMock->error = true;

        $this->credentialMock->expects($this->once())->method('getUser');
        $this->credentialMock->expects($this->once())->method('getPassword');

        // Act
        $result = $this->curlClient->report($this->chargeback);

        // Assert
        $this->assertTrue($result);
    }

    public function testUnsuccessfulReporting()
    {
        // Arrange
        $this->setExpectedException('Pachico\MaxMind\MinFraudChargeback\Exception\ExceptionAbstract');
        $this->curlMock->expects($this->once())->method('setBasicAuthentication');
        $this->curlMock->expects($this->once())->method('setHeader');
        $this->curlMock->expects($this->once())->method('post');
        $this->curlMock->error = true;
        $this->curlMock->response = new \stdClass();
        $this->curlMock->response->code = ExceptionAbstract::AUTHORIZATION_INVALID;
        $this->curlMock->response->error = 'Unauthorized user';

        $this->credentialMock->expects($this->once())->method('getUser');
        $this->credentialMock->expects($this->once())->method('getPassword');

        // Act
        $result = $this->curlClient->report($this->chargeback);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * @return array
     */
    public function errorMessageExceptionProvider()
    {
        return [
            [ExceptionAbstract::AUTHORIZATION_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\UnauthorizedException'],
            [ExceptionAbstract::FRAUD_SCORE_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidFraudScoreException'],
            [ExceptionAbstract::IP_ADDRESS_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidIpException'],
            [ExceptionAbstract::IP_ADDRESS_RESERVED, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidIpException'],
            [ExceptionAbstract::JSON_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidJSONException'],
            [ExceptionAbstract::LICENSE_KEY_REQUIRED, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidLicenceException'],
            [ExceptionAbstract::MAXMIND_ID_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidMaxMindIdException'],
            [ExceptionAbstract::MINFRAUD_ID_INVALID, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidMinFraudIdException'],
            [ExceptionAbstract::PARAMETER_UNKNOWN, 'Pachico\MaxMind\MinFraudChargeback\Exception\UnknownParameterException'],
            [ExceptionAbstract::SERVICE_UNAVAILABLE, 'Pachico\MaxMind\MinFraudChargeback\Exception\ServiceUnavailableException'],
            [ExceptionAbstract::USER_ID_REQUIRED, 'Pachico\MaxMind\MinFraudChargeback\Exception\InvalidUserIdException'],
        ];
    }

    /**
     * @dataProvider errorMessageExceptionProvider
     *
     * @param string $error
     * @param string $expectedException
     */
    public function testGetMaxMindExceptionByCodeAndMessage($error, $expectedException)
    {
        // Arrange
        $reflectionClass = new \ReflectionClass($this->curlClient);
        $reflectionMethod = $reflectionClass->getMethod('getMaxMindExceptionByCodeAndMessage');
        $reflectionMethod->setAccessible(true);
        // Act
        $exception = $reflectionMethod->invokeArgs($this->curlClient, [$error, 'foo']);
        // Assert
        $this->assertInstanceOf($expectedException, $exception);
    }

    /**
     * @return array
     */
    public function inputResultProvider()
    {
        $onlyCode = new \stdClass();
        $onlyCode->code = 'foo';
        $onlyError = new \stdClass();
        $onlyError->error = 'foo';
        $complete = new \stdClass();
        $complete->code = 'foo';
        $complete->error = 'foo';

        return [
            ['foo', false],
            [new \DateTime(), false],
            [new \stdClass(), false],
            [$onlyCode, false],
            [$onlyError, false],
            [$complete, true],
        ];
    }

    /**
     * @dataProvider inputResultProvider
     *
     * @param mixed $input
     * @param bool $expectedResult
     */
    public function testIsValidMaxMindResponse($input, $expectedResult)
    {
        // Arrange
        $reflectionClass = new \ReflectionClass($this->curlClient);
        $reflectionMethod = $reflectionClass->getMethod('isValidMaxMindResponse');
        $reflectionMethod->setAccessible(true);
        // Act
        $result = $reflectionMethod->invokeArgs($this->curlClient, [$input]);
        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
