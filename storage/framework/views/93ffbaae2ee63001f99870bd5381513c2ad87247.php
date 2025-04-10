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
							<!--payment cancellation-->
<div class="backend_custom_height item-container">
								<div class="partPayment">
									<label for="cancellPayment">Cancellation Payment ?</label>
									<input type="checkbox" name="cancellPayment" value="1" id="show_refund_payment" class="show_refund_payment">
								</div>
								<!-- part payment details -->
								<table class="refund_payment table backend_custom_height table-bordered table-striped" style="display:none;">
									<thead class="thead-dark">
								        <tr>
								            <th scope="col">Payment Type</th>
								            <th scope="col">Price Type</th>
								            <th scope="col">Payable Amount</th>
								            <th scope="col">Refund Within</th>
								            <th scope="col">Payment Date</th>
								        </tr>
								    </thead>
									<tbody>

										<!--Advance Payment-->
										<tr>
											<td class="tourPriceItem">Advance Payment</td>

											<td class="makeflex">
												<select class="fixedValue advance_refund_payment" name="refund_payments[adv_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>
												<!-- <input type="text" name="part_payments[adv_percentage]" class="form-control percentageValue number_test advance_payment_percentage"> -->
												<select name="refund_payments[adv_percentage]" class="form-control percentageValue number_test refund_advance_payment_percentage">
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>

												<span id="quote1_refund_advance_payment_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" name="refund_payments[adv_amount]" class="form-control number_test quote1_refund_advance_payment">
												<span id="quote1_refund_advance_payment_error anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[adv_days]" class="days_data">   
												<select  class="form-control payment_days">
													<option value="" disabled>Duration</option>
		                                            <?php for($i=1;$i<=$difference;$i++): ?>
		                                         		<option value="<?php echo e($i); ?>"><?php echo e($i); ?> Days</option>
		                                            <?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[adv_date]" class="form-control payment_date datepicker_adv_refund">
											</td>
										</tr>

										<!--1st Part Payment-->
										<tr>
											<td class="tourPriceItem">1st Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue first_part_refund_payment" name="refund_payments[first_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test first_part_percentage" name="part_payments[first_part_percentage]"> -->
												<select class="form-control number_test first_part_refund_percentage" name="refund_payments[first_part_percentage]" >
												    <option value="" disabled>0%</option>
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>
												<span id="first_part_refund_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_first_part_refund" name="refund_payments[first_part_amount]">
												<span id="quote1_first_part_refund_error" class="anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[first_part_days]" id="first_part_refund_days" class="days_data" value="">  
												<select class="form-control payment_days" id="first_refund_payment_days">
		                                            <!-- Options populated from JS -->
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[first_part_date]" class="form-control payment_date  datepicker_first_refund_payment">
											</td>
										</tr>

										<!--2nd Part Payment-->
										<tr>
											<td class="tourPriceItem">2nd Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue second_part_refund_payment" name="refund_payments[second_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2">Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test second_part_percentage" name="part_payments[second_part_percentage]"> -->
												<select class="form-control number_test second_part_percentage_refund" name="refund_payments[second_part_percentage]" disabled>
												    <?php for ($i = 0; $i <= 100; $i++): ?>
												        <option value="<?php echo $i; ?>"><?php echo $i; ?>%</option>
												    <?php endfor; ?>
												</select>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_second_part_refund" name="refund_payments[second_part_amount]">
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[second_part_days]" id="second_part_days_refund" class="days_data" value="">
												<select class="form-control payment_days" id="second_refund_payment_days">
													<!-- populating from js code -->
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[second_part_date]" class="form-control payment_date  datepicker_second_payment_refund" />
											</td>
										</tr>

										<!--Total Payment-->
										<tr class="">
											<td class="tourPriceItem">Total Payment</td>
											<td>
												<p class="currencyBox">INR</p>
											</td>
											<td>
												<input type="text" class="form-control query_pricetopay quote1_total_payment_refund" name="refund_payments[total_installment]" readonly oncontextmenu="return false;" /></td>
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
													<option value="">Select</option>
<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>"><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													
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
													<option value="">Select</option>
													<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>"><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
													<option value="">Select</option>
													<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>"><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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


