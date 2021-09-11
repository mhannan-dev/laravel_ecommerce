@extends('admin.layouts.master')
@section('title')
    Add Shipping Charge - Dashboard
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
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
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
                        @include('admin.partials.message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="shipping_form" action="{{ url('sadmin/edit-shipping-charge', $charge['id']) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="country">Shipping Place</label> <br>
                                                <input type="text" name="country"
                                                    class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                    placeholder="Shipping place"
                                                    value="{{ old('country', $charge['country']) }}" readonly>
                                                @if ($errors->has('country'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('country') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="shipping_charges">Shipping Charge</label> <br>
                                                <input type="number" placeholder="Shipping charges" name="shipping_charges"
                                                    value="{{ old('shipping_charges', $charge['shipping_charges']) }}"
                                                    class="form-control {{ $errors->has('shipping_charges') ? 'is-invalid' : '' }}">
                                                @if ($errors->has('shipping_charges'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('shipping_charges') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
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
    <!-- Page specific script -->
    <script>
        $(function() {
            $('#chargeForm').validate({
                rules: {
                    country: {
                        required: true,
                        minlength: 3,
                        //check-shipping-location is laravel route
                       remote: "check-shipping-area",
                    },
                    shipping_charges: {
                        required: true,
                        maxlength: 5,
                        digits: true,
                    },

                },
                messages: {
                    country: {
                        required: "Please enter valid location",
                        name: "Please enter valid location",
                        remote: "This is name is already exist"
                    },
                    shipping_charges: {
                        required: "Please enter shipping charge",
                        maxlength: "Shipping charge max consist of 5 digits",
                        digits: "Please enter only number",

                    }

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
