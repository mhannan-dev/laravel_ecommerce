@extends('admin.layouts.master')
@section('title')
    eCommerce Coupon Management
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
                        <h1>Catalogues</h1>
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
                @include('admin.partials.message')
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <a href="{{ url('sadmin/add-edit-coupon') }}" class="btn btn-success float-right">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $order['id'] }}</td>
                                            <td>{{ date('Y-m-d', strtotime($order['created_at'])) }}</td>
                                            <td>{{ $order['name'] }}</td>
                                            <td>{{ $order['email'] }}</td>
                                            <td>
                                                @foreach ($order['order_products'] as $pro)
                                                    {{ $pro['product_code'] }} <span class="badge badge-warning">({{ $pro['product_qty'] }})</span><br>
                                                @endforeach
                                            </td>
                                            <td>{{ $order['grand_total'] }}</td>
                                            <td><span class="badge badge-success">{{ $order['order_status'] }}</span></td>
                                            <td title="Cash On Delivery">{{ $order['payment_method'] }}</td>
                                            <td><a href="{{ route('sadmin.orderDetails',$order['id']) }}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
@section('scripts')

@endsection
