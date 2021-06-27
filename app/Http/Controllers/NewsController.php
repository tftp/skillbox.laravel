<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Image;
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
        if (auth()->user() && auth()->user()->isAdmin()) {
            $news = News::with('image')->paginate(20);
        } else {
            $news = News::with('image')->paginate(10);
        }

        return view('news.index', ['news' => $news]);
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoryNewsRequest $request)
    {
        $validated = $request->validated();

        $imageForNews = new Image(['path' => $validated['image-news-item']->store('images')]);

        $newsItem = new News();
        $newsItem->title = $validated['title'];
        $newsItem->body = $validated['body'];
        $newsItem->save();
        $newsItem->image()->save($imageForNews);

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

        $newsItem = $news;
        $newsItem->title = $validated['title'];
        $newsItem->body = $validated['body'];
        $newsItem->save();

        if (array_key_exists('image-news-item', $validated)) {
            $newImageForNews = new Image(['path' => $validated['image-news-item']->store('images')]);

            $newsItem->image()->delete();

            $newsItem->image()->save($newImageForNews);
        }

        return redirect()->route('news.show', ['news' => $newsItem]);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return  redirect()->route('news.index');
    }
}
