<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class MailtrapTransport extends AbstractTransport
{
    public function __construct(private string $apiToken)
    {
        parent::__construct();
    }

    protected function doSend(SentMessage $message): void
    {
        $originalMessage = MessageConverter::toEmail($message->getOriginalMessage());

        $from = $originalMessage->getFrom()[0];
        $toList = [];
        foreach ($originalMessage->getTo() as $to) {
            $toList[] = ['email' => $to->getAddress(), 'name' => $to->getName()];
        }

        $body = [
            'from' => ['email' => $from->getAddress(), 'name' => $from->getName()],
            'to' => $toList,
            'subject' => $originalMessage->getSubject() ?? '',
            'html' => $originalMessage->getHtmlBody() ?? $originalMessage->getTextBody() ?? '',
            'text' => $originalMessage->getTextBody() ?? '',
        ];

        $ch = curl_init('https://send.api.mailtrap.io/api/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiToken,
            'Content-Type: application/json',
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \Exception('Mailtrap API error: ' . $response);
        }
    }

    public function __toString(): string
    {
        return 'mailtrap';
    }
}