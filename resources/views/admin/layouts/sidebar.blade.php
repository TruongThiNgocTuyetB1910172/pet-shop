<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a wire:navigate aria-expanded="false" href="{{ route('category.index') }}">
                    <i class="icon-badge menu-icon"></i>
                    <span class="nav-text">
                        Category
                    </span>
                </a>
            </li>

            <li>
                <a wire:navigate aria-expanded="false" href="{{ route('product.index') }}">
                    <i class="icon-note menu-icon"></i>
                    <span class="nav-text">
                        Product
                    </span>
                </a>
            </li>

            <li>
                <a wire:navigate aria-expanded="false" href="{{ route('user.index') }}">
                    <i class="icon-note menu-icon"></i>
                    <span class="nav-text">
                        User
                    </span>
                </a>
            </li>

            <li>
                <a wire:navigate aria-expanded="false" href="{{ route('banner.index') }}">
                    <i class="icon-note menu-icon"></i>
                    <span class="nav-text">
                        Banner
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
