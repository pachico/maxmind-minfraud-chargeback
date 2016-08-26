# pachico/maxmind-minfraud-chargeback

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Mariano F.co Benítez Mulet``` ```pachico``` ```https://github.com/pachico``` ```pachicodev@gmail.com``` ```pachico``` ```maxmind-minfraud-chargeback``` ```:package_description``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
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

- [Mariano F.co Benítez Mulet][https://github.com/pachico/]

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
