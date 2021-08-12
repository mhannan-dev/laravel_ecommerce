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
            <li class="active">Forgot Password</li>
        </ul>
        <h3>Forgot Password / Login</h3>
        @include('frontend.partials.flash_msg')
        <hr class="soft">
        <div class="row">

            <div class="span4">

                <div class="well">
                    <h5>Reset your password</h5><br>
                    Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br><br><br>
                    <form id="quickForm" method="post" action="{{ url('forgot-password') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="span3" id="email"
                                placeholder="Please Enter Your Email" value="{{ old('email') }}"> <br>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn">Submit</button>
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
                                <button type="submit" class="btn">Sign in</button> <a href="{{ url('/forgot-password') }}">Forget
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

@endsection
