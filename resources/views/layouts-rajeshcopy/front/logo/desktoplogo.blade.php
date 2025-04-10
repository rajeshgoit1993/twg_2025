			<!--Desktop Logo starts-->
			<div class="container">
				<div class="dNavCont">
					<div>
					@if(env("WEBSITENAME")=="1")
						<a href="{{ URL::to('/') }}" title="The World Gateway">
							<div class="dLogoBox">
								<img src="{{ url('/public/uploads/twg.png') }}" alt="The World Gateway" />
							</div>
						</a>
					@elseif(env("WEBSITENAME")=="0")
						<a href="{{ URL::to('/') }}" title="Rapidex Travels">
							<div class="dLogoBox">
								<img src="{{ url('/public/uploads/logo.png') }}" alt="Rapidex Travels" />
							</div>
						</a>
					@endif
					</div>
					<div>
					

					<nav id="" class="mainMenu" role="navigation">
						<ul class="">
							<!--<li><a href="{{ URL::to('/') }}">Home</a></li>-->
							<!--<li style="display: none;"><a href="https://flights.theworldgateway.com/" target="_blank">Flights</a></li>-->
							<li><a href="https://www.booking.com/index.html?aid=7947205" target="_blank">Hotels</a></li>
							<li><a href="{{ URL::to('/') }}">Holidays</a></li>
							@if(Sentinel::check())

							@if(Sentinel::getUser()->roles()->first()->slug == 'customer' )
<li><a href="" id="myaccount">My Account</a></li>
							@else
<li><a href="{{url('/dashboard')}}" >My Account</a></li>
							@endif
							
								<div class="account">
									<div class="dUserIcon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></div>
										<form action="{{ URL::to('/logout-customer') }}" id="logout-form" method="POST">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<div class="myAccount_item">
													<a href="{{ URL::to('/my-booking') }}"><i class="fa fa-cog myAccount_itemIcon" aria-hidden="true"></i>My Bookings</a>
												</div>
												<div class="myAccount_item">
													<a href="{{ URL::to('/customer-panel') }}"><i class="fa fa-user myAccount_itemIcon" aria-hidden="true" ></i>Profile</a>
												</div>
												<div class="myAccount_item">
													<a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox"><i class="fa fa-sign-out myAccount_itemIcon" aria-hidden="true"></i>Logout</a>
												</div>
										</form>
								</div>
							@else
								<li><a href="#" class="soap-popupbox" data-toggle="modal" data-target="#user-login">Login</a></li>
							@endif
						</ul>
					</nav>
					</div>
				</div>
			</div>
			<!--Desktop Logo ends-->