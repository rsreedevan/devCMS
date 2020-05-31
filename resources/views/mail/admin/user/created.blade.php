@component('mail::message')
# Hi Admin,

A new user {{ $user->name }} with email {{ $user->email }} is registered to the system.

@component('mail::button', ['url' => $url])
View Users
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
