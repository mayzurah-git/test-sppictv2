<?php

namespace App\Mail;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMeetingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;

    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    public function build()
    {
        return $this->subject('Makluman Mesyuarat ' . $this->meeting->title . ' Bil. ' . $this->meeting->meeting_number . '/' . $this->meeting->year)
                    ->view('emails.new_meeting');
    }
}
