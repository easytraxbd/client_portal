@extends('layouts.metronic')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                <h3 class="kt-portlet__head-title">
                    Tickets
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                    &nbsp;
                    <a href="/ticket/create" class="btn btn-info btn-icon-sm">
                        <i class="flaticon2-plus"></i> Create New Ticket
                    </a>
                </div>
            </div>
        </div>
        <br>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded" id="local_data"
                 style="">
                <div class="col-md-12">
                    <table id="ticket-table" class="table table-bordered dataTable table-responsive-sm"
                           role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Subtype</th>
                            <th>Date</th>
                            <th>Call Type</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            <!--end: Datatable -->
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        <!-- DataTables -->
            <link rel="stylesheet" type="text/css"
                  href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"
                    defer></script>
            <script>
                $(document).ready(function () {

                    $('#ticket-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/ticket/data',
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'title', name: 'title'},
                            {data: 'type', name: 'type'},
                            {data: 'sub_type', name: 'sub_type'},
                            {data: 'date', name: 'date'},
                            {data: 'call_type', name: 'call_type'},
                            {data: 'status', name: 'status'},
                            {data: 'priority', name: 'priority'},
                            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'action', name: 'action'},
                        ]
                    });

                });
            </script>
@endsection
