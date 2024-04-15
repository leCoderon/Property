<?php

namespace App\Providers;

use App\Events\ContactRequestEvent;
use App\Events\DeletePropertyEvent;
use App\Events\LoginEvent;
use App\Events\TestEvent;
use App\Listeners\ContactListener;
use App\Listeners\DeletePropertyListener;
use App\Listeners\LoginListener;
use App\Listeners\PropertyEventSubscriber;
use App\Listeners\TestListener;
use App\Listeners\UserEventSubscriber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        
        
        // ContactRequestEvent::class => [
        //     ContactListener::class,
        // ],

        // LoginEvent::class => [
        //     LoginListener::class,

        // ],



    ];

    protected $subscribe = [
        UserEventSubscriber::class,
        PropertyEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
