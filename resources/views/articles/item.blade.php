<div class="blog-post">
    <h2 class="blog-post-title"><a href="/articles/{{$article->code}}">{{$article->title}}</a></h2>
    <a href='/articles/{{$article->code}}/edit' class='badge badge-secondary'>Изменить</a>
    <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

    <p>{{$article->annotation}}</p>
</div><!-- /.blog-post -->
