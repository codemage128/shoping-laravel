


<?php $__env->startSection('title'); ?>
    Single Product| Welcome to Josh Frontend
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/cart.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/tabbular.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/bootstrap-rating/bootstrap-rating.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/cart.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/tabbular.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/bootstrap-rating/bootstrap-rating.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/tabbular.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/animate/animate.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/jquery.circliful.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/owl_carousel/css/owl.theme.css')); ?>">
    <!--end of page level css-->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('top'); ?>
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo e(route('home')); ?>"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                      data-loop="true" data-c="#eee" data-hc="#eee"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eee" data-hc="#eee"></i>
                    <a href="#">Single Product</a>
                </li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="mart10">
                <div class="col-md-4">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <?php $__currentLoopData = json_decode(\App\Product::find($transaction->product_id)->avatar); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item <?php if($avatar == 0): ?> active <?php endif; ?>">
                                <img src="<?php echo url('/').'/productsimage/'.$result; ?>"
                                     alt="First slide" style="height: 150px; width: 100%">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-warning alert-dismissable margin5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Note:</strong> You must pay within 150 minutes.
                    </div>
                    <h2 class="text-primary"><?php echo \App\Product::find($transaction->product_id)->name; ?></h2>
                    <?php switch($transaction->pay_status):
                        case (0): ?> <span class="label label-default">Initial</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i><?php break; ?>
                        <?php case (1): ?> <span class="label label-success">Success</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i><?php break; ?>
                        <?php case (2): ?> <span class="label label-info">Pending</span>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-danger"></i>
                        <i class="fa fa-star text-default"></i><?php break; ?>
                        <?php case (3): ?> <span class="label label-danger">Fail</span>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i>
                        <i class="fa fa-star text-default"></i><?php break; ?>
                    <?php endswitch; ?>
                    <hr>
                    <h4>Quantity</h4>
                    <h5><?php echo $transaction->quantity; ?></h5>
                    <h4>Price</h4>
                    <h5><?php echo $transaction->product_price; ?></h5>
                    <h4>Total Amount</h4>
                    <h5><?php echo ($transaction->quantity * $transaction->product_price); ?> €</h5>
                    <h4>BitCoin (Today : <?php echo $todayprice; ?> €)</h4>
                    <h5><?php echo $total_btc; ?></h5>
                    <h4>Input Address</h4>
                    <h5 style="font-weight: bold"><?php echo $transaction->input_address; ?></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-8 col-md-4">
                <a href="<?php echo route('confirm', $transaction->id); ?>" class="btn btn-default" type="button">Confirm</a>
                <a href="<?php echo route('single_product',  $transaction->product_id); ?>" type="button" class="btn btn-default">Back</a>
            </div>
        </div>
        <hr>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/elevatezoom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-rating/bootstrap-rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/cart.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/elevatezoom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-rating/bootstrap-rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/cart.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/jquery.circliful.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/wow/js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/owl_carousel/js/owl.carousel.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/carousel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>