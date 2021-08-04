<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Мои статьи';
        $page = request('page') ?? '1';
        $user_id = auth()->id();

        $articles = cache()->tags(['articles'])->remember("articles_owner{$user_id}_{$page}", 3600, function () {
            return Article::with('tags')->latest()->where('user_id', auth()->id())->paginate(10);
        });

        return view('articles.index', compact('title', 'articles'));
    }
}
