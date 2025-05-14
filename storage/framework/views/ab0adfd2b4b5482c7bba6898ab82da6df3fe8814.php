<?php 

$price_data=CustomHelpers::get_price_part_seperate($packagesData->quote_price,$packagesData->adult,$packagesData->extra_adult,$packagesData->child_with_bed,$packagesData->child_without_bed,$packagesData->infant,$packagesData->solo_traveller); 

?>
							<!-- Price type selection section -->
					        <div class="roomGuests">
					            <label><b>Price Type</b> <span class="requiredcolor">*</span></label>

					            <select class="form-control bgF2 flexOne price_type" name="price_type">
					                <option value="1" <?php if($packagesData->price_type=='1'): ?> selected <?php endif; ?>>Per Person</option>
									<option value="2" <?php if($packagesData->price_type=='2'): ?> selected <?php endif; ?>>Group Price</option>
					            </select>

					            <!-- db table name: anything -->
					            <select class="form-control flexOne" name="priceremarks">
					            	<option value="1" <?php if($packagesData->anything=='1'): ?> selected <?php endif; ?>>Price Per Person (inclusive of taxes)</option>
									<option value="2" <?php if($packagesData->anything=='2'): ?> selected <?php endif; ?>>Price for all Person (inclusive of taxes)</option>
					            </select>
					            
					            <input type="text" class="form-control flexOne" name="remarks" value="<?php echo e($packagesData->quote_remarks); ?>" placeholder="Price Remarks (if any) ..." />

					            <!-- Default room description input (readonly) -->
					            <input type="text" class="quote1_pop_passenger_value flexOne" 
					                   value="1 Room (2 Adults)" 
					                   placeholder="" 
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
												<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($packagesData->currency==$rate->id): ?> selected <?php endif; ?>><?php echo e($rate-> currency); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="text" name="roe" class="quote1_rate number_test" placeholder="ROE" value="<?php echo e($packagesData->roe); ?>">
										</div>
										<div class="currencyConversion">
											<input type="text" name="indian_rate" class="quote1_value number_test" placeholder="Enter" value="<?php echo e($packagesData->indian_rate); ?>">
											<input type="text" name="total_value" class="bgF2 quote1_total number_test" value="<?php echo e($packagesData->total_value); ?>" placeholder="Value" readonly>
										</div>
										<p class="itemBottomHeading">Conversion</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">ADULT</p>
										<p class="itemTopSubHeading">(TWIN SHARING)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="quote1_number_of_adult" class="quote1_number_of_adult quote1_adult_room_value" value="<?php echo e($packagesData->adult); ?>" />
											<!-- <span class="travellersMinus quote1_adult_room_dec">&#8722;</span> -->
											<span class="travellersValue quote1_adult_room_result"><?php echo e($packagesData->adult); ?></span>
											<!-- <span class="travellersPlus quote1_adult_room_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
									<th>
										<!-- <p class="itemTopHeading">EXTRA ADULT</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="extra_adult" class="quote1_number_of_extra_adult quote1_child_extra_adult_value"  value="<?php echo e($packagesData->extra_adult); ?>" />
											<!-- <span class="travellersMinus quote1_child_extra_adult_dec">&#8722;</span> -->
											<span class="travellersValue quote1_child_extra_adult_result"><?php echo e($packagesData->extra_adult); ?></span>
											<!-- <span class="travellersPlus quote1_child_extra_adult_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">CHILD</p>
										<p class="itemTopSubHeading">(WITH BED)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" name="child_with_bed" class="quote1_number_of_child_with_bed quote1_child_with_bed_value" value="<?php echo e($packagesData->child_with_bed); ?>" />
											<!-- <span class="travellersMinus quote1_child_with_bed_dec">&#8722;</span> -->
											<span class="travellersValue quote1_child_with_bed_result"><?php echo e($packagesData->child_with_bed); ?></span>
											<!-- <span class="travellersPlus quote1_child_with_bed_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">CHILD</p>
										<p class="itemTopSubHeading">(WITHOUT BED)</p> -->
										<div class="addTravellerValue">
											<input type="hidden" value="<?php echo e($packagesData->child_without_bed); ?>" id="travellers" name="child_without_bed" class="quote1_number_of_child_without_bed quote1_childwithoutbed_value"  />
											<!-- <span class="travellersMinus quote1_childwithoutbed_dec">&#8722;</span> -->
											<span class="travellersValue quote1_span_value_childwithoutbed_result"><?php echo e($packagesData->child_without_bed); ?></span>
											<!-- <span class="travellersPlus quote1_childwithoutbed_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">INFANT</p> -->
										<div class="addTravellerValue">
											<input type="hidden" value="<?php echo e($packagesData->infant); ?>" id="travellers" name="infant" class="quote1_number_of_infant quote1_infant_value"  />
											<!-- <span class="travellersMinus quote1_infant_dec">&#8722;</span> -->
											<span class="travellersValue quote1_infant_result"><?php echo e($packagesData->infant); ?></span>
											<!-- <span class="travellersPlus quote1_infant_inc">&#43;</span> -->
										</div>
										<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
									</th>
									<th>
										<!-- <p class="itemTopHeading">SOLO<br>TRAVELLER</p> -->
										<div class="addTravellerValue">
											<input type="hidden" id="travellers" value="<?php echo e($packagesData->solo_traveller); ?>" name="solo_traveller" class="quote1_number_solo_traveller quote1_solo_value"  />
											<!-- <span class="travellersMinus quote1_solo_dec">&#8722;</span> -->
											<span class="travellersValue quote1_solo_result"><?php echo e($packagesData->solo_traveller); ?></span>
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
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['quote_airfare']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[quote_airfare_remarks]" id="remarks_airfare" value="<?php echo e($price_data['quote_airfare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_air_adult" name="price[query_air_adult]" value="<?php echo e($price_data['query_air_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_air_exadult exadult_disable" name="price[query_air_exadult]" value="<?php echo e($price_data['query_air_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_air_childbed childbed_disable" name="price[query_air_childbed]" value="<?php echo e($price_data['query_air_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_air_childwbed childwbed_disable" name="price[query_air_childwbed]" value="<?php echo e($price_data['query_air_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_air_infant infant_disable" name="price[query_air_infant]" value="<?php echo e($price_data['query_air_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_air_single single_disable" name="price[query_air_single]" value="<?php echo e($price_data['query_air_single']); ?>"></td>
									</tr>
									
									<!--Cruise Fare-->
									<tr>
										<td>Cruise Fare</td>
										<td class="makeflex">
											<select class="form-control supplier" name="price[quote_cruise_fare]" id="cruise_fare">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['quote_cruise_fare']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden"  name="price[quote_cruise_fare_remarks]"  id="remarks_cruise_fare" value="<?php echo e($price_data['quote_cruise_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruise_adult" name="price[query_cruise_adult]" value="<?php echo e($price_data['query_cruise_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]" value="<?php echo e($price_data['query_cruise_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]" value="<?php echo e($price_data['query_cruise_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]" value="<?php echo e($price_data['query_cruise_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]" value="<?php echo e($price_data['query_cruise_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]" value="<?php echo e($price_data['query_cruise_single']); ?>"></td>
									</tr>

									<!-- Cruise Port Charges -->
									<tr>
										<td>Port Charges </td>
										<td class="makeflex">
											<select class="form-control supplier" id="port_charge_fare" name="price[port_charge_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['port_charge_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="<?php echo e($price_data['port_charge_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_adult" name="price[query_cruiseport_adult]" value="<?php echo e($price_data['query_cruiseport_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_exadult exadult_disable" name="price[query_cruiseport_exadult]" value="<?php echo e($price_data['query_cruiseport_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_childbed childbed_disable" name="price[query_cruiseport_childbed]" value="<?php echo e($price_data['query_cruiseport_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_childwbed childwbed_disable" name="price[query_cruiseport_childwbed]" value="<?php echo e($price_data['query_cruiseport_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_infant infant_disable" name="price[query_cruiseport_infant]" value="<?php echo e($price_data['query_cruiseport_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruiseport_single single_disable" name="price[query_cruiseport_single]" value="<?php echo e($price_data['query_cruiseport_single']); ?>"></td>
									</tr>

									<!-- Cruise Gratuity -->
									<tr>
										<td>Gratuity</td>
										<td class="makeflex">
											<select class="form-control supplier" id="gratuity_fare" name="price[gratuity_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['gratuity_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[gratuity_remarks]" id="remarks_gratuity_fare" value="<?php echo e($price_data['gratuity_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_adult" name="price[query_cruisegratuity_adult]" value="<?php echo e($price_data['query_cruisegratuity_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_exadult exadult_disable" name="price[query_cruisegratuity_exadult]" value="<?php echo e($price_data['query_cruisegratuity_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_childbed childbed_disable" name="price[query_cruisegratuity_childbed]" value="<?php echo e($price_data['query_cruisegratuity_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_childwbed childwbed_disable" name="price[query_cruisegratuity_childwbed]" value="<?php echo e($price_data['query_cruisegratuity_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_infant infant_disable" name="price[query_cruisegratuity_infant]" value="<?php echo e($price_data['query_cruisegratuity_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegratuity_single single_disable" name="price[query_cruisegratuity_single]" value="<?php echo e($price_data['query_cruisegratuity_single']); ?>"></td>
									</tr>

									<!-- Cruise GST -->
									<tr>
										<td>Cruise GST </td>
										<td class="makeflex">
											<select class="form-control supplier" id="cruise_gst_fare" name="price[cruise_gst_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['cruise_gst_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>> <?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="<?php echo e($price_data['cruise_gst_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_adult" name="price[query_cruisegst_adult]" value="<?php echo e($price_data['query_cruisegst_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_exadult exadult_disable" name="price[query_cruisegst_exadult]" value="<?php echo e($price_data['query_cruisegst_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_childbed childbed_disable" name="price[query_cruisegst_childbed]" value="<?php echo e($price_data['query_cruisegst_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_childwbed childwbed_disable" name="price[query_cruisegst_childwbed]" value="<?php echo e($price_data['query_cruisegst_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_infant infant_disable" name="price[query_cruisegst_infant]" value="<?php echo e($price_data['query_cruisegst_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_cruisegst_single single_disable" name="price[query_cruisegst_single]" value="<?php echo e($price_data['query_cruisegst_single']); ?>"></td>
									</tr>

									<!--Accommodation-->
									<tr>
										<td>Accommodation</td>
										<td class="makeflex">
											<select class="form-control supplier" id="accommodation_fare" name="price[accommodation_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['accommodation_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="<?php echo e($price_data['accommodation_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_hotel_adult" name="price[query_hotel_adult]" id="" value="<?php echo e($price_data['query_hotel_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_exadult exadult_disable" name="price[query_hotel_exadult]" value="<?php echo e($price_data['query_hotel_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_childbed childbed_disable" name="price[query_hotel_childbed]" value="<?php echo e($price_data['query_hotel_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_childwbed childwbed_disable" name="price[query_hotel_childwbed]" value="<?php echo e($price_data['query_hotel_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_infant infant_disable" name="price[query_hotel_infant]" value="<?php echo e($price_data['query_hotel_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_hotel_single single_disable" name="price[query_hotel_single]" value="<?php echo e($price_data['query_hotel_single']); ?>"></td>
									</tr>

									<!-- Sightseeing -->
									<tr>
										<td>Sightseeing</td>
										<td class="makeflex">
											<select class="form-control supplier" id="sightseeing_fare" name="price[sightseeing_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['sightseeing_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="<?php echo e($price_data['sightseeing_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_tours_adult" name="price[query_tours_adult]" value="<?php echo e($price_data['query_tours_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tours_exadult exadult_disable" name="price[query_tours_exadult]" value="<?php echo e($price_data['query_tours_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tours_childbed childbed_disable" name="price[query_tours_childbed]" value="<?php echo e($price_data['query_tours_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tours_childwbed childwbed_disable" name="price[query_tours_childwbed]" value="<?php echo e($price_data['query_tours_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tours_infant infant_disable" name="price[query_tours_infant]" value="<?php echo e($price_data['query_tours_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tours_single single_disable" name="price[query_tours_single]" value="<?php echo e($price_data['query_tours_single']); ?>"></td>
									</tr>

									<!-- Transfers -->
									<tr>
										<td>Transfers</td>
										<td class="makeflex">
											<select class="form-control supplier" id="transfers_fare" name="price[transfers_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['transfers_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[transfers_fare_remarks]" id="remarks_transfers_fare" value="<?php echo e($price_data['transfers_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_transfer_adult" name="price[query_transfer_adult]" value="<?php echo e($price_data['query_transfer_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_exadult exadult_disable" name="price[query_transfer_exadult]" value="<?php echo e($price_data['query_transfer_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_childbed childbed_disable" name="price[query_transfer_childbed]" value="<?php echo e($price_data['query_transfer_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_childwbed childwbed_disable" name="price[query_transfer_childwbed]" value="<?php echo e($price_data['query_transfer_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_infant infant_disable" name="price[query_transfer_infant]" value="<?php echo e($price_data['query_transfer_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_transfer_single single_disable" name="price[query_transfer_single]" value="<?php echo e($price_data['query_transfer_single']); ?>"></td>
									</tr>

									<!-- Visa Charges -->
									<tr>
										<td>Visa Charges</td>
										<td class="makeflex">
											<select class="form-control supplier" id="visa_charges_fare" name="price[visa_charges_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['visa_charges_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="<?php echo e($price_data['visa_charges_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_visa_adult" name="price[query_visa_adult]" value="<?php echo e($price_data['query_visa_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_visa_exadult exadult_disable" name="price[query_visa_exadult]" value="<?php echo e($price_data['query_visa_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_visa_childbed childbed_disable" name="price[query_visa_childbed]" value="<?php echo e($price_data['query_visa_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_visa_childwbed childwbed_disable" name="price[query_visa_childwbed]" value="<?php echo e($price_data['query_visa_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_visa_infant infant_disable" name="price[query_visa_infant]" value="<?php echo e($price_data['query_visa_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_visa_single single_disable" name="price[query_visa_single]" value="<?php echo e($price_data['query_visa_single']); ?>"></td>
									</tr>

									<!-- Travel Insurance -->
									<tr>
										<td>Travel Insurance</td>
										<td class="makeflex">
											<select class="form-control supplier" id="travel_insurance_fare" name="price[travel_insurance_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['travel_insurance_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="<?php echo e($price_data['travel_insurance_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_inc_adult" name="price[query_inc_adult]" value="<?php echo e($price_data['query_inc_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_inc_exadult exadult_disable" name="price[query_inc_exadult]" value="<?php echo e($price_data['query_inc_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_inc_childbed childbed_disable" name="price[query_inc_childbed]" value="<?php echo e($price_data['query_inc_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_inc_childwbed childwbed_disable" name="price[query_inc_childwbed]" value="<?php echo e($price_data['query_inc_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_inc_infant infant_disable" name="price[query_inc_infant]" value="<?php echo e($price_data['query_inc_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_inc_single single_disable" name="price[query_inc_single]" value="<?php echo e($price_data['query_inc_single']); ?>"></td>
									</tr>

									<!--Meals-->
									<tr>
										<td>Meals</td>
										<td class="makeflex">
											<select class="form-control supplier" id="meals_fare" name="price[meals_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['meals_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										<input type="hidden" name="price[meals_fare_remarks]" id="remarks_meals_fare" value="<?php echo e($price_data['meals_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_meals_adult" name="price[query_meals_adult]" value="<?php echo e($price_data['query_meals_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_meals_exadult exadult_disable" name="price[query_meals_exadult]" value="<?php echo e($price_data['query_meals_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_meals_childbed childbed_disable" name="price[query_meals_childbed]" value="<?php echo e($price_data['query_meals_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_meals_childwbed childwbed_disable" name="price[query_meals_childwbed]" value="<?php echo e($price_data['query_meals_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_meals_infant infant_disable" name="price[query_meals_infant]" value="<?php echo e($price_data['query_meals_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_meals_single single_disable" name="price[query_meals_single]" value="<?php echo e($price_data['query_meals_single']); ?>"></td>
									</tr>

									<!--Addon Service-->
									<tr>
										<td>Addon Service</td>
										<td class="makeflex">
											<select class="form-control supplier" id="addon_service_fare" name="price[addon_service_fare_supplier]">
												<option value="0" select_name="0">Select</option>
												<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($price_data['addon_service_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										<input type="hidden" name="price[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="<?php echo e($price_data['addon_service_fare_remarks']); ?>">
										</td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_adult" name="price[query_additionalservice_adult]" value="<?php echo e($price_data['query_additionalservice_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_exadult exadult_disable" name="price[query_additionalservice_exadult]" value="<?php echo e($price_data['query_additionalservice_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_childbed childbed_disable" name="price[query_additionalservice_childbed]" value="<?php echo e($price_data['query_additionalservice_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_childwbed childwbed_disable" name="price[query_additionalservice_childwbed]" value="<?php echo e($price_data['query_additionalservice_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_infant infant_disable" name="price[query_additionalservice_infant]" value="<?php echo e($price_data['query_additionalservice_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_additionalservice_single single_disable" name="price[query_additionalservice_single]" value="<?php echo e($price_data['query_additionalservice_single']); ?>"></td>
									</tr>

									<!--Total before Markup-->
									<tr class="totalDisplay">
										<td>Total</td>
										<td>
										<!--<p class="currencyBox">INR</p>-->
										</td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_adult" name="price[query_tourtotal_adult]" readonly value="<?php echo e($price_data['query_tourtotal_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_exadult" name="price[query_tourtotal_exadult]" readonly value="<?php echo e($price_data['query_tourtotal_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_childbed" name="price[query_tourtotal_childbed]" readonly value="<?php echo e($price_data['query_tourtotal_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_childwbed" name="price[query_tourtotal_childwbed]" readonly value="<?php echo e($price_data['query_tourtotal_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_infant" name="price[query_tourtotal_infant]" readonly value="<?php echo e($price_data['query_tourtotal_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tourtotal_single" name="price[query_tourtotal_single]" readonly value="<?php echo e($price_data['query_tourtotal_single']); ?>"></td>
									</tr>

									<!--Markup-->
									<tr>
										<td class="fontItalic">Markup (Profit)</td>
										<td class="makeflex">
											<select class="fixedValue pricemarkup" name="price[pricemarkup]">
												<option value="0" disabled>Select</option>
												<option value="1" <?php if($price_data['pricemarkup']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['pricemarkup']==2): ?> selected <?php endif; ?>>Percentage</option>
											</select>
											<select class="percentageValue number_test markup_percentage" name="price[markup_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $markup_profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($markup_pro->value); ?>" <?php if($price_data['markup_percentage']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_markup_adult" name="price[query_markup_adult]" value="<?php echo e($price_data['query_markup_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_markup_exadult exadult_disable" name="price[query_markup_exadult]" value="<?php echo e($price_data['query_markup_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_markup_childbed childbed_disable" name="price[query_markup_childbed]" value="<?php echo e($price_data['query_markup_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_markup_childwbed childwbed_disable" name="price[query_markup_childwbed]" value="<?php echo e($price_data['query_markup_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_markup_infant infant_disable" name="price[query_markup_infant]" value="<?php echo e($price_data['query_markup_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_markup_single single_disable" name="price[query_markup_single]" value="<?php echo e($price_data['query_markup_single']); ?>"></td>
									</tr>

									<!--Discount Plus-->
									<tr>
										<td>Discount (+)</td>
										<td class="makeflex">
											<select class="fixedValue pricediscountpositive" name="price[pricediscountpositive]">
												<option value="0">No Discount</option>
												<option value="1" <?php if($price_data['pricediscountpositive']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['pricediscountpositive']==2): ?> selected <?php endif; ?>>Percentage</option>
												<!-- <option value="3" <?php if($price_data['pricediscountpositive']==3): ?> selected <?php endif; ?>>Coupon</option> -->
											</select>
											<select class="percentageValue number_test discountpositive_percentage" name="price[discountpositive_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $discunt_positive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($markup_pro->value); ?>" <?php if($price_data['discountpositive_percentage']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_discount_adult_plus" name="price[query_discount_adult]"  value="<?php echo e($price_data['query_discount_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_exadult_plus exadult_disable" name="price[query_discount_exadult]"  value="<?php echo e($price_data['query_discount_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childbed_plus childbed_disable" name="price[query_discount_childbed]"  value="<?php echo e($price_data['query_discount_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childwbed_plus childwbed_disable" name="price[query_discount_childwbed]"  value="<?php echo e($price_data['query_discount_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_infant_plus infant_disable" name="price[query_discount_infant]"  value="<?php echo e($price_data['query_discount_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_single_plus single_disable" name="price[query_discount_single]"  value="<?php echo e($price_data['query_discount_single']); ?>"></td>
									</tr>

									<!--Total before GST-->
									<tr class="grossTotalDisplay">
										<td class="tourPriceItem">Gross Total</td>
										<td>
										<!--<p class="currencyBox">INR</p>-->
										</td>
										<td><input type="text" class="form-control number_test quote1_gross_total_adult" name="price[query_total_adult]" readonly value="<?php echo e($price_data['query_total_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_exadult" name="price[query_total_exadult]" readonly value="<?php echo e($price_data['query_total_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_childbed" name="price[query_total_childbed]" readonly value="<?php echo e($price_data['query_total_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_childwbed" name="price[query_total_childwbed]" readonly value="<?php echo e($price_data['query_total_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_infant" name="price[query_total_infant]" readonly value="<?php echo e($price_data['query_total_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gross_total_single" name="price[query_total_single]" readonly value="<?php echo e($price_data['query_total_single']); ?>"></td>
									</tr>

									<!--Total Gross Total (Group)-->
									<tr class="grossGroupTotalDisplay">
										<td class="tourPriceItem">Gross Total (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gross_total_group" name="price[query_total_group]" readonly value="<?php echo e($price_data['query_total_group']); ?>"></td>
									</tr>

									<!--Discount Minus-->
									<tr>
										<td>Discount (-)</td>
										<td class="makeflex">
											<select class="fixedValue pricediscountnegative" name="price[pricediscountnegative]">
												<option value="0">No Discount</option>
												<option value="1" <?php if($price_data['pricediscountnegative']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['pricediscountnegative']==2): ?> selected <?php endif; ?>>Percentage</option>
												<option value="3" <?php if($price_data['pricediscountnegative']==3): ?> selected <?php endif; ?>>Coupon</option>
											</select>
											<select class="percentageValue number_test discountnegative_percentage" name="price[discountnegative_percentage]">
												<option value="0">0</option>
												<?php $__currentLoopData = $discunt_negative; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($markup_pro->value); ?>" <?php if($price_data['discountnegative_percentage']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
											<input type="hidden" name="price[coupon_id]" class="coupon_id" value="<?php echo e($price_data['coupon_id']); ?>">
											<select class="percentageValue number_test coupon_percentage" name="price[discount_coupon]">
												<option coupon_id="0" value="0">0</option>
												<?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option coupon_id="<?php echo e($markup_pro->id); ?>" value="<?php echo e($markup_pro->value); ?>"
													<?php if($markup_pro->id==$price_data['coupon_id']): ?> selected <?php endif; ?>><?php echo e($markup_pro->coupon_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_discount_adult_minus" name="price[query_discount_minus_adult]" value="<?php echo e($price_data['query_discount_minus_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_exadult_minus exadult_disable" name="price[query_discount_minus_exadult]" value="<?php echo e($price_data['query_discount_minus_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childbed_minus childbed_disable" name="price[query_discount_minus_childbed]" value="<?php echo e($price_data['query_discount_minus_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_childwbed_minus childwbed_disable" name="price[query_discount_minus_childwbed]" value="<?php echo e($price_data['query_discount_minus_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_infant_minus infant_disable" name="price[query_discount_minus_infant]" value="<?php echo e($price_data['query_discount_minus_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_discount_single_minus single_disable" name="price[query_discount_minus_single]" value="<?php echo e($price_data['query_discount_minus_single']); ?>"></td>
									</tr>

									<!--Total Gross Total (Group)-->
									<tr class="discountGroupTotalDisplay">
										<td class="tourPriceItem">Discount (-) (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_discount_group" name="price[query_total_discount_group]" readonly value="<?php echo e($price_data['query_total_discount_group']); ?>"></td>
									</tr>

									<!--GST-->
									<tr>
										<td class="fontItalic">(+) GST</td>
										<td class="makeflex">
											<select class="fixedValue pricegst" name="price[query_gst_curr]">
												<option value="0" <?php if($price_data['query_gst_curr']==0): ?> selected <?php endif; ?>>Select</option>
												<option value="1" <?php if($price_data['query_gst_curr']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['query_gst_curr']==2): ?> selected <?php endif; ?>>Percentage</option>
											</select>
											<select class="percentageValue number_test gst_percentage" name="price[gst_percentage]">
												<?php $__currentLoopData = $gst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="0">--Select--</option>
												<option value="<?php echo e($gst->value); ?>" <?php if($price_data['gst_percentage']==$gst->value): ?> selected <?php endif; ?>><?php echo e($gst->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_gst_adult" name="price[query_gst_adult]" value="<?php echo e($price_data['query_gst_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gst_exadult exadult_disable" name="price[query_gst_exadult]" value="<?php echo e($price_data['query_gst_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gst_childbed childbed_disable" name="price[query_gst_childbed]" value="<?php echo e($price_data['query_gst_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gst_childwbed childwbed_disable" name="price[query_gst_childwbed]" value="<?php echo e($price_data['query_gst_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gst_infant infant_disable" name="price[query_gst_infant]" value="<?php echo e($price_data['query_gst_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gst_single single_disable" name="price[query_gst_single]" value="<?php echo e($price_data['query_gst_single']); ?>"></td>
									</tr>

									<!--Total GST (Group)-->
									<tr class="gstGroupTotalDisplay">
										<td class="tourPriceItem">GST (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gst_group" name="price[query_total_gst_group]" readonly value="<?php echo e($price_data['query_total_gst_group']); ?>"></td>
									</tr>

									<!--Total Including GST-->
									<tr class="gstTotalDisplay">
										<td class="tourPriceItem">Total with GST</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_adult" name="price[query_gsttotal_adult]" readonly value="<?php echo e($price_data['query_gsttotal_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_exadult" name="price[query_gsttotal_exadult]" readonly value="<?php echo e($price_data['query_gsttotal_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_childbed" name="price[query_gsttotal_childbed]" readonly value="<?php echo e($price_data['query_gsttotal_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_childwbed" name="price[query_gsttotal_childwbed]" readonly value="<?php echo e($price_data['query_gsttotal_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_infant" name="price[query_gsttotal_infant]" readonly value="<?php echo e($price_data['query_gsttotal_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_gsttotal_single" name="price[query_gsttotal_single]" readonly value="<?php echo e($price_data['query_gsttotal_single']); ?>"></td>
									</tr>

									<!--TCS-->
									<tr>
										<td class="fontItalic">(+) TCS</td>
										<td class="makeflex">
											<select class="fixedValue pricetcs" name="price[query_tcs_curr]">
												<option value="0" <?php if($price_data['query_tcs_curr']==0): ?> selected <?php endif; ?>>Select</option>
												<option value="1" <?php if($price_data['query_tcs_curr']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['query_tcs_curr']==2): ?> selected <?php endif; ?>>Percentage</option>
											</select>
											<select class="percentageValue number_test tcs_percentage" name="price[tcs_percentage]">
												<?php $__currentLoopData = $tcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="0">0</option>
												<option value="<?php echo e($tcs->value); ?>" <?php if($price_data['tcs_percentage']==$tcs->value): ?> selected <?php endif; ?>><?php echo e($tcs->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcs_adult" name="price[query_tcs_adult]" value="<?php echo e($price_data['query_tcs_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_exadult exadult_disable" name="price[query_tcs_exadult]" value="<?php echo e($price_data['query_tcs_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_childbed childbed_disable" name="price[query_tcs_childbed]" value="<?php echo e($price_data['query_tcs_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_childwbed childwbed_disable" name="price[query_tcs_childwbed]" value="<?php echo e($price_data['query_tcs_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_infant infant_disable" name="price[query_tcs_infant]" value="<?php echo e($price_data['query_tcs_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcs_single single_disable" name="price[query_tcs_single]" value="<?php echo e($price_data['query_tcs_single']); ?>"></td>
									</tr>

									<!--Total TCS (Group)-->
									<tr class="tcsGroupTotalDisplay">
										<td class="tourPriceItem">TCS (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcs_group" name="price[query_total_tcs_group]" readonly value="<?php echo e($price_data['query_total_tcs_group']); ?>"></td>
									</tr>

									<!--Total Including TCS-->
									<tr class="tcsTotalDisplay">
										<td class="tourPriceItem">Total with TCS</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_adult" name="price[query_tcstotal_adult]" readonly value="<?php echo e($price_data['query_tcstotal_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_exadult" name="price[query_tcstotal_exadult]" readonly value="<?php echo e($price_data['query_tcstotal_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_childbed" name="price[query_tcstotal_childbed]" readonly value="<?php echo e($price_data['query_tcstotal_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_childwbed" name="price[query_tcstotal_childwbed]" readonly value="<?php echo e($price_data['query_tcstotal_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_infant" name="price[query_tcstotal_infant]" readonly value="<?php echo e($price_data['query_tcstotal_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_tcstotal_single" name="price[query_tcstotal_single]" readonly value="<?php echo e($price_data['query_tcstotal_single']); ?>"></td>
									</tr>

									<!--PG Charges Starts-->
									<tr>
										<td class="fontItalic">(+) PG Charges</td>
										<td class="makeflex">
											<select class="fixedValue pricepgcharges" name="price[pg_charges]">
												<option value="0" <?php if($price_data['pg_charges']==0): ?> selected <?php endif; ?>>Select</option>
												<option value="1" <?php if($price_data['pg_charges']==1): ?> selected <?php endif; ?>>Fixed</option>
												<option value="2" <?php if($price_data['pg_charges']==2): ?> selected <?php endif; ?>>Percentage</option>
											</select>
											<select class="percentageValue number_test pgcharges_percentage" name="price[pgcharges_percentage]">
												<option value="0">0</option>										
												<?php $__currentLoopData = $pg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($pg->value); ?>" <?php if($price_data['pgcharges_percentage']==$pg->value): ?> selected <?php endif; ?>><?php echo e($pg->value); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_adult" name="price[query_pgcharges_adult]" value="<?php echo e($price_data['query_pgcharges_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_exadult exadult_disable" name="price[query_pgcharges_exadult]" value="<?php echo e($price_data['query_pgcharges_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_childbed childbed_disable" name="price[query_pgcharges_childbed]" value="<?php echo e($price_data['query_pgcharges_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_childwbed childwbed_disable" name="price[query_pgcharges_childwbed]" value="<?php echo e($price_data['query_pgcharges_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_infant infant_disable" name="price[query_pgcharges_infant]" value="<?php echo e($price_data['query_pgcharges_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_pgcharges_single single_disable" name="price[query_pgcharges_single]" value="<?php echo e($price_data['query_pgcharges_single']); ?>"></td>
									</tr>

									<!--PG Charges Ends-->
									<!--Total PG (Group)-->
									<tr class="pgGrouptTotalDisplay">
										<td class="tourPriceItem">PG (Group)</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_pg_group" name="price[query_total_pg_group]" readonly value="<?php echo e($price_data['query_total_pg_group']); ?>"></td>
									</tr>

									<!--Grand Total-->
									<tr>
										<td class="tourPriceItem">GRAND TOTAL</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_grand_adult" name="price[query_grand_adult]" readonly value="<?php echo e($price_data['query_grand_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_exadult" name="price[query_grand_exadult]" readonly value="<?php echo e($price_data['query_grand_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_childbed" name="price[query_grand_childbed]" readonly value="<?php echo e($price_data['query_grand_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_childwbed" name="price[query_grand_childwbed]" readonly value="<?php echo e($price_data['query_grand_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_infant" name="price[query_grand_infant]" readonly value="<?php echo e($price_data['query_grand_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_single" name="price[query_grand_single]" readonly value="<?php echo e($price_data['query_grand_single']); ?>"></td>
									</tr>

									<!--Grand Total According to number of person-->
									<tr>
										<td class="tourPriceItem">PAY Total</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td><input type="text" class="form-control number_test quote1_grand_adult_with_person" name="price[query_paytotal_adult]" readonly value="<?php echo e($price_data['query_paytotal_adult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_exadult_with_person" name="price[query_paytotal_exadult]" readonly value="<?php echo e($price_data['query_paytotal_exadult']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_childbed_with_person" name="price[query_paytotal_childbed]" readonly value="<?php echo e($price_data['query_paytotal_childbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_childwbed_with_person " name="price[query_paytotal_childwbed]" readonly value="<?php echo e($price_data['query_paytotal_childwbed']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_infant_with_person" name="price[query_paytotal_infant]" readonly value="<?php echo e($price_data['query_paytotal_infant']); ?>"></td>
										<td><input type="text" class="form-control number_test quote1_grand_single_with_person" name="price[query_paytotal_single]" readonly value="<?php echo e($price_data['query_paytotal_single']); ?>"></td>
									</tr>

									<!--Price to Pay-->
									<tr>
										<td class="tourPriceItem">Price To PAY</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td class="pricetoPay"><input type="text" class="form-control query_pricetopay quote1_pricetopay" id="option1_mandate" name="price[query_pricetopay_adult]" readonly value="<?php echo e($price_data['query_pricetopay_adult']); ?>"></td>
									</tr>
									
									
								</tbody>
							</table>

							<!-- part payment -->
							<div class="backend_custom_height item-container">
								<div class="partPayment">
									<label for="partPayment">Part Payment?</label>
									<input type="checkbox" name="partPayment" value="1" id="show_part_payment" class="show_part_payment" <?php if($packagesData->partPayment==1): ?> checked <?php endif; ?> >
								</div>

								<table class="part_payment table backend_custom_height table-bordered table-striped" <?php if($packagesData->partPayment==1): ?> style="display:block" <?php else: ?> style="display:none" <?php endif; ?>>
									<thead class="thead-dark">
										<tr>
											<th scope="col">Payment Type</th>
											<th scope="col">Price Type</th>
											<th scope="col">Payable Amount</th>
											<th scope="col">Pay Within</th>
											<th scope="col">Payment Date</th>
										</tr>
									</thead>

									<?php
										$part_payments=unserialize($packagesData->part_payments);
										$part_payments_sec=CustomHelpers::part_payments($packagesData->part_payments,$price_data['query_pricetopay_adult']);
									?>
		              				<tbody>

										<!--Advance Payment-->
										<tr>
											<td class="tourPriceItem">Advance Payment</td>

											<td class="makeflex">
												<select class="fixedValue advance_payment" name="part_payments[adv_type]" style="display: none;">
													<!-- <option value="1" <?php if($part_payments['adv_type']==1): ?> selected <?php endif; ?>>Fixed</option> -->
													<option value="2" <?php if($part_payments_sec['adv_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>
												<select name="part_payments[adv_percentage]" class="form-control number_test advance_payment_percentage">
												    <?php for($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo e($i); ?>" 
												            <?php if(isset($part_payments_sec['adv_percentage']) && $part_payments_sec['adv_percentage'] == $i): ?> 
												                selected 
												            <?php endif; ?>>
												            <?php echo e($i); ?>%
												        </option>
												    <?php endfor; ?>
												</select>

												<span id="quote1_advance_payment_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" name="part_payments[adv_amount]" class="form-control number_test quote1_advance_payment" value="<?php echo e($part_payments_sec['adv_amount']); ?>" readonly>
												<span id="quote1_advance_payment_error anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[adv_days]" class="days_data" <?php if(is_array($part_payments) && array_key_exists('adv_days',$part_payments)): ?> 
value="<?php echo e($part_payments["adv_days"]); ?>" 
												

												 <?php endif; ?>>
												<select  class="form-control payment_days">
													<option value="" disabled>Duration</option>
		                                            <?php for($i=1;$i<=$difference;$i++): ?>
		                                         		<option value="<?php echo e($i); ?>" <?php if(array_key_exists('adv_days',$part_payments) && $part_payments["adv_days"]==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> Days</option>
		                                            <?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[adv_date]" class="form-control payment_date datepicker_adv" <?php if($packagesData->part_payments!='' && array_key_exists('adv_date',$part_payments)): ?> value="<?php echo e($part_payments['adv_date']); ?>" <?php endif; ?>>
											</td>
										</tr>

										<!--1st Part Payment-->
										<tr>
											<td class="tourPriceItem">1st Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue first_part_payment" name="part_payments[first_part_type]" style="display: none;">
													<!-- <option value="1" <?php if($part_payments['first_part_type']==1): ?> selected <?php endif; ?>>Fixed</option> -->
													<option value="2" <?php if($part_payments_sec['first_part_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>

												<select class="form-control number_test first_part_percentage" name="part_payments[first_part_percentage]">
												    <option value="" disabled>0%</option>
												    <?php for($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo e($i); ?>" 
												            <?php echo e(isset($part_payments['first_part_percentage']) && $part_payments['first_part_percentage'] == $i ? 'selected' : ''); ?>>
												            <?php echo e($i); ?>%
												        </option>
												    <?php endfor; ?>
												</select>


												<span id="first_part_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_first_part" name="part_payments[first_part_amount]" value="<?php echo e($part_payments_sec['first_part_amount']); ?>">
												<span id="quote1_first_part_error" class="anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[first_part_days]" class="days_data" <?php if(is_array($part_payments) && array_key_exists('first_part_days',$part_payments)): ?> 
value="<?php echo e($part_payments["first_part_days"]); ?>" 
												

												 <?php endif; ?>>           
												<select name="part_payments[first_part_days]" class="form-control payment_days" id="first_payment_days">
													<option value="">--Select Days--</option>
													<?php for($i=1;$i<=$difference;$i++): ?>
														<option value="<?php echo e($i); ?>" 
											                <?php if(array_key_exists('first_part_days', $part_payments) && $part_payments['first_part_days'] == $i): ?> selected <?php endif; ?>>
											                <?php echo e($i); ?> Days
											            </option>
													<?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[first_part_date]" class="form-control payment_date  datepicker_first_payment" <?php if($packagesData->part_payments!='' && array_key_exists('first_part_date',$part_payments)): ?> value="<?php echo e($part_payments['first_part_date']); ?>" <?php endif; ?>>
											</td>
										</tr>

										<!--2nd Part Payment-->
										<tr class="">
											<td class="tourPriceItem">2nd Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue second_part_payment" name="part_payments[second_part_type]" style="display: none;">
													<!-- <option value="1" <?php if($part_payments['second_part_type']==1): ?> selected <?php endif; ?>>Fixed</option> -->
													<option value="2" <?php if($part_payments_sec['second_part_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>

												<select class="form-control number_test second_part_percentage" name="part_payments[second_part_percentage]" disabled>
												    <?php for($i = 0; $i <= 100; $i++): ?>
												        <option value="<?php echo e($i); ?>" 
												            <?php if(isset($part_payments_sec['second_part_percentage']) && $part_payments_sec['second_part_percentage'] == $i): ?> 
												                selected 
												            <?php endif; ?>>
												            <?php echo e($i); ?>%
												        </option>
												    <?php endfor; ?>
												</select>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_second_part" name="part_payments[second_part_amount]" value="<?php echo e($part_payments_sec['second_part_amount']); ?>">
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="part_payments[second_part_days]" class="days_data" <?php if(is_array($part_payments) && array_key_exists('second_part_days',$part_payments)): ?> 
value="<?php echo e($part_payments["second_part_days"]); ?>" 
												

												 <?php endif; ?>>
												<select name="part_payments[second_part_days]" class="form-control payment_days" id="second_payment_days">
													<option value="">--Select Days--</option>
													<?php for($i=1;$i<=$difference;$i++): ?>
														<option value="<?php echo e($i); ?>" 
															<?php if(array_key_exists('second_part_days', $part_payments) && $part_payments['second_part_days'] == $i): ?> selected <?php endif; ?>>
											                <?php echo e($i); ?> Days
											            </option>
													<?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="part_payments[second_part_date]" class="form-control payment_date  datepicker_second_payment" <?php if($packagesData->part_payments!='' && array_key_exists('second_part_date',$part_payments)): ?> value="<?php echo e($part_payments['second_part_date']); ?>" <?php endif; ?>>
											</td>
										</tr>

										<!--Total Payment-->
										<tr class="">
											<td class="tourPriceItem">Total Payment</td>
											<td>
												<p class="currencyBox">INR</p>
											</td>
											<td>
												<input type="text" class="form-control query_pricetopay quote1_total_payment" id="quote1_total_payment" name="part_payments[total_installment]" readonly value="<?php echo e(round($price_data['query_pricetopay_adult'])); ?>" oncontextmenu="return false;">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
<!--payment cancellation-->
<div class="backend_custom_height item-container">
								<div class="partPayment">
									<label for="cancellPayment">Cancellation Payment ?</label>
									<input type="checkbox" name="refundPaymentCheckbox" value="1" id="show_refund_payment" class="show_refund_payment" <?php if($packagesData->refundPaymentCheckbox==1): ?> checked <?php endif; ?>>
								</div>
								<!-- part payment details -->
								<table class="refund_payment table backend_custom_height table-bordered table-striped" <?php if($packagesData->refundPaymentCheckbox==1): ?> style="display:block" <?php else: ?> style="display:none" <?php endif; ?>>
									<thead class="thead-dark">
								        <tr>
								            <th scope="col">Payment Type</th>
								            <th scope="col">Price Type</th>
								            <th scope="col">Payable Amount</th>
								            <th scope="col">Refund Within</th>
								            <th scope="col">Payment Date</th>
								        </tr>
								    </thead>
								    <?php
$refund_payments=unserialize($packagesData->refund_payments);

$refund_payments_sec=CustomHelpers::refund_payments($packagesData->refund_payments,$price_data['query_pricetopay_adult']);
?>
									<tbody>

										<!--Advance Payment-->
										<tr>
											<td class="tourPriceItem">Advance Payment</td>

											<td class="makeflex">
												<select class="fixedValue advance_refund_payment" name="refund_payments[adv_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2" <?php if($refund_payments_sec['adv_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>
												<!-- <input type="text" name="part_payments[adv_percentage]" class="form-control percentageValue number_test advance_payment_percentage"> -->
												<select name="refund_payments[adv_percentage]" class="form-control percentageValue number_test refund_advance_payment_percentage">
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo e($i); ?>" 
<?php if(isset($refund_payments_sec['adv_percentage']) && $refund_payments_sec['adv_percentage'] == $i): ?> 
selected 
<?php endif; ?>>
<?php echo e($i); ?>%
</option>s
												    <?php endfor; ?>
												</select>

												<span id="quote1_refund_advance_payment_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" name="refund_payments[adv_amount]" class="form-control number_test quote1_refund_advance_payment" value="<?php echo e($refund_payments_sec['adv_amount']); ?>" readonly>
												<span id="quote1_refund_advance_payment_error anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[adv_days]" class="days_data" <?php if(is_array($refund_payments) && array_key_exists('adv_days',$refund_payments)): ?> 
value="<?php echo e($refund_payments["adv_days"]); ?>" 
												

												 <?php endif; ?>>   
												<select  class="form-control payment_days">
													<option value="" disabled>Duration</option>
		                                            <?php for($i=1;$i<=$difference;$i++): ?>
		                          <option value="<?php echo e($i); ?>" <?php if(is_array($refund_payments) && array_key_exists('adv_days',$refund_payments) && $refund_payments["adv_days"]==$i): ?> selected <?php endif; ?>><?php echo e($i); ?> Days
		                          </option>
		                                            <?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[adv_date]" class="form-control payment_date datepicker_adv_refund" <?php if($packagesData->refund_payments!='' && array_key_exists('adv_date',$refund_payments)): ?> value="<?php echo e($refund_payments['adv_date']); ?>" <?php endif; ?>>
											</td>
										</tr>

										<!--1st Part Payment-->
										<tr>
											<td class="tourPriceItem">1st Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue first_part_refund_payment" name="refund_payments[first_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2" <?php if($refund_payments_sec['first_part_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test first_part_percentage" name="part_payments[first_part_percentage]"> -->
												<select class="form-control number_test first_part_refund_percentage" name="refund_payments[first_part_percentage]" >
												    <option value="" disabled>0%</option>
												    <?php for ($i = 1; $i <= 100; $i++): ?>
												        <option value="<?php echo e($i); ?>" 
<?php echo e(isset($refund_payments['first_part_percentage']) && $refund_payments['first_part_percentage'] == $i ? 'selected' : ''); ?>>
<?php echo e($i); ?>%
</option>
												    <?php endfor; ?>
												</select>
												<span id="first_part_refund_percentage" class="anyError"></span>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_first_part_refund" name="refund_payments[first_part_amount]" value="<?php echo e($refund_payments_sec['first_part_amount']); ?>" readonly>
												<span id="quote1_first_part_refund_error" class="anyError"></span>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[first_part_days]" id="first_part_refund_days" class="days_data" <?php if(is_array($refund_payments) && array_key_exists('first_part_days',$refund_payments)): ?> 
value="<?php echo e($refund_payments["first_part_days"]); ?>" 
												

												 <?php endif; ?>>  
												<select class="form-control payment_days" id="first_refund_payment_days">
		                                           <option value="">--Select Days--</option>
<?php for($i=1;$i<=$difference;$i++): ?>
<option value="<?php echo e($i); ?>" 
<?php if(is_array($refund_payments) && array_key_exists('first_part_days', $refund_payments) && $refund_payments['first_part_days'] == $i): ?> selected <?php endif; ?>>
<?php echo e($i); ?> Days
</option>
<?php endfor; ?>

												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[first_part_date]" class="form-control payment_date  datepicker_first_refund_payment" <?php if($packagesData->refund_payments!='' && array_key_exists('first_part_date',$refund_payments)): ?> value="<?php echo e($refund_payments['first_part_date']); ?>" <?php endif; ?>>
											</td>
										</tr>

										<!--2nd Part Payment-->
										<tr>
											<td class="tourPriceItem">2nd Part Payment</td>

											<td class="makeflex">
												<select class="fixedValue second_part_refund_payment" name="refund_payments[second_part_type]" style="display: none;">
													<!-- <option value="1">Fixed</option> -->
													<option value="2" <?php if($refund_payments_sec['second_part_type']==2): ?> selected <?php endif; ?>>Percentage</option>
												</select>

												<!-- <input type="text" class="form-control percentageValue number_test second_part_percentage" name="part_payments[second_part_percentage]"> -->
												<select class="form-control number_test second_part_percentage_refund" name="refund_payments[second_part_percentage]" disabled>
												   <?php for($i = 0; $i <= 100; $i++): ?>
<option value="<?php echo e($i); ?>" 
<?php if(isset($refund_payments_sec['second_part_percentage']) && $refund_payments_sec['second_part_percentage'] == $i): ?> 
selected 
<?php endif; ?>>
<?php echo e($i); ?>%
</option>
<?php endfor; ?>
												</select>
											</td>

											<td>
												<input type="text" class="form-control number_test quote1_second_part_refund" name="refund_payments[second_part_amount]" value="<?php echo e($refund_payments_sec['second_part_amount']); ?>" readonly>
											</td>

											<td class="payment_days_parent">
												<input type="hidden" name="refund_payments[second_part_days]" id="second_part_days_refund" class="days_data" <?php if(is_array($refund_payments) && array_key_exists('second_part_days',$refund_payments)): ?> 
value="<?php echo e($refund_payments["second_part_days"]); ?>" 
												

												 <?php endif; ?>>
												<select class="form-control payment_days" id="second_refund_payment_days">
													<?php for($i=1;$i<=$difference;$i++): ?>
<option value="<?php echo e($i); ?>" 
<?php if(is_array($refund_payments) && array_key_exists('second_part_days', $refund_payments) && $refund_payments['second_part_days'] == $i): ?> selected <?php endif; ?>>
<?php echo e($i); ?> Days
</option>
<?php endfor; ?>
												</select>
											</td>

											<td class="payment_date_parent">
												<input type="text" name="refund_payments[second_part_date]" class="form-control payment_date  datepicker_second_payment_refund"  <?php if($packagesData->refund_payments!='' && array_key_exists('second_part_date',$refund_payments)): ?> value="<?php echo e($refund_payments['second_part_date']); ?>" <?php endif; ?> />
											</td>
										</tr>

										<!--Total Payment-->
										<tr class="">
											<td class="tourPriceItem">Total Payment</td>
											<td>
												<p class="currencyBox">INR</p>
											</td>
											<td>
												<input type="text" class="form-control query_pricetopay quote1_total_payment_refund" name="refund_payments[total_installment]" readonly oncontextmenu="return false;" value="<?php echo e(round($price_data['query_pricetopay_adult'])); ?>" /></td>
										</tr>
									</tbody>
								</table>
							</div>
							<!-- pay at hotel -->
							<div class="backend_custom_height item-container">
								<div class="directPayment">
									<label for="directPayment">Pay at Hotel (not included in above price)?</label>
									<input type="checkbox" name="directPayment" value="1" id="show_direct_part"  <?php if($packagesData->directPayment==1): ?> checked <?php endif; ?>>
								</div>

								<table class="direct_part table backend_custom_height table-bordered table-striped" <?php if($packagesData->directPayment==1): ?> style="display:block" <?php else: ?> style="display:none" <?php endif; ?>>

									<thead class="thead-dark">
										<tr>
											<th>Payment Type</th>
											<th>Price Type</th>
											<th>Currency / Amount (all travellers)</th>
										</tr>
									</thead>

									<?php
										$directPayments=unserialize($packagesData->directPayments);
									?>
									<tbody>

										<!--1st Direct Pay-->
										<tr>
											<td>
												<select class="form-control" name="directPayments[type]">
													<option value="">Select</option>
													<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>" <?php if($directPayments['type']==$payathotelsdata->id): ?> selected <?php endif; ?>><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													
												</select>
											</td>

											<td>
												<input type="text" class="form-control" name="directPayments[pricetype]" value="Fixed" value="<?php echo e($directPayments['pricetype']); ?>" readonly />
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="directPayments[currency]" value="INR" value="<?php echo e($directPayments['currency']); ?>" style="max-width: 50px;" readonly />
											
												<input type="text" class="form-control number_test" name="directPayments[amount]" value="<?php echo e($directPayments['amount']); ?>" />
											</td>
										</tr>

										<!--2nd Direct Pay-->
										<tr>
											<td>
												<?php
													$second_directPayments=unserialize($packagesData->second_directPayments);
												?>
												<select class="form-control" name="second_directPayments[type]">
													<option value="">Select</option>
													<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>" <?php if($second_directPayments['type']==$payathotelsdata->id): ?> selected <?php endif; ?>><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

													
												</select>
											</td>

											<td>
												<input type="text" class="form-control" name="second_directPayments[pricetype]" value="Fixed" readonly value="<?php echo e($second_directPayments['amount']); ?>" />
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="second_directPayments[currency]" value="INR" value="<?php echo e($second_directPayments['currency']); ?>" style="max-width: 50px;" readonly />
											
												<input type="text" class="form-control number_test" name="second_directPayments[amount]" value="<?php echo e($second_directPayments['amount']); ?>" />
											</td>
										</tr>

										<!--3rd Direct Pay-->
										<tr>
											<td>
												<?php
													$third_directPayments=unserialize($packagesData->third_directPayments);
												?>
												<select class="form-control" name="third_directPayments[type]">
													<option value="">Select</option>
													<?php $__currentLoopData = $payathotelsdatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payathotelsdata): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<option value="<?php echo e($payathotelsdata->id); ?>" <?php if($third_directPayments['type']==$payathotelsdata->id): ?> selected <?php endif; ?>><?php echo e($payathotelsdata->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


													
												</select>
											</td>

											<td>
												<input type="text" class="form-control" name="third_directPayments[pricetype]" value="Fixed" value="<?php echo e($third_directPayments['pricetype']); ?>">
											</td>

											<td class="makeflex" style="column-gap: 5px;">
												<input type="text" class="form-control number_test" name="third_directPayments[currency]" value="INR" style="max-width: 50px;" readonly />
											
												<input type="text" class="form-control number_test" name="third_directPayments[amount]" value="<?php echo e($third_directPayments['amount']); ?>">
											</td>
										</tr>
									</tbody>
								</table>
							</div>
