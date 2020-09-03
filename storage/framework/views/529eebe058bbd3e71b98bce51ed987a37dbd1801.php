<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Welcome to Josh Frontend</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/all.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/vendors/iCheck/css/all.css')); ?>" />
    <link href="<?php echo e(asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')); ?>" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/frontend/login.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
    <!--end of page level css-->
</head>
<body>
<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box animation flipInX">
            <div class="box1" style="background-color: #222222; border-color: #222222">
                <img src="<?php echo e(asset('assets/images/emaillogo_login.png')); ?>" alt="logo" class="img-responsive mar">

                <!-- Notifications -->
                <div id="notific">
                    <?php echo $__env->make('notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <form action="<?php echo e(route('login2')); ?>" class="omb_loginForm"  autocomplete="off" method="POST">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <span class="help-block"><?php echo e($errors->first('email', ':message')); ?></span>
                    <div class="form-group <?php echo e($errors->first('password', 'has-error')); ?>">
                        <h4 class="text-primary text-center" style="color: #EEEEEE !important;">
                            Please type the verification code.
                        </h4>
                        <input type="text" class="form-control" name="code" required placeholder="Type Code">
                    </div>
                    <span class="help-block"><?php echo e($errors->first('code', ':message')); ?></span>
                    <input type="submit" class="btn btn-block btn-primary" value="Submit">
                </form>
                <br/>
            </div>
            <br>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/frontend/login_custom.js')); ?>"></script>
<!--global js end-->
</body>
</html>
