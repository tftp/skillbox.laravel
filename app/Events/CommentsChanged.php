<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentsChanged
{
    use Dispatchable, SerializesModels;

    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getCommentableType()
    {
        return $this->comment->commentable_type;
    }
}
