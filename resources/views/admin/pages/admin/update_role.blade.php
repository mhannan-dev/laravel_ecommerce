@extends('admin.layouts.master')
@section('title')
eCommerce Admin - Dashboard
@endsection
@section('styles')
<style>
   a {
   color: #5da1eb;
   }
</style>
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
         @include('admin.partials.message')
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">


         <!-- /.row -->
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <!-- /.card -->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                     </div>
                     <!-- form start -->
                     <form id="roleEditForm" class="form-horizontal" action="{{ url('sadmin/update-user-role',$adminDetails['id'])}}" method="post">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="form-group col-md-3">
                                 <label for="category">Categories</label>
                              </div>
                              <div class="col-md-9">
                                 <input type="checkbox" name="categories['view']" value="1">&nbsp;View
                                 only access &nbsp;
                                 <input type="checkbox" name="categories['edit']"
                                    value="1">&nbsp;View-Edit access &nbsp;
                                 <input type="checkbox" name="categories['full']" value="1">&nbsp;Full
                                 access
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="form-group col-md-3">
                                 <label for="category">Products</label>
                              </div>
                              <div class="col-md-9">
                                 <input type="checkbox" name="products['view']" value="1">&nbsp;View
                                 only access &nbsp;
                                 <input type="checkbox" name="products['edit']"
                                    value="1">&nbsp;View-Edit access &nbsp;
                                 <input type="checkbox" name="products['full']" value="1">&nbsp;Full
                                 access
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="form-group col-md-3">
                                 <label for="category">Coupons</label>
                              </div>
                              <div class="col-md-9">
                                 <input type="checkbox" name="coupons['view']" value="1">&nbsp;View
                                 only access &nbsp;
                                 <input type="checkbox" name="coupons['edit']"
                                    value="1">&nbsp;View-Edit access &nbsp;
                                 <input type="checkbox" name="coupons['full']" value="1">&nbsp;Full
                                 access
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="form-group col-md-3">
                                 <label for="category">Orders</label>
                              </div>
                              <div class="col-md-9">
                                 <input type="checkbox" name="orders['view']" value="1">&nbsp;View
                                 only access &nbsp;
                                 <input type="checkbox" name="orders['edit']"
                                    value="1">&nbsp;View-Edit access &nbsp;
                                 <input type="checkbox" name="orders['full']" value="1">&nbsp;Full
                                 access
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                           <button type="submit" class="btn btn-info rounded-0">Save</button>
                        </div>
                        <!-- /.card-footer -->
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
