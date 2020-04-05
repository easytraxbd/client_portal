@extends('layouts.metronic')

@section('content')
    <div class="row">
<div class="col-md-12">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Create New Service Request
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" METHOD="POST" action="{{route('ticket.store')}}">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Service Requests Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title" required autofocus>
                        @error('title')
                        <span class="form-text text-muted"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-lg-4" style="display: none">
                        <label class="">Service Requests Type:</label>
                        <select class="form-control" name="ticket_type_id" required>
                            @foreach($ticketTypes as $ticketTypeId => $ticketTypeName)
                            <option value="{{$ticketTypeId}}" @if($ticketTypeId == '226') selected @endif>{{$ticketTypeName}}</option>
                            @endforeach
                        </select>
{{--                        <span class="form-text text-muted">Please enter your email</span>--}}
                    </div>
                </div>
{{--                <div class="form-group row">--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <label class="">Postcode:</label>--}}
{{--                        <div class="kt-input-icon kt-input-icon--right">--}}
{{--                            <input type="text" class="form-control" placeholder="Enter your postcode">--}}
{{--                            <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>--}}
{{--                        </div>--}}
{{--                        <span class="form-text text-muted">Please enter your postcode</span>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4">--}}
{{--                        <label class="">User Group:</label>--}}
{{--                        <div class="kt-radio-inline">--}}
{{--                            <label class="kt-radio kt-radio--solid">--}}
{{--                                <input type="radio" name="example_2" checked value="2"> Sales Person--}}
{{--                                <span></span>--}}
{{--                            </label>--}}
{{--                            <label class="kt-radio kt-radio--solid">--}}
{{--                                <input type="radio" name="example_2" value="2"> Customer--}}
{{--                                <span></span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <span class="form-text text-muted">Please select user group</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="kt-ckeditor-1">Description:</label>
                        <textarea rows="6" name="description" id="kt-ckeditor-1"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Enter description" required autofocus></textarea>
                        @error('description')
                        <span class="form-text text-muted"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
{{--                        <div class="col-lg-6"></div>--}}
                        <div class="col-lg-12 text-center">
                            <input type="submit" class="btn btn-primary" value="Submit">
{{--                            <button type="reset" class="btn btn-primary">Submit</button>--}}
{{--                            <button type="reset" class="btn btn-secondary">Cancel</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>
</div>
    </div>

@endsection
@section('script')
    <!--begin::Page Vendors(used by this page) -->
{{--    <script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('js/ckeditor.bundle.js') }}"></script>--}}

    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
{{--    <script src="assets/js/pages/crud/forms/editors/ckeditor-classic.js" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('js/ckeditor.js') }}"></script>--}}

    <!--end::Page Scripts -->
@endsection
