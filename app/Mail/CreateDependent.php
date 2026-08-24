<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateDependent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dependentEmail, $dependentPassword, $dependentName)
    {
        $this->dependentEmail = $dependentEmail;
        $this->dependentPassword = $dependentPassword;
        $this->dependentName = $dependentName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dependentPassword = $this->dependentPassword;
        $dependentEmail = $this->dependentEmail;
        $dependentName = $this->dependentName;
        return $this->subject('Your account created on iWill ‘tiI i’mWell')
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('emails.users.create-dependent', compact('dependentPassword', 'dependentEmail', 'dependentName'));
    }
}
