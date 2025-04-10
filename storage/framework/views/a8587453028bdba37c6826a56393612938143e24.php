    
    <!-- websitenamehelpers -->
    <?php $__env->startSection("title", getWebsiteData('metaTitle_Home')); ?>
    <?php $__env->startSection("title", getWebsiteData('metaKeywords_Home')); ?>
    <?php $__env->startSection("title", getWebsiteData('metaDescription_Home')); ?>

<?php $__env->startSection("custom_css"); ?>

<style type="text/css">
/* Ensure the placeholder text color is visible */
.select2-search__field::placeholder {
    color: #aaa;  /* Adjust to your desired color */
    font-style: italic;
    text-transform: none;
}

</style>

<!--holidays -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/holidays.css')); ?>" /> -->

<!-- mobile search panel -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/mobile-search-panel.css')); ?>" />

<!-- search panel -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/desktop-search-panel.css')); ?>" />

<!-- mobile subscription box -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/mobile-subscription.css')); ?>" />

<!-- search subscription box -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/desktop-subscription.css')); ?>" />

<!-- mobile home packages -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/mobile-home-packages.css')); ?>" />

<!-- desktop home packages -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/desktop-home-packages.css')); ?>" />

<!-- mobile promotion-goa -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/mobile-promotion.css')); ?>" />

<!-- desktop promotion-goa -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/desktop-promotion.css')); ?>" />

<!-- travel-insurance -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/travel-insurance.css')); ?>" />

<!-- carousel for testimonials -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/carousel.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_datepicker_js'); ?>

<!-- placed in header tag -->
<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/date-picker-search-panel.js")); ?>'></script> -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section>
	<!-- Home Page Content Starts (home.home desktop & mobile) -->
	<div>
		<?php echo $__env->make('home.desktop.desktopSearchPanel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.desktopSubscription', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.desktopMidimage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.desktopPackages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.trendingHoneymoon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.desktopSectionGoa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.desktop.desktopTestimonials', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--<div class="mid_img"></div>-->
	</div>
	<!-- Home Page Content Ends (desktop & mobile) -->

	<div class="testing">
        <input type="hidden" id="csrf_token" value="<?php echo e(csrf_token()); ?>">
		<!-- <input type="hidden" value="<?php echo e(url('/')); ?>" name="" id="testvalue"> -->
		<input type="hidden" id="APP_URL" value="<?php echo e(url('/')); ?>">
		<input type="hidden" id="SEARCH_DESTINATION_URL" value="<?php echo e(route('searchDestination')); ?>">
		<input type="hidden" id="SEARCH_THEME_URL" value="<?php echo e(route('searchTheme')); ?>">
	</div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js"); ?>
<!-- home page js starts -->

<!-- sticky web header -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/web-header.js")); ?>'></script>

<!-- search panel date picker -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/date-picker-search-panel.js")); ?>'></script>    

<!--page one script -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/pageone.js")); ?>'></script>

<!-- destination search -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/destination-search.js")); ?>'></script>

<!-- insurance guest box -->
<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/insurance-guest-input.js")); ?>'></script>

<!-- home page js ends -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>