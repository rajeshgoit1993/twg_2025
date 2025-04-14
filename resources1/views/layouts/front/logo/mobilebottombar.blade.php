					<!------------------------------------ REMOVE ----------------------------------------->
					<!--Mobile home bottom bar starts--> <!-- REMOVED -->
					<div class="mBar" style="display: none">
						<div class="mBarCont">
							<!--<div class="mSvcCont" style="display: none;">
								<a href="https://flights.theworldgateway.com/" target="_blank">
									<div class="mSvcIcn">
										<i class="fa fa-plane" aria-hidden="true" style="font-size: 22px;"></i>
									</div>
									<div class="mSvcIcnTag">Flights</div>
								</a>
							</div>-->
							<div class="mSvcCont">
								<a href="https://www.booking.com/index.html?aid=7947205" target="_blank">
									<div class="mSvcIcn">
										<i class="fa fa-building-o" aria-hidden="true" style="font-size: 20px;"></i>
									</div>
									<div class="mSvcIcnTag">Hotels</div>
								</a>
							</div>
							<div class="mSvcCont">
								<a href="{{ URL::to('/') }}">
									<div class="mSvcIcn">
										<i class="fa fa-suitcase" aria-hidden="true"></i>
									</div>
									<div class="mSvcIcnTag">Holidays</div>
								</a>
							</div>
							<!--<div>
								<a href="{{ URL::to('/contact-us') }}">
									<p style="text-align: center;margin: 0px;"><i class="fa fa-envelope" aria-hidden="true" style="font-size: 20px;color: white;"></i></p>
									<p style="font-size: 12px;margin-bottom: 0px;text-align: center;color: white;">Email</p>
								</a>
							</div>-->
								
							@if(Sentinel::check())
							<div class="mSvcCont">
								@if(Sentinel::getUser()->roles()->first()->slug == 'customer' )
								<a href="" id="myaccount">
									<div class="mSvcIcn-logggedin">
										<i class="fa fa-user" aria-hidden="true" style="font-size: 22px;"></i>
									</div>
									<div class="mSvcIcnTag-logggedin">My Account</div>
								</a>
								@else
								<a href="{{url('/dashboard')}}">
									<div class="mSvcIcn-logggedin">
										<i class="fa fa-user" aria-hidden="true" style="font-size: 22px;"></i>
									</div>
									<div class="mSvcIcnTag-logggedin">My Account</div>
								</a>
								@endif
							</div>
							<div class="account">
								<div class="mUserPrflIcn">
									<i class="glyphicon glyphicon-user"></i>
								</div>
								<form action="{{ URL::to('/logout-customer') }}" id="logout-form" method="POST">
									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									<div class="mLoginItemCont">
										<a href="{{ URL::to('/customer-panel') }}">
											<div class="mLoginItem">
												<span><i class="mLoginItemIcon fa fa-cog" aria-hidden="true"></i>My Bookings</span>
											</div>
										</a>
										<a href="{{ URL::to('/customer-panel') }}">
											<div class="mLoginItem">
												<span><i class="mLoginItemIcon fa fa-user" aria-hidden="true"></i>Profile</span>
											</div>
										</a>
										<a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox">
											<div class="mLoginItem">
												<span><i class="mLoginItemIcon fa fa-sign-out" aria-hidden="true"></i>Logout</span>
											</div>
										</a>
									</div>
								</form>
								</div>
								@else
								<div class="mSvcCont">
									<a href="#user-login" class="soap-popupbox">
										<div class="mSvcIcn">
											<i class="fa fa-user" aria-hidden="true" style="font-size: 22px;"></i>
										</div>
										<div class="mSvcIcnTag">Login</div>
									</a>
								</div>
								@endif
							</div>
					</div>
					<!--Mobile home bottom bar ends-->
					<!------------------------------------ REMOVE ----------------------------------------->
