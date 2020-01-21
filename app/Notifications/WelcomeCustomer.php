<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeCustomer extends Notification
{
    use Queueable;
    protected $arr;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = $this->arr['user'];
		
        return (new MailMessage)
			->subject('Welcome')
			->greeting($name .",")
            ->line('Welcome to custom-written.com. We are glad to have you on board, as a customer. You can now place your orders and we will gladly fulfill them.')
            ->action('Place an Order',url('http://dashboard.custom-written.com'))
            ->line('Place your first order, and get a welcome 10% discount on your order.');          
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
