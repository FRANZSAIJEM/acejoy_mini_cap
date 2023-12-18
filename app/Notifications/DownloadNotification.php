<?php

namespace App\Notifications;
use App\Models\Plugin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DownloadNotification extends Notification
{
    use Queueable;

    protected $plugin;

    /**
     * Create a new notification instance.
     */
    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line('Thank you for diving into the ocean of flavors with us! We are thrilled to fulfill your fishy order.')
        ->line('Your choice of "' . $this->plugin->name . '" is like a rare catch from the deep sea.')
        ->line('Our underwater baristas are diligently preparing your order, ensuring its as fresh as a fisherman\'s morning catch.')

        ->line('Swim back to the main page if you want to explore more oceanic delights!')
        ->line('If you have any queries or need assistance, feel free to reach out.')
        ->line('We appreciate your underwater patronage and hope you enjoy every flavorful swim!')
        ->action('Done', url('/'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
