@extends('admin/layouts/default')

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/portfolio.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">--}}
@stop
{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Client Logs<span class="hidden-xs header_info"></span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Client Logs
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-12">
            <div class="portlet box black_bg">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Client Logs
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <label class="col-md-offset-4 col-md-2 control-label">Filter By: </label>
                        <div class="col-md-3">
                            <form action="{!! route('admin.filter_date') !!}" id="filter_date_form" method="get">
                                {!! csrf_field() !!}
                                <input type="hidden" name="startDate" id="startDate">
                                <input type="hidden" name="endDate" id="endDate">
                            </form>
                            <input type="hidden" action="{!! route('admin.filter_date') !!}" id="filter_date">
                            <input class="form-control" type="text" id="datepicker">
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="pagination pull-right" style="margin-bottom: -30px;">
                                    {!! $logs->links() !!}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th></th>
                            <th>
                                Ip Address
                            </th>
                            <th>
                                Login Date
                            </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php  $i = 0 + ($logs->currentPage() - 1) * 10 ; @endphp
                            @foreach($logs as $log)
                                @php $i ++; @endphp
                                <tr id="everytransaction{!! $log->id !!}" class="detail_transaction"
                                    transactionId="{!! $log->id !!}"
                                    action="{!! route('admin.getTransactionInfo') !!}" style="z-index: -10">
                                    <td>{!! $i !!}</td>
                                    <td class="highlight">
                                        <div class="success"></div>
                                        <a href="#">{!! $log->ipaddress !!}</a>
                                    </td>
                                    <td>
                                        {!! $log->created_at !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!--for calendar-->
        <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    {{--<script src="http://demo.lorvent.com/rare/default/vendors/raphael/js/raphael.min.js"></script>--}}
    <script src="{{ asset('assets/vendors/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/transaction.js') }}"></script>
    {{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                }
            }, function (start, end, label) {
                var url = $('#filter_date').attr('action');
                var form = $('#filter_date_form');
                $('#startDate').val(start.format('YYYY-MM-DD'));
                $('#endDate').val(end.format('YYYY-MM-DD'));
                form.submit();
            });
        });
    </script>
    {{--    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>--}}
@stop