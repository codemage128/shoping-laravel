


<?php $__env->startSection('title'); ?>
    Edit User
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
    <link href="<?php echo e(asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" type="text/css" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendors/iCheck/css/all.css')); ?>"  rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/pages/wizard.css')); ?>" rel="stylesheet">
    <!--end of page level css-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Edit user</h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Edit User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Editing user : <p class="user_name_max"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></p>
                        </h3>
                        <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <div class="row">

                            <div class="col-md-12">

                                <?php echo Form::model($user, ['url' => URL::to('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i/users/'. $user->id.''), 'method' => 'put', 'class' => 'form-horizontal','id'=>'commentForm', 'enctype'=>'multipart/form-data','files'=> true]); ?>

                                <?php echo e(csrf_field()); ?>


                                <div id="rootwizard">
                                    <ul>
                                        <li><a href="#tab1" data-toggle="tab">User Profile</a></li>
                                        
                                        
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">
                                            <h2 class="hidden">&nbsp;</h2>
                                            <div class="form-group <?php echo e($errors->first('first_name', 'has-error')); ?>">
                                                <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                                                <div class="col-sm-10">
                                                    <input id="first_name" name="first_name" type="text"
                                                           placeholder="First Name" class="form-control required"
                                                           value="<?php echo old('first_name', $user->first_name); ?>"/>
                                                </div>
                                                <?php echo $errors->first('first_name', '<span class="help-block">:message</span>'); ?>

                                            </div>

                                            <div class="form-group <?php echo e($errors->first('last_name', 'has-error')); ?>">
                                                <label for="last_name" class="col-sm-2 control-label">Last Name *</label>
                                                <div class="col-sm-10">
                                                    <input id="last_name" name="last_name" type="text" placeholder="Last Name"
                                                           class="form-control required"
                                                           value="<?php echo old('last_name', $user->last_name); ?>"/>
                                                </div>
                                                <?php echo $errors->first('last_name', '<span class="help-block">:message</span>'); ?>

                                            </div>
                                            <div class="form-group <?php echo e($errors->first('email', 'has-error')); ?>">
                                                <label for="email" class="col-sm-2 control-label">Email *</label>
                                                <div class="col-sm-10">
                                                    <input id="email" name="email" placeholder="E-Mail" type="text"
                                                           class="form-control required email"
                                                           value="<?php echo old('email', $user->email); ?>"/>

                                                    <?php echo $errors->first('email', '<span class="help-block">:message</span>'); ?>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group <?php echo e($errors->first('receive_email', 'has-error')); ?>">
                                                <label for="receive_email" class="col-sm-2 control-label text-danger">Email to receive notification *</label>
                                                <div class="col-sm-10">
                                                    <input id="receive_email" name="receive_email" placeholder="E-Mail" type="text"
                                                           class="form-control required email"
                                                           value="<?php echo old('receive_email', \App\Setting::first()->receive_email); ?>"/>

                                                    <?php echo $errors->first('receive_email', '<span class="help-block">:message</span>'); ?>

                                                </div>
                                            </div>
                                            <div class="form-group <?php echo e($errors->first('receive_email_two', 'has-error')); ?>">
                                                <label for="receive_email_two" class="col-sm-2 control-label text-danger">Email to receive  (for onion) *</label>
                                                <div class="col-sm-10">
                                                    <input id="receive_email_two" name="receive_email_two" placeholder="E-Mail" type="text"
                                                           class="form-control required email"
                                                           value="<?php echo old('receive_email_two', \App\Setting::first()->receive_email_two); ?>"/>

                                                    <?php echo $errors->first('receive_email_two', '<span class="help-block">:message</span>'); ?>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group <?php echo e($errors->first('password', 'has-error')); ?>">
                                                <p class="text-warning">If you don't want to change password... please leave them empty</p>
                                                <label for="password" class="col-sm-2 control-label">Password </label>
                                                <div class="col-sm-10">
                                                    <input id="password" name="password" type="password" placeholder="Password"
                                                           class="form-control" value="<?php echo old('password'); ?>"/>
                                                </div>
                                                <?php echo $errors->first('password', '<span class="help-block">:message</span>'); ?>

                                            </div>

                                            <div class="form-group <?php echo e($errors->first('password_confirm', 'has-error')); ?>">
                                                <label for="password_confirm" class="col-sm-2 control-label">Confirm Password </label>
                                                <div class="col-sm-10">
                                                    <input id="password_confirm" name="password_confirm" type="password"
                                                           placeholder="Confirm Password " class="form-control"
                                                           value="<?php echo old('password_confirm'); ?>"/>
                                                    <?php echo $errors->first('password_confirm', '<span class="help-block">:message</span>'); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <ul class="pager wizard">
                                            
                                            <li class="next"><a href="#">Next</a></li>
                                            <li class="next finish" style="display:none;"><a href="javascript:;">Save</a></li>
                                        </ul>
                                    </div>
                                </div>
                                </form>

                            </div>
                        </div>
                        <!--main content end-->
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" ></script>
    <script src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js')); ?>"  type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/js/pages/edituser.js')); ?>"></script>
    <script>
        function formatState (state) {
            if (!state.id) { return state.text; }
            var $state = $(
                '<span><img src="<?php echo e(asset('assets/img/countries_flags')); ?>/'+ state.element.value.toLowerCase() + '.png" class="img-flag" width="20px" height="20px" /> ' + state.text + '</span>'
            );
            return $state;

        }
        $(".country_field").select2({
            templateResult: formatState,
            templateSelection: formatState,
            placeholder: "select a country",
            theme:"bootstrap"
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>