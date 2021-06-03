<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticlesAdminController extends Controller
{
    public function index()
    {
        if (! Gate::allows('adminPrivileges')) {
            abort(403);
        }

        $title = 'Список статей';
        $articles = Article::with('tags')->latest()->get();
        return view('articles.index', compact('title', 'articles'));
    }
}
