<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;


    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Hello, Admin')
                    ->line('New user name: '.$this->user->name.' recently registered your website.')
                    ->action('Notification Action', url('/'))
                    ->line('Please keep in touch!');
    }


    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name
        ];
    }
}
