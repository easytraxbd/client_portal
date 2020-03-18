@extends('layouts.metronic')

@section('content')
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet" type="text/css" >
    <style>
        .kt-invoice__title,
        .kt-invoice__subtitle,
        .kt-invoice__desc,
        .kt-invoice__text{
            color: black !important;
        }
    </style>
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-invoice-1">
                    <div class="kt-invoice__head">
{{--                    <div class="kt-invoice__head" style="background-image: url('/images/easytrax/bg_invoice.png');">--}}
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__brand">
                                <h1 class="kt-invoice__title">INVOICE</h1>
                                <div href="#" class="kt-invoice__logo">
{{--                                    <a href="#"><img src="/images/easytrax/logos/easytrax_logo_white.png" width="165px"></a>--}}
                                    <a href="#"><img src="/images/easytrax/logos/easytrax_logo_color_full.png" width="165px"></a>
                                    <span class="kt-invoice__desc">
																<span>House #385 (2nd Floor), Road #06, Mirpur DOHS</span>
																<span>Dhaka-1216, Bangladesh</span>
															</span>
                                </div>
                            </div>
                            <div class="kt-invoice__items">
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INFO</span>
                                    <span class="kt-invoice__text">Invoice Date: {{\Carbon\Carbon::parse($invoice->date)->format("F j, Y")}}</span>
                                    <span class="kt-invoice__text">Service Start Date: {{\Carbon\Carbon::parse($invoice->service_start_date)->format("F j, Y")}}</span>
                                    @if(isset($invoice->number_of_month))
                                        <span class="kt-invoice__text">Duration: {{$invoice->number_of_month}} month(s)</span>
                                        @endif
                                    @if(isset($invoice->end_date))
                                        <span class="kt-invoice__text">End Date:: {{$invoice->end_date}}</span>
                                        @endif
                                    <span class="kt-invoice__text">Payment Due Date: {{\Carbon\Carbon::parse($invoice->payment_due_date)->format("F j, Y")}}</span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE NO.</span>
                                    <span class="kt-invoice__text">{{$invoice->invoice_no}}</span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE TO.</span>
                                    <span class="kt-invoice__text">{{$invoice->client->name}}</span>
                                    <span class="kt-invoice__text">{{$invoice->client->work_phone}}</span>
                                    <span class="kt-invoice__text">{{$invoice->client->email}}</span>
                                    <span class="kt-invoice__text">{{$invoice->client->home_address}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-invoice__body">
                        <div class="kt-invoice__container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ITEMS</th>
{{--                                        <th>DESCRIPTION</th>--}}
                                        <th>QUANTITY</th>
                                        <th>UNIT PRICE</th>
                                        <th>VAT(%)</th>
                                        <th>MONTHS</th>
{{--                                        <th>AMOUNT</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoiceDetailsArray as $invoiceDetail)
                                    <tr>
                                        <td>{{$invoiceDetail['item']->title}}</td>
{{--                                        <td>{{$item->description}}</td>--}}
                                        <td>{{$invoiceDetail['quantity']}}</td>
{{--                                        <td>{{$invoiceDetail['item']->price}}</td>--}}
                                        <td>{{$invoiceDetail['price']}}</td>
                                        <td>{{$invoiceDetail['vat_value']}}%</td>
{{--                                        @if()--}}
                                        <td>{{$invoiceDetail['number_of_months']}}</td>
{{--                                        <td>{{$invoiceDetail['price']}}</td>--}}
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="kt-invoice__footer">
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__total">
                                <span class="kt-invoice__title">STATUS</span>
                                <span>{!! $invoice->payment_status !!}</span>
{{--                                <span class="kt-invoice__notice">Taxes Included</span>--}}
                            </div>
                            <div class="kt-invoice__bank">

                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Total Amount:</span>
                                    <span class="kt-invoice__value">{{$invoice->total_amount}}</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Discount:</span>
                                    <span class="kt-invoice__value">{{$invoice->total_discount}}</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Invoice Total:</span>
                                    <span class="kt-invoice__value">{{$invoice->invoice_total}}</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Invoice paid:</span>
                                    <span class="kt-invoice__value">{{ $invoice->invoice_total -  $invoice->invoice_total_due}}</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Invoice Due:</span>
                                    <span class="kt-invoice__value">{{ $invoice->invoice_total_due}}</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Status:</span>
                                    <span class="kt-invoice__value">{!! $invoice->payment_status !!}</span></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-invoice__actions">
                        <div class="kt-invoice__container">
                            <button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">Download Invoice</button>
                            <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Print Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
@endsection
