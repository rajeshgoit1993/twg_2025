	<!------------------------------------ REMOVE (using DesktopFooter for Mobile & Desktop) ----------------------------------------->
	<div class="mFooter">
		<div class="makeflex">
			<div class="dFtrLftSubTtl" style="width: 50%;">
				<h4>India Holidays</h4>
				<ul>
				@foreach($india_city_font as $india_package )
					@if($india_package)
						<li><i class="fa-angle-right" aria-hidden="true"></i>
							<a href="{{ url('/Holidays/') }}/{{ str_slug($india_package) }}-tour-packages">{{ $india_package }} Tour Packages</a>
						</li>
					@endif
				@endforeach
				</ul>
			</div>
			<div class="dFtrLftSubTtl" style="width: 50%;">
				<h4>International Holidays</h4>
				<ul>
				@foreach($out_india_city_font as $out_india_package)
					@if($out_india_package)
						<li><i class="fa-angle-right" aria-hidden="true"></i>
							<a href="{{ url('/Holidays/') }}/{{ str_slug($out_india_package) }}-tour-packages">{{ $out_india_package }} Tour Packages</a>
						</li>
					@endif
				@endforeach
				</ul>
			</div>
		</div>
		<div class="makeflex appendTop30">
			<div class="dFtrLftSubTtl" style="width: 50%;">
				<h4>Theme</h4>
				<ul>
				@foreach($theme_front_data as $theme_front )
				@if($theme_front)
					@if(CustomHelpers::get_theme_footerstatus($theme_front))
						<li>
							<i class="fa-angle-right" aria-hidden="true"></i>
							<a href="{{ url('/theme/'.str_slug($theme_front).'-packages') }}">{{ $theme_front }}</a>
						</li>
					@endif
				@endif
				@endforeach
				</ul>
			</div>
			<div class="dFtrLftSubTtl" style="width: 50%;">
				<h4>About us</h4>
				<ul>
					<li>
						<i class="fa-angle-right" aria-hidden="true"></i>
						<a href="{{ route('aboutUs') }}">About Us</a>
					</li>
					<li>
						<i class="fa-angle-right" aria-hidden="true"></i>
						<a href="{{ route('contactUs') }}">Contact Us</a>
					</li>
					<li>
						<i class="fa-angle-right" aria-hidden="true"></i>
						<a href="{{ route('privacyPolicy') }}">Privacy Policy</a>
					</li>
					<li>
						<i class="fa-angle-right" aria-hidden="true"></i>
						<a href="{{ route('userAgreement') }}">User Agreement</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="mFtrSubscription">
			<h3>Subscribe for Deals & Offers</h3>
			<form id="sub">
				<div class="makeflex">
					<div class="mFtrSubsInputBox">
						<input type="email" name="sub_email" id="sub_email" placeholder="Enter email id for exclusive deals and offers" required>
					</div>
					<div>
						<button class="dBtnMain dBtnSubscribe">Subscribe</button>
					</div>
				</div>
			</form>
		</div>
		<div class="mFtrRgtSubTtl">
			<h3>Payment Mode</h3>
			<div class="makeflex">
				<div class="mPmtModeIconBox">
					<img class="lazy-load" data-src="{{ url('/resources/assets/frontend/images/icon/payment-logo/mobile/visacard.png') }}" alt="visacard">
				</div>
				<div class="mPmtModeIconBox">
					<img class="lazy-load" data-src="{{ url('/resources/assets/frontend/images/icon/payment-logo/mobile/mastercard.png') }}" alt="mastercard">
				</div>
				<div class="mPmtModeIconBox">
					<img class="lazy-load" data-src="{{ url('/resources/assets/frontend/images/icon/payment-logo/mobile/amexcard.png') }}" alt="amex">
				</div>
				<div class="mPmtModeIconBox">
					<img class="lazy-load" data-src="{{ url('/resources/assets/frontend/images/icon/payment-logo/mobile/rupaycard.png') }}" alt="rupay">
				</div>
			</div>
		</div>
		<div class="mFtrSclMedia">
			<h3>Follow us on</h3>
			<ul class="makeflex">
				<li>
					<a href="{{ getWebsiteData('facebook') }}" target="_blank" aria-label="Facebook" rel="noopener noreferrer">
						<i class="fa-facebook" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="{{ getWebsiteData('twitter') }}" target="_blank" aria-label="Twitter" rel="noopener noreferrer">
						<i class="fa-twitter" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="{{ getWebsiteData('instagram') }}" target="_blank" aria-label="Instagram" rel="noopener noreferrer">
						<i class="fa-instagram" aria-hidden="true"></i>
					</a>
				</li>
				<!--<li>
					<a href="{{ getWebsiteData('googleplus') }}" target="_blank" aria-label="Google Plus" rel="noopener noreferrer">
						<i class="fa-google-plus" aria-hidden="true"></i>
					</a>
				</li>-->
			</ul>
		</div>
	</div>
	<!------------------------------------ REMOVE ----------------------------------------->
