@extends('layout.master')

@section('title', 'Создание новости')

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title mb-4">Создание новости</h2>

            @include('layout.errors')

            <form method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">
                @include('news.form')
                @include('tags.form_element')
                <button type="submit" class="btn btn-primary">Создать новость</button>
            </form>

        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
