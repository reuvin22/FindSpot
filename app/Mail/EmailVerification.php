<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $notifiable;
    /**
     * Create a new message instance.
     */
    public function __construct($notifiable, $url)
    {
        $this->notifiable = $notifiable;
        $this->url = $url;
    }

   public function build()
   {
        return $this->subject('Email Verification')
        ->view('verify-email')
        ->with($this->url);
   }
}
