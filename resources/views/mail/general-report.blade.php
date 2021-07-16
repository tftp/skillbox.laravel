@component('mail::message')
Итоговый отчет:
<ul>
    @foreach($data as $rowData)
        <li>{{$rowData}}</li>
    @endforeach
</ul>
@endcomponent
