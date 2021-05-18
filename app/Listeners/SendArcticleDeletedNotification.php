<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use Illuminate\Support\Facades\Mail;

class SendArcticleDeletedNotification
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
     * @param  ArticleDeleted  $event
     * @return void
     */
    public function handle(ArticleDeleted $event)
    {
        Mail::to($this->adminEmail)->send(
            new \App\Mail\ArticleDeleted($event->getArticle())
        );
    }
}
