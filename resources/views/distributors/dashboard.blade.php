@extends('layouts.metronic')

@section('content')
    <style>
        .accordion.accordion-toggle-plus .card .card-header .card-title.collapsed {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .accordion.accordion-toggle-plus .card .card-header .card-title {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .checked {
            color: orange;
        }
    </style>
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">--}}
{{--            <div class="kt-portlet">--}}
{{--                <div class="kt-portlet__body  kt-portlet__body--fit">--}}
{{--                    <div class="row row-no-padding row-col-separator-lg">--}}
{{--                        <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                            <!--begin::Total Profit-->--}}
{{--                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">--}}
{{--                                <i class="fa fa-calendar"></i>&nbsp;--}}
{{--                                <span></span> <i class="fa fa-caret-down"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" class="rounded">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <div class="kt-portlet">
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-lg">
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="#">Total Clients</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ {{$balance}}</h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="#">Total Invoice</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ {{$balance}}</h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="#">Invoice Paid</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ {{$balance}}</h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="#">Invoice Due</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ {{$balance}}</h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin:: payment-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Payments
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
{{--                            @if(isset($totalDue) && $totalDue > 0)--}}
                            <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" class="btn btn-info btn-icon-sm">
                                <i class="flaticon2-plus"></i> Pay Now
                            </a>
{{--                                @endif--}}
                        </div>
                    </div>
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12">
                            <table id="payment-table" class="table table-bordered dataTable table-responsive-sm"
                                   role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Payment Date</th>
                                    <th>Paid Amount</th>
                                    {{--                                    <th>Invoice</th>--}}
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    {{--                                    <th>Payment Collector</th>--}}
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
            <!--end:: payment-->
        </div>
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin:: invoice-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
{{--			<span class="kt-portlet__head-icon">--}}
{{--				<i class="kt-font-brand flaticon2-line-chart"></i>--}}
{{--			</span>--}}
                        <h3 class="kt-portlet__head-title">
                            Invoices
                        </h3>
                    </div>
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12">
                            <table id="invoice-table" class="table table-bordered dataTable table-responsive-sm"
                                   role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>Invoice Number</th>
{{--                                    <th>Auto Renewal</th>--}}
                                    <th>Total Amount</th>
                                    <th>Due Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
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
            <!--end:: invoice-->
        </div>
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
{{--			<span class="kt-portlet__head-icon">--}}
{{--				<i class="kt-font-brand flaticon2-line-chart"></i>--}}
{{--			</span>--}}
                        <h3 class="kt-portlet__head-title">
                            Service Requests
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="/ticket/create" class="btn btn-info btn-icon-sm">
                                <i class="flaticon2-plus"></i> New Service Request
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12">
                            <table id="ticket-table" class="table table-bordered dataTable table-responsive-sm"
                                   role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    {{--                                    <th>Subtype</th>--}}
                                    {{--                                    <th>Date</th>--}}
{{--                                    <th>Call Type</th>--}}
                                    <th>Status</th>
                                    {{--                                    <th>Priority</th>--}}
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
        </div>
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" target="_blank">
                <img src="/images/easytrax/SSL Commerz Pay With logo All Size-01.png" alt="" width="100%">
            </a>
        </div>

        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1 text-center">
            <br>
            <br>
            <a href="https://g.page/easytrax/review?mt" target="_blank">
                <div class="container" style="height: 180px; width: 100%;">
                    <h4>Please rate your experience</h4>
                    <br>
                    <span class="fa fa-star checked h1"></span>
                    <span class="fa fa-star checked h1"></span>
                    <span class="fa fa-star checked h1"></span>
                    <span class="fa fa-star checked h1"></span>
                    <span class="fa fa-star checked h1"></span>
                </div>
            </a>
{{--            <div class="row">--}}
{{--                <div class="col-md-3">--}}
{{--                    <a href="https://tawk.to/chat/58307fdbfccdfa3ec838b0e2/default" target="_blank">--}}
{{--                        <img src="/images/easytrax/Group 49.png" alt="" width="100%">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <a href="https://t.me/joinchat/AYNtSg82zgf9r_LoXhpR1g" target="_blank">--}}
{{--                        <img src="/images/easytrax/Group 50.png" alt="" width="100%">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <a href="https://wa.me/8801709888903?text=Hello,%20I%20am%20interested%20in%20your%20products,%20please%20share%20features%20and%20pricing" target="_blank">--}}
{{--                        <img src="/images/easytrax/Group 51.png" alt="" width="100%">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    <a href="tel:09606667788" target="_blank">--}}
{{--                        <img src="/images/easytrax/Group 52.png" alt="" width="100%">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <br>
        </div>
    </div>
@endsection
@section('script')
    {{--    <script src="{{ asset('js/dashboard.js') }}"></script>--}}
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"
            defer></script>
    <script>
          $(document).ready(function () {

            $('#payment-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 0, "desc" ]],
                pageLength: 5,
                ajax: '/payment/data',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'payment_date', name: 'payment_date'},
                    {data: 'amount_final', name: 'amount_final'},
                    // {data: 'invoice', name: 'invoice'},
                    {data: 'payment_method', name: 'payment_method'},
                    {data: 'status', name: 'status'},
                    // {data: 'payment_collector', name: 'payment_collector'},
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'action', name: 'action'},
                ]
            });

            // $('#draft-payment-table').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: '/payment-draft/data',
            //     columns: [
            //         {data: 'id', name: 'id'},
            //         {data: 'payment_date', name: 'payment_date'},
            //         {data: 'amount', name: 'amount'},
            //         // {data: 'invoice', name: 'invoice'},
            //         {data: 'payment_method', name: 'payment_method'},
            //         // {data: 'payment_collector', name: 'payment_collector'},
            //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            //         {data: 'action', name: 'action'},
            //     ]
            // });

            $('#invoice-table').DataTable({
                processing: true,
                serverSide: true,
                // order: [[ 3, "desc" ]],
                pageLength: 5,
                ajax: '/invoice/data',
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'invoice_no', name: 'invoice_no'},
                    // {data: 'is_recurring', name: 'is_recurring'},
                    {data: 'invoice_total', name: 'invoice_total'},
                    {data: 'invoice_total_due', name: 'invoice_total_due'},
                    {data: 'payment_due_date', name: 'payment_due_date'},

                    // {data: 'date', name: 'date'},
                    {data: 'status', name: 'status'},
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'action', name: 'action'},
                ]
            });

            $('#ticket-table').DataTable({
                processing: true,
                serverSide: true,
                // order: [[ 3, "desc" ]],
                pageLength: 5,
                ajax: '/ticket/data',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    // {data: 'sub_type', name: 'sub_type'},
                    // {data: 'date', name: 'date'},
                    // {data: 'call_type', name: 'call_type'},
                    {data: 'status', name: 'status'},
                    // {data: 'priority', name: 'priority'},
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'action', name: 'action'},
                ]
            });

        });
    </script>
        <script type="text/javascript">
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
        </script>
@endsection
