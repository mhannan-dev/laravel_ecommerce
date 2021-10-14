@php
use App\Models\Category;

@endphp
@extends('admin.layouts.master')
@section('title')
    Dashboard-Web Blogs
@endsection
@section('styles')

@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                        <!-- /.card -->
                        <div class="card">
                            <form method="POST" action="{{ url('sadmin/add-edit-page', $cms['id']) }}">
                                @csrf
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-row">


                                        <div class="form-group col-md-6">
                                            <label for="title">Page title</label><span class="text-danger">*</span>
                                            <input type="text" name="title"
                                                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                                placeholder="Page name" value="{{ $cms['title'] }}">
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="meta_title">Meta title <small>For SEO</small></label><span
                                                class="text-danger">*</span>
                                            <input type="text" value="{{ @old('meta_title', $cms['meta_title']) }}"
                                                name="meta_title"
                                                class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                                placeholder="Page meta title">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="description">Description</label><span class="text-danger">*</span>
                                            <textarea id="description"
                                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                name="description">{{ @old('description', $cms['description']) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="meta_description">Meta Description</label><span
                                                class="text-danger">*</span>
                                                <textarea id="postBody"
                                                class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
                                                name="meta_description">{{ @old('meta_description', $cms['meta_description']) }}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                                </div>
                                <!-- /.card-body -->
                            </form>
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
