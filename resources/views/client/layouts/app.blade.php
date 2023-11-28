<!DOCTYPE html>
<html>
@include('client.layouts.header')
<body class="animsition">

@include('sweetalert::alert')

@php
    $categories = app('categories');

@endphp

<div class="home-2" id="page">
    <header class="header-style-2">
        <div class="header-2-inner">
            <div class="widget widget-control-header widget-search-header">
                <a class="btn-open-search-form js-open-search-form-header" href="#">
                    <span class="lnr lnr-magnifier"></span>
                </a>
            </div>
            @include('client.layouts.navbar')
            <aside class="right">
                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                    <a class="control" href="{{ route('cart-list.index') }}" >
                        <span class="lnr lnr-bag">@if(Auth::check()) {{!is_null(\App\Models\Cart::where('user_id', Auth::user()->id)->get()) ? count(\App\Models\Cart::where('user_id', Auth::user()->id)->get()) : 0 }}@endif"</span>
                    </a>
                </div>

                <div class="widget widget-control-header widget-shop-cart js-widget-shop-cart">
                    <a class="control" href="{{ route('product-wishlist.index') }}" >
                        <span class="lnr lnr-heart"></span>
                    </a>
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

    @yield('content')

    <div class="call-to-action-style-3">
        <img class="rellax bg-overlay" src="{{asset('client/images/call-to-action/2.jpg')}}" alt="" />
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
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "169452882913924");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v18.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <footer class="footer-style-2">
        <div class="footer-style-2-inner">
            <div class="container">
                <div class="row">
                    <div class="widget-footer widget-text col-first col-small">
                        <a href="#">
                            <img class="logo-footer" src="{{asset('client/images/logo33.png')}}" alt="Logo Organic" />
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
                        <p>Copyright © 2023 TruongThiNgocTuyet B1910172</p>
                        <div class="widget widget-footer widget-footer-link-inline">

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
