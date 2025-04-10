<div class="dFooter">
	<div class="container">
		<div class="dFtrBox">
			<div class="dFtrLeftSecn">
				<div class="makeflex">
					<div class="flexOne" style="min-width: 20%;">
						<div class="dFtrLftSubTtl">
							<h4>Theme</h4>
								<ul>
								@foreach($theme_front_data as $theme_front )
								@if($theme_front)
									@if(CustomHelpers::get_theme_footerstatus($theme_front))
										<li>
											<i class="fa-angle-right" aria-hidden="true"></i><a href="{{ url('/theme/'.str_slug($theme_front).'-packages') }}">{{ $theme_front }}</a>
										</li>
									@endif
								@endif
								@endforeach
								</ul>
						</div>
						<div class="dFtrLftSubTtl">
							<h4 class="appendTop30">About us</h4>
								<ul>
									<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ URL::to('/about') }}">About Us</a></li>
									<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ URL::to('/contact-us') }}">Contact Us</a></li>
									<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ URL::to('/Privacy-Policy') }}">Privacy Policy</a></li>
									<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ URL::to('/User-Agreement') }}">User Agreement</a></li>
								</ul>
						</div>
					</div>
					<div class="flexOne" style="min-width: 30%;">
							<div class="dFtrLftSubTtl">
								<h4>India Holidays</h4>
									<ul>
										@foreach($india_city_font as $india_package )
											@if($india_package)
												<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ url('/Holidays/') }}/{{ str_slug($india_package) }}-tour-packages">{{ $india_package }} Tour Packages</a>
												</li>
											@endif
										@endforeach
									</ul>
							</div>
						</div>
						<div class="flexOne" style="min-width: 30%;">
							<div class="dFtrLftSubTtl">
								<h4>International Holidays</h4>
									<ul>
									@foreach($out_india_city_font as $out_india_package)
										@if($out_india_package)
											<li><i class="fa-angle-right" aria-hidden="true"></i><a href="{{ url('/Holidays/') }}/{{ str_slug($out_india_package) }}-tour-packages">{{ $out_india_package }} Tour Packages</a>
											</li>
										@endif
									@endforeach
									</ul>
							</div>
						</div>
					</div>
			</div>
			<div class="dFtrRghtSecn">
				<div class="dFtrRgtSubTtl">
					<h3>Payment Mode</h3>
					<div class="makeflex">
						<div class="dPmtModeIconBox">
							<img src="{{ url('/resources/assets/frontend/images/icon/visacard.png') }}" alt="visacard">
						</div>
						<div class="dPmtModeIconBox">
							<img src="{{ url('/resources/assets/frontend/images/icon/mastercard.png') }}" alt="mastercard">
						</div>
						<div class="dPmtModeIconBox">
							<img src="{{ url('/resources/assets/frontend/images/icon/amexcard.png') }}" alt="amex">
						</div>
						<div class="dPmtModeIconBox">
							<img src="{{ url('/resources/assets/frontend/images/icon/rupaycard.png') }}" alt="rupay">
						</div>
					</div>
				</div>
				<div class="dFtrSclMedia">
					<h3>Follow us on</h3>
					<ul class="makeflex">
						<li><a href="https://www.facebook.com/rapidextravels" target="_blank"><i class="fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="https://twitter.com/rapidextravels" target="_blank"><i class="fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="https://www.instagram.com/rapidextravels/" target="_blank"><i class="fa-instagram" aria-hidden="true"></i></a></li>
						<!--<li><a href="https://plus.google.com/discover" target="_blank"><i class="fa-google-plus" aria-hidden="true"></i></a></li>-->
					</ul>
				</div>
				<div class="dFtrSubscription">
					<h3>Subscribe for Deals & Offers</h3>
					<form id="sub">
						<div>
							<input type="email" name="sub_email" id="sub_email" class="" placeholder="Enter email id for exclusive deals and offers"  required>
						</div>
						<div class="flexJcEnd">
							<button class="dBtnMain dBtnSubscribe">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<a href="javascript:" id="return-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</a>
		<div class="dCopyrightCont">
			<div>
				@if(env("WEBSITENAME")==1)
					<h4>2016 - 2022, All Right Reserved - by The World Gateway</h4>
				@elseif(env("WEBSITENAME")==0)
					<h4>2006 - 2022, All Right Reserved - by Rapidex Travels</h4>
				@endif
			</div>
			<div>
				<h4>Developed By: Cherry Tech</h4>
			</div>
		</div>
	</div>
</div>
 