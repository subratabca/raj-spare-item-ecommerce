<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification
{
    use Queueable;

    protected $originalNotification;

    public function __construct($originalNotification)
    {
        $this->originalNotification = $originalNotification;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

public function toArray(object $notifiable): array
{
    $data = [
        'data' => 'Unread Notification. Please check it',
        'original_notification_id' => $this->originalNotification->id,
    ];

    // Ensure `data` is an array
    $notificationData = is_array($this->originalNotification->data) 
        ? $this->originalNotification->data 
        : json_decode($this->originalNotification->data, true);

    // Debug: Log notification data
    \Log::info('Original Notification Data:', $notificationData);

    // Add only non-null IDs dynamically
    foreach ([
        'food_id', 'order_id', 'complain_id', 
        'customer_complain_id', 'client_id', 
        'doc_client_id', 'customer_id', 'doc_customer_id'
    ] as $key) {
        if (!empty($notificationData[$key])) {
            $data[$key] = $notificationData[$key];
        }
    }

    // Debug: Log final data before inserting
    \Log::info('Final Notification Data:', $data);

    return $data;
}

}

