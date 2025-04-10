	<!--Desktop Home Packages Starts-->
	<!-----------------------Indian Destination and Packages----------------------------->
	<div class="mBG">
		<div class="dPageContainer">
			<div class="dContentScrollView" id="domesticPackages"></div>
			<div class="destTypeCont">
				<ul class="destType">
					<li class="destinationTab tabActive">
						<span>Indian Destinations</span>
					</li>
					<a href="#internationalPackages">
					<li class="destinationTab">
						<span>International Destinations</span>
					</li>
					</a>
				</ul>
			</div>
		</div>
	</div>
	<!-----------------------Trending Indian Destination---------------------------------->
	<?php echo $__env->make('home.desktop.trendingIndianDestinations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-----------------------Popular Indian Tour Packages--------------------------------->
	<?php echo $__env->make('home.desktop.popularIndianPackages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-----------------------International Destination and Packages----------------------->
	<div class="mBG">
		<div class="dPageContainer">
			<div class="dContentScrollView" id="internationalPackages"></div>
			<div class="destTypeCont">
				<ul class="destType">
					<a href="#domesticPackages">
					<li class="tablinks destinationTab">
						<span>Indian Destinations</span>
					</li>
					</a>
					<li class="destinationTab tabActive">
						<span>International Destinations</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-----------------------Trending International Destination-------------------------->
	<?php echo $__env->make('home.desktop.trendingInternationalDestinations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<!-----------------------Popular International Tour Packages------------------------->
	<?php echo $__env->make('home.desktop.popularInternationalPackages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<!--Desktop Home Packages Ends-->