<?php echo $__env->make('error.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
.wrap {
	background-color: #f2f2f2;
	padding-bottom: 50px;
	text-align: center;
}
</style>
<div class="wrap">
	<div class="main">
		<div class="">
			<img src="<?php echo e(url('/public/uploads/banner1.png')); ?>" alt="" />
		</div>
		<div class="text">
			<h2>The requested url was not found !</h2>
			<p class="apndTop20">Sorry! Evidently the document you were looking for has either been moved or no longer exist.</p>
		</div>
	</div>
</div>

<?php echo $__env->make('layouts.front.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>