<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Property $property, public string $topic)
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->topic)
            ->line($this->topic)
            ->line("Titre du bien: " . $this->property->title)
            ->line("Prix: " . $this->property->price)
            ->line("Description: " . $this->property->price)
            ->action('Consulter la liste des biens', url('/admin/property'))
            ->line("Si ce n'était pas vous alors veuillez vérifier l'activité de votre compte");
    }


    public function toDatabase(object $notifiable)
    {
        return [
            'Object' => $this->topic,
            'Property_id: ' => $this->property->id,
            'Property_title: ' => $this->property->title,
        ];
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
