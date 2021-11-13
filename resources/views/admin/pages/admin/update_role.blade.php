@extends('admin.layouts.master')
@section('title')
    eCommerce Admin - Dashboard
@endsection
@section('styles')
    <style>
        a {
            color: #5da1eb;
        }

    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
                @include('admin.partials.message')
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- /.row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- form start -->
                            <form id="roleEditForm" class="form-horizontal"
                                action="{{ url('sadmin/update-user-role', $adminDetails['id']) }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    @if (!empty($adminRoles))
                                        @foreach ($adminRoles as $role)
                                            {{-- Keep selected category permission --}}
                                            @if ($role['module'] == 'categories')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewCategories = "checked"; @endphp
                                                @else
                                                    @php $viewCategories = ""; @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editCategories = "checked"; @endphp
                                                @else
                                                    @php $editCategories = ""; @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullAccCategories = "checked"; @endphp
                                                @else
                                                    @php $fullAccCategories = ""; @endphp
                                                @endif
                                            @endif
                                            {{-- Keep selected coupons permission --}}
                                            @if ($role['module'] == 'coupons')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewCoupons = "checked"; @endphp
                                                @else
                                                    @php $viewCoupons = ""; @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editCoupons = "checked"; @endphp
                                                @else
                                                    @php $editCoupons = ""; @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullAccCoupons = "checked"; @endphp
                                                @else
                                                    @php $fullAccCoupons = ""; @endphp
                                                @endif
                                            @endif
                                            {{-- Keep selected Products permission --}}
                                            @if ($role['module'] == 'products')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewPrds = "checked"; @endphp
                                                @else
                                                    @php $viewPrds = ""; @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editPrds = "checked"; @endphp
                                                @else
                                                    @php $editPrds = ""; @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullAccPrds = "checked"; @endphp
                                                @else
                                                    @php $fullAccPrds = ""; @endphp
                                                @endif
                                            @endif
                                            {{-- Keep selected Orders permission --}}
                                            @if ($role['module'] == 'orders')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewOrders = "checked"; @endphp
                                                @else
                                                    @php $viewOrders = ""; @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editOrders = "checked"; @endphp
                                                @else
                                                    @php $editOrders = ""; @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullAccOrders = "checked"; @endphp
                                                @else
                                                    @php $fullAccOrders = ""; @endphp
                                                @endif
                                            @endif

                                        @endforeach
                                    @endif
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <label for="category">Categories</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="categories[view]" value="1"
                                                @if (isset($viewCategories)) {{ $viewCategories }} @endif>&nbsp;View
                                            &nbsp;
                                            <input type="checkbox" name="categories[edit]" value="1"
                                                @if (isset($editCategories)) {{ $editCategories }} @endif>&nbsp;View-Edit
                                            &nbsp;
                                            <input type="checkbox" name="categories[full]" value="1"
                                                @if (isset($fullAccCategories)) {{ $fullAccCategories }} @endif>&nbsp;Full
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <label for="products">Products</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="products[view]" value="1"
                                                @if (isset($viewPrds)) {{ $viewPrds }} @endif>&nbsp;View &nbsp;
                                            <input type="checkbox" name="products[edit]" value="1"
                                                @if (isset($editPrds)) {{ $editPrds }} @endif>&nbsp;View-Edit &nbsp;
                                            <input type="checkbox" name="products[full]" value="1"
                                                @if (isset($fullAccPrds)) {{ $fullAccPrds }} @endif>&nbsp;Full
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <label for="coupons">Coupons</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="coupons[view]" value="1"
                                                @if (isset($viewCoupons)) {{ $viewCoupons }} @endif>&nbsp;View&nbsp;
                                            <input type="checkbox" name="coupons[edit]" value="1"
                                                @if (isset($editCoupons)) {{ $editCoupons }} @endif>&nbsp;View-Edit&nbsp;
                                            <input type="checkbox" name="coupons[full]" value="1"
                                                @if (isset($fullAccCoupons)) {{ $fullAccCoupons }} @endif>&nbsp;Full
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group col-md-3">
                                            <label for="category">Orders</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="orders[view]" value="1" @if (isset($viewOrders))
                                            {{ $viewOrders }}
                                            @endif>&nbsp;View&nbsp;
                                            <input type="checkbox" name="orders[edit]" value="1" @if (isset($editOrders))
                                            {{ $editOrders }}
                                            @endif>&nbsp;View-Edit&nbsp;
                                            <input type="checkbox" name="orders[full]" value="1" @if (isset($fullAccOrders))
                                            {{ $fullAccOrders }}
                                            @endif>&nbsp;Full
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info rounded-0">Save</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
