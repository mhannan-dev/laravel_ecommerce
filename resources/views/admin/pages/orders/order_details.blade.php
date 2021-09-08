<?php
use App\Models\Product;
?>
@extends('admin.layouts.master')
@section('title')
    Order Details of Products
@endsection
@section('styles')
    <style>
        select.form-control {
            background: rgb(153, 238, 25);
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('sadmin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details - <span
                                        class="badge badge-warning">({{ $orderDetails['id'] }})</span></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order Date</th>
                                            <th scope="col" style="background: rgb(156 236 35)">Order Status</th>
                                            <th scope="col">Order Total</th>
                                            <th scope="col">Shipping Charges</th>
                                            <th scope="col">Coupon Code</th>
                                            <th scope="col">Coupon Amount</th>
                                            <th scope="col">Payment Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ date('Y-m-d', strtotime($orderDetails['created_at'])) }}</td>
                                            <td style="background: rgb(156 236 35)">{{ $orderDetails['order_status'] }}
                                            </td>
                                            <td>{{ $orderDetails['grand_total'] }}</td>
                                            <td>{{ $orderDetails['shipping_charges'] }}</td>
                                            <td>
                                                @if (!empty($orderDetails['coupon_code']))
                                                    {{ $orderDetails['coupon_code'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($orderDetails['coupon_amount']))
                                                    {{ $orderDetails['coupon_amount'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $orderDetails['payment_method'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Information</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails['order_products'] as $product)
                                            <tr>
                                                <td>
                                                    <?php
                                                    $getProductImage = Product::getProductImage($product['product_id']);
                                                    ?>
                                                    <img style="width: 100px;"
                                                        src="{{ asset('uploads/product_img_small/' . $getProductImage['image']) }}"
                                                        alt="{{ $product['product_name'] }}">
                                                </td>
                                                <td>{{ $product['product_name'] }}</td>
                                                <td>{{ $product['product_code'] }}</td>
                                                <td>{{ $product['product_color'] }}</td>
                                                <td>{{ $product['product_size'] }}</td>
                                                <td>{{ $product['product_qty'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delivery Address and Custoemr Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Zip</th>
                                            <th>Mobile</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $orderDetails['name'] }}</td>
                                            <td>{{ $orderDetails['email'] }}</td>
                                            <td>{{ $orderDetails['address'] }}</td>
                                            <td>{{ $orderDetails['country'] }}</td>
                                            <td>{{ $orderDetails['state'] }}</td>
                                            <td>{{ $orderDetails['city'] }}</td>
                                            <td>{{ $orderDetails['zip_code'] }}</td>
                                            <td>{{ $orderDetails['mobile'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="messageDiv">
                            @include('admin.partials.message')
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Order Status</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                @if ($orderDetails['order_status'] != 'Delivered')
                                    <form id="order_status" class="form-inline" action="{{ url('sadmin/update-order-status') }}"
                                        method="post">@csrf
                                        <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                                        <div class="form-group mx-sm-3 mb-2 mt-2">
                                            <select class="form-control" name="order_status" required>
                                                <option>Select new</option>
                                                @foreach ($orderStatuses as $status)
                                                <option value="{{ $status['name'] }}"
                                                    @if (isset($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name'])
                                                    selected
                                                    @endif>
                                                    {{ $status['name'] }}
                                                </option>
                                                @endforeach
                                            </select> &nbsp;
                                            <input type="text" style="width: 120px;" @if (empty($orderDetails['courier_name'])) id="courier_name" @endif name="courier_name" value="{{ $orderDetails['courier_name'] }}" class="form-control" placeholder="Courier name"> &nbsp;
                                            <input type="text" style="width: 150px;" @if (empty($orderDetails['tracking_number'])) id="tracking_number" @endif name="tracking_number" value="{{ $orderDetails['tracking_number'] }}" class="form-control" placeholder="Tracking number">
                                        </div>
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </form>
                                @endif
                            </div>
                            @if (count($orderLog))
                                <div class="card-body p-0">
                                    <div class="form-group mx-sm-3 mb-2 mt-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Order Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderLog as $log)
                                                    <tr>
                                                        <td>{{ $log['order_status'] }}</td>
                                                        <td>
                                                            {{ date('F j, Y g:i a', strtotime($log['created_at'])) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop
<!-- External javascript -->
{{-- @section('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.messageDiv').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        });
    </script>
@endsection --}}
