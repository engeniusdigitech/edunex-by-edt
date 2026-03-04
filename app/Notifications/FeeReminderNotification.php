<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeeReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    //
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
        $instituteName = $notifiable->institute->name ?? 'EduNex';
        return [
            'title' => 'Pending Fee Reminder',
            'message' => "This is a gentle reminder from {$instituteName} that your fee payment for the current month is pending. Please clear your dues.",
            'icon' => 'fas fa-exclamation-triangle',
            'color' => 'warning',
        ];
    }
}
