<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductPublishNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
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
        $product = $this->product;
        return (new MailMessage)
                ->from('support@webhunter24.com')->view('email.notification.product-publish',compact('product'))
                ->subject('Product Publish');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $product = $this->product;
        return [
            'data' => 'Product Publish',
            'product_id' => $product['id'],
        ];
    }
}
