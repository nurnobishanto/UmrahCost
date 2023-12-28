<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $otp = '';
    public $subject = '';
    public $user = '';
    public function __construct($otp, $subject, $user)
    {
       $this->otp = $otp;
       $this->subject = $subject;
       $this->user = $user;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.forgot-password-otp')->with([
            'otp' => $this->otp,
            'user' => $this->user,
        ])
        ->subject($this->subject);
    }
}
