<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectSubmittedNotification extends Mailable
{
    use SerializesModels;

    public $project;

    /**
     * Create a new message instance.
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi Permohonan Projek Baharu: ' . $this->project->project_code)
                    ->view('emails.project_submitted');
    }
}