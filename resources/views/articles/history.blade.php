@extends('layout.master')

@section('title', $article->title)

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            @include('articles.item')
            <p>{{$article->body}}</p>
        </div>

        @include('history.index')

    </div>

@endsection
