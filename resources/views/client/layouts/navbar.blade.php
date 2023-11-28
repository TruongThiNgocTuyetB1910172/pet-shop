<nav id="menu">
    <ul>
        <li>
            <a href="index.html">Trang chủ</a>
        </li>
        <li>
            <a class="active" href="shop.html">Sản phẩm</a>
        </li>
        <li>
            <a href="contact.html">Danh mục</a>
        </li>
        <li>
            <a href="faq.html">Feature</a>
        @if(Auth::check())
            <li>
                <a href="#">
                    {{ Auth::user()->name }}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('location.new-add') }}">Trang cá nhân</a>
                    </li>
                    <li>
                        <a href="{{ route('purchase.history') }}">Đơn hàng của tôi</a>
                    </li>
                </ul>
            </li>
        @elseif(Auth::guard('admin')->check())
            <li>
                <a href="#">
                    {{Auth::guard('admin')->user()->name}}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang quản trị</a>
                    </li>
                </ul>
            </li>
        @elseif(Auth::guard('shipper')->check())
            <li>
                <a href="#">
                    {{Auth::guard('shipper')->user()->name}}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>

                </ul>
            </li>
        @else
            <li><a href="{{ route("login") }}"><span class="icon icon-person">Đăng nhập</span></a></li>
            @endif
        </li>
    </ul>
</nav>
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
        <img class="img-responsive" src="{{asset('client/images/logo33.png')}}" alt="" />
    </a>
    <ul class="menu hidden-xs">
        <li>
            <a href="#">Danh mục</a>
            <ul>
                @foreach($categories as $category)
                   @if($category->products->count() >0 )
                        <li>
                            <a href="{{ route('product-by-category.index', ['id' => $category->id]) }}"> {{ $category->name }} ({{$category->products->count()}})</a>
                        </li>
                   @endif
                @endforeach
            </ul>
        </li>
        <li>
            <a href="contact.html">Gói dịch vụ</a>
        </li>
        @if(Auth::check())
            <li>
                <a href="#">
                    {{ Auth::user()->name }}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('location.new-add') }}">Trang cá nhân</a>
                    </li>
                    <li>
                        <a href="{{ route('purchase.history') }}">Đơn hàng của tôi</a>
                    </li>
                </ul>
            </li>
        @elseif(Auth::guard('admin')->check())
            <li>
                <a href="#">
                    {{Auth::guard('admin')->user()->name}}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}">Trang quản trị</a>
                    </li>
                </ul>
            </li>
        @elseif(Auth::guard('shipper')->check())
            <li>
                <a href="#">
                    {{Auth::guard('shipper')->user()->name}}
                </a>
                <ul>
                    <li><a href="" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Đăng xuất

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>

                </ul>
            </li>
        @else
            <li><a href="{{ route("login") }}"><span class="icon icon-person">Đăng nhập</span></a></li>
        @endif
    </ul>
</nav>

{{--<nav id="menu">--}}
{{--    <ul>--}}
{{--        <li>--}}
{{--            <a href="index.html">Home</a>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="index.html">Home Version 1</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="index-02.html">Home Version 2</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="index-03.html">Home Version 3</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="index-04.html">Home Version 4</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a class="active" href="shop.html">Shop</a>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="shop.html">Shop List</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="shop-02.html">Shop List Version 2</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="shop-03.html">Shop List Version 3</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="shop-04.html">Shop List Version 4</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="shop-detail.html">Shop Detail</a>--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <a href="shop-detail.html">Shop Detail</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="shop-detail-02.html">Shop Detail Version 2</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="shop-detail-03.html">Shop Detail Version 3</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="wish-list.html">Wishlist</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="shop-cart.html">Shop Cart</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="check-out.html">Checkout</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="about.html">About</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="blog.html">Blog</a>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="blog.html">Blog List Version 1</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="blog-02.html">Blog List Version 2</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="blog-03.html">Blog List Version 3</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="blog-04.html">Blog List Version 4</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="blog-detail.html">Blog Detail</a>--}}
{{--                    <ul>--}}
{{--                        <li>--}}
{{--                            <a href="blog-detail.html">Blog Detail</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="blog-detail-02.html">Blog Detail Version 2</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="blog-detail-03.html">Blog Detail Version 3</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="contact.html">Contact</a>--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            <a href="faq.html">Feature</a>--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <a href="404.html">404 Page</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="faq.html">Faq</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="login.html">Login</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="register.html">Register</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</nav>--}}
{{--<header class="header-style-1 static">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="header-1-inner">--}}
{{--                <a class="brand-logo animsition-link" href="index.html">--}}
{{--                    <img class="img-responsive" src="images/logo.png" alt="" />--}}
{{--                </a>--}}
{{--                <nav>--}}
{{--                    <ul class="menu hidden-xs">--}}
{{--                        <li>--}}
{{--                            <a href="index.html">Home</a>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="index.html">Home Version 1</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="index-02.html">Home Version 2</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="index-03.html">Home Version 3</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="index-04.html">Home Version 4</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="active" href="shop.html">Shop</a>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="shop.html">Shop List</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="shop-02.html">Shop List Version 2</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="shop-03.html">Shop List Version 3</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="shop-04.html">Shop List Version 4</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="shop-detail.html">Shop Detail</a>--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="shop-detail.html">Shop Detail</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="shop-detail-02.html"--}}
{{--                                            >Shop Detail Version 2</a--}}
{{--                                            >--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="shop-detail-03.html"--}}
{{--                                            >Shop Detail Version 3</a--}}
{{--                                            >--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="wish-list.html">Wishlist</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="shop-cart.html">Shop Cart</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="check-out.html">Checkout</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="about.html">About</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="blog.html">Blog</a>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="blog.html">Blog List Version 1</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="blog-02.html">Blog List Version 2</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="blog-03.html">Blog List Version 3</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="blog-04.html">Blog List Version 4</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="blog-detail.html">Blog Detail</a>--}}
{{--                                    <ul>--}}
{{--                                        <li>--}}
{{--                                            <a href="blog-detail.html">Blog Detail</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="blog-detail-02.html"--}}
{{--                                            >Blog Detail Version 2</a--}}
{{--                                            >--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="blog-detail-03.html"--}}
{{--                                            >Blog Detail Version 3</a--}}
{{--                                            >--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="contact.html">Contact</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="faq.html">Feature</a>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <a href="404.html">404 Page</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="faq.html">Faq</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="login.html">Login</a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="register.html">Register</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--                <aside class="right">--}}
{{--                    <div class="widget widget-control-header">--}}
{{--                        <div class="select-custom-wrapper">--}}
{{--                            <select class="no-border">--}}
{{--                                <option>USD</option>--}}
{{--                                <option>VND</option>--}}
{{--                                <option>EUR</option>--}}
{{--                                <option>JPY</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="widget widget-control-header widget-search-header">--}}
{{--                        <a--}}
{{--                            class="control btn-open-search-form js-open-search-form-header"--}}
{{--                            href="#"--}}
{{--                        >--}}
{{--                            <span class="lnr lnr-magnifier"></span>--}}
{{--                        </a>--}}
{{--                        <div class="form-outer">--}}
{{--                            <button--}}
{{--                                class="btn-close-form-search-header js-close-search-form-header"--}}
{{--                            >--}}
{{--                                <span class="lnr lnr-cross"></span>--}}
{{--                            </button>--}}
{{--                            <form>--}}
{{--                                <input placeholder="Search" />--}}
{{--                                <button class="search">--}}
{{--                                    <span class="lnr lnr-magnifier"></span>--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div--}}
{{--                        class="widget widget-control-header widget-shop-cart js-widget-shop-cart"--}}
{{--                    >--}}
{{--                        <a class="control" href="shop-cart.html">--}}
{{--                            <p class="counter">0</p>--}}
{{--                            <span class="lnr lnr-cart"></span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div--}}
{{--                        class="widget widget-control-header hidden-lg hidden-md hidden-sm"--}}
{{--                    >--}}
{{--                        <a--}}
{{--                            class="navbar-toggle js-offcanvas-has-events"--}}
{{--                            type="button"--}}
{{--                            href="#menu"--}}
{{--                        >--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                            <span class="icon-bar"></span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </aside>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}
