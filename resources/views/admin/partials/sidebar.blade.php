<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <i class="nav-icon fas fa-tachometer-alt fa-3x"></i>
        {{-- <span class="brand-text font-weight-light">Dashboard</span> --}}
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ url('sadmin/profile-update') }}" class="d-block">
                    <i class="fas fa-user fa-2x text-warning"></i> &nbsp;
                    {{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Session::get('page') == 'dashboard')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item">
                    <a href="{{ url('sadmin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- Settings --}}
                @if (Session::get('page') == 'banners')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Site
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        @if (Session::get('page') == 'seoData')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/seo-data') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO Settings</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'banners')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/banners') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banners</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Settings --}}
                @if (Session::get('page') == 'settings' || Session::get('page') == 'profile_update')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        @if (Session::get('page') == 'settings')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/settings') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Password</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'profile_update')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/profile-update') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Information</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Catalogues --}}
                @if (Session::get('page') == 'section' || Session::get('page') == 'categories')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Catalogues
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        @if (Session::get('page') == 'cms_pages')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/cms-pages') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'admins')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/admins') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin/Subadmins</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'sections')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/sections') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Section</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'categories')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/categories') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'products')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('sadmin.products') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'coupons')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/coupons') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coupons</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'orders')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/orders') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'shippingCharges')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/shipping-charges') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shipping Charges</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'users')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('sadmin/users') }}" class="nav-link {{ $active }}">
                                <i class="far fa-user nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('sadmin/logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
