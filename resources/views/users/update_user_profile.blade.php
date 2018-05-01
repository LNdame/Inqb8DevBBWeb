@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Your Details</h3>
                </div>
                <form role="form" id="add-material" enctype="multipart/form-data"
                      action="/update_user_profile/edit/{{$user->id}}"
                      method="post"
                >
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="start_date">Full Name</label>
                                <input id="name" name="name" type='text' class="form-control" disabled
                                       value="{{$user->first_name . ' ' . $user->last_name}}"/>

                            </div>
                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type='text' class="form-control" disabled
                                       value="{{$user->email}}"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="depot">Establishment</label>
                                <input id="depot" name="depot" type='text' class="form-control" disabled
                                       value="{{$establishment->name}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <img src="{{ Gravatar::get($user->email)}}" class="img-circle" alt="User Image"/>
                                <input style="margin-top: 1em;" id="picture_url" name="picture_url" class="form-control"
                                       type="file" value=""
                                       placeholder="Upload File Url">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="depot">Contact Number</label>
                                <input id="contact_number" name="contact_number" type='tel' class="form-control"
                                       value="{{$establishment->contact_number}}"/>
                            </div>

                        </div>

                    </div>

                    <div class="box-footer">
                        <center>
                            <button class="btn btn-success" type="submit"><i class="fa fa-plus-square"></i> Update
                            </button>
                        </center>
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
                $('select').select2({
                    placeholder: 'Select or search an option'
                });
            });

        });

    </script>

@endpush()
