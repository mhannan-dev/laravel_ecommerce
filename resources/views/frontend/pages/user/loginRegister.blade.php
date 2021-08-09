@extends('frontend.layouts.front_app')
@section('title')
    User login and registration
@endsection
@section('styles')
    <style>
        span.error.invalid-feedback {
            color: #f41616;
        }

        span.text-danger {
            color: #f21818;
        }

    </style>
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Login</li>
        </ul>
        <h3>Login / Registration</h3>
        @include('frontend.partials.flash_msg')
        <hr class="soft">
        <div class="row">

            <div class="span4">

                <div class="well">
                    <h5>CREATE YOUR ACCOUNT</h5><br>
                    Fill in the forom to create an account.<br><br><br>
                    <form id="quickForm" method="post" action="{{ url('register-user') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="span3" id="name" placeholder="Enter Full Name"
                                value="{{ old('name') }}"><br>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="span3" id="email" placeholder="Enter Valid Email"
                                value="{{ old('email') }}"> <br>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="span3" id="mobile" placeholder="Enter Valid Mobile No"
                                value="{{ old('mobile') }}"> <br>
                            @if ($errors->has('mobile'))
                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="span3" id="password"
                                placeholder="Please Enter Secure Password" value="{{ old('password') }}"> <br>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create Your Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">

                    <h5>ALREADY REGISTERED ?</h5>

                    <form id="loginForm" action="{{ url('/login-user') }}" method="post"> @csrf
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="span3" id="email" placeholder="Enter Valid Email"
                                value="{{ old('email') }}"> <br>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="span3" id="password"
                                placeholder="Please Enter Secure Password" value="{{ old('password') }}"> <br>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Sign in</button> <a href="forgetpass.html">Forget
                                    password?</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            // Registration form validation
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                        name: true,
                    },
                    mobile: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                        digits: true,
                        //remote:"check-mobile" // check-mobile is laravel  route
                    },
                    email: {
                        required: true,
                        email: true,
                        remote:"check-email" // check-email is laravel  route
                    },
                    password: {
                        required: true,
                        minlength: 8
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
