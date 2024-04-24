<?php

namespace App\Notifications;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactRequestNotification extends Notification
{

    /**
     * Create a new notification instance.
     */
    public function __construct(public Property $property, public array $userData)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Je suis intéressé par le bien suivant : ' . $this->property->title)
            ->from($this->userData['email'])
            ->replyTo($this->userData['email'])
            ->line("Titre du bien: " . $this->property->title)
            ->line("Prix: " . $this->property->price)
            ->line("Description: " . $this->property->price)
            ->action('Consulter la liste des biens', url('/admin/property'));
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
