<?php

namespace BeSmarteeInc\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            'BeSmarteeInc\MailchimpServiceProvider',
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('mail.default', 'mailchimp');
        $app['config']->set('mail.mailers.mailchimp', [
            'transport' => 'mailchimp',
            'secret' => env('MAILCHIMP_SECRET'),
        ]);
    }
}
