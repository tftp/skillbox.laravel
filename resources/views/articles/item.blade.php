<h2 class="blog-post-title"><a href="/articles/{{$article->code}}">{{$article->title}}</a></h2>
@can('update', $article)
    @admin
        <a href='{{route('admin.articles.edit', ['article' => $article])}}' class='badge badge-secondary'>Изменить</a>
        <a href='{{route('admin.articles.history', ['article' => $article])}}' class='badge badge-secondary'>История</a>
    @else
        <a href='{{route('articles.edit', ['article' => $article])}}' class='badge badge-secondary'>Изменить</a>
    @endadmin
@endcan

@include('articles.tags', ['tags' => $article->tags])

<p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>
