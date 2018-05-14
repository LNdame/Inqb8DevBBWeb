@component('mail::message')
Beerly Establishment Registration<br>
Hi Admin,<br>
An establishment {{$name . ' ' . $surname}}, has registered as an establishment owner of {{$establishment->name}}.
<br>
Please click the link below to approve the registration.

@component('mail::button', ['url' => $url,'color'=>'green'])
Approve Account
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
