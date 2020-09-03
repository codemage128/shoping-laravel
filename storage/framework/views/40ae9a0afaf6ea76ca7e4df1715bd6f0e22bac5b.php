


<?php $__env->startSection('title'); ?>
    Google Information
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <h1>Google Information</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Google Information
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        
        <form method="post" action="<?php echo route('admin.otpinfo.save'); ?>">
            <?php echo csrf_field(); ?>

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
                                        <code><?php echo $google2fa_array['secret']; ?></code>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <img class="col-md-offset-2 col-md-8" alt="Image of QR barcode" src="<?php echo $google2fa_array['image']; ?>" />
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/jquery.inputmask.bundle.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/form-input-mask.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>