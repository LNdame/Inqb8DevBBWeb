@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container" >
        <div class="row">
            <div class="col-md-11">
                <table class="table table-bordered" id="users_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Name</th>
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
                oTable = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('get_users')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'username', name: 'username'},
                        {data: 'created_at', name: 'created_at'},
//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

