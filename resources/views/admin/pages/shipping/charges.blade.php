@extends('admin.layouts.master')
@section('title')
    eCommerce shippingCharge Management
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
                                <a href="{{ url('sadmin/add-edit-shipping-charge') }}"
                                    class="btn btn-success float-right">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Country/Location</th>
                                            <th>Max 500gm</th>
                                            <th>Max 1000gm</th>
                                            <th>Max 2000gm</th>
                                            <th>Above 5000gm</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippingCharges as $key => $shippingCharge)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $shippingCharge['country_name'] }}</td>
                                                <td>BDT. {{ $shippingCharge['till_500gm'] }}</td>
                                                <td>BDT. {{ $shippingCharge['till_1000gm'] }}</td>
                                                <td>BDT. {{ $shippingCharge['till_2000gm'] }}</td>
                                                <td>BDT. {{ $shippingCharge['above_5000gm'] }}</td>

                                                <td>
                                                    @if ($shippingCharge['status'] == 1)
                                                        <a title="Change" shipping_id="{{ $shippingCharge['id'] }}"
                                                            class="text-success shipping_status"
                                                            id="shipping_{{ $shippingCharge['id'] }}"
                                                            href="javascript:void(0)">
                                                            Active
                                                        </a>
                                                    @else
                                                        <a title="Change" shipping_id="{{ $shippingCharge['id'] }}"
                                                            class="shipping_status text-danger"
                                                            id="shipping_{{ $shippingCharge['id'] }}"
                                                            href="javascript:void(0)"> In
                                                            Active
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ url('sadmin/edit-shipping-charge/' . $shippingCharge['id']) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#deleteModal{{ $shippingCharge['id'] }}" data-toggle="modal"
                                                        class="btn btn-sm btn-danger btn-sm">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade"
                                                        id="deleteModal{{ $shippingCharge['id'] }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Are
                                                                        sure
                                                                        to delete?</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ url('sadmin/delete-shipping-charge', $shippingCharge['id']) }}"
                                                                        method="post">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Permanent Delete</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                </td>
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
    <script type="text/javascript">
        //Jquery ready function
        $(document).ready(function() {
            $(".shipping_status").click(function() {
                var status = $(this).text();
                var shipping_id = $(this).attr("shipping_id");
                $.ajax({
                    type: 'post',
                    url: '/sadmin/update-shipping-charge-status',
                    data: {
                        status: status,
                        shipping_id: shipping_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#shipping_" + shipping_id).html(
                                "<a href='javascript:void(0)' class='shipping_status'>In Active</a>"
                            )
                        } else if (resp['status'] == 1) {
                            $("#shipping_" + shipping_id).html(
                                "<a href='javascript:void(0)' class='shipping_status'>Active</a>"
                            )
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });
        });
    </script>
@endsection
