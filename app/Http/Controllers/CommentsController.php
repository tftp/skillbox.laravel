<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function store(StoreCommentRequest $request, Article $article)
    {
        $validated = $request->validated();

        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->user()->id,
            'article_id' => $article->id,
        ]);

        return view('articles.show', compact('article'));
    }
}