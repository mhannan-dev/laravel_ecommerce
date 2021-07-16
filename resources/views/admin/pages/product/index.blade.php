@extends('admin.layouts.master')
@section('title')
Product product
@endsection
@section('styles')
<style>
    a {
        color: none;
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                            <a href="{{ route('product.create') }}" class="btn btn-success float-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Color</th>
                                        <th>Weight</th>
                                        <th>Discount</th>
                                        <th>Image</th>

                                        <th>Section</th>
                                        <th>Category</th>
                                        <th width="5%">Is Featured</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products))
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->color }}</td>
                                        <td>{{ $product->weight }}</td>
                                        <td>{{ number_format($product->discount_amt, 2) }}</td>
                                        <td>

                                            @if (!empty($product->image))
                                            <!-- <img style="width: 60px;"
                                                                src="{{ url('storage/product/' . $product->image) }}"
                                                                alt="{{ $product->title }}"> -->
                                            <img style="width: 60px;" src="{{ asset('uploads/product_img_medium/' . $product->image) }}" alt="{{ $product->title }}">





                                            @else
                                            <!-- <img style="width: 60px; border: 3px solid red" src="{{ url('/storage/product/no_image.png') }}" alt="No Image"> -->
                                            <img style="width: 60px;" src="{{ url('/storage/product/no_image.png') }}" alt="{{ $product->title }}">
                                            @endif
                                        </td>

                                        <td>{{ !empty($product->section) ? $product->section->title : '' }}
                                        </td>
                                        <td>{{ !empty($product->category) ? $product->category->title : '' }}
                                        </td>
                                        <td>{{ $product->is_featured }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                            <a product_id="{{ $product->id }}" class="product_status text-success" id="product_{{ $product->id }}" href="javascript:void(0)"> Active
                                            </a>
                                            @else
                                            <a product_id="{{ $product->id }}" class="product_status text-danger" id="product_{{ $product->id }}" href="javascript:void(0)"> In Active
                                            </a>
                                            @endif
                                        </td>

                                        <td>

                                            <a title="Add Images" href="{{ route('add.images', $product->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                            </a>
                                            <a title="Add Attributes" href="{{ route('add_attribute', $product->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-plus"></i>
                                            </a>

                                            <a title="Edit" href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form style="display: inline-block" class="form-delete" method="post" action="{{ route('product.destroy', $product->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="12">No {{ $title }} found</td>
                                    </tr>
                                    @endif
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
@stop
<!-- External javascript -->
@section('scripts')
<script type="text/javascript">
    //Jquery ready function

    $(document).on("click", ".product_status", function() {
        var status = $(this).text();
        var product_id = $(this).attr("product_id");

        $.ajax({
            type: 'post',
            url: '/admin/catalogue/update-product-status',
            data: {
                status: status,
                product_id: product_id
            },
            success: function(resp) {
                if (resp['status'] == 0) {
                    $("#product_" + product_id).html(
                        "<a href='javascript:void(0)' class='product_status'>InActive</a>"
                    )
                } else if (resp['status'] == 1) {
                    $("#product_" + product_id).html(
                        "<a href='javascript:void(0)' class='product_status'>Active</a>"
                    )
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });
</script>
@endsection
