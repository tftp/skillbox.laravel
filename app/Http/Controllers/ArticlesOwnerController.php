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
        $articles = Article::with('tags')->latest()->where('user_id', auth()->id())->get();
        return view('articles.index', compact('title', 'articles'));
    }
}
