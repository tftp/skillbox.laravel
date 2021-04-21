@extends('layout.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">{{$title}}</h2>

            @include('layout.errors')
            @include('layout.success')

            <form method="post">
                @csrf
                <div class="form-group">
                    <label for="emailContact">Email</label>
                    <input type="email" class="form-control" id="emailContact" placeholder="Введите свой Email" name="email">
                </div>
                <div class="form-group">
                    <label for="bodyArticle">Сообщение</label>
                    <textarea class="form-control" id="bodyArticle" rows="5" name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection

