<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if (!empty($seo_data))
        @foreach ($seo_data as $seo)
            <title>{{ $seo->meta_title }}</title>
            <meta name=”keywords” content="{{ $seo->meta_tags }}">
            <meta name=”description” content="{{ $seo->meta_description }}">
        @endforeach
    @else
        <title>@yield('title', 'Laravel bootstrap modern ecommerce for sale')</title>
        <meta name=”keywords” content="Laravel, Bootstrap, Ajax, MySQL, ecommerce">
        <meta name=”description” content="Full featured Laravel bootstrap based modern ecommerce theme for sale.">
    @endif
    <meta name="author" content="Muhammad Hannan">
    <!-- Front style -->
    <link rel="preconnect" href="//fonts.googleapis.com" />
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin />
    <link href="//fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link id="callCss" rel="stylesheet" href="{{ URL::asset('backend') }}/themes/css/front.min.css" media="screen" />
    <link href="{{ URL::asset('backend') }}/themes/css/base.css" rel="stylesheet" media="screen" />
    <!-- Front style responsive -->
    <link href="{{ URL::asset('backend') }}/themes/css/front-responsive.min.css" rel="stylesheet" />
    <link href="{{ URL::asset('backend') }}/themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="{{ URL::asset('backend') }}/themes/js/google-code-prettify/prettify.css" rel="stylesheet" />
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{ URL::asset('backend') }}/themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('backend') }}/themes/images/ico/apple-icon-180x180.png">
    {{--<link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">--}}
    {{--<meta name="theme-color" content="#ffffff">--}}
    <style type="text/css" id="enject"></style>
    @yield('styles')
</head>

<body>
    @include('frontend.partials.navigation')
    {{-- @if (Request::segment(2) == null)
<!-- Header End====================================================================== -->
@include('frontend.partials.slider')
@endif --}}
    @if (isset($page_file_name) && $page_file_name == 'index')
        <!-- Header End====================================================================== -->
        @include('frontend.partials.slider')
    @endif
    <div id="mainBody">
        <div class="container">
            <div class="row">
                @include('frontend.partials.sidebar')
                @yield('content')
            </div>
        </div>
    </div>
    @include('frontend.partials.footer')
    <!-- Placed at the end of the document so the pages load faster ============================================= -->
    <script src="{{ URL::asset('backend') }}/themes/js/jquery.js" type="text/javascript"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js" integrity="sha512-c3Nl8+7g4LMSTdrm621y7kf9v3SDPnhxLNhcjFJbKECVnmZHTdo+IRO05sNLTH/D3vA6u1X32ehoLC7WFVdheg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <!-- jquery-validation -->
    <script src="//code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
    <script src="{{ URL::asset('backend') }}/themes/js/front.min.js" type="text/javascript"></script>
    <script src="{{ URL::asset('backend') }}/themes/js/google-code-prettify/prettify.js"></script>
    <script src="{{ URL::asset('backend') }}/themes/js/front.js"></script>
    <script src="{{ URL::asset('backend') }}/themes/js/jquery.lightbox-0.5.js"></script>
    <script src="{{ URL::asset('') }}js/front_end.js"></script>
    @yield('scripts')
</body>

</html>
