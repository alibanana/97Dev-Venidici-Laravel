<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateProfileAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $candidate;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidate)
    {
        $this->candidate   = $candidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bootcamp Candidate Profile Information')->view('emails.job-portal.profile_update_accepted');
    }
}
