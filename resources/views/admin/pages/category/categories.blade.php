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
                            <a href="{{ route('category.create') }}" class="btn btn-success float-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ $title }}</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Parent</th>
                                        <th>Section</th>
                                        <th>Category</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories))
                                    @foreach ($categories as $key => $category)
                                    @if (!isset( $category->parent_category->title))
                                    <?php $parent_category = "ROOT"; ?>
                                    @else
                                    <?php $parent_category = $category->parent_category->title ?>
                                    @endif
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            {{ $parent_category }}
                                        </td>
                                        <td>{{ !empty($category->section) ? $category->section->title:'' }}</td>
                                        <td class="text-dark"><a> {{ $category->title }}
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if ($category->status == 1 )
                                            <a title="Change" category_id="{{ $category->id }}" class="text-success category_status" id="category_{{ $category->id }}" href="javascript:void(0)"> Active
                                            </a>
                                            @else
                                            <a title="Change" category_id="{{ $category->id }}" class="category_status text-danger" id="category_{{ $category->id }}" href="javascript:void(0)"> In Active
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($category->image))
                                            <img style="width: 60px;" src="{{ url('storage/category/'.$category->image) }}" alt="{{ $category->title }}">
                                            @else
                                            <img style="width: 60px; border: 3px solid red" src="{{url('/storage/category/default.png')}}" alt="No Image">
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{ route('category.edit', $category->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form style="display: inline-block" action="{{ url('sadmin/category', $category->id) }}" class="form-delete" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No {{ $title }} found</td>
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
        $(document).on("click",".category_status", function(){
            var status = $(this).text();
            var category_id = $(this).attr("category_id");
            $.ajax({
                type: 'post',
                url: '/sadmin/update-category-status',
                data: {
                    status: status,
                    category_id: category_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#category_" + category_id).html(
                            "<a href='javascript:void(0)' class='category_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#category_" + category_id).html(
                            "<a href='javascript:void(0)' class='category_status'>Active</a>"
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
