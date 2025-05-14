			<!--Desktop Tour Enquiry Starts-->
			<!-- Modal -->
			<div id="enquiryModal_desktop" class="modal">
				<!-- Modal content-->
				<div class="enq_modalContent enq_modalContent_size">
					<div class="enq_modalHeader flexBetween">
						<!--<h4 class="ModalTitle">Send your Enquiry & Get the Holiday planned by our experts<?php echo e($details->title); ?></h4>-->
						<div>
							<h3><?php echo e($details->title); ?></h3>
							<h4><?php echo e($details->duration); ?> Nights / <?php echo e($details->duration + 1); ?> Days</h4>
						</div>
						<button type="button" class="btnMain btnCloseModal_desktop">Close &#10006;</button>
					</div>
					<!--Modal body-->
					<div class="enq_modalBody">
						<!-- <form  method="Post" action="<?php echo e(url('save_otp_Query')); ?>"> -->
						<form action="#" method="Post" id="enquiry_form" name="enquiry_form">
							<?php echo e(csrf_field()); ?>

							<!--<div class="alert alert-success" id="success-contaier" style="display: none">
							   <p>Thank You! Enquiry has been submitted, our experts will contact you shortly</p>
							</div>-->
							<input type="hidden" name="packageId" value="<?php echo e($details->id); ?>" />
							<input type="hidden" name="package_name" value="<?php echo e($details->title); ?>" />

							<!--Enq Fields-->
							<div class="makeflex justifycontentBetween scrollX">
								<div class="enq_leftSection">
									<!--Service & Channel Type-->
									<div class="row">
										<div class="d-none">
											<div class="col-md-6">
												<div class="form-group">
													<label for="service_type" class="formLabel selectArrow">Service Type</label>
													<select class="formSelect" id="service_type" name="service_type">
														<option value="Tour Package" selected>Tour Package</option>
														<option value="Accommodation">Accommodation</option>
														<option value="Flight">Flight</option>
														<option value="Visa">Visa</option>
														<option value="Meals">Meals</option>
														<option value="Forex">Forex</option>
														<option value="Cruise">Cruise</option>
														<option value="Transfers">Transfers</option>
														<option value="Activity">Activity</option>
														<option value="Travel Insurance">Travel Insurance</option>
														<option value="Miscellaneous">Miscellaneous</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="channel_type" class="formLabel selectArrow">Channel Type</label>
													<select class="formSelect" id="channel_type" name="channel_type">
														<option value="B2C" selected>B2C</option>
														<option value="B2B">B2B</option>
														<option value="Corporate">Corporate</option>
													</select>
												</div>
											</div>
										</div>

										<!--Name & Email Id-->									
										<div class="col-md-6">
											<div class="form-group">
												<label for="name" class="formLabel">Full Name</label>
												<input class="formInput" type="text"  value="" name="name" id="name" placeholder="Enter Your Full Name" />
												<span class="error" id="name_error"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="email" class="formLabel">Email ID</label>
												<input class="formInput" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" />
												<span class="error" id="email_error"></span>
											</div>
										</div>

										<div class="col-md-12"></div>
									
										<!--Mobile & Best Time to Call-->									
										<div class="col-md-6">
											<div class="form-group">
												<div class="row">
													<div class="col-md-4">
														<label for="country_code" class="formLabel selectArrow">Country Code</label>
														<select class="formSelect" value="" id="country_code" name="country_code"></select>
														<span class="error" id="country_code_error"></span>
													</div>
													<div class="col-md-8" style="padding-left: 0;">
														<label for="mobile" class="formLabel">Mobile No</label>
														<input class="formInput" type="text" value="" name="mobile" id="mobile" minlength="10" maxlength="10" placeholder="Enter Your Mobile No" />
														<span class="error" id="mobile_error"></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="time_call" class="formLabel selectArrow">Connect Time</label>
												<select class="formSelect" id="time_call" name="time_call">
													<option value="0">Select Time To Call</option>
													<option value="09 - 11 AM">Between 09 - 11 AM</option>
													<option value="11 - 01 PM">Between 11 - 01 PM</option>
													<option value="01 - 03 PM">Between 01 - 03 PM</option>
													<option value="03 - 05 PM">Between 03 - 05 PM</option>
													<option value="05 - 07 PM">Between 05 - 07 PM</option>
													<option value="07 - 09 PM">Between 07 - 09 PM</option>
												</select>
												<span class="error" id="time_call_error"></span>
											</div>
										</div>

										<div class="col-md-12"></div>
									
										<!--Select Residence/Departure City & Nationality-->									
										<div class="col-md-6">
											<div class="form-group">
												<label for="city_of_residence" class="formLabel">Departure City</label>
												<input class="formInput" type="text" name="city_of_residence" id="city_of_residence" placeholder="Enter Departure City" />
												<span class="error" id="city_of_residence_error"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="country_of_residence" class="formLabel selectArrow">Nationality</label>
												<select class="formSelect" id="country_of_residence" name="country_of_residence"></select>
												<span class="error" id="country_of_residence_error"></span>
											</div>
										</div>

										<div class="col-md-12"></div>

										<!--Arrival Date & Expected budget -->									
										<div class="col-md-6">
											<div class="form-group">
												<label for="travel_date_modal_desktop_enquiry" class="formLabel selectArrow">Travel Date</label>
												<input type="text" class="formInput date_arrival_destop" name="date_arrival" id="travel_date_modal_desktop_enquiry" placeholder="Select Your Travel Date" readonly="readonly" />
												<span class="error" id="date_arrival_error"></span>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="exp_budget" class="formLabel selectArrow">Budget&nbsp;<span class="font12 fontItalic">per person</span></label>
												<div class="relativeCont appendBottom20">

										            <div class="budgetBox icon-input-group" tabindex="0">
										            	<div class="icon-input-group-addon">
															<span class="rupee-container" aria-hidden="true"></span>
														</div>
														<!-- <div class="defaultCurrency fmCurrencyBox"></div> -->
														<input class="formInput_budget" type="text" id="exp_budget" name="exp_budget" placeholder="Select your budget" style="border: none;" readonly 
														<?php if($details->onrequest == 1): ?>
														<?php else: ?>
															<?php if(CustomHelpers::get_price($details->id)=="On Request"): ?>
															<?php else: ?>
																value="Rs <?php echo e(CustomHelpers::get_price($details->id)); ?>"
															<?php endif; ?>
														<?php endif; ?> />
													</div>
													<div class="budgetPriceBarBox" id="budgetSliderContainer" style="display: none;">
											            <input type="range" min="3000" max="300000" value="3000" class="budgetSlider" id="budgetSlider">
											            <div class="rangeSection">
						                					<span class="min-price-label defaulCurrency_slider">&nbsp;3,000</span>
						                					<span class="max-price-label defaulCurrency_slider">&nbsp;300,000</span>
											            </div>
											        </div>
												</div>
											</div>
										</div>

										<div class="col-md-12"></div>									

										<!--Your Destination & Duration (Hidden)-->
										<div class="d-none">
											<div class="col-md-6">
												<div class="form-group">
													<label for="destinations" class="formLabel">Destination</label>
													<input class="formInput" type="text" value="<?php echo e($details->title); ?>" id="destinations" name="destinations" placeholder="Enter Your Destination" style="background: #f2f2f2;" readonly />
													<span class="error" id="destinations_error"></span>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="duration" class="formLabel">Duration</label>
													<input class="formInput" type="text" value="<?php echo e($details->duration + 1); ?> Days" name="duration" id="duration" placeholder="Enter Duration" style="background: #f2f2f2;" readonly />
												</div>
											</div>
										</div>

										<!-- --------- -->

										<!-- Flight Booking Preference -->
										<div class="col-md-12">
											<div class="guestInputCont makeflex align-center">
												<label for="flightbookingpreference">Have you booked the flight tickets?</label>
												<div class="flightPref apndLft20">
													<label class="preference-selection" tabindex="0">
														<input type="radio" value="0" name="flight_booking" tabindex="0">Yes
													</label>
													<label class="preference-selection" tabindex="0">
														<input type="radio" value="1" name="flight_booking" tabindex="0">No
													</label>
												</div>
											</div>
										</div>									

										<!-- --------- -->

										<!--Preferred Category-->
										<div class="col-md-12">
											<div class="guestInputCont makeflex align-center">
												<label for="hotelpreference">Hotel Preference</label>
												<div class="hotelPref apndLft20">
													<label class="hotel-selection" tabindex="0">
														<input type="radio" value="3" name="hotel_pre" tabindex="0">3 Star
													</label>
													<label class="hotel-selection selected-item" tabindex="0">
														<input type="radio" value="4" name="hotel_pre" tabindex="0">4 Star
													</label>
													<label class="hotel-selection" tabindex="0">
														<input type="radio" value="5" name="hotel_pre" tabindex="0">5 Star
													</label>
												</div>
												<span class="error" id="hotelpreference_error"></span>
											</div>
										</div>

										<!--No of Traveller-->
										<div class="col-md-12 guestCont">
											<div class="travellerLabelBox">
												<label for="travellers" class="formLabel">No of Travellers</label>
											</div>
											<div class="mobscroll scrollX" style="overflow: auto;">
												<div class="makeflex">
													<div class="flex-column appendRight20">
														<input type="hidden" id="travellers" name="span_value_adult" class="span_value_adult1" value="2" />
														<div class="flexCenter">
															<span class="guestMinus span_des_adult">&#8722;</span>
															<span class="guestValue span_value_adult">2</span>
															<span class="guestPlus span_inc_adult">&#43;</span>
														</div>
														<div class="guestType">Adult<div>(+12yrs)</div></div>
													</div>
													<div class="flex-column appendRight20">
														<input type="hidden" id="travellers" name="span_value_child" class="span_value_child1" value="0" />
														<div class="flexCenter">
															<span class="guestMinus span_des_child">&#8722;</span>
															<span class="guestValue span_value_child">0</span>
															<span class="guestPlus span_inc_child">&#43;</span>
														</div>
														<div class="guestType">Child with bed<div>(2-12yrs)</div></div>
													</div>
													<div class="flex-column appendRight20">
														<input type="hidden" id="travellers" name="span_value_child_without_bed" class="span_value_child1_without_bed" value="0" />
														<div class="flexCenter">
															<span class="guestMinus span_des_child_without_bed">&#8722;</span>
															<span class="guestValue span_value_child_without_bed">0</span>
															<span class="guestPlus span_inc_child_without_bed">&#43;</span>
														</div>
														<div class="guestType">Child without bed<div>(2-12yrs)</div></div>
													</div>
													<div class="flex-column">
														<input type="hidden" id="travellers" name="span_value_infant" class="span_value_infant1" value="0" />
														<div class="flexCenter">
															<span class="guestMinus span_des_infant">&#8722;</span>
															<span class="guestValue span_value_infant">0</span>
															<span class="guestPlus span_inc_infant">&#43;</span>
														</div>
														<div class="guestType">Infant<div>(0-2yrs)</div></div>
													</div>
												</div>
											</div>
										</div>

										<!--Remarks-->
										<div class="col-md-12">
											<div class="guestInputCont appendTop5 appendBtm20">
												<label for="additionaldetails">Additional Request&nbsp;<span class="colorA1 d-none">(subject to availability)</span></label>
												<div id="tourAdtnlDtls">
													<div class="addOnDtlsCont">
														<label class="checkmarkCont">
															<input type="checkbox" class="additional_details" value="Family Tour">
															<span class="checkmark addOn-services"></span>
															<span class="addOn-services-text">Family Tour</span>
														</label>
														<label class="checkmarkCont">
															<input type="checkbox" class="additional_details" value="Leisure Tour">
															<span class="checkmark addOn-services"></span>
															<span class="addOn-services-text">Leisure Tour</span>
														</label>
														<label class="checkmarkCont">
															<input type="checkbox" class="additional_details" value="Honeymoon Tour">
															<span class="checkmark addOn-services"></span>
															<span class="addOn-services-text">Honeymoon Tour</span>
														</label>
														<label class="checkmarkCont">
															<input type="checkbox" class="additional_details" value="Business Tour">
															<span class="checkmark addOn-services"></span>
															<span class="addOn-services-text">Business Tour</span>
														</label>
													</div>
												</div>
												<textarea class="formTextarea" type="text" id="additionaldetails" name="message" placeholder="Enter additional requests (if any)"></textarea>
											</div>
										</div>

										<!--Accept Privacy Policy-->
										<div class="col-md-12">
											<div class="dAcceptTerms">
												<label class="checkmarkCont wrapper">
													<input type="checkbox" value="0" id="accept_value" name="accept_value" />
													<span class="checkmark signup-acceptance"></span>
													<?php 
														$websiteData = getWebsiteData();
													 ?>
													<h5>I here by accept the 
														<a href="<?php echo e(route('privacyPolicy')); ?>" target="_blank" class="link-color">
															<b>Privacy Policy</b>
														</a> 
														and authorize <?php echo e(getWebsiteData('name')); ?> team to contact me.
													</h5>
												</label>
											</div>
											<div>
												<span class="error" id="accept_value_error"></span>
											</div>
											<!-- <div class="dAcceptTerms">
												<input type="checkbox" value="0" id="accept_value" name="accept_value" />
												<?php 
													$websiteData = getWebsiteData();
												 ?>
												<h5>I here by accept the 
													<a href="<?php echo e(route('privacyPolicy')); ?>" target="_blank" class="link-color">
														<b>Privacy Policy</b>
													</a> 
													and authorize <?php echo e(getWebsiteData('name')); ?> team to contact me.
												</h5>
											</div>
											<span class="error" id="accept_value_error"></span> -->
										</div>
									</div>
								</div>

								<!--Sidebar Tour Image-->
								<div class="enq_rightSection">
									<div class="enq_tourImgBox">
										<?php if(count($images)>0): ?>
											<?php 
												$img_data=$images->first()->image_path;
											 ?>
										<?php else: ?>
											<?php 
												$img_data="/uploads/default_profile_image.png";
											 ?>
										<?php endif; ?>
										<?php $gallery_id=CustomHelpers::get_first_galleryid($id); ?>
										<?php if(CustomHelpers::get_imgpath_gallery($gallery_id,'image_path')!="0"): ?>
											<img src="<?php echo e(route('home').'/public/'.CustomHelpers::get_imgpath_gallery($gallery_id,'image_path')); ?>">
										<?php elseif(CustomHelpers::get_imgpath_gallery($gallery_id,'image_path')=="0"): ?>
											<img src="<?php echo e(route('home').'/public/uploads/default_profile_image.png'); ?>">
										<?php endif; ?>
										<div class="enq_tourTitle">
											<h5><?php echo e($details->title); ?></h5>
										</div>
									</div>
								</div>
								
							</div>
						</div>

						<div class="enq_modalFooter">
							<input type="submit" class="btnMain btnSubmitEnq" name="submit" value="Get a Callback" />
						</div>
						</form>
				</div>
			</div>
			<!--Desktop Tour Enquiry Ends-->