<?php

namespace App\Listeners;

use App\Events\CommentsChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentsClearCache
{
    public function handle(CommentsChanged $event)
    {
        if ($event->getCommentableType() == 'App\Models\Article')
        {
            cache()->tags(['comments_article'])->flush();
        } else {
            cache()->tags(['comments_news'])->flush();
        }
    }
}
