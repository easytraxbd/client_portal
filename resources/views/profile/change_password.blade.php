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
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Change Password<small>change or reset your account password</small></h3>
                            </div>
                        </div>
                        <form class="kt-form kt-form--label-right" method="POST" action="/profile/change-password">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
{{--                                        <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">--}}
{{--                                            <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>--}}
{{--                                            <div class="alert-text">Configure user passwords to expire periodically. Users will need warning that their passwords are going to expire, <br>or they might inadvertently get locked out of the system!</div>--}}
{{--                                            <div class="alert-close">--}}
{{--                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true"><i class="la la-close"></i></span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Change Or Recover Your Password:</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" placeholder="Current password">
                                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                <a href="/password/reset" class="kt-link kt-font-sm kt-font-bold kt-margin-t-5">Forgot password ?</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="" placeholder="New password">
                                                @error('new_password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Verify Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="password" name="confirm_new_password" class="form-control @error('confirm_new_password') is-invalid @enderror" value="" placeholder="Verify new password">
                                                @error('confirm_new_password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-brand btn-bold">Change Password</button>&nbsp;
{{--                                            <button type="reset" class="btn btn-secondary">Cancel</button>--}}
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
