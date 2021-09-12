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
                            <input value="{{ $userDetails['address'] }}" type="text" name="address" class="span3"
                                id="address"><br>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="span3" id="country" name="country">
                                <option disabled>Select country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['country_name'] }}" @if ($country['country_name'] == $userDetails['country']) selected="" @endif>{{ $country['country_name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input value="{{ $userDetails['state'] }}" type="text" name="state" class="span3"
                                id="state"><br>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input value="{{ $userDetails['city'] }}" type="text" name="city" class="span3" id="city"><br>
                        </div>
                        <div class="form-group">
                            <label for="zip_code">Pin code</label>
                            <input value="{{ $userDetails['zip_code'] }}" type="text" name="zip_code" class="span3"
                                id="zip_code"><br>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input value="{{ $userDetails['mobile'] }}" type="text" name="mobile" class="span3"
                                id="mobile"><br>
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
                    <form id="password_form" action="{{ url('/update-user-password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="span3" id="current_password"
                                placeholder="Please enter current password"> <br>
                            <span id="check_current_password"></span>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="span3" id="new_password"
                                placeholder="Please enter new password"> <br>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="span3" id="confirm_password"
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
            //Check current user password field
            $("#current_password").keyup(function() {
                var current_password = $(this).val();
                //alert(current_password);
                $.ajax({
                    type: 'POST',
                    url: '/check-user-password',
                    data: {
                        current_password: current_password
                    },
                    success: function(resp) {
                        //alert(resp);
                        if (resp == "false") {
                            $("#check_current_password").html(
                                "<font color=red>Current passsword is wrong</font>")
                        } else if (resp == "true") {
                            $("#check_current_password").html(
                                "<font color=green>Current passsword is correct</font>")
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });
            $('#password_form').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 6
                    },
                    new_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 8,
                        equalTo: "#new_password"
                    },
                },
                messages: {
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
        });
    </script>
@endsection
