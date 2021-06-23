@extends('layout.master')

@section('title', 'Новости')

@section('content')

    <div class="col-md-8 blog-main">

        <h2>Список новостей</h2>

        @foreach($news as $newsItem)
            <div class="blog-post">
                @include('news.item')
                <hr>
            </div>
        @endforeach

    </div><!-- /.blog-main -->

@endsection
