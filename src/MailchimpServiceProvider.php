<?php

namespace BeSmarteeInc;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use MailchimpTransactional\ApiClient;

class MailchimpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mail::extend('mailchimp', function ($config) {
            $client = new ApiClient;
            $client->setApiKey($config['secret'] ?? '');

            return new MailchimpTransport($client, $config);
        });
    }
}
