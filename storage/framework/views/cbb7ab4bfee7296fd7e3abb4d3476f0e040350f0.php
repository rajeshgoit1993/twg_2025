<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <!--icon management start-->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Coupon List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                        <p>Coupon Deleted Successfully.</p>
                    </div>
                    <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                        <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <?php if(Sentinel::check()): ?>
                        <?php if(Sentinel::getUser()->inRole('administrator') || Sentinel::getUser()->inRole('supervisor') || Sentinel::getUser()->inRole('super_admin')): ?>
                        <div class="add">
                            <a href="<?php echo e(URL::to('/Add-Coupon')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add New Coupon</a>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Coupon Name</th>
                                <th>Coupon Description</th>
                                <!-- <th>Type</th> -->
                                <th>Coupon Value</th>
                                <th>Coupon Start Date</th>
                                <th>Coupon End Date</th>
                                <th>Coupon Code</th>
                                <th>CouponStatus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($single->id); ?></td>

                                <td><?php echo e($single->coupon_name); ?></td>

                                <td>
                                    <?php echo e($single->coupon_desc); ?>

                                </td>

                                <!-- <td><?php echo e($single->type); ?></td> -->

                                <td><?php echo e($single->value); ?> %</td>

                                <?php
                                    $startdate=date('d-m-Y', strtotime($single->start_date ));
                                    $enddate=date('d-m-Y', strtotime($single->end_date ));
                                ?>
                                <td><?php echo e($startdate); ?></td>

                                <td><?php echo e($enddate); ?></td>

                                <td><?php echo e($single->coupon_code); ?></td>

                                <td>
                                    <button type="button" class="btn btn-sm no-event <?php echo e($single->status == 1 ? 'btn-success' : 'btn-danger'); ?>">
                                        <?php echo e($single->status == 1 ? 'Enabled' : 'Disabled'); ?>

                                    </button>
                                </td>

                                <td>
                                    <form action="<?php echo e(URL::to('/Delete-Coupon/'.$single->id)); ?>" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                                        <span class="">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="id" value=""/>
                                            <?php if(Sentinel::check()): ?>
                                                <?php if(Sentinel::getUser()->inRole('super_admin') ||
                                                Sentinel::getUser()->inRole('administrator') ||
                                                Sentinel::getUser()->inRole('supervisor')): ?>
                                                <a href="<?php echo e(URL::to('/Edit-Coupon/'.$single->id)); ?>">
                                                    <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                                </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if(Sentinel::check()): ?>
                                                <?php if(Sentinel::getUser()->inRole('super_admin') ||
                                                Sentinel::getUser()->inRole('administrator')): ?>
                                                <button type="submit" class="btn btn-sm btn-danger deletePackage">Delete</button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </span>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); if ($__empty_1): ?>
                            <tr>
                                <th colspan="9" class="text-center text-danger"> Testimonial No Found</th>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!--icon management end-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>