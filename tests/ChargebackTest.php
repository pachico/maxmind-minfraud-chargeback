<?php

namespace Pachico\MinFraudChargeback;

class ChargebackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Chargeback
     */
    protected $chargeback;

    public function setUp()
    {
        $this->chargeback = new Chargeback('77.77.77.77');
    }

    public function testEmptyToArray()
    {
        // Act
        $array = $this->chargeback->toArray();
        // Assert
        $this->assertSame(['ip_address' => '77.77.77.77'], $array);
    }

    /**
     * @return array
     */
    public function fraudScoreProvider()
    {
        return [
            [Chargeback::KNOWN_FRAUD],
            [Chargeback::NOT_FRAUD],
            [Chargeback::SUSPECTED_FRAUD],
        ];
    }

    /**
     * @dataProvider fraudScoreProvider
     *
     * @param string $fraudScore
     */
    public function testSetFraudScore($fraudScore)
    {
        // Act
        $this->chargeback->setFraudScore($fraudScore);
        $array = $this->chargeback->toArray();

        // Assert
        $this->assertSame([
            'ip_address' => '77.77.77.77',
            'fraud_score' => $fraudScore
            ], $array);
    }

    public function testInvalidFraudScoreException()
    {
        // Arrange
        $this->setExpectedException('\InvalidArgumentException', 'Invalid fraud score.');

        // Act
        $this->chargeback->setFraudScore('not a valid fraud score');
    }

    public function testSetMaxmindId()
    {
        // Act
        $this->chargeback->setMaxmindId('abcd1234');
        $array = $this->chargeback->toArray();

        // Assert
        $this->assertSame([
            'ip_address' => '77.77.77.77',
            'maxmind_id' => 'abcd1234'
            ], $array);
    }

    public function testSetMinfraudId()
    {
        // Act
        $this->chargeback->setMinfraudId('abcd1234-abcd1234-abcd1234-abcd1234-');
        $array = $this->chargeback->toArray();

        // Assert
        $this->assertSame([
            'ip_address' => '77.77.77.77',
            'minfraud_id' => 'abcd1234-abcd1234-abcd1234-abcd1234-'
            ], $array);
    }

    public function testTransactionId()
    {
        // Act
        $this->chargeback->setTransactionId('abcd1234');
        $array = $this->chargeback->toArray();

        // Assert
        $this->assertSame([
            'ip_address' => '77.77.77.77',
            'transaction_id' => 'abcd1234'
            ], $array);
    }

    public function testSetChargebackCode()
    {
        // Act
        $this->chargeback->setChargebackCode('abcd1234');
        $array = $this->chargeback->toArray();

        // Assert
        $this->assertSame([
            'ip_address' => '77.77.77.77',
            'chargeback_code' => 'abcd1234'
            ], $array);
    }
}
