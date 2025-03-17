<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientDocumentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
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
        $client = $this->client;
        return (new MailMessage)
                ->from('support@webhunter24.com')->view('email.notification.client-document',compact('client'))
                ->subject('Client document');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $client = $this->client;
        return [
            'data' => 'Client document',
            'doc_client_id' => $client['id'], 
        ];
    }
}
