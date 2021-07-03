@extends('layout.master')

@section('title', $title)

@section('content')

    <div class="col-md-8 blog-main">

        <div class="blog-post">
            <h2 class="blog-post-title">Информация о портале</h2>

            <table class="table ">
                @foreach($collection as $description => $collectItem)
                    <thead>
                        <tr class="table-info">
                            <th scope="col"  colspan="2">{{$description}}</th>
                        </tr>
                    </thead>
                    @foreach($collectItem as $key => $item)
                        <tbody>
                        <tr>
                            <td>{{$key}}</td>
                            <td class="text-center">{{$item}}</td>
                        </tr>
                        </tbody>
                    @endforeach
                @endforeach
            </table>

        </div><!-- /.blog-post -->

    </div><!-- /.blog-main -->

@endsection
