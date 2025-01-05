<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $project;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Project $project
     */
    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Application Submitted: ' . $this->project->name)
                    ->view('emails.applyProject')
                    ->with([
                        'userName' => $this->user->name,
                        'projectName' => $this->project->name,
                        'applyDate' => now()->format('Y-m-d H:i:s'),
                    ]);
    }
}
