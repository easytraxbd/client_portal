@extends('layouts.metronic')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                <h3 class="kt-portlet__head-title">
                    Offers
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
{{--                    &nbsp;--}}
{{--                    <a href="/" class="btn btn-info btn-icon-sm">--}}
{{--                        <i class="flaticon2-plus"></i> Add New--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
        <br>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded" id="local_data"
                 style="">
                <div class="col-md-12">
                    <table id="invoice-table" class="table table-bordered dataTable table-responsive-sm"
                           role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th>Coupon Code</th>
                            <th>Discount</th>
                            <th>Validity</th>
                            <th>Active?</th>
                            <th>Used?</th>
{{--                            <th>Action</th>--}}
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

                    $('#invoice-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/offer/data',
                        columns: [
                            // {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'coupon_code', name: 'coupon_code'},
                            {data: 'discount', name: 'discount'},
                            {data: 'validity', name: 'validity'},
                            {data: 'active', name: 'active'},
                            {data: 'is_used', name: 'is_used'},
                            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            // {data: 'action', name: 'action'},
                        ]
                    });

                });
            </script>
@endsection
