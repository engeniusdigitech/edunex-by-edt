<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Test;

class NewTestNotification extends Notification
{
    use Queueable;

    protected $test;

    /**
     * Create a new notification instance.
     */
    public function __construct(Test $test)
    {
        $this->test = $test;
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
            'title' => 'New Test Scheduled',
            'message' => "A new test '{$this->test->title}' has been scheduled for your batch. Date: " . $this->test->test_date->format('M d, Y'),
            'icon' => 'fas fa-file-alt',
            'color' => 'info',
        ];
    }
}
