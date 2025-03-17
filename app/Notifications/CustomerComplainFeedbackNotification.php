<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerComplainFeedbackNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $complainConversation;

    public function __construct($complainConversation)
    {
        $this->complainConversation = $complainConversation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $complainConversation = $this->complainConversation;
        return (new MailMessage)
                ->from('support@webhunter24.com')->view('email.notification.customer-complain-feedback',compact('complainConversation'))
                ->subject('Customer Complain Feedback');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $complainConversation = $this->complainConversation;
        return [
            'data' => 'Customer Complain Feedback',
            'customer_complain_id' => $complainConversation['customer_complain_id'],
        ];
    }
}
