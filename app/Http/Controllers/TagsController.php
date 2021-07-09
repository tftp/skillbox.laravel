<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        if (request()->routeIs('articles.tags')) {
            $articles = $tag->articles()->with('tags')->paginate(5);
            $title = 'Статьи - ' . $tag->title;

            return view('articles.index', compact('articles', 'title'));
        }

        $news = $tag->news()->with('tags')->paginate(5);
        $title = 'Статьи - ' . $tag->title;

        return view('news.index', compact('news', 'title'));
    }
}
