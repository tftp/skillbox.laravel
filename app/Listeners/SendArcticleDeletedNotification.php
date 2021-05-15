<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArcticleDeletedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleDeleted  $event
     * @return void
     */
    public function handle(ArticleDeleted $event)
    {
        \Mail::to(config('mail.adminEmail'))->send(
            new \App\Mail\ArticleDeleted($event->article)
        );
    }
}
