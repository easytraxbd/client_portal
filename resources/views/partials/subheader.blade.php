<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {{ucfirst($header ?? $title ?? "Client Portal")}} </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    {{ucfirst($header ?? $title ?? "Client Portal")}}</a>
                @if(isset($subHeader))
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    {{ucfirst($subHeader ?? $subTitle ?? "index")}} </a>
                    @endif
            </div>

        </div>
        <div class="col-md-10">
            <a href="/notice">
                <marquee behavior="scroll" direction="left" scrollamount="5" style="color: white">Easytrax Operations Update due to rapid spread of COVID-19 across the world !!</marquee>
            </a>
        </div>
{{--        <div class="kt-subheader__toolbar">--}}
{{--            <div class="kt-subheader__wrapper">--}}
{{--                <a href="#" class="btn kt-subheader__btn-secondary">--}}
{{--                    Reports--}}
{{--                </a>--}}
{{--                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">--}}
{{--                    <a href="#" class="btn btn-danger kt-subheader__btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        Products--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>--}}
{{--                        <a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>--}}
{{--                        <a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
</div>
