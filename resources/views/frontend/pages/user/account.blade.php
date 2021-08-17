@extends('frontend.layouts.front_app')
@section('title')
    User Account
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
            <li class="active">{{ $title }}</li>
        </ul>
        @include('frontend.partials.flash_msg')
        <h3>{{ $title }}</h3>
        <hr class="soft">
        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>Contact Details</h5><br>
                    Your contact details<br><br><br>
                    <form id="accountForm" method="post" action="{{ url('account') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ $userDetails['name'] }}" type="text" name="name" class="span3" id="name"><br>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input value="{{ $userDetails['address'] }}" type="text" name="address" class="span3" id="address"><br>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input value="{{ $userDetails['country'] }}" type="text" name="country" class="span3" id="country"><br>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input value="{{ $userDetails['state'] }}" type="text" name="state" class="span3" id="state"><br>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input value="{{ $userDetails['city'] }}" type="text" name="city" class="span3" id="city"><br>
                        </div>
                        <div class="form-group">
                            <label for="pin_code">Pin code</label>
                            <input value="{{ $userDetails['pin_code'] }}" type="text" name="pin_code" class="span3" id="pin_code"><br>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input value="{{ $userDetails['mobile'] }}" type="text" name="mobile" class="span3" id="mobile"><br>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input value="{{ $userDetails['email'] }}" type="text" class="span3" id="email" readonly>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5>CHANGE PASSWORD</h5>
                    <form id="loginForm" action="{{ url('/login-user') }}" method="post"> @csrf
                        @csrf
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="span3" id="password"
                                placeholder="Please enter password"> <br>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password" class="span3" id="password"
                                placeholder="Please confirm password"> <br>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Update</button>
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
            $('#accountForm').validate({
                rules: {
                    name: {
                        required: true,
                        name: true,
                        accept: "[a-zA-z]+"
                    },
                    mobile: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                        digits: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter full name",
                        name: "Please enter full name"
                    },

                    mobile: {
                        required: "Please enter a mobile no",
                        mobile: "Please enter a mobile no",
                        minlength: "Your mobile must consist of 10 digits",
                        maxlength: "Your mobile max consist of 10 digits",
                        digits: "Please enter your valid mobile",
                        //remote: "This is mobile no is already exist"
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
