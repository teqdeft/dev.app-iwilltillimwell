<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
public function build()
    {
        return $this->subject('Contact Us Email')
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('app.contactus');
    }
}
