				<div class="tab">
					<!-- Holiday Sub Tab -->
					<div class="sub-tab-container">
						<div class="sub-nav-item">
							<h5 class="holiday-search-icon">Search</h5>
						</div>
						<a class="flexOne" href="#domesticPackages">
							<div class="noContent-sub-nav-item sub-nav-ite">
								<h5 class="holiday-destination-icon">Trending Destination</h5>
							</div>
						</a>
						<a class="flexOne" href="#honeymoonPackages">
							<div class="noContent-sub-nav-item sub-nav-ite">
								<h5 class="holiday-honeymoon-icon">Honeymoon</h5>
							</div>
						</a>
						<a class="flexOne" href="#">
							<div class="noContent-sub-nav-item sub-nav-ite">
								<h5 class="holiday-easyvisa-icon">Easy Visa Destination</h5>
							</div>
						</a>
					</div>

					<!-- Holiday Sub Tab Content -->
					<div class="sub-nav-item-content">
						<div class="sub-tab active">
							<!-- <form action="{{ URL::to('/packages_list') }}" method="post" autocomplete="off" name="search2" id="search2" > -->
							<form action="{{ route('productList') }}" method="post" autocomplete="off" name="search2" id="search2" >
								<input type="hidden" name="_token" value="{{ Session::token() }}"/>
								<div class="dHldyPanel">
									<div class="tripTypeCont">
										<h4>Book Domestic and International Tour Packages</h4>
									</div>
									<div class="dHldyPanelBox">
										<div class="dSvcPanel_inputbox flexTwo">
											<label for="destination_search">To City / Country</label>
											<select class="select3 package_service" id="destination_search" required>
												<!-- populate from AJAX-->
											</select>
										</div>
										<div class="dSvcPanel_inputbox_date flexOne">
											<label for="datepicker_holiday" class="">
												<span class="searchBoxdownArrow">Departure Date</span>
												<input type="text" id="datepicker_holiday" name="datepicker" value="{{ date('d M y', strtotime('+2 months')) }}" placeholder="Select Date" />
												<div class="dateValueCont">
													<div class="dateValue makeflex">
														<span class="dayStyle" id="day-holiday"></span>
														<span class="monthStyle comma" id="month-holiday"></span>
														<span class="yearStyle" id="year-holiday"></span>
													</div>
													<div class="dayName" id="day-name-holiday"></div>
												</div>
											</label>
										</div>
										<div class="dSvcPanel_inputbox flexOne">
											<label for="select_theme" class="searchBoxdownArrow">Travel Theme</label>
											<select id="select_theme" name="select_theme" class="select2">
												<!-- <option value="">All</option> -->
												<!-- populate from theme selection based on destination -->
											</select>
										</div>
									</div>
								</div>
								<div class="dSrchBtnCont">
									<button type="submit" class="btnSearchWeb">Search</button>
								</div>
							</form>
						</div>
					</div>
				</div>