				<div class="tab">
					<!--Travel Insurance Sub Tab Starts-->
					<!--Travel Insurance Sub Tab Ends-->
					<!--Travel Insurance Sub Tab Content Starts-->
					<div class="sub-nav-item-content">
						<div class="sub-tab active">
							<!-- <form action="<?php echo e(URL::to('/packages_lists')); ?>" method="post" autocomplete="off" name="search2" id="search2" > -->
							<form action="" method="" autocomplete="off" name="" id="">
								<input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>"/>
								<div class="dHldyPanel">
									<div class="tripTypeCont">
										<h4>Book Travel Insurance</h4>
									</div>
									<div class="dHldyPanelBox">
										<div class="dSvcPanel_inputbox flexTwo">
											<label for="destination_name">Travelling Country</label>
											<select class="select3 package_service" id="destination_name" required></select>
										</div>
										<!-- start date -->
										<div class="dSvcPanel_inputbox_date flexOne">
											<label for="datepicker_insurance_startdate">
												<span class="searchBoxdownArrow">Start Date</span>
												<input type="text" id="datepicker_insurance_startdate" name="datepicker_insurance_startdate" value="<?php echo e(date('d M y', strtotime('+10 days'))); ?>" placeholder="Select Date" style="opacity: 0;height: 0;padding: 0;" />
												<div class="dateValueCont">
													<div class="dateValue makeflex">
														<span class="dayStyle" id="day-insurance-startdate"></span>
														<span class="monthStyle comma" id="month-insurance-startdate"></span>
														<span class="yearStyle" id="year-insurance-startdate"></span>
													</div>
													<div class="dayName" id="day-name-insurance-startdate"></div>
												</div>
											</label>
										</div>

										<!-- end date -->
										<div class="dSvcPanel_inputbox_date flexOne">
											<label for="datepicker_insurance_enddate">
												<span class="searchBoxdownArrow">Return Date</span>
												<input type="text" id="datepicker_insurance_enddate" name="datepicker_insurance_enddate" value="<?php echo e(date('d M y', strtotime('+10 days'))); ?>" placeholder="Select Date" />
												<div class="dateValueCont">
													<div class="dateValue makeflex">
														<span class="dayStyle" id="day-insurance-enddate"></span>
														<span class="monthStyle comma" id="month-insurance-enddate"></span>
														<span class="yearStyle" id="year-insurance-enddate"></span>
													</div>
													<div class="dayName" id="day-name-insurance-enddate"></div>
												</div>
											</label>
										</div>

										<!-- no of guests -->
										<div class="dSvcPanel_inputbox flexOne">
											<label for="guests-box">Guests</label>
											<input type="text" id="guests-box" value="1" placeholder="Number of Guests" readonly >
											<!--Guest Details Starts-->
											<div class="guestsDetailsWrapper" id="guest-details">
												<div class="guests-detail-top-section">
													<div class="guestsCountInputWrapper ">
														<div class="guestsCountInputTtl">Guests</div>
														<div class="makeflex align-center">
															<span class="minusGuestCount" id="decrease-guests">&#8722;</span>
															<input type="hidden" id="guests-input-box" value="1">
															<span class="totalGuestCount" id="guest-count-display">1</span>
															<span class="plusGuestCount" id="increase-guests">&#43;</span>
														</div>
													</div>
													<div class="makeflex">
														<div class="guest-age" id="age-selection">
														    <div class="age-selection-item">
														      <label for="adult-1-age">Adult 1:</label>
														      <select id="adult-1-age" name="adult-1-age">
														      </select>
														    </div>
														</div>
													</div>
												</div>
												<div class="roomGuestBottomSection">
													<!-- <button type="button" class="btnAddMore" name="submit">+ Add Another Room</button> -->
													<button type="button" class="btnApply" name="submit">Apply</button>
												</div>
											</div>
											<!--Guest Details Ends-->
										</div>
									</div>
								</div>
								<div class="dSrchBtnCont">
									<button type="submit" class="btnSearchWeb">Book</button>
								</div>
							</form>
						</div>
					</div>
					<!--Travel Insurance Sub Tab Content Ends-->
				</div>