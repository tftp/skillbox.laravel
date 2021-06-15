
<form method="post" action="{{ route('comments.store', ['article' => $article]) }}">
    @csrf
    <div class="form-group">
        <label for="bodyComment">Добавить комментарий</label>
        <textarea class="form-control" id="bodyComment" rows="5" name="body"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Добавить комментарий</button>
</form>
