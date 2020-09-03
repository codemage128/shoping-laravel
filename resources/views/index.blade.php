@extends('layouts/default')
@section('title')
    Home
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
@stop
@section('top')
    <div class="row">
        <div class="col-md-12">
        <div id="owl-demo" class="owl-carousel owl-theme">
            @foreach(json_decode(\App\ViewInfo::first()->home_photo) as $photo => $result)
                <div class="item  @if($photo == 0) active @endif">
                    <img class="img-responsive" src="{!! url('/').'/productsimage/'.$result !!}"
                         alt="First slide">
                </div>
            @endforeach
        </div>
        </div>
    </div>
@stop
@section('content')
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
@stop
