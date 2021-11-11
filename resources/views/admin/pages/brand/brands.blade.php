@extends('admin.layouts.master')
@section('title')
    eCommerce Admin - Dashboard
@endsection
@section('styles')
    <style>
        a {
            color: #5da1eb;
        }

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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <a href="{{ url('sadmin/add-edit-brand') }}" class="btn btn-success float-right">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($brands))
                                            @foreach ($brands as $key => $brand)
                                                <tr id="brand_id{{ $brand['id'] }}">
                                                    <td>{{ ++$key }}</td>
                                                    <td class="text-dark"><a> {{ $brand['title'] }}
                                                    </td>
                                                    <td>{{ $brand['slug'] }}</td>
                                                    <td>
                                                        @if ($brand['status'] == 1)
                                                            <a class="update_brand_status" id="brand_{{ $brand['id'] }}"
                                                                brand_id="{{ $brand['id'] }}"
                                                                href="javascript:void(0)">Active
                                                            </a>
                                                        @else
                                                            <a class="update_brand_status" id="brand_{{ $brand['id'] }}"
                                                                brand_id="{{ $brand['id'] }}"
                                                                href="javascript:void(0)">In Active
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a title="Edit Brand" href="{{ url('sadmin/add-edit-brand/' . $brand['id']) }}" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button class="deleteRecord btn btn-sm btn-danger btn-sm"
                                                            data-id="{{ $brand['id'] }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">No {{ $title }} found</td>
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
@endsection
@section('scripts')
    <script type="text/javascript">
        //Jquery ready function
        $(document).on("click", ".update_brand_status", function() {
            var status = $(this).text();
            var brand_id = $(this).attr("brand_id");
            $.ajax({
                type: 'post',
                url: '/admin/update-brand-status',
                data: {
                    status: status,
                    brand_id: brand_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#brand_" + brand_id).html(
                            "<a href='javascript:void(0)' class='brand_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#brand_" + brand_id).html(
                            "<a href='javascript:void(0)' class='brand_status'>Active</a>"
                        )
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        });
        //delete using ajax
        $(".deleteRecord").click(function() {
            var id = $(this).data("id");
            if (confirm("Do you want to delete brand??")) {
                $.ajax({
                    url: "/sadmin/delete-brand/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        //console.log("it Works");
                        $("#brand_id" + id).remove()
                    }
                });
            }
        });
    </script>
@endsection
