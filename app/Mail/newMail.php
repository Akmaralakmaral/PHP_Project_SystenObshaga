<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $recipientEmail;

    /**
     * Create a new message instance.
     *
     * @param string $recipientEmail
     */
    public function __construct($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;
    }

    // /**
    //  * Create a new message instance.
    //  */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hello, My Dear!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email',
        );
    }

    public function build(): self
    {
        return $this
            // ->to('dzhanyshbekova@gmail.com') // Замените на фактический адрес получателя
            ->to($this->recipientEmail)
            ->subject('New Mail')
            ->markdown('email');
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
