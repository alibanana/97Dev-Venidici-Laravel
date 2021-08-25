<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BootcampFullRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $course_title;
    public $user_name;
    public $sentence;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($course_title,$user_name,$sentence)
    {
        $this->course_title     = $course_title;
        $this->user_name        = $user_name;
        $this->sentence         = $sentence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Full Bootcamp Application')->view('emails.bootcamp_full_registration');
    }
}
