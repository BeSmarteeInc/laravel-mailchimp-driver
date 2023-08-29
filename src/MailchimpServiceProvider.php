<?php

namespace BeSmarteeInc;

use Illuminate\Support\Facades\Config;
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
        Mail::extend('mailchimp', function () {
            $client = new ApiClient();
            $client->setApiKey(Config::get('services.mailchimp.secret'));

            return new MailchimpTransport($client);
        });
    }
}
