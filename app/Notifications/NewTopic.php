<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTopic extends Notification
{
    use Queueable;
    public $topic;

    /**
     * Create a new notification instance.
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $user = User::find($this->topic->user_id);

        return [
            'name' => $user->name,
            'email' => $user->email,
            'message' => 'New Topic started: '. $this->topic->title,
            'type' => 2
        ];
    }
}
