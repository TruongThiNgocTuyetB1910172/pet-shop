<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user-o" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin-profile.index', ['id' => Auth::guard('admin')->id()]) }}" class="dropdown-item">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i> Trang cá nhân
                </a>
                <div class="dropdown-divider"></div>
                <a href="" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="dropdown-item" ><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
