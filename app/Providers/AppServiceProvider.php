<?php

namespace App\Providers;

use App\Mail\Transport\MailtrapTransport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Mail::extend('mailtrap', function () {
            return new MailtrapTransport(config('mail.mailtrap_token'));
        });
    }
}