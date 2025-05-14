<?php $__env->startSection('custom_css_code'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/contact-us-enquiry.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/ui-datepicker-new-contact-us.css')); ?>" />
<style type="text/css">
	.checkmarkCont 
	{
		background: white !important;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box autoScroll">
					<div class="box-header">
						<!-- query-enquiry page -->
						
							<h3 class="box-title">Add Customer Detail</h3>
						
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



						<div class="dashboard-outer-table">
						 <form action="#" method="Post" id="enquiry_form" name="enquiry_form">
    <?php echo e(csrf_field()); ?>

<div class="alert alert-success" id="success-contaier" style="display:none">
   <p>Thanks You! Your query has been submitted.</p>
</div>

<?php echo $__env->make('cms.form-contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


</form>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
	</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js_code'); ?>


<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> -->
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

<!-- contact-us-enquiry js -->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/contact-us-enquiry.js")); ?>'></script>
<script type="text/javascript">
	
	$('#TravelDate').datepicker({
    format: 'dd M yyyy', 
    autoclose: true,
    todayHighlight: true,
    startDate: '0d',
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>