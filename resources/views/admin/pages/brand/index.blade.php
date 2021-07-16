@extends('admin.layouts.master')
@section('title')
Brands
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
      </brand>
    <!-- Main content -->
    <brand class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{ $title }}</h3>
                  <a href="{{ route('brand.create') }}" class="btn btn-success float-right">
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
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td class="text-dark"><a> {{ $brand['title'] }}
                            </td>
                            <td>{{ $brand['slug'] }}</td>
                            <td>
                                @if ($brand['status'] == 1 )
                                <a class="update_brand_status" id="brand_{{ $brand['id'] }}"
                                  brand_id="{{ $brand['id'] }}" href="javascript:void(0)">Active
                                </a>
                                @else
                                <a class="update_brand_status" id="brand_{{ $brand['id'] }}"
                                  brand_id="{{ $brand['id'] }}" href="javascript:void(0)">In Active
                                </a>
                                @endif
                            </td>
                              <td>
                                  <a title="Edit" href="{{ route('brand.edit', $brand['id']) }}"
                                     class="btn btn-warning btn-sm">
                                      <i class="fa fa-edit"></i>
                                  </a>
                                  <form style="display: inline-block" class="form-delete" method="post"
                                        action="{{ route('brand.destroy', $brand['id']) }}">
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
      </brand>
    <!-- /.content -->
</div>
@stop
<!-- External javascript -->
@section('scripts')
<script type="text/javascript">
    //Jquery ready function
    
        
          $(document).on("click",".update_brand_status", function(){
            var status = $(this).text();
            var brand_id = $(this).attr("brand_id");

            $.ajax({
                type: 'post',
                url: '/admin/update-brand-status',
                data: {status:status, brand_id :brand_id},
                success: function (resp) {
                    if (resp['status'] == 0) {
                        $("#brand_"+brand_id).html(
                          "<a href='javascript:void(0)' class='brand_status'>In Active</a>"
                          )
                    } else if (resp['status'] == 1) {
                        $("#brand_"+brand_id).html(
                          "<a href='javascript:void(0)' class='brand_status'>Active</a>"
                          )
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    
</script>
@endsection
