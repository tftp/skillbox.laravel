<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

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

    public function store()
    {
        $this->validate(request(), [
           'code' => 'required|unique:articles|alpha_dash',
            'title' => 'required|between:5,100',
            'body' => 'required',
            'annotation' => 'required|max:255',
        ]);
        $article = new Article();
        $article->code = request('code');
        $article->title = request('title');
        $article->body = request('body');
        $article->annotation = request('annotation');
        $article->published = (bool)request('published');

        $article->save();

        return redirect('/');
    }
}
