@component('mail::message')
    Hi {{$name . ' ' . $surname}},
    An account has been created for you by the Beerly Team.
    Your default generated password are as below:

    Username:{{$user_name}}
    Password: {{$password}}

    Thanks,
    {{ config('app.name') }}
@endcomponent