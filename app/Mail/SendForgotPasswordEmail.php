<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendForgotPasswordEmail extends Mailable
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
        // echo "<pre>";
        // print_r($this->emailData);
        // exit;
        return $this
                    ->from('luv3177@gmail.com', 'Ekart')
                    ->replyTo('luv3177@gmail.com', 'Reply To Email')
                    ->subject('User Forgot password Request')
                    ->view('forgot_password_email')
                    ->with([
                        'token' => $this->emailData['token'],
                        'email' => $this->emailData['email']
                    ]);
                    //->text('text_mail)
                    // ->attach(public_path('demo.pdf'),[
                    //     'as' => 'Demo PDF File.pdf',
                    //     'mime' => 'application/pdf'
                    // ]);
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
