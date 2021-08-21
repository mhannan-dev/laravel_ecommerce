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
            <div class="row">

                <div class="col-12">
                    @include('admin.partials.message')

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('coupon.update', $coupon['id']) }}" method="POST">
                                @method('put')
                                @include('admin.pages.coupons._form', ['buttonText' => 'Update'])
                            </form>

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
<!-- External javascript -->
@section('scripts')
<!-- bs-custom-file-input -->
<script src="{{ URL::asset('backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    //Jquery ready function
    $(document).ready(function () {
        bsCustomFileInput.init();
        $("#section_id").change(function () {
            var section_id = $(this).val();
            $.ajax({
                type: 'post',
                url: '/sadmin/append-category-level',
                data: {
                    section_id: section_id
                },
                success: function (resp) {
                    $("#append_category").html(resp);
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });

</script>
@endsection
