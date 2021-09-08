<?php
    use App\Models\Product;
?>
@extends('frontend.layouts.front_app')
@section('title')
    Order Details
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Order Details</li>
        </ul>
        <h3>{{ $title }} ID#{{ $orderDetails['id'] }}</h3>
        <hr class="soft">
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
                    <th scope="col">Courier</th>
                    <th scope="col">Tracking number</th>
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
                    <td>{{ $orderDetails['courier_name'] }}</td>
                    <td>{{ $orderDetails['tracking_number'] }}</td>
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
@endsection
@section('scripts')
    <script>
    </script>
@endsection
