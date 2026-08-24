<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $user_name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $password = $this->password;
        $email = $this->email; 
        $user_name = $this->user_name; 
        return $this->subject('iWill ‘tiI i’mWell - Registration Successful')
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('emails.users.create-user', compact('email', 'password','user_name'));
    }
}
