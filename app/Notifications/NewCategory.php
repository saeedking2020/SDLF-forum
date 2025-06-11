<?php

namespace App\Notifications;

use App\Models\Category;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCategory extends Notification
{
    use Queueable;
    public $category;

    /**
     * Create a new notification instance.
     */
    public function __construct($category)
    {
        $this->category = $category;
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
        $user = User::find($this->category->user_id);

        return [
            'name' => $user->name,
            'email' => $user->email,
            'message' => 'New Category started: '. $this->category->title,
            'type' => 4
        ];
    }
}
