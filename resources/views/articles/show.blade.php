@extends('layout.master')

@section('title', $article->title)

@section('content')

    <div class="col-md-8 blog-main">

        @include('layout.success')

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">{{$article->title}}</h2>

            @can('update', $article)
                @admin
                    <a href='{{route('admin.articles.edit', ['article' => $article->code])}}' class='badge badge-secondary'>Изменить</a>
                @else
                    <a href='{{route('articles.edit', ['article' => $article->code])}}' class='badge badge-secondary'>Изменить</a>
                @endadmin
            @endcan

            @include('articles.tags', ['tags' => $article->tags])

            <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->
        <div class="comments">
            <h3>Комментарии:</h3>
            @each('comments.item', $article->comments, 'comment', 'comments.empty')

            @include('comments.form')
        </div>

    </div><!-- /.blog-main -->

@endsection
