<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCustomerRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
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
        $customer = $this->customer;
        return (new MailMessage)
                ->from('support@webhunter24.com')->view('email.notification.new-customer-registration',compact('customer'))
                ->subject('New Customer Registration');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $customer = $this->customer;
        return [
            'data' => 'New Customer Registration',
            'customer_id' => $customer['id'], 
        ];
    }
}
