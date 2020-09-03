@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Single Product
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                      data-loop="true" data-c="#eee" data-hc="#eee"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eee" data-hc="#eee"></i>
                    <a href="#">Single Product</a>
                </li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="mart10">
                <div class="col-md-4">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        @foreach(json_decode(\App\Product::find($transaction->product_id)->avatar) as $avatar => $result)
                            <div class="item @if($avatar == 0) active @endif">
                                <img src="{!! url('/').'/productsimage/'.$result !!}"
                                     alt="First slide" style="width: 100%">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-warning alert-dismissable margin5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Note:</strong> You must pay within 150 minutes.
                    </div>
                    <h2 class="text-primary">{!! \App\Product::find($transaction->product_id)->name !!}</h2>
                    @switch($transaction->pay_status)
                        @case(0) <span class="label label-default">Initial</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i>@break
                        @case(1) <span class="label label-success">Success</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i>@break
                        @case(2) <span class="label label-info">Pending</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-default"></i>@break
                        @case(3) <span class="label label-danger">Fail</span>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i>@break
                    @endswitch
                    <hr>
                    <h4>Amount : {!! $transaction->amount !!} g</h4>
                    <h4>Total Amount + Fee : {!! $transaction->total_amount !!} €</h4>
                    <h4>BitCoin <span style="color: yellow">(Today : {!! $todayprice !!} €) : {!! $total_btc !!}</span></h4>
                    <h4>Input Address : <span style="color: #59a457">{!! $transaction->input_address !!}</span></h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-8 col-md-4">
                <a href="{!! route('payconfirm', $transaction->id) !!}" class="btn btn-default" type="button">Confirm</a>
                <a href="{!! route('single_product',  $transaction->product_id)!!}" type="button" class="btn btn-default">Back</a>
            </div>
        </div>
        <hr>
    </div>
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
@stop
