@php
use App\Models\Section;
$sections = Section::with('categories')
    ->where('status', 1)
    ->get();
@endphp
<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">

    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach ($sections as $section)
            @if (count($section['categories']) > 0)
                <li class="subMenu"><a>{!! $section['title'] !!}</a>
                    @foreach ($section['categories'] as $category)
                        <ul>

                            <li><a href="{{ url($category['slug']) }}"><i
                                        class="icon-chevron-right"></i><strong>{!! $category['title'] !!}</strong></a></li>
                            @foreach ($category['subcategories'] as $subcategory)
                                <li><a href="{{ url($subcategory['slug']) }}"><i
                                            class="icon-chevron-right"></i>{!! $subcategory['title'] !!}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </li>
            @endif
        @endforeach
    </ul>
    <br />
    @if (isset($page_name) && ($page_name = 'listing') && !isset($_REQUEST['search']))
        <div class="well well-small">
            <h5 class="subMenu">Fabrics</h5>
            @foreach ($fabrics as $fabric)
                <input class="fabric" style="margin-top: -3px;" type="checkbox" name="fabric[]"
                    id="{{ $fabric }}" value="{{ $fabric }}"> &nbsp;{{ $fabric }} <br>
            @endforeach<br>
        </div>
        <div class="well well-small">
            <h5 class="subMenu">Sleeves</h5>
            @foreach ($sleeves as $sleeve)
                <input class="sleeve" style="margin-top: -3px;" type="checkbox" name="sleeve[]"
                    id="{{ $sleeve }}" value="{{ $sleeve }}"> &nbsp;{{ $sleeve }} <br>
            @endforeach<br>
        </div>
        <div class="well well-small">
            <h5 class="subMenu">Patterns</h5>
            @foreach ($patterns as $pattern)
                <input class="pattern" style="margin-top: -3px;" type="checkbox" name="pattern[]"
                    id="{{ $pattern }}" value="{{ $pattern }}"> &nbsp;{{ $pattern }} <br>
            @endforeach<br>
        </div>
        <div class="well well-small">
            <h5 class="subMenu">Occasions</h5>
            @foreach ($occasions as $occasion)
                <input class="occasion" style="margin-top: -3px;" type="checkbox" name="occasion[]"
                    id="{{ $occasion }}" value="{{ $occasion }}"> &nbsp;{{ $occasion }} <br>
            @endforeach<br>
        </div>
        <div class="well well-small">
            <h5 class="subMenu">Fits</h5>
            @foreach ($fits as $fit)
                <input style="margin-top: -3px;" class="fit" type="checkbox" name="fit[]"
                    id="{{ $fit }}" value="{{ $fit }}"> &nbsp; {!! $fit !!} <br>
            @endforeach<br>
        </div>




    @endif
    <br />

</div>
<!-- Sidebar end=============================================== -->
