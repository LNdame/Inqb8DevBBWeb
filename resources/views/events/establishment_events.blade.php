@extends('adminlte::layouts.app')

@section('main-content')
    <div class="container-fluid">
        <div class="row" style="margin-top:1em;">
            <div class="col-sm-2">
                <a href="/create_establishment_event" class="btn btn-success"><i class="fa fa-plus-square"></i> Add
                    Event</a>
            </div>
        </div>
        <div class="row" style="margin-top:1em;">
            <div class="col-md-12">
                <table class="table table-bordered" id="events-table" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Address</th>
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
                oTable = $('#events-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('events.get_establishment_events')}}",
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'end_date', name: 'end_date'},
                        {data: 'status', name: 'status'},
                        {data: 'description', name: 'description'},
                        {data: 'address', name: 'address'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
            });
        });

    </script>

@endpush

