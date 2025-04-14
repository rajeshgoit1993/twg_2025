				<div class="tab">
					<!--Holiday Sub Tab Starts-->
					<div class="sub-tab-container mobscroll scrollX">
						<div class="sub-nav-item">Search</div>
						<a class="flexOne" href="#domesticPackages"><div class="sub-nav-ite noContent-sub-nav-item">Trending Destination</div></a>
						<a class="flexOne" href="#honeymoonPackages"><div class="sub-nav-ite noContent-sub-nav-item">Honeymoon</div></a>
						<a class="flexOne" href="#"><div class="sub-nav-ite noContent-sub-nav-item">Easy Visa Destination</div></a>
					</div>
					<!--Holiday Sub Tab Ends-->
					<!--Holiday Sub Tab Content Starts-->
					<div class="sub-nav-item-content">
						<div class="sub-tab active">
							<form action="{{ URL::to('/packages_list') }}" method="post" autocomplete="off" name="search2" id="search2" >
								<input type="hidden" name="_token" value="{{ Session::token() }}"/>
								<div class="dHldyPanel">
									<div class="tripTypeCont">
										<h4>Book Domestic and International Tour Packages</h4>
									</div>
									<div class="dHldyPanelBox">
										<div class="dSvcPanel" style="width: 50%;">
											<div class="dSvcPanel_inputbox">
												<label for="countrySearch">Starting City</label>
												<select class="" id="countrySearch">
													<option value="">All</option>
												</select>
											</div>
										</div>
										<div class="dSvcPanel_inputbox">
											<label for="destination_search">To City / Country</label>
											<select class="select3 package_service" id="destination_search" required></select>
										</div>
										<div class="dSvcPanel_inputbox" style="max-width: ;">
											<label for="datepicker" class="inputBoxdownArrow">Departure Date</label>
											<input type="text" id="datepicker" name="datepicker" class="searchContainer_inputBox" value="{{ date('d M y', strtotime('+2 months')) }}" placeholder="Select Date">
										</div>
										<div class="dSvcPanel_inputbox" style="max-width: ;">
											<label for="select_theme" class="inputBoxdownArrow">Travel Theme</label>
											<select id="select_theme" name="select_theme" class="select2">
												<option value="">All</option>
											</select>
										</div>
									</div>
								</div>
								<div class="dSrchBtnCont">
									<button type="submit" class="btnMain btnSearchWeb">Search</button>
								</div>
							</form>
						</div>
						<!--<div class="sub-tab">
							<div class="dHldyPanel">
								<div class="tripTypeCont">
									<h4>Select Trending Destinations</h4>
								</div>
								<div class="dHldyPanelBox">
									Goa, Srinagar, Kerala
								</div>
							</div>
						</div>-->
					</div>
					<!--Holiday Sub Tab Content Ends-->
				</div>