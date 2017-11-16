@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid" style="margin-top:1em;" >
            <div class="row" style="margin-top:1em;">
                <div class="col-sm-2">
                    <a href="" class="btn btn-success"><i class="fa fa-plus-square"></i> Add</a>
                </div>
            </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="establishment-accounts" style="width:100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Establishment</th>
                        <th>Date Opened</th>
                        <th>Status</th>
                        <th>Balance</th>
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
                oTable = $('#establishment-accounts').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('establishments.get_establishments_accounts')}}",
                    columns: [
                        {data: 'id', 'name': 'id'},
                        {data: 'establishment_id', name: 'establishment_id'},
                        {data: 'date_opened', name: 'date_opened'},
                        {data: 'status', name: 'status'},
                        {data: 'balance', name: 'balance'},
                        {data: 'created_at', name: 'created_at'},

//                        {data:'action',name:'action',orderable:false,searchable:false}
                    ]
                });
            });
        });

    </script>

@endpush

