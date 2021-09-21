@extends('admin.layouts.master')
@section('title')
    Registered User
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
                            <li class="breadcrumb-item"><a href="{{ url('sadmin/dashboard') }}">Home</a></li>
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
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Mobile</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td>{{ $user['city'] }}</td>
                                                <td>{{ $user['country'] }}</td>
                                                <td>{{ $user['mobile'] }}</td>
                                                <td>
                                                    @if ($user->status == 1)
                                                        <a title="Change" user_id="{{ $user->id }}"
                                                            class="text-success user_status"
                                                            id="user_{{ $user->id }}" href="javascript:void(0)">
                                                            Active
                                                        </a>
                                                    @else
                                                        <a title="Change" user_id="{{ $user->id }}"
                                                            class="user_status text-danger"
                                                            id="user_{{ $user->id }}" href="javascript:void(0)"> In
                                                            Active
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    {{ date('Y-m-d', strtotime($user['created_at'])) }}
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
            $(".user_status").click(function() {
                var status = $(this).text();
                var user_id = $(this).attr("user_id");
                $.ajax({
                    type: 'post',
                    url: '/sadmin/update-user-status',
                    data: {
                        status: status,
                        user_id: user_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#user_" + user_id).html(
                                "<a href='javascript:void(0)' class='user_status'>In Active</a>"
                            )
                        } else if (resp['status'] == 1) {
                            $("#user_" + user_id).html(
                                "<a href='javascript:void(0)' class='user_status'>Active</a>"
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
