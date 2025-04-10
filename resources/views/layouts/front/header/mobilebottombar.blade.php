					<!-- Mobile bottom bar starts -->
					<div class="mBar">
						<div class="mBarCont">
							<div class="mSvcCont">
								<a href="https://www.booking.com/index.html?aid=7947205" target="_blank">
									<div class="mSvcIcn">
										<span class="hotel"><i class="fa fa-building-o" aria-hidden="true"></i></span>
									</div>
									<div class="mSvcIcnTag">Hotels</div>
								</a>
							</div>
							<div class="mSvcCont">
								<a href="{{ route('home') }}">
									<div class="mSvcIcn">
										<span class="holidays"><i class="fa fa-suitcase" aria-hidden="true"></i></span>
									</div>
									<div class="mSvcIcnTag">Holidays</div>
								</a>
							</div>
							<div class="mSvcCont">
								@if(Sentinel::check())
								<a href="{{ route('myBooking') }}">
									<div class="mSvcIcn">
										<span class="email"><i class="fa fa-user" aria-hidden="true"></i></span>
									</div>
									<div class="mSvcIcnTag">My Trips</div>
								</a>
								@else
								<a href="javascript:void(0);" class="redirect-link" data-redirect="{{ route('myBooking') }}">
									<div class="mSvcIcn">
										<span class="email"><i class="fa fa-user" aria-hidden="true"></i></span>
									</div>
									<div class="mSvcIcnTag">My Trips</div>
								</a>
								@endif
							</div>
						</div>
					</div>
					<!-- Mobile bottom bar ends -->