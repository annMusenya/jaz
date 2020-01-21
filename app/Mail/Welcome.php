<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = "support@custom-written.com";
        $subject = "Welcome to Custom Written";
        $name = $data["username"];

        return $this->view('mail.welcome')
                ->from($address)
                ->subject($subject)
                ->with(['message' => $this->data['message']]);
    }
}