<?php

namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage; use App\User;

class MailResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $token;
    protected $username = null;

    public function setName($name) {
        $this->username = $name;
    }

    public function __construct($token) 
    {
        $this->token = $token;
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
        $link = url( "/password/reset/?token=" . $this->token );
        return ( new MailMessage )
            ->greeting('Hi there, ')
			->subject('Reset Account Password')
            ->line('You are receiving this email because you have requested for password reset. To reset your password, click the link and you will be redirected to a web address to reset your password')
            ->action('Reset Password', $link)
            ->line('If you have not requested for password reset, ignore this message.');
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
