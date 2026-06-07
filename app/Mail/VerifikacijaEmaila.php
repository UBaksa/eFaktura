<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class VerifikacijaEmaila extends Mailable
{
    use Queueable, SerializesModels;

    public string $verifikacioniLink;

    public function __construct(public User $user)
    {
        $this->verifikacioniLink = URL::temporarySignedRoute(
            'verifikacija.potvrdi',
            now()->addHours(24),
            ['id' => $user->id]
        );
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'eFaktura - Verifikujte vašu email adresu',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verifikacija-emaila',
        );
    }
}