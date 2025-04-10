	<!--Desktop Tour Name Starts-->
	<div class="dPageContainer">
		<div class="dTourTitleCont">
			<h1><?php echo e($destination_search); ?></h1>
			<input type="hidden" id="destination" value="<?php echo e($destination_search); ?>">
			<div class="dTourCount"><?php echo e(count($data)); ?><span class="font12">/<?php echo e(count($data)); ?></span> Tour Packages</div>
		</div>
	</div>
	<!--Desktop Tour Name Ends-->