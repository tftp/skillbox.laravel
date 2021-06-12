<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\PushallService;

class SendArticleCreatedPushNotification
{
    /**
     * @var PushallService
     */
    private $pushall;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PushallService $pushall)
    {
        $this->pushall = $pushall;
    }

    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $article = $event->getArticle();

        $this->pushall->send(
            'Создана новая статья ',
            $article->title . PHP_EOL .
            (string) route('articles.show', ['article' => $article->code])
        );
    }
}
