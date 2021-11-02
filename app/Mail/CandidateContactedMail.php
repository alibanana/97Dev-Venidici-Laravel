<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateContactedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $candidate;
    public $company;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidate,$company)
    {
        $this->candidate   = $candidate;
        $this->company     = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bootcamp Hiring Partner Information ')->view('emails.job-portal.contacted_candidate');
    }
}
