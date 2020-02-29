<div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
    <div class="kt-container ">

        <!-- begin:: Brand -->
        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
            <a class="kt-header__brand-logo" href="?page=index">
{{--                <img alt="Logo" src="/assets/media/logos/logo-4.png" class="kt-header__brand-logo-default" />--}}
{{--                <img alt="Logo" src="/assets/media/logos/logo-4-sm.png" class="kt-header__brand-logo-sticky" />--}}
                <img alt="Logo" src="/images/easytrax/logos/easytrax_logo_white.png" class="kt-header__brand-logo-default" width="100px"/>
                <img alt="Logo" src="/images/easytrax/logos/easytrax_logo_color_full.png" class="kt-header__brand-logo-sticky" width="47px"/>
            </a>
        </div>

        <!-- end:: Brand -->

        <!-- begin: Header Menu -->
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                <ul class="kt-menu__nav ">
{{--                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--here kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open kt-menu__item--here" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Dashboard</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>--}}
{{--                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">--}}
{{--                            <ul class="kt-menu__subnav">--}}
{{--                                <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href="index.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Default Dashboard</span></a></li>--}}
{{--                                <li class="kt-menu__item " aria-haspopup="true"><a href="dashboards/fluid.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Fluid Dashboard</span></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="kt-menu__item {{ Request::is("/") ? 'kt-menu__item--here' : '' }}">
                        <a href="/" class="kt-menu__link"><span class="kt-menu__link-text">Dashboard</span></a>
                    </li>
                    <li class="kt-menu__item {{ Request::is("payment") ? 'kt-menu__item--here' : '' }}">
                        <a href="/payment" class="kt-menu__link"><span class="kt-menu__link-text">Payment</span></a>
                    </li>
                    <li class="kt-menu__item {{ Request::is("payment-draft") ? 'kt-menu__item--here' : '' }}">
                        <a href="/payment-draft" class="kt-menu__link"><span class="kt-menu__link-text">Draft Payment</span></a>
                    </li>
                    <li class="kt-menu__item {{ Request::is("invoice") ? 'kt-menu__item--here' : '' }}">
                        <a href="/invoice" class="kt-menu__link"><span class="kt-menu__link-text">Invoice</span></a>
                    </li>
                    <li class="kt-menu__item {{ Request::is("ticket") ? 'kt-menu__item--here' : '' }}">
                        <a href="/ticket" class="kt-menu__link"><span class="kt-menu__link-text">Ticket</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar kt-grid__item">

            <!--begin: Notifications -->
            <!--end: Notifications -->

            <!--begin: Cart -->
            <!--end: Cart-->

            <!--begin: Language bar -->
            <!--end: Language bar -->

            <!--begin: User bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                    <span class="kt-header__topbar-welcome">Hi,</span>
                    <span class="kt-header__topbar-username">{{ ucfirst(Auth::user()->first_name ?? ' ')}}</span>
{{--                    <span class="kt-header__topbar-icon"><b>S</b></span>--}}
                    @if(isset(Auth::user()->client_photo))
                    <img alt="Client Profile" src="https://crm.easytrax.com.bd/uploads/client/client_photo/{{Auth::user()->client_photo}}" class="kt-header__brand-logo-default" height="59px" width="59px">
                    @endif
                    <img alt="Pic" src="/assets/media/users/300_21.jpg" class="kt-hidden" />
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                    <!--begin: Head -->
                    <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
                        <div class="kt-user-card__avatar">
                            <img class="kt-hidden" alt="Pic" src="/assets/media/users/300_25.jpg" />

                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
{{--                            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>--}}
                            @if(isset(Auth::user()->client_photo))
                            <img alt="S" src="https://crm.easytrax.com.bd/uploads/client/client_photo/{{Auth::user()->client_photo}}" class="kt-header__brand-logo-default">
                                @endif
                        </div>
                        <div class="kt-user-card__name">
                            {{ ucfirst(Auth::user()->name ?? ' ')}}
                        </div>
                        <div class="kt-user-card__badge">
                            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                        </div>
                    </div>

                    <!--end: Head -->

                    <!--begin: Navigation -->
                    <div class="kt-notification">
                        <a href="/profile/overview" class="kt-notification__item">
                            <div class="kt-notification__item-icon">
                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                            </div>
                            <div class="kt-notification__item-details">
                                <div class="kt-notification__item-title kt-font-bold">
                                    My Profile
                                </div>
                                <div class="kt-notification__item-time">
                                    Account settings and more
                                </div>
                            </div>
                        </a>
{{--                        <a href="custom/apps/user/profile-3.html" class="kt-notification__item">--}}
{{--                            <div class="kt-notification__item-icon">--}}
{{--                                <i class="flaticon2-mail kt-font-warning"></i>--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-details">--}}
{{--                                <div class="kt-notification__item-title kt-font-bold">--}}
{{--                                    My Messages--}}
{{--                                </div>--}}
{{--                                <div class="kt-notification__item-time">--}}
{{--                                    Inbox and tasks--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="custom/apps/user/profile-2.html" class="kt-notification__item">--}}
{{--                            <div class="kt-notification__item-icon">--}}
{{--                                <i class="flaticon2-rocket-1 kt-font-danger"></i>--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-details">--}}
{{--                                <div class="kt-notification__item-title kt-font-bold">--}}
{{--                                    My Activities--}}
{{--                                </div>--}}
{{--                                <div class="kt-notification__item-time">--}}
{{--                                    Logs and notifications--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="custom/apps/user/profile-3.html" class="kt-notification__item">--}}
{{--                            <div class="kt-notification__item-icon">--}}
{{--                                <i class="flaticon2-hourglass kt-font-brand"></i>--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-details">--}}
{{--                                <div class="kt-notification__item-title kt-font-bold">--}}
{{--                                    My Tasks--}}
{{--                                </div>--}}
{{--                                <div class="kt-notification__item-time">--}}
{{--                                    latest tasks and projects--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                        <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">--}}
{{--                            <div class="kt-notification__item-icon">--}}
{{--                                <i class="flaticon2-cardiogram kt-font-warning"></i>--}}
{{--                            </div>--}}
{{--                            <div class="kt-notification__item-details">--}}
{{--                                <div class="kt-notification__item-title kt-font-bold">--}}
{{--                                    Billing--}}
{{--                                </div>--}}
{{--                                <div class="kt-notification__item-time">--}}
{{--                                    billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
                        <div class="kt-notification__custom kt-space-between pull-right">
                            <a href="/logout" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                    <!--end: Navigation -->
                </div>
            </div>

            <!--end: User bar -->
        </div>

        <!-- end:: Header Topbar -->
    </div>
</div>
