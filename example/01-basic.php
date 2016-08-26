<?php

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
