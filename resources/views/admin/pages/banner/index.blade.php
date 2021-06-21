@extends('admin.layouts.master')
@section('title')
Product Category
@endsection
@section('styles')
<style>
    a {
        color: #5da1eb;
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
                            <a href="{{ route('banner.create') }}" class="btn btn-success float-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($banners as $key => $banner)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $banner['title'] }}</td>
                                        <td width="30%">
                                            @if (!empty($banner['banner_image']))

                                            <img style="width: 60px;" src="{{ asset('/storage/banner/' . $banner->banner_image) }}" alt="{{ $banner->title }}">
                                            @else
                                            <img style="width: 60px; border: 3px solid red" src="{{ url('/storage/banner/no_image.png') }}" alt="No Image">
                                            @endif
                                        </td>
                                        <td>@if ($banner->status == 1 )
                                            <a title="Change" banner_id="{{ $banner->id }}" class="text-success banner_status" id="banner_{{ $banner->id }}" href="javascript:void(0)"> Active
                                            </a>
                                            @else
                                            <a title="Change" banner_id="{{ $banner->id }}" class="banner_status text-danger" id="banner_{{ $banner->id }}" href="javascript:void(0)"> In Active
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{ route('banner.edit', $banner->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form style="display: inline-block" action="{{ route('banner.destroy', $banner->id) }}" class="form-delete" method="post">
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
@stop
<!-- External javascript -->
@section('scripts')
<script type="text/javascript">
    //Jquery ready function
    $(document).ready(function() {
        $(".banner_status").click(function() {
            var status = $(this).text();
            var banner_id = $(this).attr("banner_id");
            $.ajax({
                type: 'post',
                url: '/admin/site/update-banner-status',
                data: {
                    status: status,
                    banner_id: banner_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#banner_" + banner_id).html(
                            "<a href='javascript:void(0)' class='banner_status'>Inactive</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#banner_" + banner_id).html(
                            "<a href='javascript:void(0)' class='banner_status'>Active</a>"
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
