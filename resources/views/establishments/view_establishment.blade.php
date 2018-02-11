@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Establishment Details</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data"
                      action="/update_establishment/{{$establishment->id}}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Establishment Account Name</label>
                                <input id="user_name" name="user_name" class="form-control"
                                       placeholder="Establishment Account Name"
                                       value="{{$establishment->user_name}}">

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Establishment Name</label>
                                <input id="name" name="name" class="form-control" placeholder="Establishment Name"
                                       value="{{$establishment->name}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Address</label>
                                <input id="address" name="address" type="text" class="form-control"
                                       value="{{$establishment->address}}"
                                       placeholder="Establishment Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="latitude">Establishment Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="form-control"
                                       value="{{$establishment->latitude}}"
                                       placeholder="Establishment Latitude">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="longtitude	">Establishment Longitude</label>
                                <input id="longitude	" name="longitude" type="text" class="form-control"
                                       value="{{$establishment->longitude}}"
                                       placeholder="Establishment Longitude">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="liqour_license">Liqour License</label>
                                <input id="liqour_license" name="liqour_license" type="text" class="form-control"
                                       value="{{$establishment->liqour_license}}"
                                       placeholder="Liqour License">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">HS License</label>
                                <input id="hs_license" name="hs_license" class="form-control" type="text"
                                       value="{{$establishment->hs_license}}"
                                       placeholder="HS License">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="contact_person">Contact Person</label>
                                <input id="contact_person" name="contact_person" class="form-control" type="text"
                                       value="{{$establishment->contact_person}}"
                                       placeholder="Contact Person">
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control"
                                       value="{{$establishment->contact_number}}"
                                       placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="last_inspection_date">Last Inspection Date</label>
                                <input id="last_inspection_date" name="last_inspection_date" type="date"
                                       value="{{date('Y-m-d',strtotime($establishment->last_inspection_date))}}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="establishment_url">Establishment URL</label>
                                <input id="establishment_url" name="establishment_url" class="form-control"
                                       value="{{$establishment->establishment_url}}"
                                       type="text" placeholder="Establishment URL">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="establishment_url">Status</label>
                                <input id="establishment_url" name="establishment_url" class="form-control"
                                       value="{{$establishment->status}}">
                            </div>
                        </div>


                        <div class="row" style="margin-top:1em;">
                            <div class="col-md-6 form-group">
                                <label for="main_picture_url">Main Picture</label><br>
                                <img id="main_pic_preview" src="{{asset($establishment->main_picture_url)}}"
                                     width="200px" height="200px">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="picture_2">Second Picture</label><br/>
                                <img id="pic_2_preview" src="{{asset($establishment->picture_2)}}" width="200px"
                                     height="200px">
                            </div>

                        </div>

                        <div class="row" style="margin-top:1em;">
                            <div class="col-md-6 form-group">
                                <label for="picture_3">Third Picture</label><br/>
                                <div class="col-md-6">
                                    <img id="pic_3_preview" src="{{asset($establishment->picture_3)}}" width="200px"
                                         height="200px">
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection





