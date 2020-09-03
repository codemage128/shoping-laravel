<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?php $__env->startSection('title'); ?>
            | Admin
        <?php echo $__env->yieldSection(); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- global css -->

    <link href="<?php echo e(asset('assets/css/app.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->
    <!-- end of global css -->
    <!--page level css-->
    <?php echo $__env->yieldContent('header_styles'); ?>
            <!--end of page level css-->
<body class="skin-josh">
<header class="header">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
        <img style="width: 150px; height: 50px" src="<?php echo e(asset('assets/images/emaillogo.PNG')); ?>" alt="logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if(Sentinel::getUser()->pic): ?>
                                <img src="<?php echo url('/').'/uploads/users/'.Sentinel::getUser()->pic; ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>

                            <?php elseif(Sentinel::getUser()->gender === "male"): ?>
                                <img src="<?php echo e(asset('assets/images/authors/avatar3.png')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>

                            <?php elseif(Sentinel::getUser()->gender === "female"): ?>
                                <img src="<?php echo e(asset('assets/images/authors/avatar5.png')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>

                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/authors/no_avatar.jpg')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>
                            <?php endif; ?>
                        <div class="riot">
                            <div>
                                <p class="user_name_max"><?php echo e(Sentinel::getUser()->first_name); ?> <?php echo e(Sentinel::getUser()->last_name); ?></p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <?php if(Sentinel::getUser()->pic): ?>
                                <img src="<?php echo url('/').'/uploads/users/'.Sentinel::getUser()->pic; ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>

                            <?php elseif(Sentinel::getUser()->gender === "male"): ?>
                                <img src="<?php echo e(asset('assets/images/authors/avatar3.png')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>

                            <?php elseif(Sentinel::getUser()->gender === "female"): ?>
                                <img src="<?php echo e(asset('assets/images/authors/avatar5.png')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/images/authors/no_avatar.jpg')); ?>" alt="img" height="35px" width="35px"
                                     class="img-circle img-responsive pull-left"/>
                            <?php endif; ?>
                            <p class="topprofiletext"><?php echo e(Sentinel::getUser()->first_name); ?> <?php echo e(Sentinel::getUser()->last_name); ?></p>
                        </li>

                        <li role="presentation"></li>
                        <li>
                            <a href="<?php echo e(route('admin.users.edit', Sentinel::getUser()->id)); ?>">
                                <i class="livicon" data-name="gears" data-s="18"></i>
                                Account Settings
                            </a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo e(URL::to('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/logout')); ?>">
                                    <i class="livicon" data-name="sign-out" data-s="15"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper ">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side ">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <!-- BEGIN SIDEBAR MENU -->
                <?php echo $__env->make('admin.layouts._left_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">
        <!-- Notifications -->
        <div id="notific">
        <?php echo $__env->make('notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <!-- Content -->
        <?php echo $__env->yieldContent('content'); ?>
    </aside>
    <!-- right-side -->
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->
<script src="<?php echo e(asset('assets/js/app.js')); ?>" type="text/javascript"></script>
<!-- end of global js -->
<!-- begin page level js -->
<?php echo $__env->yieldContent('footer_scripts'); ?>
        <!-- end page level js -->
</body>
</html>
