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
        $app['config']->set('mail.driver', 'mailchimp');
        $app['config']->set('services.mailchimp.secret', 'md-eBuhGl2jFKyoX6C9rcBv8g'); // dummy account
    }
}
