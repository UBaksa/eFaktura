<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KorisnikRegistrovan extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dobrodošli na eFaktura portal - Nalog na čekanju',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.korisnik-registrovan',
        );
    }
}