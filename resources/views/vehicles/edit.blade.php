@extends('layouts.metronic')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Vehicle Details
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/vehicle" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
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
                    <table class="table table-bordered">
                        <thead>
{{--                        <tr>--}}
{{--                            <th>heading1</th>--}}
{{--                            <th>heading2</th>--}}
{{--                        </tr>--}}
                        </thead>
                        <tbody>
                        <tr>
                            <td>Registration Number</td>
                            <td>{{$vehicle->car_reg_number}}</td>
                        </tr>
                        <tr>
                            <td>Vehicle Model</td>
                            <td>{{$vehicle->car_model}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Manufacturing Year</td>--}}
{{--                            <td>{{$vehicle->}}</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td>Frame Number</td>
                            <td>{{$vehicle->car_frame_number}}</td>
                        </tr>
                        <tr>
                            <td>Engine No</td>
                            <td>{{$vehicle->car_engine_number}}</td>
                        </tr>
                        <tr>
                            <td>Vehicle Type</td>
                            @if(isset($vehicle->vehicle_type))
                            <td>{{ucfirst($vehicle->vehicle_type)}}</td>
                                @endif
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Vehicle Seat Capacity</td>--}}
{{--                            <td>{{$vehicle->}}</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td>Registration Date</td>
                            <td>{{$vehicle->car_reg_date}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Device Warranty Expiry Date</td>--}}
{{--                            <td>{{$vehicle->}}</td>--}}
{{--                        </tr>--}}
                        <tr>
                            <td>Insurance Company</td>
                            <td>{{$vehicle->insurance_company}}</td>
                        </tr>
                        <tr>
                            <td>Insurance Issue Date</td>
                            <td>{{$vehicle->insurance_issue_date}}</td>
                        </tr>
                        <tr>
                            <td>Insurance Expiry Date</td>
                            <td>{{$vehicle->insurance_expiry_date}}</td>
                        </tr>
                        <tr>
                            <td>Tax Token Number</td>
                            <td>{{$vehicle->tax_token_number}}</td>
                        </tr>
                        <tr>
                            <td>Tax Token Issue Date</td>
                            <td>{{$vehicle->tax_token_issue_date}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Route Permit Expiry Date</td>--}}
{{--                            <td>{{$vehicle->}}</td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
    @endsection
    @section('script')
@endsection
