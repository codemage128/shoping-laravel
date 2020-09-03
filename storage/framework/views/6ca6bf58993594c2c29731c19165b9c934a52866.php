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
                    <a href="<?php echo e(route('products')); ?>"> <i class="livicon icon3 icon4" data-name="home" data-size="18"
                                                          data-loop="true" data-c="#eeeeee" data-hc="#eeeeee"></i>Produts
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true"
                       data-c="#eeeeee" data-hc="#eeeeee"></i>
                    <a><?php echo $product->name; ?></a>
                </li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="mart10">
                <div class="col-sm-4">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <?php $__currentLoopData = json_decode($product->avatar); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item <?php if($avatar == 0): ?> active <?php endif; ?>">
                                <img src="<?php echo url('/').'/productsimage/'.$result; ?>"
                                     alt="First slide" style="width: 100%">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12"> <?php echo $__env->make('notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-primary"><?php echo strtoupper($product->name); ?></h2>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                            <i class="fa fa-star text-primary"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <p><?php echo $product->des_short; ?></p>
                        </div>
                    </div>
                    <hr>
                    <form action="<?php echo route('payment', $product->id); ?>" method="post">
                        <div class="row" style="margin-left: 5px">
                            <div class="col-sm-3">
                                <input type="hidden" value='<?php echo $weight; ?>' id="pricelist"/>
                                <div class="form-group <?php echo e($errors->first('amount', 'has-error')); ?>">
                                    <?php echo csrf_field(); ?>

                                    <select class="col-md-12 form-control" style="width:100px;" name="amount"
                                            id="amount">
                                        <option value="0"></option>
                                        <?php $__currentLoopData = $weight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo $item->weight; ?>"><?php echo $item->weight; ?>g</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="row" id="total_div">
                                    <div class="col-md-12">
                                        <h4 id="total_amount"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">





                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_first" id="fee_first" class="col-sm-2"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">UK Fee
                                        (<?php echo $product->price_fee_first; ?> €/ g)</label>
                                    <input type="hidden" id="fee_first_value" value="<?php echo $product->price_fee_first; ?>"/>
                                </div>
                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_second" id="fee_second" class="col-sm-6"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">EU Fee
                                        (<?php echo $product->price_fee_second; ?> €/ g)</label>
                                    <input type="hidden" id="fee_second_value" value="<?php echo $product->price_fee_second; ?>"/>
                                </div>
                                <div class="row" style="padding-left: 15px">
                                    <input type="checkbox" name="fee_third" id="fee_third" class="col-sm-6"
                                           style="width:20px;height: 20px"/>
                                    <label class="col-sm-10" style="color: white; font-size: 16px">Other Country Fee
                                        (<?php echo $product->price_fee_third; ?> €/ g)</label>
                                    <input type="hidden" id="fee_third_value" value="<?php echo $product->price_fee_third; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 5px">
                            <div class="col-sm-3">
                                <button type="submit" data-toggle="collapse" data-target="#payfield"
                                        class="col-sm-12 btn btn-primary text-white">Buy
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Email</h4>
                                <div class="form-group <?php echo e($errors->first('email', 'has-error')); ?>">
                                    <input type="text" class="form-control" placeholder="Email" name="email">
                                </div>
                                <?php echo $errors->first('email', '<span class="help-block" style="color:red !important">The Email field is required.</span>'); ?>

                                <h4>Delivery information</h4>
                                <div class="form-group <?php echo e($errors->first('custominfo', 'has-error')); ?>">
                            <textarea name="custominfo"
                                      class="form-control resize_vertical <?php echo e($errors->first('custominfo', 'has-error')); ?>"
                                      rows="5"></textarea>
                                </div>
                                <?php echo $errors->first('custominfo', '<span class="help-block" style="color:red !important">The delivery information field is required.</span>'); ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                    Description </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <p><?php echo $product->des_long; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/elevatezoom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-rating/bootstrap-rating.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/cart.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/jquery.circliful.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/wow/js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/owl_carousel/js/owl.carousel.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/carousel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/index.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/single_product.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>