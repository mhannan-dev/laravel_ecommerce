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
                                                value="" placeholder="Admin/Subadmin name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control rounded-0" value="" name="email" placeholder="Email ID">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Admin Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control rounded-0" id="type" name="type">
                                                <option value="">Select type</option>
                                                <option value="admin">Admin</option>
                                                <option value="sub-admin">Sub-Admin</option>
                                                <option value="operator">Operator</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-3 col-form-label">Mobile No</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mobile" class="form-control rounded-0" id="mobile"
                                                value="Enter mobile no">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" class="form-control rounded-0" id="password"
                                                value="{{ $adminData['password'] }}" placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
																						<label for="password" class="col-sm-3 col-form-label">Photo</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="customFile">Choose Photo</label>
                                                <input type="file" class="custom-file-input rounded-0" id="customFile" name="image"
                                                    accept="image/*">
                                            </div>
                                            {{-- @if (!@empty(Auth::guard('admin')->user()->image))
                                                <img style="width: 80px; height: 80px; margin-top:5px;"
                                                    class="rounded float-right"
                                                    src="{{ url('storage/admin/' . Auth::guard('admin')->user()->image) }}"
                                                    alt="Admin Image">
                                                <input type="hidden" name="current_image"
                                                    value="{{ !empty(Auth::guard('admin')->user()->image) }}">
                                            @endif --}}
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
