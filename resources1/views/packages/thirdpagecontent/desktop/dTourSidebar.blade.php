						<!--Desktop Tour Price Side Bar Starts-->
						<div class="dSideNav" id="sidebar_custom">
							<!--Price Container-->
							<div class="dPosition_Sticky whitebg">
								<div class="dSideItemCont">

									<!--Price Box-->
									<div class="get_update_price">
										@if($new_price!='na')
											@if($new_price['actual_price']==$new_price['discount_price'])
											<div class="dSideItemBoxTop flexCenter">
												<p class="dSlashedPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
												<p class="dPriceTag"><span class="dActualPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $details->Price_type }}</p>
											</div>
											@else
											<div class="dSideItemBoxTop">
												<p class="dSlashedPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
												<p class="dPriceTag"><span class="dActualPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $details->Price_type }}</p>
												<p class="dPriceSubTag">*Excluding applicable taxes</p>
												<span class="dPkgOfferTag">
													<?php
														$tourdiscount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
														$percentage=$tourdiscount/$new_price['actual_price']*100;
													?>
													{{ round($percentage) }}% Off
												</span>
											</div>
											@endif
										@else
											<div class="dSideItemBoxTop flexCenter">
												<p class="dPriceTag_OnRequest"><span class="defaultCurrency"></span> On Request</p>
											</div>
										@endif
									</div>

									<!--Price Date Range-->
									<div class="dSideItemBoxBottom">
										<div class="dDateRangeBox">
											<div class="flexBetween">
												<div class="dDateRange">20 Dec - 24 Dec</div>
												<div class="dDateRange_Modify" onclick="document.getElementById('datepicker').focus();">Modify</div>
											</div>
										</div>
										<!--Booking-->
										<div class="dBookBtnBox">
											<button type="button" class="btnMain btnViewDtls" id="addEnquiryModal_desktop">BOOK</button>
										</div>
									</div>
								</div>

								<!--Why Book with us-->
								<!-- <div class="dbook_with_us_cont">
									<div>
										<h4 class="">Why Book with us?</h4>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box">
											<i class="fa fa-support"></i>
										</div>
										<div>
											<h5 class="">Excellent Support</h5>
											<p>We have dedicated team to provide the support</p>
										</div>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box">
											<i class="fa fa-money"></i>
										</div>
										<div>
											<h5 class="">Low Rates & Savings</h5>
											<p>Contracted rates with the Hotels help to minimize the cost to Tour Packages</p>
										</div>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box">
											<i class="fa fa-bars"></i>
										</div>
										<div>
											<h5 class="">Variety of Tour Itineraries</h5>
											<p>Our experts work on the Tour itineraries to be offered </p>
										</div>
									</div>
								</div> -->
								<div class="dbook_with_us_cont">
									<div>
										<h4 class="">Why Book with us?</h4>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box star-icon">
											<!-- <i class="fa fa-support"></i> -->
										</div>
										<div>
											<h5>Exceptional Support & Care</h5>
											<p>Your journey is our priority! Our friendly, professional team is dedicated to providing 24/7 support—before, during, and after your trip. From customized advice to real-time assistance, we ensure a stress-free and enjoyable travel experience.</p>
										</div>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box money-bag-icon">
											<!-- <i class="fa fa-money"></i> -->
											
										</div>
										<div>
											<h5>Unbeatable Rates & Big Savings</h5>
											<p>Thanks to our strong partnerships with top hotels, transport providers, and activity operators, we offer exclusive contracted rates that significantly lower the cost of our tour packages. Quality travel at affordable prices—that's our promise to you!</p>
										</div>
									</div>
									<div class="dbook_with_us_sub_cont">
										<div class="dbook_with_us_icon_box earth-globe-icon">
											<!-- <i class="fa fa-bars"></i> -->
											
										</div>
										<div>
											<h5>Tailored & Diverse Itineraries</h5>
											<p>From relaxing getaways to adventurous explorations, our travel experts craft a wide range of meticulously planned itineraries to suit every type of traveler. With us, every trip is designed to deliver a memorable experience.<br><br>
											Let us turn your dream vacation into reality!</p>
										</div>
									</div>
								</div>
							</div>

							<!--Subscription Box-->
							<div class="dSubscribeCont">
								<div>
									<label for="emailsubscription">Subscribe</label>
									<input type="email" id="emailsubscription" placeholder="Type email id for xclusive deals & offers" />
								</div>
								<div class="text-center">
									<button type="button" class="btnSubscribe">Subscribe</button>
								</div>
							</div>
						</div>
						<!--Desktop Tour Price Side Bar Starts-->