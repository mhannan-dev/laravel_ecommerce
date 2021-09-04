@extends('frontend.layouts.front_app')
@section('title')
    User Account
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">{{ $title }}</li>
        </ul>
        <h3>{{ $title }}</h3>
        <hr class="soft">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Order ID</th>
                        <th scope="col">Order products</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    <tr>

                        <td>{{ $order['id'] }}</td>
                        <td>
                            @foreach ($order['order_products'] as $prod)
                                {{ $prod['product_code'] }} <br>
                            @endforeach
                        </td>
                        <td>{{ $order['payment_method'] }}</td>
                        <td>{{ $order['grand_total'] }}</td>
                        <td>{{ date('Y-m-d', strtotime($order['created_at'])) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    </script>
@endsection
