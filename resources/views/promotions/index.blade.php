@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid"  >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Promotion</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="promotions-table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Beer</th>
                        <th>Establishment</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Price</th>
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
                oTable = $('#promotions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('promotions.get_promotions')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'beer_id', name: 'beer_id'},
                        {data: 'establishment_id', name: 'establishment_id'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'end_date', name: 'end_date'},
                        {data: 'status', name: 'status'},
                        {data: 'price', name: 'price'},
//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

