@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="users_table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Liqour License</th>
                        <th>HS License</th>
                        <th>Last Inspection Date</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th>Status</th>
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
                oTable = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('establishments.get_establishments')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'address', name: 'address'},
                        {data: 'liqour_license', name: 'liqour_license'},
                        {data: 'hs_license', name: 'hs_license'},
                        {data: 'last_inspection_date', name: 'last_inspection_date'},
                        {data: 'contact_person', name: 'contact_person'},
                        {data: 'contact_number', name: 'contact_number'},
                        {data: 'status', name: 'status'},
//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

