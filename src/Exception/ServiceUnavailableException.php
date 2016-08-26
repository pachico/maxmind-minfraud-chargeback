<?php

/**
 * This file is part of Pachico\MaxMind\MinFraudChargeback. (https://github.com/pachico/maxmind-minfraud-chargeback)
 *
 * @link https://github.com/pachico/maxmind-minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/maxmind-minfraud-chargeback/master/LICENSE.md MIT
 */

namespace Pachico\MaxMind\MinFraudChargeback\Exception;

class ServiceUnavailableException extends ExceptionAbstract
{

    /**
     *
     */
    public function __construct()
    {
        parent::__construct('There was a problem with the service. Try again.');
    }
}
