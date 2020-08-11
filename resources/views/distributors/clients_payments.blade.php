@extends('layouts.metronic')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xl-3 order-lg-1 order-xl-1">
            <div id="date-range" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" class="rounded">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
                <form class="filtering-dates-form">
                    <input type="hidden" class="start-date" id="hidden-start-date" name="hidden-start-date">
                    <input type="hidden" class="end-date" id="hidden-end-date" name="hidden-end-date">
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                <h3 class="kt-portlet__head-title">
                    Payments
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                    &nbsp;
{{--                    <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" class="btn btn-info btn-icon-sm">--}}
{{--                        <i class="flaticon2-plus"></i> Pay Now--}}
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
                    <table id="payment-table" class="table table-bordered dataTable table-responsive-sm"
                           role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th>Payment ID</th>
                            <th>Client Name</th>
                            <th>Payment Date</th>
                            <th>Paid Amount</th>
                            <th>Discount</th>
                            <th>Total Amount</th>
                            <th>Invoice</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Payment Collector</th>
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
                $(function() {

                    // var start = moment().startOf('month');
                    var start = moment('2016-01-01', 'YYYY-MM-DD');
                    // var end = moment().endOf('month');
                    var end = moment('2040-12-31', 'YYYY-MM-DD');

                    function cb(start, end) {
                        $('#date-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                        $('#hidden-start-date').val(start.format('YYYY-MM-DD'));
                        $('#hidden-end-date').val(end.format('YYYY-MM-DD'));
                    }

                    $('#date-range').daterangepicker({
                        startDate: start,
                        endDate: end,
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                            'This Year': [moment().startOf('year'), moment().endOf('year')],
                            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                            'All Time': [moment('2016-01-01', 'YYYY-MM-DD'), moment('2040-12-31', 'YYYY-MM-DD')]
                        }
                    }, cb);

                    cb(start, end);

                    var start_date = start.format("YYYY-MM-DD");
                    var end_date = end.format("YYYY-MM-DD");
                    var filter = {
                        start_date: start_date,
                        end_date: end_date,
                    };

                });
                $(document).ready(function () {

                    var table = $('#payment-table').DataTable({
                        "pageLength": 50,
                        processing: true,
                        serverSide: true,
                        order: [[ 0, "desc" ]],
                        ajax: {
                            url:'/payment/distributors-data',
                            data: function (d) {
                                d.date_from = $('#hidden-start-date').val();
                                d.date_to = $('#hidden-end-date').val();
                                // $(".form-filter").serializeArray().map(function (x) {
                                //     d[x.name] = x.value;
                                // });
                            }
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'client', name: 'client'},
                            {data: 'payment_date', name: 'payment_date'},
                            {data: 'amount_final', name: 'amount_final'},
                            {data: 'discount_amount', name: 'discount_amount'},
                            {data: 'amount', name: 'amount'},
                            {data: 'invoice', name: 'invoice'},
                            {data: 'payment_method', name: 'payment_method'},
                            {data: 'status', name: 'status'},
                            {data: 'payment_collector', name: 'payment_collector'},
                            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'action', name: 'action'},
                        ]
                    });

                    //After applying in Date Range picker
                    $('#date-range').on('apply.daterangepicker', function (ev, picker) {
                        if (picker.startDate.format('YYYY-MM-DD') <= '2016-01-28' && picker.endDate.format('YYYY-MM-DD') >= '2040-12-01') {
                            $('#date-range').val('All Time');
                        } else {
                            $('#date-range').val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
                        }
                        table.draw();
                    });

                });
            </script>
@endsection
