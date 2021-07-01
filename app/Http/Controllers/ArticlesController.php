<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\TagsSynchronizer;

class ArticlesController extends Controller
{
    private TagsSynchronizer $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->tagsSynchronizer = $tagsSynchronizer;
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update,article')->only(['edit', 'update']);
        $this->middleware('can:delete,article')->only('destroy');
    }

    public function index()
    {
        $articles = Article::with('tags')->latest()->where('published', true)->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article = $article->load('comments');
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $article = new Article();
        $article->code = request('code');
        $article->title = request('title');
        $article->body = request('body');
        $article->annotation = request('annotation');
        $article->published = (bool)request('published');
        $article->user_id = auth()->id();

        $article->save();

        $tags = collect(array_filter(explode(',', request('tags'))));

        $this->tagsSynchronizer->sync($tags, $article);

        return redirect(route('home'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, UpdateArticleRequest $request)
    {
        $attributes = $request->validated();
        $attributes['published'] = (bool)request('published');

        $article->update($attributes);

        $tags = collect(array_filter(explode(',', request('tags'))));

        $this->tagsSynchronizer->sync($tags, $article);

        return redirect()->route('articles.show', ['article' => $article])->with('success', 'Статья изменена');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('home'));
    }

    public function history(Article $article)
    {
        $article = $article->load(['histories' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('articles.history', compact('article'));
    }
}

