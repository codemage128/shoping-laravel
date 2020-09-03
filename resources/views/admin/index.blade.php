`@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Shop Admin
    @parent
@stop

{{-- page level styles --}}
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
@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Product<span class="hidden-xs header_info">( shop )</span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Product List
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-8">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Product List
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <label class="col-md-offset-4 col-md-2 control-label">Filter By: </label>
                        <div class="col-md-3">
                            <form id="sort_form" method="get">
                                {!! csrf_field() !!}
                                <input type="hidden" value="{!! route('admin.dashboard2', 0) !!}" id="refreshurl">
                                <select class="form-control" id="show_status">
                                    <option value="4"></option>
                                    <option value="active" @if($id == "active") selected @else @endif>Active</option>
                                    <option value="inactive" @if($id == "inactive") selected @endif>InActive</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="pagination pull-right">
                                    {!! $product_list->links() !!}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th></th>
                            <th>
                                Name
                            </th>
                            <th>
                                Photo
                            </th>
                            <th>
                                Detail
                            </th>
                            <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0; @endphp
                            @foreach($product_list as $product)
                                @php $i ++; @endphp
                                <tr id="everyproduct{!! $product->id !!}" class="detail_product"
                                    productid="{!! $product->id !!}"
                                    action="{!! route('admin.getProductInfo') !!}" style="z-index: -10">
                                    <td>{!! $i !!}</td>
                                    <td class="highlight">
                                        <div class="success"></div>
                                        <a href="#">{!! $product->name !!}</a>
                                    </td>
                                    <td width="20%">
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach(json_decode($product->avatar) as $avatar => $result)
                                                    <div class="item @if($avatar == 0) active @endif">
                                                        <img src="{!! url('/').'/productsimage/'.$result !!}"
                                                             alt="First slide">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>{!! $product->des_short !!}</td>
                                    <td>
                                        <div class="row">
                                            <a class="btn default btn-xs mb-2" style="display: inline-block !important;"
                                               href="{!! route('admin.editimage', $product->id) !!}">
                                                &nbsp;&nbsp;&nbsp;<i class="livicon" data-name="edit" data-loop="true"
                                                                     data-color="#000"
                                                                     data-hovercolor="black" data-size="14"></i>Edit
                                                Photo&nbsp;&nbsp;
                                            </a>
                                        </div>
                                        <div class="row">
                                            <a class="btn default btn-xs mb-2" style="display: inline-block !important;"
                                               href="{!! route('admin.editprice', $product->id) !!}">
                                                &nbsp;&nbsp;&nbsp;<i class="livicon" data-name="edit" data-loop="true"
                                                                     data-color="#000"
                                                                     data-hovercolor="black" data-size="14"></i>Edit
                                                Price&nbsp;&nbsp;&nbsp;
                                            </a>
                                        </div>
                                        <div class="row">
                                            <button class="del_product btn default btn-xs purple"
                                                    id="del_product{!! $product->id !!}"
                                                    action="{!! route('admin.delProductInfo') !!}"
                                                    productid="{!! $product->id !!}" style="z-index: 10">
                                                <i class="livicon" data-name="pen" data-loop="true" data-color="#000"
                                                   data-hovercolor="black" data-size="14"></i>
                                                Del Product<input type="hidden" id="productid{!! $product->id !!}"
                                                                  value="{!! $product->id !!}"/>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i>
                        <span id="title">Add Product</span>
                    </h3>
                    <span class="pull-right">
{{--                        <i class="glyphicon glyphicon-chevron-up clickable"></i>--}}
                        <a id="refresh"><i class="livicon" data-name="refresh" data-size="25" data-loop="true"
                                           data-c="#fff" data-hc="white"></i></a>
{{--                        <i class="glyphicon glyphicon-remove removepanel clickable"></i>--}}
                    </span>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="addflag" value="1"/>
                    <form class="form form-horizontal" id="productinfo_form" method="post"
                          enctype="multipart/form-data">
                        <input type="hidden" id="addurl" value="{!! route('admin.addProductInfo') !!}">
                        <input type="hidden" id="updateurl" value="{!! route('admin.updateProductInfo') !!}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-8">
                                <input type="hidden" id="current_id" name="current_id">
                                <input class="form-control" id="name" name="name" placeholder="Product Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Short Descritpion</label>
                            <div class="col-md-8">
                                <textarea id="description_short" name="description_short"
                                          class="form-control resize_vertical"
                                          rows="2" placeholder="Type the SHORT description of the Product"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Long Description</label>
                            <div class="col-md-8">
                                <textarea id="description_long" name="description_long"
                                          class="form-control resize_vertical" rows="5"
                                          placeholder="Type the DETAIL description of the Product"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">UK Fee (€)</label>
                            <div class="col-md-8">
                                <input id="price_fee_first" name="price_fee_first" class="form-control" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">EU Fee (€)</label>
                            <div class="col-md-8">
                                <input id="price_fee_second" name="price_fee_second" class="form-control" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Other Fee (€)</label>
                            <div class="col-md-8">
                                <input id="price_fee_third" name="price_fee_third" class="form-control" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Photo</label>
                            <div class="col-md-8">
                                <input type='file' name="avatars[]" id="upload_temp" multiple>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-8">
                                <div id="file-list-display"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8">
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="old_price_div">
                            <div class="row">
                                <div class="col-md-offset-3">
                                    <table class="table">
                                        <thead>
                                        <th>Weight(g)</th>
                                        <th>Price(€)</th>
                                        </thead>
                                        <tbody id="old_price_table">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-position">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-responsive btn-danger btn-sm"
                                        id="btn_add_update"><span
                                            id="button_type">Add Product</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <p>You are already editing a row, you must save or cancel that row before edit/delete a new row</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    {{--<script src="http://demo.lorvent.com/rare/default/vendors/raphael/js/raphael.min.js"></script>--}}
    <script src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/productList.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#upload_temp').on("change", previewImages);

            function previewImages() {
                var preview = $('#file-list-display');
                preview.empty();
                if (this.files) {
                    [].forEach.call(this.files, readAndPreview);
                }

                function readAndPreview(file) {
                    // Make sure `file.name` matches our extensions criteria
                    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                        return alert(file.name + " is not an image");
                    } // else...F
                    var reader = new FileReader();
                    reader.addEventListener("load", function () {
                        var image = new Image();
                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        preview.append(image);
                    });
                    reader.readAsDataURL(file);
                }
            }
        });

    </script>
@stop