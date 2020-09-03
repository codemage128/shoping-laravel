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
                    <a href="{{ route('products') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                          data-loop="true" data-c="#eeeeee" data-hc="#eeeeee"></i>Produts
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eeeeee" data-hc="#eeeeee"></i>
                    <a>{!! $product->name !!}</a>
                </li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="mart10">
                <div class="col-sm-4">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        @foreach(json_decode($product->avatar) as $avatar => $result)
                            <div class="item @if($avatar == 0) active @endif">
                                <img src="{!! url('/').'/productsimage/'.$result !!}"
                                     alt="First slide" style="width: 100%">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12"> @include('notifications')</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-primary">{!! strtoupper($product->name) !!}</h2>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>{!! $product->des_short !!}</p>
                        </div>
                    </div>
                    <hr>
                    <form action="{!! route('payment', $product->id) !!}" method="post">
                        <div class="row" style="margin-left: 5px">
                            <div class="col-sm-3">
                                <input type="hidden" value='{!! $weight!!}' id="pricelist"/>
                                <div class="form-group {{ $errors->first('amount', 'has-error') }}">
                                    {!! csrf_field() !!}
                                    <select class="col-md-12 form-control" style="width:100px;" name="amount"
                                            id="amount">
                                        <option value="0"></option>
                                        @foreach($weight as $item)
                                            <option value="{!! $item->weight !!}">{!! $item->weight !!}g</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row" id="total_div">
                                    <div class="col-md-12">
                                        <h4 id="total_amount"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <span style="color: #6cc46c">(If you don't select fee option, default fee will be UK fee.) </span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_first" id="fee_first" class="col-sm-2"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">UK Fee
                                        ({!! $product->price_fee_first !!} €/ g)</label>
                                    <input type="hidden" id="fee_first_value" value="{!! $product->price_fee_first !!}"/>
                                </div>
                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_second" id="fee_second" class="col-sm-6"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">EU Fee
                                        ({!! $product->price_fee_second !!} €/ g)</label>
                                    <input type="hidden" id="fee_second_value" value="{!! $product->price_fee_second !!}"/>
                                </div>
                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_third" id="fee_third" class="col-sm-6"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">Other Country Fee
                                        ({!! $product->price_fee_third !!} €/ g)</label>
                                    <input type="hidden" id="fee_third_value" value="{!! $product->price_fee_third !!}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-sm-3">
                                <button type="submit" data-toggle="collapse" data-target="#payfield"
                                        class="col-sm-12 btn btn-primary text-white">Buy
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Email</h4>
                                <div class="form-group {{$errors->first('email', 'has-error')}}">
                                    <input type="text" class="form-control" placeholder="Email" name="email">
                                </div>
                                {!! $errors->first('email', '<span class="help-block" style="color:red !important">The Email field is required.</span>') !!}
                                <h4>Delivery information</h4>
                                <div class="form-group {{ $errors->first('custominfo', 'has-error') }}">
                            <textarea name="custominfo"
                                      class="form-control resize_vertical {{ $errors->first('custominfo', 'has-error') }}"
                                      rows="5"></textarea>
                                </div>
                                {!! $errors->first('custominfo', '<span class="help-block" style="color:red !important">The delivery information field is required.</span>') !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                    Description </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <p>{!! $product->des_long !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/frontend/elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/cart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/single_product.js') }}"></script>
@stop
