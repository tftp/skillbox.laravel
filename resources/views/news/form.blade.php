    @csrf
    <div class="form-group">
        <label for="titleNewsItem">Заголовок новости</label>
        <input type="text" name="title" id="titleNewsItem" class="form-control" value="{{ old('title', $newsItem->title ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="bodyNewsItem">Текст статьи</label>
        <textarea class="form-control" id="bodyNewsItem" name="body" rows="5" required>{{ old('body', $newsItem->body ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="imageNewsItem">Добавить картинку</label>
        <input type="file" name="image-news-item" id="imageNewsItem" accept="image/gif, image/jpeg, image/png">
    </div>
