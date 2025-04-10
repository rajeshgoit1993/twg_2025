<style type="text/css">
.item-container {
	box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
	border: 1px solid #e9e9e9;
	border-radius: 10px;
	padding: 30px;
	margin-bottom: 20px;
	display: -webkit-box;
	display: inline-block;
	width: 100%;
}

</style>
		<div class="quoteDtlsCont">

			<!-- left section -->
			<div class="left-section">
			<form action="<?php echo e(URL::to('/option1')); ?>" method="post" id="quo1" name="quo1">
				<input type="hidden" name="type" value=""/>
				<input type="hidden" name="query_id" value="<?php echo e($data->id); ?>"/>
				<?php echo e(csrf_field()); ?>


				<!--Enquiry Details-->
				<!-- <div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details <span class="requiredcolor">*</span>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							include('query.enquiryDetails.quoteLeadDetails')							
						</div>
					</div>
				</div> -->

				<!--Trip Details-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trip Details <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-3 apndBtm10">
									<label for="custom_package_name">Trip Name <span class="requiredcolor">*</span></label>
									<input type="text" class="form-control textCapitalize" name="custom_package_name" id="custom_package_name" placeholder="Enter Package Name" value="<?php if(is_numeric($data->packageId)): ?> <?php echo e(CustomHelpers::get_package_name($data->packageId)); ?> <?php endif; ?>" />
								</div>

								<div class="col-md-3 apndBtm10">
									<label for="sourcecity">Starting City <span class="requiredcolor">*</span></label>
									<select class="quote_city form-control" name="sourcecity" id="sourcecity" required></select>
								</div>

								<!-- tour type -->
                                 <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="tour_type" class="field-required">Tour Type</label>
                                      <select class="form-control" name="tour_type" id="tour_type">
                                        <option selected disabled>Select tour type</option>
                                        <!-- populate from db -->
                                      </select>
                                    </div>
                                </div>

								<div class="col-md-3 apndBtm10">
									<label for="tour_date">Travel Date</label>
									<input type="date" name="tour_date" id="tour_date" class="form-control tour_date" value="<?php echo e($data->date_arrival); ?>" placeholder="Tour Date" />
								</div>

								<div class="col-md-12 apndBtm10">
									<label for="package_service">Services Included</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
										<select name="package_service[]" id="package_service" class="form-control select2 package_service" multiple>
											<?php if(count($icons)>0): ?>
											<?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($icon->icon_title); ?>"><?php echo e($icon->icon_title); ?> </option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											<?php else: ?>
												<option value="No Service">No Service</option>
											<?php endif; ?>
										</select>
									</div>
								</div>

								<!-- duration city wise -->
								<div class="col-md-12">
									<label>Duration</label>
									<div class="item-container flex-column">

										<!-- city wise duration -->
	                                	<div class="row">

	                                    	<!-- continent -->
	                                      	<div class="col-md-2 apndBtm10">
	                                      		<label for="continent">Continent</label>
	                                      		<select name="continent[0]" id="continent" class="form-control">
	                                      			<option value="Asia">Asia</option>
		                                            <option value="Africa">Africa</option>
		                                            <option value="Antarctica">Antarctica</option>
		                                            <option value="Australia">Australia</option>
		                                            <option value="Europe">Europe</option>
		                                            <option value="North America">North America</option>
		                                            <option value="South America">South America</option>
		                                        </select>
	                                      	</div>

	                                      	<!-- country -->
	                                      	<div class="col-md-2 apndBtm10">
	                                      		<label for="package_dest_countries" class="field-required">Country</label>
	                                      		<select class="form-control package_dest_country" name="country[0]" id="package_dest_countries" onchange="changeCountry(this)">
	                                      			<option value='0'>Select Country</option>
	                                      		</select>
	                                      	</div>

	                                      	<!-- state -->
	                                      	<div class="col-md-2 apndBtm10">
	                                      		<label for="package_dest_state" class="field-required">State</label>
	                                      		<select name="state[0]" id="package_dest_state" class="form-control package_dest_countries" onchange="changeSate(this)">
	                                      		</select>
	                                      	</div>

	                                      	<!-- city -->
	                                      	<div class="col-md-3 apndBtm10">
	                                      		<label for="package_dest_city" class="field-required">City</label>
	                                      		<select name="city[0]" id="package_dest_city" class="package_dest_cities form-control package_dest_state city_package_dest_countries min-select" onchange="cityFunction(this)"></select>
	                                      	</div>

	                                      	<!-- duration city wise -->
	                                      	<div class="col-md-3 apndBtm10">
	                                      		<label for="package_dest_days" class="field-required">Duration</label>
	                                      		<select name="days[0]" id="package_dest_days" class="form-control package_dest_days "></select>
	                                      	</div>
	                                	</div>
	                           		</div>
                            	</div>

                                <!-- add more city -->
                                <div class="col-md-12 apndBtm10">
                                	<button type="button" name="add-continent" id="add-continent-row" class="btn btn-success"><span class="fa fa-plus"></span> Add more city</button>
                                </div>
                            
                            	<hr>

                            	<!-- trip remarks -->
                                <div class="col-md-12 apndTop10 apndBtm10">
									<label for="admin_remarks">Trip Remarks</label>
									<input type="text" class="form-control" name="admin_remarks" id="admin_remarks" placeholder="Enter Remarks (if any)..." />
								</div>

							</div>
						</div>
					</div>
				</div>

				<!--Trip Guest Room-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-user-o" aria-hidden="true"></i> Guest Room <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
					    <div class="panelContent">
					        
					        <!-- Room selection section -->
					        <div class="roomGuests">
					            <label for="roomnumber"><b>No of Rooms</b> <span class="requiredcolor">*</span></label>
					            <select class="form-control select_room" name="no_of_room">
					                <?php for($i = 1; $i <= 10; $i++): ?>
					                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
					                <?php endfor; ?>
					            </select>
					            
					            <!-- Default room description input (readonly) -->
					            <input type="text" class="quote1_pop_passenger_value" 
					                   value="1 Room (2 Adults)" 
					                   placeholder="" 
					                   readonly />
					        </div>
					        
					        <!-- Dynamic room and guest section -->
					        <div class="dynamic_four" id="dynamic_four">
					            <div id="fourrow1">
					                
					                <!-- Room 1 configuration -->
					                <div class="room-container">
					                    <div class="label textUppercase">Room 1</div>
					                    <br>
					                    
					                    <!-- Maximum guests allowed dropdown -->
					                    <div class="makeflex align-center">
					                        <div class="label">Maximum guest allowed <span class="requiredcolor">*</span></div>
					                        <select class="form-control max_passenger" 
					                                name="room[0][max_passenger]" 
					                                style="max-width: 90px; border-radius: 3px;">
					                            <?php for($i = 1; $i <= 10; $i++): ?>
					                                <option value="<?php echo e($i); ?>" <?php if($i == 7): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
					                            <?php endfor; ?>
					                        </select>
					                    </div>
					                    
					                    <!-- Guests selection for Room 1 -->
					                    <div class="guest-room-wrapper mobScroll scrollX">
					                        
					                        <!-- Adult (Twin Sharing +12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][twin_adult_room]" 
					                                       class="twin_adult_room_value" 
					                                       value="2" />
					                                <span class="travellersMinus twin_adult_room_dec">&#8722;</span>
					                                <span class="travellersValue twin_adult_room_result">2</span>
					                                <span class="travellersPlus twin_adult_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Adult<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Extra Adult (+12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][extra_adult_room]" 
					                                       class="extra_adult_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus extra_adult_room_dec">&#8722;</span>
					                                <span class="travellersValue extra_adult_room_result">0</span>
					                                <span class="travellersPlus extra_adult_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Child (With Bed 2-12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][child_with_bed_room]" 
					                                       class="child_with_bed_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus child_with_bed_room_dec">&#8722;</span>
					                                <span class="travellersValue child_with_bed_room_result">0</span>
					                                <span class="travellersPlus child_with_bed_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
					                        </div>
					                        
					                        <!-- Child (without bed 2-12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][child_without_bed_room]" 
					                                       class="child_without_bed_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus child_without_bed_room_dec">&#8722;</span>
					                                <span class="travellersValue child_without_bed_room_result">0</span>
					                                <span class="travellersPlus child_without_bed_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
					                        </div>
					                        
					                        <!-- Infant (0-2yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][infant_room]" 
					                                       class="span_value_child_with_bed infant_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus infant_room_dec">&#8722;</span>
					                                <span class="travellersValue infant_room_result">0</span>
					                                <span class="travellersPlus infant_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
					                        </div>
					                        
					                        <!-- Single (+12yrs) -->
					                        <div>
					                            <div class="addTravellerValue">
					                                <input type="hidden" 
					                                       name="room[0][single_room]" 
					                                       class="single_room_value" 
					                                       value="0" />
					                                <span class="travellersMinus single_room_dec">&#8722;</span>
					                                <span class="travellersValue single_room_result">0</span>
					                                <span class="travellersPlus single_room_inc">&#43;</span>
					                            </div>
					                            <p class="itemBottomHeading">Single<br>(+12yrs)</p>
					                        </div>
					                        
					                        <!-- Add more rooms button -->
					                        <div class="text-center">
					                            <button type="button" id="add_certification" class="btn btn-info">
					                                <span class="fa fa-plus"></span> Add more rooms
					                            </button>
					                        </div>
					                    </div> <!-- guest-room-wrapper end -->
					                </div> <!-- room-wrapper end -->
					                
					            </div> <!-- fourrow1 end -->
					        </div> <!-- dynamic_four end -->
					        
					    </div> <!-- panelContent end -->
					</div> <!-- panelBox end -->
				</div>

				<!--Trip Pricing-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-money" aria-hidden="true"></i> Trip Pricing <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox mobScroll scrollX">
						<div class="panelContent">

							<!-- Price type selection section -->
					        <div class="roomGuests">
					            <label><b>Price Type</b> <span class="requiredcolor">*</span></label>

					            <select class="form-control bgF2 flexOne price_type" name="price_type">
					            	<!-- <option value="Per Person">Per Person</option>
					            	<option value="Group Price">Group Price</option> -->
					                <option value="1">Per Person</option>
					                <option value="2">Group Price</option>
					            </select>

					            <select class="form-control flexOne" name="priceremarks">
					            	<!-- <option value="Price Per Person (inclusive of taxes)">Price Per Person (inclusive of taxes)</option>
					            	<option value="Price for all Person (inclusive of taxes)">Price for all Person (inclusive of taxes)</option> -->
					            	<option value="1">Price Per Person (inclusive of taxes)</option>
					            	<option value="2">Price for all Person (inclusive of taxes)</option>
					            </select>
					            
					            <input type="text" class="form-control flexOne" name="remarks" placeholder="Price Remarks (if any) ..." />

					            <!-- Default room description input (readonly) -->
					            <input type="text" class="quote1_pop_passenger_value flexOne" 
					                   value="1 Room (2 Adults,0 Child,0 Infant)" 
					                   placeholder="1 Room (2 Adults,0 Child,0 Infant)" 
					                   readonly />
					        </div>

							<table class="table backend_custom_height">
								<thead>
									<th>
										<p class="quoteCurrency">INR</p>
										<p class="itemBottomHeading">Quote Currency</p>
									</th>
									<th>
										<p class="itemTopHeading">CALCULATOR</p>
										<div class="currencyConversion">
											<select class="query_air_curr" name="currency">
												<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($rate-> id); ?>" c_val="<?php echo e($rate->rate); ?>"><?php echo e($rate-> currency); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="text" name="roe" class="quote1_rate number_test" placeholder="ROE">
										</div>
										<div class="currencyConversion">
											<input type="text" name="indian_rate" class="quote1_value number_test" placeholder="Enter">
											<input type="text" name="total_value" class="bgF2 quote1_total number_test" placeholder="Value" readonly />
										</div>
										<p class="itemBottomHeading">Conversion</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">ADULT</p>
										<p class="itemTopSubHeading">(TWIN SHARING)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="quote1_number_of_adult" class="quote1_number_of_adult quote1_adult_room_value" value="2" />
											<!-- <span class="travellersMinus quote1_adult_room_dec">&#8722;</span> -->
											<span class="travellersValue quote1_adult_room_result">2</span>
											<!-- <span class="travellersPlus quote1_adult_room_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">EXTRA ADULT</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="extra_adult" class="quote1_number_of_extra_adult quote1_child_extra_adult_value" value="0" />
											<!-- <span class="travellersMinus quote1_child_extra_adult_dec">&#8722;</span> -->
											<span class="travellersValue quote1_child_extra_adult_result">0</span>
											<!-- <span class="travellersPlus quote1_child_extra_adult_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">CHILD</p>
										<p class="itemTopSubHeading">(WITH BED)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="child_with_bed" class="quote1_number_of_child_with_bed quote1_child_with_bed_value" value="0" />
											<!-- <span class="travellersMinus quote1_child_with_bed_dec">&#8722;</span> -->
											<span class="travellersValue quote1_child_with_bed_result">0</span>
											<!-- <span class="travellersPlus quote1_child_with_bed_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">CHILD</p>
										<p class="itemTopSubHeading">(WITHOUT BED)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="child_without_bed" class="quote1_number_of_child_without_bed quote1_childwithoutbed_value" value="0" />
											<!-- <span class="travellersMinus quote1_childwithoutbed_dec">&#8722;</span> -->
											<span class="travellersValue quote1_span_value_childwithoutbed_result">0</span>
											<!-- <span class="travellersPlus quote1_childwithoutbed_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">INFANT</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="infant" class="quote1_number_of_infant quote1_infant_value" value="0" />
											<!-- <span class="travellersMinus quote1_infant_dec">&#8722;</span> -->
											<span class="travellersValue quote1_infant_result">0</span>
											<!-- <span class="travellersPlus quote1_infant_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">SINGLE<br>TRAVELLER</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="solo_traveller" class="quote1_number_solo_traveller quote1_solo_value" value="0" />
											<!-- <span class="travellersMinus quote1_solo_dec">&#8722;</span> -->
											<span class="travellersValue quote1_solo_result">0</span>
											<!-- <span class="travellersPlus quote1_solo_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Single<br>(+12yrs)</p>
									</th>
								</thead>
								<tbody>
									<!-- Airfare -->
									<tr>
										<td>Airfare</td>
										<td class="makeflex">
											<select class="form-control supplier" name="price[quote_airfare]" id="airfare">
												<option value="0" select_name="0" >Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[quote_airfare_remarks]" id="remarks_airfare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_air_adult adult_disable" name="price[query_air_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_air_exadult exadult_disable" name="price[query_air_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_air_childbed childbed_disable" name="price[query_air_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_air_childwbed childwbed_disable" name="price[query_air_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_air_infant infant_disable" name="price[query_air_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_air_single single_disable" name="price[query_air_single]"></td>
									</tr>

									<!--Cruise Fare-->
									<tr>
										<td>Cruise Fare</td>
										<td class="makeflex">
											<select class="form-control supplier" name="price[quote_cruise_fare]" id="cruise_fare">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden"  name="price[quote_cruise_fare_remarks]"  id="remarks_cruise_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruise_adult adult_disable" name="price[query_cruise_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]"></td>
									</tr>

									<!-- Cruise Port Charges -->
									<tr>
										<td>Port Charges </td>
										<td class="makeflex">
											<select class="form-control supplier" id="port_charge_fare" name="price[port_charge_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_adult adult_disable" name="price[query_cruiseport_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_exadult exadult_disable" name="price[query_cruiseport_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_childbed childbed_disable" name="price[query_cruiseport_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_childwbed childwbed_disable" name="price[query_cruiseport_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_infant infant_disable" name="price[query_cruiseport_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_single single_disable" name="price[query_cruiseport_single]"></td>
									</tr>

									<!-- Cruise Gratuity -->
									<tr>
										<td>Gratuity</td>
										<td class="makeflex">
											<select class="form-control supplier" id="gratuity_fare" name="price[gratuity_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[gratuity_remarks]" id="remarks_gratuity_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_adult adult_disable" name="price[query_cruisegratuity_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_exadult exadult_disable" name="price[query_cruisegratuity_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_childbed childbed_disable" name="price[query_cruisegratuity_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_childwbed childwbed_disable" name="price[query_cruisegratuity_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_infant infant_disable" name="price[query_cruisegratuity_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_single single_disable" name="price[query_cruisegratuity_single]"></td>
									</tr>

									<!-- Cruise GST -->
									<tr>
										<td>Cruise GST </td>
										<td class="makeflex">
											<select class="form-control supplier" id="cruise_gst_fare" name="price[cruise_gst_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_adult adult_disable" name="price[query_cruisegst_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_exadult exadult_disable" name="price[query_cruisegst_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_childbed childbed_disable" name="price[query_cruisegst_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_childwbed childwbed_disable" name="price[query_cruisegst_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_infant infant_disable" name="price[query_cruisegst_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_single single_disable" name="price[query_cruisegst_single]"></td>
									</tr>

									<!--Accommodation-->
									<tr>
										<td>Accommodation</td>
										<td class="makeflex">
											<select class="form-control supplier" id="accommodation_fare" name="price[accommodation_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_hotel_adult adult_disable" name="price[query_hotel_adult]" id=""></td>
										<td><input type="text" class="form-control number_test quote1_hotel_exadult exadult_disable" name="price[query_hotel_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_childbed childbed_disable" name="price[query_hotel_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_childwbed childwbed_disable" name="price[query_hotel_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_infant infant_disable" name="price[query_hotel_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_single single_disable" name="price[query_hotel_single]"></td>
									</tr>

									<!-- Sightseeing -->
									<tr>
										<td>Sightseeing</td>
										<td class="makeflex">
											<select class="form-control supplier" id="sightseeing_fare" name="price[sightseeing_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_tours_adult adult_disable" name="price[query_tours_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_tours_exadult exadult_disable" name="price[query_tours_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_tours_childbed childbed_disable" name="price[query_tours_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_tours_childwbed childwbed_disable" name="price[query_tours_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_tours_infant infant_disable" name="price[query_tours_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_tours_single single_disable" name="price[query_tours_single]"></td>
									</tr>

									<!-- Transfers -->
									<tr>
										<td>Transfers</td>
										<td class="makeflex">
											<select class="form-control supplier" id="transfers_fare" name="price[transfers_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[transfers_fare_remarks]" id="remarks_transfers_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_transfer_adult adult_disable" name="price[query_transfer_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_exadult exadult_disable" name="price[query_transfer_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_childbed childbed_disable" name="price[query_transfer_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_childwbed childwbed_disable" name="price[query_transfer_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_infant infant_disable" name="price[query_transfer_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_single single_disable" name="price[query_transfer_single]"></td>
									</tr>

									<!-- Visa Charges -->
									<tr>
										<td>Visa Charges</td>
										<td class="makeflex">
											<select class="form-control supplier" id="visa_charges_fare" name="price[visa_charges_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_visa_adult adult_disable" name="price[query_visa_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_visa_exadult exadult_disable" name="price[query_visa_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_visa_childbed childbed_disable" name="price[query_visa_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_visa_childwbed childwbed_disable" name="price[query_visa_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_visa_infant infant_disable" name="price[query_visa_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_visa_single single_disable" name="price[query_visa_single]"></td>
									</tr>

									<!-- Travel Insurance -->
									<tr>
										<td> Travel Insurance</td>
										<td class="makeflex">
											<select class="form-control supplier" id="travel_insurance_fare" name="price[travel_insurance_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_inc_adult adult_disable" name="price[query_inc_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_inc_exadult exadult_disable" name="price[query_inc_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_inc_childbed childbed_disable" name="price[query_inc_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_inc_childwbed childwbed_disable" name="price[query_inc_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_inc_infant infant_disable" name="price[query_inc_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_inc_single single_disable" name="price[query_inc_single]"></td>
									</tr>

									<!--Meals-->
									<tr>
										<td>Meals</td>
										<td class="makeflex">
											<select class="form-control supplier" id="meals_fare" name="price[meals_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										<input type="hidden" name="price[meals_fare_remarks]" id="remarks_meals_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_meals_adult adult_disable" name="price[query_meals_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_meals_exadult exadult_disable" name="price[query_meals_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_meals_childbed childbed_disable" name="price[query_meals_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_meals_childwbed childwbed_disable" name="price[query_meals_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_meals_infant infant_disable" name="price[query_meals_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_meals_single single_disable" name="price[query_meals_single]"></td>
									</tr>

									<!--Addon Service-->
									<tr>
										<td>Addon Service</td>
										<td class="makeflex">
											<select class="form-control supplier" id="addon_service_fare" name="price[addon_service_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>"><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										<input type="hidden" name="price[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="">
										</td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_adult adult_disable" name="price[query_additionalservice_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_exadult exadult_disable" name="price[query_additionalservice_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_childbed childbed_disable" name="price[query_additionalservice_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_childwbed childwbed_disable" name="price[query_additionalservice_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_infant infant_disable" name="price[query_additionalservice_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_single single_disable" name="price[query_additionalservice_single]"></td>
									</tr>

									<!--Total before Markup-->
									<tr class="totalDisplay">
										<td>Total</td>
										<td>
										<!--<p class="currencyBox">INR</p>-->
										</td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_adult" name="price[query_tourtotal_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_exadult" name="price[query_tourtotal_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_childbed" name="price[query_tourtotal_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_childwbed" name="price[query_tourtotal_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_infant" name="price[query_tourtotal_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_single" name="price[query_tourtotal_single]" readonly /></td>
									</tr>

									<!--Markup-->
									<tr>
										<td class="fontItalic">Markup (Profit)</td>
										<td class="makeflex">
											<select class="fixedValue pricemarkup" name="price[pricemarkup]">
												<option value="0" disabled>Select</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<select class="percentageValue number_test markup_percentage" name="price[markup_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $markup_profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($markup_pro->value); ?>"><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_markup_adult adult_disable" name="price[query_markup_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_markup_exadult exadult_disable" name="price[query_markup_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_markup_childbed childbed_disable" name="price[query_markup_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_markup_childwbed childwbed_disable" name="price[query_markup_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_markup_infant infant_disable" name="price[query_markup_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_markup_single single_disable" name="price[query_markup_single]"></td>
									</tr>

									<!--Discount Plus-->
									<tr>
										<td>Discount (+)</td>
										<td class="makeflex">
											<select class="fixedValue pricediscountpositive" name="price[pricediscountpositive]">
												<option value="0">No Discount</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
												<!-- <option value="3">Coupon</option> -->
											</select>
											<select class="percentageValue number_test discountpositive_percentage" name="price[discountpositive_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $discunt_positive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($markup_pro->value); ?>"><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_discount_adult_plus adult_disable" name="price[query_discount_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_exadult_plus exadult_disable" name="price[query_discount_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childbed_plus childbed_disable" name="price[query_discount_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childwbed_plus childwbed_disable" name="price[query_discount_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_infant_plus infant_disable" name="price[query_discount_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_single_plus single_disable" name="price[query_discount_single]"></td>
									</tr>

									<!--Total before GST-->
									<tr class="grossTotalDisplay">
										<td class="tourPriceItem">Gross Total</td>
										<td>
										<!--<p class="currencyBox">INR</p>-->
										</td>
										<td><input type="text" class="form-control number_test quote1_gross_total_adult" name="price[query_total_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_exadult" name="price[query_total_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_childbed" name="price[query_total_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_childwbed" name="price[query_total_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_infant" name="price[query_total_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_single" name="price[query_total_single]" readonly /></td>
									</tr>

									<!--Total Gross Total (Group)-->
									<tr class="grossGroupTotalDisplay">
										<td class="tourPriceItem">Gross Total (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gross_total_group" name="price[query_total_group]" readonly /></td>
									</tr>

									<!--Discount Minus-->
									<tr>
										<td>Discount (-)</td>
										<td class="makeflex">
											<select class="fixedValue pricediscountnegative" name="price[pricediscountnegative]">
												<option value="0">No Discount</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
												<option value="3">Coupon</option>
											</select>
											<select class="percentageValue number_test discountnegative_percentage" name="price[discountnegative_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $discunt_negative; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($markup_pro->value); ?>"><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>

											<input type="hidden" name="price[coupon_id]" class="coupon_id" value="">
											<select class="percentageValue number_test coupon_percentage" name="price[discount_coupon]">
											<option coupon_id="0"  value="0">0</option>
											<?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option coupon_id="<?php echo e($markup_pro->id); ?>"  value="<?php echo e($markup_pro->value); ?>" ><?php echo e($markup_pro->coupon_name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>

										</td>
										<td><input type="text" class="form-control number_test quote1_discount_adult_minus adult_disable" name="price[query_discount_minus_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_exadult_minus exadult_disable" name="price[query_discount_minus_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childbed_minus childbed_disable" name="price[query_discount_minus_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childwbed_minus childwbed_disable" name="price[query_discount_minus_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_infant_minus infant_disable" name="price[query_discount_minus_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_discount_single_minus single_disable" name="price[query_discount_minus_single]"></td>
									</tr>

									<!--Total Gross Total (Group)-->
									<tr class="discountGroupTotalDisplay">
										<td class="tourPriceItem">Discount (-) (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td>
											<input type="text" class="form-control number_test quote1_discount_group" name="price[query_total_discount_group]" readonly />
										</td>
									</tr>

									<!--GST-->
									<tr>
										<td class="fontItalic">(+) GST</td>
										<td class="makeflex">
											<select class="fixedValue pricegst" name="price[query_gst_curr]">
												<option value="0">Select</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<select class="percentageValue number_test gst_percentage" name="price[gst_percentage]">
												<?php $__currentLoopData = $gst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="0">--Select--</option>
												<option value="<?php echo e($gst->value); ?>"><?php echo e($gst->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_gst_adult adult_disable" name="price[query_gst_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_gst_exadult exadult_disable" name="price[query_gst_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_gst_childbed childbed_disable" name="price[query_gst_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_gst_childwbed childwbed_disable" name="price[query_gst_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_gst_infant infant_disable" name="price[query_gst_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_gst_single single_disable" name="price[query_gst_single]"></td>
									</tr>

									<!--Total GST (Group)-->
									<tr class="gstGroupTotalDisplay">
										<td class="tourPriceItem">GST (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gst_group" name="price[query_total_gst_group]" readonly /></td>
									</tr>

									<!--Total Including GST-->
									<tr class="gstTotalDisplay">
										<td class="tourPriceItem">Total with GST</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_adult" name="price[query_gsttotal_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_exadult" name="price[query_gsttotal_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_childbed" name="price[query_gsttotal_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_childwbed" name="price[query_gsttotal_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_infant" name="price[query_gsttotal_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_single" name="price[query_gsttotal_single]" readonly /></td>
									</tr>

									<!--TCS-->
									<tr>
										<td class="fontItalic">(+) TCS</td>
										<td class="makeflex">
											<select class="fixedValue pricetcs" name="price[query_tcs_curr]">
												<option value="0">Select</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<select class="percentageValue number_test tcs_percentage" name="price[tcs_percentage]">
												<?php $__currentLoopData = $tcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="0">0</option>
												<option value="<?php echo e($tcs->value); ?>"><?php echo e($tcs->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcs_adult adult_disable" name="price[query_tcs_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_exadult exadult_disable" name="price[query_tcs_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_childbed childbed_disable" name="price[query_tcs_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_childwbed childwbed_disable" name="price[query_tcs_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_infant infant_disable" name="price[query_tcs_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_single single_disable" name="price[query_tcs_single]"></td>
									</tr>

									<!--Total TCS (Group)-->
									<tr class="tcsGroupTotalDisplay">
										<td class="tourPriceItem">TCS (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcs_group" name="price[query_total_tcs_group]" readonly /></td>
									</tr>

									<!--Total Including TCS-->
									<tr class="tcsTotalDisplay">
										<td class="tourPriceItem">Total with TCS</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_adult" name="price[query_tcstotal_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_exadult" name="price[query_tcstotal_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_childbed" name="price[query_tcstotal_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_childwbed" name="price[query_tcstotal_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_infant" name="price[query_tcstotal_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_single" name="price[query_tcstotal_single]" readonly /></td>
									</tr>

									<!--PG Charges-->
									<tr>
										<td class="fontItalic">(+) PG Charges</td>
										<td class="makeflex">
											<select class="fixedValue pricepgcharges" name="price[pg_charges]">
												<option value="0">Select</option>
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<select class="percentageValue number_test pgcharges_percentage" name="price[pgcharges_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $pg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($pg->value); ?>"><?php echo e($pg->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_adult adult_disable" name="price[query_pgcharges_adult]"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_exadult exadult_disable" name="price[query_pgcharges_exadult]"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_childbed childbed_disable" name="price[query_pgcharges_childbed]"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_childwbed childwbed_disable" name="price[query_pgcharges_childwbed]"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_infant infant_disable" name="price[query_pgcharges_infant]"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_single single_disable" name="price[query_pgcharges_single]"></td>
									</tr>

									<!--PG Charges (Group)-->
									<tr class="pgGrouptTotalDisplay">
										<td class="tourPriceItem">PG (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_pg_group" name="price[query_total_pg_group]" readonly /></td>
									</tr>

									<!--Grand Total-->
									<tr>
										<td class="tourPriceItem">GRAND TOTAL</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_grand_adult" name="price[query_grand_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_exadult" name="price[query_grand_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_childbed" name="price[query_grand_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_childwbed" name="price[query_grand_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_infant" name="price[query_grand_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_single" name="price[query_grand_single]" readonly /></td>
									</tr>

									<!--Grand Total According to number of person-->
									<tr>
										<td class="tourPriceItem">PAY Total</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_grand_adult_with_person" name="price[query_paytotal_adult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_exadult_with_person" name="price[query_paytotal_exadult]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_childbed_with_person" name="price[query_paytotal_childbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_childwbed_with_person " name="price[query_paytotal_childwbed]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_infant_with_person" name="price[query_paytotal_infant]" readonly /></td>
										<td><input type="text" class="form-control number_test quote1_grand_single_with_person" name="price[query_paytotal_single]" readonly /></td>
									</tr>

									<!--Price to Pay-->
									<tr>
										<td class="tourPriceItem">Price To PAY</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td class="pricetoPay"><input type="text" class="form-control query_pricetopay quote1_pricetopay" id="option1_mandate" name="price[query_pricetopay_adult]" readonly /></td>
									</tr>
								</tbody>
							</table>

							<!-- part payment -->
							<div class="backend_custom_height item-container">
								<div class="partPayment">
									<label for="partPayment">Part Payment?</label>
									<input type="checkbox" name="partPayment" value="1" id="show_part_payment" class="show_part_payment">
								</div>
								<!-- part payment details -->
								<table class="part_payment table backend_custom_height table-bordered table-striped">
									<thead class="thead-dark">
								        <tr>
								            <th scope="col">Payment Type</th>
								            <th scope="col">Price Type</th>
								            <th scope="col">Payable Amount</th>
								            <th scope="col">Pay Within</th>
								            <th scope="col">Payment Date</th>
								        </tr>
								    </thead>
									<tbody>

										<!--Advance Payment-->
										<tr>
											<td class="tourPriceItem">Advance Payment</td>

											<td class="makeflex">
												<select class="fixedValue advance_payment" name="part_payments[adv_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>
												<!-- <input type="text" name="part_payments[adv_percentage]" class="form-control percentageValue number_test advance_payment_percentage"> -->
												<select name="part_payments[adv_percentage]" class="form-control percentageValue number_test advance_payment_percentage">
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>

												<span id="quote1_advance_payment_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" name="part_payments[adv_amount]" class="form-control number_test quote1_advance_payment">
												<span id="quote1_advance_payment_error anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[adv_days]" class="days_data">   
												<select  class="form-control payment_days">
													<option value="" disabled>Duration</option>
		                                            <?php for($i=1;$i<=$difference;$i++): ?>
		                                         		<option value="<?php echo e($i); ?>"><?php echo e($i); ?> Days</option>
		                                            <?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[adv_date]" class="form-control payment_date datepicker_adv">
											</td>
										</tr>

										<!--1st Part Payment-->
										<tr>
											<td class="tourPriceItem">1st Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue first_part_payment" name="part_payments[first_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test first_part_percentage" name="part_payments[first_part_percentage]"> -->
												<select class="form-control number_test first_part_percentage" name="part_payments[first_part_percentage]" >
												    <option value="" disabled>0%</option>
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>
												<span id="first_part_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_first_part" name="part_payments[first_part_amount]">
												<span id="quote1_first_part_error" class="anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[first_part_days]" id="first_part_days" class="days_data" value="">  
												<select class="form-control payment_days" id="first_payment_days">
		                                            <!-- Options populated from JS -->
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[first_part_date]" class="form-control payment_date  datepicker_first_payment">
											</td>
										</tr>

										<!--2nd Part Payment-->
										<tr>
											<td class="tourPriceItem">2nd Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue second_part_payment" name="part_payments[second_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test second_part_percentage" name="part_payments[second_part_percentage]"> -->
												<select class="form-control number_test second_part_percentage" name="part_payments[second_part_percentage]" disabled>
												    <?php for ($i = 0; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_second_part" name="part_payments[second_part_amount]">
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[second_part_days]" id="second_part_days" class="days_data" value="">
												<select class="form-control payment_days" id="second_payment_days">
													<!-- populating from js code -->
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[second_part_date]" class="form-control payment_date  datepicker_second_payment" />
											</td>
										</tr>

										<!--Total Payment-->
										<tr class="">
											<td class="tourPriceItem">Total Payment</td>
											<td>
												<p class="currencyBox">INR</p>
											</td>
											<td>
												<input type="text" class="form-control query_pricetopay quote1_total_payment" name="part_payments[total_installment]" readonly oncontextmenu="return false;" /></td>
										</tr>
									</tbody>
								</table>
							</div>

							<!-- pay at hotel -->
							<div class="backend_custom_height item-container">
								<div class="directPayment">
									<label for="directPayment">Pay at Hotel (not included in above price)?</label>
									<input type="checkbox" name="directPayment" value="1" id="show_direct_part">
								</div>

								<table class="direct_part table backend_custom_height table-bordered table-striped">
									<thead class="thead-dark">
									    <tr>
									        <th>Payment Type</th>
									        <th>Price Type</th>
									        <th>Currency / Amount (all travellers)</th>
									    </tr>
									</thead>

									<tbody>
										<!--1st Direct Pay-->
										<tr>
											<td>
												<select class="form-control" name="directPayments[type]">
													<option value="0">Select</option>
													<option value="Airport Transfers">Airport Transfers</option>
													<option value="Speed Boat Transfers">Speed Boat Transfers</option>
													<option value="Sea Plane">Sea Plane</option>
													<option value="Ferry Transfers">Ferry Transfers</option>
													<option value="Green Tax">Green Tax</option>
													<option value="City Tax">City Tax</option>
													<option value="VAT">VAT</option>
													<option value="Tourism Fee">Tourism Fee</option>
													<option value="Christmas Gala Dinner">Christmas Gala Dinner</option>
													<option value="New Year Gala Dinner">New Year Gala Dinner</option>
													<option value="Tours">Tours</option>
													<option value="Transfers">Transfers</option>
													<option value="Activity">Activity</option>
												</select>
											</td>

											<td>
												<input type="text" class="form-control" name="directPayments[pricetype]" value="Fixed" readonly />
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="directPayments[currency]" value="INR" style="max-width: 50px;" readonly />
												<input type="text" class="form-control number_test" name="directPayments[amount]" value="0">
											</td>
										</tr>

										<!--2nd Direct Pay-->
										<tr>
											<td>
												<select class="form-control" name="second_directPayments[type]">
													<option value="0">Select</option>
													<option value="Airport Transfers">Airport Transfers</option>
													<option value="Speed Boat Transfers">Speed Boat Transfers</option>
													<option value="Sea Plane">Sea Plane</option>
													<option value="Ferry Transfers">Ferry Transfers</option>
													<option value="Green Tax">Green Tax</option>
													<option value="City Tax">City Tax</option>
													<option value="VAT">VAT</option>
													<option value="Tourism Fee">Tourism Fee</option>
													<option value="Christmas Gala Dinner">Christmas Gala Dinner</option>
													<option value="New Year Gala Dinner">New Year Gala Dinner</option>
													<option value="Tours">Tours</option>
													<option value="Transfers">Transfers</option>
													<option value="Activity">Activity</option>
												</select>
											</td>
											<td>
												<input type="text" class="form-control" name="second_directPayments[pricetype]" value="Fixed" readonly />
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="second_directPayments[currency]" value="INR" style="max-width: 50px;" readonly />
												<input type="text" class="form-control number_test" name="second_directPayments[amount]" value="0">
											</td>
										</tr>
										
										<!--3rd Direct Pay-->
										<tr>
											<td>
												<select class="form-control" name="third_directPayments[type]">
													<option value="0">Select</option>
													<option value="Airport Transfers">Airport Transfers</option>
													<option value="Speed Boat Transfers">Speed Boat Transfers</option>
													<option value="Sea Plane">Sea Plane</option>
													<option value="Ferry Transfers">Ferry Transfers</option>
													<option value="Green Tax">Green Tax</option>
													<option value="City Tax">City Tax</option>
													<option value="VAT">VAT</option>
													<option value="Tourism Fee">Tourism Fee</option>
													<option value="Christmas Gala Dinner">Christmas Gala Dinner</option>
													<option value="New Year Gala Dinner">New Year Gala Dinner</option>
													<option value="Tours">Tours</option>
													<option value="Transfers">Transfers</option>
													<option value="Activity">Activity</option>
												</select>
											</td>

											<td>
												<input type="text" class="form-control" name="third_directPayments[pricetype]" value="Fixed" readonly />
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="third_directPayments[currency]" value="INR" style="max-width: 50px;" readonly />

												<input type="text" class="form-control number_test" name="third_directPayments[amount]" value="0">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<!--Trip Accommodation-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-bed" aria-hidden="true"></i> Trip Accommodation <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<?php
								$days=$data->duration;
								$days=(int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
								$days=$days-1;
							?>
							<div class="dynamic_acc">
								<input type="hidden" name="duration" value="<?php echo e((int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)); ?>" >
								<div class="item-container makeflex field0" id="0">
									<div class="row">
										<!-- duration -->
										<div class="col-md-6 relativeCont">
											<label class="field-required">Duration</label>
											<label class="label-duration">Select all<input type="checkbox" class="all_days"></label>

											<select class="form-control select_day select2" name="accommodation[0][night][]" multiple>
												<?php for($i=1; $i<=$days; $i++): ?>
													<option value="Night <?php echo e($i); ?>">Night <?php echo e($i); ?></option>
												<?php endfor; ?>
											</select>
										</div>

										<!-- select nights -->
                                        <!-- <div class="col-md-6 relativeCont">
                                          <div class="form-group daysel">
                                            <label class="field-required">Select Duration</label>
                                            <label class="label-duration">Select all<input type="checkbox" class="all_days"></label>
                                            <select class="form-control select_day select2" name="accommodation[0][night][]" multiple>
                                              !-- populating from package.js --
                                            </select>
                                          </div>
                                        </div> -->

										<!-- destination -->
										<div class="col-md-3 apndBtm10 quote_city_class">
											<label>City</label>
											<select class="quote_city form-control" name="accommodation[0][city]" required></select>				
											<!-- <input type="text" name="accommodation[0][city]" class="form-control text-capitalize quote_city" placeholder="Enter city name" /> -->
										</div>

										<!-- property type -->
										<div class="col-md-3 apndBtm10 propertytype_class">
											<label for="propertytype">Accommodation Type <span class="requiredcolor">*</span></label>
											<select class="form-control propertytype" name="accommodation[0][propertytype]" id="propertytype">
												<option selected disabled>Select</option>
												<option value="hotel">Hotel</option>
												<option value="resort">Resort</option>
												<option value="villa">Villa</option>
												<option value="home">Home</option>
												<option value="camp">Camp</option>
												<option value="cruise">Cruise</option>
											</select>
										</div>

										<!-- property source -->
										<div class="col-md-4 apndBtm10 propertysource_class">
											<label>Accommodation Source</label>
											<select class="form-control propertysource" name="accommodation[0][trip]" id="propertysource">
												<option selected disabled>Select</option>
												<option value="packagehoteldatabase">Package Hotel Database</option>
												<option value="hoteldatabase">Hotel Database</option>
												<option value="tripadvisor">TripAdvisor</option>
												<option value="manual">Manual</option>
											</select>
										</div>

										<!-- select property name -->
										<div class="col-md-4 apndBtm10 selectproperty" id="selectproperty" style="display: none">
											<label>Property Name</label>
											<select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
												<option value="" selected="true" disabled="disabled">Select</option>
												<!-- populate from js code -->
											</select>
										</div>

										<!-- select property star rating -->
										<div class="col-md-4 apndBtm10 selectpropertystar" id="selectpropertystar" style="display: none">
											<label>Star Rating</label>
											<select class="form-control selectpropertystar_value" name="accommodation[0][star]">
												<option selected disabled>Select</option>
												<option value="1">1 star</option>
												<option value="2">2 star</option>
												<option value="3">3 star</option>
												<option value="4">4 star</option>
												<option value="5">5 star</option>
											</select>
										</div>

										<!-- enter property name (manual) -->
										<div class="col-md-4 apndBtm10 propertyname" id="propertyname" style="display: none">
											<label>Enter Property</label>
											<input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
										</div>

										<!-- enter property star rating (manual) -->
										<div class="col-md-4 apndBtm10 selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
											<label>Enter Star Rating</label>
											<!--<input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Enter hotel star rating">-->
											<select class="form-control" name="accommodation[0][star_other]" id="">
												<option selected disabled>Select</option>
												<option value='1'>1 Star</option>
												<option value='2'>2 Star</option>
												<option value='3'>3 Star</option>
												<option value='4'>4 Star</option>
												<option value='5'>5 Star</option>
											</select>
										</div>

										<div class="col-md-12"></div>

										<!-- room type -->
										<div class="col-md-4 apndBtm10">
											<label>Room Type</label>
											<input type="text" class="form-control text-capitalize" name="accommodation[0][category]" placeholder="Enter room type">
										</div>

										<!-- property website -->
										<div class="col-md-4 apndBtm10 hotel_link_class">
											<label>Hotel Website</label>
											<input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
										</div>

										<!-- property contact no -->
										<div class="col-md-4 apndBtm10 hotel_contact_class">
											<label>Hotel Contact No</label>
											<input type="text" class="form-control hotel_contact" placeholder="Enter hotel contact no" name="accommodation[0][contact]">
										</div>

										<!-- meals -->
										<div class="col-md-4 apndBtm10">
											<label>Meals</label>
											<select class="form-control accommodationMeals" name="accommodation[0][meals]" id="">
												<option selected disabled>Select</option>
												<option value='Room Only'>Room Only</option>
												<option value='Breakfast'>Breakfast</option>
												<option value='Half Board'>Half Board</option>
												<option value='Full Board'>Full Board</option>
											</select>
										</div>

										<!-- price type -->
										<div class="col-md-4 apndBtm10">
											<label>Price Type</label>
											<select class="form-control accommodationFareType" name="accommodation[0][faretype]" id="">
												<option selected disabled>Select</option>
												<option value='Refundable'>Refundable</option>
												<option value='Non-refundable'>Non-refundable</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br>

							<!-- add more hotel -->
							<div class="row">
								<div class="col-md-12">
									<button type="button" name="add" id="add_acco" days="<?php echo e($days); ?>" class="btn btn-success">(+) Add more hotel</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Flight-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-plane" aria-hidden="true"></i> Flight <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="flightOption">
										<label for="flightOption">Flight Required?</label>
										<input type="checkbox" name="flight[flightOption]"  id="show_flight_options" value="1">
									</div>
								</div>
								<div class="col-md-12 flight">

									<!-- Onward Flight Container -->
                                   	<div class="col-md-12">
                                   		<div class="item-container">
											<div class="flightOption">
												<label for="onward_required">Onward Flight Required?</label>
												<input type="checkbox" name="flight[onward_required]" id="onward_required" value="1" checked>
											</div>									

											<!-- Onward Flight -->
											<div class="row onwardflight">
												<!--Onward Flight-->
												<div class="col-md-12 apndBtm10">
													<p class="flightBoxHeading">ONWARD FLIGHT</p>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Onward Date</label>
													<input type="text" name="flight[onwarddate]" class="form-control departure_date" placeholder="Select departure date">
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Airline Name</label>
													<select name="flight[name]" class="form-control flight_name">
														<option value="0">Select Airline</option>
														<?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($airline->airline_name); ?>"><?php echo e($airline->airline_name); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Flight No.</label>
													<input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333">
												</div>
												<div class="col-md-3 apndBtm20">
													<label>No. Of Stop</label>
													<select name="flight[numberstop]" class="form-control">
														<option value="" selected disabled>Select Stops</option>
														<option value="Non-Stop" selected>Non-Stop</option>
														<?php for($i=1; $i<=4; $i++): ?>
														<?php if($i==1): ?>
															<option value="<?php echo e($i); ?> Stop"><?php echo e($i); ?> Stop</option>
														<?php else: ?>
															<option value="<?php echo e($i); ?> Stops"><?php echo e($i); ?> Stops</option>
														<?php endif; ?>
														<?php endfor; ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Flight Origin</label>
													<!--<input type="text" name="flight[Origin]" class="form-control flight_origin">-->
													<select name="flight[origin]" class="form-control origin">
														<option value="" selected disabled>Select Origin</option>
														<?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
															<option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Departure Time</label>
													<!--<input type="text" name="flight[dtime]" class="form-control">-->
													<div class="clearfix"></div>
														<select name="flight[dhours]" class="form-control dhours" style="max-width: 49%;display: inline-block;">
															<option value="" selected disabled>Hours</option>
															<?php for($i=1; $i<=24; $i++): ?>
																<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
															<?php endfor; ?>
														</select>
														<select name="flight[dmins]" class="form-control dmins" style="max-width: 49%;display: inline-block;">
															<option value="" selected disabled>Minutes</option>
															<?php for($i = 0; $i <= 59; $i++): ?>
																<option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
															<?php endfor; ?>
														</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Destination</label>
													<select name="flight[dest]" class="form-control dest">
														<option value="" selected disabled>Select Destination</option>
														<?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
															<option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>)</option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Arrival Time</label>
													<div class="clearfix"></div>
													<select name="flight[ahours]" class="form-control ahours" style="padding: 5px;max-width: 32%;display: inline-block;">
														<option value="" selected disabled>Hours</option>
														<?php for($i=1; $i<=24; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
														<?php endfor; ?>
													</select>
													<select name="flight[amins]" class="form-control amins" style="padding: 5px;max-width: 37%;display: inline-block;">
														<option value="" selected disabled>Minutes</option>
														<?php for($i = 0; $i <= 59; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
														<?php endfor; ?>
													</select>
													<select name="flight[adayplus]" class="form-control adayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
														<option value="0">+0 Day</option>
														<option value="1">+1 Day</option>
														<option value="2">+2 Day</option>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Cabin Class</label>
													<select name="flight[cabin]" class="form-control">
														<option value="economyclass">Economy</option>
														<option value="premiumeconomyclass">Premium Economy</option>
														<option value="businessclass">Business</option>
														<option value="firstclass">First</option>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Fare Type</label>
													<select name="flight[faretype]" class="form-control">
														<option value="" selected disabled>Select</option>
														<option value="refundable" selected>Refundable</option>
														<option value="partialrefundable">Partial-refundable</option>
														<option value="non-refundable">Non-refundable</option>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Flight Duration</label>
													<div class="clearfix"></div>
														<select name="flight[duration_hours]" class="form-control duration_hours" style="max-width: 49%;display: inline-block;">
															<option value="" selected disabled>Hours</option>
															<?php for($i = 1; $i <= 40; $i++): ?>
															 	<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?></option>
															<?php endfor; ?>
														</select>
														<select name="flight[duration_dmins]" class="form-control duration_min" style="max-width: 49%;display: inline-block;">
															<option value="" selected disabled>Minutes</option>
															<?php for($i = 0; $i <= 59; $i++): ?>
															    <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
															<?php endfor; ?>
														</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<div class="makeflex">
														<!-- cabin baggage -->
														<div class="flexOne">
															<label>Cabin Baggage</label>
															<select class="form-control" name="flight[baggage]">
																<option selected disabled>Cabin Bag</option>
																<option value="0 Kg">0 Kg</option>
																<option value="5 Kgs">5 Kgs</option>
																<option value="7 Kgs">7 Kgs</option>
																<option value="8 Kgs">8 Kgs</option>
															</select>
														</div>

														<!-- check-in baggage -->
														<div class="flexOne">
															<label>Check-In Baggage</label>
															<select class="form-control" name="flight[cbaggage]">
																<option selected disabled>Check-In Bag</option>
																<option value="0 Kg">0 Kg</option>
																<option value="10 Kgs">10 Kgs</option>
																<option value="15 Kgs">15 Kgs</option>
																<option value="20 Kgs">20 Kgs</option>
																<option value="23 Kgs">23 Kgs</option>
																<option value="25 Kgs">25 Kgs</option>
																<option value="30 Kgs">30 Kgs</option>
																<option value="35 Kgs">35 Kgs</option>
																<option value="40 Kgs">40 Kgs</option>
																<option value="45 Kgs">45 Kgs</option>
																<option value="50 Kgs">50 Kgs</option>
																<option value="55 Kgs">55 Kgs</option>
																<option value="60 Kgs">60 Kgs</option>
																<option value="1 Piece">1 Piece</option>
																<option value="2 Pieces">2 Pieces</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- Return Flight Container -->
									<div class="col-md-12">
										<div class="item-container">
											<div class="flightOption">
												<label for="return_required">Return Flight Required?</label>
												<input type="checkbox" name="flight[return_required]" id="return_required" value="1" checked>
											</div>
										

											<!-- Return Flight -->
											<div class="row returnflight">
												<div class="col-md-12 apndBtm10">
													<p class="flightBoxHeading">RETURN FLIGHT</p>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Return Date</label>
													<input type="text" name="flight[downwarddate]" class="form-control return_date" placeholder="Select return date">
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Airline Name</label>
													<!--<input type="text" name="flight[dname]" class="form-control down_filght">-->
													<select name="flight[dname]" class="form-control down_filght">
														<option value="" selected disabled>Select Airline</option>
														<?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
															<option value="<?php echo e($airline->airline_name); ?>"><?php echo e($airline->airline_name); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Flight No.</label>
													<input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334">
												</div>
												<div class="col-md-3 apndBtm20">
													<label>No. Of Stop</label>
													<select name="flight[dnumberstop]" class="form-control">
														<option value="" selected disabled>Select Stopover</option>
														<option value="Non-Stop" selected>Non-Stop</option>
														<?php for($i=1; $i<=4; $i++): ?>
														<?php if($i==1): ?>
															<option value="<?php echo e($i); ?> Stop"><?php echo e($i); ?> Stop</option>
														<?php else: ?>
															<option value="<?php echo e($i); ?> Stops"><?php echo e($i); ?> Stops</option>
														<?php endif; ?>
														<?php endfor; ?>;
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Flight Origin</label>
													<select name="flight[dOrigin]" class="form-control down_origin">
														<option value="" selected disabled>Select Origin</option>
														<?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
															<option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Departure Time</label>
													<div class="clearfix"></div>
													<select name="flight[ddhours]" class="form-control ddhours" style="max-width: 49%;display: inline-block;">
														<option value="" selected disabled>Hours</option>
														<?php for($i=1; $i<=24; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
														<?php endfor; ?>
													</select>
													<select name="flight[ddmins]" class="form-control ddmins" style="max-width: 49%;display: inline-block;">
														<option value="" selected disabled>Minutes</option>
														<?php for($i = 0; $i <= 59; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
														<?php endfor; ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Destination</label>
													<select name="flight[ddest]" class="form-control down_dest">
														<option value="" selected disabled>Select Destination</option>
														<?php $__currentLoopData = $iatalist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<?php $val=$iata->iata_name.' '.'('.$iata->iata_code.')'; ?>
															<option value="<?php echo e($val); ?>"><?php echo e($iata->iata_name); ?> (<?php echo e($iata->iata_code); ?>) </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Arrival Time</label>
													<div class="clearfix"></div>
													<select name="flight[dahours]" class="form-control dahours" style="padding: 5px;max-width: 32%;display: inline-block;">
														<option value="" selected disabled>Hours</option>
														<?php for($i=1; $i<=24; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e(\Illuminate\Support\Str::plural('hour', $i)); ?></option>
														<?php endfor; ?>;
													</select>
													<select name="flight[damins]" class="form-control damins" style="padding: 5px;max-width: 37%;display: inline-block;">
														<option value="" selected disabled>Minutes</option>
														<?php for($i = 0; $i <= 59; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e(\Illuminate\Support\Str::plural('minute', $i)); ?></option>
														<?php endfor; ?>
													</select>
													<select name="flight[dadayplus]" class="form-control dadayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
														<option value="0">+0 Day</option>
														<option value="1">+1</option>
														<option value="2">+2</option>
													</select>
												</div>
												<div class="col-md-3">
													<label>Cabin Class</label>
													<select name="flight[dcabin]" class="form-control">
														<option value="economyclass">Economy</option>
														<option value="premiumeconomyclass">Premium Economy</option>
														<option value="businessclass">Business</option>
														<option value="firstclass">First</option>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<label>Fare Type</label>
													<select name="flight[dfaretype]" class="form-control">
														<option value="" selected disabled>Select</option>
														<option value="refundable">Refundable</option>
														<option value="partialrefundable">Partial-refundable</option>
														<option value="non-refundable">Non-refundable</option>
													</select>
												</div>
												<div class="col-md-3">
													<label>Flight Duration</label>
													<div class="clearfix"></div>
													<select name="flight[return_duration_hours]" class="form-control return_duration_hours" style="max-width: 49%;display: inline-block;">
														<option value="" selected disabled>Hours</option>
														<?php for($i = 1; $i <= 40; $i++): ?>
															<option value="<?php echo e($i); ?>"><?php echo e($i); ?> <?php echo e($i === 1 ? 'hour' : 'hours'); ?></option>
														<?php endfor; ?>
													</select>
													<select name="flight[return_duration_mins]" class="form-control return_duration_min" style="max-width: 49%;display: inline-block;">
														<option value="" selected disabled>Minutes</option>
														<?php for($i = 0; $i <= 59; $i++): ?>
														    <option value="<?php echo e($i); ?>"><?php echo e($i === 0 ? '00' : $i); ?> <?php echo e($i === 1 ? 'minute' : 'minutes'); ?></option>
														<?php endfor; ?>
													</select>
												</div>
												<div class="col-md-3 apndBtm20">
													<div class="makeflex">
														<!-- cabin baggage -->
														<div class="flexOne">
															<label>Cabin Baggage</label>
															<select class="form-control" name="flight[dbaggage]">
																<option selected disabled>Cabin Bag</option>
																<option value="0 Kg">0 Kg</option>
																<option value="5 Kgs">5 Kgs</option>
																<option value="7 Kgs">7 Kgs</option>
																<option value="8 Kgs">8 Kgs</option>
															</select>
														</div>

														<!-- check-in baggage -->
														<div class="flexOne">
															<label>Check-In Baggage</label>
															<select class="form-control" name="flight[dcbaggage]">
																<option selected disabled>Check-In Bag</option>
																<option value="0 Kg">0 Kg</option>
																<option value="10 Kgs">10 Kgs</option>
																<option value="15 Kgs">15 Kgs</option>
																<option value="20 Kgs">20 Kgs</option>
																<option value="23 Kgs">23 Kgs</option>
																<option value="25 Kgs">25 Kgs</option>
																<option value="30 Kgs">30 Kgs</option>
																<option value="35 Kgs">35 Kgs</option>
																<option value="40 Kgs">40 Kgs</option>
																<option value="45 Kgs">45 Kgs</option>
																<option value="50 Kgs">50 Kgs</option>
																<option value="55 Kgs">55 Kgs</option>
																<option value="60 Kgs">60 Kgs</option>
																<option value="1 Piece">1 Piece</option>
																<option value="2 Pieces">2 Pieces</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Transfers-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-bus" aria-hidden="true"></i> Transfers (Car, Bus, Train) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12 transfers_input_wrapper">
									<div class="item-container transfers_input" id="transfers_input-0" data-id="0">
										<div class="row">
											<input type="hidden" value="">
											<div class="field-0" id="0">
												<div class="form-group col-sm-3">
													<label for="transfertitle">Transfer Title</label>
													<input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="transportmode">Transport Mode</label>
														<select name="transfers[0][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
															<option selected disabled>Select</option>
															<option value="Car">Car</option>
															<option value="Bus">Bus</option>
															<option value="Train">Train</option>
														</select>
													</div>
												</div>
												<div class="form-group col-sm-3">
													<label for="transfertype">Transfer Type</label>
													<select name="transfers[0][transfers_type]" id="transfers_type0" class="form-control transfers_type">
														<?php /*<option value="0">--Select Transfers--</option>
														@foreach($transfers->unique('transfer_type') as $transfer)
														<option value="{{$transfer->title}}">{{$transfer->title}} </option>
														@endforeach*/ ?>
														<option value="0">Select</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">Add More</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Overview-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-sticky-note-o" aria-hidden="true"></i> Trip Overview (Add-on Service & Highlights) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group item-container">
										<label for="addonservices">Add-On Services (Room upgrade, Honeymoon freebies etc.)</label>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="5"><?php echo e(old('description')); ?></textarea>
									</div>

									<div class="form-group item-container">
										<label for="">Add Tour Highlights</label>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5"><?php echo e(old('highlights')); ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Inclusions & Exclusions-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-plus-circle" aria-hidden="true"></i> Inclusions & Exclusions <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group item-container">
										<label>Inclusions</label>
										<select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
											<?php $__currentLoopData = $inclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option value="<?php echo e($pol->id); ?>" ><?php echo e($pol->name); ?> </option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="inclusions" id="" cols="30" rows="5"><?php echo e(old('inclusions')); ?></textarea>
									</div>
								</div>
								<br>
								<div class="col-md-12">
									<div class="form-group item-container">
										<label>Exclusions</label>
										<select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
											<?php $__currentLoopData = $exclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->name); ?> </option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="exclusions" id="" cols="30" rows="5"><?php echo e(old('exclusions')); ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Itinerary-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Trip Itinerary <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<?php for($j=1;$j<=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT);$j++): ?>
										<div class="item-container day1">
											<div class="dayTitle">DAY <?php echo e($j); ?>

												<input type="text" name="dayItinerary[day<?php echo e($j); ?>][title]" placeholder="Day Title">
											</div>
											<div class="form-group">
												<label for="dayDescription" class="color4a">Add day description</label>
												<br>
												<span class="show_hide morePlus">More+</span>
												<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day<?php echo e($j); ?>][desc]"></textarea>
											</div>
										</div>
										<?php endfor; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Policy-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-info-circle" aria-hidden="true"></i> Trip Policies (Visa, Payment, Cancellation & Important Notes) <span class="requiredcolor">*</span></h4>
					</div>

					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="item-container">
										<h4>Terms & Conditions</h4>
										<div class="visaOption">
											<label for="visa">Is Visa Required?</label>
											<input type="checkbox" name="visa" value="1" id="visa" class="visa" />
										</div>
										<!--Visa Policy-->
										<div class="visa_pol">
											<h5>Visa Terms & Policies</h5>
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>
															<div>
																<select name="package_visa[]"  class="select2 form-control package_visa" multiple>
																	<?php $__currentLoopData = $visaPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																	<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
																</select>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<span class="show_hides morePlus">More+</span>
															<br>
															<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text"></textarea>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

									<!--Payment Policy-->
									<div class="item-container">
										<h5>Payment Terms & Methods</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div>
															<select name="package_payment[]"  class="select2 form-control package_payment" multiple>
																<?php $__currentLoopData = $paymentPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides morePlus">More+</span>
														<br>
														<textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text"></textarea>
													</td>
												</tr>
											</tbody>
										</table>
									</div>

									<!--Cancellation Policy-->
									<div class="item-container">
										<h5>Cancellation & Refund Policy</h5>
										<table class="table table-bordered" id="dynamic_field">
											<tbody>
												<tr>
													<td>
														<div>
															<select name="package_can[]"  class="select2 form-control package_can" multiple>
																<?php $__currentLoopData = $cancelPolicy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</select>
														</div>
													</td>
												</tr>
											<tr>
												<td>
													<span class="show_hides morePlus">More+</span>
													<br>
													<textarea name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control hide_text"></textarea><!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
												</td>
											</tr>
											</tbody>
										</table>
									</div>

									<!--Important Notes-->
									<div class="item-container">
										<h5>Important Notes</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div>
															<select name="package_impnotes[]" class="select2 form-control package_impnotes" multiple>
																<?php $__currentLoopData = $imp_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>"><?php echo e($pol->policy); ?> </option>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</select>
														</div>
													</td>
												</tr>
											<tr>
												<td>
													<span class="show_hides morePlus">More+</span>
													<br>
													<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control hide_text"></textarea>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Trip Quote Validity-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Quote Validity <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="item-container">
								<div class="row">
									<!-- trip date validity -->
									<?php
										// Get the current date in the desired format (e.g., YYYY-MM-DD or DD-MM-YYYY)
										$currentDate = date('d-m-Y'); // Format as dd-mm-yyyy or use another format if needed
									?>
									<div class="col-md-2">
									    <label for="quoteValidity">Date valid upto</label>
									    <input type="text" class="form-control datepicker_s" name="validaty" value="<?php echo $currentDate; ?>">
									</div>

									<!-- trip time validity -->
									<div class="col-md-3">
									    <label for="quoteValidity">Time valid upto</label>
									    <div class="relativeCont">
									        <span class="btn-time-reset-cont reset_class"></span>
									    </div>
									    <input type="text" class="form-control validity_time" value="23:59:59" id="timeInput" name="validity_time" pattern="^(?:[01]\d|2[0-3]):[0-5]\d:[0-5]\d$" placeholder="HH:MM:SS (24 Hours)" required />
									</div>


									<!-- pay type -->
									<div class="col-md-2">
									    <label>Pay Immediately</label>
									    <div class="pay-custom-radio-group makeflex">
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="Yes" name="validity_show_on_frontend" />
									            <span class="pay-custom-radio-label">Yes</span>
									        </label>
									        <label class="pay-custom-radio flexOne">
									            <input type="radio" value="No" name="validity_show_on_frontend" checked />
									            <span class="pay-custom-radio-label">No</span>
									        </label>
									    </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--Greetings & Signature-->
				<div class="panel-item-cont">
					<div class="accordion panelHeading down-arrow">
						<i class="fa fa-user" aria-hidden="true"></i> Greetings & Signature <span class="requiredcolor">*</span></h4>
					</div>
					<?php
						$loged_user=Sentinel::getUser();
					?>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="item-container">
									<h5>Header <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<label for="emailHeader" class="emailHeader">Email header <span class="requiredcolor">*</span></label> 
													<i class="fa <?php if($loged_user->lock_header_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true"></i>
													<br>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor" <?php if($loged_user->lock_header_email==1): ?> readonly <?php endif; ?>> <?php echo $loged_user->signature_header; ?> </textarea>
												</td>
											</tr>
											<tr>
												<td>
													<label for="webHeader" class="webHeader">Web header <span class="requiredcolor">*</span></label> 
													<i class="fa  <?php if($loged_user->lock_header==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true">
													</i>
													<br>

													<div>
														<input type="hidden" name="quotation_header" class="quotation_header" value="<?php echo e($loged_user->quotation_header); ?>">
														<select name="quotation_header" class="select2 form-control" <?php if($loged_user->lock_header==1): ?> style="cursor:not-allowed" disabled <?php endif; ?>>
															<?php $__currentLoopData = $quotation_header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>" <?php if($loged_user->quotation_header==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->header); ?> </option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="item-container">
									<h5>Signature <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<label for="emailFooter" class="emailFooter">Email footer <span class="requiredcolor">*</span></label> 
													<i class="fa  <?php if($loged_user->lock_footer_email==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true">
													</i>
													<br>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor" <?php if($loged_user->lock_footer_email==1): ?> readonly <?php endif; ?>> <?php echo $loged_user->signature; ?> </textarea>
												</td>
											</tr>
											<tr>
												<td>
													<label for="webFooter" class="webFooter">Web footer <span class="requiredcolor">*</span></label>
													<i class="fa  <?php if($loged_user->lock_footer==1): ?> fa-lock <?php else: ?> fa-unlock <?php endif; ?> colorA1 fontSize14 lock_header_icon" aria-hidden="true"></i>
													<br>
													<div>
														<input type="hidden" name="quotation_footer" class="quotation_footer" value="<?php echo e($loged_user->quotation_footer); ?>">
														<select name="" class="select2 form-control" <?php if($loged_user->lock_footer==1): ?> style="cursor:not-allowed" disabled <?php endif; ?>>
															<?php $__currentLoopData = $quotation_footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
																<option value="<?php echo e($pol->id); ?>" <?php if($loged_user->quotation_footer==$pol->id): ?> selected <?php endif; ?>><?php echo e($pol->footer); ?> </option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
														</select>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- save or send quote -->
				<div class="col-md-12">
					<div class="saveOptions">
						<!-- select save quote -->
						<div class="savePreview">
							<label class="radio-inline">
							<input type="radio" value="1" name="send_option" checked>Save & Preview</label>
						</div>

						<!-- select send quote -->
						<div class="saveSend" style="display: none;">
							<label class="radio-inline">
							<input type="radio" value="0" name="send_option">Save & Send</label>
						</div>
					</div>
				</div>

				<!-- continue -->
				<div class="col-md-12">
					<div class="saveQuote">
						<button type="submit" name="add" id="remove" class="btnblue btnQuoteSave">Continue</button>
					</div>
				</div>
			</form>
			</div>

			<!-- right section -->
			<div class="right-section sidebar">
				<!--Enquiry Details-->
				<div class="panel-item-cont">
					<div class="panelHeading">
						<i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details <span class="requiredcolor">*</span>
					</div>
					<div class="panelBox" style="display: block; max-height: inherit;">
						<div class="panelContent">
							<!-- lead details -->
							<?php echo $__env->make('query.enquiryDetails.leadDetails', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>							
						</div>
					</div>
				</div>
			</div>
		</div>