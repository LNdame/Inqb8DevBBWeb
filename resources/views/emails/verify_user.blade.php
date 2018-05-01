@component('mail::message')
    Beerly Registration - Account Verification<br>
    Hi {{$name .'  '. $surname}},<br>
    You have been successfully registered with Beerly Beloved.
    Please verify your account by clicking the link below.

    @component('mail::button', ['url' => $url,'color'=>'green'])
        Verify Account
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
