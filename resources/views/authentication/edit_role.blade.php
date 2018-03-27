@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Role Details</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data"
                      action="/update_role/{{$role->id}}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Role Name</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="Role Name"
                                       value="{{$role->name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="display_name">Role Display Name</label>
                                <input id="display_name" name="display_name" class="form-control" type="text"
                                       placeholder="Role display name" value="{{$role->display_name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="description">Role Description</label>
                                <input id="description" name="description" class="form-control" type="text"
                                       placeholder="Role description" value="{{$role->description}}">
                            </div>

                        </div>

                        <div class="box-footer">
                            <center>
                                <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Save
                                </button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
