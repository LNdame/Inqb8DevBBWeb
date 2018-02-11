@extends('adminlte::layouts.establishments')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Promotion Details</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_promotion"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Promotion Title</label>
                                <input id="title" name="title" class="form-control" type="text"
                                       placeholder="Promotion Title" value="{{$promotion->title}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Establishment</label>
                                <select id="establishment_id" name="establishment_id" class="form-control">
                                    <option> Select Establishment</option>
                                    <option value="{{$establishment->id}}" {{$promotion->establishment_id == $establishment->id?'selected':''}}>{{$establishment->name}}</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Start DateTime</label>
                                <div class='input-group'>
                                    <input id="datetimepicker1" name="start_date" type='text' class="form-control"
                                           value="{{$promotion->start_date}}"/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="end_date">End DateTime</label>
                                <div class='input-group' id=''>
                                    <input id="datetimepicker2" name="end_date" type='text' class="form-control"
                                           value="{{$promotion->end_date}}"/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="price">Beer</label>
                                <select id="beer_id" name="beer_id" class="form-control">
                                    <option> ***Select Beer***</option>
                                    <option> ***Select Beer***</option>
                                    @foreach($beers as $beer)
                                        <option value="{{$beer->id}}" {{$promotion->beer_id == $beer->id ? 'selected':'' }} >{{$beer->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">Price</label>
                                <input id="price" name="price" class="form-control" type="text"
                                       value="{{$promotion->price}}"
                                       placeholder="Price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    @if($promotion->status == 'active')
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">InActive</option>
                                    @else
                                        <option value="active">Active</option>
                                        <option value="inactive" selected>InActive</option>
                                    @endif
                                </select>
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
