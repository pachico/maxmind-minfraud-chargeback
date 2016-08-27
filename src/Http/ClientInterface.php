<?php

/**
 * This file is part of Pachico\MaxMind\MinFraudChargeback. (https://github.com/pachico/maxmind-minfraud-chargeback)
 *
 * @link https://github.com/pachico/maxmind-minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/maxmind-minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MaxMind\MinFraudChargeback\Http;

use Pachico\MaxMind\MinFraudChargeback\Chargeback;
use Pachico\MaxMind\MinFraudChargeback\Exception\ExceptionAbstract;

/**
 * Interface for those classes that will be between MaxMind and the Manager
 */
interface ClientInterface
{
    /**
     * @param int $seconds
     *
     * @return ClientInterface
     */
    public function setTimeout($seconds);

    /**
     * @param int $seconds
     *
     * @return ClientInterface
     */
    public function setConnectTimeout($seconds);

    /**
     * @param string $string
     *
     * @return ClientInterface
     */
    public function setHostname($string);

    /**
     * @param Chargeback $chargeback
     *
     * @throws ExceptionAbstract
     * @throws RuntimeException
     *
     * @return bool
     */
    public function report(Chargeback $chargeback);
}
