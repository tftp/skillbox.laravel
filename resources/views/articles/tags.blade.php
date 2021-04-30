@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href='/articles/tags/{{ $tag->title }}' class='badge badge-secondary'>{{ $tag->title }}</a>
        @endforeach
    </div>
@endif
