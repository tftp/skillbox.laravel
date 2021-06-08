@component('mail::message')
Список Статей {{$namePeriod}}

@each('mail.article-item', $articles, 'article', 'mail.article-empty')

Thanks,<br>
{{ config('app.name') }}
@endcomponent
