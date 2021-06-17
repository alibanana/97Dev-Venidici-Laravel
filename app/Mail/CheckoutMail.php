<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class checkoutMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invoice;
    public $courses_string;
    public $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice,$courses_string,$link)
    {
        $this->invoice = $invoice;
        $this->courses_string = $courses_string;
        $this->link = $link;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please Complete Your Payment')->view('emails.checkout');
    }
}
