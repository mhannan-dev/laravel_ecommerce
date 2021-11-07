@php
use App\Models\Category;
@endphp
@extends('admin.layouts.master')
@section('title')
    Dashboard-Web Blogs
@endsection
@section('styles')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                        <!-- /.card -->
                        <div class="card">
                            <!-- form start -->
                            <form class="form-horizontal" action="{{ url('sadmin/add-edit-admin', $adminData['id']) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control rounded-0" id="name"
                                                value="{{ old('email', $adminData['name']) }}"
                                                placeholder="Admin/Subadmin name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" @if (isset($adminData['id'])) disabled="" @else required="" @endif class="form-control rounded-0"
                                                name="email" placeholder="Email ID"
                                                value="{{ old('email', $adminData['email']) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Admin Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control rounded-0" id="type" name="type"
                                                @if (isset($adminData['id'])) disabled="" @else required="" @endif>
                                                <option value="">Select type</option>
                                                <option value="admin" @if ($adminData['type'] == 'admin') selected="" @endif>
                                                    Admin
                                                </option>
                                                <option value="sub-admin" @if ($adminData['type'] == 'sub-admin') selected @endif>
                                                    Sub-Admin
                                                </option>
                                                <option value="operator" @if ($adminData['type'] == 'operator') selected @endif>
                                                    Operator
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-3 col-form-label">Mobile No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mobile" class="form-control rounded-0" id="mobile"
                                                placeholder="Enter mobile no"
                                                value="{{ old('mobile', $adminData['mobile']) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" class="form-control rounded-0" id="password"
                                                @if (!empty($adminData['password']))
                                            value="{{ $adminData['password'] }}"
                                        @else
                                            value="{{ old('password') }}"
                                            @endif placeholder="Enter password">
                                            {{-- <input type="text" name="password" class="form-control rounded-0" id="password"
                                                value="{{ old('password', $adminData['password']) }}"
                                                placeholder="Enter password"> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <label for="password" class="col-sm-3 col-form-label">Photo</label>
                                            <input type="file" name="image" accept="image/*">
                                            {{-- <div class="custom-file">
																								<label class="custom-file-label" for="customFile">Choose Photo</label>
                                                <input type="file" class="custom-file-input" id="customFile" name="image"
                                                    accept="image/*">
                                            </div> --}}
                                            @if (!empty($adminData['image']))
                                                <img style="width: 80px; height: 80px; margin-top:5px;"
                                                    class="rounded float-right"
                                                    src="{{ url('storage/admin/' . $adminData['image']) }}"
                                                    alt="{{ $adminData['image'] }}">
                                                <input type="hidden" name="current_image"
                                                    value="{{ $adminData['image'] }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info rounded-0">{{ $buttonText }}</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
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
