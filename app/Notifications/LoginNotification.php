<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user)
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
            ->subject('Nouvelle conexion à l\'espace d\'administration !')
            ->greeting('Bonjour Mr ' . $this->user->name)
            ->action('Accéder à l\'espace d\'administration', url('/admin/property'))
            ->line('Si ce n\'était pas vous alors veuillez vérifier !');
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'Object' => 'Nouvelle conexion !',
            'User_id: ' => $this->user->id,
            'User_email: ' => $this->user->email,
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
