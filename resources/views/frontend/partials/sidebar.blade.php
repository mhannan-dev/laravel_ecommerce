@php
use App\Models\Section;
$sections = Section::with('categories')->where('status', 1)->get();

@endphp
<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="#"><img src="themes/images/ico-cart.png" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach ( $sections as $section)
        @if (count($section['categories']) > 0)
        <li class="subMenu"><a>{!! $section['title'] !!}</a>
            @foreach ($section['categories'] as $category)
            <ul>
                <li><a href="{{ route('slug', $category['slug']) }}"><i class="icon-chevron-right"></i><strong>{!! $category['title'] !!}</strong></a></li>
                @foreach ($category['subcategories'] as $subcategory )
                <li><a href="{{ route('slug', $subcategory['slug']) }}"><i class="icon-chevron-right"></i>{!! $subcategory['title'] !!}</a></li>
                @endforeach
            </ul>
            @endforeach
        </li>
        @endif
        @endforeach
    </ul>
    <br/>
    <div class="thumbnail">
        <img src="themes/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
<!-- Sidebar end=============================================== -->
