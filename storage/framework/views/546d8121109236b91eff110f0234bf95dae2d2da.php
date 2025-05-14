						<div class="row">

                            <!-- add rooms -->
							<div class="col-md-12">
								<div class="add-room-wrapper">
									<div class="col-md-12">
										<div class="form-group">
											<div class="title">Add Rooms</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="field-required">Display Price (frontend)</label>
											<select class="form-control" name="show_status">
												<option value="1" <?php if($packagesData->show_status==1): ?> selected <?php endif; ?>>Show</option>
												<option value="0" <?php if($packagesData->show_status==0): ?> selected <?php endif; ?>>Hide</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="field-required">No of Rooms</label>
											<select class="form-control select_room" name="no_of_room">
												<?php for($i=1; $i<=10; $i++): ?>
													<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
												<?php endfor; ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="field-required">Total Rooms & Guests</label>
											<input type="text" class="form-control packages_pop_passenger_value" value="1 Room (2 Adults)" id="" readonly>
										</div>
									</div>


									<!-- ******************** -->

									<!-- add guest in room -->
									<div class="dynamic_four" id="dynamic_four">
										<?php $rooms=unserialize($packagesData->room); ?>
										<?php if($rooms!=''): ?>
											<?php
												$m=1;
												$k=0;
											?>
											<?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($m>1): ?>
												<div id="fourrow<?php echo e($i); ?>">
													<div class="col-md-12">
														<div class="room-container">
															<div>
																<!-- room no -->
																<div>
																	<div class="title">Room <?php echo e($m); ?></div>
																</div>

																<!-- guest allowed in a room -->
																<div class="makeflex align-center">
																	<label class="field-required">Max. guests allowed</label>
																	<select class="form-control apndLft5 max_passenger" name="room[<?php echo e($k); ?>][max_passenger]" style="max-width: 90px;border-radius: 3px;">
																		<?php for($i=1; $i<=10; $i++): ?>
																			<option value="<?php echo e($i); ?>" <?php if($i==$col['max_passenger']): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
																		<?php endfor; ?>
																	</select>
																</div>

																<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][twin_adult_room]" class="twin_adult_room_value" value="<?php echo e($col['twin_adult_room']); ?>">
																			<span class="travellersMinus twin_adult_room_dec">−</span>
																			<span class="travellersValue twin_adult_room_result"><?php echo e($col['twin_adult_room']); ?></span>
																			<span class="travellersPlus twin_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][extra_adult_room]" class="extra_adult_room_value" value="<?php echo e($col['extra_adult_room']); ?>">
																			<span class="travellersMinus extra_adult_room_dec">−</span>
																			<span class="travellersValue extra_adult_room_result"><?php echo e($col['extra_adult_room']); ?></span>
																			<span class="travellersPlus extra_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][child_with_bed_room]" class="child_with_bed_room_value" value="<?php echo e($col['child_with_bed_room']); ?>">
																			<span class="travellersMinus child_with_bed_room_dec">−</span>
																			<span class="travellersValue child_with_bed_room_result"><?php echo e($col['child_with_bed_room']); ?></span>
																			<span class="travellersPlus child_with_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][child_without_bed_room]" class="child_without_bed_room_value" value="<?php echo e($col['child_without_bed_room']); ?>">
																			<span class="travellersMinus child_without_bed_room_dec">−</span>
																			<span class="travellersValue child_without_bed_room_result"><?php echo e($col['child_without_bed_room']); ?></span>
																			<span class="travellersPlus child_without_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][infant_room]" class="span_value_child_with_bed infant_room_value" value="<?php echo e($col['infant_room']); ?>">
																			<span class="travellersMinus infant_room_dec">−</span>
																			<span class="travellersValue infant_room_result"><?php echo e($col['infant_room']); ?></span>
																			<span class="travellersPlus infant_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][single_room]" class="single_room_value" value="<?php echo e($col['single_room']); ?>">
																			<span class="travellersMinus single_room_dec">−</span>
																			<span class="travellersValue single_room_result"><?php echo e($col['single_room']); ?></span>
																			<span class="travellersPlus single_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Single<br>(+12yrs)</p>
																	</div>
																</div>

																<!-- add more rooms -->
																<div class="text-center">
																	<button type="button" name="remove" id="<?php echo e($i); ?>" class="btn btn-danger btn_remove_four" style="margin-bottom: 5px">x Remove </button>
																</div>
															</div>
														</div>
													</div>
													<!-- </div> -->
												</div>
												<?php else: ?>
												<div id="fourrow<?php echo e($i); ?>">
													<!-- <div class="row"> -->
													<div class="col-md-12">
														<div class="room-container">
															<div>
																<!-- room no -->
																<div class="">
																	<div class="title">Room <?php echo e($m); ?></div>
																</div>

																<!-- guest allowed in a room -->
																<div class="makeflex align-center">
																	<label class="field-required">Max. guests allowed</label>
																	<select class="form-control apndLft5 max_passenger" name="room[<?php echo e($k); ?>][max_passenger]">
																		<?php for($i=1; $i<=10; $i++): ?>
																			<option value="<?php echo e($i); ?>" <?php if($i==$col['max_passenger']): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
																		<?php endfor; ?>
																	</select>
																</div>

																<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][twin_adult_room]" class="twin_adult_room_value" value="<?php echo e($col['twin_adult_room']); ?>">
																			<span class="travellersMinus twin_adult_room_dec">−</span>
																			<span class="travellersValue twin_adult_room_result"><?php echo e($col['twin_adult_room']); ?></span>
																			<span class="travellersPlus twin_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][extra_adult_room]" class="extra_adult_room_value" value="<?php echo e($col['extra_adult_room']); ?>">
																			<span class="travellersMinus extra_adult_room_dec">−</span>
																			<span class="travellersValue extra_adult_room_result"><?php echo e($col['extra_adult_room']); ?></span>
																			<span class="travellersPlus extra_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][child_with_bed_room]" class="child_with_bed_room_value" value="<?php echo e($col['child_with_bed_room']); ?>">
																			<span class="travellersMinus child_with_bed_room_dec">−</span>
																			<span class="travellersValue child_with_bed_room_result"><?php echo e($col['child_with_bed_room']); ?></span>
																			<span class="travellersPlus child_with_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][child_without_bed_room]" class="child_without_bed_room_value" value="<?php echo e($col['child_without_bed_room']); ?>">
																			<span class="travellersMinus child_without_bed_room_dec">−</span>
																			<span class="travellersValue child_without_bed_room_result"><?php echo e($col['child_without_bed_room']); ?></span>
																			<span class="travellersPlus child_without_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][infant_room]" class="span_value_child_with_bed infant_room_value" value="<?php echo e($col['infant_room']); ?>">
																			<span class="travellersMinus infant_room_dec">−</span>
																			<span class="travellersValue infant_room_result"><?php echo e($col['infant_room']); ?></span>
																			<span class="travellersPlus infant_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[<?php echo e($k); ?>][single_room]" class="single_room_value" value="<?php echo e($col['single_room']); ?>">
																			<span class="travellersMinus single_room_dec">−</span>
																			<span class="travellersValue single_room_result"><?php echo e($col['single_room']); ?></span>
																			<span class="travellersPlus single_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Single<br>(+12yrs)</p>
																	</div>
																</div>

																<!-- add more rooms -->
																<div class="text-center">
																	<button id="add_certification" class="btn btn-info rightFloat"><span class="fa fa-plus"></span>&nbsp;Add more rooms</button>
																</div>
															</div>
														</div>
													</div>
													<!-- </div> -->
												</div>
											<?php endif; ?>
											<?php
												$m++;
												$k++;
											?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php else: ?>
											<div id="fourrow1">
												<div class="col-md-12">
													<div class="room-container">
														<!-- room no -->											
														<div class="">
															<div class="title">Room 1</div>
														</div>

														<!-- guest allowed in a room -->
														<div class="makeflex align-center">
															<label class="field-required">Max. guests allowed</label>
															<select class="form-control apndLft5 max_passenger" name="room[0][max_passenger]" style="max-width: 90px;border-radius: 3px;">
																<?php for($i=1; $i<=10; $i++): ?>
																	<option value="<?php echo e($i); ?>" <?php if($i==7): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
																<?php endfor; ?>
															</select>
														</div>

														<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][twin_adult_room]" class="twin_adult_room_value" value="2" />
																	<span class="travellersMinus twin_adult_room_dec">−</span>
																	<span class="travellersValue twin_adult_room_result">2</span>
																	<span class="travellersPlus twin_adult_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
															</div>
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][extra_adult_room]" class="extra_adult_room_value" value="0" />
																	<span class="travellersMinus extra_adult_room_dec">−</span>
																	<span class="travellersValue extra_adult_room_result">0</span>
																	<span class="travellersPlus extra_adult_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
															</div>
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][child_with_bed_room]" class="child_with_bed_room_value" value="0" />
																	<span class="travellersMinus child_with_bed_room_dec">−</span>
																	<span class="travellersValue child_with_bed_room_result">0</span>
																	<span class="travellersPlus child_with_bed_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
															</div>
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][child_without_bed_room]" class="child_without_bed_room_value" value="0" />
																	<span class="travellersMinus child_without_bed_room_dec">−</span>
																	<span class="travellersValue child_without_bed_room_result">0</span>
																	<span class="travellersPlus child_without_bed_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
															</div>
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][infant_room]" class="span_value_child_with_bed infant_room_value" value="0" />
																	<span class="travellersMinus infant_room_dec">−</span>
																	<span class="travellersValue infant_room_result">0</span>
																	<span class="travellersPlus infant_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
															</div>
															<div>
																<div class="addTravellerValue">
																	<input type="hidden" id="travellers" name="room[0][single_room]" class="single_room_value" value="0" />
																	<span class="travellersMinus single_room_dec">−</span>
																	<span class="travellersValue single_room_result">0</span>
																	<span class="travellersPlus single_room_inc">+</span>
																</div>
																<p class="itemBottomHeading">Single<br>(+12yrs)</p>
															</div>
														

														<!-- add more rooms -->
														<div class="text-center">
															<button id="add_certification" class="btn btn-info rightFloat"><span class="fa fa-plus"></span>&nbsp;Add more rooms</button>
														</div>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>

							<!-- ******************** -->

							<!-- pricing -->
							<?php 
							$new_price=PackagePriceHelpers::get_package_new_price(
									$packagesData->newprices,
									$packagesData->adult,
									$packagesData->extra_adult,
									$packagesData->child_with_bed,
									$packagesData->child_without_bed,
									$packagesData->infant,
									$packagesData->solo_traveller);

				
							?>

							<!-- add price -->
							<div class="col-md-12">
								<div class="add-room-wrapper">
									<div class="col-md-12">
										<div class="form-group">
											<div class="title">Add Price</div>
										</div>
									</div>

									<!-- price type -->
									<div class="col-md-3">
										<div class="form-group">
											<label class="field-required">Price Type</label>
											<select class="form-control backgroundColorF2 price_type" name="price_type">
												<option value="1" <?php if($packagesData->Price_type=="Per Person" || $packagesData->Price_type=="1"): ?> selected="selected" <?php endif; ?> >Per Person</option>
												<option value="2" <?php if($packagesData->Price_type=="Per Group" || $packagesData->Price_type=="2"): ?> selected="selected" <?php endif; ?>>Per Group</option>
											</select>
										</div>
									</div>

									<!-- select price tag -->
									<div class="col-md-3">
										<div class="form-group">
											<label class="field-required">Price Type Tag</label>
											<select class="form-control" name="priceremarks">
												<option value="Price Per Person" <?php if($packagesData->priceremarks=="Price Per Person"): ?> selected="selected" <?php endif; ?>>Price Per Person (inclusive of taxes)</option>
												<option value="Price Group" <?php if($packagesData->priceremarks=="Price Group"): ?> selected="selected" <?php endif; ?>>Price for all Person (inclusive of taxes)</option>
											</select>
										</div>
									</div>

									<!-- remarks -->
									<div class="col-md-3">
										<div class="form-group">
											<label>Remarks</label>
											<input type="text" name="remarks" class="form-control" placeholder="Enter price remarks (if any) ..." value="<?php echo e($packagesData->anything); ?>">
										</div>
									</div>

									<!-- total guest count -->
									<div class="col-md-3">
										<div class="form-group">
											<label>Total Rooms & Guests</label>
											<input type="text" placeholder="1 Room (2 Adults,0 Child,0 Infant)" value="1 Room (2 Adults,0 Child,0 Infant)" class="form-control packages_pop_passenger_value" readonly>
										</div>
									</div>
								

									<!-- ----------- -->

									<!-- pricing table -->
									<table class="table backend_custom_height">
										<thead>
											<tr>
												<th>
													<p class="quoteCurrency">INR</p>
													<p class="itemBottomHeading">Quote Currency</p>
												</th>
												<th>
													<p class="itemTopHeading">CALCULATOR</p>
													<div class="currencyConversion">
														<select class="form-control package_air_curr" name="currency">
															<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
															<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($packagesData->currency==$rate->id): ?> selected <?php endif; ?>><?php echo e($rate-> currency); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
															</option>
														</select>
														<input type="text" name="roe" class="form-control packages_rate number_test" placeholder="ROE" value="<?php echo e($packagesData->roe); ?>">
													</div>
													<div class="currencyConversion">
														<input type="text" value="<?php echo e($packagesData->indian_rate); ?>" name="indian_rate" class="form-control packages_value number_test" placeholder="Enter">
														<input type="text"  value="<?php echo e($packagesData->total_value); ?>" name="total_value" class="form-control backgroundColorF2 packages_total number_test" placeholder="Value" readonly>
													</div>
													<p class="itemBottomHeading">Conversion</p>
												</th>
												<th>
													<p class="itemBottomHeading">Currency</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">ADULT</p> -->
													<!-- <p class="itemTopSubHeading">(TWIN SHARING)</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="packages_number_of_adult" class="packages_number_of_adult packages_adult_room_value" value="<?php echo e($packagesData->adult); ?>">
														<span class="travellersValue packages_adult_room_result"><?php echo e($packagesData->adult); ?></span>
													</div>
													<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">EXTRA ADULT</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="extra_adult" class="packages_number_of_extra_adult packages_child_extra_adult_value" value="<?php echo e($packagesData->extra_adult); ?>">
														<span class="travellersValue packages_child_extra_adult_result"><?php echo e($packagesData->extra_adult); ?></span>
													</div>
													<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">CHILD</p>
													<p class="itemTopSubHeading">(WITH BED)</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="child_with_bed" class="packages_number_of_child_with_bed packages_child_with_bed_value" value="<?php echo e($packagesData->child_with_bed); ?>">
														<span class="travellersValue packages_child_with_bed_result"><?php echo e($packagesData->child_with_bed); ?></span>
													</div>
													<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">CHILD</p>
													<p class="itemTopSubHeading">(WITHOUT BED)</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="child_without_bed" class="packages_number_of_child_without_bed packages_childwithoutbed_value" value="<?php echo e($packagesData->child_without_bed); ?>">
														<!-- <span class="travellersMinus packages_childwithoutbed_dec">&#8722;</span> -->
														<span class="travellersValue packages_span_value_childwithoutbed_result"><?php echo e($packagesData->child_without_bed); ?></span>
													</div>
													<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">INFANT</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="infant" class="packages_number_of_infant packages_infant_value" value="<?php echo e($packagesData->infant); ?>">
														<span class="travellersValue packages_infant_result"><?php echo e($packagesData->infant); ?></span>
													</div>
													<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">SINGLE<br>TRAVELLER</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="solo_traveller" class="packages_number_solo_traveller packages_solo_value" value="<?php echo e($packagesData->solo_traveller); ?>">
														<span class="travellersValue packages_solo_result"><?php echo e($packagesData->solo_traveller); ?></span>
													</div>
													<p class="itemBottomHeading">Single<br>(+12yrs)</p>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Airfare</td>
												<td class="makeflex">
													<select class="form-control supplier" name="newprice[package_airfare]" id="airfare">
														<option value="0" select_name="0" >Select</option>
													<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['package_airfare']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
												<input type="hidden" name="newprice[package_airfare_remarks]" id="remarks_airfare" value="<?php echo e($new_price['package_airfare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control aircurrency" name="newprice[aircurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['aircurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_air_adult adult_disable" name="newprice[package_air_adult]" <?php if($new_price["package_air_adult"]!=""): ?> value="<?php echo e($new_price["package_air_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_air_exadult exadult_disable" name="newprice[package_air_exadult]" <?php if($new_price["package_air_exadult"]!=""): ?> value="<?php echo e($new_price["package_air_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_air_childbed childbed_disable" name="newprice[package_air_childbed]" <?php if($new_price["package_air_childbed"]!=""): ?> value="<?php echo e($new_price["package_air_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_air_childwbed childwbed_disable" name="newprice[package_air_childwbed]" <?php if($new_price["package_air_childwbed"]!=""): ?> value="<?php echo e($new_price["package_air_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_air_infant infant_disable" name="newprice[package_air_infant]" <?php if($new_price["package_air_infant"]!=""): ?> value="<?php echo e($new_price["package_air_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_air_single single_disable" name="newprice[package_air_single]" <?php if($new_price["package_air_single"]!=""): ?> value="<?php echo e($new_price["package_air_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Cruise Start-->
											<tr>
												<td>Cruise Fare</td>
												<td class="makeflex">
													<select class="form-control supplier" name="newprice[package_cruise_fare]" id="cruise_fare">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" lect_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['package_cruise_fare']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden"  name="newprice[package_cruise_fare_remarks]"  id="remarks_cruise_fare" value="<?php echo e($new_price['package_cruise_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control cruisecurrency" name="newprice[cruisecurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['cruisecurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruise_adult adult_disable" name="newprice[package_cruise_adult]" <?php if($new_price["package_cruise_adult"]!=""): ?> value="<?php echo e($new_price["package_cruise_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruise_exadult exadult_disable" name="newprice[package_cruise_exadult]" <?php if($new_price["package_cruise_exadult"]!=""): ?> value="<?php echo e($new_price["package_cruise_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruise_childbed childbed_disable" name="newprice[package_cruise_childbed]" <?php if($new_price["package_cruise_childbed"]!=""): ?> value="<?php echo e($new_price["package_cruise_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruise_childwbed childwbed_disable" name="newprice[package_cruise_childwbed]" <?php if($new_price["package_cruise_childwbed"]!=""): ?> value="<?php echo e($new_price["package_cruise_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruise_infant infant_disable" name="newprice[package_cruise_infant]" <?php if($new_price["package_cruise_infant"]!=""): ?> value="<?php echo e($new_price["package_cruise_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruise_single single_disable" name="newprice[package_cruise_single]" <?php if($new_price["package_cruise_single"]!=""): ?> value="<?php echo e($new_price["package_cruise_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Port Charges </td>
												<td class="makeflex">
													<select class="form-control supplier" id="port_charge_fare" name="newprice[port_charge_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['port_charge_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="<?php echo e($new_price['port_charge_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control portchargecurrency" name="newprice[portchargecurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['portchargecurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruiseport_adult adult_disable" name="newprice[package_cruiseport_adult]" <?php if($new_price["package_cruiseport_adult"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_exadult exadult_disable" name="newprice[package_cruiseport_exadult]" <?php if($new_price["package_cruiseport_exadult"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_childbed childbed_disable" name="newprice[package_cruiseport_childbed]" <?php if($new_price["package_cruiseport_childbed"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_childwbed childwbed_disable" name="newprice[package_cruiseport_childwbed]" <?php if($new_price["package_cruiseport_childwbed"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_infant infant_disable" name="newprice[package_cruiseport_infant]" <?php if($new_price["package_cruiseport_infant"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_single single_disable" name="newprice[package_cruiseport_single]" <?php if($new_price["package_cruiseport_single"]!=""): ?> value="<?php echo e($new_price["package_cruiseport_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Gratuity</td>
												<td class="makeflex">
													<select class="form-control supplier" id="gratuity_fare" name="newprice[gratuity_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['gratuity_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												<input type="hidden" name="newprice[gratuity_remarks]" id="remarks_gratuity_fare" value="<?php echo e($new_price['gratuity_remarks']); ?>">
												</td>
												<td>
												<select class="form-control gratuitycurrency" name="newprice[gratuitycurrency]">
												<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['gratuitycurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_adult adult_disable" name="newprice[package_cruisegratuity_adult]" <?php if($new_price["package_cruisegratuity_adult"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_exadult exadult_disable" name="newprice[package_cruisegratuity_exadult]" <?php if($new_price["package_cruisegratuity_exadult"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_childbed childbed_disable" name="newprice[package_cruisegratuity_childbed]" <?php if($new_price["package_cruisegratuity_childbed"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_childwbed childwbed_disable" name="newprice[package_cruisegratuity_childwbed]" <?php if($new_price["package_cruisegratuity_childwbed"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_infant infant_disable" name="newprice[package_cruisegratuity_infant]" <?php if($new_price["package_cruisegratuity_infant"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_single single_disable" name="newprice[package_cruisegratuity_single]" <?php if($new_price["package_cruisegratuity_single"]!=""): ?> value="<?php echo e($new_price["package_cruisegratuity_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Cruise GST </td>
												<td class="makeflex">
													<select class="form-control supplier" id="cruise_gst_fare" name="newprice[cruise_gst_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['cruise_gst_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												<input type="hidden" name="newprice[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="<?php echo e($new_price['cruise_gst_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control cruise_gstcurrency" name="newprice[cruise_gstcurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['cruise_gstcurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruisegst_adult adult_disable" name="newprice[package_cruisegst_adult]" <?php if($new_price["package_cruisegst_adult"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_exadult exadult_disable" name="newprice[package_cruisegst_exadult]" <?php if($new_price["package_cruisegst_exadult"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_childbed childbed_disable" name="newprice[package_cruisegst_childbed]" <?php if($new_price["package_cruisegst_childbed"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_childwbed childwbed_disable" name="newprice[package_cruisegst_childwbed]" <?php if($new_price["package_cruisegst_childwbed"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_infant infant_disable" name="newprice[package_cruisegst_infant]" <?php if($new_price["package_cruisegst_infant"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_single single_disable" name="newprice[package_cruisegst_single]" <?php if($new_price["package_cruisegst_single"]!=""): ?> value="<?php echo e($new_price["package_cruisegst_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Cruise End-->
											<tr>
												<td>Accommodation</td>
												<td class="makeflex">
													<select class="form-control supplier" id="accommodation_fare" name="newprice[accommodation_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['accommodation_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												<input type="hidden" name="newprice[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="<?php echo e($new_price['accommodation_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control accommodationcurrency" name="newprice[accommodationcurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['accommodationcurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_hotel_adult adult_disable" name="newprice[package_hotel_adult]" id="" <?php if($new_price["package_hotel_adult"]!=""): ?> value="<?php echo e($new_price["package_hotel_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_hotel_exadult exadult_disable" name="newprice[package_hotel_exadult]" <?php if($new_price["package_hotel_exadult"]!=""): ?> value="<?php echo e($new_price["package_hotel_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_hotel_childbed childbed_disable" name="newprice[package_hotel_childbed]" <?php if($new_price["package_hotel_childbed"]!=""): ?> value="<?php echo e($new_price["package_hotel_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_hotel_childwbed childwbed_disable" name="newprice[package_hotel_childwbed]" <?php if($new_price["package_hotel_childwbed"]!=""): ?> value="<?php echo e($new_price["package_hotel_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_hotel_infant infant_disable" name="newprice[package_hotel_infant]" <?php if($new_price["package_hotel_infant"]!=""): ?> value="<?php echo e($new_price["package_hotel_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_hotel_single single_disable" name="newprice[package_hotel_single]" <?php if($new_price["package_hotel_single"]!=""): ?> value="<?php echo e($new_price["package_hotel_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Sightseeing</td>
												<td class="makeflex">
													<select class="form-control supplier" id="sightseeing_fare" name="newprice[sightseeing_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['sightseeing_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="<?php echo e($new_price['sightseeing_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control sightseeingcurrency" name="newprice[sightseeingcurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['sightseeingcurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_tours_adult adult_disable" name="newprice[package_tours_adult]" <?php if($new_price["package_tours_adult"]!=""): ?> value="<?php echo e($new_price["package_tours_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tours_exadult exadult_disable" name="newprice[package_tours_exadult]" <?php if($new_price["package_tours_exadult"]!=""): ?> value="<?php echo e($new_price["package_tours_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tours_childbed childbed_disable" name="newprice[package_tours_childbed]" <?php if($new_price["package_tours_childbed"]!=""): ?> value="<?php echo e($new_price["package_tours_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tours_childwbed childwbed_disable" name="newprice[package_tours_childwbed]" <?php if($new_price["package_tours_childwbed"]!=""): ?> value="<?php echo e($new_price["package_tours_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tours_infant infant_disable" name="newprice[package_tours_infant]" <?php if($new_price["package_tours_infant"]!=""): ?> value="<?php echo e($new_price["package_tours_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tours_single single_disable" name="newprice[package_tours_single]" <?php if($new_price["package_tours_single"]!=""): ?> value="<?php echo e($new_price["package_tours_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Transfers</td>
												<td class="makeflex">
													<select class="form-control supplier" id="transfers_fare" name="newprice[transfers_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['transfers_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[transfers_fare_remarks]" id="remarks_transfers_fare" value="<?php echo e($new_price['transfers_fare_remarks']); ?>">
												</td>
												<td>
												<select class="form-control transferscurrency" name="newprice[transferscurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['transferscurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_transfer_adult adult_disable" name="newprice[package_transfer_adult]" <?php if($new_price["package_transfer_adult"]!=""): ?> value="<?php echo e($new_price["package_transfer_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_transfer_exadult exadult_disable" name="newprice[package_transfer_exadult]" <?php if($new_price["package_transfer_exadult"]!=""): ?> value="<?php echo e($new_price["package_transfer_exadult"]); ?>"  <?php endif; ?> ></td>
												<td><input type="text" class="form-control number_test packages_transfer_childbed childbed_disable" name="newprice[package_transfer_childbed]" <?php if($new_price["package_transfer_childbed"]!=""): ?> value="<?php echo e($new_price["package_transfer_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_transfer_childwbed childwbed_disable" name="newprice[package_transfer_childwbed]" <?php if($new_price["package_transfer_childwbed"]!=""): ?> value="<?php echo e($new_price["package_transfer_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_transfer_infant infant_disable" name="newprice[package_transfer_infant]" <?php if($new_price["package_transfer_infant"]!=""): ?> value="<?php echo e($new_price["package_transfer_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_transfer_single single_disable" name="newprice[package_transfer_single]" <?php if($new_price["package_transfer_single"]!=""): ?> value="<?php echo e($new_price["package_transfer_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td>Visa Charges</td>
												<td class="makeflex">
													<select class="form-control supplier" id="visa_charges_fare" name="newprice[visa_charges_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['visa_charges_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												<input type="hidden" name="newprice[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="<?php echo e($new_price['visa_charges_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control visacurrency" name="newprice[visacurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['visacurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_visa_adult adult_disable" name="newprice[package_visa_adult]" <?php if($new_price["package_visa_adult"]!=""): ?> value="<?php echo e($new_price["package_visa_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_visa_exadult exadult_disable" name="newprice[package_visa_exadult]" <?php if($new_price["package_visa_exadult"]!=""): ?> value="<?php echo e($new_price["package_visa_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_visa_childbed childbed_disable" name="newprice[package_visa_childbed]" <?php if($new_price["package_visa_childbed"]!=""): ?> value="<?php echo e($new_price["package_visa_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_visa_childwbed childwbed_disable" name="newprice[package_visa_childwbed]" <?php if($new_price["package_visa_childwbed"]!=""): ?> value="<?php echo e($new_price["package_visa_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_visa_infant infant_disable" name="newprice[package_visa_infant]" <?php if($new_price["package_visa_infant"]!=""): ?> value="<?php echo e($new_price["package_visa_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_visa_single single_disable" name="newprice[package_visa_single]" <?php if($new_price["package_visa_single"]!=""): ?> value="<?php echo e($new_price["package_visa_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<tr>
												<td> Travel Insurance</td>
												<td class="makeflex">
													<select class="form-control supplier" id="travel_insurance_fare" name="newprice[travel_insurance_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['travel_insurance_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="<?php echo e($new_price['travel_insurance_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control travelcurrency" name="newprice[travelcurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['travelcurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_inc_adult adult_disable" name="newprice[package_inc_adult]" <?php if($new_price["package_inc_adult"]!=""): ?> value="<?php echo e($new_price["package_inc_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_inc_exadult exadult_disable" name="newprice[package_inc_exadult]" <?php if($new_price["package_inc_exadult"]!=""): ?> value="<?php echo e($new_price["package_inc_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_inc_childbed childbed_disable" name="newprice[package_inc_childbed]" <?php if($new_price["package_inc_childbed"]!=""): ?> value="<?php echo e($new_price["package_inc_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_inc_childwbed childwbed_disable" name="newprice[package_inc_childwbed]" <?php if($new_price["package_inc_childwbed"]!=""): ?> value="<?php echo e($new_price["package_inc_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_inc_infant infant_disable" name="newprice[package_inc_infant]" <?php if($new_price["package_inc_infant"]!=""): ?> value="<?php echo e($new_price["package_inc_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_inc_single single_disable" name="newprice[package_inc_single]" <?php if($new_price["package_inc_single"]!=""): ?> value="<?php echo e($new_price["package_inc_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Meals  Start-->
											<tr>
												<td>Meals</td>
												<td class="makeflex">
													<select class="form-control supplier" id="meals_fare" name="newprice[meals_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['meals_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[meals_fare_remarks]" id="remarks_meals_fare" value="<?php echo e($new_price['meals_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control mealscurrency" name="newprice[mealscurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['mealscurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_meals_adult adult_disable" name="newprice[package_meals_adult]" <?php if($new_price["package_meals_adult"]!=""): ?> value="<?php echo e($new_price["package_meals_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_meals_exadult exadult_disable" name="newprice[package_meals_exadult]" <?php if($new_price["package_meals_exadult"]!=""): ?> value="<?php echo e($new_price["package_meals_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_meals_childbed childbed_disable" name="newprice[package_meals_childbed]" <?php if($new_price["package_meals_childbed"]!=""): ?> value="<?php echo e($new_price["package_meals_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_meals_childwbed childwbed_disable" name="newprice[package_meals_childwbed]" <?php if($new_price["package_meals_childwbed"]!=""): ?> value="<?php echo e($new_price["package_meals_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_meals_infant infant_disable" name="newprice[package_meals_infant]" <?php if($new_price["package_meals_infant"]!=""): ?> value="<?php echo e($new_price["package_meals_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_meals_single single_disable" name="newprice[package_meals_single]" <?php if($new_price["package_meals_single"]!=""): ?> value="<?php echo e($new_price["package_meals_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Meals End-->
											<!--Additional Service-->
											<tr>
												<td>Addon Service</td>
												<td class="makeflex">
													<select class="form-control supplier" id="addon_service_fare" name="newprice[addon_service_fare_supplier]">
													<option value="0" select_name="0">Select</option>
													<?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($suppliers->id); ?>" select_name="<?php echo e($suppliers->suppliercompanyname); ?>" <?php if($new_price['addon_service_fare_supplier']==$suppliers->id): ?> selected <?php endif; ?> ><?php echo e($suppliers->suppliercompanyname); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="<?php echo e($new_price['addon_service_fare_remarks']); ?>">
												</td>
												<td>
													<select class="form-control addon_servicecurrency" name="newprice[addon_servicecurrency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['addon_servicecurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_additionalservice_adult adult_disable" name="newprice[package_additionalservice_adult]" <?php if($new_price["package_additionalservice_adult"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_exadult exadult_disable" name="newprice[package_additionalservice_exadult]" <?php if($new_price["package_additionalservice_exadult"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_childbed childbed_disable" name="newprice[package_additionalservice_childbed]" <?php if($new_price["package_additionalservice_childbed"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_childwbed childwbed_disable" name="newprice[package_additionalservice_childwbed]" <?php if($new_price["package_additionalservice_childwbed"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_infant infant_disable" name="newprice[package_additionalservice_infant]" <?php if($new_price["package_additionalservice_infant"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_single single_disable" name="newprice[package_additionalservice_single]" <?php if($new_price["package_additionalservice_single"]!=""): ?> value="<?php echo e($new_price["package_additionalservice_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Additional Service End-->
											<!--Total before Markup-->
											<tr class="totalDisplay">
												<td>Total</td>
												<td>
												<!--<p class="currencyBox">INR</p>-->
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_adult" name="newprice[package_tourtotal_adult]" readonly="" <?php if($new_price["package_tourtotal_adult"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_exadult" name="newprice[package_tourtotal_exadult]" readonly="" <?php if($new_price["package_tourtotal_exadult"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_childbed" name="newprice[package_tourtotal_childbed]" readonly="" <?php if($new_price["package_tourtotal_childbed"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_childwbed" name="newprice[package_tourtotal_childwbed]" readonly="" <?php if($new_price["package_tourtotal_childwbed"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_infant" name="newprice[package_tourtotal_infant]" readonly="" <?php if($new_price["package_tourtotal_infant"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_single" name="newprice[package_tourtotal_single]" readonly="" <?php if($new_price["package_tourtotal_single"]!=""): ?> value="<?php echo e($new_price["package_tourtotal_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Markup  Start-->
											<tr>
												<td class="fontItalic">Markup (Profit)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricemarkup" name="newprice[pricemarkup]">
														<option value="0" disabled="">Select</option>
														<option value="1" <?php if($new_price['pricemarkup']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['pricemarkup']==2): ?> selected <?php endif; ?>>Percentage</option>
													</select>
													
													<select class="percentageValue number_test markup_percentage" name="newprice[markup_percentage]">
														<option value="0">Select</option>
														<?php $__currentLoopData = $markup_profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($markup_pro->value); ?>" <?php if($new_price['markup_percentage']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>

												<td>
													<select class="form-control markupcurrency" name="newprice[markupcurrency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['markupcurrency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_markup_adult adult_disable" name="newprice[package_markup_adult]" <?php if($new_price["package_markup_adult"]!=""): ?> value="<?php echo e($new_price["package_markup_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_markup_exadult exadult_disable" name="newprice[package_markup_exadult]" <?php if($new_price["package_markup_exadult"]!=""): ?> value="<?php echo e($new_price["package_markup_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_markup_childbed childbed_disable" name="newprice[package_markup_childbed]" <?php if($new_price["package_markup_childbed"]!=""): ?> value="<?php echo e($new_price["package_markup_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_markup_childwbed childwbed_disable" name="newprice[package_markup_childwbed]" <?php if($new_price["package_markup_childwbed"]!=""): ?> value="<?php echo e($new_price["package_markup_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_markup_infant infant_disable" name="newprice[package_markup_infant]" <?php if($new_price["package_markup_infant"]!=""): ?> value="<?php echo e($new_price["package_markup_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_markup_single single_disable" name="newprice[package_markup_single]" <?php if($new_price["package_markup_single"]!=""): ?> value="<?php echo e($new_price["package_markup_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Discount Plus-->
											<tr>
												<td>Discount (+)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricediscountpositive" name="newprice[pricediscountpositive]">
														<option value="0" <?php if($new_price['pricediscountpositive']==0): ?> selected <?php endif; ?>>No Discount</option>
														<option value="1" <?php if($new_price['pricediscountpositive']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['pricediscountpositive']==2): ?> selected <?php endif; ?>>Percentage</option>
														<!-- <option value="3">Coupon</option> -->
													</select>

													<select class="percentageValue number_test discountpositive_percentage" name="newprice[discountpositive_percentage]">
														<option value="0">Select</option>
														<?php $__currentLoopData = $discunt_positive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($markup_pro->value); ?>" <?php if($new_price['discountpositive_percentage']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td>
													<select class="form-control discount_positive_currency" name="newprice[discount_positive_currency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['discount_positive_currency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_discount_adult_plus adult_disable" name="newprice[package_discount_adult]" <?php if($new_price["package_discount_adult"]!=""): ?> value="<?php echo e($new_price["package_discount_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_exadult_plus exadult_disable" name="newprice[package_discount_exadult]" <?php if($new_price["package_discount_exadult"]!=""): ?> value="<?php echo e($new_price["package_discount_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_childbed_plus childbed_disable" name="newprice[package_discount_childbed]" <?php if($new_price["package_discount_childbed"]!=""): ?> value="<?php echo e($new_price["package_discount_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_childwbed_plus childwbed_disable" name="newprice[package_discount_childwbed]" <?php if($new_price["package_discount_childwbed"]!=""): ?> value="<?php echo e($new_price["package_discount_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_infant_plus infant_disable" name="newprice[package_discount_infant]" <?php if($new_price["package_discount_infant"]!=""): ?> value="<?php echo e($new_price["package_discount_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_single_plus single_disable" name="newprice[package_discount_single]" <?php if($new_price["package_discount_single"]!=""): ?> value="<?php echo e($new_price["package_discount_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Total before GST-->
											<tr class="grossTotalDisplay">
												<td class="tourPriceItem">Gross Total</td>
												<td>
												<!--<p class="currencyBox">INR</p>-->
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_gross_total_adult" name="newprice[package_total_adult]" readonly="" <?php if($new_price["package_total_adult"]!=""): ?> value="<?php echo e($new_price["package_total_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gross_total_exadult" name="newprice[package_total_exadult]" readonly="" <?php if($new_price["package_total_exadult"]!=""): ?> value="<?php echo e($new_price["package_total_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gross_total_childbed" name="newprice[package_total_childbed]" readonly="" <?php if($new_price["package_total_childbed"]!=""): ?> value="<?php echo e($new_price["package_total_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gross_total_childwbed" name="newprice[package_total_childwbed]" readonly="" <?php if($new_price["package_total_childwbed"]!=""): ?> value="<?php echo e($new_price["package_total_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gross_total_infant" name="newprice[package_total_infant]" readonly="" <?php if($new_price["package_total_infant"]!=""): ?> value="<?php echo e($new_price["package_total_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gross_total_single" name="newprice[package_total_single]" readonly="" <?php if($new_price["package_total_single"]!=""): ?> value="<?php echo e($new_price["package_total_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Total Gross Total (Group)-->
											<tr class="grossGroupTotalDisplay">
												<td class="tourPriceItem">Gross Total (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_gross_total_group" name="newprice[package_total_group]" readonly="" <?php if($new_price["package_total_group"]!=""): ?> value="<?php echo e($new_price["package_total_group"]); ?>"  <?php endif; ?>>
												</td>
											</tr>

											<!--Discount Minus-->
											<tr>
												<td>Discount (-)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricediscountnegative" name="newprice[pricediscountnegative]">
														<option value="0" <?php if($new_price['pricediscountnegative']==0): ?> selected <?php endif; ?>>No Discount</option>
														<option value="1" <?php if($new_price['pricediscountnegative']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['pricediscountnegative']==2): ?> selected <?php endif; ?>>Percentage</option>
														<!-- <option value="3">Coupon</option> -->
													</select>

													<select class="percentageValue number_test discountnegative_percentage" name="newprice[discountnegative_percentage]" >
														<option value="0">Select</option>
														<?php $__currentLoopData = $discunt_negative; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($markup_pro->value); ?>" <?php if($new_price['pricediscountnegative']==$markup_pro->value): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
													<input type="hidden" name="newprice[coupon_id]" class="coupon_id" value="">
													<!-- <select class="percentageValue number_test coupon_percentage" name="newprice[discount_coupon]" style="display: none;">
													<option coupon_id="0" value="0">0</option>
													</select> -->
												</td>
												<td>
												<select class="form-control discount_negative_currency" name="newprice[discount_negative_currency]">
												<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['discount_negative_currency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_discount_adult_minus adult_disable" name="newprice[package_discount_minus_adult]" <?php if($new_price["package_discount_minus_adult"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_exadult_minus exadult_disable" name="newprice[package_discount_minus_exadult]" <?php if($new_price["package_discount_minus_exadult"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_childbed_minus childbed_disable" name="newprice[package_discount_minus_childbed]" <?php if($new_price["package_discount_minus_childbed"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_childwbed_minus childwbed_disable" name="newprice[package_discount_minus_childwbed]" <?php if($new_price["package_discount_minus_childwbed"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_infant_minus infant_disable" name="newprice[package_discount_minus_infant]"  <?php if($new_price["package_discount_minus_infant"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_discount_single_minus single_disable" name="newprice[package_discount_minus_single]" <?php if($new_price["package_discount_minus_single"]!=""): ?> value="<?php echo e($new_price["package_discount_minus_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Total Gross Total (Group)-->
											<tr class="discountGroupTotalDisplay">
												<td class="tourPriceItem">Discount (-) (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_discount_group" name="newprice[package_total_discount_group]" readonly="" <?php if($new_price["package_total_discount_group"]!=""): ?> value="<?php echo e($new_price["package_total_discount_group"]); ?>"  <?php endif; ?>>
												</td>
											</tr>

											<!--GST Starts-->
											<tr>
												<td class="fontItalic">(+) GST</td>
												<td class="makeflex">
													<select class="fixedValue pricegst" name="newprice[package_gst_curr]">
														<option value="0" <?php if($new_price['package_gst_curr']==0): ?> selected <?php endif; ?>>Select</option>
														<option value="1" <?php if($new_price['package_gst_curr']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['package_gst_curr']==2): ?> selected <?php endif; ?>>Percentage</option>
														</select>
														<select class="percentageValue number_test gst_percentage" name="newprice[gst_percentage]">
														<option value="0">Select</option>
														<?php $__currentLoopData = $gst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gst): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($gst->value); ?>" <?php if($new_price['package_gst_curr']==$gst->value): ?> selected <?php endif; ?>><?php echo e($gst->value); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td>
													<select class="form-control gst_currency" name="newprice[gst_currency]">
													<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['gst_currency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_gst_adult adult_disable" name="newprice[package_gst_adult]" <?php if($new_price["package_gst_adult"]!=""): ?> value="<?php echo e($new_price["package_gst_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gst_exadult exadult_disable" name="newprice[package_gst_exadult]" <?php if($new_price["package_gst_exadult"]!=""): ?> value="<?php echo e($new_price["package_gst_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gst_childbed childbed_disable" name="newprice[package_gst_childbed]" <?php if($new_price["package_gst_childbed"]!=""): ?> value="<?php echo e($new_price["package_gst_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gst_childwbed childwbed_disable" name="newprice[package_gst_childwbed]" <?php if($new_price["package_gst_childwbed"]!=""): ?> value="<?php echo e($new_price["package_gst_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gst_infant infant_disable" name="newprice[package_gst_infant]" <?php if($new_price["package_gst_infant"]!=""): ?> value="<?php echo e($new_price["package_gst_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gst_single single_disable" name="newprice[package_gst_single]" <?php if($new_price["package_gst_single"]!=""): ?> value="<?php echo e($new_price["package_gst_single"]); ?>"  <?php endif; ?>></td>
											</tr>
											
											<!--Total GST (Group)-->
											<tr class="gstGroupTotalDisplay">
												<td class="tourPriceItem">GST (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_gst_group" name="newprice[package_total_gst_group]" readonly="" <?php if($new_price["package_total_gst_group"]!=""): ?> value="<?php echo e($new_price["package_total_gst_group"]); ?>"  <?php endif; ?>>
												</td>
											</tr>

											<!--Total after GST-->
											<tr class="gstTotalDisplay">
												<td class="tourPriceItem">Total with GST</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_adult" name="newprice[package_gsttotal_adult]" readonly="" <?php if($new_price["package_gsttotal_adult"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_exadult" name="newprice[package_gsttotal_exadult]" readonly="" <?php if($new_price["package_gsttotal_exadult"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_childbed" name="newprice[package_gsttotal_childbed]" readonly="" <?php if($new_price["package_gsttotal_childbed"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_childwbed" name="newprice[package_gsttotal_childwbed]" readonly="" <?php if($new_price["package_gsttotal_childwbed"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_infant" name="newprice[package_gsttotal_infant]" readonly="" <?php if($new_price["package_gsttotal_infant"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_single" name="newprice[package_gsttotal_single]" readonly="" <?php if($new_price["package_gsttotal_single"]!=""): ?> value="<?php echo e($new_price["package_gsttotal_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--TCS Starts-->
											<tr>
												<td class="fontItalic">(+) TCS</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricetcs" name="newprice[package_tcs_curr]">
														<option value="0" <?php if($new_price['package_tcs_curr']==0): ?> selected <?php endif; ?>>Select</option>
														<option value="1" <?php if($new_price['package_tcs_curr']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['package_tcs_curr']==2): ?> selected <?php endif; ?>>Percentage</option>
													</select>

													<select class="percentageValue number_test tcs_percentage" name="newprice[tcs_percentage]">
														<option value="0">Select</option>
														<?php $__currentLoopData = $tcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcs): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($tcs->value); ?>" <?php if($new_price['package_tcs_curr']==$tcs->value): ?> selected <?php endif; ?>><?php echo e($tcs->value); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td>
													<select class="form-control tcs_currency" name="newprice[tcs_currency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['tcs_currency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_tcs_adult adult_disable" name="newprice[package_tcs_adult]" <?php if($new_price["package_tcs_adult"]!=""): ?> value="<?php echo e($new_price["package_tcs_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcs_exadult exadult_disable" name="newprice[package_tcs_exadult]" <?php if($new_price["package_tcs_exadult"]!=""): ?> value="<?php echo e($new_price["package_tcs_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcs_childbed childbed_disable" name="newprice[package_tcs_childbed]" <?php if($new_price["package_tcs_childbed"]!=""): ?> value="<?php echo e($new_price["package_tcs_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcs_childwbed childwbed_disable" name="newprice[package_tcs_childwbed]" <?php if($new_price["package_tcs_childwbed"]!=""): ?> value="<?php echo e($new_price["package_tcs_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcs_infant infant_disable" name="newprice[package_tcs_infant]" <?php if($new_price["package_tcs_infant"]!=""): ?> value="<?php echo e($new_price["package_tcs_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcs_single single_disable" name="newprice[package_tcs_single]" <?php if($new_price["package_tcs_single"]!=""): ?> value="<?php echo e($new_price["package_tcs_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Total TCS (Group)-->
											<tr class="tcsGroupTotalDisplay">
												<td class="tourPriceItem">TCS (Group)</td>
												<td>
												<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tcs_group" name="newprice[package_total_tcs_group]" readonly="" <?php if($new_price["package_total_tcs_group"]!=""): ?> value="<?php echo e($new_price["package_total_tcs_group"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Total after TCS-->
											<tr class="tcsTotalDisplay">
												<td class="tourPriceItem">Total with TCS</td>
												<td>
												<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_adult" name="newprice[package_tcstotal_adult]" readonly="" <?php if($new_price["package_tcstotal_adult"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_exadult" name="newprice[package_tcstotal_exadult]" readonly="" <?php if($new_price["package_tcstotal_exadult"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_childbed" name="newprice[package_tcstotal_childbed]" readonly="" <?php if($new_price["package_tcstotal_childbed"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_childwbed" name="newprice[package_tcstotal_childwbed]" readonly="" <?php if($new_price["package_tcstotal_childwbed"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_infant" name="newprice[package_tcstotal_infant]" readonly="" <?php if($new_price["package_tcstotal_infant"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_single" name="newprice[package_tcstotal_single]" readonly="" <?php if($new_price["package_tcstotal_single"]!=""): ?> value="<?php echo e($new_price["package_tcstotal_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--PG Charges Starts-->
											<tr>
												<td class="fontItalic">(+) PG Charges</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricepgcharges" name="newprice[pg_charges]">
														<option value="0" <?php if($new_price['pg_charges']==0): ?> selected <?php endif; ?>>Select</option>
														<option value="1" <?php if($new_price['pg_charges']==1): ?> selected <?php endif; ?>>Fixed</option>
														<option value="2" <?php if($new_price['pg_charges']==2): ?> selected <?php endif; ?>>Percentage</option>
													</select>

													<select class="percentageValue number_test pgcharges_percentage" name="newprice[pgcharges_percentage]">
														<option value="0">Select</option>
														<?php $__currentLoopData = $pg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($pg->value); ?>" <?php if($new_price['pg_charges']==$pg->value): ?> selected <?php endif; ?>><?php echo e($pg->value); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td>
													<select class="form-control pgcharges_currency" name="newprice[pgcharges_currency]">
														<?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
														<option value="<?php echo e($rate->id); ?>" c_val="<?php echo e($rate->rate); ?>" <?php if($new_price['pgcharges_currency']==$rate->rate): ?> selected <?php endif; ?>><?php echo e($rate->currency); ?> </option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_pgcharges_adult adult_disable" name="newprice[package_pgcharges_adult]" <?php if($new_price["package_pgcharges_adult"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_exadult exadult_disable" name="newprice[package_pgcharges_exadult]" <?php if($new_price["package_pgcharges_exadult"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_childbed childbed_disable" name="newprice[package_pgcharges_childbed]" <?php if($new_price["package_pgcharges_childbed"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_childwbed childwbed_disable" name="newprice[package_pgcharges_childwbed]" <?php if($new_price["package_pgcharges_childwbed"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_infant infant_disable" name="newprice[package_pgcharges_infant]" <?php if($new_price["package_pgcharges_infant"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_single single_disable" name="newprice[package_pgcharges_single]" <?php if($new_price["package_pgcharges_single"]!=""): ?> value="<?php echo e($new_price["package_pgcharges_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--PG Charges Ends-->
											<!--Total PG (Group)-->
											<tr class="pgGrouptTotalDisplay">
												<td class="tourPriceItem">PG (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_pg_group" name="newprice[package_total_pg_group]" readonly="" <?php if($new_price["package_total_pg_group"]!=""): ?> value="<?php echo e($new_price["package_total_pg_group"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Grand Total-->
											<tr>
												<td class="tourPriceItem">GRAND TOTAL</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_grand_adult" name="newprice[package_grand_adult]" readonly="" <?php if($new_price["package_grand_adult"]!=""): ?> value="<?php echo e($new_price["package_grand_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_exadult" name="newprice[package_grand_exadult]" readonly="" <?php if($new_price["package_grand_exadult"]!=""): ?> value="<?php echo e($new_price["package_grand_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_childbed" name="newprice[package_grand_childbed]" readonly="" <?php if($new_price["package_grand_childbed"]!=""): ?> value="<?php echo e($new_price["package_grand_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_childwbed" name="newprice[package_grand_childwbed]" readonly="" <?php if($new_price["package_grand_childwbed"]!=""): ?> value="<?php echo e($new_price["package_grand_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_infant" name="newprice[package_grand_infant]" readonly="" <?php if($new_price["package_grand_infant"]!=""): ?> value="<?php echo e($new_price["package_grand_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_single" name="newprice[package_grand_single]" readonly="" <?php if($new_price["package_grand_single"]!=""): ?> value="<?php echo e($new_price["package_grand_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Grand Total According to number of person-->
											<tr>
												<td class="tourPriceItem">PAY Total</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_grand_adult_with_person" name="newprice[package_paytotal_adult]" readonly="" <?php if($new_price["package_paytotal_adult"]!=""): ?> value="<?php echo e($new_price["package_paytotal_adult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_exadult_with_person" name="newprice[package_paytotal_exadult]" readonly="" <?php if($new_price["package_paytotal_exadult"]!=""): ?> value="<?php echo e($new_price["package_paytotal_exadult"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_childbed_with_person" name="newprice[package_paytotal_childbed]" readonly="" <?php if($new_price["package_paytotal_childbed"]!=""): ?> value="<?php echo e($new_price["package_paytotal_childbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_childwbed_with_person " name="newprice[package_paytotal_childwbed]" readonly="" <?php if($new_price["package_paytotal_childwbed"]!=""): ?> value="<?php echo e($new_price["package_paytotal_childwbed"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_infant_with_person" name="newprice[package_paytotal_infant]" readonly="" <?php if($new_price["package_paytotal_infant"]!=""): ?> value="<?php echo e($new_price["package_paytotal_infant"]); ?>"  <?php endif; ?>></td>
												<td><input type="text" class="form-control number_test packages_grand_single_with_person" name="newprice[package_paytotal_single]" readonly="" <?php if($new_price["package_paytotal_single"]!=""): ?> value="<?php echo e($new_price["package_paytotal_single"]); ?>"  <?php endif; ?>></td>
											</tr>

											<!--Price to Pay-->
											<tr>
												<td class="tourPriceItem">Price To PAY</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td class="pricetoPay"><input type="text" class="form-control package_pricetopay packages_pricetopay" id="option1_mandate" name="newprice[package_pricetopay_adult]" readonly="" <?php if($new_price["package_pricetopay_adult"]!=""): ?> value="<?php echo e($new_price["package_pricetopay_adult"]); ?>"  <?php endif; ?>></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<!-- ******************** -->

							<!-- pricing category -->
							<?php
                          		$newprices_discounts=$packagesData->newprices_discounts;
                          		$pricediscounts=unserialize($newprices_discounts);
                          		if(!is_array($pricediscounts)) {
	                            	$pricediscounts=[];
	                            	}
                          	?>
                          	<div class="col-md-12">
                          		<div class="add-price-table mobscroll scrollX">
                          			<table class="table table-bordered" id="new_price_dynamic_field">
			                            <tr>
			                              	<th class="bkgrndColorDDD">Tour Category</th>
			                              	<th class="bkgrndColorDDD">Price Range</th>
			                            </tr>
			                            <?php if(count($pricediscounts)==0): ?>
			                              	<tr class="price-range-container" id="new_price_row1">
			                              		<!-- Select Category -->
			                              		<td>
			                              			<table class="table">
			                              				<thead>
			                              					<tr>
			                              						<th>Tour Category</th>
			                              					</tr>
			                              				</thead>
			                              				<tbody>
			                              					<tr>
			                              						<td>
			                              							<select name="NewPrice[0][package_rating]" id="rating" class="form-control rating-field new_price_category" style="width: 100%;">
			                              								<option value="" selected disabled>Select Category</option>
			                              								<?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			                              									<option value="<?php echo e($rtyp->id); ?>"><?php echo e($rtyp->name); ?></option>
			                              								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			                              								<option value="other">Other</option>
			                              							</select>
			                              							<input name="NewPrice[0][package_rating_other]" id="otherrating" class="form-control other-rating" placeholder="Specify Other Rating">
			                              						</td>
			                              					</tr>
			                              				</tbody>
			                              			</table>
			                              		</td>

				                                <!-- add price to category -->
				                                <td class="dynamic_price_range_0">
				                                  	<table class="table" id="dynamic_price_range_0_0">
				                                    <tr>
				                                    	<th>Price starting date</th>
				                                    	<th>Price end date</th>
				                                    	<th>Price applicable date (cut-off point)</th>
				                                    	<th>Discount Applicable on</th>
				                                    	<th>Action</th>
				                                    </tr>
				                                    <tr>
				                                      <td>
				                                        <div class="input-group date">
					                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					                                        <input name="NewPrice[0][datefrom][0]" class="form-control pull-right datepicker_package date_start" type="text">
				                                        </div>
				                                      </td>

				                                      <td>
				                                        <div class="input-group date">
					                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					                                        <input name="NewPrice[0][dateto][0]" class="form-control pull-right datepicker_package date_end" type="text">
				                                        </div>
				                                      </td>

				                                      <td>
				                                        <input type="number" value="0" name="NewPrice[0][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cutt Off Days">
				                                      </td>

				                                      <td>
				                                        <select class="form-control price_applicable_for" name="NewPrice[0][applicable_for][0]">
					                                        <option value="all">All Days</option>
					                                        <option value="day_wise">Day Wise</option>
				                                      	</select>
				                                      </td>

				                                      <td class="price_td">
				                                      	<div class="makeflex gap10">
					                                        <select class="form-control over_all_discount_type" name="NewPrice[0][over_all_discount_type][0]">
						                                        <option value="0">No Discount</option>
						                                        <!-- <option value="1">Fixed</option> -->
						                                        <option value="2">Percentage</option>
						                                        <option value="3">Coupon</option>
					                                        </select>

					                                        <!-- discount percentage -->
					                                        <select class="form-control number_test normal_discount normal_discount_first" name="NewPrice[0][normal_discount][0]" style="display: none;">
						                                        <option value="0">0</option>
						                                        <?php $__currentLoopData = $discunt_negative; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						                                        	<option value="<?php echo e($markup_pro->id); ?>"><?php echo e($markup_pro->value); ?></option>
						                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					                                        </select>

					                                        <!-- select discount coupon -->
					                                        <select class="coupon_discount number_test form-control coupon_discount_first" name="NewPrice[0][coupon_discount][0]" style="display: none;">
						                                        <option coupon_id="0" value="0">Select Coupon</option>
						                                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						                                        	<option coupon_id="<?php echo e($markup_pro->id); ?>"  value="<?php echo e($markup_pro->id); ?>" ><?php echo e($markup_pro->coupon_name); ?></option>
						                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					                                        </select>

					                                        <!-- <input type="text" class="form-control over_all_discount" name="NewPrice[0][over_all_discount]" value="" placeholder="Enter Discount Value"> -->
					                                        <div class="d_price00" id="d_price00" >
						                                        <input type="hidden" name="NewPrice[0][sunday_discount_type][0]" value="0" class="sunday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][sunday_normal_discount][0]" value="0" class="sunday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][monday_discount_type][0]" value="0" class="monday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][monday_normal_discount][0]" value="0" class="monday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][monday_coupon_discount][0]" value="0" class="monday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][tuesday_discount_type][0]" value="0" class="tuesday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][tuesday_normal_discount][0]" value="0" class="tuesday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][tuesday_coupon_discount][0]" value="0" class="tuesday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][wednesday_discount_type][0]" value="0" class="wednesday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][wednesday_normal_discount][0]" value="0" class="wednesday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][wednesday_coupon_discount][0]" value="0" class="wednesday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][thursday_discount_type][0]" value="0" class="thursday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][thursday_normal_discount][0]" value="0" class="thursday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][thursday_coupon_discount][0]" value="0" class="thursday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][friday_discount_type][0]" value="0" class="friday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][friday_normal_discount][0]" value="0" class="friday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][friday_coupon_discount][0]" value="0" class="friday_coupon_discount">
						                                        <input type="hidden" name="NewPrice[0][saturday_discount_type][0]" value="0" class="saturday_discount_type">
						                                        <input type="hidden" name="NewPrice[0][saturday_normal_discount][0]" value="0" class="saturday_normal_discount">
						                                        <input type="hidden" name="NewPrice[0][saturday_coupon_discount][0]" value="0" class="saturday_coupon_discount">
						                                        <!--
						                                        <input type="hidden" name="NewPrice[0][monday]" value="" class="new_price_monday">
						                                        <input type="hidden" name="NewPrice[0][tuesday]" value="" class="new_price_tuesday">
						                                        <input type="hidden" name="NewPrice[0][wednesday]" value="" class="new_price_wednesday">
						                                        <input type="hidden" name="NewPrice[0][thursday]" value="" class="new_price_thursday">
						                                        <input type="hidden" name="NewPrice[0][friday]" value="" class="new_price_friday">
						                                        <input type="hidden" name="NewPrice[0][saturday]" value="" class="new_price_saturday"> -->
					                                        </div>

					                                        <button style="display:none;" type="button" class="btn btn-info price_daywise" data-toggle="modal" data-id="d_price00">Add Price</button>
					                                    </div>
				                                      </td>

				                                      <td>
				                                        <button type="button" name="add" id="row_id_0" class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button>
				                                      </td>
				                                    </tr>
				                                  </table>
				                                </td>
				                              </tr>
			                              	<?php else: ?>
			                              	<?php
				                            	$a1=1;
				                            	$b1=0;
				                            ?>
			                              	<?php $__currentLoopData = $pricediscounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			                                <?php if(count($col)>=25): ?>
			                                <tr id="new_price_row<?php echo e($a1); ?>">
			                                	<!-- Select Category -->
			                              		<td>
			                              			<table class="table">
			                              				<thead>
			                              					<tr>
			                              						<th>Tour Category</th>
			                              					</tr>
			                              				</thead>
			                              				<tbody>
			                              					<tr>
			                              						<td>
			                              							<select name="NewPrice[<?php echo e($b1); ?>][package_rating]" id="rating" class="form-control rating-field new_price_category" style="width: 100%;">
			                              								<option value="" selected disabled>Select Category</option>
			                              								<?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			                              									<option value='<?php echo e($rtyp->id); ?>' <?php if(array_key_exists('package_rating',$col) && $col['package_rating']==$rtyp->id): ?> selected <?php endif; ?>><?php echo e($rtyp->name); ?> </option>
			                              								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			                              								<option value="other" <?php if(array_key_exists('package_rating',$col) && $col['package_rating']=='other'): ?> selected <?php endif; ?>>Other</option>
			                              							</select>
			                              							<input value="<?php echo e($col['package_rating_other']); ?>" name="NewPrice[<?php echo e($b1); ?>][package_rating_other]" id="otherrating" class="form-control other-rating"
							                                  			<?php if(array_key_exists('package_rating',$col) 
							                                  			&& 
							                                  			$col['package_rating']=='other'): ?> style="width: 100%;display:block;" 
							                                  			<?php else: ?> style="width: 100%;display:none" 
							                                  			<?php endif; ?> >
			                              						</td>
			                              					</tr>
			                              				</tbody>
			                              			</table>
			                              		</td>

			                                  	<!-- select category -->
			                                  	<!-- <td style="vertical-align: middle;">
			                                  		<select name="NewPrice[<?php echo e($b1); ?>][package_rating]" id="rating" class="form-control rating-field new_price_category" style="width: 100%;">
			                                  			<option value='' selected disabled>Select Category </option>
			                                  			<?php $__currentLoopData = $ratingType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtyp): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			                                  				<option value='<?php echo e($rtyp->id); ?>' <?php if(array_key_exists('package_rating',$col) && $col['package_rating']==$rtyp->id): ?> selected <?php endif; ?>><?php echo e($rtyp->name); ?> </option>
			                                  			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			                                  			<option value="other" <?php if(array_key_exists('package_rating',$col) && $col['package_rating']=='other'): ?> selected <?php endif; ?>>Other</option>
			                                  		</select>
			                                  		<input value="<?php echo e($col['package_rating_other']); ?>" name="NewPrice[<?php echo e($b1); ?>][package_rating_other]" id="otherrating" class="form-control other-rating"
			                                  			<?php if(array_key_exists('package_rating',$col) 
			                                  			&& 
			                                  			$col['package_rating']=='other'): ?> style="width: 100%;display:block;" 
			                                  			<?php else: ?> style="width: 100%;display:none" 
			                                  			<?php endif; ?> >
			                                  	</td> -->

			                                  	<!-- add price to category -->
				                                  <?php
				                                    $sub_elements=$col['datefrom'];
				                                    $sub_count=0;
				                                  ?>
				                                  <td class="dynamic_price_range_<?php echo e($b1); ?>">
				                                    <?php $__currentLoopData = $sub_elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_row=>$sub_col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				                                    <table class="table" id="dynamic_price_range_<?php echo e($b1); ?>_<?php echo e($sub_row); ?>">
				                                      	<tr>
					                                        <th>Price starting date</th>
					                                    	<th>Price end date</th>
					                                    	<th>Price applicable date (cut-off point)</th>
					                                    	<th>Discount Applicable on</th>
					                                    	<th>Action</th>
				                                      	</tr>
				                                      	<tr>
				                                        <td>
				                                        	<div class="input-group date">
				                                        		<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				                                        		<input value="<?php echo e($col['datefrom'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][datefrom][<?php echo e($sub_row); ?>]" class="form-control pull-right datepicker_package date_start" type="text">
				                                        	</div>
				                                        </td>

				                                        <td>
				                                        	<div class="input-group date">
				                                        		<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				                                        		<input value="<?php echo e($col['dateto'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][dateto][<?php echo e($sub_row); ?>]" class="form-control pull-right datepicker_package date_end" type="text">
				                                        	</div>
				                                        </td>

				                                        <td>
				                                        	<input type="number" <?php if(array_key_exists('cuttoffpoint',$col)): ?> value="<?php echo e($col['cuttoffpoint'][$sub_row]); ?>" <?php endif; ?> name="NewPrice[<?php echo e($b1); ?>][cuttoffpoint][<?php echo e($sub_row); ?>]" class="form-control cuttoffpoint" placeholder="Cutt Off Days">
				                                        </td>

				                                        <td>
				                                        	<select class="form-control price_applicable_for" name="NewPrice[<?php echo e($b1); ?>][applicable_for][<?php echo e($sub_row); ?>]">
				                                        		<option value="all" <?php if(array_key_exists('applicable_for',$col) && $col['applicable_for'][$sub_row]=='all'): ?> selected <?php endif; ?>>All Days</option>
				                                        		<option value="day_wise" <?php if(array_key_exists('applicable_for',$col) &&  $col['applicable_for'][$sub_row]=='day_wise'): ?> selected <?php endif; ?>>Day Wise</option>
				                                        	</select>
				                                        </td>

				                                        <td class="price_td">
					                                      	<div class="makeflex gap10">
					                                        <!-- <td class="price_td makeflex" style="column-gap: 10px;"> -->
					                                        	<select <?php if(array_key_exists('applicable_for',$col) &&  $col['applicable_for'][$sub_row]=='all'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> class="form-control over_all_discount_type" name="NewPrice[<?php echo e($b1); ?>][over_all_discount_type][<?php echo e($sub_row); ?>]">
					                                        		<option value="0" <?php if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==0): ?> selected <?php endif; ?>>No Discount</option>
					                                        		<!-- <option value="1">Fixed</option> -->
					                                        		<option value="2" <?php if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==2): ?> selected <?php endif; ?>>Percentage</option>
					                                        		<option value="3" <?php if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==3): ?> selected <?php endif; ?>>Coupon</option>
					                                        	</select>

					                                        	<!-- discount percentage -->
					                                        	<select class="form-control number_test normal_discount normal_discount_first" name="NewPrice[<?php echo e($b1); ?>][normal_discount][<?php echo e($sub_row); ?>]" <?php if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==2): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
					                                        		<option value="0">0</option>
					                                        		<?php $__currentLoopData = $discunt_negative; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					                                        			<option value="<?php echo e($markup_pro->id); ?>" <?php if($col['normal_discount'][$sub_row]==$markup_pro->id): ?> selected <?php endif; ?>><?php echo e($markup_pro->value); ?></option>
					                                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					                                        	</select>

					                                        	<!-- select discount coupon -->
					                                        	<select class="coupon_discount number_test form-control coupon_discount_first" name="NewPrice[<?php echo e($b1); ?>][coupon_discount][<?php echo e($sub_row); ?>]" <?php if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==3): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
					                                        		<option coupon_id="0" value="0">Select Coupon</option>
					                                        		<?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $markup_pro): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					                                        			<option coupon_id="<?php echo e($markup_pro->id); ?>"  value="<?php echo e($markup_pro->id); ?>" <?php if($col['coupon_discount'][$sub_row]==$markup_pro->id): ?> selected <?php endif; ?>><?php echo e($markup_pro->coupon_name); ?></option>
					                                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					                                        	</select>

						                                        <div class="d_price<?php echo e($b1); ?><?php echo e($sub_row); ?>" id="d_price<?php echo e($b1); ?><?php echo e($sub_row); ?>" >
																	<input type="hidden" value="<?php echo e($col['sunday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][sunday_discount_type][<?php echo e($sub_row); ?>]"  class="sunday_discount_type">
																	<input type="hidden" value="<?php echo e($col['sunday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][sunday_normal_discount][<?php echo e($sub_row); ?>]"  class="sunday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['sunday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][sunday_coupon_discount][<?php echo e($sub_row); ?>]"  class="sunday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['monday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][monday_discount_type][<?php echo e($sub_row); ?>]"  class="monday_discount_type">
																	<input type="hidden" value="<?php echo e($col['monday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][monday_normal_discount][<?php echo e($sub_row); ?>]"  class="monday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['monday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][monday_coupon_discount][<?php echo e($sub_row); ?>]"  class="monday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['tuesday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][tuesday_discount_type][<?php echo e($sub_row); ?>]"  class="tuesday_discount_type">
																	<input type="hidden" value="<?php echo e($col['tuesday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][tuesday_normal_discount][<?php echo e($sub_row); ?>]"  class="tuesday_normal_discount">
																	<input type="hidden" <?php if(array_key_exists($sub_row,$col['tuesday_coupon_discount'])): ?> value="<?php echo e($col['tuesday_coupon_discount'][$sub_row]); ?>" <?php endif; ?> name="NewPrice[<?php echo e($b1); ?>][tuesday_coupon_discount][<?php echo e($sub_row); ?>]"  class="tuesday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['wednesday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][wednesday_discount_type][<?php echo e($sub_row); ?>]"  class="wednesday_discount_type">
																	<input type="hidden" value="<?php echo e($col['wednesday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][wednesday_normal_discount][<?php echo e($sub_row); ?>]"  class="wednesday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['wednesday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][wednesday_coupon_discount][<?php echo e($sub_row); ?>]"  class="wednesday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['thursday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][thursday_discount_type][<?php echo e($sub_row); ?>]"  class="thursday_discount_type">
																	<input type="hidden" value="<?php echo e($col['thursday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][thursday_normal_discount][<?php echo e($sub_row); ?>]"  class="thursday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['thursday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][thursday_coupon_discount][<?php echo e($sub_row); ?>]"  class="thursday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['friday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][friday_discount_type][<?php echo e($sub_row); ?>]"  class="friday_discount_type">
																	<input type="hidden" value="<?php echo e($col['friday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][friday_normal_discount][<?php echo e($sub_row); ?>]"  class="friday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['friday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][friday_coupon_discount][<?php echo e($sub_row); ?>]"  class="friday_coupon_discount">
																	<input type="hidden" value="<?php echo e($col['saturday_discount_type'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][saturday_discount_type][<?php echo e($sub_row); ?>]"  class="saturday_discount_type">
																	<input type="hidden" value="<?php echo e($col['saturday_normal_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][saturday_normal_discount][<?php echo e($sub_row); ?>]"  class="saturday_normal_discount">
																	<input type="hidden" value="<?php echo e($col['saturday_coupon_discount'][$sub_row]); ?>" name="NewPrice[<?php echo e($b1); ?>][saturday_coupon_discount][<?php echo e($sub_row); ?>]"  class="saturday_coupon_discount">
																</div>
																
																<button
																	<?php if(array_key_exists('applicable_for',$col) && $col['applicable_for'][$sub_row]=='day_wise'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price<?php echo e($b1); ?><?php echo e($sub_row); ?>">Add Price
																</button>
															</div>
														</td>
														
				                                        <td>
				                                        	<?php if($sub_count==0): ?>
				                                        		<button type="button" name="add" id="row_id_<?php echo e($b1); ?>"  class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button>
				                                        	<?php else: ?>
				                                        		<button type="button" name="remove_price_range" id="<?php echo e($b1); ?>_<?php echo e($sub_row); ?>" class="remove_price_range btn btn-danger">X</button>
				                                        	<?php endif; ?>
				                                        </td>
				                                      </tr>
				                                    </table>
				                                    <?php
				                                      $sub_count++;
				                                    ?>
				                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				                                </td>
				                                <?php if($b1>0): ?>
				                                <td>
				                                	<button type="button" name="remove" id="<?php echo e($a1); ?>" class="btn btn-danger btn_remove_new_price">X</button>
				                                </td>
				                                <?php endif; ?>
				                            </tr>
				                            <?php
			                                	$a1++;
			                                	$b1++;
			                                ?>
			                                <?php endif; ?>
			                              	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			                            <?php endif; ?>
		                          	</table>

		                          	<!-- add price category -->
		                          	<button type="button" name="add" id="add-new-price-row" class="btn btn-success">Add price category</button>
	                      		</div>
                  			</div>
                      </div>