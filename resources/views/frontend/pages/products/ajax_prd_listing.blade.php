<?php
use App\Models\Product;
?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="{{ route('product.detail', $product['id']) }}">

                        @if (!empty($product['image']))
                            <img src="{{ asset('uploads/product_img_small/' . $product['image']) }}"
                                alt="{!! $product['title'] !!}">
                        @else
                            <img src="{{ url('/storage/product/no_image.png') }}" alt="No Image">
                        @endif
                    </a>
                    <div class="caption">

                        <h5>{{ $product['title'] }}</h5>
                        <p>
                            {{ Str::limit($product['description'], 50) }}
                        </p>
                        <?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
                        <h4 style="text-align:center">
                            <a class="btn" href="{{ route('product.detail', $product['id']) }}">
                                <i class="icon-zoom-in"></i>
                            </a>
                            <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                            @if ($discounted_price > 0)
                                <button class="btn btn-warning">
                                    <del>
                                        BDT. {{ $product['price'] }}
                                    </del>
                                </button>
                            @else
                                <button class="btn btn-success">
                                    BDT. {{ $product['price'] }}
                                </button>
                            @endif

                        </h4>
                        @if ($discounted_price > 0)
                            <h4 style="text-align:center">
                                <button class="btn btn-primary">
                                    Discount Price BDT. {!! $discounted_price !!}
                                </button>
                            </h4>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
    <hr class="soft">
</div>
