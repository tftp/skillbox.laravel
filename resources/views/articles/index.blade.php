@extends('layout.master')

@section('title', 'Список статей')

@section('content')

    <div class="col-md-8 blog-main">

        @foreach($articles as $article)
            <div class="blog-post">
                @include('articles.item')
                <p>{{$article->annotation}}</p>
            </div>
        @endforeach

    </div><!-- /.blog-main -->

@endsection
