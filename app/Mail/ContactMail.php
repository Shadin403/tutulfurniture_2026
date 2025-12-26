<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address; // ✅ সঠিক Address ক্লাস ইমপোর্ট করা হচ্ছে
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $subject, $phone, $comment;

    public function __construct($name, $email, $subject, $phone, $comment)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->phone = $phone;
        $this->comment = $comment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
            from: new Address($this->email, $this->name)
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
