@component('mail::message')
# Hi {{ $name }},
<br/>
<br/>
Welcome to the world of nextGen CMS, DevCMS built on top of robust Laravel platform.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
