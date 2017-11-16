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
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="middle_name">Middle Name</label>
                                <input id="middle_name" name="middle_name" type="text" class="form-control" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" class="form-control" type="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="username">User Name</label>
                                <input id="username" name="username" type="text" class="form-control" placeholder="User Name">
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


