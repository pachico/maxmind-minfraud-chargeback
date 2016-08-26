<?php

require __DIR__ . '/../vendor/autoload.php';

use Pachico\MinFraudChargeback\Chargeback;
use Pachico\MinFraudChargeback\Manager;
use Pachico\MinFraudChargeback\Auth\Credential;

$chargeback = new Chargeback('77.77.77.77');
$chargeback->setChargebackCode('foo')
    ->setFraudScore(Chargeback::SUSPECTED_FRAUD)
    ->setMaxmindId('5VDEKMT5')
    ->setMinfraudId('f6c86cca-6af2-11e6-985a-d80cd6c1744d')
    ->setTransactionId('foo');

$manager = new Manager(new Credential('115188', 'WGvcicYjRIqF'));
$manager->setConnectTimeout(0.01)
    ->setTimeout(0.01);

try {
    $manager->report($chargeback);
} catch (Exception $exc) {
    echo $exc->getMessage();
}
