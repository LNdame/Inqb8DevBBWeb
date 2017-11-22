@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('create_beer')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Beer</a>
            </div>
        </div>
        <div class="row" style="margin-top:2em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="beer-table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Vendor</th>
                        <th>Percentage</th>
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
        jQuery(document).ready(function ($) {
            $(function () {
                oTable = $('#beer-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('beers.get_beers_list')}}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'vendor', name: 'vendor'},
                        {data: 'percentage', name: 'percentage'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        });

    </script>

@endpush

