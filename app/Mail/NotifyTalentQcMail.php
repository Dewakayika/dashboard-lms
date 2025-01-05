<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyTalentQcMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Check if talentQc relationship exists
        $talentQc = $this->project->talentQc; // This will return the associated User (talentQc)

        if (!$talentQc) {
            // Handle the case when there is no talentQc associated with the project
            // You can either throw an error or handle it gracefully
            return;
        }

        return $this->subject('New Project Application: ' . $this->project->name)
                    ->view('emails.notifyTalentQc')
                    ->with([
                        'qcName' => $talentQc->name,  // talentQc name
                        'projectName' => $this->project->comic_name,
                        'applicantName' => $this->project->talent,  // Assuming 'talent' is the applicant's name
                    ]);
    }
}
