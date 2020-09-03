@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View Information
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
    <link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop
{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Front View Information</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Front View Information
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-offset-1 col-md-10">
            <div class="portlet box primary">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i>Front View Information
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                            <li class="active">
                                <a href="#contactus" data-toggle="tab">Contact</a>
                            </li>
                            <li>
                                <a href="#news" data-toggle="tab">News</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="contactus">
                            <form method="post" action="{!! route('admin.viewinfo.save')!!}"
                                  enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Home Images</label>
                                        <div class="col-md-4">
                                            <input type='file' name="photos[]" id="upload_temp" multiple>
                                        </div>
                                        <div class="col-md-4">
                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach(json_decode($viewinfo->home_photo) as $photo => $result)
                                                        <div class="item @if($photo == 0) active @endif">
                                                            <img src="{!! url('/').'/productsimage/'.$result !!}"
                                                                 alt="First slide">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <div id="file-list-display">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Instagram Link (*Please type the Full
                                                Link)</label>
                                        </div>
                                        <div class="form-group">
                                            <input required class="form-control" name="instagram"
                                                   value="{!! $viewinfo->instagram !!}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">About Us</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <textarea id="about_us" name="about_us"
                                                      class="form-control resize_vertical" rows="12"
                                                      placeholder="Type the your information,">{!! $viewinfo->about_us !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Contact Us</label>
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label class="control-label">Address</label>--}}
{{--                                            <input required class="form-control" type="text" name="address"--}}
{{--                                                   placeholder="Address"--}}
{{--                                                   is="address" value="{!! $viewinfo->address !!}">--}}
{{--                                            {!! $errors->first('address', '<span class="help-block" style="color:red !important">:message</span>') !!}--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label class="control-label">WICKR</label>
                                            <input required class="form-control" type="text"
                                                   name="phone"
                                                   placeholder="Phone" value="{!! $viewinfo->phone !!}">
                                            {!! $errors->first('phone', '<span class="help-block" style="color:red !important">:message</span>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">THREEMA</label>
                                            <input required class="form-control" type="text" name="fax"
                                                   placeholder="Fax"
                                                   is="fax" value="{!! $viewinfo->fax !!}">
                                            {!! $errors->first('fax', '<span class="help-block" style="color:red !important">:message</span>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input required class="form-control" type="text" name="email"
                                                   placeholder="Email"
                                                   is="email"
                                                   value="{!! $viewinfo->email !!}">
                                            {!! $errors->first('email', '<span class="help-block" style="color:red !important">:message</span>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">TELEGRAM</label>
                                            <input required class="form-control" type="text" name="skype"
                                                   placeholder="Skype"
                                                   is="skype"
                                                   value="{!! $viewinfo->skype !!}">
                                            {!! $errors->first('skype', '<span class="help-block" style="color:red !important">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-offset-10 col-md-2">
                                            <button class="btn btn-danger form-control" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="news">
                            <div class='box-body pad'>
                                <textarea id="content_news" name="content" placeholder="Please type the contents!"
                                          class="textarea form-control"> {!! \App\ViewInfo::first()->news_content !!}</textarea>
                            </div>
                            <input action="{!! route('admin.save.news') !!}" type="hidden" id="news_url">
                            <div class="row">
                                <div class="col-md-offset-8 col-md-2">
                                    <button class="btn btn-default form-control" id="preview_news_button"
                                            type="button">Preview
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger form-control" id="save_news_button" type="button">
                                        Save
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="preview_news">
                                    {!! \App\ViewInfo::first()->news_content !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/form-input-mask.js') }}" type="text/javascript"></script>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="{!! asset('assets/js/save_news.js') !!}"></script>
@stop
