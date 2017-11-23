
@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Establishment</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_establishment"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Establishment Name</label>
                                <input id="name" name="name" class="form-control" placeholder="Establishment Name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control"
                                       placeholder="Establishment Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="latitude">Establishment Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="form-control"
                                       placeholder="Establishment Latitude">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="longtitude	">Establishment Longitude</label>
                                <input id="longitude	" name="longitude" type="text" class="form-control"
                                       placeholder="Establishment Longitude">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="liqour_license">Liqour License</label>
                                <input id="liqour_license" name="liqour_license" type="text" class="form-control"
                                       placeholder="Liqour License">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">HS License</label>
                                <input id="hs_license" name="hs_license" class="form-control" type="text"
                                       placeholder="HS License">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="contact_person">Contact Person</label>
                                <input id="contact_person" name="contact_person" class="form-control" type="text"
                                       placeholder="Contact Person">
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control"
                                       placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="last_inspection_date">Last Inspection Date</label>
                                <input id="last_inspection_date" name="last_inspection_date" type="date"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="establishment_url">Establishment URL</label>
                                <input id="establishment_url" name="establishment_url" class="form-control"
                                       type="text" placeholder="Establishment URL">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="main_picture_url">Main Picture</label>
                                <input id="main_picture_url" name="main_picture_url" class="form-control" type="file"
                                       placeholder="Upload Main picture">
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6 form-group">
                                <label for="picture_2">Second Picture</label>
                                <input id="picture_2" name="picture_2" class="form-control" type="file"
                                       placeholder="Upload Second picture">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="picture_3">Third Picture</label>
                                <input id="picture_3" name="picture_3" class="form-control" type="file"
                                       placeholder="Upload Third picture">
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
