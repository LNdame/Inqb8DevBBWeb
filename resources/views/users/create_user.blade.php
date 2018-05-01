@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add User</h3>
                </div>
                <form role="form" id="add-establishment" action="/save_user" method="post">
                    {{ csrf_field() }}
                    <input id="creator_id" hidden name="creator_id" type="number" value="{{Auth::user()->id}}">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" class="form-control" placeholder="First Name"
                                       required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="form-control"
                                       placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6 form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" class="form-control" type="email"
                                       placeholder="Email Address" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" class="form-control" type="tel"
                                       placeholder="Contact Number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Creator</label>
                                <input id="" disabled="disabled" name="" type="text" class="form-control"
                                       value="{{Auth::user()->first_name . ' ' .Auth::user()->last_name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="role_id">Role</label>
                                <select id="role_id" name="role_id" class="form-control" required>
                                    <option></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="establishments" class="row">
                            <div class="col-md-6 form-group">
                                <label for="establishment_id">Establishment</label>
                                <select id="establishment_id" name="establishment_id" class="form-control" required>
                                    <option></option>
                                    @foreach($establishments as $establishment)
                                        <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        {{--<div class="row">--}}
                        {{----}}
                        {{--</div>--}}
                        <hr>
                        <label>*Auto generated credentials - Credentials will be mailed to the user.</label>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="username">User Name</label>
                                <input id="username" name="username" type="text" class="form-control"
                                       placeholder="User Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="text" class="form-control" required
                                       placeholder="Password">
                            </div>
                        </div>

                        <div class="box-footer">
                            <center>
                                <button   class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

