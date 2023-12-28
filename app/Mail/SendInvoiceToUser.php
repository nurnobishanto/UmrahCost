<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInvoiceToUser extends Mailable
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
    public function __construct($url, $subject, $user)
    {
       $this->url = $url;
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
        return $this->view('mail.customPackageCreated')->with([
            'url' => $this->url,
            'user' => $this->user,
        ])
        ->subject($this->subject);
        
    }
}
