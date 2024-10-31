<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeclineEmail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @return void
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    public function build()
    {
        return $this->view('emails.decline')
                    ->subject('Update Information on Your Background Webtoon Designer');
    }


}
