@extends('frontend.layouts.front_app')
@section('title')
    Product Cart
@endsection
@section('content')
    <!-- Sidebar end=============================================== -->
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"> CHECK OUT</li>
        </ul>
        <h3> CHECK OUT [ <small> <span class="totalCartItems">{{ totalCartItems() }} </span> Item(s) </small>]<a
                href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back To
                Cart</a></h3>
        <hr class="soft" />
        <table class="table table-bordered">
            <tr>
                <th> <strong>Delivery Address</strong> &nbsp; <a href="{{ url('/add-edit-delivery-address') }}"
                        class="btn" style="float:right;">Add Address</a>

                </th>
            </tr>
            @foreach ($deliveryAddress as $address_item)


                <tr>
                    <td>
                        <div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px;">
                            <input type="radio" id="address{{ $address_item['id'] }}" name="address_id"
                                value="{{ $address_item['id'] }}">
                        </div>
                        <div class="control-group">
                            <label for="" class="control-label">
                                {{ $address_item['name'] }},
                                {{ $address_item['address'] }},
                                {{ $address_item['city'] }},
                                {{ $address_item['state'] }},
                                {{ $address_item['country'] }}
                            </label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php
        use App\Models\Product;
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Quantity</th>

                    <th>Price</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sub_total_price = 0;
                $total_discount = 0;
                $total_price = 0;
                ?>
                @foreach ($userCartItems as $item)
                    <?php
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    //dd($attrPrice);
                    ?>
                    <tr>
                        <td>
                            <img style="width: 60px;"
                                src="{{ asset('uploads/product_img_small/' . $item['product']['image']) }}" alt="">
                        </td>
                        <td>
                            {{ $item['product']['title'] }} <strong> ({{ $item['product']['code'] }}) </strong> <br />
                            Color : {{ $item['product']['color'] }} <br />
                            Size : {{ $item['size'] }}
                        </td>
                        <td>
                            {{ $item['quantity'] }}
                        </td>
                        <td style="text-align:right;">BDT. {{ number_format($attrPrice['price'], 2) }}</td>
                        <td style="text-align:right;">BDT. {{ number_format($attrPrice['discount'], 2) }}</td>
                        <td style="text-align:right;">BDT.
                            {{ number_format($attrPrice['final_price'] * $item['quantity'], 2) }}</td>
                    </tr>
                    <?php
                    $sub_total_price = $sub_total_price + $attrPrice['final_price'] * $item['quantity'];
                    $total_discount = $total_discount + $attrPrice['discount'];
                    $total_price = $sub_total_price - $total_discount;
                    ?>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align:right">Sub Total Price: </td>
                    <td style="text-align:right;"> BDT. {{ number_format($sub_total_price, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right">Coupon Discount: </td>
                    <td class="couponAmount" style="text-align:right;">
                        @if (Session::has('couponAmount'))
                            -BDT. {{ Session::get('couponAmount') }}
                        @else
                            BDT. 0
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right"><strong>GRAND TOTAL =</strong></td>
                    <td class="label label-important grand_total" style="display:block;text-align:right"> <strong> BDT.
                            {{ number_format($total_price - Session::get('couponAmount'), 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <form id="applyCoupon" action="javascript:void(0)" class="form-horizontal" method="post"
                            @if (Auth::check()) user="1" @endif>
                            @csrf
                            <div class="control-group">
                                <label class="control-label"><strong> Payment Method: </strong> </label>
                                <div class="controls">
                                    <input type="radio" name="" id=""> Paypal
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back To Cart</a>
        <a href="{{ url('checkout') }}" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></a>
    </div>
@endsection
