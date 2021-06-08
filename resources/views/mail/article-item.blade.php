
{{$article->title}}

@component('mail::button', ['url' => route('articles.show', ['article' => $article->code])])
    Button Text
@endcomponent
