<?php

/**
 * This file is part of Pachico\MaxMind\MinFraudChargeback. (https://github.com/pachico/maxmind-minfraud-chargeback)
 *
 * @link https://github.com/pachico/maxmind-minfraud-chargeback for the canonical source repository
 * @copyright Copyright (c) 2016-2017 Mariano F.co Benítez Mulet. (https://github.com/pachico/)
 * @license https://raw.githubusercontent.com/pachico/maxmind-minfraud-chargeback/master/LICENSE.md MIT
 */
require __DIR__ . '/../vendor/autoload.php';

use Pachico\MaxMind\MinFraudChargeback\Chargeback;
use Pachico\MaxMind\MinFraudChargeback\Manager;
use Pachico\MaxMind\MinFraudChargeback\Auth\Credential;

$chargeback = new Chargeback('77.77.77.77');
$chargeback->setChargebackCode('CHARGEBACK_STRING')
    ->setFraudScore(Chargeback::SUSPECTED_FRAUD)
    ->setMaxmindId('XXXXXXXX')
    ->setMinfraudId('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx')
    ->setTransactionId('XXXXXX');

$manager = new Manager(new Credential('XXXXX', 'XXXXXXXXXXXX'));
$manager->setConnectTimeout(1)
    ->setTimeout(1);

try {
    $manager->report($chargeback);
} catch (Exception $exc) {
    echo $exc->getMessage();
}
