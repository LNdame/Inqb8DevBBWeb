@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Beer Lover</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="beer-lovers-table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Birth Date</th>
                        <th>Status</th>
                        <th>Terms & Conditions</th>
                        <th>Created At</th>
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
                oTable = $('#beer-lovers-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('users.get_beer_lovers')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'date_of_birth', name: 'date_of_birth'},
                        {data: 'status', name: 'status'},
                        {data: 'terms_conditions_accept', name: 'terms_conditions_accept'},
                        {data: 'created_at', name: 'created_at'},
//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

