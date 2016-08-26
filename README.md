# pachico/maxmind-minfraud-chargeback

This is a client for (MaxMind's minFraud Chargeback Web Service Api)[http://dev.maxmind.com/minfraud/chargeback/].
This is NOT an official implementation, although it was written following official documentation.

## Install

Via Composer

```bash
$ composer require pachico/maxmind-minfraud-chargeback
```

## Usage

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

- (Mariano F.co Benítez Mulet)[https://github.com/pachico/]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/pachico/maxmind-minfraud-chargeback.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pachico/maxmind-minfraud-chargeback/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/pachico/maxmind-minfraud-chargeback.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/pachico/maxmind-minfraud-chargeback.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pachico/maxmind-minfraud-chargeback.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pachico/maxmind-minfraud-chargeback
[link-travis]: https://travis-ci.org/pachico/maxmind-minfraud-chargeback
[link-scrutinizer]: https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/pachico/maxmind-minfraud-chargeback
[link-downloads]: https://packagist.org/packages/pachico/maxmind-minfraud-chargeback
[link-author]: https://github.com/pachico
