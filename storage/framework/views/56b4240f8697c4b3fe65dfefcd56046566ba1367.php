<?php if(count($data1) > 0): ?>
    <?php 
        $seo = $data1->first(); // Use only the first entry
     ?>
    <?php $__env->startSection('keywords', $seo->keywords); ?>
    <?php $__env->startSection('desc', $seo->description); ?>
    <?php $__env->startSection('title', $seo->title); ?>
<?php else: ?>
    <?php $__env->startSection('keywords', getWebsiteData('keyword')); ?>
    <?php $__env->startSection('desc', getWebsiteData('description')); ?>
    <?php $__env->startSection('title', getWebsiteData('title')); ?>
<?php endif; ?>

<!-- <?php if(count($data1) == 0): ?>
    <?php $__env->startSection('keywords', getWebsiteData('keyword')); ?>
    <?php $__env->startSection('desc', getWebsiteData('description')); ?>
    <?php $__env->startSection('title', getWebsiteData('title')); ?>
<?php else: ?>
    <?php $__currentLoopData = $data1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php $__env->startSection('keywords', $seo->keywords); ?>
        <?php $__env->startSection('desc', $seo->description); ?>
        <?php $__env->startSection('title', $seo->title); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?> -->


<?php $__env->startSection('custom_second_page_js'); ?>

	<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery.noconflict.js")); ?>'></script> -->

	<!--second page (load content on scroll)-->
	<!--<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js")); ?>'></script>-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_css"); ?>

	<!--pagetwo css-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/pagetwo.css')); ?>" />

	<!-- Search Inputs Modal Popup CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/frontend/css/modal-popup-search-inputs.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php
		use App\Icons;
		use App\Gtags;
		use App\Suitable;
		$icons = Icons::all();
		$generals = Gtags::all();
		$suitables = Suitable::all();
	?>

	<!-- loading more pacakges -->
	<div id="overlay"></div>

	<!--Desktop Page-->
	<div class="destop_test_exp">
		<?php echo $__env->make('packages.secondpage.desktop.dModifyPanel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('packages.secondpage.desktop.dTourName', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('packages.secondpage.desktop.dFilterSorting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('packages.secondpage.desktop.dTourItemCard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>

	<!--Mobile Page-->
	<div class="mobile_test_exp">
		<div class="mBG">
			<?php echo $__env->make('packages.secondpage.mobile.mSorting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
			<?php echo $__env->make('packages.secondpage.mobile.mtourItemCard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<!--Mobile Filter Starts-->
		<?php echo $__env->make('packages.secondpage.mobile.mFilterModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--Mobile Filter Ends-->

		<!--Mobile Modify Search Starts-->
		<?php echo $__env->make('packages.secondpage.mobile.mModifySearchModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--Mobile Modify Search Ends-->
	</div>

	<div class="testing">
		<!-- <input type="hidden" id="testvalue" name="" value="<?php echo e(url('/')); ?>"> -->
		<!-- <input type="hidden" id="APP_URL" value="<?php echo e(url('/')); ?>"> -->
		<input type="hidden" id="ROOT_URL" value="<?php echo e(route('home')); ?>">
		<input type="hidden" id="SEARCH_DESTINATION_URL" value="<?php echo e(route('searchDestination')); ?>">
		<input type="hidden" id="SEARCH_THEME_URL" value="<?php echo e(route('searchTheme')); ?>">
		<input type="hidden" id="LOAD_MORE_ITEM_URL" value="<?php echo e(route('loadMoreItem')); ?>">
	</div>

	<!-- placed in header tag -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js"); ?>

	<!--Page Two-->
	<!-- <script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/pagetwo_1.js")); ?>'></script> -->
	<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/pagetwo.js")); ?>'></script>

	<!-- destination search (when enabled coming two boxes)-->
	<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/destination-search.js")); ?>'></script> -->

	<!--Filter Second Page-->
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/filter.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>