@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">Создание статьи</h2>

            @include('layout.errors')

            <form method="post" action="{{ route('articles.store') }}">

                @include('articles.form')

                <div class="form-group">
                    <label for="tagsArticle">Тэги</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tagsArticle"
                        placeholder="тэг1,тэг2,тэг3...."
                        name="tags"
                        value="{{old('tags')}}"
                    >
                </div>

                <button type="submit" class="btn btn-primary">Сохранить статью</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
