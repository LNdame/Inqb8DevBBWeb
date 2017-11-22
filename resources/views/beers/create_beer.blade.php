@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Beer</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_beer"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Beer Name</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="Beer Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="description">Beer Description</label>
                                <input id="description" name="description" class="form-control" type="text"
                                       placeholder="Beer Description">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="vendor">Vendor</label>
                                <input id="vendor" name="vendor" class="form-control" type="text"
                                       placeholder="Beer Vendor">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="percentage">Beer Percentage</label>
                                <input id="percentage" name="percentage" type="number" step="0.1" class="form-control"
                                       placeholder="Beer Percentage">
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
