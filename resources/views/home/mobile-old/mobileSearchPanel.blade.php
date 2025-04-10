<!--Search Panel starts-->
<div>
	<!--Nav Bar-->
	<div class="mNavBarCont">
		<div class="mNavBar">
			<ul role="tablist">
				<!--<li role="presentation">
					<a href="https://flights.theworldgateway.com/" aria-controls="mFlights" target="_blank">
					<div class="mSrvcCont">
						<div class="mSrvcIcn">
							<img height= "36" src="{{ asset("/resources/assets/frontend/images/icon")."/mAirplane.png" }}" aria-hidden="true">
						</div>
						<div class="mSrvcIcnTag">Flights</div>
					</div>
					</a>
				</li>-->
				<li role="presentation">
					<a href="https://www.booking.com/index.html?aid=7947205" aria-controls="hotels" target="_blank">
					<div class="mSrvcCont">
						<div class="mSrvcIcn">
							<img height= "34" src="{{ asset("/resources/assets/frontend/images/icon")."/mHotel.png" }}" aria-hidden="true">
						</div>
						<div class="mSrvcIcnTag">Hotels</div>
					</div>
					</a>
				</li>
				<li role="presentation">
					<a href="#mHolidays" aria-controls="mHolidays" role="tab" data-toggle="tab">
					<div class="mSrvcCont">
						<div class="mSrvcIcn">
							<img height= "36" src="{{ asset("/resources/assets/frontend/images/icon")."/mHoliday.png" }}" aria-hidden="true">
						</div>
						<div class="mSrvcIcnTag">Holidays</div>
					</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="mContainer">
			<!-- Tab panes -->
			<div class="tab-content">
				<!--Holidays Search starts-->
				<div role="tabpanel" class="fade in active" id="mHolidays">
					<form action="{{ URL::to('/packages_list') }}" method="post" autocomplete="off" id="search_mobile" name="search_mobile">
						<input type="hidden" name="_token" value="{{ Session::token() }}"/>
						<div class="tripTypeCont">
							<h4>Book Domestic and International Tour Packages</h4>
						</div>
						<div class="mSearchBox">
							<select class=" select3 package_service destination_search_mobile" id="destination_search" required></select>
							<button class="mBbtnSearch"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</button>
						</div>
						<div class="responseResult" id="response"></div>
					</form>
				</div>
				<!--Holidays Search ends-->
				<!--Hotel Search starts-->
				<div role="tabpanel" class="tab-pane fade" id="mHotels">
					<form action="{{ URL::to('/search-hotel') }}" method="POST">
					<input type="hidden" name="_token"  value="{{ Session::token() }}"/>
						<div class="row">
							<div class="col-md-4">
								<label>Location</label>
								<div class="right-inner-addon"><i class="fa fa-map-o" aria-hidden="true"></i>
								<input type="text" id="autocomplete" name="hotelcity" class="form-control" placeholder="Search by Hotel or City Name" />
								</div>
							</div>
							<div class="col-md-2 col-xs-6">
								<div class="date_main">
								<label class="lab_custom">Check in</label>
								<input type="hidden" id="input-hotel-checkin" name="hotel_checkin" />
								<div class="bfh-datepicker" id="hotelcheckin" data-format="d/ m/ y" name="checkin" data-date="today"></div>
								</div>
							</div>
							<div class="col-md-2 col-xs-6">
								<div class="date_main">
								<label class="lab_custom">Check out</label>
								<input type="hidden" id="input-hotel-checkout"  name="hotel_checkout" />
								<!--<i class="fa fa-calendar" aria-hidden="true"></i>-->
								<div class="bfh-datepicker" id="hotelcheckout" data-format="d/ m/ y" name="checkout" data-date="today"></div>
								</div>
							</div>
							<div class="col-md-2">
								<label class="lab_custom">Guests</label>
								<div class="right-inner-addon ">
								<input type="number" id="guest_count" name="guest" min="1" max="5" placeholder="Guests">
								</div>
							</div>
							<div class="col-md-2">
								<div class="search_button">
								<button type="submit" class="btn-5"><i class="fa fa-search" aria-hidden="true" id="searchHotel"></i> Search</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!--Hotel Search ends-->
				<!--Flight Search starts-->
				<div role="tabpanel" class="tab-pane fade " id="mFlights">
					<div class="row">
						<div class="col-md-4 col-xs-6">
							<label>Origin</label>
							<div class="right-inner-addon ">
							<!--<i class="fa fa-map-o" aria-hidden="true"></i>-->
							<input type="text" class="form-control" placeholder="Enter Location" />
							</div>
						</div>
						<div class="col-md-4 col-xs-6">
							<label>Destination</label>
							<div class="right-inner-addon ">
							<i class="fa fa-map-o" aria-hidden="true"></i>
							<input type="text" class="form-control" placeholder="Enter Location" />
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<label class="lab_custom">Class Type</label>
							<div class="right-inner-addon ">
								<select>
									<option>Economy</option>
									<option>Business</option>
									<option>First</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-3 col-xs-6 mar_top">
							<div class="date_main">
								<label>Departure</label>
								<!--<i class="fa fa-calendar" aria-hidden="true"></i>-->
								<div class="bfh-datepicker" data-format="d/ m/ y" >
									<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker" >
										<input name="" class="form-control" placeholder="" readonly="" type="text">
									</div>
									<div class="bfh-datepicker-calendar"></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-xs-6 mar_top">
							<div class="date_main">
								<label>Return</label>
								<!--<i class="fa fa-calendar" aria-hidden="true"></i>-->
								<div class="bfh-datepicker" data-format="d/ m/ y" >
									<div class="input-group bfh-datepicker-toggle" data-toggle="bfh-datepicker">
										<input name="" class="form-control" placeholder="" readonly="" type="text">
									</div>
									<div class="bfh-datepicker-calendar"></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 mar_top">
							<label class="lab_custom">Guests</label>
							<div class="right-inner-addon " style="cursor: pointer;">
								<i class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" ></i>
								<input type="text" name="quantity" min="1" id="travel_value" value="1" readonly style="cursor: pointer;"><span class="tra">Traveller</span>
							</div>
							<div class="travelers" id="travelers">
								<span class="glyphicon glyphicon-triangle-top travel_icon"></span>
								<div class="row ">
									<div class="col-md-12 col-xs-12 ">
										<div class="travel_inner">
											<div class="pull-left ">
												<p><span id="travel_adult">1</span> <span class="ad">Adult</span></p>
											</div>
											<div class="pull-right ">
												<span class="travel_inc travel_inc_left travel_adult_minus glyphicon glyphicon-minus"></span>
												<span class="travel_inc travel_inc_right travel_adult_plus glyphicon glyphicon-plus"></span>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<!---->
									<div class="col-md-12 col-xs-12 ">
										<div class="travel_inner">
											<div class="pull-left ">
												<p><span id="travel_child">0</span> <span class="ch">Child</span> &nbsp;&nbsp;&nbsp;
												<span style="font-size: 11px;color: gray">2-12 YRS</span></p>
											</div>
											<div class="pull-right ">
												<span class="travel_inc travel_inc_left travel_child_minus glyphicon glyphicon-minus"></span>
												<span class="travel_inc travel_inc_right travel_child_plus glyphicon glyphicon-plus"></span>
											</div>
										<div class="clearfix"></div>
										</div>
									</div>
									<!---->
									<div class="col-md-12 col-xs-12 ">
										<div class="travel_inner" style="border-style: none;">
											<div class="pull-left ">
												<p><span id="travel_infant">0</span> <span class="inf">Infant</span> &nbsp;&nbsp;&nbsp;
												<span style="font-size: 11px;color: gray">Below 2 YRS</span></p>
											</div>
											<div class="pull-right ">
												<span class="travel_inc travel_inc_left travel_infant_minus glyphicon glyphicon-minus"></span>
												<span class="travel_inc travel_inc_right travel_infant_plus glyphicon glyphicon-plus"></span>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<!---->
									<div class="col-md-12 col-xs-12 ">
										<div class="travel_inner" style="border-style: none;">
											<div class="pull-left"></div>
												<div class="pull-right ">
													<button id="done">Done</button>
												</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<!---->
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-3 mar_top">
							<div class="search_button">
								<button class="btn-5"  style="height: 41px;"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
							</div>
						</div>
					</div>
				</div>
				<!--Flight Search ends-->
			</div>
		</div>
	</div>
	<!--Banner-->
	@include('home.mobile.mobileBanner')
</div>
<!--Search Panel ends-->