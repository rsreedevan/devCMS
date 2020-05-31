@component('mail::message')
# Hi Admin,

The user {{ $user->name }} with email {{ $user->email }} is removed from the platform.

@component('mail::button', ['url' => $user])
View Users
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
