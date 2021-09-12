@extends('frontend.layouts.front_app')
@section('title')
    Welcome for placing order
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">{{ $title }}</li>
        </ul>
        <h3> {{ $title }}</h3>
        <hr class="soft">
        <div id="legalNotice">
            <h4>Your order has been placed successfully! Please check your associated email inbox/spam</h4><br>
            <p>
                Your order number is <strong>{{ Session::get('order_id') }}</strong> and payable grand total is <strong>{{ Session::get('grand_total') }}</strong>
            </p>
        </div>
    </div>
@endsection
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponAmount');
    Session::forget('couponCode');
?>
