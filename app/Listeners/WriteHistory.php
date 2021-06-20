<?php

namespace App\Listeners;

use App\Events\HistoryChanged;
use App\Models\HistoryArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WriteHistory
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
     * @param  HistoryChanged  $event
     * @return void
     */
    public function handle(HistoryChanged $event)
    {
        $article = $event->getArticle();
        $changes = $article->getChanges();

        $history = new HistoryArticle();
        $history->user_id = auth()->id() ? auth()->id() : $article->user_id; // для seeders наполнителей задается $article->user_id
        $history->article_id = $article->id;
        $history->changes = empty($changes) ? 'Статья создана' : json_encode($changes, JSON_UNESCAPED_UNICODE);
        $history->save();
    }
}
