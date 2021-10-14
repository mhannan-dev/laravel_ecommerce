@extends('admin.layouts.master')
@section('title')
    Manage - CMS
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
        <brand class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </brand>
        <!-- Main content -->
        <brand class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <a href="{{ url('sadmin/add-edit-page') }}" class="btn btn-success float-right">
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
                                        @if (count($cms_pages))
                                            @foreach ($cms_pages as $key => $page)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        {{ $page['title'] }}
                                                    </td>
                                                    <td>{{ $page['slug'] }}</td>
                                                    <td>
                                                        @if ($page['status'] == 1)


                                                            <a title="Change" page_id="{{ $page['id'] }}"
                                                            class="text-success page_status"
                                                            id="page_{{ $page['id'] }}" href="javascript:void(0)">
                                                            Active
                                                        </a>
                                                        @else
                                                            <a class="update_cms_status" id="cms_{{ $page['id'] }}"
                                                                cms_id="{{ $page['id'] }}" href="javascript:void(0)">In
                                                                Active
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a title="Edit" href="" class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button class="deleteRecord btn btn-sm btn-danger btn-sm" data-id="{{ $page['id'] }}">
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
        </brand>
        <!-- /.content -->
    </div>
@stop
<!-- External javascript -->
@section('scripts')
    <script type="text/javascript">
        //Jquery ready function
        $(document).ready(function() {
            $(".page_status").click(function() {
                var status = $(this).text();
                var page_id = $(this).attr("page_id");
                $.ajax({
                    type: 'post',
                    url: '/sadmin/update-page-status',
                    data: {
                        status: status,
                        page_id: page_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#page_" + page_id).html(
                                "<a href='javascript:void(0)' class='page_status'>In Active</a>"
                            )
                        } else if (resp['status'] == 1) {
                            $("#page_" + page_id).html(
                                "<a href='javascript:void(0)' class='page_status'>Active</a>"
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
                if (confirm("Do you want to delete page??")) {
                    $.ajax({
                        url: "/sadmin/delete-page/" + id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            //console.log("it Works");
                            $("#page_id" + id).remove()
                        }
                    });
                }
            });

        });
    </script>
@endsection
