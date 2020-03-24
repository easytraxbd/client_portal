
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>Easytrax | Reset password</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
{{--    <link href="././demo4/src/assets/css/pages/login/login-1.css" rel="stylesheet" type="text/css" />--}}

<!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    {{--    <link href="././demo4/src/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="././demo4/src/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="images/easytrax/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body style="background-image: url(assets/media/demos/demo4/header.jpg); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

<!-- begin::Page loader -->

<!-- end::Page Loader -->

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(/images/easytrax/bg_login.jpg);">
                <div class="kt-grid__item">
                    <a href="#" class="kt-login__logo">
                        <img alt="Logo" src="/images/easytrax/logos/easytrax_logo_white.png" class="kt-header__brand-logo-default" width="100px" height="53px"/>
                    </a>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <h3 class="kt-login__title">Welcome to Easytrax!</h3>
                        {{--                        <h3 class="kt-login__title">Welcome to Easytrax Customer Self Service Portal!</h3>--}}
                        <h4 class="kt-login__subtitle">The Ultimate Fleet Management Solution Provider.</h4>
                    </div>
                </div>
                <div class="kt-grid__item">
                    <div class="kt-login__info">
                        <div class="kt-login__copyright">
                            &copy 2020 Easytrax
                        </div>
                        <div class="kt-login__menu">
                            <a href="https://www.easytrax.com.bd/contact/" target="_blank">Contact</a>
                            <a href="https://www.easytrax.com.bd/privacy-policy" target="_blank">Privacy Policy</a>
                            <a href="https://www.easytrax.com.bd/terms-conditions" target="_blank">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                <!--begin::Body-->
                <div class="kt-login__body" style="margin-top: 0rem;">

                    <!--begin::Signin-->
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h3>{{ __('Reset Password') }}</h3>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    @endif
                        <!--begin::Form-->
                        <form class="kt-form" method="POST" action="{{ route('password.email') }}" novalidate="novalidate" id="kt_login_form">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--begin::Action-->
                            <div class="kt-login__actions">
                                <a href="{{ route('login') }}">
                                    Back to login ?
                                </a>
                                <input id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary" value=" {{ __('Send Password Reset Link') }}">
                                {{--                                <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>--}}
                            </div>

                            <!--end::Action-->
                        </form>

                        <!--end::Form-->
                    </div>

                    <!--end::Signin-->
                </div>

                <!--end::Body-->

                <!--begin::Head-->
                <div class="kt-login__head">
                    <span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
                    <a href="http://reg.easytrax.com.bd">Sign Up!</a>
                </div>

                <!--end::Head-->
            </div>

            <!--end::Content-->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#366cf3",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
{{--<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>--}}
{{--<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->
{{--<script src="assets/js/pages/custom/login/login-1.js" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/login.js') }}"></script>--}}
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
