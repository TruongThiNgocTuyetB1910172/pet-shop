
<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.header')

<body>

<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>

<div id="main-wrapper">
    <div class="nav-header">
        <div class="brand-logo">
            <a href="#">
                <b class="logo-abbr"><img src="admin/images/logo.png" alt=""> </b>
                <span class="logo-compact"><img src="admin/images/logo-compact.png" alt=""></span>
                <span class="brand-title">
                        <img src="admin/images/logo-text.png" alt="">
                    </span>
            </a>
        </div>
    </div>

    @include('admin.layouts.navbar')

    @include('admin.layouts.sidebar')

    @include('sweetalert::alert')

    <div class="content-body">
        <div class="container-fluid mt-3">
            @yield('content')
        </div>
    </div>
</div>

@include('admin.layouts.footer')

</body>

</html>
