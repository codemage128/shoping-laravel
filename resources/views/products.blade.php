@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Products
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                      data-loop="true" data-c="#eeeeee" data-hc="#eeeeee"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eeeeee" data-hc="#eeeeee"></i>
                    <a href="#">Products</a>
                </li>
            </ol>
        </div>
    </div>
@stop
{{-- Page content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3><i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#eee"
                       data-hc="#eee"></i>PRODUCTS LIST</h3>
            </div>
            <div class="col-md-6">
                <nav>
                    <ul class="pagination pull-right">
                        {!! $product_list->links() !!}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            @php $id = 0; @endphp
            @foreach($product_list as $product)
                @if($product->status == "active")
                    @php $id ++; @endphp
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail text-center">
                            <a href="{{ route('single_product', $product) }}">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach(json_decode($product->avatar) as $avatar => $result)
                                            <div class="item @if($avatar == 0) active @endif">
                                                <img src="{!! url('/').'/productsimage/'.$result!!}"
                                                     alt="First slide"/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                            <br/>
                            <h5 class="text-primary">{!! strtoupper($product->name) !!}</h5>
                            <hr>
                            <div style="max-height: 25px; overflow: hidden;text-overflow: ellipsis; !important;white-space: nowrap;">
                                {!! $product->des_short!!}
                            </div>
                            <hr>
                            <a href="{{ route('single_product', $product->id) }}"
                               class="btn btn-primary btn-block text-white">View</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            new WOW().init();
        });
    </script>
@stop
