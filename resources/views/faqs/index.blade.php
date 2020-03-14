@extends('layouts.metronic')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                <h3 class="kt-portlet__head-title">
                    FAQs
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
{{--                    &nbsp;--}}
{{--                    <a href="/" class="btn btn-info btn-icon-sm">--}}
{{--                        <i class="flaticon2-plus"></i> Add New--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
        <br>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded" id="local_data"
                 style="">
                <div class="col-md-12">
                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample1">
                        @foreach($faqArray as $faq)
                        <div class="card">
                            <div class="card-header" id="headingOne{{$faq['question_number']}}">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne{{$faq['question_number']}}" aria-expanded="false" aria-controls="collapseOne1">
                                    {{$faq['question']}}
                                </div>
                            </div>
                            <div id="collapseOne{{$faq['question_number']}}" class="collapse show" aria-labelledby="headingOne{{$faq['question_number']}}" data-parent="#accordionExample1" style="">
                                <div class="card-body">
                                   {!! $faq['ans'] !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            <!--end: Datatable -->
            </div>
        </div>
    </div>
    @endsection
    @section('script')
@endsection
