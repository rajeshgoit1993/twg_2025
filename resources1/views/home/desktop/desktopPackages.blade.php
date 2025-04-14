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
	@include('home.desktop.trendingIndianDestinations')

	<!-----------------------Popular Indian Tour Packages--------------------------------->
	@include('home.desktop.popularIndianPackages')

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
	@include('home.desktop.trendingInternationalDestinations')

	<!-----------------------Popular International Tour Packages------------------------->
	@include('home.desktop.popularInternationalPackages')
	
	<!--Desktop Home Packages Ends-->