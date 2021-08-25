@extends('frontend.layouts.front_app')
@section('title')
    Product Cart
@endsection
@section('content')
    <!-- Sidebar end=============================================== -->
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3> SHOPPING CART [ <small> <span class="totalCartItems">{{ totalCartItems() }} </span> Item(s) </small>]<a href="{{ url('/') }}"
                class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
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
                                <button type="submit" class="btn">Sign in</button> OR
                                <a href="{{ url('login-register') }}" class="btn">Register Now!</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <a href="#" style="text-decoration:underline">Forgot password ?</a>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
        <div id="AppendCartItems">
            @include('frontend.pages.products.cart_items')
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <form id="applyCoupon" action="javascript:void(0)" class="form-horizontal" method="post" @if (Auth::check()) user="1" @endif>
                            @csrf
                            <div class="control-group">
                                <label class="control-label"><strong> COUPON CODE: </strong> </label>
                                <div class="controls">
                                    <input type="text" class="input-medium" name="code" id="code" placeholder="Ente a coupon" required>
                                    <button type="submit" class="btn"> Apply </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="{{ url('checkout') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
    </div>
@endsection
