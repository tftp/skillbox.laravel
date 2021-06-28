<h3><a href="{{ route('news.show', ['news' => $newsItem]) }}">{{$newsItem->title}}</a></h3>
@admin
    <form method="post" action="{{ route('news.destroy', ['news' => $newsItem]) }}">
        @csrf
        @method('DELETE')
        <a href='{{ route('news.edit', ['news' => $newsItem]) }}' class='btn btn-secondary btn-sm'>Изменить</a>
        <button type="submit" class='btn btn-secondary btn-sm'>Удалить</button>
    </form>
@endadmin

<p class="blog-post-meta">{{$newsItem->created_at->toFormattedDateString()}}</p>

