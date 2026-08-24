<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $promo_data = $this->data;
        return $this->subject('iWill ‘tiI i’mWell - Promocode Generated Successfully')
        ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('emails.promocode.create-code', compact('promo_data'));
    }
}
