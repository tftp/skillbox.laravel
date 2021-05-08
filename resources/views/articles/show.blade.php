@extends('layout.master')

@section('title', $title)

@section('content')

    <div class="col-md-8 blog-main">

        @include('layout.success')

        <div class="blog-post">
            <h2 class="blog-post-title">{{$article->title}}</h2>

            @can('update', $article)
                <a href='{{route('articles.edit', ['article' => $article->code])}}' class='badge badge-secondary'>Изменить</a>
            @endcan

            @include('articles.tags', ['tags' => $article->tags])

            <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
