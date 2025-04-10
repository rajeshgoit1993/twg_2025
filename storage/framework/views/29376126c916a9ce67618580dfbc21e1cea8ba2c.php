<?php $__env->startSection("custom_css_code"); ?>

<style type="text/css">
.custom_border .row {
	padding: 5px 0px
}
table.dataTable thead > tr > th {
	padding-right: 0px;
}
/*.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
}*/

/**/
.switch {
	position: relative;
	display: inline-block;
	width: 50px;
	height: 24px;
}
.switch input {
	opacity: 0;
	width: 0;
	height: 0;
}
.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
}
.slider:before {
	position: absolute;
	content: "";
	height: 16px;
	width: 16px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}
input:checked + .slider {
	background-color: #2196F3;
}
input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
}
/* Rounded sliders */
.slider.round {
	border-radius: 34px;
}
.slider.round:before {
	border-radius: 50%;
}
</style>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main Content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">

                <?php $i = 1; ?> <!-- Initialize counter -->

                <!-- Services Table -->
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datas): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <td>
                                    <p><?php echo e($datas->services_name); ?></p> 
                                </td>
                                <td>
                                    <!-- Toggle Switch for Activation -->
                                    <label class="switch">
                                        <input type="checkbox" class="activation_service" id="<?php echo e($datas->id); ?>" <?php if($datas->activation == '1'): ?> checked <?php endif; ?> >
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <?php if($i % 2 == 0): ?> 
                                    </tr><tr> <!-- Close and open a new row after every 2 items -->
                                <?php endif; ?>

                                <?php $i++; ?> <!-- Increment counter -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </tr>
                    </tbody>
                </table>
                <!-- End Services Table -->

            </div>
        </div>
    </section>
    <!-- /.content -->

</div>

<div class="testing">
	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
</div>

<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>

<script>
    $(document).on('click', '.activation_service', function (e) {
        e.stopPropagation(); // Prevent event bubbling

        var id = $(this).attr("id");
        var activation = $(this).is(':checked') ? 1 : 0; // Set activation based on checkbox state

        // Send AJAX request to update activation status
        $.ajax({
            type: 'POST',
            url: APP_URL + '/activation_data',
            data: { id: id, activation: activation },
            success: function (data) {
                if (data === "success") {
                    location.reload(); // Reload page on success
                }
            },
            error: function (error) {
                console.error("Error updating activation status:", error);
            }
        });
    });
</script>

<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>