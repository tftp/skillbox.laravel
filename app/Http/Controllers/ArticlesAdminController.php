<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticlesAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminPrivileges');
    }

    public function index()
    {
        $page = request('page') ?? '1';

        $articles = cache()->tags(['articles'])->remember('articles_admin' . $page, 3600,function () {
            return Article::with('tags')->latest()->paginate(20);
        });

        return view('articles.index', compact('articles'));
    }
}
