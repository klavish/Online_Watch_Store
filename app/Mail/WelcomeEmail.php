<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailData;

    /**
     * Create a new message instance.
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

      /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                    ->from('luv3177@gmail.com', 'Ekart')
                    ->replyTo('lavishkumar1212@gmail.com', 'Reply To Email')
                    ->subject($this->emailData['subject'])
                    ->view('html_email')
                    ->with([
                        'tagline' => $this->emailData['tagline']
                    ])
                    //->text('text_mail)
                    ->attach(public_path('demo.pdf'),[
                        'as' => 'Demo PDF File.pdf',
                        'mime' => 'application/pdf'
                    ]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
