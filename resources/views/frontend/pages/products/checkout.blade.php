<?php
use App\Models\Product;

?>
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
        @include('frontend.partials.flash_msg')
        <hr class="soft" />
        <form name="checkOutForm" id="checkOutForm" action="{{ url('checkout') }}" method="post">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>
                        <strong>Delivery Address</strong> &nbsp;
                        <a href="{{ url('add-edit-delivery-address/') }}" class="btn" style="float:right;">Add
                            Address</a>
                    </th>
                </tr>
                @foreach ($deliveryAddress as $address)
                @php
                    $address
                @endphp
                    <tr>
                        <td>
                            <div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px;">
                                <input class="address_id" type="radio" id="address{{ $address['id'] }}" name="address_id"
                                    value="{{ $address['id'] }}" shipping_charges="{{ $address['shipping_charges'] }}"
                                    total_price="{{ $total_price }}" coupon_amount="{{ Session::get('couponAmount') }}">
                            </div>
                            <div class="control-group">
                                <label for="address" class="control-label">
                                    {{ $address['name'] }},
                                    {{ $address['address'] }},
                                    {{ $address['city'] }},
                                    {{ $address['state'] }},
                                    {{ $address['country'] }}
                                </label>
                            </div>
                        </td>
                        <td>
                            <a class="btn"
                                href="{{ url('add-edit-delivery-address/' . $address['id']) }}">Edit</a>
                            <a href="#deleteModal{{ $address['id'] }}" data-toggle="modal" class="btn btn-danger">
                                Delete
                            </a>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $address['id'] }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are sure
                                                to delete?</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('delete-delivery-address/' . $address['id']) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Permanent Delete</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                        </td>
                    </tr>
                @endforeach
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                                {{ $item['product']['title'] }} <strong> ({{ $item['product']['code'] }}) </strong>
                                <br />
                                Color : {{ $item['product']['color'] }} <br />
                                Size : {{ $item['size'] }}
                            </td>
                            <td style="text-align:right;">BDT. {{ $attrPrice['price'] * $item['quantity'] }}</td>
                            <td style="text-align:right;">BDT. {{ $attrPrice['discount']  * $item['quantity']}}</td>
                            <td style="text-align:right;">BDT. {{ $attrPrice['final_price'] * $item['quantity'] }}</td>
                        </tr>
                        <?php
                        $total_price = $total_price + $attrPrice['final_price'] * $item['quantity'];
                        ?>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align:right">Sub Total: </td>
                        <td style="text-align:right;"> BDT. {{ $total_price }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right">Coupon Discount: </td>
                        <td class="couponAmount" style="text-align:right;">
                            @if (Session::has('couponAmount'))
                                - BDT. {{ Session::get('couponAmount') }}
                            @else
                                BDT. 0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right">Shipping Charge: </td>
                        <td class="shipping_charges" style="text-align:right;"> BDT. 0 </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right">
                            {{-- <strong>GRAND TOTAL =(BDT. {{ $total_price }} - <span class="couponAmount">BDT. 0</span>)</strong> --}}
                            <strong>GRAND TOTAL =
                        </td>
                        <td class="label label-important" style="display:block;text-align:right">
                            <strong class="grand_total">
                                BDT. {{ $grand_total = $total_price - Session::get('couponAmount') }}
                            </strong>
                            <?php Session::put('grand_total', $grand_total); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><strong> Payment Method: </strong> </label>
                                <div class="controls">
                                    <input type="radio" name="payment_gateway" value="paypal" required> <strong
                                        class="btn disables">Paypal</strong>
                                    <input type="radio" name="payment_gateway" value="COD" required> <strong
                                        class="btn">Cash On Delivery</strong>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back To Cart</a>
            <button type="submit" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></button>
        </form>
    </div>
@endsection
