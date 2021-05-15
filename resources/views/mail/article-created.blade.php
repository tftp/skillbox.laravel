@component('mail::message')
# Создана новая статья: {{$article->title}}

{{$article->annotation}}

@component('mail::button', ['url' => route('articles.show', ['article' => $article->code])])
Перейти
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
