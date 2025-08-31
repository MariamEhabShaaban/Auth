<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $verifyUrl ;
    public $otp ;
    public function __construct($otp)
    {
        $this->verifyUrl  = 'verify-account/'.$otp;
        $this->otp = $otp;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Account',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-account',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
