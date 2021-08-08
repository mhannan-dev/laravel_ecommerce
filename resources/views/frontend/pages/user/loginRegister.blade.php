@extends('frontend.layouts.front_app')
@section('title')
    User login and registration
@endsection
@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Login</li>
        </ul>
        <h3> Login</h3>
        <hr class="soft">
        <div class="row">
            <div class="span4">
                @include('frontend.partials.flash_msg')
                <div class="well">
                    <h5>CREATE YOUR ACCOUNT</h5><br>
                    Fill in the forom to create an account.<br><br><br>
                    <form id="user_reg_form" action="{{ url('/user-register') }}" method="post">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">Name</label>
                            <div class="controls">
                                <input class="span3" type="text" name="name" id="name" placeholder="Enter full name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">Mobile</label>
                            <div class="controls">
                                <input class="span3" type="text" name="mobile" id="mobile"
                                    placeholder="Enter mobile number">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">E-mail address</label>
                            <div class="controls">
                                <input class="span3" type="text" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">Password</label>
                            <div class="controls">
                                <input class="span3" type="password" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Create Your Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5>ALREADY REGISTERED ?</h5>
                    <form>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">Email</label>
                            <div class="controls">
                                <input class="span3" type="text" id="inputEmail1" placeholder="Email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword1">Password</label>
                            <div class="controls">
                                <input type="password" class="span3" id="inputPassword1" placeholder="Password">
                            </div>
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
@endsection
