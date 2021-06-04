@extends('layout.master')

@section('title', 'Изменить статью')


@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">Изменить статью</h2>

            @include('layout.errors')

            <form method="post" action="{{ route('articles.update', ['article' => $article]) }}">
                @method('PATCH')
                @include('articles.form', ['checked' => ($article->published ? 'checked' : '')])
                <div class="form-group">
                    <label for="tagsArticle">Тэги</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tagsArticle"
                        placeholder="тэг1,тэг2,тэг3...."
                        name="tags"
                        value="{{old('tags', $article->tags->pluck('title')->implode(',') ?? '')}}"
                    >
                </div>

                <button type="submit" class="btn btn-primary">Изменить статью</button>
            </form>
            <form method="post" action="{{ route('articles.update', ['article' => $article]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary mt-2">Удалить</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
