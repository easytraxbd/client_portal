@extends('layouts.metronic')

@section('content')
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
    <!--Begin:: App Aside-->
        <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
            <!--begin:: Widgets/Applications/User/Profile1-->
            <div class="kt-portlet kt-portlet--height-fluid-">
                <div class="kt-portlet__head  kt-portlet__head--noborder">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit-y">

                    <!--begin::Widget -->
                    <div class="kt-widget kt-widget--user-profile-1">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                @if(isset($client->client_photo) && $client->client_photo != null)
                                    <img alt="S" src="https://crm.easytrax.com.bd/uploads/client/client_photo/{{$client->client_photo}}" height="60px" width="60px">
                                @endif
                                {{--                        <img src="/assets/media/users/100_13.jpg" alt="image">--}}
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                                    <a href="#" class="kt-widget__username">
                                        {{$client->name}}
                                        <i class="flaticon2-correct kt-font-success"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__body">
                            <div class="kt-widget__content">
                                @if(isset($client->email))
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Email:</span>
                                        <a href="mailto:{{$client->email}}" class="kt-widget__data">{{$client->email}}</a>
                                    </div>
                                @endif
                                <div class="kt-widget__info">
                                    <span class="kt-widget__label">Phone:</span>
                                    <a href="tel:+88{{$client->work_phone}}" class="kt-widget__data">{{$client->work_phone}}</a>
                                </div>
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Alternative Phone:</span>
                                        <a href="tel:+88{{$client->alt_phone}}" class="kt-widget__data">{{$client->alt_phone}}</a>
                                    </div>
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__label">Address:</span>
                                        <a class="kt-widget__data">{{$client->home_address}}</a>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!--end::Widget -->
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile1-->
        </div>
    <!--End:: App Aside-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">

                    <!--begin:: Widgets/Order Statistics-->
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Total Info
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget12">
                                <div class="kt-widget12__content">
                                    <div class="kt-widget12__item">
                                        <div class="kt-widget12__info">
                                            <div class="kt-widget12__info">
                                                <span class="kt-widget12__desc">Invoice Count</span>
                                                <span class="kt-widget12__value">{{ $invoices->count() ?? 0}} </span>
                                            </div>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Total Invoice </span>
                                            <span class="kt-widget12__value">৳ {{ $invoices->sum('invoice_total') ?? 0}}</span>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Paid Invoice </span>
                                            <span class="kt-widget12__value">৳ {{ $invoices->sum('invoice_total') - $invoices->sum('invoice_total_due') ?? 0}}</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget12__item">
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Due </span>
                                            <span class="kt-widget12__value">৳ {{ $invoices->sum('invoice_total_due') ?? 0}}</span>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Number of Vehicles</span>
                                            <span class="kt-widget12__value">{{ $vehicles->count() ?? 0}}</span>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Total Payment</span>
                                            <span class="kt-widget12__value">{{$payments->count() ?? 0}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Order Statistics-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <!--begin:: payment-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Payments
                        </h3>
                    </div>
{{--                    <div class="kt-portlet__head-toolbar">--}}
{{--                        <div class="kt-portlet__head-wrapper">--}}
{{--                            <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" class="btn btn-info btn-icon-sm">--}}
{{--                                <i class="flaticon2-plus"></i> Pay Now--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
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
        <div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        {{--			<span class="kt-portlet__head-icon">--}}
                        {{--				<i class="kt-font-brand flaticon2-line-chart"></i>--}}
                        {{--			</span>--}}
                        <h3 class="kt-portlet__head-title">
                            Vehicles
                        </h3>
                    </div>
{{--                    <div class="kt-portlet__head-toolbar">--}}
{{--                        <div class="kt-portlet__head-wrapper">--}}
{{--                            <a href="/ticket/create" class="btn btn-info btn-icon-sm">--}}
{{--                                <i class="flaticon2-plus"></i> New Service Request--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12">
                            <table id="vehicles-table" class="table table-bordered dataTable table-responsive-sm"
                                   role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>Vehicle Type</th>
                                    <th>Model</th>
                                    <th>Reg Number</th>
                                    <th>Reg Date</th>
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
    </div>
    @endsection
    @section('script')
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
                    ajax: '/payment/distributors-data?client_id={{$client->id}}',
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
                    ajax: '/invoice/distributors-data?client_id={{$client->id}}',
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
                    ajax: '/ticket/distributors-data?client_id={{$client->id}}',
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

                $('#vehicles-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/vehicle/distributors-data?client_id={{$client->id}}',
                    columns: [
                        // {data: 'id', name: 'id'},
                        {data: 'vehicle_type', name: 'vehicle_type'},
                        {data: 'car_model', name: 'car_model'},
                        {data: 'car_reg_number', name: 'car_reg_number'},
                        {data: 'car_reg_date', name: 'car_reg_date'},
                        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'action', name: 'action'},
                    ]
                });

            });
        </script>
@endsection
