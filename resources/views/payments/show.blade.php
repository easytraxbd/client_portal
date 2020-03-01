@extends('layouts.metronic')

@section('content')
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet" type="text/css" >
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-invoice-1">
                    <div class="kt-invoice__head" style="background-image: url('/images/easytrax/bg_invoice.png');">
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__brand">
                                <h1 class="kt-invoice__title">PAYMENT</h1>
                                <div href="#" class="kt-invoice__logo">
                                    <a href="#"><img src="/images/easytrax/logos/easytrax_logo_white.png" width="165px"></a>
                                    <span class="kt-invoice__desc">
																<span>House #385 (2nd Floor), Road #06, Mirpur DOHS</span>
																<span>Dhaka-1216, Bangladesh</span>
															</span>
                                </div>
                            </div>
                            <div class="kt-invoice__items">
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">DATE</span>
                                    <span class="kt-invoice__text">{{$payment->payment_date}}</span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">PAYMENT ID.</span>
                                    <span class="kt-invoice__text">{{$payment->id}}</span>
                                </div>
                                @if(isset($payment->payment_method))
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">PAYMENT METHOD.</span>
                                    <span class="kt-invoice__text">{{$payment->payment_method}}</span>
                                </div>@endif
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">PAYMENT AMOUNT</span>
                                    <span class="kt-invoice__text">৳ {{$payment->total_amount}}</span>
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
                                        <th>INVOICE</th>
                                        <th>INVOICE AMOUNT</th>
                                        <th>PAID AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoiceArray as $invoice)
                                    <tr>
                                        <td><a href="/invoice/{{$invoice->id}}">{{$invoice->invoice_no}}</a></td>
                                        <td>৳ {{$invoice->invoice_total}}</td>
                                        <td>৳ {{$invoice->paid_to_invoice}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="kt-invoice__footer">
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__bank">
                                <div class="kt-invoice__title" style="display: none">BANK TRANSFER</div>
                            </div>
                            <div class="kt-invoice__total">
                                <span class="kt-invoice__title">TOTAL AMOUNT</span>
                                <span class="kt-invoice__price">৳ {{$payment->total_amount}}</span>
{{--                                <span class="kt-invoice__notice">Taxes Included</span>--}}
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
