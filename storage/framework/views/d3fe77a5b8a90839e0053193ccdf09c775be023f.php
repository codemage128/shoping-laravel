


<?php $__env->startSection('title'); ?>
    Products
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/shopping.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/animate/animate.min.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('top'); ?>
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo e(route('home')); ?>"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                      data-loop="true" data-c="#eeeeee" data-hc="#eeeeee"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eeeeee" data-hc="#eeeeee"></i>
                    <a href="#">Products</a>
                </li>
            </ol>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3><i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#eee"
                       data-hc="#eee"></i>PRODUCTS LIST</h3>
            </div>
            <div class="col-md-6">
                <nav>
                    <ul class="pagination pull-right">
                        <?php echo $product_list->links(); ?>

                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <?php $id = 0; ?>
            <?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($product->status == "active"): ?>
                    <?php $id ++; ?>
                    <div class="col-sm-6 col-md-3 wow flipInX" data-wow-duration="3.5s">
                        <div class="thumbnail text-center">
                            <a href="<?php echo e(route('single_product', $product)); ?>">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php $__currentLoopData = json_decode($product->avatar); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="item <?php if($avatar == 0): ?> active <?php endif; ?>">
                                                <img src="<?php echo url('/').'/productsimage/'.$result; ?>"
                                                     alt="First slide" style="height: 150px">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </a>
                            <br/>
                            <h5 class="text-primary"><?php echo strtoupper($product->name); ?></h5>
                            <ul>
                                <li><i class="livicon" data-name="check" data-size="18" data-loop="true"
                                       data-c="#787878"
                                       data-hc="787878"></i> <?php echo $product->des_short; ?>

                                </li>
                                <li><i class="livicon" data-name="check" data-size="18" data-loop="true"
                                       data-c="#787878"
                                       data-hc="787878"></i>
                                    <del> € <?php echo $product->price_original; ?>  </del>
                                    ERU
                                </li>
                            </ul>
                            <h4 class="text-primary">€  <?php echo $product->price_lower; ?> EUR</h4>
                            <a href="<?php echo e(route('single_product', $product->id)); ?>"
                               class="btn btn-primary btn-block text-white">View</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/vendors/wow/js/wow.min.js')); ?>" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            new WOW().init();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>