@extends('layout.master')

@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="col-md-8 blog-main">

        @foreach($contacts as $contact)
            @include('contacts.item')
        @endforeach

    </div><!-- /.blog-main -->

@endsection