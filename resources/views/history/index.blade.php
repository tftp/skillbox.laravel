<div class="comments">
    <h3>История изменений:</h3>

    @foreach($article->histories as $history)
        <p>{{$history->user->email}} - {{$history->created_at->diffForHumans()}} - {{$history->changes}}</p>
        <hr>
    @endforeach
</div>
