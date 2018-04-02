@component('mail::message')
# Welcome {{ $user->first_name }},

Your account has just been added on TERC. <br>
You can login to your account by clicking the link below: <br>
<br>

@component('mail::panel')
Your email address: {{ $user->email }} <br>
@endcomponent

@component('mail::button', ['url' => 'http://41.215.126.10/terc'])
View Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
