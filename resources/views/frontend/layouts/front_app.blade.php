<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'eCommerce')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
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
