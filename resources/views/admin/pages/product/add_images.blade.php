@extends('admin.layouts.master')
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
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.message')
                    <form action="{{ route('add.images',$product_data['id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                {{ $title }}
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="product_id" value="{{ $product_data['id'] }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name </label>
                                            {{ $product_data['title'] }}
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Produce Code</label>
                                            {{ $product_data['code'] }}
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Produce Color</label>
                                            {{ $product_data['color'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img style="height:150px;" src="{{ asset('uploads/product_img_large/'.$product_data['image']) }}" alt="{{ $product_data['title'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="file" name="images[]" multiple />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mt-4">Add {{ $title }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="" method="post"> @csrf
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($product_data['images']))
                                    @foreach ($product_data['images'] as $key => $prd_image)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            <img style="height:150px;" src="{{ asset('uploads/product_img_medium/'.$prd_image['images']) }}">
                                        </td>
                                        <td>
                                            @if ($prd_image['status'] == 1 )
                                            <a prd_image_id="{{ $prd_image['id'] }}" class="prd_image_status text-success" id="product_{{ $prd_image['id'] }}" href="javascript:void(0)">
                                                Active
                                            </a>
                                            @else
                                            <a prd_image_id="{{ $prd_image['id'] }}" class="prd_image_status" id="prd_image_{{ $prd_image['id'] }}" href="javascript:void(0)">
                                                In Active
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/delete-product-image', $prd_image['id']) }}" class="delete-confirm">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center"> Opps!!, {{$title}} Not found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mt-4">Update {{ $title }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        //Update attribute status
        $(".prd_image_status").click(function() {
            var status = $(this).text();
            var prd_image_id = $(this).attr("prd_image_id");
            $.ajax({
                type: 'post',
                url: '/admin/update-image-status',
                data: {
                    status: status,
                    prd_image_id: prd_image_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#prd_image_" + prd_image_id).html(
                            "<a href='javascript:void(0)' class='prd_image_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#prd_image_" + prd_image_id).html(
                            "<a href='javascript:void(0)' class='prd_image_status'>Active</a>"
                        )
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        });
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
