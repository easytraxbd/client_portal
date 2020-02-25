@extends('layouts.metronic')

@section('content')
    <link href="{{ asset('css/invoice.css') }}" rel="stylesheet" type="text/css" >
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-invoice-1">
                    <div class="kt-invoice__head" style="background-image: url('/assets/media/bg/bg-6.jpg');">
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__brand">
                                <h1 class="kt-invoice__title">PAYMENT</h1>
                                <div href="#" class="kt-invoice__logo">
                                    <a href="#"><img src="/assets/media/company-logos/logo_client_white.png" width="165px"></a>
                                    <span class="kt-invoice__desc">
																<span>House #385 (2nd Floor), Road #06, Mirpur DOHS</span>
																<span>Dhaka-1216, Bangladesh</span>
															</span>
                                </div>
                            </div>
                            <div class="kt-invoice__items">
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">DATA</span>
                                    <span class="kt-invoice__text">Dec 12, 2017</span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE NO.</span>
                                    <span class="kt-invoice__text">GS 000014</span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__subtitle">INVOICE TO.</span>
                                    <span class="kt-invoice__text">Iris Watson, P.O. Box 283 8562 Fusce RD.<br>Fredrick Nebraska 20620</span>
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
                                        <th>DESCRIPTION</th>
                                        <th>HOURS</th>
                                        <th>RATE</th>
                                        <th>AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Creative Design</td>
                                        <td>80</td>
                                        <td>$40.00</td>
                                        <td>$3200.00</td>
                                    </tr>
                                    <tr>
                                        <td>Front-End Development</td>
                                        <td>120</td>
                                        <td>$40.00</td>
                                        <td>$4800.00</td>
                                    </tr>
                                    <tr>
                                        <td>Back-End Development</td>
                                        <td>210</td>
                                        <td>$60.00</td>
                                        <td>$12600.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="kt-invoice__footer">
                        <div class="kt-invoice__container">
                            <div class="kt-invoice__bank">
                                <div class="kt-invoice__title">BANK TRANSFER</div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Account Name:</span>
                                    <span class="kt-invoice__value">Barclays UK</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Account Number:</span>
                                    <span class="kt-invoice__value">1234567890934</span></span>
                                </div>
                                <div class="kt-invoice__item">
                                    <span class="kt-invoice__label">Code:</span>
                                    <span class="kt-invoice__value">BARC0032UK</span></span>
                                </div>
                            </div>
                            <div class="kt-invoice__total">
                                <span class="kt-invoice__title">TOTAL AMOUNT</span>
                                <span class="kt-invoice__price">$20.600.00</span>
                                <span class="kt-invoice__notice">Taxes Included</span>
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
