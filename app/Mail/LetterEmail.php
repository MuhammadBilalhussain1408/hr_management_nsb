<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LetterEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $employee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee )
    {
        $this->employee = $employee;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Letter Email',
    //     );
       
    // }
    public function build(){
        return $this->view('mail.letteremail')
       // ->from('ukhrms@gmail.com.com','UK HR CLOUD')
       // ->to('afroza2prova@gmail.com')
        ->subject('Right to Work Documentation – Temporary Visa Reminder')
        ->with([ 'employee' => $this->employee ]);
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'mail.letteremail',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
