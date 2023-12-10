<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;
    public $user;
    /**
     * Create a new message instance.
     *
     * @param  string  $verificationUrl
     * @return void
     */
    public function __construct($verificationUrl, $user)
    {
        $this->verificationUrl = $verificationUrl;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('auth.verify-email')
                    ->subject('Verify Your Email Address')
                    ->with(['user' => $this->user]);
    }
}
