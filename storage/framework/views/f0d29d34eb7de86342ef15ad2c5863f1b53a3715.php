	<!-- Bootstrap 3.3.2 -->
	<!-- <link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/bootstrap.min.css')); ?>" crossorigin="anonymous" /> -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

	<!--gateway css-->
	<link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/gateway.css')); ?>" rel="stylesheet" />

	<!--common css-->
	<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/common.css')); ?>" />

	<!--header & footer css-->
	<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/header.css')); ?>" />

	<!--custom checkmark-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/custom-checkmark.css')); ?>" />

	<!--user login-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/user-login.css')); ?>" />

	<!--datepicker css-->
	<!-- <link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/ui-datepicker.css')); ?>" /> -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/ui-datepicker-new.css')); ?>" />

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" type="text/css" as="style" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" />
	<!-- <link href="<?php echo e(asset('/resources/assets/frontend/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" /> -->

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/animate.min.css')); ?>" />

	<!-- google font -->
	<!-- <link rel="stylesheet" type="text/css" href='https://fonts.googleapis.com/css?family=Lato:300,400,700' crossorigin="anonymous" /> -->
	<link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900&display=swap" onload="this.rel='stylesheet'" crossorigin="anonymous">

	<!-- Main Style 
	<link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/style.css')); ?>" crossorigin="anonymous" />
	<link rel="preload stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/frontend/css/style-2.css')); ?>" crossorigin="anonymous" />-->

	<!--slick css-->
	<link rel="stylesheet" type="text/css" as="style" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" crossorigin="anonymous" />

	<!--Testimonials Slick-->
	<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/slick/css/slick.css')); ?>" />
	<link rel="stylesheet" type="text/css" as="style" href="<?php echo e(asset('/resources/assets/slick/css/slick-theme.css')); ?>" />

	<!--scroll-to-top css-->
	<link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/scroll-to-top.css')); ?>" rel="stylesheet" />

	<!--footer css-->
	<link type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/footer.css')); ?>" rel="stylesheet" />

	<!--Lazy-loading-images (to be check and remove from footer and try-->
	<!-- <script rel="preload" as="script" type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/lazy-loading.js")); ?>'></script> -->

	<!--Page Loader Script-->
	<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/pace.min.js")); ?>' data-pace-options='{ "ajax": false }'></script>
	
	<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/page-loading.js")); ?>'></script> -->

	<!-- jquery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <!-- search panel date picker -->
    <!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/date-picker-search-panel.js")); ?>'></script> -->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <?php echo $__env->yieldContent('custom_css'); ?>