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
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <a href="{{ route('coupon.create') }}" class="btn btn-success float-right">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial No.</th>
                                            <th>Coupon code</th>
                                            <th>Coupon type</th>
                                            <th>Expiry Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $key => $coupon)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $coupon['coupon_code'] }}</td>
                                                <td>{{ $coupon['coupon_type'] }}</td>
                                                <td>{{ $coupon['expiry_date'] }}</td>
                                                <td>{{ $coupon['amount'] }}</td>
                                                <td>@if ($coupon['status'] == 1 )
                                                    <a title="Change" coupon_id="{{ $coupon['id'] }}" class="text-success coupon_status" id="coupon_{{ $coupon['id'] }}" href="javascript:void(0)"> Active
                                                    </a>
                                                    @else
                                                    <a title="Change" coupon_id="{{ $coupon['id'] }}" class="coupon_status text-danger" id="coupon_{{ $coupon['id'] }}" href="javascript:void(0)"> In Active
                                                    </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('coupon.edit', $coupon['id']) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form style="display: inline-block" action="{{ route('coupon.destroy', $coupon['id']) }}" class="form-delete" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
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
        $(".coupon_status").click(function() {
            var status = $(this).text();
            var coupon_id = $(this).attr("coupon_id");
            $.ajax({
                type: 'post',
                url: '/sadmin/update-coupon-status',
                data: {
                    status: status,
                    coupon_id: coupon_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#coupon_" + coupon_id).html(
                            "<a href='javascript:void(0)' class='coupon_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#coupon_" + coupon_id).html(
                            "<a href='javascript:void(0)' class='coupon_status'>Active</a>"
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

