@extends('layout.master')

@section('title', 'Главная')

@section('content')

    <div class="col-md-8 blog-main">

        @foreach($articles as $article)
            @include('articles.item')
        @endforeach

    </div><!-- /.blog-main -->

@endsection
