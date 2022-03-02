<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponSendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $c_data;

    public function __construct($c_data)
    {
        $this->c_data = $c_data;
    }

    public function build()
    {
        $from_name = "AllUNeed Ecommerce";
        $from_email = "alluneed881@gmail.com";
        $subject = "You Received a coupon Code from our Seller";
        return $this->from($from_email, $from_name)
            ->view('emails.sendcoupon')
            ->subject($subject);
    }
}
