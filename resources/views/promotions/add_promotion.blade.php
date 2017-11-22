@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Promotion</h3>
                </div>
                <form role="form" id="add-establishment" enctype="multipart/form-data" action="/save_promotion"
                      method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="name">Promotion Title</label>
                                <input id="title" name="title" class="form-control" type="text"
                                       placeholder="Promotion Title">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Establishment</label>
                                <select id="establishment_id" name="establishment_id" class="form-control">
                                    <option> Select Establishment</option>
                                    @foreach($establishments as $establishment)
                                        <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="latitude">End date</label>
                                <input id="end_date" name="end_date" type="date" class="form-control"
                                       placeholder="End date">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Start Date</label>
                                <input id="start_date" name="start_date" type="date" class="form-control"
                                       placeholder="Start Date">
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label for="price">Beer</label>
                                <select id="beer_id" name="beer_id" class="form-control">
                                    <option> ***Select Beer***</option>
                                    @foreach($beers as $beer)
                                        <option value="{{$beer->id}}">{{$beer->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">Price</label>
                                <input id="price" name="price" class="form-control" type="text"
                                       placeholder="Price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="longtitude	">Status</label>
                                <input id="Status" name="longitude" type="Status" class="form-control" type="text"
                                       placeholder="Promotion Status">
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
