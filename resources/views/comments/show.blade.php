<div class="comments">
    <h3>Комментарии:</h3>
    @each('comments.item', $article->comments, 'comment', 'comments.empty')

    @include('comments.form')
</div>
