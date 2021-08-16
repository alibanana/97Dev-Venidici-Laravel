<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BootcampSyllabusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $course;
    public $link;
    public $user_name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course,$link,$user_name)
    {
        $this->course   = $course;
        $this->link     = $link;
        $this->user_name     = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Course Brochure')->view('emails.bootcamp_syllabus');
    }
}
