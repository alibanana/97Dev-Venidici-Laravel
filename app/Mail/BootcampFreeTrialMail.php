<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BootcampFreeTrialMail extends Mailable
{
    use Queueable, SerializesModels;
    public $course_title;
    public $user_name;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course_title,$user_name)
    {
        $this->course_title     = $course_title;
        $this->user_name        = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bootcamp Free Trial Application')->view('emails.bootcamp_free_trial');
    }
}
