<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminPrivileges')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        return view('news.index', ['news' => $news]);
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoryNewsRequest $request)
    {
        $validated = $request->validated();

        $newsItem = new News();
        $newsItem->img_path = $validated['image-news-item']->store('images');
        $newsItem->title = $validated['title'];
        $newsItem->body = $validated['body'];
        $newsItem->save();

        return redirect()->route('news.show', ['news' => $newsItem]);
    }

    public function show(News $news)
    {
        return view('news.show', ['newsItem' => $news]);
    }

    public function edit(News $news)
    {
        return view('news.edit', ['newsItem' => $news]);
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $validated = $request->validated();

        $image = $request->validate([
            'image-news-item' => 'file|image|max:512',
        ]);

        $newsItem = $news;
        $newsItem->title = $validated['title'];
        $newsItem->body = $validated['body'];
        $newsItem->img_path = $image ? $image['image-news-item']->store('images') : $newsItem->img_path;
        $newsItem->save();

        return redirect(route('news.show', ['news' => $newsItem]));
    }

    public function destroy(News $news)
    {
        $news->delete();

        return  redirect(route('news.index'));
    }
}
