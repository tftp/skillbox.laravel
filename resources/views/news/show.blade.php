
@extends('layout.master')

@section('title', 'Новости: ' . $newsItem->title)

@section('content')

    <div class="col-md-8 blog-main">

        @include('layout.success')

        <div class="blog-post">
            @include('news.item')
            <p><img src="{{asset($newsItem->img_path)}}" width="200" height="200"></p>
            <p>{{$newsItem->body}}</p>
        </div><!-- /.blog-post -->

        <div class="comments">
            @include('comments.show', ['comments' => $newsItem->comments])
            <form method="post" action="{{ route('comments.store_news_comment', ['news' => $newsItem]) }}">
                @include('comments.form')
            </form>
        </div>

    </div><!-- /.blog-main -->

@endsection

