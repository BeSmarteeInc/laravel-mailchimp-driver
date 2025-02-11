<?php

declare(strict_types=1);

namespace BeSmarteeInc;

use MailchimpTransactional\ApiClient;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\MessageConverter;
use Symfony\Component\Mime\Part\DataPart;

class MailchimpTransport extends AbstractTransport
{
    /**
     * Create a new Mailchimp transport instance.
     */
    public function __construct(
        protected ApiClient $client,
        protected array $configs = []
    ) {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $response = $this->client->messages->send(['message' => $this->buildMessageData($email)]);

        if (optional($response)[0]) {
            $message->getOriginalMessage()->getHeaders()->addHeader('X-Message-ID', $response[0]?->_id);
            $message->getOriginalMessage()->getHeaders()->addHeader('X-Message-Status', $response[0]?->status);
        }
    }

    protected function buildMessageData(Email $email): array
    {

        $messageData = array_merge($this->determineBaseMessageConfig(), [
            'to' => $this->determineRecipients($email),
            'subject' => $email->getSubject(),
            'html' => $email->getHtmlBody(),
        ]);

        $messageData = array_merge($messageData, $this->determineFrom($email));

        $mailHeaders = $this->determineMailHeaders($email);

        if (! empty($mailHeaders)) {
            $messageData['headers'] = $mailHeaders;
        }

        $attachments = $this->determineAttachments($email);

        if (! empty($attachments)) {
            $messageData['attachments'] = $attachments;
        }

        return $messageData;
    }

    protected function determineBaseMessageConfig(): array
    {
        $messageData = [];
        isset($this->configs['tags']) && $messageData['tags'] = $this->configs['tags'];
        isset($this->configs['tracking_domain']) && $messageData['tracking_domain'] = $this->configs['tracking_domain'];
        isset($this->configs['inline_css']) && $messageData['inline_css'] = $this->configs['inline_css'];
        isset($this->configs['track_clicks']) && $messageData['track_clicks'] = $this->configs['track_clicks'];
        isset($this->configs['track_opens']) && $messageData['track_opens'] = $this->configs['track_opens'];

        return $messageData;
    }

    protected function determineMailHeaders(Email $email): array
    {
        $headers = [];

        $replyTo = $email->getReplyTo()[0] ?? null;

        if ($replyTo) {
            $headers['Reply-To'] = $replyTo->getAddress();
        }

        return $headers;
    }

    protected function determineFrom(Email $email): array
    {
        $from = $email->getFrom()[0] ?? null;

        return array_filter([
            'from_email' => $from?->getAddress(),
            'from_name' => $from?->getName(),
        ]);
    }

    protected function determineRecipients(Email $email): array
    {
        $toEmails = collect($email->getTo())
            ->map(fn (Address $address) => $this->transformAddress($address));

        $ccEmails = collect($email->getCc())
            ->map(fn (Address $address) => $this->transformAddress($address, 'cc'));

        $bccEmails = collect($email->getBcc())
            ->map(fn (Address $address) => $this->transformAddress($address, 'bcc'));

        return $toEmails->merge($ccEmails)->merge($bccEmails)->values()->all();
    }

    protected function determineAttachments(Email $email): array
    {
        $attachments = $email->getAttachments();

        return collect($attachments)->map(function (DataPart $attachment) {
            return $this->transformAttachment($attachment);
        })->values()->all();
    }

    /**
     * @return array{type: string, email: string, name: string}
     */
    protected function transformAddress(Address $address, ?string $type = null): array
    {
        $data = [
            'type' => $type ?? 'to',
            'email' => $address->getAddress(),
        ];

        $name = $address->getName();

        if (! empty($name)) {
            $data['name'] = $name;
        }

        return $data;
    }

    /**
     * @return array{type: string, name: string, content: string}
     */
    protected function transformAttachment(DataPart $attachment): array
    {
        return [
            'type' => $attachment->getContentType(),
            'name' => $attachment->getName(),
            'content' => base64_encode($attachment->getBody()),
        ];
    }

    /**
     * Get the string representation of the transport.
     */
    public function __toString(): string
    {
        return 'mailchimp';
    }
}
