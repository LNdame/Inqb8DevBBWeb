@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                 <a href="{{url('create_establishment')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Establishment</a>
            </div>
        </div>
        <div class="row" style="margin-top:2em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="establishments-table" style="width:100%;">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Address</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Main Pic Url</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('datatable-scripts')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $.noConflict();
        jQuery( document ).ready(function( $ ) {
            $(function () {
                oTable = $('#establishments-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('establishments.get_establishments')}}",
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'longitude', name: 'longitude'},
                        {data: 'latitude', name: 'latitude'},
                        {data: 'main_picture_url', name: 'main_picture_url'},
                        {data: 'contact_person', name: 'contact_person'},
                        {data: 'contact_number', name: 'contact_number'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

