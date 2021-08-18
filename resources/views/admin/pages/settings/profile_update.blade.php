@extends('admin.layouts.master')
@section('title')
    Settings
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
                        <h1 class="m-0">Update profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ url('admin/profile-update') }}">Update profile</a>
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
                                <h3 class="card-title">Update profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="{{ url('sadmin/profile-update') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control rounded-0"
                                                value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">User Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control rounded-0"
                                                value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control rounded-0" id="name"
                                                value="{{ Auth::guard('admin')->user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-3 col-form-label">Mobile No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mobile" class="form-control rounded-0" id="mobile"
                                                value="{{ Auth::guard('admin')->user()->mobile }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="customFile">Choose Photo</label>
                                                <input type="file" class="custom-file-input" id="customFile" name="image"
                                                    accept="image/*">
                                            </div>
                                            @if (!@empty(Auth::guard('admin')->user()->image))
                                                <img style="width: 80px; height: 80px; margin-top:5px;"
                                                    class="rounded float-right"
                                                    src="{{ url('storage/admin/' . Auth::guard('admin')->user()->image) }}"
                                                    alt="Admin Image">
                                                <input type="hidden" name="current_image"
                                                    value="{{ !empty(Auth::guard('admin')->user()->image) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info rounded-0">Update</button>
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
