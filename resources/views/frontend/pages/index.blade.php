<?php
use App\Models\Product;
?>
@extends('frontend.layouts.front_app')
@section('content')
    <div class="span9">
        <div class="well well-small">
            <h4>Featured Products <small class="pull-right">200+ featured products</small></h4>
            <div class="row-fluid">
                <div id="featured" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($feature_product_chunk as $key => $feature_product)
                            <div class="item @if ($key==1) active @endif">
                                <ul class="thumbnails">
                                    @foreach ($feature_product as $feature)
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <i class="tag"></i>
                                                <a href="{{ route('detail', $feature['id']) }}">
                                                    @if (!empty($feature['image']))
                                                        <img src="{{ asset('uploads/product_img_medium/' . $feature['image']) }}"
                                                            alt="{!! $feature['title'] !!}">
                                                    @else
                                                        <img src="{{ asset('/uploads/no_image.png') }}" alt="No Image">
                                                    @endif
                                                </a>
                                                <div class="caption">
                                                    <?php $discounted_price = Product::getDiscountedPrice($feature['id']); ?>
                                                    <h5>{!! $feature['title'] !!}</h5>
                                                    @if ($discounted_price > 0)
                                                        <del>
                                                            <p>BDT. {{ $feature['price'] }}</p>
                                                        </del>
                                                        <p>BDT. {{ $discounted_price }}</p>
                                                    @else
                                                        <p>BDT. {{ $feature['price'] }}</p>
                                                    @endif
                                                    <a href="{{ url('detail', $feature['id']) }}"
                                                        class="btn btn-block">View</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#featured" data-slide="next">›</a>
                </div>
            </div>
        </div>
        <h4>Latest Products </h4>
        <ul class="thumbnails">
            @foreach ($new_products as $new_product)
                <li class="span3">
                    <div class="thumbnail">
                        <a href="{{ route('detail', $new_product['id']) }}">
                            @if (!empty($new_product['image']))
                                <img src="{{ asset('uploads/product_img_small/' . $new_product['image']) }}"
                                    alt="{!! $new_product['title'] !!}">
                            @else
                                <img src="{{ asset('/uploads/no_image.png') }}" alt="No Image">
                            @endif
                        </a>
                        <div class="caption">
                            <h5>{{ $new_product['title'] }}</h5>
                            <p>
                                {{ $new_product['description'] }}
                            </p>
                            <h4 style="text-align:center">
                                <a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn"
                                    href="#">Add to <i class="icon-shopping-cart"></i></a>
                                <?php $discounted_price = Product::getDiscountedPrice($new_product['id']); ?>
                                @if ($discounted_price > 0)
                                    <button class="btn btn-warning">
                                        <del>
                                            BDT. {{ $new_product['price'] }}
                                        </del>
                                    </button>
                                    <button class="btn btn-primary">
                                        BDT.{{ $discounted_price }}
                                    </button>
                                @else
                                    <button class="btn btn-success">
                                        BDT.{{ $new_product['price'] }}
                                    </button>
                                @endif
                            </h4>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
