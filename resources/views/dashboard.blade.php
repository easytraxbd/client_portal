@extends('layouts.metronic')

@section('content')
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
                                        <h4 class="kt-widget24__title">Balance</h4>
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
                                    <span class="kt-widget24__stats kt-font-success">276</span>
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
                                    <th>Auto Renewal</th>
                                    <th>Total Amount</th>
                                    <th>Due</th>
                                    {{--                                    <th>Date</th>--}}
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
                                    <th>Call Type</th>
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
                            FAQ
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

                                <a href="#demo3" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Showing Wrong Location ?
                                        </div>
                                        <div id="demo3" class="collapse">
                                            Ans : No GPS company in the world can ensure 100% accuracy of device location in some conditions. These conditions are if vehicle is parked in a garage, underground parking or there are lots of high raised buildings in an area where GPS Signal fluctuates. Device location might not show the exact position. But if while the vehicle is running and location is not showing perfectly you can contact out hotline for a solution                                        </div>
                                    </div>
                                </a>
                                <a href="#demo4" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Offline ?
                                        </div>
                                        <div id="demo4" class="collapse">
                                            Ans : As our service is dependent on the mobile operators sometimes you might find device offline for sometime which is totally out of our control. But if the device is offline for over 6-12 hour then you should contact our support only. There are lots of pockets and due to GPRS network capacity device might show offine. 10-60 mins offline is not an issue from our end, requesting not to panic and wait for some time to recover.
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo5" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Shows moving but Parked ?
                                        </div>
                                        <div id="demo5" class="collapse">
                                            Ans : This is also a limitation of GPS Tracking solution. In some cases when vehicle is parked and GPS signal is weak vehicle might show moving even while parked as GPS signal fluctuates like GSM network. In this case you have to check ignition status to verify vehicle status                                        </div>
                                    </div>
                                </a>
                                <a href="#demo6" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Mileage incorrect ?                                        </div>
                                        <div id="demo6" class="collapse">
                                            Ans : We cannot ensure 100% accurate mileage reports as lots of factors are related to mileage. Mileage reports might vary upto (+-)5-15% in some cases. This is also a technical limitation for this industry.                                        </div>
                                    </div>
                                </a>
                                <a href="#demo7" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Not getting Push Alerts on Mobile App ?                                        </div>
                                        <div id="demo7" class="collapse">
                                            Ans : Real time push alerts is a paid service and in some cases we cannot ensure real time push alerts due to server capacity or congestion and other factors which might lead to delay push alerts or in some cases no push alerts. We will always try to ensure this service but can’t guarantee always.
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo8" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Missing Event alerts on App ?
                                        </div>
                                        <div id="demo8" class="collapse">
                                            Ans : In some cases some alert events might be missed due to server capacity and congestion in our server. Most of them might be with ignition on off alerts as its the most triggered alerts in our system.
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo9" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Engine not getting Started ?
                                        </div>
                                        <div id="demo9" class="collapse">
                                            Ans : In some cases we get complaints that vehicle is not starting and blame GPS device for this. But actually there are some other vehicle related issues where your vehicle might not start. Please check the below to confirm the issue :
                                            <ul>
                                                <li>Fuse box and check whether any fuse has been disabled</li>
                                                <li>Check battery status, your battery might be drained</li>
                                                <li>Check electric wires connected with ignition or fuel pump</li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo10" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Showing Expired in App?
                                        </div>
                                        <div id="demo10" class="collapse">
                                            Ans : You need to pay your monthly bills to renew your device. Please call our hotline to check outstanding due or Pay directly through our Direct Digital Payment Link : https://crm.easytrax.com.bd/payment (Bkash, Debit/Credit/Visa/Master/Amex Cards)
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo11" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Seeing Straight Lines in Playback History ?
                                        </div>
                                        <div id="demo11" class="collapse">
                                            Ans : You might see straight lines in playback reports when 1st vehicles starts in the morning. GPS signal takes up to 3-5 minutes in some cases to activate after vehicle starts moving. So you might see straight lines after long parking. But if this shows in all trips then please contact directly with our support engineer at 09606667788
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo12" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Vehicle Showing Expired on App?
                                        </div>
                                        <div id="demo12" class="collapse">
                                            Ans : You need to pay your monthly bills to renew your device. Please call our hotline to check outstanding due or Pay directly through our Direct Digital Payment Link : https://crm.easytrax.com.bd/payment (Bkash, Debit/Credit/Visa/Master/Amex Cards)
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Do I need to bring my vehicle for installation ?
                                        </div>
                                        <div id="demo" class="collapse">
                                            Ans : Absolutely not ! Our experienced installation team will visit you at your preferred location on your preferred time to install the device on your vehicle. We want our customer to start the journey with us at their convenience.
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo1" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            How much time does it take for installation ?
                                        </div>
                                        <div id="demo1" class="collapse">
                                            Ans : Generally it takes 20-30 minutes for installing one device on your vehicle. Based on different model time may vary.
                                        </div>
                                    </div>
                                </a>
                                <a href="#demo2" class="kt-notification__item" data-toggle="collapse">
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title">
                                            Will my Vehicle give any trouble after installing ?
                                        </div>
                                        <div id="demo2" class="collapse">
                                            Ans : Our experienced team will check the vehicle before starting to install the VTS and once finished they will again. If you want you can also check before they leave.
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <img src="/images/easytrax/offer.png" alt="" width="100%">
        </div>
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <img src="/images/easytrax/SSL Commerz Pay With logo All Size-01.png" alt="" width="100%">
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
                    {data: 'is_recurring', name: 'is_recurring'},
                    {data: 'invoice_total', name: 'invoice_total'},
                    {data: 'invoice_total_due', name: 'invoice_total_due'},
                    // {data: 'date', name: 'date'},
                    {data: 'payment_status', name: 'payment_status'},
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
                    {data: 'call_type', name: 'call_type'},
                    {data: 'status', name: 'status'},
                    // {data: 'priority', name: 'priority'},
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'action', name: 'action'},
                ]
            });

        });
    </script>
@endsection
