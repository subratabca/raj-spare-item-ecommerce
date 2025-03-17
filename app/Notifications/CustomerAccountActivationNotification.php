<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomerAccountActivationNotification extends Notification
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
                ->from('support@webhunter24.com')->view('email.notification.customer-account-activation',compact('customer'))
                ->subject('Customer Account Activation');
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
            'data' => 'Customer Account Activation',
            'customer_id' => $customer['id'], 
        ];
    }
}
