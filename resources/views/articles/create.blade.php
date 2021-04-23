@extends('layout.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$title}}</h2>

            @include('layout.errors')

            <form method="post" action="/articles">

                @include('articles.form')

                <button type="submit" class="btn btn-primary">Сохранить статью</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
