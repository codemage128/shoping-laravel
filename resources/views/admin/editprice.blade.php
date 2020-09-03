`@extends('admin/layouts/default')
@section('title')
    Shop Admin
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/morrisjs/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dashboard2.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/productlist.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/portfolio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
    <style>
        #overlay {
            background: #ffffff;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .80;
        }
        .spinner {
            margin: 0 auto;
            height: 64px;
            width: 64px;
            animation: rotate 0.8s infinite linear;
            border: 5px solid firebrick;
            border-right-color: transparent;
            border-radius: 50%;
        }
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@stop
@section('content')
    <div id="overlay" style="display:none;">
        <div class="spinner"></div>
        <br/>
        Loading...
    </div>
    <section class="content-header">
        <h1>Product<span class="hidden-xs header_info">( shop )</span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Price List
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-offset-2 col-md-8">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Image List
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{!! route('admin.addprice', $data[0]->id) !!}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" value="0" id="priceid" name="priceid"/>
                        <input type="hidden" value="add" id="addflag" name="addflag"/>
                        <div class="row">
                            <div class="col-md-1">
                                <label class="control-label">Weight</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control"  name="weight" id="weight"/>
                            </div>
                            <div class="col-md-1">
                                <label class="control-label" >Price</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="price" id="price"/>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-xs" id="button_type">Add Price</button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-default btn-xs" id="refresh_btn">
                                    <i class="livicon" data-name="refresh" data-size="20" data-loop="true"
                                       data-c="#fff" data-hc="white"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th>#</th>
                            <th>
                                Weight(g)
                            </th>
                            <th>
                                Price(€)
                            </th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" value='{!! json_encode($data[1]) !!}' id="pricelist"/>
                            @php $i = 0; @endphp
                            @foreach($data[1] as $price)
                                @php $i ++; @endphp
                                <tr class="price_row" id="{!! $price->id !!}">
                                    <td>{!! $i !!}</td>
                                    <td>{!! $price->weight !!}</td>
                                    <td>{!! $price->price !!}</td>
                                    <td>
                                        <a style="display: inline-block !important;"  class="btn btn-danger btn-xs remove_btn" href="{!! route('admin.removeprice', $price->id) !!}">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    <script src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/productList.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"
            type="text/javascript"></script>
    <script>
        $(function () {
            var pricelist = JSON.parse($('#pricelist').val());
            $('.remove_btn').click(function () {
                $('#overlay').fadeIn().delay(10000).fadeOut();
            })
            $('.price_row').click(function () {
                $('#button_type').text("Update Price");
                var id = $(this).attr('id');
                console.log(id);
                for(var i = 0; i < pricelist.length; i ++){
                    if(pricelist[i].id == id){
                        $('#weight').val(pricelist[i].weight);
                        $('#price').val(pricelist[i].price);
                        $('#addflag').val('update');
                        $('#priceid').val(id);
                    }
                }
            });
            $('#refresh_btn').click(function () {
                $('#button_type').text("Add Price");
                $('#weight').val("");
                $('#price').val("");
                $('#addflag').val('add');
            });
        })
    </script>
@stop