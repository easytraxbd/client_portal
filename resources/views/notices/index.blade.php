@extends('layouts.metronic')

@section('content')
    <div class="row row-full-height">
        @foreach($noticeArray as $notice)
        <div class="col-md-6">
            <a href="notice/{{$notice['notice_number']}}">
            <div class="card" style="color: black">
{{--                <img class="card-img-top" src="..." alt="Card image cap">--}}
                <div class="card-body">
                    <h5 class="card-title">{{$notice['date']}}</h5>
                    <p class="card-text">{{$notice['title']}}</p>
                </div>
            </div>
            </a>
        </div>
            @endforeach
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
