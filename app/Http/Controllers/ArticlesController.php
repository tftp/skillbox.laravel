<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
//use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function index()
    {
        $title = 'Главная';
        $articles = Article::latest()->get();
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

    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->code = request('code');
        $article->title = request('title');
        $article->body = request('body');
        $article->annotation = request('annotation');
        $article->published = (bool)request('published');

        $article->save();

        return redirect('/');
    }

    public function edit(Article $article)
    {
        $title = 'Изменить статью';
        return view('articles.edit', compact('title', 'article'));
    }

    public function update(Article $article, ArticleRequest $request)
    {
        $atributes = $request->validated();

        $atributes['published'] = (bool)request('published');

        $article->where('code', $article->code)->update($atributes);

        return redirect()->route('articles.show', ['article' => $atributes['code']])->with('success', 'Статья изменена');
    }

    public function destroy(Article $article)
    {
        $article->where('code', $article->code)->delete();
        return redirect('/');
    }
}

