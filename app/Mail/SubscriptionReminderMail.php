<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionReminderMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $subscription;
    public $daysLeft;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$daysLeft)
    {
        $this->order = $order;
        $this->daysLeft = $daysLeft;
    }

    
    public function build()
    {
		$subject = "{$this->order['packag_name']} Package – Auto-Renewal in {$this->daysLeft} "
           . ($this->daysLeft > 1 ? 'Days' : 'Day');

			
        return $this->subject($subject)
                    ->view('emails.users.subscription_reminder')->with([
					'order' => $this->order
        ]);
    }
}
