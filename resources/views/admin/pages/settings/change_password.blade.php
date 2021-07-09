@extends('admin.layouts.master')
@section('title')
Change password
@endsection
@section('styles')
@endsection
@section('content')
<div class="content-wrapper" style="min-height: 194px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}
                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            <a href="{{ url('admin/settings/change-password') }}">{{ $title }}</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('update_current_pwd') }}" method="post">
                           @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="username" class="form-control rounded-0"
                                            value="{{ $adminDetails->email }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user_type" class="col-sm-3 col-form-label">User Type</label>
                                    <div class="col-sm-10">
                                        <input type="username" class="form-control rounded-0"
                                            value="{{ $adminDetails->type }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="current_pwd" class="col-sm-3 col-form-label">Current password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" class="form-control rounded-0"
                                            id="current_password" placeholder="Enter current password">
                                        <span id="check_current_password"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control rounded-0"
                                            id="new_password" placeholder="Enter new password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="again_new_password" class="form-control rounded-0"
                                            id="again_new_password" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info rounded-0">Update Password</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
<!-- External javascript -->
@section('scripts')
<script type="text/javascript">
    //Jquery ready function
    $(document).ready(function () {
        //Current password checking
        $("#current_password").keyup(function () {
            var current_password = $("#current_password").val();
            $.ajax({
                type: 'POST',
                url: '/admin/check-current-pwd',
                data: {
                    current_password: current_password
                },
                success: function (resp) {
                    if (resp == "false") {
                        $("#check_current_password").html(
                            "<font color=red>Current passsword is wrong</font>")
                    } else if (resp == "true") {
                        $("#check_current_password").html(
                            "<font color=green>Current passsword is correct</font>")
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
</script>
@endsection
