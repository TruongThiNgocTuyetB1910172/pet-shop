
<!DOCTYPE html>
<html>
<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }

    .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
    }

    .card-registration .select-arrow {
        top: 13px;
    }

    .bg-grey {
        background-color: #eae8e8;
    }

    @media (min-width: 992px) {
        .card-registration-2 .bg-grey {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }

    @media (max-width: 991px) {
        .card-registration-2 .bg-grey {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
    }
</style>

@include('client.layouts.header')
<body class="animsition">

@include('sweetalert::alert')

<div class="home-2" id="page">
@include('client.layouts.navbar')
    <header class="header-style-2">
        <div class="header-2-inner">
            <div class="widget widget-control-header widget-search-header">
                <a class="btn-open-search-form js-open-search-form-header" href="#">
                    <span class="lnr lnr-magnifier"></span>
                </a>
                <div class="form-outer">
                    <button class="btn-close-form-search-header js-close-search-form-header">
                        <span class="lnr lnr-cross"></span>
                    </button>
                    <form>
                        <input placeholder="Search" />
                        <button class="search">
                            <span class="lnr lnr-magnifier"></span>
                        </button>
                    </form>
                </div>
            </div>
            <nav>
                <ul class="menu hidden-xs">
                    <li>
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('product-list.index')}}">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="about.html">Về chúng tôi</a>
                    </li>
                </ul>
                <a class="brand-logo" href="#">
                    <img class="img-responsive" src="client/images/logo.png" alt="" />
                </a>
                <ul class="menu hidden-xs">
                    <li>
                        <a href="{{route('service-list.index')}}">Dịch vụ</a>
                    </li>
                    <li>
                        <a href="contact.html">Gói dịch vụ</a>
                    </li>
                    <li>
                        <a href="faq.html">Liên hệ</a>

                    </li>

                </ul>
            </nav>
            <aside class="right">
{{--                <div class="widget widget-control-header">--}}
{{--                    <div class="select-custom-wrapper">--}}
{{--                        <select class="no-border">--}}
{{--                            <option>USD</option>--}}

{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                    <a class="control" href="{{ route('cart-list.index') }}" >

                        <span class="lnr lnr-bag"></span>
                    </a>
                </div>
                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                    <div class="dropdown-content-body">
                        <ul>

{{--                            <li>--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </li>--}}
                            @if (Auth::check())
                                <li><a href="" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ route("login") }}"><span class="icon icon-person">Login</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="widget widget-control-header hidden-lg hidden-md hidden-sm">
                    <a class="navbar-toggle js-offcanvas-has-events" type="button" href="#menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </div>
            </aside>
        </div>
    </header>
{{--    @include('client.layouts.silder')--}}
    @yield('content')
    <div class="call-to-action-style-3">
        <img class="rellax bg-overlay" src="client/images/call-to-action/2.jpg" alt="" />
        <div class="overlay-call-to-action"></div>
        <div class="container">
            <div class="row">
                <p class="h4">SUBCRIBE TO OUR SPECIAL OFFERS</p>
                <p>Sign up today our newsletter and receive 20% on your firts purchase</p>
                <form class="organic-form form-inline btn-add-on">
                    <div class="form-group">
                        <input class="form-control white pill" type="text" placeholder="Your email address..." />
                        <button class="btn btn-brand pill" type="submit">SUBSCRIBE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer-style-2">
        <div class="footer-style-2-inner">
            <div class="container">
                <div class="row">
                    <div class="widget-footer widget-text col-first col-small">
                        <a href="#">
                            <img class="logo-footer" src="client/images/logo.png" alt="Logo Organic" />
                        </a>
                        <p>Suspendisse ut diam quis turpis convallis tempus. Sed ultrices lobortis dolor laoreet luctus. Morbi ornare nisi vitae tellus euismod bibendum. Pellentesque posuere iaculis volutpat. </p>
                    </div>
                    <div class="widget-footer widget-link col-second col-small">
                        <div class="list-link">
                            <h4 class="h4 heading">SHOP</h4>
                            <ul>
                                <li>
                                    <a href="#">Food</a>
                                </li>
                                <li>
                                    <a href="#">Farm</a>
                                </li>
                                <li>
                                    <a href="#">Health</a>
                                </li>
                                <li>
                                    <a href="#">Organic</a>
                                </li>
                            </ul>
                        </div>
                        <div class="list-link">
                            <h4 class="h4 heading">SUPPORT</h4>
                            <ul>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">FAQ</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-footer widget-newsletter-footer col-last col-medium">
                        <h4 class="h4 heading">NEWSLETTER</h4>
                        <p>Subscribe now to get daily updates</p>
                        <form class="organic-form form-inline btn-add-on circle border">
                            <div class="form-group">
                                <input class="form-control pill transparent" placeholder="Your Email..." type="email" />
                                <button class="btn btn-brand circle" type="submit">
                                    <i class="fa fa-envelope-o"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right style-2">
            <div class="container">
                <div class="row">
                    <div class="copy-right-inner">
                        <p>Copyright © 2017 Designed by AuThemes. All rights reserved.</p>
                        <div class="widget widget-footer widget-footer-link-inline">
                            <ul class="list-unstyle">
                                <li>
                                    <a href="#">Term of Uses</a>
                                </li>
                                <li>
                                    <a href="#">Privacy</a>
                                </li>
                                <li>
                                    <a href="#">Shipping</a>
                                </li>
                                <li>
                                    <a href="#">Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

 @include('client.layouts.footer')
</div>
@livewireScripts
</body>
</html>
