@extends('adminlte::layouts.app')
<?php $establishment = App\Establishment::where('id', Auth::user()->establishment_id)->first()
?>
@section('main-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Promotion</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_promotion"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <input hidden name="creator_id" value="{{Auth::user()->id}}">
                            <div class="col-md-6 form-group">
                                <label for="name">Promotion Title</label>
                                <input id="title" name="title" class="form-control" type="text" required
                                       placeholder="Promotion Title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Establishment</label>
                                @if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('super_admin'))
                                    <select required id="establishment_id" name="establishment_id" class="form-control">
                                        @foreach($establishments as $establishment)
                                            <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    {{--<label for="est_id">Establishment</label>--}}
                                    <input name="establishment_id" value="{{$establishment->id}}" hidden>
                                    <input required id="est_id" name="" disabled="disabled" class="form-control"
                                           type="text"
                                           value="{{$establishment->name}}">
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Start DateTime</label>
                                <div class='input-group'>
                                    <input required id="datetimepicker1" name="start_date" type='text'
                                           class="form-control"
                                           value=""/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="end_date">End DateTime</label>
                                <div class='input-group' id=''>
                                    <input required id="datetimepicker2" name="end_date" type='text'
                                           class="form-control"
                                           value=""/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="price">Beer</label>
                                <select required id="beer_id" name="beer_id" class="form-control">

                                    @foreach($beers as $beer)
                                        <option value="{{$beer->id}}">{{$beer->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">Price</label>
                                <input required id="price" name="price" class="form-control" type="number" step="0.01"
                                       placeholder="Price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select required id="status" name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
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
