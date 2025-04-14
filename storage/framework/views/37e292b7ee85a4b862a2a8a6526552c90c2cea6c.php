<?php $__env->startSection('custom_css_code'); ?>
    <!-- lead manager css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/lead-manager.css')); ?>" />

    <!-- enquiry timeline CSS -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/enquiry-timeline.css')); ?>" />

    <!-- lead modal CSS -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/lead-validation.css')); ?>" />

    <!-- JS modal pop-up -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/modal-popup.css')); ?>" />

    <!-- search lead -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/backend/css/search-form.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box autoScroll">
                        <div class="box-header">
                            <h3 class="box-title">Raised Concerns</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if(\Session::has('message')): ?>
                                <div class="alert alert-success">
                                    <ul>
                                        <li><?php echo \Session::get('message'); ?></li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                                <p>Concern Updated Successfully</p>
                            </div>

                            <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                                <ul class="error-contaier-hotel" id="error-contaier-hotel"></ul>
                            </div>

                            <div class="dashboard-outer-table">
                                <table id="concernTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">Query Reference</th>
                                            <th width="150">Guest Name</th>
                                            <th width="200">Concern Description</th>
                                            <th width="100">Status</th>
                                            <th width="150">Raised At</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($concerns) && $concerns->isNotEmpty()): ?>
                                            <?php $__currentLoopData = $concerns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <tr>
                                                    <!-- Query Reference -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls">#<?php echo e($query->query_reference); ?></p>
                                                        </div>
                                                    </td>

                                                    <!-- Guest Name -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls"><?php echo e($query->name ?? 'N/A'); ?></p>
                                                        </div>
                                                    </td>

                                                    <!-- Concern Description -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <p class="q-dtls"><?php echo e($query->description ?? 'No description available'); ?></p>
                                                        </div>
                                                    </td>

                                                    <!-- Status -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <?php if($query->status == 0): ?>
                                                                <p class="q-sendbox">Pending</p>
                                                            <?php elseif($query->status == 1): ?>
                                                                <p class="q-acceptancebox">Open</p>
                                                            <?php else: ?>
                                                                <p class="q-rejectionbox">Closed</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>

                                                    <!-- Raised At -->
                                                    <td>
                                                        <div class="dashboard-inner-table">
                                                            <?php
                                                                $raised_at = date("d M Y, H:i:s", strtotime($query->created_at));
                                                            ?>
                                                            <p class="q-dtls textCenter"><?php echo e($raised_at); ?></p>
                                                        </div>
                                                    </td>

                                                    <!-- Action -->
                                                    <td>
                                                        <div class="btnContainer">
                                                            <button class="btn-q btn-viewlead edit-concern" data-id="<?php echo e($query->id); ?>" data-toggle="modal">Edit</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No concerns available.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- Include modals if needed -->
    <?php echo $__env->make('query.query_modal.modal-popup.action-modal.edit-raised-concern', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>
    <!-- page script -->
    <script type="text/javascript" src='<?php echo e(asset("/resources/assets/backend/js/concern-raised.js")); ?>'></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>