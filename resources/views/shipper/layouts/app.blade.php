<!DOCTYPE html>
<html lang="en">

@include('shipper.layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('shipper.layouts.navbar')

    @include('shipper.layouts.sidebar')

    @include('sweetalert::alert')

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>
</div>

@include('shipper.layouts.footer')

</body>
</html>
