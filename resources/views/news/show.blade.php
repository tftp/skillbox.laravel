
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

    </div><!-- /.blog-main -->

@endsection

