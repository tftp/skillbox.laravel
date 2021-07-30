<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdateBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('admin-channel');
    }

    public function broadcastWith()
    {
        $changes = $this->article->histories()->latest()->first()->changes;
        $link = route('articles.show', ['article' => $this->article]);
        $id = $this->article->id;

        return ['id' => $id,
                'changes' => $changes,
                'link' => $link,
                ];
    }
}
