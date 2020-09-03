<?php $__env->startSection('title'); ?>
    Single Product
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
                                     alt="First slide" style="width: 100%">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-dismissable margin5" style="background-color: #59a457">
                        <h4>Your order is now being processed via our bitcoin merchant. Please add noreply@darkrice.online to your contacts and check your inbox/spam folder for the confirmation email. Depending on the fee you chose it will take some time for the coins to reach us! Thank you for shopping with Dark Rice.</h4>
                    </div>
                    <h2 class="text-primary"><?php echo \App\Product::find($transaction->product_id)->name; ?></h2>
                    <hr>
                    <h4>Amount : <?php echo $transaction->amount; ?> g</h4>
                    <h5></h5>
                    <h4>Total Amount + Fee : <?php echo $transaction->total_amount; ?> €</h4>
                    <h4>BitCoin <span style="color: yellow">(Today : <?php echo $todayprice; ?> €)</span> : <?php echo $total_btc; ?>

                        (BTC)</h4>
                    <h4>Input Address : <span style="color: #59a457"><?php echo $transaction->input_address; ?></span></h4>
                    <h5 style="font-weight: bold"></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                <a href="<?php echo route('single_product',  $transaction->product_id); ?>" type="button"
                   class="btn btn-default">Back</a>
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