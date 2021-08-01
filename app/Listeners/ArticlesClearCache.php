<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Events\ArticleDeleted;
use App\Events\ArticleUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ArticlesClearCache
{
    public function subscribe($events)
    {
        $events->listen(
            ArticleUpdated::class,
            [ArticlesClearCache::class, 'handleArticleWasChanged']
        );

        $events->listen(
            ArticleDeleted::class,
            [ArticlesClearCache::class, 'handleArticleWasChanged']
        );

        $events->listen(
            ArticleCreated::class,
            [ArticlesClearCache::class, 'handleArticleWasChanged']
        );
    }

    public function handleArticleWasChanged($event)
    {
        cache()->tags(['articles'])->flush();
    }
}
