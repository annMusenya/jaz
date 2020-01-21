<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Rejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
	
	protected $arr;
    public function __construct()
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
        $customer = $this->arr['user'];
		$id = $this->arr['id'];
		$reason = $this->arr['reason'];
		$explanation = $this->arr['explanation'];
        return (new MailMessage)
			->subject('Order Unaccepted')
			->greeting($customer .",")
			->line("Reason: ".$reason),
			->line($explanation),
            ->line('We are sorry to notify you that your order #'.$id.' was not accepted. It is unfortunate that we are unable to work on your order.');
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
