@extends('layout.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$title}}</h2>

            @include('layout.errors')

            <form method="post" action="/">
                @csrf
                <div class="form-group">
                    <label for="codeArticle">Код статьи</label>
                    <input type="text" class="form-control" id="codeArticle" placeholder="Введите код статьи" name="code">
                </div>
                <div class="form-group">
                    <label for="titleArticle">Заголовок</label>
                    <input type="text" class="form-control" id="titleArticle" placeholder="Заголовок статьи" name="title">
                </div>
                <div class="form-group">
                    <label for="annotationArticle">Краткое содержание</label>
                    <input type="text" class="form-control" id="annotationArticle" placeholder="Краткое содержание статьи" name="annotation">
                </div>
                <div class="form-group">
                    <label for="bodyArticle">Содержание статьи</label>
                    <textarea class="form-control" id="bodyArticle" rows="5" name="body"></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="publishedArticle" name="published">
                    <label class="form-check-label" for="publishedArticle">Опубликовано</label>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить статью</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
