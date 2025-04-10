<?php $__env->startSection("title", 'Create Quote'); ?>

<?php $__env->startSection('custom_css_code'); ?>

	<!-- create quote css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/backend/css/create-quote.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
<?php
	$dept_date = str_replace(' ', '',$data->date_arrival);
	$dept_date = str_replace('/', '-', $dept_date);
	$condition_data=date('m/d/Y' ,strtotime($dept_date));
	$dept_date=strtotime($dept_date);
	$now=strtotime("now");
	$difference=($dept_date-$now)/ (60 * 60 * 24);
	$difference=(int)$difference;
	if($dept_date<=$now) { 
		$difference=0;
	}
?>
<input type="hidden" id="condition_data" name="" value="<?php echo e($condition_data); ?>">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="flexCenter pdng10">
					<a href="<?php echo e(URL::to('/quote-pending')); ?>">
						<button class="btnBack">&nbsp;Back</button>
					</a>
					<div class="box-header">
						<!-- create quote page -->
						<h3 class="box-title">Create Quotation</h3>
					</div>
				</div>
				<div class="quoteCont makeflex flex-column">
					<div class="navQuoteBar">
						<!-- tab -->
						<ul class="quoteType">
							<li class="tablinks quoteTab" id="defaultOpen" data-tab="quote1">
								<span>Quote 1</span>
							</li>
							<li class="tablinks quoteTab" data-tab="quote2">
								<span>Quote 2</span>
							</li>
							<!--<li class="tablinks quoteTab" onclick="openTab(event, 'quote3')">
								<span>Quote 3</span>
							</li>
							<li class="tablinks quoteTab" onclick="openTab(event, 'quote4')">
								<span>Quote 4</span>
							</li>-->
						</ul>
					</div>

					<!-- tab content -->
					<!-- quote 1 -->
					<div class="tabcontent" id="quote1">
						<?php echo $__env->make('query.quotation.quote1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>

					<!-- quote 2 -->
					<div class="tabcontent" id="quote2">
					<!--include('query.quotation.option1')-->
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>
</div>

<div class="testing">
	<input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="test">
</div>

<!-- supplier modal remarks -->
<div class="modal fade" id="supplier" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content borderRadius5">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<input type="hidden" name="" value="" id="bookId">
				<h4 class="modal-title">Supplier Remarks</h4>
			</div>
			<form action="#" method="post" id="enq_data" name="enq_data">
				<div class="modal-body custom_border" id="supplier_body"></div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-success supplier_remarks" supplier_remarks_id="" supplier_attr="">Apply</button>
				<button type="button" class="btn btn-default color4a" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- page script -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript" src='<?php echo e(url("resources/assets/js/packages/create-edit-quote.js")); ?>'></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js_code_second"); ?>

<!-- tour quote -->
<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/js/packages/tour-quote.js")); ?>'></script> -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>