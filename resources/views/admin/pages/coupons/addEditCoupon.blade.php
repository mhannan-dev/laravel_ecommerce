@extends('admin.layouts.master')
@section('title')
    New Coupon - Dashboard
@endsection
@section('styles')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL('backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
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
                        @include('admin.partials.message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form  method="POST" action="{{ url('sadmin/add-edit-coupon',$coupon['id']) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-3">
                                            @if (empty($coupon['coupon_code']))
                                                <div class="form-group">
                                                    <label for="coupon_option">Coupon option</label> <br>
                                                    <span>
                                                        <input value="automatic" type="radio" name="coupon_option"
                                                            id="automaticCoupon" checked>&nbsp;Automatic&nbsp;&nbsp;
                                                    </span>
                                                    <span>
                                                        <input value="manual" type="radio" name="coupon_option"
                                                            id="manualCoupon"> &nbsp;Manual&nbsp;&nbsp;
                                                    </span>
                                                </div>
                                                <div class="form-group" id="couponField" style="display: none">
                                                    <label for="coupon_code">Coupon code : </label>
                                                    <input type="text" name="coupon_code" class="form-control "
                                                        id="coupon_code" placeholder="Enter Coupon Code">
                                                </div>
                                                @if ($errors->has('coupon_option'))
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('coupon_option') }}</strong>
                                                    </span>
                                                @endif
                                            @else
                                            <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                                            <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                                                <div class="form-group" id="couponField">
                                                    <label for="coupon_code">Coupon code : </label>
                                                    <span>{{ $coupon['coupon_code'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="coupon_type">Coupon type</label> <br>
                                                <span>
                                                    <input @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'multipleTimes') checked @endif value="multipleTimes"
                                                        type="radio" name="coupon_type" id="multipleTimes" >&nbsp;Multiple
                                                    Times&nbsp;
                                                </span>
                                                <span>
                                                    <input value="singleTimes" type="radio" name="coupon_type"
                                                        id="singleTimes" checked @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'singleTimes') checked @endif> &nbsp;Single Times&nbsp;
                                                </span>
                                            </div>
                                            @if ($errors->has('coupon_type'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('coupon_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="amount_type">Amount type</label> <br>
                                                <span>
                                                    <input value="percentage" type="radio" name="amount_type"
                                                        id="percentage" @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'percentage') checked @endif>&nbsp;Percentage (In
                                                    %)&nbsp;&nbsp;
                                                </span>
                                                <span>
                                                    <input checked value="fixed" type="radio" name="amount_type" id="fixed" @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'fixed') checked @endif>
                                                    &nbsp;Fixed (In BDT.)&nbsp;&nbsp;
                                                </span>
                                            </div>
                                            @if ($errors->has('amount_type'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('amount_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount"
                                                    placeholder="Enter amount" required @if (isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif>
                                            </div>
                                            @if ($errors->has('amount'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">


                                            <div class="form-group">
                                                <label for="expiry_date">Expiry Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input name="expiry_date" type="text" class="form-control" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="yyyy/mm/dd" data-mask=""
                                                        inputmode="numeric" @if (isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @endif required>
                                                </div>
                                                <!-- /.input group -->
                                            </div>

                                            @if ($errors->has('expiry_date'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('expiry_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="categories">Select Categories</label>
                                                <select name="categories[]" id="categories" class="select2bs4"
                                                    multiple="multiple" data-placeholder="Select Categories"
                                                    style="width: 100%;" required>
                                                    <option value="">Select Categories</option>
                                                    @foreach ($categories as $section)
                                                        <optgroup label="{{ $section['title'] }}"></optgroup>
                                                        @foreach ($section['categories'] as $category)
                                                            <option value="{{ $category['id'] }}" @if (in_array($category['id'], $selCats)) selected="" @endif>
                                                                &nbsp;&#8594;&#8594;{{ $category['title'] }}</option>
                                                            @foreach ($category['subcategories'] as $subcategory)
                                                                &#8594;&#8594;&#8594;<option
                                                                    value="{{ $subcategory['id'] }}" @if (in_array($subcategory['id'], $selCats)) selected="" @endif>
                                                                    &nbsp;&#8594;&#8594;&#8594;{{ $subcategory['title'] }}
                                                                </option>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('categories'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('categories') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Select Users Emails</label>
                                                <select name="users[]" id="users" class="select2bs4" multiple="multiple"
                                                    data-placeholder="Select Emails" style="width: 100%;" required>
                                                    <option value="">Select Emails</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user['email'] }}" @if (in_array($user['email'], $selUsers)) selected="" @endif>
                                                            {{ $user['email'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('users'))
                                                <span class="alert alert-danger">
                                                    <strong>{{ $errors->first('users') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                                </form>
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
@endsection
