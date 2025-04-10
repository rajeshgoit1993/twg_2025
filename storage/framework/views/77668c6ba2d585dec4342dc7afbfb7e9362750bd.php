		<!--Desktop Search Panel Header Starts-->
		<div class="dPageContainer">
			<!--Desktop Nav-Header Starts-->
			<div class="dNavBarCent navHeaderOuter" id="scrollToTopContent">
				<div class="navHeaderWrapper navClass">
					<div class="navHeaderContainer">
						<div class="navLogoBox">
							<a href="<?php echo e(URL::to('/')); ?>" title="The World Gateway">
							<div class="dLogoBox">
								<img src="<?php echo e(url('/public/uploads/twg.png')); ?>" alt="The World Gateway" />
							</div>
						</a>
						</div>
					<!--Nav Tabs-->
					<nav>
					<ul class="navTabs headerIconsGap" role="tablist">
						<!--Hotels-->
						<li class="nav-ite noContent-nav-item" role="presentation">
							<a href="https://www.booking.com/index.html?aid=7947205" target="_blank">
							<div class="dSrvcCont">
								<div class="dSvcIconBox">
									<div class="hotelIcon"></div>
								</div>
								<div class="dSvcIconName">Hotels</div>
							</div>
							</a>
						</li>
						<!--Holidays-->
						<li class="nav-item" role="presentation">
							<div class="dSrvcCont">
								<div class="dSvcIconBox">
									<div class="holidayIcon"></div>
								</div>
								<div class="dSvcIconName">Holiday Packages</div>
							</div>
						</li>
						<!--Travel Insurance-->
						<li class="nav-item" role="presentation">
							<div class="dSrvcCont">
								<div class="dSvcIconBox">
									<div class="travelInsuranceIcon"></div>
								</div>
								<div class="dSvcIconName">Travel Insurance</div>
							</div>
						</li>
					</ul>
					</nav>
					<?php echo $__env->make('layouts.front.userlogin.userLoginSection', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
				</div>
			</div>
			<!--Desktop Nav-Header Ends-->
		</div>
		<!--Desktop Search Panel Header Ends-->