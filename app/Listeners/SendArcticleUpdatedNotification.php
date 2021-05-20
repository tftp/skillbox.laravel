<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use Illuminate\Support\Facades\Mail;

class SendArcticleUpdatedNotification
{
    private string $adminEmail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleUpdated  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        $adminEmail = $this->adminEmail;
        Mail::to($adminEmail)->send(
            new \App\Mail\ArticleUpdated($event->getArticle())
        );
    }
}
