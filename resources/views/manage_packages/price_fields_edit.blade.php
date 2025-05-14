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
												<option value="1" @if($packagesData->show_status==1) selected @endif>Show</option>
												<option value="0" @if($packagesData->show_status==0) selected @endif>Hide</option>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="field-required">No of Rooms</label>
											<select class="form-control select_room" name="no_of_room">
												@for($i=1; $i<=10; $i++)
													<option value="{{$i}}">{{$i}}</option>
												@endfor
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
										@if($rooms!='')
											<?php
												$m=1;
												$k=0;
											?>
											@foreach($rooms as $row=>$col)
											@if($m>1)
												<div id="fourrow{{ $i }}">
													<div class="col-md-12">
														<div class="room-container">
															<div>
																<!-- room no -->
																<div>
																	<div class="title">Room {{ $m }}</div>
																</div>

																<!-- guest allowed in a room -->
																<div class="makeflex align-center">
																	<label class="field-required">Max. guests allowed</label>
																	<select class="form-control apndLft5 max_passenger" name="room[{{$k}}][max_passenger]" style="max-width: 90px;border-radius: 3px;">
																		@for($i=1; $i<=10; $i++)
																			<option value="{{ $i }}" @if($i==$col['max_passenger']) selected @endif>{{ $i }}</option>
																		@endfor
																	</select>
																</div>

																<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][twin_adult_room]" class="twin_adult_room_value" value="{{$col['twin_adult_room']}}">
																			<span class="travellersMinus twin_adult_room_dec">−</span>
																			<span class="travellersValue twin_adult_room_result">{{$col['twin_adult_room']}}</span>
																			<span class="travellersPlus twin_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][extra_adult_room]" class="extra_adult_room_value" value="{{$col['extra_adult_room']}}">
																			<span class="travellersMinus extra_adult_room_dec">−</span>
																			<span class="travellersValue extra_adult_room_result">{{$col['extra_adult_room']}}</span>
																			<span class="travellersPlus extra_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][child_with_bed_room]" class="child_with_bed_room_value" value="{{$col['child_with_bed_room']}}">
																			<span class="travellersMinus child_with_bed_room_dec">−</span>
																			<span class="travellersValue child_with_bed_room_result">{{$col['child_with_bed_room']}}</span>
																			<span class="travellersPlus child_with_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][child_without_bed_room]" class="child_without_bed_room_value" value="{{$col['child_without_bed_room']}}">
																			<span class="travellersMinus child_without_bed_room_dec">−</span>
																			<span class="travellersValue child_without_bed_room_result">{{$col['child_without_bed_room']}}</span>
																			<span class="travellersPlus child_without_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][infant_room]" class="span_value_child_with_bed infant_room_value" value="{{$col['infant_room']}}">
																			<span class="travellersMinus infant_room_dec">−</span>
																			<span class="travellersValue infant_room_result">{{$col['infant_room']}}</span>
																			<span class="travellersPlus infant_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][single_room]" class="single_room_value" value="{{$col['single_room']}}">
																			<span class="travellersMinus single_room_dec">−</span>
																			<span class="travellersValue single_room_result">{{$col['single_room']}}</span>
																			<span class="travellersPlus single_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Single<br>(+12yrs)</p>
																	</div>
																</div>

																<!-- add more rooms -->
																<div class="text-center">
																	<button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove_four" style="margin-bottom: 5px">x Remove </button>
																</div>
															</div>
														</div>
													</div>
													<!-- </div> -->
												</div>
												@else
												<div id="fourrow{{ $i }}">
													<!-- <div class="row"> -->
													<div class="col-md-12">
														<div class="room-container">
															<div>
																<!-- room no -->
																<div class="">
																	<div class="title">Room {{ $m }}</div>
																</div>

																<!-- guest allowed in a room -->
																<div class="makeflex align-center">
																	<label class="field-required">Max. guests allowed</label>
																	<select class="form-control apndLft5 max_passenger" name="room[{{$k}}][max_passenger]">
																		@for($i=1; $i<=10; $i++)
																			<option value="{{ $i }}" @if($i==$col['max_passenger']) selected @endif>{{ $i }}</option>
																		@endfor
																	</select>
																</div>

																<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][twin_adult_room]" class="twin_adult_room_value" value="{{$col['twin_adult_room']}}">
																			<span class="travellersMinus twin_adult_room_dec">−</span>
																			<span class="travellersValue twin_adult_room_result">{{$col['twin_adult_room']}}</span>
																			<span class="travellersPlus twin_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][extra_adult_room]" class="extra_adult_room_value" value="{{$col['extra_adult_room']}}">
																			<span class="travellersMinus extra_adult_room_dec">−</span>
																			<span class="travellersValue extra_adult_room_result">{{$col['extra_adult_room']}}</span>
																			<span class="travellersPlus extra_adult_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][child_with_bed_room]" class="child_with_bed_room_value" value="{{$col['child_with_bed_room']}}">
																			<span class="travellersMinus child_with_bed_room_dec">−</span>
																			<span class="travellersValue child_with_bed_room_result">{{$col['child_with_bed_room']}}</span>
																			<span class="travellersPlus child_with_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][child_without_bed_room]" class="child_without_bed_room_value" value="{{$col['child_without_bed_room']}}">
																			<span class="travellersMinus child_without_bed_room_dec">−</span>
																			<span class="travellersValue child_without_bed_room_result">{{$col['child_without_bed_room']}}</span>
																			<span class="travellersPlus child_without_bed_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][infant_room]" class="span_value_child_with_bed infant_room_value" value="{{$col['infant_room']}}">
																			<span class="travellersMinus infant_room_dec">−</span>
																			<span class="travellersValue infant_room_result">{{$col['infant_room']}}</span>
																			<span class="travellersPlus infant_room_inc">+</span>
																		</div>
																		<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
																	</div>
																	<div>
																		<div class="addTravellerValue">
																			<input type="hidden" id="travellers" name="room[{{$k}}][single_room]" class="single_room_value" value="{{$col['single_room']}}">
																			<span class="travellersMinus single_room_dec">−</span>
																			<span class="travellersValue single_room_result">{{$col['single_room']}}</span>
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
											@endif
											<?php
												$m++;
												$k++;
											?>
											@endforeach
										@else
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
																@for($i=1; $i<=10; $i++)
																	<option value="{{ $i }}" @if($i==7) selected @endif>{{ $i }}</option>
																@endfor
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
										@endif
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
												<option value="1" @if($packagesData->Price_type=="Per Person" || $packagesData->Price_type=="1") selected="selected" @endif >Per Person</option>
												<option value="2" @if($packagesData->Price_type=="Per Group" || $packagesData->Price_type=="2") selected="selected" @endif>Per Group</option>
											</select>
										</div>
									</div>

									<!-- select price tag -->
									<div class="col-md-3">
										<div class="form-group">
											<label class="field-required">Price Type Tag</label>
											<select class="form-control" name="priceremarks">
												<option value="Price Per Person" @if($packagesData->priceremarks=="Price Per Person") selected="selected" @endif>Price Per Person (inclusive of taxes)</option>
												<option value="Price Group" @if($packagesData->priceremarks=="Price Group") selected="selected" @endif>Price for all Person (inclusive of taxes)</option>
											</select>
										</div>
									</div>

									<!-- remarks -->
									<div class="col-md-3">
										<div class="form-group">
											<label>Remarks</label>
											<input type="text" name="remarks" class="form-control" placeholder="Enter price remarks (if any) ..." value="{{ $packagesData->anything  }}">
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
															@foreach($rates as $rate)
															<option value="{{ $rate->id}}" c_val="{{$rate->rate}}" @if($packagesData->currency==$rate->id) selected @endif>{{ $rate-> currency }}</option>
															@endforeach
															</option>
														</select>
														<input type="text" name="roe" class="form-control packages_rate number_test" placeholder="ROE" value="{{ $packagesData->roe}}">
													</div>
													<div class="currencyConversion">
														<input type="text" value="{{ $packagesData->indian_rate}}" name="indian_rate" class="form-control packages_value number_test" placeholder="Enter">
														<input type="text"  value="{{ $packagesData->total_value}}" name="total_value" class="form-control backgroundColorF2 packages_total number_test" placeholder="Value" readonly>
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
														<input type="hidden" id="travellers" name="packages_number_of_adult" class="packages_number_of_adult packages_adult_room_value" value="{{ $packagesData->adult}}">
														<span class="travellersValue packages_adult_room_result">{{ $packagesData->adult}}</span>
													</div>
													<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">EXTRA ADULT</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="extra_adult" class="packages_number_of_extra_adult packages_child_extra_adult_value" value="{{ $packagesData->extra_adult}}">
														<span class="travellersValue packages_child_extra_adult_result">{{ $packagesData->extra_adult}}</span>
													</div>
													<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">CHILD</p>
													<p class="itemTopSubHeading">(WITH BED)</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="child_with_bed" class="packages_number_of_child_with_bed packages_child_with_bed_value" value="{{ $packagesData->child_with_bed}}">
														<span class="travellersValue packages_child_with_bed_result">{{ $packagesData->child_with_bed}}</span>
													</div>
													<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">CHILD</p>
													<p class="itemTopSubHeading">(WITHOUT BED)</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="child_without_bed" class="packages_number_of_child_without_bed packages_childwithoutbed_value" value="{{ $packagesData->child_without_bed}}">
														<!-- <span class="travellersMinus packages_childwithoutbed_dec">&#8722;</span> -->
														<span class="travellersValue packages_span_value_childwithoutbed_result">{{ $packagesData->child_without_bed}}</span>
													</div>
													<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">INFANT</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="infant" class="packages_number_of_infant packages_infant_value" value="{{ $packagesData->infant}}">
														<span class="travellersValue packages_infant_result">{{ $packagesData->infant}}</span>
													</div>
													<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
												</th>
												<th>
													<!-- <p class="itemTopHeading">SINGLE<br>TRAVELLER</p> -->
													<div class="addTravellerValue">
														<input type="hidden" id="travellers" name="solo_traveller" class="packages_number_solo_traveller packages_solo_value" value="{{ $packagesData->solo_traveller}}">
														<span class="travellersValue packages_solo_result">{{ $packagesData->solo_traveller}}</span>
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
													@foreach($supplier as $suppliers)
													<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['package_airfare']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
													@endforeach
												</select>
												<input type="hidden" name="newprice[package_airfare_remarks]" id="remarks_airfare" value="{{$new_price['package_airfare_remarks']}}">
												</td>
												<td>
													<select class="form-control aircurrency" name="newprice[aircurrency]">
													@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['aircurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_air_adult adult_disable" name="newprice[package_air_adult]" @if($new_price["package_air_adult"]!="") value="{{$new_price["package_air_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_air_exadult exadult_disable" name="newprice[package_air_exadult]" @if($new_price["package_air_exadult"]!="") value="{{$new_price["package_air_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_air_childbed childbed_disable" name="newprice[package_air_childbed]" @if($new_price["package_air_childbed"]!="") value="{{$new_price["package_air_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_air_childwbed childwbed_disable" name="newprice[package_air_childwbed]" @if($new_price["package_air_childwbed"]!="") value="{{$new_price["package_air_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_air_infant infant_disable" name="newprice[package_air_infant]" @if($new_price["package_air_infant"]!="") value="{{$new_price["package_air_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_air_single single_disable" name="newprice[package_air_single]" @if($new_price["package_air_single"]!="") value="{{$new_price["package_air_single"]}}"  @endif></td>
											</tr>

											<!--Cruise Start-->
											<tr>
												<td>Cruise Fare</td>
												<td class="makeflex">
													<select class="form-control supplier" name="newprice[package_cruise_fare]" id="cruise_fare">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" lect_name="{{$suppliers->suppliercompanyname}}" @if($new_price['package_cruise_fare']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden"  name="newprice[package_cruise_fare_remarks]"  id="remarks_cruise_fare" value="{{$new_price['package_cruise_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control cruisecurrency" name="newprice[cruisecurrency]">
													@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['cruisecurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruise_adult adult_disable" name="newprice[package_cruise_adult]" @if($new_price["package_cruise_adult"]!="") value="{{$new_price["package_cruise_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruise_exadult exadult_disable" name="newprice[package_cruise_exadult]" @if($new_price["package_cruise_exadult"]!="") value="{{$new_price["package_cruise_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruise_childbed childbed_disable" name="newprice[package_cruise_childbed]" @if($new_price["package_cruise_childbed"]!="") value="{{$new_price["package_cruise_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruise_childwbed childwbed_disable" name="newprice[package_cruise_childwbed]" @if($new_price["package_cruise_childwbed"]!="") value="{{$new_price["package_cruise_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruise_infant infant_disable" name="newprice[package_cruise_infant]" @if($new_price["package_cruise_infant"]!="") value="{{$new_price["package_cruise_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruise_single single_disable" name="newprice[package_cruise_single]" @if($new_price["package_cruise_single"]!="") value="{{$new_price["package_cruise_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Port Charges </td>
												<td class="makeflex">
													<select class="form-control supplier" id="port_charge_fare" name="newprice[port_charge_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['port_charge_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="{{$new_price['port_charge_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control portchargecurrency" name="newprice[portchargecurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['portchargecurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruiseport_adult adult_disable" name="newprice[package_cruiseport_adult]" @if($new_price["package_cruiseport_adult"]!="") value="{{$new_price["package_cruiseport_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_exadult exadult_disable" name="newprice[package_cruiseport_exadult]" @if($new_price["package_cruiseport_exadult"]!="") value="{{$new_price["package_cruiseport_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_childbed childbed_disable" name="newprice[package_cruiseport_childbed]" @if($new_price["package_cruiseport_childbed"]!="") value="{{$new_price["package_cruiseport_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_childwbed childwbed_disable" name="newprice[package_cruiseport_childwbed]" @if($new_price["package_cruiseport_childwbed"]!="") value="{{$new_price["package_cruiseport_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_infant infant_disable" name="newprice[package_cruiseport_infant]" @if($new_price["package_cruiseport_infant"]!="") value="{{$new_price["package_cruiseport_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruiseport_single single_disable" name="newprice[package_cruiseport_single]" @if($new_price["package_cruiseport_single"]!="") value="{{$new_price["package_cruiseport_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Gratuity</td>
												<td class="makeflex">
													<select class="form-control supplier" id="gratuity_fare" name="newprice[gratuity_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['gratuity_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
												<input type="hidden" name="newprice[gratuity_remarks]" id="remarks_gratuity_fare" value="{{$new_price['gratuity_remarks']}}">
												</td>
												<td>
												<select class="form-control gratuitycurrency" name="newprice[gratuitycurrency]">
												@foreach($rates as $rate)
												<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['gratuitycurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
												@endforeach
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_adult adult_disable" name="newprice[package_cruisegratuity_adult]" @if($new_price["package_cruisegratuity_adult"]!="") value="{{$new_price["package_cruisegratuity_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_exadult exadult_disable" name="newprice[package_cruisegratuity_exadult]" @if($new_price["package_cruisegratuity_exadult"]!="") value="{{$new_price["package_cruisegratuity_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_childbed childbed_disable" name="newprice[package_cruisegratuity_childbed]" @if($new_price["package_cruisegratuity_childbed"]!="") value="{{$new_price["package_cruisegratuity_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_childwbed childwbed_disable" name="newprice[package_cruisegratuity_childwbed]" @if($new_price["package_cruisegratuity_childwbed"]!="") value="{{$new_price["package_cruisegratuity_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_infant infant_disable" name="newprice[package_cruisegratuity_infant]" @if($new_price["package_cruisegratuity_infant"]!="") value="{{$new_price["package_cruisegratuity_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegratuity_single single_disable" name="newprice[package_cruisegratuity_single]" @if($new_price["package_cruisegratuity_single"]!="") value="{{$new_price["package_cruisegratuity_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Cruise GST </td>
												<td class="makeflex">
													<select class="form-control supplier" id="cruise_gst_fare" name="newprice[cruise_gst_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['cruise_gst_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
												<input type="hidden" name="newprice[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="{{$new_price['cruise_gst_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control cruise_gstcurrency" name="newprice[cruise_gstcurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['cruise_gstcurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_cruisegst_adult adult_disable" name="newprice[package_cruisegst_adult]" @if($new_price["package_cruisegst_adult"]!="") value="{{$new_price["package_cruisegst_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_exadult exadult_disable" name="newprice[package_cruisegst_exadult]" @if($new_price["package_cruisegst_exadult"]!="") value="{{$new_price["package_cruisegst_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_childbed childbed_disable" name="newprice[package_cruisegst_childbed]" @if($new_price["package_cruisegst_childbed"]!="") value="{{$new_price["package_cruisegst_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_childwbed childwbed_disable" name="newprice[package_cruisegst_childwbed]" @if($new_price["package_cruisegst_childwbed"]!="") value="{{$new_price["package_cruisegst_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_infant infant_disable" name="newprice[package_cruisegst_infant]" @if($new_price["package_cruisegst_infant"]!="") value="{{$new_price["package_cruisegst_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_cruisegst_single single_disable" name="newprice[package_cruisegst_single]" @if($new_price["package_cruisegst_single"]!="") value="{{$new_price["package_cruisegst_single"]}}"  @endif></td>
											</tr>

											<!--Cruise End-->
											<tr>
												<td>Accommodation</td>
												<td class="makeflex">
													<select class="form-control supplier" id="accommodation_fare" name="newprice[accommodation_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['accommodation_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
												<input type="hidden" name="newprice[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="{{$new_price['accommodation_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control accommodationcurrency" name="newprice[accommodationcurrency]">
													@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['accommodationcurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_hotel_adult adult_disable" name="newprice[package_hotel_adult]" id="" @if($new_price["package_hotel_adult"]!="") value="{{$new_price["package_hotel_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_hotel_exadult exadult_disable" name="newprice[package_hotel_exadult]" @if($new_price["package_hotel_exadult"]!="") value="{{$new_price["package_hotel_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_hotel_childbed childbed_disable" name="newprice[package_hotel_childbed]" @if($new_price["package_hotel_childbed"]!="") value="{{$new_price["package_hotel_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_hotel_childwbed childwbed_disable" name="newprice[package_hotel_childwbed]" @if($new_price["package_hotel_childwbed"]!="") value="{{$new_price["package_hotel_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_hotel_infant infant_disable" name="newprice[package_hotel_infant]" @if($new_price["package_hotel_infant"]!="") value="{{$new_price["package_hotel_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_hotel_single single_disable" name="newprice[package_hotel_single]" @if($new_price["package_hotel_single"]!="") value="{{$new_price["package_hotel_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Sightseeing</td>
												<td class="makeflex">
													<select class="form-control supplier" id="sightseeing_fare" name="newprice[sightseeing_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['sightseeing_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="{{$new_price['sightseeing_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control sightseeingcurrency" name="newprice[sightseeingcurrency]">
													@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['sightseeingcurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_tours_adult adult_disable" name="newprice[package_tours_adult]" @if($new_price["package_tours_adult"]!="") value="{{$new_price["package_tours_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tours_exadult exadult_disable" name="newprice[package_tours_exadult]" @if($new_price["package_tours_exadult"]!="") value="{{$new_price["package_tours_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tours_childbed childbed_disable" name="newprice[package_tours_childbed]" @if($new_price["package_tours_childbed"]!="") value="{{$new_price["package_tours_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tours_childwbed childwbed_disable" name="newprice[package_tours_childwbed]" @if($new_price["package_tours_childwbed"]!="") value="{{$new_price["package_tours_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tours_infant infant_disable" name="newprice[package_tours_infant]" @if($new_price["package_tours_infant"]!="") value="{{$new_price["package_tours_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tours_single single_disable" name="newprice[package_tours_single]" @if($new_price["package_tours_single"]!="") value="{{$new_price["package_tours_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Transfers</td>
												<td class="makeflex">
													<select class="form-control supplier" id="transfers_fare" name="newprice[transfers_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['transfers_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[transfers_fare_remarks]" id="remarks_transfers_fare" value="{{$new_price['transfers_fare_remarks']}}">
												</td>
												<td>
												<select class="form-control transferscurrency" name="newprice[transferscurrency]">
													@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['transferscurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_transfer_adult adult_disable" name="newprice[package_transfer_adult]" @if($new_price["package_transfer_adult"]!="") value="{{$new_price["package_transfer_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_transfer_exadult exadult_disable" name="newprice[package_transfer_exadult]" @if($new_price["package_transfer_exadult"]!="") value="{{$new_price["package_transfer_exadult"]}}"  @endif ></td>
												<td><input type="text" class="form-control number_test packages_transfer_childbed childbed_disable" name="newprice[package_transfer_childbed]" @if($new_price["package_transfer_childbed"]!="") value="{{$new_price["package_transfer_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_transfer_childwbed childwbed_disable" name="newprice[package_transfer_childwbed]" @if($new_price["package_transfer_childwbed"]!="") value="{{$new_price["package_transfer_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_transfer_infant infant_disable" name="newprice[package_transfer_infant]" @if($new_price["package_transfer_infant"]!="") value="{{$new_price["package_transfer_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_transfer_single single_disable" name="newprice[package_transfer_single]" @if($new_price["package_transfer_single"]!="") value="{{$new_price["package_transfer_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td>Visa Charges</td>
												<td class="makeflex">
													<select class="form-control supplier" id="visa_charges_fare" name="newprice[visa_charges_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['visa_charges_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
												<input type="hidden" name="newprice[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="{{$new_price['visa_charges_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control visacurrency" name="newprice[visacurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['visacurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_visa_adult adult_disable" name="newprice[package_visa_adult]" @if($new_price["package_visa_adult"]!="") value="{{$new_price["package_visa_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_visa_exadult exadult_disable" name="newprice[package_visa_exadult]" @if($new_price["package_visa_exadult"]!="") value="{{$new_price["package_visa_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_visa_childbed childbed_disable" name="newprice[package_visa_childbed]" @if($new_price["package_visa_childbed"]!="") value="{{$new_price["package_visa_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_visa_childwbed childwbed_disable" name="newprice[package_visa_childwbed]" @if($new_price["package_visa_childwbed"]!="") value="{{$new_price["package_visa_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_visa_infant infant_disable" name="newprice[package_visa_infant]" @if($new_price["package_visa_infant"]!="") value="{{$new_price["package_visa_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_visa_single single_disable" name="newprice[package_visa_single]" @if($new_price["package_visa_single"]!="") value="{{$new_price["package_visa_single"]}}"  @endif></td>
											</tr>

											<tr>
												<td> Travel Insurance</td>
												<td class="makeflex">
													<select class="form-control supplier" id="travel_insurance_fare" name="newprice[travel_insurance_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['travel_insurance_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="{{$new_price['travel_insurance_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control travelcurrency" name="newprice[travelcurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['travelcurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_inc_adult adult_disable" name="newprice[package_inc_adult]" @if($new_price["package_inc_adult"]!="") value="{{$new_price["package_inc_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_inc_exadult exadult_disable" name="newprice[package_inc_exadult]" @if($new_price["package_inc_exadult"]!="") value="{{$new_price["package_inc_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_inc_childbed childbed_disable" name="newprice[package_inc_childbed]" @if($new_price["package_inc_childbed"]!="") value="{{$new_price["package_inc_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_inc_childwbed childwbed_disable" name="newprice[package_inc_childwbed]" @if($new_price["package_inc_childwbed"]!="") value="{{$new_price["package_inc_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_inc_infant infant_disable" name="newprice[package_inc_infant]" @if($new_price["package_inc_infant"]!="") value="{{$new_price["package_inc_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_inc_single single_disable" name="newprice[package_inc_single]" @if($new_price["package_inc_single"]!="") value="{{$new_price["package_inc_single"]}}"  @endif></td>
											</tr>

											<!--Meals  Start-->
											<tr>
												<td>Meals</td>
												<td class="makeflex">
													<select class="form-control supplier" id="meals_fare" name="newprice[meals_fare_supplier]">
														<option value="0" select_name="0">Select</option>
														@foreach($supplier as $suppliers)
														<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['meals_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[meals_fare_remarks]" id="remarks_meals_fare" value="{{$new_price['meals_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control mealscurrency" name="newprice[mealscurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['mealscurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_meals_adult adult_disable" name="newprice[package_meals_adult]" @if($new_price["package_meals_adult"]!="") value="{{$new_price["package_meals_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_meals_exadult exadult_disable" name="newprice[package_meals_exadult]" @if($new_price["package_meals_exadult"]!="") value="{{$new_price["package_meals_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_meals_childbed childbed_disable" name="newprice[package_meals_childbed]" @if($new_price["package_meals_childbed"]!="") value="{{$new_price["package_meals_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_meals_childwbed childwbed_disable" name="newprice[package_meals_childwbed]" @if($new_price["package_meals_childwbed"]!="") value="{{$new_price["package_meals_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_meals_infant infant_disable" name="newprice[package_meals_infant]" @if($new_price["package_meals_infant"]!="") value="{{$new_price["package_meals_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_meals_single single_disable" name="newprice[package_meals_single]" @if($new_price["package_meals_single"]!="") value="{{$new_price["package_meals_single"]}}"  @endif></td>
											</tr>

											<!--Meals End-->
											<!--Additional Service-->
											<tr>
												<td>Addon Service</td>
												<td class="makeflex">
													<select class="form-control supplier" id="addon_service_fare" name="newprice[addon_service_fare_supplier]">
													<option value="0" select_name="0">Select</option>
													@foreach($supplier as $suppliers)
													<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($new_price['addon_service_fare_supplier']==$suppliers->id) selected @endif >{{$suppliers->suppliercompanyname}}</option>
													@endforeach
													</select>
													<input type="hidden" name="newprice[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="{{$new_price['addon_service_fare_remarks']}}">
												</td>
												<td>
													<select class="form-control addon_servicecurrency" name="newprice[addon_servicecurrency]">
													@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['addon_servicecurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_additionalservice_adult adult_disable" name="newprice[package_additionalservice_adult]" @if($new_price["package_additionalservice_adult"]!="") value="{{$new_price["package_additionalservice_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_exadult exadult_disable" name="newprice[package_additionalservice_exadult]" @if($new_price["package_additionalservice_exadult"]!="") value="{{$new_price["package_additionalservice_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_childbed childbed_disable" name="newprice[package_additionalservice_childbed]" @if($new_price["package_additionalservice_childbed"]!="") value="{{$new_price["package_additionalservice_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_childwbed childwbed_disable" name="newprice[package_additionalservice_childwbed]" @if($new_price["package_additionalservice_childwbed"]!="") value="{{$new_price["package_additionalservice_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_infant infant_disable" name="newprice[package_additionalservice_infant]" @if($new_price["package_additionalservice_infant"]!="") value="{{$new_price["package_additionalservice_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_additionalservice_single single_disable" name="newprice[package_additionalservice_single]" @if($new_price["package_additionalservice_single"]!="") value="{{$new_price["package_additionalservice_single"]}}"  @endif></td>
											</tr>

											<!--Additional Service End-->
											<!--Total before Markup-->
											<tr class="totalDisplay">
												<td>Total</td>
												<td>
												<!--<p class="currencyBox">INR</p>-->
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_adult" name="newprice[package_tourtotal_adult]" readonly="" @if($new_price["package_tourtotal_adult"]!="") value="{{$new_price["package_tourtotal_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_exadult" name="newprice[package_tourtotal_exadult]" readonly="" @if($new_price["package_tourtotal_exadult"]!="") value="{{$new_price["package_tourtotal_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_childbed" name="newprice[package_tourtotal_childbed]" readonly="" @if($new_price["package_tourtotal_childbed"]!="") value="{{$new_price["package_tourtotal_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_childwbed" name="newprice[package_tourtotal_childwbed]" readonly="" @if($new_price["package_tourtotal_childwbed"]!="") value="{{$new_price["package_tourtotal_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_infant" name="newprice[package_tourtotal_infant]" readonly="" @if($new_price["package_tourtotal_infant"]!="") value="{{$new_price["package_tourtotal_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tourtotal_single" name="newprice[package_tourtotal_single]" readonly="" @if($new_price["package_tourtotal_single"]!="") value="{{$new_price["package_tourtotal_single"]}}"  @endif></td>
											</tr>

											<!--Markup  Start-->
											<tr>
												<td class="fontItalic">Markup (Profit)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricemarkup" name="newprice[pricemarkup]">
														<option value="0" disabled="">Select</option>
														<option value="1" @if($new_price['pricemarkup']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['pricemarkup']==2) selected @endif>Percentage</option>
													</select>
													
													<select class="percentageValue number_test markup_percentage" name="newprice[markup_percentage]">
														<option value="0">Select</option>
														@foreach($markup_profit as $markup_pro)
														<option value="{{$markup_pro->value}}" @if($new_price['markup_percentage']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
														@endforeach
													</select>
												</td>

												<td>
													<select class="form-control markupcurrency" name="newprice[markupcurrency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['markupcurrency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_markup_adult adult_disable" name="newprice[package_markup_adult]" @if($new_price["package_markup_adult"]!="") value="{{$new_price["package_markup_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_markup_exadult exadult_disable" name="newprice[package_markup_exadult]" @if($new_price["package_markup_exadult"]!="") value="{{$new_price["package_markup_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_markup_childbed childbed_disable" name="newprice[package_markup_childbed]" @if($new_price["package_markup_childbed"]!="") value="{{$new_price["package_markup_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_markup_childwbed childwbed_disable" name="newprice[package_markup_childwbed]" @if($new_price["package_markup_childwbed"]!="") value="{{$new_price["package_markup_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_markup_infant infant_disable" name="newprice[package_markup_infant]" @if($new_price["package_markup_infant"]!="") value="{{$new_price["package_markup_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_markup_single single_disable" name="newprice[package_markup_single]" @if($new_price["package_markup_single"]!="") value="{{$new_price["package_markup_single"]}}"  @endif></td>
											</tr>

											<!--Discount Plus-->
											<tr>
												<td>Discount (+)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricediscountpositive" name="newprice[pricediscountpositive]">
														<option value="0" @if($new_price['pricediscountpositive']==0) selected @endif>No Discount</option>
														<option value="1" @if($new_price['pricediscountpositive']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['pricediscountpositive']==2) selected @endif>Percentage</option>
														<!-- <option value="3">Coupon</option> -->
													</select>

													<select class="percentageValue number_test discountpositive_percentage" name="newprice[discountpositive_percentage]">
														<option value="0">Select</option>
														@foreach($discunt_positive as $markup_pro)
														<option value="{{$markup_pro->value}}" @if($new_price['discountpositive_percentage']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select class="form-control discount_positive_currency" name="newprice[discount_positive_currency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['discount_positive_currency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_discount_adult_plus adult_disable" name="newprice[package_discount_adult]" @if($new_price["package_discount_adult"]!="") value="{{$new_price["package_discount_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_exadult_plus exadult_disable" name="newprice[package_discount_exadult]" @if($new_price["package_discount_exadult"]!="") value="{{$new_price["package_discount_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_childbed_plus childbed_disable" name="newprice[package_discount_childbed]" @if($new_price["package_discount_childbed"]!="") value="{{$new_price["package_discount_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_childwbed_plus childwbed_disable" name="newprice[package_discount_childwbed]" @if($new_price["package_discount_childwbed"]!="") value="{{$new_price["package_discount_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_infant_plus infant_disable" name="newprice[package_discount_infant]" @if($new_price["package_discount_infant"]!="") value="{{$new_price["package_discount_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_single_plus single_disable" name="newprice[package_discount_single]" @if($new_price["package_discount_single"]!="") value="{{$new_price["package_discount_single"]}}"  @endif></td>
											</tr>

											<!--Total before GST-->
											<tr class="grossTotalDisplay">
												<td class="tourPriceItem">Gross Total</td>
												<td>
												<!--<p class="currencyBox">INR</p>-->
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_gross_total_adult" name="newprice[package_total_adult]" readonly="" @if($new_price["package_total_adult"]!="") value="{{$new_price["package_total_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gross_total_exadult" name="newprice[package_total_exadult]" readonly="" @if($new_price["package_total_exadult"]!="") value="{{$new_price["package_total_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gross_total_childbed" name="newprice[package_total_childbed]" readonly="" @if($new_price["package_total_childbed"]!="") value="{{$new_price["package_total_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gross_total_childwbed" name="newprice[package_total_childwbed]" readonly="" @if($new_price["package_total_childwbed"]!="") value="{{$new_price["package_total_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gross_total_infant" name="newprice[package_total_infant]" readonly="" @if($new_price["package_total_infant"]!="") value="{{$new_price["package_total_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gross_total_single" name="newprice[package_total_single]" readonly="" @if($new_price["package_total_single"]!="") value="{{$new_price["package_total_single"]}}"  @endif></td>
											</tr>

											<!--Total Gross Total (Group)-->
											<tr class="grossGroupTotalDisplay">
												<td class="tourPriceItem">Gross Total (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_gross_total_group" name="newprice[package_total_group]" readonly="" @if($new_price["package_total_group"]!="") value="{{$new_price["package_total_group"]}}"  @endif>
												</td>
											</tr>

											<!--Discount Minus-->
											<tr>
												<td>Discount (-)</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricediscountnegative" name="newprice[pricediscountnegative]">
														<option value="0" @if($new_price['pricediscountnegative']==0) selected @endif>No Discount</option>
														<option value="1" @if($new_price['pricediscountnegative']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['pricediscountnegative']==2) selected @endif>Percentage</option>
														<!-- <option value="3">Coupon</option> -->
													</select>

													<select class="percentageValue number_test discountnegative_percentage" name="newprice[discountnegative_percentage]" >
														<option value="0">Select</option>
														@foreach($discunt_negative as $markup_pro)
														<option value="{{$markup_pro->value}}" @if($new_price['pricediscountnegative']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
														@endforeach
													</select>
													<input type="hidden" name="newprice[coupon_id]" class="coupon_id" value="">
													<!-- <select class="percentageValue number_test coupon_percentage" name="newprice[discount_coupon]" style="display: none;">
													<option coupon_id="0" value="0">0</option>
													</select> -->
												</td>
												<td>
												<select class="form-control discount_negative_currency" name="newprice[discount_negative_currency]">
												@foreach($rates as $rate)
													<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['discount_negative_currency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
												@endforeach
												</select>
												</td>
												<td><input type="text" class="form-control number_test packages_discount_adult_minus adult_disable" name="newprice[package_discount_minus_adult]" @if($new_price["package_discount_minus_adult"]!="") value="{{$new_price["package_discount_minus_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_exadult_minus exadult_disable" name="newprice[package_discount_minus_exadult]" @if($new_price["package_discount_minus_exadult"]!="") value="{{$new_price["package_discount_minus_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_childbed_minus childbed_disable" name="newprice[package_discount_minus_childbed]" @if($new_price["package_discount_minus_childbed"]!="") value="{{$new_price["package_discount_minus_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_childwbed_minus childwbed_disable" name="newprice[package_discount_minus_childwbed]" @if($new_price["package_discount_minus_childwbed"]!="") value="{{$new_price["package_discount_minus_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_infant_minus infant_disable" name="newprice[package_discount_minus_infant]"  @if($new_price["package_discount_minus_infant"]!="") value="{{$new_price["package_discount_minus_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_discount_single_minus single_disable" name="newprice[package_discount_minus_single]" @if($new_price["package_discount_minus_single"]!="") value="{{$new_price["package_discount_minus_single"]}}"  @endif></td>
											</tr>

											<!--Total Gross Total (Group)-->
											<tr class="discountGroupTotalDisplay">
												<td class="tourPriceItem">Discount (-) (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_discount_group" name="newprice[package_total_discount_group]" readonly="" @if($new_price["package_total_discount_group"]!="") value="{{$new_price["package_total_discount_group"]}}"  @endif>
												</td>
											</tr>

											<!--GST Starts-->
											<tr>
												<td class="fontItalic">(+) GST</td>
												<td class="makeflex">
													<select class="fixedValue pricegst" name="newprice[package_gst_curr]">
														<option value="0" @if($new_price['package_gst_curr']==0) selected @endif>Select</option>
														<option value="1" @if($new_price['package_gst_curr']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['package_gst_curr']==2) selected @endif>Percentage</option>
														</select>
														<select class="percentageValue number_test gst_percentage" name="newprice[gst_percentage]">
														<option value="0">Select</option>
														@foreach($gst as $gst)
														<option value="{{$gst->value}}" @if($new_price['package_gst_curr']==$gst->value) selected @endif>{{$gst->value}}</option>
													@endforeach
													</select>
												</td>
												<td>
													<select class="form-control gst_currency" name="newprice[gst_currency]">
													@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['gst_currency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
													@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_gst_adult adult_disable" name="newprice[package_gst_adult]" @if($new_price["package_gst_adult"]!="") value="{{$new_price["package_gst_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gst_exadult exadult_disable" name="newprice[package_gst_exadult]" @if($new_price["package_gst_exadult"]!="") value="{{$new_price["package_gst_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gst_childbed childbed_disable" name="newprice[package_gst_childbed]" @if($new_price["package_gst_childbed"]!="") value="{{$new_price["package_gst_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gst_childwbed childwbed_disable" name="newprice[package_gst_childwbed]" @if($new_price["package_gst_childwbed"]!="") value="{{$new_price["package_gst_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gst_infant infant_disable" name="newprice[package_gst_infant]" @if($new_price["package_gst_infant"]!="") value="{{$new_price["package_gst_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gst_single single_disable" name="newprice[package_gst_single]" @if($new_price["package_gst_single"]!="") value="{{$new_price["package_gst_single"]}}"  @endif></td>
											</tr>
											
											<!--Total GST (Group)-->
											<tr class="gstGroupTotalDisplay">
												<td class="tourPriceItem">GST (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td>
													<input type="text" class="form-control number_test packages_gst_group" name="newprice[package_total_gst_group]" readonly="" @if($new_price["package_total_gst_group"]!="") value="{{$new_price["package_total_gst_group"]}}"  @endif>
												</td>
											</tr>

											<!--Total after GST-->
											<tr class="gstTotalDisplay">
												<td class="tourPriceItem">Total with GST</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_adult" name="newprice[package_gsttotal_adult]" readonly="" @if($new_price["package_gsttotal_adult"]!="") value="{{$new_price["package_gsttotal_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_exadult" name="newprice[package_gsttotal_exadult]" readonly="" @if($new_price["package_gsttotal_exadult"]!="") value="{{$new_price["package_gsttotal_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_childbed" name="newprice[package_gsttotal_childbed]" readonly="" @if($new_price["package_gsttotal_childbed"]!="") value="{{$new_price["package_gsttotal_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_childwbed" name="newprice[package_gsttotal_childwbed]" readonly="" @if($new_price["package_gsttotal_childwbed"]!="") value="{{$new_price["package_gsttotal_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_infant" name="newprice[package_gsttotal_infant]" readonly="" @if($new_price["package_gsttotal_infant"]!="") value="{{$new_price["package_gsttotal_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_gsttotal_single" name="newprice[package_gsttotal_single]" readonly="" @if($new_price["package_gsttotal_single"]!="") value="{{$new_price["package_gsttotal_single"]}}"  @endif></td>
											</tr>

											<!--TCS Starts-->
											<tr>
												<td class="fontItalic">(+) TCS</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricetcs" name="newprice[package_tcs_curr]">
														<option value="0" @if($new_price['package_tcs_curr']==0) selected @endif>Select</option>
														<option value="1" @if($new_price['package_tcs_curr']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['package_tcs_curr']==2) selected @endif>Percentage</option>
													</select>

													<select class="percentageValue number_test tcs_percentage" name="newprice[tcs_percentage]">
														<option value="0">Select</option>
														@foreach($tcs as $tcs)
														<option value="{{$tcs->value}}" @if($new_price['package_tcs_curr']==$tcs->value) selected @endif>{{$tcs->value}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select class="form-control tcs_currency" name="newprice[tcs_currency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['tcs_currency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_tcs_adult adult_disable" name="newprice[package_tcs_adult]" @if($new_price["package_tcs_adult"]!="") value="{{$new_price["package_tcs_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcs_exadult exadult_disable" name="newprice[package_tcs_exadult]" @if($new_price["package_tcs_exadult"]!="") value="{{$new_price["package_tcs_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcs_childbed childbed_disable" name="newprice[package_tcs_childbed]" @if($new_price["package_tcs_childbed"]!="") value="{{$new_price["package_tcs_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcs_childwbed childwbed_disable" name="newprice[package_tcs_childwbed]" @if($new_price["package_tcs_childwbed"]!="") value="{{$new_price["package_tcs_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcs_infant infant_disable" name="newprice[package_tcs_infant]" @if($new_price["package_tcs_infant"]!="") value="{{$new_price["package_tcs_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcs_single single_disable" name="newprice[package_tcs_single]" @if($new_price["package_tcs_single"]!="") value="{{$new_price["package_tcs_single"]}}"  @endif></td>
											</tr>

											<!--Total TCS (Group)-->
											<tr class="tcsGroupTotalDisplay">
												<td class="tourPriceItem">TCS (Group)</td>
												<td>
												<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tcs_group" name="newprice[package_total_tcs_group]" readonly="" @if($new_price["package_total_tcs_group"]!="") value="{{$new_price["package_total_tcs_group"]}}"  @endif></td>
											</tr>

											<!--Total after TCS-->
											<tr class="tcsTotalDisplay">
												<td class="tourPriceItem">Total with TCS</td>
												<td>
												<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_adult" name="newprice[package_tcstotal_adult]" readonly="" @if($new_price["package_tcstotal_adult"]!="") value="{{$new_price["package_tcstotal_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_exadult" name="newprice[package_tcstotal_exadult]" readonly="" @if($new_price["package_tcstotal_exadult"]!="") value="{{$new_price["package_tcstotal_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_childbed" name="newprice[package_tcstotal_childbed]" readonly="" @if($new_price["package_tcstotal_childbed"]!="") value="{{$new_price["package_tcstotal_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_childwbed" name="newprice[package_tcstotal_childwbed]" readonly="" @if($new_price["package_tcstotal_childwbed"]!="") value="{{$new_price["package_tcstotal_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_infant" name="newprice[package_tcstotal_infant]" readonly="" @if($new_price["package_tcstotal_infant"]!="") value="{{$new_price["package_tcstotal_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_tcstotal_single" name="newprice[package_tcstotal_single]" readonly="" @if($new_price["package_tcstotal_single"]!="") value="{{$new_price["package_tcstotal_single"]}}"  @endif></td>
											</tr>

											<!--PG Charges Starts-->
											<tr>
												<td class="fontItalic">(+) PG Charges</td>
												<td class="makeflex gap5">
													<select class="fixedValue pricepgcharges" name="newprice[pg_charges]">
														<option value="0" @if($new_price['pg_charges']==0) selected @endif>Select</option>
														<option value="1" @if($new_price['pg_charges']==1) selected @endif>Fixed</option>
														<option value="2" @if($new_price['pg_charges']==2) selected @endif>Percentage</option>
													</select>

													<select class="percentageValue number_test pgcharges_percentage" name="newprice[pgcharges_percentage]">
														<option value="0">Select</option>
														@foreach($pg as $pg)
														<option value="{{$pg->value}}" @if($new_price['pg_charges']==$pg->value) selected @endif>{{$pg->value}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select class="form-control pgcharges_currency" name="newprice[pgcharges_currency]">
														@foreach($rates as $rate)
														<option value="{{$rate->id}}" c_val="{{$rate->rate}}" @if($new_price['pgcharges_currency']==$rate->rate) selected @endif>{{$rate->currency}} </option>
														@endforeach
													</select>
												</td>
												<td><input type="text" class="form-control number_test packages_pgcharges_adult adult_disable" name="newprice[package_pgcharges_adult]" @if($new_price["package_pgcharges_adult"]!="") value="{{$new_price["package_pgcharges_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_exadult exadult_disable" name="newprice[package_pgcharges_exadult]" @if($new_price["package_pgcharges_exadult"]!="") value="{{$new_price["package_pgcharges_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_childbed childbed_disable" name="newprice[package_pgcharges_childbed]" @if($new_price["package_pgcharges_childbed"]!="") value="{{$new_price["package_pgcharges_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_childwbed childwbed_disable" name="newprice[package_pgcharges_childwbed]" @if($new_price["package_pgcharges_childwbed"]!="") value="{{$new_price["package_pgcharges_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_infant infant_disable" name="newprice[package_pgcharges_infant]" @if($new_price["package_pgcharges_infant"]!="") value="{{$new_price["package_pgcharges_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_pgcharges_single single_disable" name="newprice[package_pgcharges_single]" @if($new_price["package_pgcharges_single"]!="") value="{{$new_price["package_pgcharges_single"]}}"  @endif></td>
											</tr>

											<!--PG Charges Ends-->
											<!--Total PG (Group)-->
											<tr class="pgGrouptTotalDisplay">
												<td class="tourPriceItem">PG (Group)</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_pg_group" name="newprice[package_total_pg_group]" readonly="" @if($new_price["package_total_pg_group"]!="") value="{{$new_price["package_total_pg_group"]}}"  @endif></td>
											</tr>

											<!--Grand Total-->
											<tr>
												<td class="tourPriceItem">GRAND TOTAL</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_grand_adult" name="newprice[package_grand_adult]" readonly="" @if($new_price["package_grand_adult"]!="") value="{{$new_price["package_grand_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_exadult" name="newprice[package_grand_exadult]" readonly="" @if($new_price["package_grand_exadult"]!="") value="{{$new_price["package_grand_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_childbed" name="newprice[package_grand_childbed]" readonly="" @if($new_price["package_grand_childbed"]!="") value="{{$new_price["package_grand_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_childwbed" name="newprice[package_grand_childwbed]" readonly="" @if($new_price["package_grand_childwbed"]!="") value="{{$new_price["package_grand_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_infant" name="newprice[package_grand_infant]" readonly="" @if($new_price["package_grand_infant"]!="") value="{{$new_price["package_grand_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_single" name="newprice[package_grand_single]" readonly="" @if($new_price["package_grand_single"]!="") value="{{$new_price["package_grand_single"]}}"  @endif></td>
											</tr>

											<!--Grand Total According to number of person-->
											<tr>
												<td class="tourPriceItem">PAY Total</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td><input type="text" class="form-control number_test packages_grand_adult_with_person" name="newprice[package_paytotal_adult]" readonly="" @if($new_price["package_paytotal_adult"]!="") value="{{$new_price["package_paytotal_adult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_exadult_with_person" name="newprice[package_paytotal_exadult]" readonly="" @if($new_price["package_paytotal_exadult"]!="") value="{{$new_price["package_paytotal_exadult"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_childbed_with_person" name="newprice[package_paytotal_childbed]" readonly="" @if($new_price["package_paytotal_childbed"]!="") value="{{$new_price["package_paytotal_childbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_childwbed_with_person " name="newprice[package_paytotal_childwbed]" readonly="" @if($new_price["package_paytotal_childwbed"]!="") value="{{$new_price["package_paytotal_childwbed"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_infant_with_person" name="newprice[package_paytotal_infant]" readonly="" @if($new_price["package_paytotal_infant"]!="") value="{{$new_price["package_paytotal_infant"]}}"  @endif></td>
												<td><input type="text" class="form-control number_test packages_grand_single_with_person" name="newprice[package_paytotal_single]" readonly="" @if($new_price["package_paytotal_single"]!="") value="{{$new_price["package_paytotal_single"]}}"  @endif></td>
											</tr>

											<!--Price to Pay-->
											<tr>
												<td class="tourPriceItem">Price To PAY</td>
												<td>
													<p class="currencyBox">INR</p>
												</td>
												<td></td>
												<td class="pricetoPay"><input type="text" class="form-control package_pricetopay packages_pricetopay" id="option1_mandate" name="newprice[package_pricetopay_adult]" readonly="" @if($new_price["package_pricetopay_adult"]!="") value="{{$new_price["package_pricetopay_adult"]}}"  @endif></td>
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
			                            @if(count($pricediscounts)==0)
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
			                              								@foreach($ratingType as $rtyp)
			                              									<option value="{{ $rtyp->id }}">{{ $rtyp->name }}</option>
			                              								@endforeach
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
						                                        @foreach($discunt_negative as $markup_pro)
						                                        	<option value="{{$markup_pro->id}}">{{$markup_pro->value}}</option>
						                                        @endforeach
					                                        </select>

					                                        <!-- select discount coupon -->
					                                        <select class="coupon_discount number_test form-control coupon_discount_first" name="NewPrice[0][coupon_discount][0]" style="display: none;">
						                                        <option coupon_id="0" value="0">Select Coupon</option>
						                                        @foreach($coupons as $markup_pro)
						                                        	<option coupon_id="{{$markup_pro->id}}"  value="{{$markup_pro->id}}" >{{$markup_pro->coupon_name}}</option>
						                                        @endforeach
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
			                              	@else
			                              	<?php
				                            	$a1=1;
				                            	$b1=0;
				                            ?>
			                              	@foreach($pricediscounts as $row=>$col)
			                                @if(count($col)>=25)
			                                <tr id="new_price_row{{$a1}}">
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
			                              							<select name="NewPrice[{{ $b1 }}][package_rating]" id="rating" class="form-control rating-field new_price_category" style="width: 100%;">
			                              								<option value="" selected disabled>Select Category</option>
			                              								@foreach($ratingType as $rtyp)
			                              									<option value='{{$rtyp->id}}' @if(array_key_exists('package_rating',$col) && $col['package_rating']==$rtyp->id) selected @endif>{{$rtyp->name}} </option>
			                              								@endforeach
			                              								<option value="other" @if(array_key_exists('package_rating',$col) && $col['package_rating']=='other') selected @endif>Other</option>
			                              							</select>
			                              							<input value="{{$col['package_rating_other']}}" name="NewPrice[{{$b1}}][package_rating_other]" id="otherrating" class="form-control other-rating"
							                                  			@if(array_key_exists('package_rating',$col) 
							                                  			&& 
							                                  			$col['package_rating']=='other') style="width: 100%;display:block;" 
							                                  			@else style="width: 100%;display:none" 
							                                  			@endif >
			                              						</td>
			                              					</tr>
			                              				</tbody>
			                              			</table>
			                              		</td>

			                                  	<!-- select category -->
			                                  	<!-- <td style="vertical-align: middle;">
			                                  		<select name="NewPrice[{{$b1}}][package_rating]" id="rating" class="form-control rating-field new_price_category" style="width: 100%;">
			                                  			<option value='' selected disabled>Select Category </option>
			                                  			@foreach($ratingType as $rtyp)
			                                  				<option value='{{$rtyp->id}}' @if(array_key_exists('package_rating',$col) && $col['package_rating']==$rtyp->id) selected @endif>{{$rtyp->name}} </option>
			                                  			@endforeach
			                                  			<option value="other" @if(array_key_exists('package_rating',$col) && $col['package_rating']=='other') selected @endif>Other</option>
			                                  		</select>
			                                  		<input value="{{$col['package_rating_other']}}" name="NewPrice[{{$b1}}][package_rating_other]" id="otherrating" class="form-control other-rating"
			                                  			@if(array_key_exists('package_rating',$col) 
			                                  			&& 
			                                  			$col['package_rating']=='other') style="width: 100%;display:block;" 
			                                  			@else style="width: 100%;display:none" 
			                                  			@endif >
			                                  	</td> -->

			                                  	<!-- add price to category -->
				                                  <?php
				                                    $sub_elements=$col['datefrom'];
				                                    $sub_count=0;
				                                  ?>
				                                  <td class="dynamic_price_range_{{$b1}}">
				                                    @foreach($sub_elements as $sub_row=>$sub_col)
				                                    <table class="table" id="dynamic_price_range_{{$b1}}_{{$sub_row}}">
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
				                                        		<input value="{{$col['datefrom'][$sub_row]}}" name="NewPrice[{{$b1}}][datefrom][{{$sub_row}}]" class="form-control pull-right datepicker_package date_start" type="text">
				                                        	</div>
				                                        </td>

				                                        <td>
				                                        	<div class="input-group date">
				                                        		<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				                                        		<input value="{{$col['dateto'][$sub_row]}}" name="NewPrice[{{$b1}}][dateto][{{$sub_row}}]" class="form-control pull-right datepicker_package date_end" type="text">
				                                        	</div>
				                                        </td>

				                                        <td>
				                                        	<input type="number" @if(array_key_exists('cuttoffpoint',$col)) value="{{$col['cuttoffpoint'][$sub_row]}}" @endif name="NewPrice[{{$b1}}][cuttoffpoint][{{$sub_row}}]" class="form-control cuttoffpoint" placeholder="Cutt Off Days">
				                                        </td>

				                                        <td>
				                                        	<select class="form-control price_applicable_for" name="NewPrice[{{$b1}}][applicable_for][{{$sub_row}}]">
				                                        		<option value="all" @if(array_key_exists('applicable_for',$col) && $col['applicable_for'][$sub_row]=='all') selected @endif>All Days</option>
				                                        		<option value="day_wise" @if(array_key_exists('applicable_for',$col) &&  $col['applicable_for'][$sub_row]=='day_wise') selected @endif>Day Wise</option>
				                                        	</select>
				                                        </td>

				                                        <td class="price_td">
					                                      	<div class="makeflex gap10">
					                                        <!-- <td class="price_td makeflex" style="column-gap: 10px;"> -->
					                                        	<select @if(array_key_exists('applicable_for',$col) &&  $col['applicable_for'][$sub_row]=='all') style="display: block;" @else style="display: none;" @endif class="form-control over_all_discount_type" name="NewPrice[{{$b1}}][over_all_discount_type][{{$sub_row}}]">
					                                        		<option value="0" @if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==0) selected @endif>No Discount</option>
					                                        		<!-- <option value="1">Fixed</option> -->
					                                        		<option value="2" @if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==2) selected @endif>Percentage</option>
					                                        		<option value="3" @if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==3) selected @endif>Coupon</option>
					                                        	</select>

					                                        	<!-- discount percentage -->
					                                        	<select class="form-control number_test normal_discount normal_discount_first" name="NewPrice[{{$b1}}][normal_discount][{{$sub_row}}]" @if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==2) style="display: block;" @else style="display: none;" @endif >
					                                        		<option value="0">0</option>
					                                        		@foreach($discunt_negative as $markup_pro)
					                                        			<option value="{{$markup_pro->id}}" @if($col['normal_discount'][$sub_row]==$markup_pro->id) selected @endif>{{$markup_pro->value}}</option>
					                                        		@endforeach
					                                        	</select>

					                                        	<!-- select discount coupon -->
					                                        	<select class="coupon_discount number_test form-control coupon_discount_first" name="NewPrice[{{$b1}}][coupon_discount][{{$sub_row}}]" @if(array_key_exists('over_all_discount_type',$col) &&  $col['over_all_discount_type'][$sub_row]==3) style="display: block;" @else style="display: none;" @endif>
					                                        		<option coupon_id="0" value="0">Select Coupon</option>
					                                        		@foreach($coupons as $markup_pro)
					                                        			<option coupon_id="{{$markup_pro->id}}"  value="{{$markup_pro->id}}" @if($col['coupon_discount'][$sub_row]==$markup_pro->id) selected @endif>{{$markup_pro->coupon_name}}</option>
					                                        		@endforeach
					                                        	</select>

						                                        <div class="d_price{{$b1}}{{$sub_row}}" id="d_price{{$b1}}{{$sub_row}}" >
																	<input type="hidden" value="{{$col['sunday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][sunday_discount_type][{{$sub_row}}]"  class="sunday_discount_type">
																	<input type="hidden" value="{{$col['sunday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][sunday_normal_discount][{{$sub_row}}]"  class="sunday_normal_discount">
																	<input type="hidden" value="{{$col['sunday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][sunday_coupon_discount][{{$sub_row}}]"  class="sunday_coupon_discount">
																	<input type="hidden" value="{{$col['monday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][monday_discount_type][{{$sub_row}}]"  class="monday_discount_type">
																	<input type="hidden" value="{{$col['monday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][monday_normal_discount][{{$sub_row}}]"  class="monday_normal_discount">
																	<input type="hidden" value="{{$col['monday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][monday_coupon_discount][{{$sub_row}}]"  class="monday_coupon_discount">
																	<input type="hidden" value="{{$col['tuesday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][tuesday_discount_type][{{$sub_row}}]"  class="tuesday_discount_type">
																	<input type="hidden" value="{{$col['tuesday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][tuesday_normal_discount][{{$sub_row}}]"  class="tuesday_normal_discount">
																	<input type="hidden" @if(array_key_exists($sub_row,$col['tuesday_coupon_discount'])) value="{{$col['tuesday_coupon_discount'][$sub_row]}}" @endif name="NewPrice[{{$b1}}][tuesday_coupon_discount][{{$sub_row}}]"  class="tuesday_coupon_discount">
																	<input type="hidden" value="{{$col['wednesday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][wednesday_discount_type][{{$sub_row}}]"  class="wednesday_discount_type">
																	<input type="hidden" value="{{$col['wednesday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][wednesday_normal_discount][{{$sub_row}}]"  class="wednesday_normal_discount">
																	<input type="hidden" value="{{$col['wednesday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][wednesday_coupon_discount][{{$sub_row}}]"  class="wednesday_coupon_discount">
																	<input type="hidden" value="{{$col['thursday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][thursday_discount_type][{{$sub_row}}]"  class="thursday_discount_type">
																	<input type="hidden" value="{{$col['thursday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][thursday_normal_discount][{{$sub_row}}]"  class="thursday_normal_discount">
																	<input type="hidden" value="{{$col['thursday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][thursday_coupon_discount][{{$sub_row}}]"  class="thursday_coupon_discount">
																	<input type="hidden" value="{{$col['friday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][friday_discount_type][{{$sub_row}}]"  class="friday_discount_type">
																	<input type="hidden" value="{{$col['friday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][friday_normal_discount][{{$sub_row}}]"  class="friday_normal_discount">
																	<input type="hidden" value="{{$col['friday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][friday_coupon_discount][{{$sub_row}}]"  class="friday_coupon_discount">
																	<input type="hidden" value="{{$col['saturday_discount_type'][$sub_row]}}" name="NewPrice[{{$b1}}][saturday_discount_type][{{$sub_row}}]"  class="saturday_discount_type">
																	<input type="hidden" value="{{$col['saturday_normal_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][saturday_normal_discount][{{$sub_row}}]"  class="saturday_normal_discount">
																	<input type="hidden" value="{{$col['saturday_coupon_discount'][$sub_row]}}" name="NewPrice[{{$b1}}][saturday_coupon_discount][{{$sub_row}}]"  class="saturday_coupon_discount">
																</div>
																
																<button
																	@if(array_key_exists('applicable_for',$col) && $col['applicable_for'][$sub_row]=='day_wise') style="display: block;" @else style="display: none;" @endif type="button" class="btn btn-info btn-lg price_daywise" data-toggle="modal" data-id="d_price{{$b1}}{{$sub_row}}">Add Price
																</button>
															</div>
														</td>
														
				                                        <td>
				                                        	@if($sub_count==0)
				                                        		<button type="button" name="add" id="row_id_{{$b1}}"  class="add_new_price_range btn btn-success" style="margin-left: 10px">Add Row</button>
				                                        	@else
				                                        		<button type="button" name="remove_price_range" id="{{$b1}}_{{$sub_row}}" class="remove_price_range btn btn-danger">X</button>
				                                        	@endif
				                                        </td>
				                                      </tr>
				                                    </table>
				                                    <?php
				                                      $sub_count++;
				                                    ?>
				                                    @endforeach
				                                </td>
				                                @if($b1>0)
				                                <td>
				                                	<button type="button" name="remove" id="{{$a1}}" class="btn btn-danger btn_remove_new_price">X</button>
				                                </td>
				                                @endif
				                            </tr>
				                            <?php
			                                	$a1++;
			                                	$b1++;
			                                ?>
			                                @endif
			                              	@endforeach
			                            @endif
		                          	</table>

		                          	<!-- add price category -->
		                          	<button type="button" name="add" id="add-new-price-row" class="btn btn-success">Add price category</button>
	                      		</div>
                  			</div>
                      </div>