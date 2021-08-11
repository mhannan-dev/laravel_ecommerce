@php
use App\Models\Banner;
$banners = Banner::where('status', 1)->get();
@endphp
<!-- Header End====================================================================== -->
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($banners as $key=>$banner)
            <div class="item @if ($key==1) active @endif">
                <div class="container">
                    <a href="#">
                    @if (!empty($banner['banner_image']))
                    <img style="width:100%" src="{{ url('storage/banner/'.$banner['banner_image']) }}" alt="{{ $banner['alt']}}" />
                    @else
                    <img style="width:100%" src="{{url('/storage/product/no_image.png')}}" alt="{{ $banner['alt']}}" />
                    @endif
                    </a>
                    <div class="carousel-caption">
                        <h4>First Thumbnail label</h4>
                        <p>Banner text</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>
