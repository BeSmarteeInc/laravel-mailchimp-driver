# Laravel Mailchimp Driver

A simple Mailchimp mail driver package for Laravel extending the abstract mail transport functionality.

## Installation

You can install the package via composer by adding this to your composer.json:

```json
{
    "repositories": [
        // ...
        {
            "type": "github",
            "url": "https://github.com/besmarteeinc/laravel-mailchimp-driver.git"
        }
    ]
}
```

Then run:

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

- [Jeffrey Pau](https://github.com/jpau-besmartee)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
