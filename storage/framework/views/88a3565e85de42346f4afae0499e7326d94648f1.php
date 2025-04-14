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

								<!-- Airfare -->
								<tr>
                        <td>Airfare</td>
                        <td class="makeflex">
                            <select class="form-control supplier" name="price[quote_airfare]" id="airfare">
                                <option value="0" select_name="0">Select</option>
                                <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if(isset($price_data['quote_airfare']) && $price_data['quote_airfare'] == $suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                            <input type="hidden" name="price[quote_airfare_remarks]" id="remarks_airfare" value="<?php echo e($price_data['quote_airfare_remarks'] ?? ''); ?>">
                        </td>
                        <td><input type="text" class="form-control number_test quote1_air_adult" name="price[query_air_adult]" value="<?php echo e($price_data['query_air_adult'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_air_exadult exadult_disable" name="price[query_air_exadult]" value="<?php echo e($price_data['query_air_exadult'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_air_childbed childbed_disable" name="price[query_air_childbed]" value="<?php echo e($price_data['query_air_childbed'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_air_childwbed childwbed_disable" name="price[query_air_childwbed]" value="<?php echo e($price_data['query_air_childwbed'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_air_infant infant_disable" name="price[query_air_infant]" value="<?php echo e($price_data['query_air_infant'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_air_single single_disable" name="price[query_air_single]" value="<?php echo e($price_data['query_air_single'] ?? ''); ?>"></td>
                    </tr>

                    <!-- Cruise Fare -->
                    <tr>
                        <td>Cruise Fare</td>
                        <td class="makeflex">
                            <select class="form-control supplier" name="price[quote_cruise_fare]" id="cruise_fare">
                                <option value="0" select_name="0 0">Select</option>
                                <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if(isset($price_data['quote_cruise_fare']) && $price_data['quote_cruise_fare'] == $suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                            <input type="hidden" name="price[quote_cruise_fare_remarks]" id="remarks_cruise_fare" value="<?php echo e($price_data['quote_cruise_fare_remarks'] ?? ''); ?>">
                        </td>
                        <td><input type="text" class="form-control number_test quote1_cruise_adult" name="price[query_cruise_adult]" value="<?php echo e($price_data['query_cruise_adult'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]" value="<?php echo e($price_data['query_cruise_exadult'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]" value="<?php echo e($price_data['query_cruise_childbed'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]" value="<?php echo e($price_data['query_cruise_childwbed'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]" value="<?php echo e($price_data['query_cruise_infant'] ?? ''); ?>"></td>
                        <td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]" value="<?php echo e($price_data['query_cruise_single'] ?? ''); ?>"></td>
                    </tr>
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
