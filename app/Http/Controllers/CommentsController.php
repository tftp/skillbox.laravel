<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function storeArticlesComment(StoreCommentRequest $request, Article $article)
    {
        $validated = $request->validated();

        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->user()->id,
            'commentable_type' => Article::class,
            'commentable_id' => $article->id,
        ]);

        return view('articles.show', compact('article'));
    }

    public  function storeNewsComment(StoreCommentRequest $request, News $news)
    {
        $validated = $request->validated();

        Comment::create([
            'body' => $validated['body'],
            'user_id' => auth()->user()->id,
            'commentable_type' => News::class,
            'commentable_id' => $news->id,
        ]);

        return redirect()->route('news.show', compact('news'));
    }
}
