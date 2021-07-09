@extends('layout.master')

@section('title', $article->title)

@section('content')

    <div class="col-md-8 blog-main">

        @include('layout.success')

        <div class="blog-post">
            @include('articles.item')
            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->

        <div class="comments">
            @include('comments.show', ['comments' => $article->comments])
            <form method="post" action="{{ route('comments.store_articles_comment', ['article' => $article]) }}">
                @include('comments.form')
            </form>
        </div>

    </div><!-- /.blog-main -->

@endsection
