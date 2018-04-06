@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Establishment - {{$establishment->name}}</h3>
                    <a class="btn btn-primary pull-right" onclick="goBack()"><i class="fa fa-arrow-left"></i>Back</a>

                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data"
                      action="/update_establishment/{{$establishment->id}}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
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
                        {{--<div class="row">--}}
                        {{--<div class="col-md-6 form-group">--}}
                        {{--<label for="status">Status</label>--}}
                        {{--<input id="status" name="status" class="form-control" type="text"--}}
                        {{--value="{{$establishment->status}}"--}}
                        {{--placeholder="Establishment Status">--}}
                        {{--</div>--}}

                        {{--</div>--}}

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    @if('active'==$establishment->status)
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">InActive</option>
                                    @else
                                        <option value="inactive" selected>InActive</option>
                                        <option value="active">Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top:1em;">
                            <div class="col-md-6 form-group">
                                <label for="main_picture_url">Main Picture</label>
                                <input id="main_picture_url" name="main_picture_url" class="form-control" type="file"
                                       placeholder="Upload Main picture">
                            </div>
                            <div class="col-md-6">
                                <img id="main_pic_preview" src="{{asset($establishment->main_picture_url)}}"
                                     width="200px" height="200px">
                            </div>
                        </div>
                        <div class="row" style="margin-top:1em;">
                            <div class="col-md-6 form-group">
                                <label for="picture_2">Second Picture</label>

                                <input id="picture_2" name="picture_2" class="form-control" type="file"
                                       placeholder="Upload Second picture">
                            </div>
                            <div class="col-md-6">
                                <img id="pic_2_preview" src="{{asset($establishment->picture_2)}}" width="200px"
                                     height="200px">
                            </div>
                        </div>

                        <div class="row" style="margin-top:1em;">
                            <div class="col-md-6 form-group">
                                <label for="picture_3">Third Picture</label>
                                <input id="picture_3" name="picture_3" class="form-control" type="file"
                                       placeholder="Upload Third picture">
                            </div>
                            <div class="col-md-6">
                                <img id="pic_3_preview" src="{{asset($establishment->picture_3)}}" width="200px"
                                     height="200px">
                            </div>
                        </div>
                        <div class="box-footer">
                            <center>
                                <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Update
                                </button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('image-scripts')
    <script type="text/javascript">
        $.noConflict();
        jQuery(document).ready(function ($) {
            $(function () {
                $("#main_picture_url").change(function () {
                    console.log("ndeio");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#main_pic_preview").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                });

                $("#picture_2").change(function () {
                    console.log("ndeio");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#pic_2_preview").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                });

                $("#picture_3").change(function () {
                    console.log("ndeio");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#pic_3_preview").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(this.files[0]);
                });
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
@endpush




