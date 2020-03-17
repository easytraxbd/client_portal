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
    </style>
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
                                        <h4 class="kt-widget24__title">Advance Payment</h4>
{{--                                        <span class="kt-widget24__desc">All Customs Value</span>--}}
                                    </div>
                                    <span class="kt-widget24__stats kt-font-brand">৳{{$balance}}</span>
                                </div>
                                <div class="progress progress--sm">
                                    <div class="progress-bar kt-bg-brand" role="progressbar" @if($balance > 0) style="width: 100%;" @endif
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
{{--                                <div class="kt-widget24__action">--}}
{{--														<span class="kt-widget24__change">--}}
{{--															Change--}}
{{--														</span>--}}
{{--                                    <span class="kt-widget24__number">--}}
{{--															78%--}}
{{--														</span>--}}
{{--                                </div>--}}
                            </div>

                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Feedbacks-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Total Paid
                                        </h4>
{{--                                        <span class="kt-widget24__desc">--}}
{{--																Customer Review--}}
{{--															</span>--}}
                                    </div>
                                    <span class="kt-widget24__stats kt-font-warning">৳{{$totalPaidAmount}}</span>
                                </div>
                                <div class="progress progress--sm">
                                    <div class="progress-bar kt-bg-warning" role="progressbar" style="width: {{$totalPaidPercentage}}%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>

                            <!--end::New Feedbacks-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Orders-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Total due
                                        </h4>
{{--                                        <span class="kt-widget24__desc">--}}
{{--																Fresh Order Amount--}}
{{--															</span>--}}
                                    </div>
                                    <span class="kt-widget24__stats kt-font-danger">৳{{$totalDue}}</span>
                                </div>
                                <div class="progress progress--sm">
                                    <div class="progress-bar kt-bg-warning" role="progressbar" style="width: {{$totalDuePercentage}}%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!--end::New Orders-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">

                            <!--begin::New Users-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <h4 class="kt-widget24__title">
                                            Reward point
                                        </h4>
{{--                                        <span class="kt-widget24__desc">Joined New User</span>--}}
                                    </div>
                                    <span class="kt-widget24__stats kt-font-success">0</span>
                                </div>
                            </div>

                            <!--end::New Users-->
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
{{--			<span class="kt-portlet__head-icon">--}}
{{--				<i class="kt-font-brand flaticon2-line-chart"></i>--}}
{{--			</span>--}}
                        <h3 class="kt-portlet__head-title">
                            Payments
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            @if(isset($totalDue) && $totalDue > 0)
                            <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" class="btn btn-info btn-icon-sm">
                                <i class="flaticon2-plus"></i> Pay Now
                            </a>
                                @endif
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
                                    <th>Amount</th>
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
                            Tickets
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <a href="/ticket/create" class="btn btn-info btn-icon-sm">
                                <i class="flaticon2-plus"></i> Create New Ticket
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
                            Most asked Question
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
                            <div class="kt-notification kt-notification--fit">
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample1">
                                    @foreach($faqArray as $faq)
                                        <div class="card">
                                            <div class="card-header" id="headingOne{{$faq['question_number']}}">
                                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne{{$faq['question_number']}}" aria-expanded="false" aria-controls="collapseOne1">
                                                    {{$faq['question']}}
                                                </div>
                                            </div>
                                            <div id="collapseOne{{$faq['question_number']}}" class="collapse" aria-labelledby="headingOne{{$faq['question_number']}}" data-parent="#accordionExample1" style="">
                                                <div class="card-body">
                                                    Ans : {!! $faq['ans'] !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <a href="https://www.easytrax.com.bd/payment-discounts" target="_blank">
            <img src="/images/easytrax/offer.png" alt="" width="100%">
            </a>
        </div>
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <a href="https://www.easytrax.com.bd/payment-discounts" target="_blank">
            <img src="/images/easytrax/SSL Commerz Pay With logo All Size-01.png" alt="" width="100%">
            </a>
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
                order: [[ 2, "desc" ]],
                pageLength: 5,
                ajax: '/payment/data',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'payment_date', name: 'payment_date'},
                    {data: 'amount', name: 'amount'},
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
@endsection
