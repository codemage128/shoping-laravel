`
<?php $__env->startSection('title'); ?>
    Shop Admin
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/animate/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/only_dashboard.css')); ?>"/>
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/morrisjs/morris.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/dashboard2.css')); ?>"/>
    <link href="<?php echo e(asset('assets/css/pages/tables.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/css/pages/productlist.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css')); ?>" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/portfolio.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/animate/animate.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.theme.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Product<span class="hidden-xs header_info">( shop )</span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Image List
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
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th>#</th>
                            <th>
                                Photo
                            </th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            <input type="hidden" value="<?php echo $product->id; ?>" id="productid"/>
                            <input type="hidden" value='<?php echo $product->avatar; ?>' id="imagelist"/>
                            <input type="hidden" value="<?php echo route('admin.updateimage'); ?>" id="url"/>
                            <?php $__currentLoopData = json_decode($product->avatar); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i ++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo asset('productsimage/'.$image); ?>" style="width: 100px; height: 100px"></td>
                                    <td><button class="btn btn-xs btn-danger removebtn" id="<?php echo $i - 1; ?>">remove</button></td>
                                    <input type="hidden" id="image<?php echo e($i); ?>" value="<?php echo $image; ?>"/>
                                </tr>
                            </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/countUp_js/js/countUp.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/morrisjs/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/productList.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js')); ?>"
            type="text/javascript"></script>
    <script>
        $(function () {
            var imagelist = JSON.parse($('#imagelist').val());
            var url = $('#url').val();
            var productid = $('#productid').val();
            $('.removebtn').click(function () {
                var id = parseInt($(this).attr('id'));
                for(var i = 0; i <= imagelist.length; i++){
                    if(id == i){
                        imagelist.pop(imagelist[i]);
                    }
                }
                $.ajax({
                    type: "POST",
                    url:url,
                    dataType: "json",
                    data: {productid: productid, imagelist: imagelist},
                    success: function (data) {
                        location.reload();
                    }
                })
            });

        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>