@extends('layouts.metronic')

@section('content')
    <div class="row row-full-height">
        @foreach($noticeArray as $notice)
        <div class="col-md-6">
            <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget26">
                        <div class="kt-widget26__content">
                            <span class="kt-widget26__number">21-03-2020</span>
                            <span class="kt-widget26__desc"> {{$notice['question']}}</span>
                        </div>
                        <div>
                            {!! $notice['ans'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endforeach
    </div>
    @endsection
    @section('script')
@endsection
