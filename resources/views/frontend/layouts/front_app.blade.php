<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Stack Developers online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Front style -->
    <link id="callCss" rel="stylesheet" href="themes/css/front.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
    <!-- Front style responsive -->
    <link href="themes/css/front-responsive.min.css" rel="stylesheet"/>
    <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
    <style type="text/css" id="enject"></style>
</head>
<body>
@include('frontend.partials.navigation')
{{-- @if (Request::segment(2) == null)

<!-- Header End====================================================================== -->
@include('frontend.partials.slider')
@endif --}}
@if (isset($page_file_name) && $page_file_name == "index")

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
<script src="themes/js/jquery.js" type="text/javascript"></script>
<script src="themes/js/front.min.js" type="text/javascript"></script>
<script src="themes/js/google-code-prettify/prettify.js"></script>

<script src="themes/js/front.js"></script>
<script src="themes/js/jquery.lightbox-0.5.js"></script>

</body>
</html>
