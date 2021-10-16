@extends('admin.layouts.master')
@section('title')
    SEO Settings
@endsection
@section('styles')
    <style>
        

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
                @include('admin.partials.message')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                                @if (count($seo_data) == 0)
                                    <a href="{{ url('sadmin/add-edit-seoData') }}" class="btn btn-success float-right">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Meta Ttitle</th>
                                            <th>Meta Tags</th>
                                            <th>Meta Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($seo_data))
                                            @foreach ($seo_data as $key => $seoData)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        {{ $seoData->meta_title }}
                                                    </td>
                                                    <td>{{ $seoData->meta_tags }}</td>
                                                    <td>{{ $seoData->meta_description }}</td>
                                                    <td>
                                                        <a title="Edit"
                                                            href="{{ url('sadmin/add-edit-seoData/' . $seoData->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Demo Table</h3>
                                <a href="{{ url('sadmin/add-edit-seoData') }}" class="btn btn-success float-right">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Demo Table</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Meta Ttitle</th>
                                            <th>Meta Tags</th>
                                            <th>Meta Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>A</td>
                                            <td>A</td>
                                            <td>A</td>
                                            <td>A</td>
                                            <td>A</td>

                                        </tr>
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
                //console.log(page_id);
                $.ajax({
                    type: 'post',
                    url: '/sadmin/update-page-status',
                    data: {
                        status: status,
                        page_id: page_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            //console.log(resp['status']);
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
