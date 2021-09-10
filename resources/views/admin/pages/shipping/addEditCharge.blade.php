@extends('admin.layouts.master')
@section('title')
    Add Shipping Charge - Dashboard
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
                                <form  method="POST" action="{{ url('sadmin/add-edit-shipping-charge',$charge['id']) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="countries">Shipping Place</label> <br>
                                                <input type="text" name="countries" class="form-control {{ $errors->has('countries') ? 'is-invalid' : '' }}" placeholder="Shipping place" value="{{ old('countries', $charge->countries) }}">
                                                @if ($errors->has('countries'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('countries') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="shipping_charges">Shipping Charge</label> <br>
                                                <input type="number" placeholder="Shipping charges" name="shipping_charges" value="{{ old('shipping_charges', $charge->shipping_charges) }}" class="form-control {{ $errors->has('shipping_charges') ? 'is-invalid' : '' }}">
                                                @if ($errors->has('shipping_charges'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('shipping_charges') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
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


@section('scripts')
    <script>
        $(function() {
            // Registration form validation
            $('#chargeForm').validate({
                rules: {
                    countries: {
                        required: true,
                        countries: true,
                        minlength: 3,
                        remote:"check-shipping-country" // check-shipping-country is laravel  route
                    },
                    mobile: {
                        required: true,
                        minlength: 2,
                        maxlength: 11,
                        digits: true,
                        //remote:"check-mobile" // check-mobile is laravel  route
                    },

                },
                messages: {
                    name: {
                        required: "Please enter full name",
                        name: "Please enter full name"
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a email address",
                        remote:"Email is already exist use email or login"
                    },
                    mobile: {
                        required: "Please enter a mobile no",
                        mobile: "Please enter a mobile no",
                        minlength: "Your mobile must consist of 10 digits",
                        maxlength: "Your mobile max consist of 10 digits",
                        digits: "Please enter your valid mobile",
                        //remote: "This is mobile no is already exist"

                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                },
                messages: {

                    email: {
                        required: "Please enter your email address",
                        email: "Please enter your email address"
                    },

                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection

