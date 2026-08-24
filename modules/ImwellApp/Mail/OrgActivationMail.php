<?php

namespace Modules\ImwellApp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Activation invite. Carries a one-time link only - never a password.
 */
class OrgActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $org;
    public $memberName;
    public $activationUrl;
    public $orgUrl;

    public function __construct(ImwellOrg $org, $memberName, $activationUrl)
    {
        $this->org           = $org;
        $this->memberName    = $memberName;
        $this->activationUrl = $activationUrl;
        $this->orgUrl        = $org->url();
    }

    public function build()
    {
        return $this->subject('Activate your ' . $this->org->name . ' account')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view('ImwellApp::mail.activation');
    }
}
