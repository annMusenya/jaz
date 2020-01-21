<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeWriter extends Notification
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
        $writer = $this->arr['user'];
        $password = $this->arr['password'];
		
        return (new MailMessage)
			->subject('Congratulations.')
			->greeting($writer .",")
            ->line('Welcome to custom-written.com. We are glad to have you on board, as a freelance writer. We look forward to working together.')
            ->line('Your temporary password for your writer account is:')
            ->line($password)
			->action('My Account',url('/writer'))
            ->line('Visit your writer account to set up your account and password. Happy writing.');          
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
