<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccessCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var Invoice
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Access Code')
        ->from(env('MAIL_FROM_ADDRESS'), $this->user->name)
        ->view('emails.users.access-code');
                    // ->text('emails.users.access-code-plain');
    }
}
