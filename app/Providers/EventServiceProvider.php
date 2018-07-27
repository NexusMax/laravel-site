<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*
        'App\Events\Event' => [
            'App\Listeners\ChatMessageDeleteEventListener',
        ],*/

        'App\Events\ChatMessageDeleteEvent' => [
            'App\Listeners\ChatMessageDeleteEventListener'
        ],

        'App\Events\ChatMessageSentEvent' => [
            'App\Listeners\ChatMessageSentEventListener'
        ],

        'App\Events\ChatUserBanEvent' => [
            'App\Listeners\ChatUserBanEventListener'
        ],

        'App\Events\OrderStoredEvent' => [
            'App\Listeners\StoreOrderUserAgentEventListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
