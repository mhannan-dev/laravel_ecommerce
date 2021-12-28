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
    <!-- Content Header (admin header) -->
    <div class="content-header">
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
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @include('admin.partials.message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }} Users</h3>
                            <a href="{{ url('sadmin/add-edit-admin') }}" class="btn btn-success float-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($admins))
                                    @foreach ($admins as $key => $admin)
                                    <tr id="admin_id{{ $admin['id'] }}">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            {{ $admin['name'] }}
                                        </td>
                                        <td>{{ $admin['email'] }}</td>
                                        <td>{{ $admin['mobile'] }}</td>
                                        <td>{{ $admin['type'] }}</td>
                                        <td><img class="img-circle" width="60px"
                                                src="{{ asset('uploads/admin_photos/' . $admin['image']) }}"
                                                alt="{{ $admin['name'] }}" title="{{ $admin['name'] }}">
                                        </td>
                                        <td>


                                            @if ($admin['type'] !== "superAdmin")
                                                @if ($admin['status'] == 1)
                                                <a title="Change" admin_id="{{ $admin['id'] }}"
                                                    class="text-success admin_status" id="admin_{{ $admin['id'] }}"
                                                    href="javascript:void(0)">
                                                    Active
                                                </a>
                                                @else
                                                <a title="Change" class="admin_status text-warning"
                                                    id="admin_{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}"
                                                    href="javascript:void(0)">In
                                                    Active
                                                </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($admin['type'] != 'superAdmin')
                                            <a title="Assign Role/Permission" href="{{ url('sadmin/update-user-role/' . $admin['id']) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-lock-open"></i>
                                            </a>
                                            <a title="Edit" href="{{ url('sadmin/add-edit-admin/' . $admin['id']) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="deleteRecord btn btn-sm btn-danger btn-sm"
                                                data-id="{{ $admin['id'] }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endif
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
    </div>
    <!-- /.content -->
</div>
@stop
<!-- External javascript -->
@section('scripts')
<script type="text/javascript">
    //Jquery ready function
    $(document).ready(function () {
        $(".admin_status").click(function () {
            var status = $(this).text();
            var admin_id = $(this).attr("admin_id");
            //console.log(admin_id);
            $.ajax({
                type: 'post',
                url: '/sadmin/update-admin-status',
                data: {
                    status: status,
                    admin_id: admin_id
                },
                success: function (resp) {
                    if (resp['status'] == 0) {
                        //console.log(resp['status']);
                        $("#admin_" + admin_id).html(
                            "<a href='javascript:void(0)' class='admin_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#admin_" + admin_id).html(
                            "<a href='javascript:void(0)' class='admin_status'>Active</a>"
                        )
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        //delete using ajax
        $(".deleteRecord").click(function () {
            var id = $(this).data("id");
            if (confirm("Do you want to delete admin??")) {
                $.ajax({
                    url: "/sadmin/delete-admin/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        //console.log("it Works");
                        $("#admin_id" + id).remove()
                    }
                });
            }
        });
    });
</script>
@endsection
