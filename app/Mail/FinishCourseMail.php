<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinishCourseMail extends Mailable
{
    use Queueable, SerializesModels;
    public $course;
    public $link;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course,$link)
    {
        $this->course   = $course;
        $this->link     = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Claim your certificate')->view('emails.complete_course');
    }
}
