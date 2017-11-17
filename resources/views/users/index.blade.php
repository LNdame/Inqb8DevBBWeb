@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" >
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="{{url('create_user')}}" class="btn btn-success"><i class="fa fa-plus-square"></i> Add User</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="users_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Name</th>
                        <th>Created At</th>
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
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'email', name: 'email'},
                        {data: 'username', name: 'username'},
                        {data: 'created_at', name: 'created_at'},
                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

