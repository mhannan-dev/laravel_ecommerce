@extends('frontend.layouts.front_app')
@section('title')
    Welcome for placing order
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="">Home</a> <span class="divider">/</span></li>
            <li class="active">{{ $title }}</li>
        </ul>
        <h3> {{ $title }}</h3>
        <hr class="soft">
        <div id="legalNotice">
            <h3>Your order has been placed successfully!</h3><br>
            <p>
                Your order number is <strong>{{ Session::get('order_id') }}</strong> and total payable amount is <strong>{{ Session::get('grand_total') }}</strong>
            </p>
            <p>Please make payment by clicking button</p>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="text" name="cmd" value="_xclick">
                <input type="text" name="business" value="sb-g39sf7688335@business.example.com">
                <input type="text" name="currency_code" value="USD">
                <input type="text" name="item_name" value="{{ Session::get('order_id') }}">
                <input type="text" name="amount" value="{{ round(Session::get('grand_total'),2 ) }}">
                <input type="text" name="first_name" value="{{ $nameArr[0] }}">
                <input type="text" name="last_name" value="{{ $nameArr[1] }}">
                <input type="text" name="address1" value="{{ $orderDetails['address'] }}">
                <input type="text" name="address2" value="">
                <input type="text" name="city" value="{{ $orderDetails['city'] }}">
                <input type="text" name="state" value="{{ $orderDetails['state'] }}">
                <input type="text" name="zip" value="{{ $orderDetails['zip_code'] }}">
                <input type="text" name="email" value="{{ $orderDetails['email'] }}">
                <input type="text" name="country" value="{{ $orderDetails['country'] }}">
                <input type="image" name="submit"
                  src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
                  alt="PayPal - The safer, easier way to pay online">
              </form>
        </div>
    </div>
@endsection
<?php
    // Session::forget('grand_total');
    // Session::forget('order_id');
    // Session::forget('couponAmount');
    // Session::forget('couponCode');
?>
