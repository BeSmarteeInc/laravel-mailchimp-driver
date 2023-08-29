<?php

namespace BeSmarteeInc;

use MailchimpTransactional\ApiClient;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\MessageConverter;

class MailchimpTransport extends AbstractTransport
{
    /**
     * Create a new Mailchimp transport instance.
     */
    public function __construct(
        protected ApiClient $client,
    ) {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $response = $this->client->messages->send(['message' => [
            'from_email' => $email->getFrom()[0]->getAddress(),
            'to' => collect($email->getTo())->map(function (Address $email) {
                return ['email' => $email->getAddress(), 'type' => 'to'];
            })->all(),
            'subject' => $email->getSubject(),
            'html' => $email->getHtmlBody(),
        ]]);

        if (optional($response)[0]) {
            $message->getOriginalMessage()->getHeaders()->addHeader('X-Message-ID', $response[0]?->_id);
            $message->getOriginalMessage()->getHeaders()->addHeader('X-Message-Status', $response[0]?->status);
        }
    }

    /**
     * Get the string representation of the transport.
     */
    public function __toString(): string
    {
        return 'mailchimp';
    }
}
