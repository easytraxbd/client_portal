@extends('layouts.metronic')

@section('content')
    <div class="row row-full-height">
        @foreach($noticeArray as $notice)
        <div class="col-md-6" style="padding-bottom: 20px">
            <a href="notice/{{$notice->id}}">
            <div class="card" style="color: black; height: 150px;">
{{--                <img class="card-img-top" src="..." alt="Card image cap">--}}
                <div class="card-body">
                    <br>
                    <h4 class="card-title">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notice->published_at)->toDayDateTimeString()}}</h4>
                    <p class="card-text">{{$notice->title}}</p>
                </div>
            </div>
            </a>
        </div>
            @endforeach
    </div>
    @endsection
    @section('script')
@endsection
