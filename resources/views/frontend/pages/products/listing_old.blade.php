@extends('frontend.layouts.front_app')
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
        <input type="hidden" name="slug" value="{{ $slug }}">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort_products" id="sort_products">
                <option value="">Select</option>
                <option value="latest_product" @if (isset($_GET['sort_products']) && $_GET['sort_products'] == 'latest_product') selected="" @endif>Latest Products</option>
                <option value="products_sort_a_to_z" @if (isset($_GET['sort_products']) && $_GET['sort_products'] == 'products_sort_a_to_z') selected="" @endif>Product A to Z</option>
                <option value="products_sort_z_to_a" @if (isset($_GET['sort_products']) && $_GET['sort_products'] == 'products_sort_z_to_a') selected="" @endif>Product Z to A</option>
                <option value="lowest_price_wise_products" @if (isset($_GET['sort_products']) && $_GET['sort_products'] == 'lowest_price_wise_products') selected="" @endif>Lowest Price First</option>
                <option value="highest_price_wise_products" @if (isset($_GET['sort_products']) && $_GET['sort_products'] == 'highest_price_wise_products') selected="" @endif>Price Highest First</option>
            </select>
        </div>
    </form>

    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>
    <br class="clr">
    <div class="tab-content">
        <div class="tab-pane" id="listView">
            @foreach ($categoryProducts as $product)
            <div class="row">
                <div class="span2">
                    @if (!empty($product['image']))
                    <img src="{{ url('storage/product/'.$product['image']) }}" alt="{!! $product['title'] !!}">
                    @else
                    <img src="{{url('/storage/product/no_image.png')}}" alt="No Image">
                    @endif

                </div>
                <div class="span4">
                    <h3>{!! $product['title'] !!}</h3>
                    <hr class="soft">
                    <h5>{!! $product['brand']['title'] !!} </h5>
                    <p>
                        {!! $product['description'] !!}
                    </p>
                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                    <br class="clr">
                </div>
                <div class="span3 alignR">
                    <form class="form-horizontal qtyFrm">
                        <h3> BDT.  {!! $product['price'] !!}</h3>
                        <label class="checkbox">
                            <input type="checkbox">  Adds product to compare
                        </label><br>

                        <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                        <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                    </form>
                </div>
            </div>
            <hr class="soft">
            @endforeach
        </div>
        <div class="tab-pane  active" id="blockView">
            <ul class="thumbnails">
                @foreach ($categoryProducts as $product)
                <li class="span3">
                    <div class="thumbnail">
                        <a href="product_details.html">

                            @if (!empty($product['image']))
                            <img src="{{ url('storage/product/'.$product['image']) }}" alt="{!! $product['title'] !!}">
                            @else
                            <img src="{{url('/storage/product/no_image.png')}}" alt="No Image">
                            @endif
                        </a>
                        <div class="caption">
                            <h5>{{ $product['title'] }}</h5>
                            <p>
                                {{ Str::limit($product['description'], 50) }}
                            </p>
                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">BDT. {{ $product['price'] }}</a></h4>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            <hr class="soft">
        </div>
    </div>
    <a href="#" class="btn btn-large pull-right">Compair Product</a>
    <div class="pagination">

        @if (isset($_GET['sort_products']) && !empty($_GET['sort_products']))
            {{ $categoryProducts->appends(['sort_products' => $_GET['sort_products']])->links() }}
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

