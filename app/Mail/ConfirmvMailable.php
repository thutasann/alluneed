<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmvMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $v_data;


    public function __construct($v_data)
    {
        $this->v_data = $v_data;
    }


    public function build()
    {
        $from_name = "AllUNeed Ecommerce";
        $from_email = "thutasann2002@gmail.com";
        $subject = "Your Account was Updated to Vendor Account";
        return $this->from($from_email, $from_name)
            ->view('emails.confirmv')
            ->subject($subject);
    }
}
