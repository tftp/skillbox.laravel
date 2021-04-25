@extends('layout.master')

@section('title', $title)


@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$title}}</h2>

            @include('layout.errors')

            <form method="post" action="/articles/{{ $article->code }}">
                @method('PATCH')
                @include('articles.form', ['checked' => ($article->published ? 'checked' : '')])

                <button type="submit" class="btn btn-primary">Изменить статью</button>
            </form>
            <form method="post" action="/articles/{{ $article->code }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary mt-2">Удалить</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
