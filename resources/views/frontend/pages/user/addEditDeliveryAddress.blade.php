@extends('frontend.layouts.front_app')
@section('title')
    User Product Delivery Address
@endsection
@section('styles')
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Add Delivery Address</li>
        </ul>
        <h3>Add Delivery Address</h3>
        @include('frontend.partials.flash_msg')
        <div class="well">
            <form class="form-horizontal" action="{{ url('add-edit-delivery-address', $address['id']) }}" method="POST">
                @csrf
                <h4>Your address</h4>
                <div class="control-group">
                    <label class="control-label" for="name">First name <sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="name" name="name" placeholder="First Name"
                            value="{{ old('name', $address['name']) }}">
                        @if ($errors->has('name'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="country">Country<sup>*</sup></label>
                    <div class="controls">
                        <select id="country" name="country">
                            <option value="" disabled>-</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="state">State<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="state" placeholder="State">
                        @if ($errors->has('state'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="city">City<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="city" id="city" value="{{ old('city', $address['city']) }}">
                        <!--/ Districts Section-->
                        @if ($errors->has('city'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div class="control-group">
                    <label class="control-label" for="phone">Mobile<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" name="mobile" id="mobile" placeholder="Mobile" value="{{ old('mobile', $address['mobile']) }}">
                        @if ($errors->has('mobile'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="address">Address<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="address" name="address" placeholder="Adress" value="{{ old('address', $address['address']) }}">
                        @if ($errors->has('address'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="postcode">Zip / Postal Code<sup>*</sup></label>
                    <div class="controls">
                        <input type="text" id="zip_code" name="zip_code" placeholder="Zip/Postal Code" value="{{ old('zip_code', $address['zip_code']) }}">
                        @if ($errors->has('zip_code'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-large btn-success" type="submit" value="{{ $buttonText }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
