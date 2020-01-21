<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WriterReturn extends Notification
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
        $admin = $this->arr['user'];
        $order = $this->arr['order'];
        $writer = $this->arr['writer'];
		
        return (new MailMessage)
			->subject('Order Returned')
			->greeting("Hello ".$admin.",")
            ->line('Order #'.$order.' assigned to writer,'.$writer.', has been rejected. You need to reassign the order to a different writer.')
			->action('Manage Orders',url('/admin/order/'.$order))
            ->line('You can place this order on bidding or directly assign it to writers.');   
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
