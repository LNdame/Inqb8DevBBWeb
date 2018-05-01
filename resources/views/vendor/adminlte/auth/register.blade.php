@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')
    <?php
    $establishments = \App\Establishment::all();
    ?>
<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="www.beerlybeloved.co.za"><img src="/img/beerly_logo.png" alt="Beerly Beloved"></a>
            </div>

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

            <div class="register-box-body">
                <p class="login-box-msg">{{ trans('adminlte_lang::message.registermember') }}</p>
                <form action="{{ url('/register') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autofocus/>

                    </div>

                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" autofocus/>
                        {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                    </div>
                    @if (config('auth.providers.users.field','email') === 'username')
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="{{ trans('adminlte_lang::message.username') }}" name="username" autofocus/>
                            {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                        </div>
                    @endif

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>
                        {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
                    </div>
                    <div class="form-group has-feedback">
                        <input type="tell" class="form-control" placeholder="Contact Number" name="contact_number"/>
                        {{--<span class="glyphicon glyphicon-log-in form-control-feedback"></span>--}}
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                        {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Retry Password" name="password_confirmation"/>
                        {{--<span class="glyphicon glyphicon-log-in form-control-feedback"></span>--}}
                    </div>

                    <div class="form-group has-feedback">
                        <label for="establishment_id">Establishment</label>
                        <select id="establishment_id" name="establishment_id" class="form-control">
                            <option></option>
                            @foreach($establishments as $establishment)
                                <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            <label>
                                <div class="checkbox_register icheck">
                                    <label>
                                        <input type="checkbox" name="terms">
                                    </label>
                                </div>
                            </label>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-flat" data-toggle="modal" data-target="#termsModal">{{ trans('adminlte_lang::message.terms') }}</button>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4 col-xs-push-1">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
                        </div><!-- /.col -->
                    </div>
                </form>


                <a href="{{ url('/login') }}" class="text-center">{{ trans('adminlte_lang::message.membreship') }}</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    @include('adminlte::auth.terms')

</body>

@endsection
@push('datatable-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        //        $.noConflict();
        $(document).ready(function ($) {
            $(function () {
                $('select').select2({
                    placeholder: 'Select or search an option'
                });
                $('#establishments').hide();
                $("#email").blur(function () {
                    var randomstring = Math.random().toString(36).slice(-8);
                    $("#username").val($("#email").val());
                    $("#password").val(randomstring);
                });
                $('#role_id').on('change', function () {
                    var selected_value = this.value;
                    if (selected_value == 3) {
                        $('#establishments').show();
                    }
                    else {
                        $('#establishments').hide();
                    }
                });

                $("#email").blur(function () {
                    var randomstring = Math.random().toString(36).slice(-8);
                    $("#user_name").val($("#email").val());
                    $("#password").val(randomstring);
                });
            });
        });
    </script>

@endpush()