<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApproveEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($registrationCode)
    {
        $this->registrationCode = $registrationCode;
    }

    public function build()
    {
        return $this->subject('CV Approved')
                    ->view('emails.approve')
                    ->with(['registrationCode' => $this->registrationCode]);
    }
}
