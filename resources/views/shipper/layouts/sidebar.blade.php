<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/' .Auth::guard('shipper')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('shipper')->user()->name }}</a>
            </div>

        </div>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex mx-3"> <a class="d-block" >{{ Auth::guard('shipper')->user()->email }}</a></div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('order-list.index') }}" class="nav-link">
                        <i class="fa fa-tags"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
