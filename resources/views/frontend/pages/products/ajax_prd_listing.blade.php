<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach ($categoryProducts as $product)
        <li class="span3">
            <div class="thumbnail">
                <a href="{{ route('product.detail', $product['id']) }}">

                    @if (!empty($product['image']))
                    <img src="{{ asset('uploads/product_img_small/' . $product['image']) }}" alt="{!! $product['title'] !!}">
                    @else
                    <img src="{{ url('/storage/product/no_image.png') }}" alt="No Image">
                    @endif
                </a>
                <div class="caption">

                    <h5>{{ $product['title'] }}</h5>
                    <p>
                        {{ Str::limit($product['description'], 50) }}
                    </p>

                    <h4 style="text-align:center">
                    <a class="btn" href="{{ route('product.detail', $product['id']) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">BDT.
                            {{ $product['price'] }}</a></h4>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
    <hr class="soft">
</div>
