# pachico/maxmind-minfraud-chargeback

[![Author](https://img.shields.io/badge/author-@pachico-blue.svg?style=flat-square)](https://twitter.com/pachico)
![php 5.4+](https://img.shields.io/badge/php-min%205.4-red.svg?style=flat-square)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://github.com/pachico/maxmind-minfraud-chargeback/blob/master/LICENSE.md)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/badges/build.png?b=master)](https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/build-status/master)

This is a client for [MaxMind's minFraud Chargeback Web Service Api](http://dev.maxmind.com/minfraud/chargeback/).

This is NOT an official implementation, although it was written following official documentation.

## Install

Via Composer

```bash
$ composer require pachico/maxmind-minfraud-chargeback
```

## Usage

Please read http://dev.maxmind.com/minfraud/chargeback/


```php
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
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email pachicodev@gmail.com instead of using the issue tracker.

## Credits

- [Mariano F.co Benítez Mulet](https://github.com/pachico/)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.