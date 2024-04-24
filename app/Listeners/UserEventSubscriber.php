<?php

namespace App\Listeners;

use App\Events\ContactRequestEvent;
use App\Events\LoginEvent;
use App\Mail\PropertyContactMail;
use App\Notifications\LoginNotification;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\Notification;

class UserEventSubscriber
{

    public function __construct(public Mailer $mailer)
    {
    }

    /**
     * Handle User Login & send a notification to user
     * @param  App\Events\LoginEvent $event
     * @return bool
     */
    public function handleUserLogin(LoginEvent $event): bool
    {
        if (Auth::attempt($event->credentials)) {
            $event->request->session()->regenerate();
            $user = Auth::user();
            Notification::send($user, new LoginNotification($user));
            return true;
        }
        else{
            return false;
        }
    }

    /**
     *Send an email to admin when user is interested in a new property
     *
     *@param App\Events\ContactRequestEvent $event
     */
    public function handleContactRequest(ContactRequestEvent $event): void
    {
        $this->mailer->send(new PropertyContactMail($event->property, $event->data));
    }


    /**
     * Subscribes to events
     * @param Illuminate\Events\Dispatcher $events
     * @return array 
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            LoginEvent::class => 'handleUserLogin',
            ContactRequestEvent::class => 'handleContactRequest',
        ];
    }
}
