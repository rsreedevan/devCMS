@component('mail::message')
# Hello {{$name}}

We are really sorry to inform you that your account has been terminated by our adminstrator. 
Please do contact us if you want to regain the access. 

@component('mail::button', ['url' => ''])
Contact Support
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
