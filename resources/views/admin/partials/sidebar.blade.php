@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    // echo '<pre>';
    // echo '======================<br>';
    // print_r($prefix);
    // echo '<br>======================<br>';
    // exit();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
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
                @if (Session::get('page')=="dashboard"))
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{( $prefix=='admin/site') ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Site
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('banner.index') }}" class="nav-link {{($route=='banner.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                   Banner
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview {{( $prefix=='admin/settings') ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('change_pwd') }}" class="nav-link {{($route=='change_pwd')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Update Password
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile_update') }}" class="nav-link {{($route=='profile_update')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Update Profile
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{( $prefix=='admin/catalogue') ? 'menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Catalogues
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('section.index') }}" class="nav-link {{($route=='section.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Section
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link {{($route=='brand.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Brands
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{($route=='category.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link {{($route=='product.index')?'active':''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Product
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
