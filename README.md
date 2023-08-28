# Laravel Mandrill Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/besmarteeinc/laravel-mandrill-driver.svg?style=flat-square)](https://packagist.org/packages/besmarteeinc/laravel-mandrill-driver)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/besmarteeinc/laravel-mandrill-driver/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/besmarteeinc/laravel-mandrill-driver/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/besmarteeinc/laravel-mandrill-driver/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/besmarteeinc/laravel-mandrill-driver/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/besmarteeinc/laravel-mandrill-driver.svg?style=flat-square)](https://packagist.org/packages/besmarteeinc/laravel-mandrill-driver)

A simple Mandrill mail driver package for Laravel extending the abstract mail transport functionality.

## Installation

You can install the package via composer:

```bash
composer require besmarteeinc/laravel-mandrill-driver
```

In your `services.php` config file, add the following configuration:

```php
// config/services.php

return [
    // ...

    'mandrill' => [
        'secret' => env('MANDRILL_KEY'),
    ],
];
```

Then set your `MANDRILL_KEY` in your env.
```php
MANDRILL_KEY=<your key>
```

Add the Mandrill mailer to your `config/mail.php`:

```php
// config/mail.php

return [
    // ...

    'mailers' => [
        // ...

        'mandrill' => [
            'transport' => 'mandrill',
        ],
    ],

    // ...
]
```

Set the `MAIL_MAILER` value in your env to `mandrill` to enable it:
```php
MAIL_MAILER=mandrill
```

## Usage

```php
$laravelMandrillDriver = new BeSmarteeInc\LaravelMandrillDriver();
echo $laravelMandrillDriver->echoPhrase('Hello, BeSmarteeInc!');
```

## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Anthony Diep](https://github.com/BeSmarteeInc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
