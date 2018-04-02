@component('mail::message')
# Welcome {{ $user->first_name }},

Your account has just been added on {{ config('app.name') }}. <br>
You need to confirm your account before you can use it.<br><br>
Use the details below to confirm your account:
<br><br>

@component('mail::panel')
Your country: {{ $user->country->name }} <br>
Your phone number: {{ $user->phone }} <br>
Your email address: {{ $user->email }} <br>
Confirmation code: {{ $user->getActiveConfirmCode('', '', $user->email) }} <br>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
