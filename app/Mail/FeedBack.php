<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedBack extends Mailable
{
    use Queueable, SerializesModels;

    public  $FeedBack;
    public  function __construct($FeedBackdata)
    {
       return $this->FeedBack = $FeedBackdata;
    }

    public function build()
    {
        return $this->view('emails.feedback')->with('Feedback',$this->FeedBack);
    }
}
