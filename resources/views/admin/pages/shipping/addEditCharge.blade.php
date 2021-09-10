@extends('admin.layouts.master')
@section('title')
    Add Shipping Charge - Dashboard
@endsection
@section('styles')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ URL('backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
                                <form  method="POST" action="{{ url('sadmin/add-edit-shipping-charge',$charge['id']) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="countries">Shipping Place</label> <br>
                                                <input type="text" name="countries" class="form-control {{ $errors->has('countries') ? 'is-invalid' : '' }}" placeholder="Shipping place" value="{{ old('countries', $charge->countries) }}">
                                                @if ($errors->has('countries'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('countries') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="shipping_charges">Shipping Charge</label> <br>
                                                <input type="number" placeholder="Shipping charges" name="shipping_charges" value="{{ old('shipping_charges', $charge->shipping_charges) }}" class="form-control {{ $errors->has('shipping_charges') ? 'is-invalid' : '' }}">
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
