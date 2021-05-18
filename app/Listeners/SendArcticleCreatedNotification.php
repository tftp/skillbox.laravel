<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Support\Facades\Mail;

class SendArcticleCreatedNotification
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
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        Mail::to($this->adminEmail)->send(
            new \App\Mail\ArticleCreated($event->getArticle())
        );
    }
}
