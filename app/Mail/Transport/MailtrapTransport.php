<?php

namespace App\Mail\Transport;

use Mailtrap\Config as MailtrapConfig;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
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
        
        $mailtrap = new MailtrapClient(new MailtrapConfig($this->apiToken));
        
        $email = (new MailtrapEmail())
            ->from(new Address(
                $originalMessage->getFrom()[0]->getAddress(),
                $originalMessage->getFrom()[0]->getName()
            ))
            ->subject($originalMessage->getSubject() ?? '');

        foreach ($originalMessage->getTo() as $to) {
            $email->addTo(new Address($to->getAddress(), $to->getName()));
        }

        $html = $originalMessage->getHtmlBody();
        $text = $originalMessage->getTextBody();
        
        if ($html) {
            $email->html($html);
        } elseif ($text) {
            $email->text($text);
        }

        $mailtrap->sending()->emails()->send($email);
    }

    public function __toString(): string
    {
        return 'mailtrap';
    }
}