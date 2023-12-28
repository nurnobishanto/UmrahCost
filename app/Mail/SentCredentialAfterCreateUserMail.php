<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SentCredentialAfterCreateUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url = '';
    public $subject = '';
    public $user = '';
    public $password = '';

    public function __construct($url, $subject, $user, $password)
    {
        $this->url = $url;
        $this->subject = $subject;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('mail.sentCredentialAfterCreateUser')->with([
            'url' => $this->url,
            'user' => $this->user,
            'password' => $this->password,
        ])->subject($this->subject);
    }
}
