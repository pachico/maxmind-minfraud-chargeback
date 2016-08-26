<?php

namespace Pachico\MinFraudChargeback;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Manager
     */
    protected $manager;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $clientMock;

    public function setUp()
    {
        $credentialMockBuilder = $this->getMockBuilder('Pachico\MinFraudChargeback\Auth\Credential')
            ->disableOriginalConstructor();
        $credentialMock = $credentialMockBuilder->getMock();
        $this->clientMock = $this->getMock('Pachico\MinFraudChargeback\Http\ClientInterface');

        $this->manager = new Manager($credentialMock, $this->clientMock);
    }

    public function testReport()
    {
        // Arrange
        $chargebackMockBuilder = $this->getMockBuilder('Pachico\MinFraudChargeback\Chargeback')
            ->disableOriginalConstructor();
        $chargebackMock = $chargebackMockBuilder->getMock();

        $this->clientMock->expects($this->once())->method('report')->with($chargebackMock)->willReturn(true);

        // Act
        $result = $this->manager->report($chargebackMock);

        $this->assertTrue($result);
    }

    public function setterMethodNameProvider()
    {
        return [
            ['setTimeout', 1],
            ['setConnectTimeout', 2],
            ['setHostname', Http\CurlClient::HOSTNAME_DEFAULT],
        ];
    }

    /**
     * @dataProvider setterMethodNameProvider
     *
     * @param string $methodname
     * @param mixed $value
     */
    public function testSetters($methodname, $value)
    {
        // Arrange
        $this->clientMock->expects($this->once())->method($methodname)->willReturnSelf();

        // Act
        $result = $this->manager->{$methodname}($value);

        $this->assertInstanceOf('\Pachico\MinFraudChargeback\Manager', $result);
    }
}
