# Laravel Mailchimp Driver

[![Latest Version on Packagist](https://img.shields.io/packagist/v/besmarteeinc/laravel-mailchimp-driver.svg?style=flat-square)](https://packagist.org/packages/besmarteeinc/laravel-mailchimp-driver)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/besmarteeinc/laravel-mailchimp-driver/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/besmarteeinc/laravel-mailchimp-driver/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/besmarteeinc/laravel-mailchimp-driver/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/besmarteeinc/laravel-mailchimp-driver/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/besmarteeinc/laravel-mailchimp-driver.svg?style=flat-square)](https://packagist.org/packages/besmarteeinc/laravel-mailchimp-driver)

A simple Mailchimp mail driver package for Laravel extending the abstract mail transport functionality.

## Installation

You can install the package via composer:

```bash
composer require besmarteeinc/laravel-mailchimp-driver
```

In your `services.php` config file, add the following configuration:

```php
// config/services.php

return [
    // ...

    'mailchimp' => [
        'secret' => env('MAILCHIMP_KEY'),
    ],
];
```

Then set your `MAILCHIMP_KEY` in your env.
```php
MAILCHIMP_KEY=<your key>
```

Add the Mailchimp mailer to your `config/mail.php`:

```php
// config/mail.php

return [
    // ...

    'mailers' => [
        // ...

        'mailchimp' => [
            'transport' => 'mailchimp',
        ],
    ],

    // ...
]
```

Set the `MAIL_MAILER` value in your env to `mailchimp` to enable it:
```php
MAIL_MAILER=mailchimp
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
