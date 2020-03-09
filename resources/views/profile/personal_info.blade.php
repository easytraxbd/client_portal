@extends('layouts.metronic')

@section('content')
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>

        <!--End:: App Aside Mobile Toggle-->

        <!--Begin:: App Aside-->
    @include('profile.profile_aside')
        <!--End:: App Aside-->

        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Personal Information <small>update your personal informaiton</small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="dropdown dropdown-inline">
{{--                                        <button type="button" class="btn btn-label-brand btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            <i class="flaticon2-gear"></i>--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <ul class="kt-nav">--}}
{{--                                                <li class="kt-nav__section kt-nav__section--first">--}}
{{--                                                    <span class="kt-nav__section-text">Export Tools</span>--}}
{{--                                                </li>--}}
{{--                                                <li class="kt-nav__item">--}}
{{--                                                    <a href="#" class="kt-nav__link">--}}
{{--                                                        <i class="kt-nav__link-icon la la-print"></i>--}}
{{--                                                        <span class="kt-nav__link-text">Print</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li class="kt-nav__item">--}}
{{--                                                    <a href="#" class="kt-nav__link">--}}
{{--                                                        <i class="kt-nav__link-icon la la-copy"></i>--}}
{{--                                                        <span class="kt-nav__link-text">Copy</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li class="kt-nav__item">--}}
{{--                                                    <a href="#" class="kt-nav__link">--}}
{{--                                                        <i class="kt-nav__link-icon la la-file-excel-o"></i>--}}
{{--                                                        <span class="kt-nav__link-text">Excel</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li class="kt-nav__item">--}}
{{--                                                    <a href="#" class="kt-nav__link">--}}
{{--                                                        <i class="kt-nav__link-icon la la-file-text-o"></i>--}}
{{--                                                        <span class="kt-nav__link-text">CSV</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li class="kt-nav__item">--}}
{{--                                                    <a href="#" class="kt-nav__link">--}}
{{--                                                        <i class="kt-nav__link-icon la la-file-pdf-o"></i>--}}
{{--                                                        <span class="kt-nav__link-text">PDF</span>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right" method="POST" action="{{route('profile.ticket')}}">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Customer Info:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                                    <div class="kt-avatar__holder" style="background-image: url(https://crm.easytrax.com.bd/uploads/client/client_photo/{{Auth::user()->client_photo}})"></div>
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen"></i>
                                                        <input type="file" accept=".png, .jpg, .jpeg">
                                                    </label>
                                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																					<i class="fa fa-times"></i>
																				</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="name" type="text" value="{{\Auth::user()->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="company_name" value="{{\Auth::user()->company_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Contact Number</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" class="form-control" name="work_phone" value="{{\Auth::user()->work_phone}}" placeholder="Contact number" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Alternative Contact Number</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                    <input type="text" class="form-control" name="alt_phone" value="{{\Auth::user()->alt_phone}}" placeholder="Alternative contact number" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                    <input type="text" class="form-control" name="email" value="{{\Auth::user()->email}}" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">NID</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="nid_number" value="{{\Auth::user()->nid_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Platform User ID</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="platform_username" value="{{\Auth::user()->platform_username}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Current Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="text" name="home_address" value="{{\Auth::user()->home_address}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3">
                                            </div>
                                            <div class="col-lg-9 col-xl-9">
                                                <input type="submit" class="btn btn-success" value="Request Update">&nbsp;
                                                <input type="reset" class="btn btn-secondary" value="Reset">
                                                <span class="form-text text-muted">It will create a ticket with info you provided and<br> profile will be updated after verification.</span>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot"></div>
                        </form>


                        <form class="kt-form kt-form--label-right" method="POST" action="{{route('profile.update')}}">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Other Information:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Date of Birth</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" name="birth_date" type="date" value="{{\Auth::user()->birth_date}}">
                                            </div>
                                        </div>
{{--                                        <div class="form-group row">--}}
{{--                                            <label class="col-xl-3 col-lg-3 col-form-label">Occupation</label>--}}
{{--                                            <div class="col-lg-9 col-xl-6">--}}
{{--                                                <input class="form-control" type="text" value="occupation" multiple>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Marital Status</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <select name="marital_status">
                                                    <option>Select one</option>
                                                    <option value="single" @if(\Auth::user()->marital_status == 'single') selected @endif>Single</option>
                                                    <option value="married" @if(\Auth::user()->marital_status == 'married') selected @endif>Married</option>
                                                    <option value="widowed" @if(\Auth::user()->marital_status == 'widowed') selected @endif>Widowed</option>
                                                    <option value="divorced" @if(\Auth::user()->marital_status == 'divorced') selected @endif>Divorced</option>
                                                    <option value="separated" @if(\Auth::user()->marital_status == 'separated') selected @endif>Separated</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Anniversary</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control" type="date" name="marriage_anniversary" value="{{\Auth::user()->marriage_anniversary}}">
                                            </div>
                                        </div>
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3">
                                                </div>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input type="submit" class="btn btn-success" value="Update">&nbsp;
                                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    @endsection
    @section('script')

@endsection
