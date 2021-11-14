@extends('admin.layouts.master')
@section('title')
    eCommerce Admin - Dashboard
@endsection
@section('styles')
    <style>

    </style>
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
                @include('admin.partials.message')
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->


                        @if (count($minMaxCartVal) !== 1 )
                        <a type="button" href="{{ url('sadmin/add-edit-other-setting') }}" class="btn btn-success mb-2"><i
                            class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add New</a>
                        @endif
                       <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Min Value</th>
                                            <th>Max Value</th>
                                            <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($minMaxCartVal as $value)
                                            <tr>
                                                <td>{{ $value['min_value'] }}</td>
                                                <td>{{ $value['max_value'] }}</td>
                                                <td>
                                                    <a href="{{ url('sadmin/add-edit-other-setting', $value['id']) }}"
                                                        class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </table>
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
