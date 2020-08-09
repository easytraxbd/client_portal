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
{{--                            <div id="date-range" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">--}}
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
                                        <a href="/distributor/clients">Total Clients</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left"> {{$numberOfClients}}</h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="/distributor/clients-invoice">Total Invoice</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ <span id="invoice-total" class="invoice-total">0</span></h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="/distributor/clients-invoice">Invoice Paid</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ <span id="invoice-paid" class="invoice-paid">0</span></h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <!--begin::Total Profit-->
                            <div class="kt-widget24">
                                <div class="kt-widget24__details">
                                    <div class="kt-widget24__info">
                                        <a href="/distributor/clients-invoice">Invoice Due</a>
                                    </div>
                                </div>
                                <br>
                                <h3 class="pull-left">৳ <span id="invoice-due" class="invoice-due">0</span></h3>
                                <p class="pull-right rounded" style="background-color: #e2e4e7;padding: 5px;">0%</p>
                            </div>
                            <!--end::Total Profit-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <!--begin:: payment-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Clients Chart
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <button id="client_bar_chart" class="btn btn-outline-info btn-icon-sm">Bar</button>&nbsp;
                            <button id="client_horizontalBar_chart" class="btn btn-outline-info btn-icon-sm">horizontal Bar</button>&nbsp;
                            <button id="client_line_chart" class="btn btn-outline-info btn-icon-sm">Line</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12 clients-chart" >
{{--                            <canvas id="clients-chart"></canvas>--}}
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <!--end:: payment-->
        </div>

        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <!--begin:: payment-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Revenue Chart
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <button id="revenue_bar_chart" class="btn btn-outline-info btn-icon-sm">Bar</button>&nbsp;
                            <button id="revenue_horizontalBar_chart" class="btn btn-outline-info btn-icon-sm">horizontal Bar</button>&nbsp;
                            <button id="revenue_line_chart" class="btn btn-outline-info btn-icon-sm">Line</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
                         id="local_data"
                         style="">
                        <div class="col-md-12 revenue-chart" >
{{--                            <canvas id="revenue-chart"></canvas>--}}
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <!--end:: payment-->
        </div>


        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <!--begin:: payment-->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Clients
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
{{--                            @if(isset($totalDue) && $totalDue > 0)--}}
{{--                            <a href="https://crm.easytrax.com.bd/payment?clientId={{\Auth::user()->id}}" class="btn btn-info btn-icon-sm">--}}
{{--                                <i class="flaticon2-plus"></i> Pay Now--}}
{{--                            </a>--}}
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
                            <table id="client-table" class="table table-bordered dataTable table-responsive-sm"
                                   role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>Client ID</th>
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Alternative Phone</th>
                                    <th>Address</th>
                                    <th>Payment status</th>
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
              $('#client-table').DataTable({
                  "pageLength": 10,
                  processing: true,
                  serverSide: true,
                  order: [[ 0, "desc" ]],
                  ajax: '/distributor/clients-data',
                  columns: [
                      {data: 'id', name: 'id'},
                      {data: 'name', name: 'name'},
                      {data: 'work_phone', name: 'work_phone'},
                      {data: 'alt_phone', name: 'alt_phone'},
                      {data: 'home_address', name: 'home_address'},
                      {data: 'payment_status', name: 'payment_status'},
                  ]
              });

        });
    </script>
        <script type="text/javascript">
            $(function() {

                var start = moment().startOf('month');
                var end = moment().endOf('month');

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
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

                var start_date = start.format("YYYY-MM-DD");
                var end_date = end.format("YYYY-MM-DD");
                var filter = {
                    start_date: start_date,
                    end_date: end_date,
                };

                getClientsInvoiceTotalAmount(filter);
                getClientsInvoicePaidAmount(filter);
                getClientsInvoiceDueAmount(filter);
                getClientsChart();
                getRevenueChart();

            });

            //After applying in Date Range picker
            $('#date-range').on('apply.daterangepicker', function (ev, picker) {
                if (picker.startDate.format('YYYY-MM-DD') <= '2016-01-28' && picker.endDate.format('YYYY-MM-DD') >= '2040-12-01') {
                    $('#date-range').val('All Time');
                } else {
                    $('#date-range').val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
                }

                filter = {
                    // start_date: picker.startDate,
                    start_date: $('#hidden-start-date').val(),
                    // end_date: picker.endDate,
                    end_date: $('#hidden-end-date').val(),
                };
                // test();
                getClientsInvoiceTotalAmount(filter);
                getClientsInvoicePaidAmount(filter);
                getClientsInvoiceDueAmount(filter);
            });

            function getClientsInvoiceTotalAmount(filter) {
                $('.invoice-total').html('<div  class="tc"><img src="/images/easytrax/loading.png"/></div>');
                $.ajax({
                    url: 'distributor/clients-invoice-total-amount',
                    type: "GET",
                    data: {
                        start_date: filter.start_date,
                        end_date: filter.end_date,
                    },
                    //Receive Data
                    success: function (data) {
                        $('#invoice-total').html(data);
                    }
                })
            }
            function getClientsInvoicePaidAmount(filter) {
                $('.invoice-paid').html('<div  class="tc"><img src="/images/easytrax/loading.png"/></div>');
                $.ajax({
                    url: 'distributor/clients-invoice-paid-amount',
                    type: "GET",
                    data: {
                        start_date: filter.start_date,
                        end_date: filter.end_date,
                    },
                    //Receive Data
                    success: function (data) {
                        $('#invoice-paid').html(data);
                    }
                })
            }
            function getClientsInvoiceDueAmount(filter) {
                $('.invoice-due').html('<div  class="tc"><img src="/images/easytrax/loading.png"/></div>');
                $.ajax({
                    url: 'distributor/clients-invoice-due-amount',
                    type: "GET",
                    data: {
                        start_date: filter.start_date,
                        end_date: filter.end_date,
                    },
                    //Receive Data
                    success: function (data) {
                        $('#invoice-due').html(data);
                    }
                })
            }
            function getClientsChart(chartType = 'bar') {
                $('.clients-chart').html('<div  class="tc"><img src="/images/easytrax/loading.png"/></div>');
                $.ajax({
                    url: 'distributor/lol',
                    type: "GET",
                    success: function (data) {
                        $('.clients-chart').html(' <canvas id="clients-chart"></canvas>');
                        chart('clients-chart',chartType,data.labels,data.dataset_label,data.dataset_data);
                    }
                })
            }

            function getRevenueChart(chartType = 'bar') {
                $('.revenue-chart').html('<div  class="tc"><img src="/images/easytrax/loading.png"/></div>');
                $.ajax({
                    url: 'distributor/lol2',
                    type: "GET",
                    success: function (data) {
                        $('.revenue-chart').html(' <canvas id="revenue-chart"></canvas>');
                        chart('revenue-chart',chartType,data.labels,data.dataset_label,data.dataset_data);
                    }
                })
            }

            function test() {
                alert('lol');
            }

            $('#client_bar_chart').click(function(){
                getClientsChart('bar');
            });
            $('#client_horizontalBar_chart').click(function(){
                getClientsChart('horizontalBar');
            });
            $('#client_line_chart').click(function(){
                getClientsChart('line');
            });

            $('#revenue_bar_chart').click(function(){
                getRevenueChart('bar');
            });
            $('#revenue_horizontalBar_chart').click(function(){
                getRevenueChart('horizontalBar');
            });
            $('#revenue_line_chart').click(function(){
                getRevenueChart('line');
            });

            function chart(id,type,labels,dataset_labels,dataset_data) {
                var ctx = $('#'+id);
                var myChart = new Chart(ctx, {
                    type: type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: dataset_labels,
                            data: dataset_data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        </script>
@endsection
