@component('mail::message')
# Удалена статья: {{$article->title}}

{{$article->annotation}}

@component('mail::button', ['url' => '/'])
Перейти на главную страницу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
