@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Password reset
@endsection

@section('content')

    <body class="login-page">

    <div id="app">
        <div class="login-box">
        <div class="login-logo">
            <a href="www.beerlybeloved.co.za"><img src="/img/beerly_logo.png" alt="Beerly Beloved"></a>
        </div><!-- /.login-logo -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('adminlte_lang::message.passwordreset') }}</p>

            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}"
                       name="email" value="{{ old('email') }}"/>
                {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
            </div>
            <div class="col-xs-4 col-xs-push-1">
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
            </div>

            <a href="{{ url('/login') }}">Log in</a><br>
            <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.membreship') }}</a>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>

@endsection
