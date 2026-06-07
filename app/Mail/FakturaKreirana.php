<?php

namespace App\Mail;

use App\Models\Faktura;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FakturaKreirana extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Faktura $faktura) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'eFaktura - Nova faktura ' . $this->faktura->broj_fakture,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.faktura-kreirana',
        );
    }
}