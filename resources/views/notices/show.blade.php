@extends('layouts.metronic')

@section('content')
    <div class="row row-full-height">
        <div class="col-md-12">
            <div class="card">
{{--                <img class="card-img-top" src="..." alt="Card image cap">--}}
                <div class="card-body">
                    <h5 class="card-title">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notice->published_at)->toDayDateTimeString()}}</h5>
                    <h5 class="card-subtitle">{{$notice->title}}</h5>
                    <br>
                    <div class="card-text">{!! $notice->body !!}</div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
@endsection

{{--<div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">--}}
{{--    <div class="kt-portlet__body kt-portlet__body--fluid">--}}
{{--        <div class="kt-widget26">--}}
{{--            <div class="kt-widget26__content">--}}
{{--                <span class="kt-widget26__number">{{$notice['date']}}</span>--}}
{{--                <span class="kt-widget26__desc"> {{$notice['title']}}</span>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                {!! $notice['body'] !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
