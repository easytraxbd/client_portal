<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>{{ucfirst($title ?? "Client Portal")}} | {{ config('app.name', 'Easytrax') }}</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
		<!--end::Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
{{--		<link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />--}}
		<link rel="shortcut icon" href="/images/easytrax/favicon.ico"/>
        <style>
            table.table-bordered.dataTable th, table.table-bordered.dataTable td {
                font-size: 1rem;
                text-align: center;
            }
        </style>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background-image: url(/images/easytrax/header.png); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            </div>
			<div class="kt-header-mobile__logo">
				<a href="index.html">
{{--					<img alt="Logo" src="/assets/media/logos/logo-4-sm.png" />--}}
                    <img alt="Logo" src="/images/easytrax/logos/easytrax_logo_color_full.png" width="80px"/>
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">

				<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					@include('partials.header')
					<!-- end:: Header -->
					<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
						<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

							<!-- begin:: Subheader -->
							@include('partials.subheader')
							<!-- end:: Subheader -->

							<!-- begin:: Content -->
							<div class="kt-container  kt-grid__item kt-grid__item--fluid">
                            @yield('content')
								<!--Begin::Dashboard 3-->
{{--								@include('partials.dashboard_demo_content')--}}
								<!--End::Dashboard 3-->
							</div>

							<!-- end:: Content -->
						</div>
					</div>

					<!-- begin:: Footer -->
                     @include('partials.footer')

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- begin::Sticky Toolbar -->
{{--		@include('partials.sticky_toolbar')--}}
		<!-- end::Sticky Toolbar -->

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

        <script src="{{ asset('js/app.js') }}"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/5e705d25eec7650c33207534/default';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
        @if ($message = Session::get('success'))
            <script type="text/javascript">
                $(document).ready(function() {
                    toastr.success("{{ $message }}")
                });
            </script>
        @endif
        @yield('script')
		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>
