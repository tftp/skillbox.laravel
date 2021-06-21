@extends('layout.master')

@section('title', $article->title)

@section('content')

    <div class="col-md-8 blog-main">

        @include('layout.success')

        <div class="blog-post">
            @include('articles.item')
            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->

        @include('comments.show')

    </div><!-- /.blog-main -->

@endsection
