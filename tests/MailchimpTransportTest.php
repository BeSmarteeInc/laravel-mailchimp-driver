<?php

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Header\UnstructuredHeader;

class TestMailable extends Mailable
{
    public function build()
    {
        return $this->from('dev@besmartee.com')
            ->html('Hello World')
            ->cc('cc@besmartee.com', 'CC BeSmartee')
            ->bcc('bcc@besmartee.com')
            ->replyTo('reply@besmartee.com')
            ->attachData('file content', 'test.txt', ['mine' => 'text/plain']);
    }
}

it('sends email via mailchimp', function () {
    Event::listen(MessageSent::class, function ($event) {
        expect($event->data['mailer'])->toBe('mailchimp');
    });

    Mail::to('test@test.com')->send(new TestMailable);
});

it('sends headers', function ($header) {
    $response = Mail::to('test@test.com')->send(new TestMailable);

    expect($response->getOriginalMessage()->getHeaders()->get($header))
        ->toBeInstanceOf(UnstructuredHeader::class);
})->with([
    'message ID' => 'X-Message-ID',
    'message status' => 'X-Message-Status',
]);
