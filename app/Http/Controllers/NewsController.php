<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Services\TagsSynchronizer;

class NewsController extends Controller
{
    private TagsSynchronizer $tagsSynchronizer;

    public function __construct(TagsSynchronizer $tagsSynchronizer)
    {
        $this->tagsSynchronizer = $tagsSynchronizer;
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
            $news = News::paginate(20);
        } else {
            $news = News::paginate(10);
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

        $newsItem = new News();
        $newsItem->img_path = getPath($validated['image-news-item']);
        $newsItem->title = $validated['title'];
        $newsItem->body = $validated['body'];
        $newsItem->save();

        $tags = collect(array_filter(explode(',', request('tags'))));

        $this->tagsSynchronizer->sync($tags, $newsItem);

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
        $newsItem->img_path = array_key_exists('image-news-item', $validated) ? getPath($validated['image-news-item']) : $newsItem->img_path;
        $newsItem->save();

        $tags = collect(array_filter(explode(',', request('tags'))));

        $this->tagsSynchronizer->sync($tags, $newsItem);

        return redirect()->route('news.show', ['news' => $newsItem]);
    }

    public function destroy(News $news)
    {
        $news->delete();

        return  redirect()->route('news.index');
    }
}
