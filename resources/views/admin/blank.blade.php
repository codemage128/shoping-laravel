@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Manage
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
@stop
@section('content')
    <section class="content-header">
        <h1>Main Address Manage</h1>

    </section>
    @include('notifications')
    <section class="content">
        <form action="{!! route('admin.manage_save') !!}" method="post">
            {!! csrf_field() !!}
            <div class="col-md-offset-2 col-md-8">
                <div class="portlet box black_bg">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i> Main Address Manage
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">Address</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="address" is="address" value="{!! $address !!}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-offset-8 col-md-4">
                                    <button class="btn btn-primary form-control" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
