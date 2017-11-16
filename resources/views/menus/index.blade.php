@extends('adminlte::home')

@section('partials')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="" class="btn btn-success"><i class="fa fa-plus-square"></i> Add</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="menus" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Establishment</th>
                        <th>Beer</th>
                        <th>Status</th>
                        <th>Normal Price</th>
                        <th>Created At</th>
                        {{--<th>Action</th>--}}
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
                oTable = $('#menus').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('menus.get_menus_list')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'establishment_id', name: 'establishment_id'},
                        {data: 'beer_id', name: 'beer_id'},
                        {data: 'status', name: 'status'},
                        {data: 'normal_price', name: 'normal_price'},
                        {data: 'created_at', name: 'created_at'},
//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

