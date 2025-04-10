<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- Uncomment the following block to add a header with a link -->
                    <!--
                    <div class="box-header">
                        <div class="">
                            <a href="<?php echo e(route('add_payment_mode')); ?>" class="btn btn-success" style="margin-right: 20px">
                                <i class="glyphicon glyphicon-plus-sign"></i> Add New Payment Mode
                            </a>
                        </div>
                    </div>
                    -->
                    <!-- /.box-header -->

                    <div class="box-body">
                        <!-- Success message container -->
                        <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                            <p>Gateway deleted successfully.</p>
                        </div>
                        <!-- Error message container -->
                        <div class="alert alert-danger error-contaier-parenterror-contaier-parent-hotel" style="display:none">
                            <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul>
                        </div>

                        <div class="row makeflex aligncenter form-group">
                            <div class="col-md-6">
                                <h4 class="box-title">OTP Setting</h4>
                            </div>
                            <!-- Search input (commented out) -->
                            <!--
                            <div class="col-md-6">
                                <input type="text" id="searchsupplier" class="form-control" name="" placeholder="Search... By Name, City or Country">
                            </div>
                            -->
                        </div>

                        <!-- Table for displaying data -->
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th width="50px">S.No.</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1; ?>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td><?php echo e($a++); ?></td>
                                    <td><?php echo e($d->description); ?></td>
                                    <td>
                                        <!-- Radio button group for status -->
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-secondary <?php if($d->status == 1): ?> active <?php endif; ?>">
                                                <input type="radio" name="status" id="<?php echo e($d->id); ?>" value="1" class="status" <?php if($d->status == 1): ?> checked <?php endif; ?>> On
                                            </label>
                                            <label class="btn btn-secondary <?php if($d->status == 0): ?> active <?php endif; ?>">
                                                <input type="radio" name="status" id="<?php echo e($d->id); ?>" value="0" class="status" <?php if($d->status == 0): ?> checked <?php endif; ?>> Off
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Hidden input for passing APP_URL to JavaScript -->
<div class="testing">
    <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="APP_URL">
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom JavaScript section -->
<?php $__env->startSection("custom_js_code"); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=radio]').change(function() {
            var status = $(this).val();
            var id = $(this).attr('id');
            var APP_URL = $("#APP_URL").val();

            $.ajax({
                url: APP_URL + '/store_setting_status',
                type: "get",
                data: {
                    status: status,
                    id: id
                },
                success: function(data) {
                    if (data == 'success') {
                        swal({
                            title: "Done !",
                            text: "Successfully Changed !",
                            icon: "success",
                            timer: 500
                        });
                    } else {
                        swal("Error", data, "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>