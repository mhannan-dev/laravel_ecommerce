@extends('admin.layouts.master')
@section('title')
    Product Sections
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
                        <h1>Catalogue</h1>
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
                @include('admin.partials.message')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                <a href="{{ route('section.create') }}" class="btn btn-success float-right">
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
                                        @if (count($sections))
                                            @foreach ($sections as $key => $section)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td class="text-dark"><a> {{ $section['title'] }}
                                                    </td>
                                                    <td>{{ $section['slug'] }}</td>
                                                    <td>
                                                        @if ($section['status'] == 1)
                                                            <a class="update_section_status"
                                                                id="section_{{ $section['id'] }}"
                                                                section_id="{{ $section['id'] }}"
                                                                href="javascript:void(0)">Active
                                                            </a>
                                                        @else
                                                            <a class="update_section_status"
                                                                id="section_{{ $section['id'] }}"
                                                                section_id="{{ $section['id'] }}"
                                                                href="javascript:void(0)">InActive
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a title="Edit"
                                                            href="{{ route('section.edit', $section['id']) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form style="display: inline-block" class="form-delete"
                                                            method="post"
                                                            action="{{ route('section.destroy', $section['id']) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
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
@stop
<!-- External javascript -->
@section('scripts')
    <script type="text/javascript">
        //Jquery ready function
        $(document).ready(function() {
            $(".update_section_status").click(function() {
                var status = $(this).text();
                var section_id = $(this).attr("section_id");
                $.ajax({
                    type: 'post',
                    url: '/sadmin/update-section-status',
                    data: {
                        status: status,
                        section_id: section_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#section_" + section_id).html(
                                "<a href='javascript:void(0)' class='section_status'>In Active</a>"
                            )
                        } else if (resp['status'] == 1) {
                            $("#section_" + section_id).html(
                                "<a href='javascript:void(0)' class='section_status'>Active</a>"
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
