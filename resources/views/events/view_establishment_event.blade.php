@extends('adminlte::layouts.establishments')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Promotion Details</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Promotion Title</label>
                                <input id="title" name="title" class="form-control" type="text"
                                       placeholder="Promotion Title" value="{{$event->title}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Establishment Name</label>
                                <select id="establishment_id" name="establishment_id" class="form-control">
                                    <option value="{{$establishment->id}}">{{$establishment->name}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Start DateTime</label>
                                <div class='input-group'>
                                    <input id="datetimepicker1" name="start_date" type='text' class="form-control"
                                           value="{{$event->start_date}}"/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="end_date">End DateTime</label>
                                <div class='input-group' id=''>
                                    <input id="datetimepicker2" name="end_date" type='text' class="form-control"
                                           value="{{$event->end_date}}"/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="price">Event Description</label>
                                <textarea id="description" name="description" class="form-control">{{$event->description}}

                                </textarea>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    @if($event->status == 'active')
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">InActive</option>
                                    @else
                                        <option value="active">Active</option>
                                        <option value="inactive" selected>InActive</option>
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="latitude">Location Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="form-control"
                                       value="{{$event->latitude}}"
                                       placeholder="Location Latitude">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="longtitude	">Location Longitude</label>
                                <input id="longitude	" name="longitude" type="text" class="form-control"
                                       value="{{$event->longitude}}"
                                       placeholder="Location Longitude">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="contact_person">Contact Person</label>
                                <input id="contact_person" name="contact_person" class="form-control" type="text"
                                       value="{{$event->contact_person}}"
                                       placeholder="Contact Person">
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="contact_number">Contact Number</label>
                                <input id="contact_number" name="contact_number" type="tel" class="form-control"
                                       value="{{$event->address}}"
                                       placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="address">Event Address</label>
                                <textarea id="address" name="address"
                                          class="form-control">{{$event->address}}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="establishment_url">Event URL</label>
                                <input id="event_url" name="event_url" class="form-control"
                                       type="text" placeholder="Establishment URL" value="{{$event->event_url}}">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="main_picture_url">Event Main Picture</label><br>
                                <img id="main_pic_preview" src="{{asset($event->main_picture_url)}}"
                                     width="200px" height="200px">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script type="text/javascript">
        $.noConflict();
        jQuery(document).ready(function ($) {
            $(function () {
                $('#datetimepicker1').datetimepicker();
                $('#datetimepicker2').datetimepicker();
            });
        });

    </script>

@endpush()
