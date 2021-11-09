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
                            <form id="admin_form" class="form-horizontal"
                                action="{{ url('sadmin/add-edit-admin', $adminData['id']) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control rounded-0" id="name"
                                                placeholder="Admin/Subadmin name" @if (!empty($adminData['name']))
                                            value="{{ $adminData['name'] }}"
                                        @else
                                            value="{{ old('name') }}"
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input @if ($adminData['id'] != '') disabled="" @else required="" @endif type="email" class="form-control rounded-0"
                                                name="email" placeholder="Email ID" @if (!empty($adminData['email']))
                                            value="{{ $adminData['email'] }}"
                                        @else
                                            value="{{ old('email') }}"
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Admin Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control rounded-0" id="type" name="type"
                                                @if ($adminData['id'] != '') disabled="" @else required="" @endif>
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
                                                placeholder="Enter mobile no" @if (!empty($adminData['mobile']))
                                            value="{{ $adminData['mobile'] }}"
                                        @else
                                            value="{{ old('mobile') }}"
                                            @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input placeholder="Enter password" type="password" name="password"
                                                class="form-control rounded-0" id="password">
                                            {{-- <input placeholder="Enter password" type="password" name="password"
                                                class="form-control rounded-0" id="password" @if (!empty($adminData['password']))
                                            value="{{ $adminData['password'] }}"
                                        @else
                                            value="{{ old('password') }}"
                                            @endif> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-8">
                                            <label for="password" class="col-sm-3 col-form-label">Photo</label>
                                            <input type="file" name="image" accept="image/*">
                                            @if (!empty($adminData['image']))
                                                <img style="width: 80px; height: 80px; margin-top:5px;"
                                                    class="rounded float-right"
                                                    src="{{ url('uploads/admin_photos/' . $adminData['image']) }}"
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
@section('scripts')
    <script type="text/javascript">
        //Jquery ready function
        $(document).ready(function() {
            //$('#admin_form').validate({
            //    rules: {
            //        name: {
            //            required: true,
            //            name: true
            //        },
            //        email: {
            //            required: true,
            //            email: true,
            //        },
            //        mobile: {
            //            required: true,
            //            minlength: 10
            //        },
            //        password: {
            //            required: true,
            //            minlength: 5
            //        }
            //    },
            //    messages: {
            //        name: {
            //            required: "Please enter a name",
            //            name: "Please enter a name"
            //        },
            //        email: {
            //            required: "Please enter a email address",
            //            email: "Please enter a vaild email address"
            //        },
            //        password: {
            //            required: "Please provide a password",
            //            minlength: "Your password must be at least 5 characters long"
            //        },
            //        mobile: {
            //            required: "Please provide mobile number",
            //            minlength: "Your mobile number must be at least 10"
            //        }
            //    },
            //    errorElement: 'span',
            //    errorPlacement: function(error, element) {
            //        error.addClass('invalid-feedback');
            //        element.closest('.form-group').append(error);
            //    },
            //    highlight: function(element, errorClass, validClass) {
            //        $(element).addClass('is-invalid');
            //    },
            //    unhighlight: function(element, errorClass, validClass) {
            //        $(element).removeClass('is-invalid');
            //    }
            //});
        });
    </script>
@endsection
