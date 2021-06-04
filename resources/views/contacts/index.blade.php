@extends('layout.master')

@section('title', 'Сообщения пользователей')

@section('content')

    <h2 class="blog-post-title mb-4">Сообщения пользователей</h2>
    <div class="col-md-8 blog-main">

        @foreach($contacts as $contact)
            @include('contacts.item')
        @endforeach

    </div><!-- /.blog-main -->

@endsection
