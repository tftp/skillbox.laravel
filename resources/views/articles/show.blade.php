@extends('layout.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$article->title}}</h2>
            <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

            <p>{{$article->body}}</p>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
