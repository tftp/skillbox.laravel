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
        $title = 'Главная';
        $articles = Article::with('tags')->latest()->where('published', true)->get();
        return view('articles.index', compact('title', 'articles'));
    }

    public function show(Article $article)
    {
        $title = $article->title;
        return view('articles.show', compact('title', 'article'));
    }

    public function create()
    {
        $title = 'Создание статьи';
        return view('articles.create', compact('title'));
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

        return redirect('/');
    }

    public function edit(Article $article)
    {
        $title = 'Изменить статью';
        return view('articles.edit', compact('title', 'article'));
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
        return redirect('/');
    }
}

