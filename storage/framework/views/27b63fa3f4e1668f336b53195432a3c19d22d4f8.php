


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
    
    
    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>Transaction<span class="hidden-xs header_info">( shop )</span></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Transaction List
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-8">
            <div class="portlet box black_bg">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-name="pencil" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Transaction List
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <label class="col-md-offset-4 col-md-2 control-label">Filter By: </label>
                        <div class="col-md-3">
                            <form id="sort_form" method="get">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" value="<?php echo route('admin.transaction2', 0); ?>" id="refreshurl">
                                <select class="form-control" id="show_status">
                                    <option value="4"></option>
                                    <option value="0" <?php if($id == 0): ?> selected <?php else: ?> <?php endif; ?>>Initial</option>
                                    <option value="1" <?php if($id == 1): ?> selected <?php endif; ?>>Pending</option>
                                    <option value="2" <?php if($id == 2): ?> selected <?php endif; ?>>Success</option>
                                    <option value="3" <?php if($id == 3): ?> selected <?php endif; ?>>Fail</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <nav>
                                <ul class="pagination pull-right" style="margin-bottom: -30px;">
                                    <?php echo $transactions->links(); ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <th></th>
                            <th>
                                Input_address
                            </th>
                            <th>
                                Product Name
                            </th>
                            <th>
                                Product Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Pay Amount
                            </th>
                            <th>
                                Total BitCoin
                            </th>
                            <th>
                                Pay Status
                            </th>
                            <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($transaction->isdeleted == 0): ?>
                                    <?php $i ++; ?>
                                    <tr id="everytransaction<?php echo $transaction->id; ?>" class="detail_transaction"
                                        transactionId="<?php echo $transaction->id; ?>"
                                        action="<?php echo route('admin.getTransactionInfo'); ?>" style="z-index: -10">
                                        <td><?php echo $i; ?></td>
                                        <td class="highlight">
                                            <div class="success"></div>
                                            <a href="#"><?php echo $transaction->input_address; ?></a>
                                        </td>
                                        <td><?php echo \App\Product::find($transaction->product_id)->name; ?></td>
                                        <td><?php echo $transaction->product_price; ?></td>
                                        <td>
                                            <?php echo $transaction->quantity; ?>

                                        </td>
                                        <td><?php echo $transaction->pay_amount; ?> </td>
                                        <td><?php echo $transaction->total_bitcoin; ?> </td>
                                        <td>
                                            <?php switch($transaction->pay_status):
                                                case (0): ?>  <span class="label label-default">Initial</span> <?php break; ?>
                                                <?php case (1): ?>  <span class="label label-info">Pending</span> <?php break; ?>
                                                <?php case (2): ?>  <span class="label label-success">Success</span> <?php break; ?>
                                                <?php case (3): ?>  <span class="label label-danger">Failed</span> <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>
                                        <td>
                                            <button class="del_transaction btn default btn-xs purple"
                                                    id="del_transaction<?php echo $transaction->id; ?>"
                                                    action="<?php echo route('admin.delTransaction'); ?>"
                                                    transactionid="<?php echo $transaction->id; ?>" style="z-index: 10">
                                                <i class="livicon" data-name="pen" data-loop="true" data-color="#000"
                                                   data-hovercolor="black" data-size="14"></i>
                                                Del<input type="hidden" id="transactionid<?php echo $transaction->id; ?>"
                                                          value="<?php echo $transaction->id; ?>"/>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="clock" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i>
                        <span id="title">Transaction Info</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <input type="hidden" id="addflag" value="1"/>
                    <form class="form form-horizontal" id="productinfo_form" method="post">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Input Address</label>
                            <div class="col-md-8">
                                <input type="hidden" id="current_id" name="current_id">
                                <input class="form-control" id="input_address" name="input_address"
                                       placeholder="Input Address" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-8">
                                <input class="form-control" id="product_name" name="product_name"
                                       placeholder="Product Name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Product Price</label>
                            <div class="col-md-8">
                                <input class="form-control" id="product_price" name="product_price"
                                       placeholder="Product Price" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                Quantity
                            </label>
                            <div class="col-md-8">
                                <input id="quantity" name="quantity" class="form-control" type="number"
                                       placeholder="Quantity" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Pay Amount</label>
                            <div class="col-md-8">
                                <input id="pay_amount" name="pay_amount" class="form-control" type="number"
                                       placeholder="Pay Amount" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Total BitCoin</label>
                            <div class="col-md-8">
                                <input id="total_bitcoin" name="total_bitcoin" class="form-control" type="number"
                                       placeholder="Total BitCoin" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Customer Information</label>
                            <div class="col-md-8">
                            <textarea id="customer_info" name="customer_info"
                                      class="form-control resize_vertical" rows="10"
                                      placeholder="Show the Information. e.g comments" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8">
                                <input id="pay_status" class="form-control" readonly placeholder="Initial">
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <p>You are already editing a row, you must save or cancel that row before edit/delete a new row</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>"></script>
    <!--for calendar-->
    <script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="<?php echo e(asset('assets/vendors/countUp_js/js/countUp.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/vendors/morrisjs/morris.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/transaction.js')); ?>"></script>

    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>