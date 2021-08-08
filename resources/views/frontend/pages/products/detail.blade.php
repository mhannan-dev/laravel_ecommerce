<?php use App\Models\Product; ?>
@extends('frontend.layouts.front_app')
@section('title')
Product Details
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li><a
                    href="{{ url('/' . $product_details['category']['slug']) }}">{{ $product_details['category']['title'] }}</a>
                <span class="divider">/</span>
            </li>
            <li class="active">{{ $product_details['title'] }}</li>
        </ul>
        <div class="row">
            <div id="gallery" class="span3">
                <a href="{{ asset('uploads/product_img_medium/' . $product_details['image']) }}"
                    title="Blue Casual T-Shirt">
                    <img src="{{ asset('uploads/product_img_medium/' . $product_details['image']) }}" style="width:100%"
                        alt="Blue Casual T-Shirt">
                </a>
                <div id="differentview" class="moreOptopm carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach ($product_details['images'] as $image)
                                <a href="{{ asset('uploads/product_img_medium/' . $image['images']) }}">
                                    <img style="width:29%"
                                        src="{{ asset('uploads/product_img_small/' . $image['images']) }}" alt="">
                                </a>
                            @endforeach
                        </div>
                        <div class="item">
                            @foreach ($product_details['images'] as $image)
                                <a href="{{ asset('uploads/product_img_medium/' . $image['images']) }}">
                                    <img style="width:29%"
                                        src="{{ asset('uploads/product_img_small/' . $image['images']) }}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!--
                                                                                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                                                                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                                                                            -->
                </div>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <span class="btn"><i class="icon-envelope"></i></span>
                        <span class="btn"><i class="icon-print"></i></span>
                        <span class="btn"><i class="icon-zoom-in"></i></span>
                        <span class="btn"><i class="icon-star"></i></span>
                        <span class="btn"><i class=" icon-thumbs-up"></i></span>
                        <span class="btn"><i class="icon-thumbs-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="span6">
                {{-- Stock error message --}}
                @include('frontend.partials.flash_msg')
                <h3>{{ $product_details['title'] }}</h3>
                <small>- {{ $product_details['brand']['title'] }}</small>
                <hr class="soft">
                <small><span class="badge badge-primary">{{ $total_stock }}</span> items in stock</small>
                <form action="{{ url('add-to-cart') }}" method="post" class="form-horizontal qtyFrm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product_details['id'] }}">
                    <div class="control-group">
                        <?php $discounted_price = Product::getDiscountedPrice($product_details['id']); ?>

                        <h4 class="getAttrPrice">
                            @if ($discounted_price > 0)
                                <del>BDT.{{ $product_details['price'] }}</del>
                                BDT.{{ $discounted_price }}
                            @else
                                BDT.{{ $product_details['price'] }}
                            @endif
                        </h4>
                        <select name="size" id="getPrice" product_id={{ $product_details['id'] }} class="span2 pull-left"
                            required>
                            <option value="">Select Size</option>
                            @foreach ($product_details['attributes'] as $attribute)
                                <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="quantity" class="span1" placeholder="Qty." required>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i
                                class=" icon-shopping-cart"></i></button>
                    </div>
                </form>
            </div>
            <hr class="soft clr">
            <p class="span6">
                {{ $product_details['description'] }}
            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr">
            <a href="#" name="detail"></a>
            <hr class="soft">
        </div>
        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="techSpecRow">
                                <th colspan="2">Product Details</th>
                            </tr>
                            @if (!empty($product_details['brand']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Brand: </td>
                                    <td class="techSpecTD2">{{ $product_details['brand']['title'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['code']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Code:</td>
                                    <td class="techSpecTD2">{{ $product_details['code'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['fabric']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Color:</td>
                                    <td class="techSpecTD2">{{ $product_details['color'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['fabric']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Sleeve:</td>
                                    <td class="techSpecTD2">{{ $product_details['sleeve'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['fabric']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Fabric:</td>
                                    <td class="techSpecTD2">{{ $product_details['fabric'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['pattern']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Pattern:</td>
                                    <td class="techSpecTD2">{{ $product_details['pattern'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['occasion']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Occation:</td>
                                    <td class="techSpecTD2">{{ $product_details['occasion'] }}</td>
                                </tr>
                            @endif
                            @if (!empty($product_details['fit']))
                                <tr class="techSpecRow">
                                    <td class="techSpecTD1">Fit:</td>
                                    <td class="techSpecTD2">{{ $product_details['fit'] }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <h5>Washcare</h5>
                    <p>{{ $product_details['wash_care'] }}</p>
                    <h5>Disclaimer</h5>
                    <p>
                        {{ $product_details['description'] }}
                    </p>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                    class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i
                                    class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr">
                    <hr class="soft">
                    <div class="tab-content">
                        <div class="tab-pane" id="listView">
                            @foreach ($related_products as $related_product)
                                <div class="row">
                                    <div class="span2">
                                        <img src="{{ asset('uploads/product_img_medium/' . $related_product['image']) }}"
                                            alt="">
                                    </div>
                                    <div class="span4">
                                        <h3>New | Available</h3>
                                        <hr class="soft">
                                        <h5>{{ $related_product['title'] }}</h5>
                                        <p>
                                            {{ $related_product['description'] }}
                                        </p>
                                        <a class="btn btn-small pull-right"
                                            href="{{ route('product.detail', $related_product['id']) }}">View Details</a>
                                        <br class="clr">
                                    </div>
                                    <div class="span3 alignR">
                                        <form class="form-horizontal qtyFrm">
                                            <h3> BDT. {{ $related_product['price'] }}</h3>
                                            <label class="checkbox">
                                                <input type="checkbox"> Adds product to compair
                                            </label><br>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-large btn-primary"> Add to <i
                                                        class=" icon-shopping-cart"></i></a>
                                                <a href="#" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr class="soft">
                            @endforeach
                        </div>
                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach ($related_products as $related_product)
                                    <li class="span3">
                                        <div class="thumbnail">
                                            <a href="{{ route('product.detail', $related_product['id']) }}"><img
                                                    src="{{ asset('uploads/product_img_medium/' . $related_product['image']) }}"
                                                    alt=""></a>
                                            <div class="caption">
                                                <h5>{!! $related_product['title'] !!}</h5>
                                                <p>
                                                    {!! $related_product['description'] !!}
                                                </p>
                                                <h4 style="text-align:center">
                                                    <a class="btn"
                                                        href="{{ route('product.detail', $related_product['id']) }}"> <i
                                                            class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i
                                                            class="icon-shopping-cart"></i></a> <a class="btn btn-primary"
                                                        href="#">BDT.{!! $related_product['price'] !!}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <hr class="soft">
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
@endsection
