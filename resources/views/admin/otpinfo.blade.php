@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Google Information
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
{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Google Information</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Google Information
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        {{--        action="{!! route('admin.viewinfo.save') !!}"--}}
        <form method="post" action="{!! route('admin.otpinfo.save')!!}">
            {!! csrf_field() !!}
            <div class="col-md-offset-3 col-md-6">
                <div class="portlet box primary">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i> Set Up Google Authenticator
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                                <div class="form-group">
                                    <label class="control-label text-center">
                                        Set up your two factor authentication by scanning the barcode below. Alternatively, you can use code
                                        <code>{!! $google2fa_array['secret']!!}</code>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <img class="col-md-offset-2 col-md-8" alt="Image of QR barcode" src="{!! $google2fa_array['image'] !!}" />
                                </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <button class="btn btn-danger form-control" type="submit">Generate</button>
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
    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/form-input-mask.js') }}" type="text/javascript"></script>
@stop
