<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon; 


class MeetingInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $startTime;
    public $endTime;

    public function __construct(Carbon $startTime, Carbon $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function build()
    {
        $meetingData = [
            'title' => 'Invitation to Interview for Background Webtoon Designer Position',
            'startDateTime' => $this->startTime, // Bali time zone
            'endDateTime' => $this->endTime,     // Bali time zone
            'googleMeetLink' => 'https://meet.google.com/kpp-tyfw-oex', // Replace with generated link if available
        ];

        return $this->view('emails.meeting_invitation')
                    ->with('meetingData', $meetingData)
                    ->subject('Invitation to Interview for Background Webtoon Designer Position');
    }
}
