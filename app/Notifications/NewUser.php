<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUser extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    //notify admin when a user has registered
    public function toArray(object $notifiable): array
    {
        return [
            //
            'name' => $this->user->name,
            'email' => $this->user->email,
            'message' => 'New user has registered to the forum',
            'type' => 1
        ];
    }
}
