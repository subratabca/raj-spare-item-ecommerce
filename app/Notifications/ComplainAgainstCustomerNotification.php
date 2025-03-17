<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplainAgainstCustomerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $complain;

    public function __construct($complain)
    {
        $this->complain = $complain;
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
        $complain = $this->complain;
        return (new MailMessage)
                ->from('support@webhunter24.com')->view('email.notification.complain-against-customer',compact('complain'))
                ->subject('Complain Against Customer');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $complain = $this->complain;
        return [
            'data' => 'Complain Against Customer',
            'customer_complain_id' => $complain['id'],
        ];
    }
}
