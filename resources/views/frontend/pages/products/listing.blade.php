@extends('frontend.layouts.front_app')
@section('title')
Product List
@endsection
@section('content')
@if (count($categoryProducts) > 0)

<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/')}}">Home</a> <span class="divider">/</span></li>
        <li class="active">
            <?php
                echo $categoryDetails['breadcrumbs'];
            ?>
        </li>
    </ul>
    <h3> {{ $categoryDetails['catDetails']['title'] }} <small class="pull-right text-success">
        {{ count($categoryProducts)}} products are available </small></h3>
    <hr class="soft">
    <p>
        {{ $categoryDetails['catDetails']['description'] }}
    </p>
    <hr class="soft">
    <form class="form-horizontal span6" name="product_sort_form" id="product_sort_form">
        <input type="hidden" id="slug" name="slug" value="{{ $slug }}">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort">
                <option value="">Select</option>
                <option value="latest_product" @if (isset($_GET['sort']) && $_GET['sort'] == 'latest_product') selected="" @endif>Latest Products</option>
                <option value="products_sort_a_to_z" @if (isset($_GET['sort']) && $_GET['sort'] == 'products_sort_a_to_z') selected="" @endif>Product A to Z</option>
                <option value="products_sort_z_to_a" @if (isset($_GET['sort']) && $_GET['sort'] == 'products_sort_z_to_a') selected="" @endif>Product Z to A</option>
                <option value="lowest_price_wise_products" @if (isset($_GET['sort']) && $_GET['sort'] == 'lowest_price_wise_products') selected="" @endif>Lowest Price First</option>
                <option value="highest_price_wise_products" @if (isset($_GET['sort']) && $_GET['sort'] == 'highest_price_wise_products') selected="" @endif>Price Highest First</option>
            </select>
        </div>
    </form>


    <br class="clr">
    <div class="tab-content filter_products_ajax">
       @include('frontend/pages/products/ajax_prd_listing')
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
    <div class="pagination">

        @if (isset($_GET['sort']) && !empty($_GET['sort']))
            {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
        @else
            {{ $categoryProducts->links() }}
        @endif
    </div>
    <br class="clr">
</div>
@else

<div class="span9">
    <h3 class="text-danger"> No product found</h3>

</div>
@endif
@endsection

