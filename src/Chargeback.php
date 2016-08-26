<?php

/**
 * This file is part of Pachico\MaxMind\MinFraudChargeback. (https://github.com/pachico/maxmind-minfraud-chargeback)
 *
 * @link https://github.com/pachico/maxmind-minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/maxmind-minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MaxMind\MinFraudChargeback;

use Webmozart\Assert\Assert;
use InvalidArgumentException;

/**
 * This is a namespaced container for the values a chargeback can have
 */
class Chargeback
{
    /**
     * Indicates transaction is unlikely fraudulent
     */
    const NOT_FRAUD = 'not_fraud';
    /**
     * Indicates transaction is suspectedly fraudulent
     */
    const SUSPECTED_FRAUD = 'suspected_fraud';
    /**
     * Indicates transaction is likely fraudulent
     */
    const KNOWN_FRAUD = 'known_fraud';

    /**
     * @var string
     */
    protected $ipAddress;
    /**
     * @var string
     */
    protected $chargebackCode;
    /**
     * @var string
     */
    protected $fraudScore;
    /**
     * @var string
     */
    protected $maxmindId;
    /**
     * @var string
     */
    protected $minfraudId;
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @param string $ipAddress The IP address of the customer placing the order.
     * This should be passed as a string like “44.55.66.77” or “2001:db8::2:1”.
     *
     * @throws InvalidArgumentException
     */
    public function __construct($ipAddress)
    {
        Assert::stringNotEmpty($ipAddress);

        $this->ipAddress = $ipAddress;
    }

    /**
     * @param A string which is provided by your payment processor
     * indicating the reason for the chargeback.
     * @see https://en.wikipedia.org/wiki/Chargeback#Reason_codes
     *
     * @throws InvalidArgumentException
     *
     * @return \Pachico\MinFraudChargeback\Chargeback
     */
    public function setChargebackCode($chargebackCode)
    {
        Assert::stringNotEmpty($chargebackCode);

        $this->chargebackCode = $chargebackCode;

        return $this;
    }

    /**
     * @param string $fraudScore A string indicating the likelihood that
     * a transaction may be fraudulent.
     * Possible values: ‘not_fraud’, ‘suspected_fraud’, ‘known_fraud’.
     *
     * @throws InvalidArgumentException
     *
     * @return \Pachico\MinFraudChargeback\Chargeback
     */
    public function setFraudScore($fraudScore)
    {
        if (!in_array($fraudScore, [
                static::KNOWN_FRAUD,
                static::NOT_FRAUD,
                static::SUSPECTED_FRAUD
            ])) {
            throw new InvalidArgumentException('Invalid fraud score.');
        }

        $this->fraudScore = $fraudScore;

        return $this;
    }

    /**
     * @param string $maxmindId A unique eight character string identifying
     * a minFraud Standard or Premium request. These IDs are returned in the
     * maxmindID field of a response for a successful minFraud request.
     * This field is not required, but you are encouraged to provide it, if possible.
     *
     * @throws InvalidArgumentException
     *
     * @return \Pachico\MinFraudChargeback\Chargeback
     */
    public function setMaxmindId($maxmindId)
    {
        Assert::length($maxmindId, 8);

        $this->maxmindId = $maxmindId;

        return $this;
    }

    /**
     * @param string $minfraudId A UUID that identifies a minFraud Score,
     * minFraud Insights, or minFraud Factors request.
     * This ID is returned at /id in the response.
     * This field is not required, but you are encouraged to provide it if
     * the request was made to one of these services.
     *
     * @throws InvalidArgumentException
     *
     * @return \Pachico\MinFraudChargeback\Chargeback
     */
    public function setMinfraudId($minfraudId)
    {
        Assert::length($minfraudId, 36);

        $this->minfraudId = $minfraudId;

        return $this;
    }

    /**
     * @param string $transactionId The transaction ID you originally passed to minFraud.
     * This field is not required, but you are encouraged to provide it or
     * the transaction’s maxmind_id or minfraud_id.
     *
     * @throws InvalidArgumentException
     *
     * @return \Pachico\MinFraudChargeback\Chargeback
     */
    public function setTransactionId($transactionId)
    {
        Assert::stringNotEmpty($transactionId);

        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            'ip_address' => $this->ipAddress
        ];

        if ($this->chargebackCode) {
            $array['chargeback_code'] = $this->chargebackCode;
        }

        if ($this->fraudScore) {
            $array['fraud_score'] = $this->fraudScore;
        }

        if ($this->maxmindId) {
            $array['maxmind_id'] = $this->maxmindId;
        }


        if ($this->minfraudId) {
            $array['minfraud_id'] = $this->minfraudId;
        }

        if ($this->transactionId) {
            $array['transaction_id'] = $this->transactionId;
        }

        return $array;
    }
}
