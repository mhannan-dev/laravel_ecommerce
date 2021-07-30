@extends('admin.layouts.master')
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
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.message')
                    <form action="{{ route('add_attribute',$product['id'])}}" method="post">
                        <div class="card">
                            <div class="card-header">
                                {{ $title }}
                            </div>
                            <div class="card-body">
                                @csrf
                                <input type="hidden" name="attribute_id" value="{{ $product['id'] }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name </label>
                                            {{ $product['title'] }}
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Produce Code</label>
                                            {{ $product['code'] }}
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Produce Color</label>
                                            {{ $product['color'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img style="height:150px;" src="{{ asset('uploads/product_img_large/'.$product['image']) }}" alt="{{ $product['title'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="field_wrapper">
                                            <div>
                                                <input style="width: 120px;" id="size" type="text" name="size[]" value="" placeholder="Size" required />
                                                <input style="width: 120px;" id="sku" type="text" name="sku[]" value="" placeholder="SKU" required />
                                                <input style="width: 120px;" id="price" type="number" name="price[]" value="" placeholder="Price" required />
                                                <input style="width: 120px;" id="stock" type="text" name="stock[]" value="" placeholder="Stock" required />
                                                <a href="javascript:void(0);" class="add_button" title="Add field">&nbsp;<i class="fa fa-plus success"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mt-4">Save {{ $title }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('edit_attribute', $product['id'])}}" method="post"> @csrf
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Size</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($product['attributes']))
                                    @foreach ($product['attributes'] as $key => $attribute)
                                    <input type="hidden" name="attrId[]" value="{{ $attribute['id'] }}">
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $attribute['size'] }}</td>
                                        <td>{{ $attribute['sku'] }}</td>
                                        <td width="15%">
                                            <input type="number" name="price[]" value="{{ $attribute['price'] }}" class="form-control" required>
                                        </td>
                                        <td width="15%">
                                            <input type="number" name="stock[]" value="{{ $attribute['stock'] }}" class="form-control" required>
                                        </td>
                                        <td>
                                            @if ($attribute['status'] == 1 )
                                            <a attribute_id="{{ $attribute['id'] }}" class="attribute_status text-success" id="product_{{ $attribute['id'] }}" href="javascript:void(0)">
                                                Active
                                            </a>
                                            @else
                                            <a attribute_id="{{ $attribute['id'] }}" class="attribute_status" id="attribute_{{ $attribute['id'] }}" href="javascript:void(0)">
                                                In Active
                                            </a>
                                            @endif
                                            &nbsp;&nbsp; / &nbsp;&nbsp; <a href="{{ url('admin/delete-attribute', $attribute['id'])}}" class="button delete-confirm text-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center"> Opps!!, {{$title}} Not found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mt-4">Update {{ $title }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div style="margin-top: 5px; margin-left: 2px;"><div style="height:5px;"></div></div><input style="width:120px;" type="text" name="size[]" placeholder="Size" required/>&nbsp;<input style="width:120px;" type="text" name="sku[]" placeholder="SKU" required/>&nbsp;<input style="width:120px;" type="text" name="price[]" placeholder="Price" required />&nbsp;<input style="width:120px;" type="text" name="stock[]" placeholder="Stock"required />&nbsp;<a href="javascript:void(0);" class="remove_button"> &nbsp;<i class="fa fa-minus success"></i></a></div>';
        var x = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
        //Update attribute status
        $(".attribute_status").click(function() {
            var status = $(this).text();
            var attribute_id = $(this).attr("attribute_id");
            $.ajax({
                type: 'post',
                url: '/admin/update-attribute-status',
                data: {
                    status: status,
                    attribute_id: attribute_id
                },
                success: function(resp) {
                    if (resp['status'] == 0) {
                        $("#attribute_" + attribute_id).html(
                            "<a href='javascript:void(0)' class='attribute_status'>In Active</a>"
                        )
                    } else if (resp['status'] == 1) {
                        $("#attribute_" + attribute_id).html(
                            "<a href='javascript:void(0)' class='attribute_status'>Active</a>"
                        )
                    }
                },
                error: function() {
                    alert("Error");
                }
            });
        });

        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
