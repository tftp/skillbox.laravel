<?php

namespace App\Providers;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use App\Listeners\SendArcticleCreatedNotification;
use App\Listeners\SendArcticleDeletedNotification;
use App\Listeners\SendArcticleUpdatedNotification;
use App\Listeners\SendArticleCreatedPushNotification;
use App\Listeners\WriteHistory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ArticleCreated::class => [
            SendArcticleCreatedNotification::class,
            SendArticleCreatedPushNotification::class,
            WriteHistory::class,
        ],
        ArticleUpdated::class => [
            SendArcticleUpdatedNotification::class,
            WriteHistory::class,
        ],
        ArticleDeleted::class => [
            SendArcticleDeletedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
