<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Homework;

class NewHomeworkNotification extends Notification
{
    use Queueable;

    protected $homework;

    /**
     * Create a new notification instance.
     */
    public function __construct(Homework $homework)
    {
        $this->homework = $homework;
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
        return [
            'title' => 'New Homework Assigned',
            'message' => "A new homework assignment '{$this->homework->title}' has been added for your batch. Due on: " . $this->homework->due_date->format('M d, Y'),
            'icon' => 'fas fa-book-open',
            'color' => 'primary',
        ];
    }
}
