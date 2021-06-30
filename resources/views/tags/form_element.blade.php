<div class="form-group">
    <label for="tags">Тэги</label>
    <input
        type="text"
        class="form-control"
        id="tags"
        placeholder="тэг1,тэг2,тэг3...."
        name="tags"
        @if($tags ?? null)
            value="{{old('tags', $tags->pluck('title')->implode(',') ?? '')}}"
        @else
            value="{{old('tags')}}"
        @endif
    >
</div>
