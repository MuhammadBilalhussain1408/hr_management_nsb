<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data )
    {
        $this->data = $data;
    }

    public function build(){
        return $this->view('mail.contactemail')
       // ->from('ukhrms@gmail.com.com','UK HR CLOUD')
       // ->to('afroza2prova@gmail.com')
        ->subject('Contact')
        ->with([ 'data' => $this->data ]);
    }


    public function attachments()
    {
        return [];
    }
}
