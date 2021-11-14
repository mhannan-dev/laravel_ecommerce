@extends('admin.layouts.master')
@section('title')
    Other Settings
@endsection
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper" style="min-height: 194px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Other settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ url('admin/profile-update') }}">Other settings</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-8">
                        @include('admin.partials.message')
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Other settings</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" action="{{ url('sadmin/add-edit-other-setting',$minMaxCartVal['id']) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="min_value" class="col-sm-3 col-form-label">Min Cart Value</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="min_value" class="form-control rounded-0"
                                                id="min_value" placeholder="Min Value 500" min="500" @if (isset($minMaxCartVal))
                                                value="{{ $minMaxCartVal['min_value'] }}"
                                                @else
                                                    required
                                                @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="max_value" class="col-sm-3 col-form-label">Max Cart Value</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="max_value" class="form-control rounded-0"
                                                id="max_value" placeholder="Max Value 50000" max="50000" @if (isset($minMaxCartVal))
                                                value="{{ $minMaxCartVal['max_value'] }}"
                                                @else
                                                    required
                                                @endif>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info rounded-0">{{ $buttonText }}</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@stop
<!-- External javascript -->
