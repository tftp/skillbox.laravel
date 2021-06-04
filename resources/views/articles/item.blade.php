<div class="blog-post">
    <h2 class="blog-post-title"><a href="/articles/{{$article->code}}">{{$article->title}}</a></h2>
    @can('update', $article)
        @admin
            <a href='{{route('admin.articles.edit', ['article' => $article->code])}}' class='badge badge-secondary'>Изменить</a>
        @else
            <a href='{{route('articles.edit', ['article' => $article->code])}}' class='badge badge-secondary'>Изменить</a>
        @endadmin
    @endcan

    @include('articles.tags', ['tags' => $article->tags])

    <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

    <p>{{$article->annotation}}</p>
</div><!-- /.blog-post -->
