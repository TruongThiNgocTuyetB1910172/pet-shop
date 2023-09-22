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
                        <a href="#">Danh mục</a>
                    </li>
                    <li>
                        <a href="contact.html">Gói dịch vụ</a>
                    </li>
                        @if(Auth::check())
                        <li>
                            <a href="#">
                                    {{ auth()->user()->name }}
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
                        @elseif(Auth::check())
                        <li>
                            <a href="#">
                                {{ auth('admin')->user()->name }}
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
                        @else
                            <li><a href="{{ route("login") }}"><span class="icon icon-person">Đăng nhập</span></a></li>
                        @endif
                </ul>
 </nav>
