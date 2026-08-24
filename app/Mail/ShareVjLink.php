<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShareVjLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $msg, $user_name)
    {
        $this->email = $email;
        $this->msg = $msg;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $msg = $this->msg;
        $username = $this->user_name; 
    
        return $this->subject("iwilltilimwell - Voice Journal")
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('emails.users.sharevjlink', compact('msg','username'));
    }
}
