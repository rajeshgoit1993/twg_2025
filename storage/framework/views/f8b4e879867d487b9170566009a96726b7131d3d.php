<?php if(env("WEBSITENAME")==1): ?>
	<?php $__env->startSection('keywords',$details->meta_keyword); ?>
	<?php $__env->startSection('desc',$details->meta_desc); ?>
	<?php $__env->startSection("title", $details->meta_title); ?>
<?php elseif(env("WEBSITENAME")==0): ?>
	<?php $__env->startSection('keywords',$details->rapidex_meta_keyword); ?>
	<?php $__env->startSection('desc',$details->rapidex_meta_desc); ?>
	<?php $__env->startSection("title", $details->rapidex_meta_title); ?>
<?php endif; ?>

<!-- section('custom_second_page_js') -->
<!-- <script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery.noconflict.js")); ?>'></script> -->
<!-- endsection -->

<?php $__env->startSection("custom_css"); ?>

<!--pagethree css-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/pagethree.css')); ?>" />

<!-- Image Gallery Modal Popup CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/frontend/css/modal-popup-img-gallery.css')); ?>" />

<!--calender css start--third page-->
<link rel="stylesheet" href="<?php echo e(asset('/resources/assets/frontend/css/fullcalendar.min.css')); ?>" />

<!---->
<!--<link rel="stylesheet" href="<?php echo e(asset('/resources/assets/slick/css/slick.css')); ?>" />-->
<!--<link rel="stylesheet" href="<?php echo e(asset('/resources/assets/slick/css/slick-theme.css')); ?>" />-->
<!-- <link rel="stylesheet" href="<?php echo e(asset('/resources/assets/frontend/css/style_nex.css')); ?>" /> -->
<!--<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/resources/assets/frontend/css/pagetwo.css')); ?>" />-->

<!-- Search Inputs Modal Popup CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('/resources/assets/frontend/css/modal-popup-search-inputs.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
$input_date = date('Y-m-d', strtotime('+60 days'));
if (Session::has('filtered_tour_date')) {
	$i_date = Session::get('filtered_tour_date');
    $input_date = date('Y-m-d', strtotime($i_date));
          }


?>

<section>
	<?php 

	$new_price=PackagePriceHelpers::get_new_pricing_data($details->id,$input_date); 

	?>
	<input type="hidden" name="" id="package_value" value="<?php echo e($id); ?>">

	<?php if($new_price!='na'): ?>
		<?php $new_second_price=PackagePriceHelpers::get_new_pricing_data($details->id,date('Y-m-d',$new_price['date'])); ?>
		<input type="hidden" id="given_year" name="" value="<?php echo e(date('Y',$new_price['date'])); ?>">
		<input type="hidden" id="given_month" name="" value="<?php echo e(date('m',$new_price['date'])); ?>">
		<input type="hidden" id="given_date" name="" value="<?php echo e(date('d',$new_price['date'])); ?>">

		<input type="hidden" id="given_end_year" name="" value="<?php echo e(date('Y',$new_price['end_date'])); ?>">
		<input type="hidden" id="given_end_month" name="" value="<?php echo e(date('m',$new_price['end_date'])); ?>">
		<input type="hidden" id="given_end_date" name="" value="<?php echo e(date('d',$new_price['end_date'])); ?>">

	<?php else: ?>

		<?php 
			$new_second_price=PackagePriceHelpers::get_new_pricing_data($details->id,$input_date);
			$futureDate=date('Y-m-d', strtotime('+1 year'));
		?>

		<input type="hidden" id="given_year" name="" value="<?php echo e(date('Y', strtotime($input_date))); ?>">
		<input type="hidden" id="given_month" name="" value="<?php echo e(date('m' , strtotime($input_date))); ?>">
		<input type="hidden" id="given_date" name="" value="<?php echo e(date('d' , strtotime($input_date))); ?>">

		<input type="hidden" id="given_end_year" name="" value="<?php echo e(date('Y',strtotime($futureDate))); ?>">
		<input type="hidden" id="given_end_month" name="" value="<?php echo e(date('m',strtotime($futureDate))); ?>">
		<input type="hidden" id="given_end_date" name="" value="<?php echo e(date('d',strtotime($futureDate))); ?>">

	<?php endif; ?>

	<!--Desktop Page-->
	<div class="destop_test_exp">
		<div class="dBGColor">

			<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourDatePanel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<div class="dPageContainer">
				<div class="dTourDtlsCont">
					<!-- <?php if(session()->has('message')): ?>
						<div class="alert alert-success">
							<?php echo e(session()->get('message')); ?>

						</div>
					<?php endif; ?> -->

					<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourName', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<div class="makeflex">
						<div class="dLeftContainer">
							<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourImages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourDetails', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourTabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>

						<div class="dRightContainer">
							<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourSidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>

					</div>
				</div>

				<!--D_Tour Gallery Modal starts-->
				<?php echo $__env->make('packages.thirdpagecontent.tour-gallery-popup.d-tour-gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<!--D_Tour Enquiry Modal ends-->
				<?php echo $__env->make('packages.thirdpagecontent.desktop.dTourEnquiry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
		</div>
	</div>

	<!-- ***************** -->

	<!--Mobile Page-->
	<div class="mobile_test_exp">
		<div>
			<!-- <?php if(session()->has('message')): ?>
				<div class="alert alert-success">
					<?php echo e(session()->get('message')); ?>

				</div>
			<?php endif; ?> -->

			<?php echo $__env->make('packages.thirdpagecontent.mobile.mTourImages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<div class="mContainer select-none">
				<?php echo $__env->make('packages.thirdpagecontent.mobile.mTourDetails', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('packages.thirdpagecontent.mobile.mTourTabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>

			<?php echo $__env->make('packages.thirdpagecontent.mobile.mPriceBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		</div>

		<!--M_Tour Gallery Modal starts-->
		<?php echo $__env->make('packages.thirdpagecontent.tour-gallery-popup.m-tour-gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--M_Tour Gallery Modal ends-->

		<!--M_Tour Search Inputs Modal starts-->
		<?php echo $__env->make('packages.thirdpagecontent.search-inputs-popup.m-tour-search-inputs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<!--M_Tour Search Inputs Modal ends-->

		<?php echo $__env->make('packages.thirdpagecontent.mobile.mTourEnquiry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</div>

	<!--Common Calendar Tour Enquiry and OTP-->
	<?php echo $__env->make('packages.thirdpagecontent.desktop.calendartourenquiry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('packages.thirdpagecontent.desktop.otp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</section>
 
<div class="testing">
		<input type="hidden" id="test" name="" value="<?php echo e(url('/')); ?>">
		<input type="hidden" id="APP_URL" value="<?php echo e(url('/')); ?>">
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_js'); ?>

<!--Page Three-->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/pagethree.js")); ?>'></script>

<!--Get Modal-->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/get-modal.js")); ?>'></script>

<!--Image-slider-->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/content-slider.js")); ?>'></script>

<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery-ui.1.10.4.min.js")); ?>'></script>

<!-- Mobile Search Inputs Modal Popup JS -->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/modal-popup-search-inputs.js")); ?>'></script>

<!--Enquiry-->
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/enquiry.js")); ?>'></script>

<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/moment.min.js")); ?>'></script>

<!--<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/jquery.min.js")); ?>'></script>-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/fullcalendar.js")); ?>'></script>

<!--<script type="text/javascript" src='<?php echo e(asset ("/resources/assets/frontend/js/gcal.js")); ?>'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src='<?php echo e(asset("/resources/assets/slick/js/slick.js")); ?>'></script>-->

<script type="text/javascript" src='<?php echo e(asset("/resources/assets/frontend/js/pagethree_1.js")); ?>'></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.masternofooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>