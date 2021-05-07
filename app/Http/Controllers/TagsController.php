<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->get();
        $title = 'Статьи - ' . $tag->title;

        return view('articles.index', compact('articles', 'title'));
    }
}
