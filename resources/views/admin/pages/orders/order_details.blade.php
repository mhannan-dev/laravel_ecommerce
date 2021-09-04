<?php
    use App\Models\Product;
?>
@extends('admin.layouts.master')
@section('title')
Product Sections
@endsection
@section('styles')
<style>
    a {
        color: #5da1eb;
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Order Status</th>
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
                                        <td>{{ $orderDetails['order_status'] }}</td>
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
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">Delivery Address</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $orderDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $orderDetails['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $orderDetails['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>{{ $orderDetails['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $orderDetails['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td>{{ $orderDetails['zip_code'] }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td>{{ $orderDetails['mobile'] }}</td>
                                </tr>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Color</th>
                                        <th scope="col">Product Size</th>
                                        <th scope="col">Product Quantity</th>
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
                                                src="{{ asset('uploads/product_img_small/'.$getProductImage['image']) }}"
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
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
<!-- External javascript -->
@section('scripts')

@endsection
