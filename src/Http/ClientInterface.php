<?php

/**
 * This file is part of Pachico/MinFraudChargeback. (https://github.com/pachico/minfraud-chargeback)
 *
 * @link https://github.com/pachico/minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MinFraudChargeback\Http;

use Pachico\MinFraudChargeback\Chargeback;
use Pachico\MinFraudChargeback\Exception\ExceptionAbstract;

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
     * @return true|ExceptionAbstract
     */
    public function report(Chargeback $chargeback);
}
