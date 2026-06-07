<?php

namespace App\Mail\Transport;

use Mailtrap\Config as MailtrapConfig;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
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
        
        $email = (new \Mailtrap\Model\Email\Sending\Email())
            ->from(new Address(
                $originalMessage->getFrom()[0]->getAddress(),
                $originalMessage->getFrom()[0]->getName()
            ))
            ->subject($originalMessage->getSubject() ?? '')
            ->html($originalMessage->getHtmlBody() ?? $originalMessage->getTextBody() ?? '');

        foreach ($originalMessage->getTo() as $to) {
            $email->addTo(new Address($to->getAddress(), $to->getName()));
        }

        $mailtrap->sending()->emails()->send($email);
    }

    public function __toString(): string
    {
        return 'mailtrap';
    }
}