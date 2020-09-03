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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Client Logs<span class="hidden-xs header_info"></span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Client Logs
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-12">
            <div class="portlet box black_bg">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Client Logs
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <label class="col-md-offset-4 col-md-2 control-label">Filter By: </label>
                        <div class="col-md-3">
                            <form action="<?php echo route('admin.filter_date'); ?>" id="filter_date_form" method="get">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="startDate" id="startDate">
                                <input type="hidden" name="endDate" id="endDate">
                            </form>
                            <input type="hidden" action="<?php echo route('admin.filter_date'); ?>" id="filter_date">
                            <input class="form-control" type="text" id="datepicker">
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="pagination pull-right" style="margin-bottom: -30px;">
                                    <?php echo $logs->links(); ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th></th>
                            <th>
                                Ip Address
                            </th>
                            <th>
                                Login Date
                            </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 0 + ($logs->currentPage() - 1) * 10 ; ?>
                            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i ++; ?>
                                <tr id="everytransaction<?php echo $log->id; ?>" class="detail_transaction"
                                    transactionId="<?php echo $log->id; ?>"
                                    action="<?php echo route('admin.getTransactionInfo'); ?>" style="z-index: -10">
                                    <td><?php echo $i; ?></td>
                                    <td class="highlight">
                                        <div class="success"></div>
                                        <a href="#"><?php echo $log->ipaddress; ?></a>
                                    </td>
                                    <td>
                                        <?php echo $log->created_at; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <!--for calendar-->
        <script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/countUp_js/js/countUp.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/vendors/morrisjs/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/transaction.js')); ?>"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                }
            }, function (start, end, label) {
                var url = $('#filter_date').attr('action');
                var form = $('#filter_date_form');
                $('#startDate').val(start.format('YYYY-MM-DD'));
                $('#endDate').val(end.format('YYYY-MM-DD'));
                form.submit();
            });
        });
    </script>
    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>