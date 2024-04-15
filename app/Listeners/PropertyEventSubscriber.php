<?php

namespace App\Listeners;

use App\Events\DeletePropertyEvent;
use App\Events\StorePropertyEvent;
use App\Notifications\PropertyNotification;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PropertyEventSubscriber
{
    public function __construct(public Notification $notify)
    {
    }

    public function handleStore(StorePropertyEvent $event)
    {
        $subject = "Nouveau bien crée";
        $user = Auth::user();
        Notification::send($user, new PropertyNotification($event->property, $subject));
    }

    public function handleDelete(DeletePropertyEvent $event)
    {
        $subject = "Nouveau bien supprimé";
        $user = Auth::user();
        Notification::send($user, new PropertyNotification($event->property, $subject));
    }

    public function subscribe(Dispatcher $events)
    {
        return [
            DeletePropertyEvent::class => 'handleDelete',
            StorePropertyEvent::class => 'handleStore',
        ];
    }
}
