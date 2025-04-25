	<input type="hidden" id="base_url" value="<?php echo e(url('/')); ?>">
	<div class="whiteBG ">
		<div class="dPageContainer">
			<!-- Fixed-Header Starts -->
			<div class="dNavCont">
				<div class="dLogoContainer">
				    <?php 
				        $websiteData = getWebsiteData();
				     ?>
				    <a href="<?php echo e($websiteData['route'] ?? '#'); ?>" title="<?php echo e($websiteData['name'] ?? 'Default Name'); ?>">
				        <div class="dLogoBox">
				            <img src="<?php echo e($websiteData['logo'] ?? 'default-logo.png'); ?>" alt="<?php echo e($websiteData['alt'] ?? 'Default Alt'); ?>" />
				        </div>
				    </a>
				</div>

				<!-- User Login Section -->
				<?php echo $__env->make('layouts.front.userlogin.userLoginSection', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			<!-- Fixed-Header Ends -->
		</div>
		<?php echo $__env->make('layouts.front.header.mobilebottombar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>