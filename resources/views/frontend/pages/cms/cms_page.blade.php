@extends('frontend.layouts.front_app')
@section('title')
    Product Cart
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">{{ $cmsPageDetails['title'] }}</li>
        </ul>
        <h3>{{ $cmsPageDetails['title'] }}</h3>
        <hr class="soft">
        <h5>Lorem ipsum dolor sit amet</h5><br>
        <p>
            {!! $cmsPageDetails['description'] !!}
        </p>

    </div>
@endsection
