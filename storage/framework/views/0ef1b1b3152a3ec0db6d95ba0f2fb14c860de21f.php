	<!-- D-M Footer Starts -->
	<div class="footerBG">
		<div class="dPageContainer">
			<div class="footerWrapper">
				<div class="footerLeftPart">
					<div class="footerLeftPartWrapper">
						<div class="columnOne">
							<div class="footerLeftPartSubTtl">
								<h6>Theme</h6>
								<ul>
									<?php $__currentLoopData = $theme_front_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme_front): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php if($theme_front): ?>
											<?php if(CustomHelpers::get_theme_footerstatus($theme_front)): ?>
												<li>
													<a href="<?php echo e(url('/theme/'.str_slug($theme_front).'-packages')); ?>" target="_blank"><?php echo e($theme_front); ?></a>
												</li>
											<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</ul>
							</div>
							<div class="footerLeftPartSubTtl">
								<h6 class="appendTop30">About us</h6>
								<ul>
									<!--<li><i class="fa-angle-right" aria-hidden="true"></i><a href="<?php echo e(URL::to('/about')); ?>">About Us</a></li>-->
									<li><a href="<?php echo e(route('aboutUs')); ?>" target="_blank">About Us</a></li>
									<li><a href="<?php echo e(route('contactUs')); ?>" target="_blank">Contact Us</a></li>
									<li><a href="<?php echo e(route('privacyPolicy')); ?>" target="_blank">Privacy Policy</a></li>
									<li><a href="<?php echo e(route('userAgreement')); ?>" target="_blank">User Agreement</a></li>
								</ul>
							</div>
						</div>
						<div class="columnTwo">
							<div class="footerLeftPartSubTtl">
								<h6>India Holidays</h6>
								<ul>
									<?php $__currentLoopData = $india_city_font; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $india_package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php if($india_package): ?>
											<li>
												<a href="<?php echo e(url('/holidays/')); ?>/<?php echo e(str_slug($india_package)); ?>-tour-packages" target="_blank"><?php echo e($india_package); ?> Tour Packages</a>
											</li>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</ul>
							</div>
						</div>
						<div class="columnThree">
							<div class="footerLeftPartSubTtl">
								<h6>International Holidays</h6>
								<ul>
									<?php $__currentLoopData = $out_india_city_font; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $out_india_package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php if($out_india_package): ?>
											<li>
												<a href="<?php echo e(url('/holidays/')); ?>/<?php echo e(str_slug($out_india_package)); ?>-tour-packages" target="_blank"><?php echo e($out_india_package); ?> Tour Packages</a>
											</li>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="footerRightPart">
					<div class="footerItemCont">
						<h4>Payment Mode</h4>
						<div class="paymentModeIconWrapper">
							<div class="paymentModeIconBox">
								<img class="lazy-load" data-src="<?php echo e(url('/resources/assets/frontend/images/icon/payment-logo/upi.webp')); ?>" alt="upi" lazyload="lazy">
							</div>
							<div class="paymentModeIconBox">
								<img class="lazy-load" data-src="<?php echo e(url('/resources/assets/frontend/images/icon/payment-logo/visa.webp')); ?>" alt="visacard" lazyload="lazy">
							</div>
							<div class="paymentModeIconBox">
								<img class="lazy-load" data-src="<?php echo e(url('/resources/assets/frontend/images/icon/payment-logo/mastercard.webp')); ?>" alt="mastercard" lazyload="lazy">
							</div>
							<div class="paymentModeIconBox">
								<img class="lazy-load" data-src="<?php echo e(url('/resources/assets/frontend/images/icon/payment-logo/american-express.webp')); ?>" alt="amex" lazyload="lazy">
							</div>
							<div class="paymentModeIconBox">
								<img class="lazy-load" data-src="<?php echo e(url('/resources/assets/frontend/images/icon/payment-logo/rupay.webp')); ?>" alt="rupay" lazyload="lazy">
							</div>
						</div>
					</div>
					<div class="footerItemCont">
						<h4>Follow us on</h4>
						<ul class="makeflex">
							<li>
								<?php if(getWebsiteData('facebook')): ?>
									<a href="<?php echo e(getWebsiteData('facebook')); ?>" target="_blank" aria-label="Facebook" rel="noopener noreferrer">
										<i class="fa-facebook" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</li>
							<li>
								<?php if(getWebsiteData('twitter')): ?>
									<a href="<?php echo e(getWebsiteData('twitter')); ?>" target="_blank" aria-label="Twitter" rel="noopener noreferrer">
										<i class="fa-twitter" aria-hidden="true"></i>
									</a>									
								<?php endif; ?>
							</li>
							<li>
								<?php if(getWebsiteData('instagram')): ?>
									<a href="<?php echo e(getWebsiteData('instagram')); ?>" target="_blank" aria-label="Instagram" rel="noopener noreferrer">
										<i class="fa-instagram" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</li>
							<!--<li>
								<?php if(getWebsiteData('googleplus')): ?>
									<a href="<?php echo e(getWebsiteData('googleplus')); ?>" target="_blank" aria-label="Google Plus" rel="noopener noreferrer">
										<i class="fa-google-plus" aria-hidden="true"></i>
									</a>
								<?php endif; ?>
							</li>-->
						</ul>
					</div>
					<div class="footerItemCont">
						<h4>Subscribe for Deals & Offers</h4>
						<form class="fullWidth" id="sub">
							<div class="makeflex">
								<input type="email" name="sub_email" id="sub_email" placeholder="Enter email id for exclusive deals and offers" required>
								<button class="btn-subscribe">Subscribe</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--<a href="javascript:" id="return-to-top">
				<i class="fa fa-angle-double-up" aria-hidden="true"></i>
			</a>-->
			<div class="copyRightCont">
				<div>
					<h4><?php echo e(getWebsiteData('startingYear')); ?> - <?php echo e(date('Y')); ?>, <?php echo e(getWebsiteData('copyRight')); ?></h4>
				</div>
				<div>
					<h4><?php echo e(getWebsiteData('developerName')); ?></h4>
				</div>
			</div>
		</div>
	</div>
	<!-- D-M Footer Ends -->