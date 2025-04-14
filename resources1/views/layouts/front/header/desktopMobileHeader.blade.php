	<input type="hidden" id="base_url" value="{{ url('/')}}">
	<div class="whiteBG ">
		<div class="dPageContainer">
			<!-- Fixed-Header Starts -->
			<div class="dNavCont">
				<div class="dLogoContainer">
				    @php
				        $websiteData = getWebsiteData();
				    @endphp
				    <a href="{{ $websiteData['route'] ?? '#' }}" title="{{ $websiteData['name'] ?? 'Default Name' }}">
				        <div class="dLogoBox">
				            <img src="{{ $websiteData['logo'] ?? 'default-logo.png' }}" alt="{{ $websiteData['alt'] ?? 'Default Alt' }}" />
				        </div>
				    </a>
				</div>

				<!-- User Login Section -->
				@include('layouts.front.userlogin.userLoginSection')
			</div>
			<!-- Fixed-Header Ends -->
		</div>
		@include('layouts.front.header.mobilebottombar')
	</div>