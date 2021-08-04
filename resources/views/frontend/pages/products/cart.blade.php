<?php
use App\Models\Cart;
use App\Models\Product;
?>
@extends('frontend.layouts.front_app')
@section('content')
    <!-- Sidebar end=============================================== -->
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3> SHOPPING CART [ <small>3 Item(s) </small>]<a href="products.html" class="btn btn-large pull-right"><i
                    class="icon-arrow-left"></i> Continue Shopping </a></h3>
        <hr class="soft" />
        <table class="table table-bordered">
            <tr>
                <th> I AM ALREADY REGISTERED </th>
            </tr>
            <tr>
                <td>
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="inputUsername">Username</label>
                            <div class="controls">
                                <input type="text" id="inputUsername" placeholder="Username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword1">Password</label>
                            <div class="controls">
                                <input type="password" id="inputPassword1" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Sign in</button> OR <a href="register.html"
                                    class="btn">Register Now!</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Description</th>
                    <th>Quantity/Update</th>
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
                    //$attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    //dd($attrPrice['price']);
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
                            <div class="input-append">
                                <input class="span1" style="max-width:34px" value="{{ $item['quantity'] }}"
                                    id="appendedInputButtons" size="16" type="text">
                                <button class="btn" type="button"><i class="icon-minus"></i></button>
                                <button class="btn" type="button"><i class="icon-plus"></i></button>
                                <button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>
                            </div>
                        </td>
                        <td>BDT. {{ $attrPrice['price'] }}</td>
                        <td>BDT. {{ $attrPrice['discount'] }}</td>
                        <td>BDT. {{ $attrPrice['final_price'] * $item['quantity'] }}</td>
                    </tr>
                    <?php
                    $sub_total_price = $sub_total_price + $attrPrice['final_price'] * $item['quantity'];
                    $total_discount = $total_discount + $attrPrice['discount'];
                    $total_price = $sub_total_price - $total_discount;
                    ?>
                @endforeach
                <tr>
                    <td colspan="5" style="text-align:right">Sub Total Price: </td>
                    <td> BDT. {{ $sub_total_price }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right">Voucher Discount: </td>
                    <td> BDT. {{  $total_discount }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right"><strong>GRAND TOTAL (BDT. {{ $sub_total_price }} - BDT. {{ $total_discount }}) =</strong></td>
                    <td class="label label-important" style="display:block"> <strong> BDT. {{ number_format($total_price, 2) }} </strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <form class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><strong> VOUCHERS CODE: </strong> </label>
                                <div class="controls">
                                    <input type="text" class="input-medium" placeholder="CODE">
                                    <button type="submit" class="btn"> ADD </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <table class="table table-bordered">
                       <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
                       <tr>
                       <td>
                        <form class="form-horizontal">
                        <div class="control-group">
                         <label class="control-label" for="inputCountry">Country </label>
                         <div class="controls">
                         <input type="text" id="inputCountry" placeholder="Country">
                         </div>
                        </div>
                        <div class="control-group">
                         <label class="control-label" for="inputPost">Post Code/ Zipcode </label>
                         <div class="controls">
                         <input type="text" id="inputPost" placeholder="Postcode">
                         </div>
                        </div>
                        <div class="control-group">
                         <div class="controls">
                         <button type="submit" class="btn">ESTIMATE </button>
                         </div>
                        </div>
                        </form>
                       </td>
                       </tr>
                                </table> -->
        <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="login.html" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
    </div>
@endsection
