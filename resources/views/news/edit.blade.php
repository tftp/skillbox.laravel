@extends('layout.master')

@section('title', 'Изменить новость')


@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">Изменить новость</h2>

            @include('layout.errors')

            <form method="post" action="{{ route('news.update', ['news' => $newsItem]) }}"  enctype="multipart/form-data">
                @method('PATCH')
                @include('news.form')
                <button type="submit" class="btn btn-primary">Изменить новость</button>
            </form>
            <form method="post" action="{{ route('news.destroy', ['news' => $newsItem]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary mt-2">Удалить</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
