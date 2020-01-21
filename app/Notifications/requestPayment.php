<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class requestPayment extends Notification
{
    use Queueable;
    protected $arr;
    
    public function __construct(array $arr)
    {
        $this->arr = $arr; 
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $customer = $this->arr['user'];
        $order = $this->arr['order'];
		
        return (new MailMessage)
			->subject('Pending Payment')
			->greeting($customer .",")
            ->line('Thank you for placing an order. We would like to request you to make payment for this order. To proceed, checkout using Paypal.')
			->action('Manage Order',url('/orders/'.$order))
            ->line('Visit your account to make payment.');          
    }
    
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
