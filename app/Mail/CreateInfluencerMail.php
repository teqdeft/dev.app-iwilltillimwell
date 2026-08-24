<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateInfluencerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($influencerEmail, $influencerPassword, $influencerName)
    {
        $this->influencerEmail = $influencerEmail;
        $this->influencerPassword = $influencerPassword;
        $this->influencerName = $influencerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $influencerPassword = $this->influencerPassword;
        $influencerEmail = $this->influencerEmail;
        $influencerName = $this->influencerName;
        return $this->subject('Your account created on iWill ‘tiI i’mWell')
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('emails.influencers.create-influencer', compact('influencerPassword', 'influencerEmail', 'influencerName'));
    }
}
