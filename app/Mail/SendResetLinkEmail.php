<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendResetLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public function __construct($token)
    {
        $this->resetUrl = url("reset-password/$token");
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Reset Link Email',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-password',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
