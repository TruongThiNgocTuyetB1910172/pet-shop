<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>

        </div>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex mx-3"> <a class="d-block" >{{ Auth::guard('admin')->user()->email }}</a></div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="fa fa-tags"></i>
                        <p>
                            Quản lý danh mục
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        <p>
                            Quản lý sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('banner.index') }}" class="nav-link">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <p>
                            Quản lý banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            Quản lý khách hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('account.index') }}" class="nav-link">
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                        <p>
                            Quản lý tài khoản
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('receipt.index') }}" class="nav-link">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        <p>
                            Quản lý phiếu nhập
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
