<?php $__env->startSection('title'); ?>
    Manage
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
        <h1>Main Address Manage</h1>

    </section>
    <?php echo $__env->make('notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="content">
        <form action="<?php echo route('admin.manage_save'); ?>" method="post">
            <?php echo csrf_field(); ?>

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
                                <input class="form-control" type="text" name="address" is="address" value="<?php echo $address; ?>">
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


<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>