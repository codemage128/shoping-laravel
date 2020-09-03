@extends('admin/layouts/default')
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
@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Transaction<span class="hidden-xs header_info">( shop )</span></h1>
    </section>
    <section class="content">
        <div class="col-md-9">
            <div class="portlet box black_bg">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Transaction List
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <label class="col-md-offset-4 col-md-2 control-label">Filter By: </label>
                        <div class="col-md-3">
                            <form id="sort_form" method="get">
                                {!! csrf_field() !!}
                                <input type="hidden" value="{!! route('admin.transaction2', 0) !!}" id="refreshurl">
                                <select class="form-control" id="show_status">
                                    <option value="4"></option>
                                    <option value="0" @if($id == 0) selected @else @endif>Initial</option>
                                    <option value="1" @if($id == 1) selected @endif>Pending</option>
                                    <option value="2" @if($id == 2) selected @endif>Success</option>
                                    <option value="3" @if($id == 3) selected @endif>Fail</option>
                                    <option value="5" @if($id == 5) selected @endif>Particial Payed</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="pagination pull-right" style="margin-bottom: -30px;">
                                    {!! $transactions->links() !!}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th></th>
                            <th>
                                Input_address
                            </th>
                            <th>
                                Product Name
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Total Amount
                            </th>
                            <th>
                                Total BitCoin
                            </th>
                            <th>
                                Pay Status
                            </th>
                            <th>
                                Date
                            </th>
{{--                            <th></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0 + ($transactions->currentPage() - 1) * 10 ;@endphp
                            @foreach($transactions as $transaction)
                                @php $i ++; @endphp
                                <tr id="everytransaction{!! $transaction->id !!}" class="detail_transaction"
                                    transactionId="{!! $transaction->id !!}"
                                    action="{!! route('admin.getTransactionInfo') !!}" style="z-index: -10">
                                    <td>{!! $i !!}</td>
                                    <td class="highlight">
                                        <div class="success"></div>
                                        <a href="#">{!! $transaction->input_address !!}</a>
                                    </td>
                                    <td>{!! \App\Product::find($transaction->product_id)->name !!}</td>
                                    <td>
                                        {!! $transaction->amount !!} g
                                    </td>
                                    <td>{!! $transaction->total_amount !!} </td>
                                    <td>{!! $transaction->total_bitcoin !!} </td>
                                    <td>
                                        @switch ($transaction->pay_status)
                                            @case(0)  <span class="label label-default">Initial</span> @break
                                            @case(1)  <span class="label label-info">Pending</span> @break
                                            @case(2)  <span class="label label-success">Success</span> @break
                                            @case(3)  <span class="label label-danger">Failed</span> @break
                                            @case(5)  <span class="label label-warning">Particial Payed</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        {!! $transaction->created_at->format('Y-m-d H:i')!!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i>
                        <span id="title">Transaction Info</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="addflag" value="1"/>
                    <form class="form form-horizontal" id="productinfo_form" method="post">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Input Address</label>
                            <div class="col-md-8">
                                <input type="hidden" id="current_id" name="current_id">
                                <input class="form-control" id="input_address" name="input_address"
                                       placeholder="Input Address" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-8">
                                <input class="form-control" id="product_name" name="product_name"
                                       placeholder="Product Name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                Amount (g)
                            </label>
                            <div class="col-md-8">
                                <input id="amount" name="amount" class="form-control" type="number"
                                       placeholder="amount" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Total Amount</label>
                            <div class="col-md-8">
                                <input id="total_amount" name="total_amount" class="form-control" type="number"
                                       placeholder="Total Amount" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Total BitCoin</label>
                            <div class="col-md-8">
                                <input id="total_bitcoin" name="total_bitcoin" class="form-control" type="number"
                                       placeholder="Total BitCoin" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Payed BitCoin</label>
                            <div class="col-md-8">
                                <input id="payed_bitcoin" name="payed_bitcoin" class="form-control" type="number"
                                       placeholder="Payed BitCoin" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Customer Email</label>
                            <div class="col-md-8">
                                <input id="customer_email" name="customer_email" class="form-control" type="email"
                                       placeholder="Customer Email" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Customer Information</label>
                            <div class="col-md-8">
                            <textarea id="customer_info" name="customer_info"
                                      class="form-control resize_vertical" rows="10"
                                      placeholder="Show the Information. e.g comments" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8">
                                <input id="pay_status" class="form-control" readonly placeholder="Initial">
                            </div>
                        </div>
                        <hr>
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

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    {{--<script src="http://demo.lorvent.com/rare/default/vendors/raphael/js/raphael.min.js"></script>--}}
    <script src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/transaction.js') }}"></script>

    {{--    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>--}}
@stop