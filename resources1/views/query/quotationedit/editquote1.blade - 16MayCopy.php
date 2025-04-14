		<form action="{{URL::to('/copy_option1')}}" method="post" id="quo1" name="quo1">
			<input type="hidden" name="custom_id" value="{{$custom_id}}"/>
			<input type="hidden" name="copy_reference" value="{{$reference_data->id}}"/>
			<input type="hidden" name="query_id" value="{{$data->id}}"/>
			{{csrf_field()}} 
				<!--Enquiry Details-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label for="guest_name">Primary Guest Name</label>
									<input type="text" class="form-control textCapitalize" name="guest_name" placeholder="Primary Guest Name" value="{{$data->name}}" readonly>
								</div>
								<?php $loged_user=Sentinel::getUser(); ?>
								@if($loged_user->lock_before_quote_send=='')
								<div class="col-md-4 appendBottom10">
									<label>Guest Email Address</label>
									<input type="text" class="form-control text-lowercase" name="guest_email" value="{{$data->email}}" readonly="" placeholder="Email Address"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Contact No</label>
									<input type="tel" class="form-control" name="guest_no" readonly="" value="{{$data->mobile}}" placeholder="Contact No"> 
								</div>
								 @else
								 <div class="col-md-4 appendBottom10">
									<label>Guest Email Address</label>
									<input type="text" class="form-control text-lowercase" name="guest_email" value="{{CustomHelpers::partiallyHideEmail($data->email)}}" readonly="" placeholder="Email Address"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Contact No</label>
									<input type="tel" class="form-control" name="guest_no" readonly="" value="{{CustomHelpers::mask_mobile_no($data->mobile)}}" placeholder="Contact No"> 
								</div>
								@endif
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>Tour Name</label>
									@if(is_numeric($data->packageId))
									<input type="text" class="form-control" name="package_name" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name" readonly>
									@else
									<input type="text" class="form-control textCapitalize" name="package_name" value="{{$data->packageId}}" placeholder="Package Name" readonly>
									@endif
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Tour Destination</label>
									<input type="text" class="form-control textCapitalize" value="{{$data->destinations}}" name="destination" placeholder="Package Destination" readonly>
								</div>
								<div class="col-md-4 appendBottom10">
									<?php $day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT); ?>
									<label>Tour Duration</label>
									<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}">
									<input type="text" class="form-control" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="duration" placeholder="Package Destination" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>No of Adult (+12 yrs)</label>
									<input type="text" class="form-control" name="adult" value="{{$data->span_value_adult}}" placeholder="No of Adults (+12 yrs)" readonly>
								</div>
									<div class="col-md-4 appendBottom10">
									<label>No of Children (2-12 yrs)</label>
									<input type="text" class="form-control" name="child" value="{{$data->span_value_child}}" placeholder="No of Child (5-12 yrs)" readonly>
								</div>
								<div class="col-md-4 appendBottom10">
									<label>No of Infant (0-2 yrs)</label>
									<input type="text" class="form-control" name="infant" value="{{$data->span_value_infant}}" placeholder="No of Child (0-5 yrs)" readonly>
								</div>
							</div>
							<div class="row appendBottom10">
								<div class="col-md-4">
									<label>Guest Nationality</label>
									<input type="text" class="form-control text-capitalize" value="{{$data->country_of_residence}}" name="nationality" placeholder="Nationality" readonly>
								</div>
								<div class="col-md-4">
									<label>Best time to Call</label>
									<input type="text" class="form-control" value="{{$data->time_call}}" name="best_time_call" placeholder="Best time to Call" readonly>
								</div>
								<div class="col-md-4">
									<label>Departure Date</label>
									<input type="text" name="date_arrival" class="form-control" value="{{$data->date_arrival}}" placeholder="Arrival Date" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Additional Information</label>
									<input type="text" name="message" class="form-control text-capitalize" value="{{$data->message}}" placeholder="Nationality" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Package Name-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Tour Package Name <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label for="custom_package_name">Tour Package Name <span class="requiredcolor">*</span></label>
									<input type="text" class="form-control textCapitalize" name="custom_package_name" placeholder="Enter Package Name" value="@if(is_numeric($data->packageId)) {{CustomHelpers::get_package_name($data->packageId)}} @endif">
								</div>
								<div class="col-md-4 appendBottom10">
									<label for="sourcecity">Departure City <span class="requiredcolor">*</span></label>
									<input type="text" class="form-control textCapitalize sourcecity" name="sourcecity" placeholder="Enter Departure City" value="{{$reference_data->sourcecity}}">
								</div>
								<div class="col-md-4 appendBottom10">
									<label for="admin_remarks">User Remarks</label>
									<input type="text" class="form-control" name="admin_remarks" placeholder="Enter Remarks (if any)..." value="{{$reference_data->admin_remarks}}">
								</div>
								<div class="col-md-12 appendBottom10">
									<label for="package_location">Services Included</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
												<select name="package_service[]" id="" class="form-control select2 package_service" multiple>
											@if(count($icons)>0)
											<?php 
                                            $package_service=unserialize($reference_data->package_service);
											?>
											@foreach($icons as $icon)
											<option value="{{$icon->icon_title}}" @if($package_service!='' && in_array($icon->icon_title,$package_service)) selected @endif>{{$icon->icon_title}} </option>
											@endforeach
											@else
											<option value="No Service">No Service</option>
											@endif
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					$price_data=CustomHelpers::get_price_part_seperate($reference_data->option1_price,$reference_data->quote1_number_of_adult,$reference_data->extra_adult,$reference_data->child_with_bed,$reference_data->child_without_bed,$reference_data->infant,$reference_data->solo_traveller);
					
				?>
				<!--Tour Pricing-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-money" aria-hidden="true"></i> Tour Pricing <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
						<table class="table">
							<tr>
								<td>Price Type <span class="requiredcolor">*</span></td>
								<td>
									<select class="form-control backgroundColorF2 price_type" name="price_type">
										<option value="Per Person" @if($reference_data->price_type=='Per Person') selected @endif>Per Person</option>
										<option value="Group Price" @if($reference_data->price_type=='Group Price') selected @endif>Group Price</option>
									</select>
								</td>
								<td class="anything"><input type="text" name="anything" class="form-control" placeholder="Price per person (inclusive of GST)..." value="{{ $reference_data->anything  }}"></td>
								<td class="remarks"><input type="text" name="remarks" class="form-control" placeholder="Price Remarks (if any) ..." ></td>
								<!-- <td class="noofrooms">
								<select class="form-control select_room" name="remarks">
								<option value="">Select Room</option>
								@for($i=1;$i<=10;$i++)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
								</select>
								</td> -->
								</div>
								<td>
									<div class="addRooms">
										<input type="text" value="{{ $reference_data->no_of_room  }}" id="" readonly >
										<span><button type="button" class="btnGreen get_room"> Add/Edit Rooms </button></span>
									</div>
								</td>
							</tr>
						</table>
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
										@foreach($rates as $rate)
										<option value="{{ $rate->id}}" c_val="{{$rate->rate}}" @if($reference_data->currency==$rate->id) selected @endif>{{ $rate-> currency }}</option>
										@endforeach
									</select>
									<input type="text" name="roe" class="quote1_rate number_test" placeholder="ROE" value="{{ $reference_data->roe}}">
								</div>
								<div class="currencyConversion">
									<input type="text" name="indian_rate" class="quote1_value number_test" placeholder="Enter" value="{{ $reference_data->indian_rate}}">
									<input type="text" name="total_value" class="backgroundColorF2 quote1_total number_test" value="{{ $reference_data->total_value}}" placeholder="Value" readonly>
								</div>
								<p class="itemBottomHeading">Conversion</p>
							</th>
							<th>
								<p class="itemTopHeading">ADULT</p>
								<p class="itemTopSubHeading">(TWIN SHARING)</p>
								<div class="addTravellerValue">
									<input type="hidden" id="travellers" name="quote1_number_of_adult" class="quote1_number_of_adult quote1_adult_room_value" value="{{ $reference_data->quote1_number_of_adult}}" />
									<span class="travellersMinus quote1_adult_room_dec">&#8722;</span>
									<span class="travellersValue quote1_adult_room_result">{{$reference_data->quote1_number_of_adult}}</span>
									<span class="travellersPlus quote1_adult_room_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Adult (+12yrs)</p>
							<th>
								<p class="itemTopHeading">EXTRA ADULT</p>
								<div class="addTravellerValue">
									<input type="hidden" id="travellers" name="extra_adult" class="quote1_number_of_extra_adult quote1_child_extra_adult_value"  value="{{$reference_data->extra_adult}}" />
									<span class="travellersMinus quote1_child_extra_adult_dec">&#8722;</span>
									<span class="travellersValue quote1_child_extra_adult_result">{{$reference_data->extra_adult}}</span>
									<span class="travellersPlus quote1_child_extra_adult_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Extra Adult (+12yrs)</p>
							</th>
							<th>
								<p class="itemTopHeading">CHILD</p>
								<p class="itemTopSubHeading">(WITH BED)</p>
								<div class="addTravellerValue">
									<input type="hidden" id="travellers" name="child_with_bed" class="quote1_number_of_child_with_bed quote1_child_with_bed_value" value="{{ $reference_data->child_with_bed}}" />
									<span class="travellersMinus quote1_child_with_bed_dec">&#8722;</span>
									<span class="travellersValue quote1_child_with_bed_result">{{$reference_data->child_with_bed}}</span>
									<span class="travellersPlus quote1_child_with_bed_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Child (2-12yrs)</p>
							</th>
							<th>
								<p class="itemTopHeading">CHILD</p>
								<p class="itemTopSubHeading">(WITHOUT BED)</p>
								<div class="addTravellerValue">
									<input type="hidden" value="{{ $reference_data->child_without_bed}}" id="travellers" name="child_without_bed" class="quote1_number_of_child_without_bed quote1_childwithoutbed_value"  />
									<span class="travellersMinus quote1_childwithoutbed_dec">&#8722;</span>
									<span class="travellersValue quote1_span_value_childwithoutbed_result">{{$reference_data->child_without_bed}}</span>
									<span class="travellersPlus quote1_childwithoutbed_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Child (2-12yrs)</p>
							</th>
							<th>
								<p class="itemTopHeading">INFANT</p>
								<div class="addTravellerValue">
									<input type="hidden" value="{{ $reference_data->infant}}" id="travellers" name="infant" class="quote1_number_of_infant quote1_infant_value"  />
									<span class="travellersMinus quote1_infant_dec">&#8722;</span>
									<span class="travellersValue quote1_infant_result">{{$reference_data->infant}}</span>
									<span class="travellersPlus quote1_infant_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Infant (0-2yrs)</p>
							</th>
							<th>
								<p class="itemTopHeading">SOLO<br>TRAVELLER</p>
								<div class="addTravellerValue">
									<input type="hidden" id="travellers" value="{{ $reference_data->solo_traveller}}" name="solo_traveller" class="quote1_number_solo_traveller quote1_solo_value"  />
									<span class="travellersMinus quote1_solo_dec">&#8722;</span>
									<span class="travellersValue quote1_solo_result">{{$reference_data->solo_traveller}}</span>
									<span class="travellersPlus quote1_solo_inc">&#43;</span>
								</div>
								<p class="itemBottomHeading">Solo (+12yrs)</p>
							</th>
						</thead>
						<tbody>

							<tr>
								<td>Airfare</td>
								<td class="makeflex">
									<select class="form-control supplier" name="price[quote_airfare]" id="airfare">
										<option value="0" select_name="0" >Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['quote_airfare']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[quote_airfare_remarks]" id="remarks_airfare" value="{{$price_data['quote_airfare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_air_adult" name="price[query_air_adult]" value="{{$price_data['query_air_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_air_exadult exadult_disable" name="price[query_air_exadult]" value="{{$price_data['query_air_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_air_childbed childbed_disable" name="price[query_air_childbed]" value="{{$price_data['query_air_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_air_childwbed childwbed_disable" name="price[query_air_childwbed]" value="{{$price_data['query_air_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_air_infant infant_disable" name="price[query_air_infant]" value="{{$price_data['query_air_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_air_single single_disable" name="price[query_air_single]" value="{{$price_data['query_air_single']}}"></td>
							</tr>
							<!--Cruise Start-->
							<tr>
								<td>Cruise Fare</td>
								<td class="makeflex">
									<select class="form-control supplier" name="price[quote_cruise_fare]" id="cruise_fare">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['quote_cruise_fare']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden"  name="price[quote_cruise_fare_remarks]"  id="remarks_cruise_fare" value="{{$price_data['quote_cruise_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_cruise_adult" name="price[query_cruise_adult]" value="{{$price_data['query_cruise_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]" value="{{$price_data['query_cruise_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]" value="{{$price_data['query_cruise_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]" value="{{$price_data['query_cruise_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]" value="{{$price_data['query_cruise_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]" value="{{$price_data['query_cruise_single']}}"></td>
							</tr>
							<tr>
								<td>Port Charges </td>
								<td class="makeflex">
									<select class="form-control supplier" id="port_charge_fare" name="price[port_charge_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['port_charge_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="{{$price_data['port_charge_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_adult" name="price[query_cruiseport_adult]" value="{{$price_data['query_cruiseport_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_exadult exadult_disable" name="price[query_cruiseport_exadult]" value="{{$price_data['query_cruiseport_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_childbed childbed_disable" name="price[query_cruiseport_childbed]" value="{{$price_data['query_cruiseport_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_childwbed childwbed_disable" name="price[query_cruiseport_childwbed]" value="{{$price_data['query_cruiseport_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_infant infant_disable" name="price[query_cruiseport_infant]" value="{{$price_data['query_cruiseport_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruiseport_single single_disable" name="price[query_cruiseport_single]" value="{{$price_data['query_cruiseport_single']}}"></td>
							</tr>
							<tr>
								<td>Gratuity</td>
								<td class="makeflex">
									<select class="form-control supplier" id="gratuity_fare" name="price[gratuity_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['gratuity_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[gratuity_remarks]" id="remarks_gratuity_fare" value="{{$price_data['gratuity_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_adult" name="price[query_cruisegratuity_adult]" value="{{$price_data['query_cruisegratuity_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_exadult exadult_disable" name="price[query_cruisegratuity_exadult]" value="{{$price_data['query_cruisegratuity_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_childbed childbed_disable" name="price[query_cruisegratuity_childbed]" value="{{$price_data['query_cruisegratuity_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_childwbed childwbed_disable" name="price[query_cruisegratuity_childwbed]" value="{{$price_data['query_cruisegratuity_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_infant infant_disable" name="price[query_cruisegratuity_infant]" value="{{$price_data['query_cruisegratuity_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegratuity_single single_disable" name="price[query_cruisegratuity_single]" value="{{$price_data['query_cruisegratuity_single']}}"></td>
							</tr>
							<tr>
								<td>Cruise GST </td>
								<td class="makeflex">
									<select class="form-control supplier" id="cruise_gst_fare" name="price[cruise_gst_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['cruise_gst_fare_supplier']==$suppliers->id) selected @endif> {{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="{{$price_data['cruise_gst_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_adult" name="price[query_cruisegst_adult]" value="{{$price_data['query_cruisegst_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_exadult exadult_disable" name="price[query_cruisegst_exadult]" value="{{$price_data['query_cruisegst_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_childbed childbed_disable" name="price[query_cruisegst_childbed]" value="{{$price_data['query_cruisegst_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_childwbed childwbed_disable" name="price[query_cruisegst_childwbed]" value="{{$price_data['query_cruisegst_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_infant infant_disable" name="price[query_cruisegst_infant]" value="{{$price_data['query_cruisegst_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_cruisegst_single single_disable" name="price[query_cruisegst_single]" value="{{$price_data['query_cruisegst_single']}}"></td>
							</tr>
							<!--Cruise End-->
							<tr>
								<td>Accommodation</td>
								<td class="makeflex">
									<select class="form-control supplier" id="accommodation_fare" name="price[accommodation_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['accommodation_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="{{$price_data['accommodation_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_hotel_adult" name="price[query_hotel_adult]" id="" value="{{$price_data['query_hotel_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_hotel_exadult exadult_disable" name="price[query_hotel_exadult]" value="{{$price_data['query_hotel_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_hotel_childbed childbed_disable" name="price[query_hotel_childbed]" value="{{$price_data['query_hotel_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_hotel_childwbed childwbed_disable" name="price[query_hotel_childwbed]" value="{{$price_data['query_hotel_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_hotel_infant infant_disable" name="price[query_hotel_infant]" value="{{$price_data['query_hotel_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_hotel_single single_disable" name="price[query_hotel_single]" value="{{$price_data['query_hotel_single']}}"></td>
							</tr>
							<tr>
								<td>Sightseeing</td>
								<td class="makeflex">
									<select class="form-control supplier" id="sightseeing_fare" name="price[sightseeing_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['sightseeing_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="{{$price_data['sightseeing_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_tours_adult" name="price[query_tours_adult]" value="{{$price_data['query_tours_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tours_exadult exadult_disable" name="price[query_tours_exadult]" value="{{$price_data['query_tours_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tours_childbed childbed_disable" name="price[query_tours_childbed]" value="{{$price_data['query_tours_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tours_childwbed childwbed_disable" name="price[query_tours_childwbed]" value="{{$price_data['query_tours_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tours_infant infant_disable" name="price[query_tours_infant]" value="{{$price_data['query_tours_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tours_single single_disable" name="price[query_tours_single]" value="{{$price_data['query_tours_single']}}"></td>
							</tr>
							<tr>
								<td>Transfers</td>
								<td class="makeflex">
									<select class="form-control supplier" id="transfers_fare" name="price[transfers_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['transfers_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[transfers_fare_remarks]" id="remarks_transfers_fare" value="{{$price_data['transfers_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_transfer_adult" name="price[query_transfer_adult]" value="{{$price_data['query_transfer_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_transfer_exadult exadult_disable" name="price[query_transfer_exadult]" value="{{$price_data['query_transfer_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_transfer_childbed childbed_disable" name="price[query_transfer_childbed]" value="{{$price_data['query_transfer_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_transfer_childwbed childwbed_disable" name="price[query_transfer_childwbed]" value="{{$price_data['query_transfer_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_transfer_infant infant_disable" name="price[query_transfer_infant]" value="{{$price_data['query_transfer_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_transfer_single single_disable" name="price[query_transfer_single]" value="{{$price_data['query_transfer_single']}}"></td>
							</tr>
							<tr>
								<td>Visa Charges</td>
								<td class="makeflex">
									<select class="form-control supplier" id="visa_charges_fare" name="price[visa_charges_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['visa_charges_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="{{$price_data['visa_charges_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_visa_adult" name="price[query_visa_adult]" value="{{$price_data['query_visa_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_visa_exadult exadult_disable" name="price[query_visa_exadult]" value="{{$price_data['query_visa_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_visa_childbed childbed_disable" name="price[query_visa_childbed]" value="{{$price_data['query_visa_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_visa_childwbed childwbed_disable" name="price[query_visa_childwbed]" value="{{$price_data['query_visa_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_visa_infant infant_disable" name="price[query_visa_infant]" value="{{$price_data['query_visa_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_visa_single single_disable" name="price[query_visa_single]" value="{{$price_data['query_visa_single']}}"></td>
							</tr>
							<tr>
								<td>Travel Insurance</td>
								<td class="makeflex">
									<select class="form-control supplier" id="travel_insurance_fare" name="price[travel_insurance_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['travel_insurance_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
									<input type="hidden" name="price[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="{{$price_data['travel_insurance_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_inc_adult" name="price[query_inc_adult]" value="{{$price_data['query_inc_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_inc_exadult exadult_disable" name="price[query_inc_exadult]" value="{{$price_data['query_inc_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_inc_childbed childbed_disable" name="price[query_inc_childbed]" value="{{$price_data['query_inc_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_inc_childwbed childwbed_disable" name="price[query_inc_childwbed]" value="{{$price_data['query_inc_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_inc_infant infant_disable" name="price[query_inc_infant]" value="{{$price_data['query_inc_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_inc_single single_disable" name="price[query_inc_single]" value="{{$price_data['query_inc_single']}}"></td>
							</tr>
							<!--Meals  Start-->
							<tr>
								<td>Meals</td>
								<td class="makeflex">
									<select class="form-control supplier" id="meals_fare" name="price[meals_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['meals_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
								<input type="hidden" name="price[meals_fare_remarks]" id="remarks_meals_fare" value="{{$price_data['meals_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_meals_adult" name="price[query_meals_adult]" value="{{$price_data['query_meals_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_meals_exadult exadult_disable" name="price[query_meals_exadult]" value="{{$price_data['query_meals_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_meals_childbed childbed_disable" name="price[query_meals_childbed]" value="{{$price_data['query_meals_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_meals_childwbed childwbed_disable" name="price[query_meals_childwbed]" value="{{$price_data['query_meals_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_meals_infant infant_disable" name="price[query_meals_infant]" value="{{$price_data['query_meals_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_meals_single single_disable" name="price[query_meals_single]" value="{{$price_data['query_meals_single']}}"></td>
							</tr>
							<!--Meals End-->
							<!--Additional Service-->
							<tr>
								<td>Addon Service</td>
								<td class="makeflex">
									<select class="form-control supplier" id="addon_service_fare" name="price[addon_service_fare_supplier]">
										<option value="0" select_name="0">Select</option>
										@foreach($supplier as $suppliers)
										<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}" @if($price_data['addon_service_fare_supplier']==$suppliers->id) selected @endif>{{$suppliers->suppliercompanyname}}</option>
										@endforeach
									</select>
								<input type="hidden" name="price[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="{{$price_data['addon_service_fare_remarks']}}">
								</td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_adult" name="price[query_additionalservice_adult]" value="{{$price_data['query_additionalservice_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_exadult exadult_disable" name="price[query_additionalservice_exadult]" value="{{$price_data['query_additionalservice_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_childbed childbed_disable" name="price[query_additionalservice_childbed]" value="{{$price_data['query_additionalservice_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_childwbed childwbed_disable" name="price[query_additionalservice_childwbed]" value="{{$price_data['query_additionalservice_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_infant infant_disable" name="price[query_additionalservice_infant]" value="{{$price_data['query_additionalservice_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_additionalservice_single single_disable" name="price[query_additionalservice_single]" value="{{$price_data['query_additionalservice_single']}}"></td>
							</tr>
							<!--Additional Service End-->
							<!--Total before Markup-->
							<tr class="totalDisplay">
								<td>Total</td>
								<td>
								<!--<p class="currencyBox">INR</p>-->
								</td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_adult" name="price[query_tourtotal_adult]" readonly value="{{$price_data['query_tourtotal_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_exadult" name="price[query_tourtotal_exadult]" readonly value="{{$price_data['query_tourtotal_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_childbed" name="price[query_tourtotal_childbed]" readonly value="{{$price_data['query_tourtotal_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_childwbed" name="price[query_tourtotal_childwbed]" readonly value="{{$price_data['query_tourtotal_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_infant" name="price[query_tourtotal_infant]" readonly value="{{$price_data['query_tourtotal_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tourtotal_single" name="price[query_tourtotal_single]" readonly value="{{$price_data['query_tourtotal_single']}}"></td>
							</tr>
							<!--Markup  Start-->
							<tr>
								<td class="fontItalic">Markup (Profit)</td>
								<td class="makeflex">
									<select class="fixedValue pricemarkup" name="price[pricemarkup]">
										<option value="0" disabled>Select</option>
										<option value="1" @if($price_data['pricemarkup']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['pricemarkup']==2) selected @endif>Percentage</option>
									</select>
									<select class="percentageValue number_test markup_percentage" name="price[markup_percentage]">
										<option value="0">0</option>
										@foreach($markup_profit as $markup_pro)
										<option value="{{$markup_pro->value}}" @if($price_data['markup_percentage']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control number_test quote1_markup_adult" name="price[query_markup_adult]" value="{{$price_data['query_markup_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_markup_exadult exadult_disable" name="price[query_markup_exadult]" value="{{$price_data['query_markup_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_markup_childbed childbed_disable" name="price[query_markup_childbed]" value="{{$price_data['query_markup_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_markup_childwbed childwbed_disable" name="price[query_markup_childwbed]" value="{{$price_data['query_markup_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_markup_infant infant_disable" name="price[query_markup_infant]" value="{{$price_data['query_markup_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_markup_single single_disable" name="price[query_markup_single]" value="{{$price_data['query_markup_single']}}"></td>
							</tr>
							<!--Discount Plus-->
							<tr>
								<td>Discount (+)</td>
								<td class="makeflex">
									<select class="fixedValue pricediscountpositive" name="price[pricediscountpositive]">
										<option value="0">Select</option>
										<option value="1" @if($price_data['pricediscountpositive']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['pricediscountpositive']==2) selected @endif>Percentage</option>
										<option value="3" @if($price_data['pricediscountpositive']==3) selected @endif>Coupon</option>
									</select>
									<select class="percentageValue number_test discountpositive_percentage" name="price[discountpositive_percentage]">
										<option value="0">0</option>
										@foreach($discunt_positive as $markup_pro)
										<option value="{{$markup_pro->value}}" @if($price_data['discountpositive_percentage']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control number_test quote1_discount_adult_plus" name="price[query_discount_adult]"  value="{{$price_data['query_discount_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_exadult_plus exadult_disable" name="price[query_discount_exadult]"  value="{{$price_data['query_discount_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_childbed_plus childbed_disable" name="price[query_discount_childbed]"  value="{{$price_data['query_discount_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_childwbed_plus childwbed_disable" name="price[query_discount_childwbed]"  value="{{$price_data['query_discount_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_infant_plus infant_disable" name="price[query_discount_infant]"  value="{{$price_data['query_discount_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_single_plus single_disable" name="price[query_discount_single]"  value="{{$price_data['query_discount_single']}}"></td>
							</tr>
							<!--Total before GST-->
							<tr class="grossTotalDisplay">
								<td class="tourPriceItem">Gross Total</td>
								<td>
								<!--<p class="currencyBox">INR</p>-->
								</td>
								<td><input type="text" class="form-control number_test quote1_gross_total_adult" name="price[query_total_adult]" readonly value="{{$price_data['query_total_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gross_total_exadult" name="price[query_total_exadult]" readonly value="{{$price_data['query_total_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gross_total_childbed" name="price[query_total_childbed]" readonly value="{{$price_data['query_total_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gross_total_childwbed" name="price[query_total_childwbed]" readonly value="{{$price_data['query_total_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gross_total_infant" name="price[query_total_infant]" readonly value="{{$price_data['query_total_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gross_total_single" name="price[query_total_single]" readonly value="{{$price_data['query_total_single']}}"></td>
							</tr>
							<!--Total Gross Total (Group)-->
							<tr class="grossGroupTotalDisplay">
								<td class="tourPriceItem">Gross Total (Group)</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_gross_total_group" name="price[query_total_group]" readonly value="{{$price_data['query_total_group']}}"></td>
							</tr>
							<!--Discount Minus-->
							<tr>
								<td>Discount (-)</td>
								<td class="makeflex">
									<select class="fixedValue pricediscountnegative" name="price[pricediscountnegative]">
										<option value="0">Select</option>
										<option value="1" @if($price_data['pricediscountnegative']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['pricediscountnegative']==2) selected @endif>Percentage</option>
										<option value="3" @if($price_data['pricediscountnegative']==3) selected @endif>Coupon</option>
									</select>
									<select class="percentageValue number_test discountnegative_percentage" name="price[discountnegative_percentage]">
										<option value="0">0</option>
										@foreach($discunt_negative as $markup_pro)
										<option value="{{$markup_pro->value}}" @if($price_data['discountnegative_percentage']==$markup_pro->value) selected @endif>{{$markup_pro->value}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control number_test quote1_discount_adult_minus" name="price[query_discount_minus_adult]" value="{{$price_data['query_discount_minus_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_exadult_minus exadult_disable" name="price[query_discount_minus_exadult]" value="{{$price_data['query_discount_minus_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_childbed_minus childbed_disable" name="price[query_discount_minus_childbed]" value="{{$price_data['query_discount_minus_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_childwbed_minus childwbed_disable" name="price[query_discount_minus_childwbed]" value="{{$price_data['query_discount_minus_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_infant_minus infant_disable" name="price[query_discount_minus_infant]" value="{{$price_data['query_discount_minus_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_discount_single_minus single_disable" name="price[query_discount_minus_single]" value="{{$price_data['query_discount_minus_single']}}"></td>
							</tr>
							<!--Total Gross Total (Group)-->
							<tr class="discountGroupTotalDisplay">
								<td class="tourPriceItem">Discount (-) (Group)</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_discount_group" name="price[query_total_discount_group]" readonly value="{{$price_data['query_total_discount_group']}}"></td>
							</tr>
							<!--GST Starts-->
							<tr>
								<td class="fontItalic">(+) GST</td>
								<td class="makeflex">
									<select class="fixedValue pricegst" name="price[query_gst_curr]">
										<option value="0" @if($price_data['query_gst_curr']==0) selected @endif>Select</option>
										<option value="1" @if($price_data['query_gst_curr']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['query_gst_curr']==2) selected @endif>Percentage</option>
									</select>
									<select class="percentageValue number_test gst_percentage" name="price[gst_percentage]">
										@foreach($gst as $gst)
										<option value="0">--Select--</option>
										<option value="{{$gst->value}}" @if($price_data['gst_percentage']==$gst->value) selected @endif>{{$gst->value}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control number_test quote1_gst_adult" name="price[query_gst_adult]" value="{{$price_data['query_gst_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gst_exadult exadult_disable" name="price[query_gst_exadult]" value="{{$price_data['query_gst_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gst_childbed childbed_disable" name="price[query_gst_childbed]" value="{{$price_data['query_gst_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gst_childwbed childwbed_disable" name="price[query_gst_childwbed]" value="{{$price_data['query_gst_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gst_infant infant_disable" name="price[query_gst_infant]" value="{{$price_data['query_gst_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gst_single single_disable" name="price[query_gst_single]" value="{{$price_data['query_gst_single']}}"></td>
							</tr>
							<!--Total GST (Group)-->
							<tr class="gstGroupTotalDisplay">
								<td class="tourPriceItem">GST (Group)</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_gst_group" name="price[query_total_gst_group]" readonly value="{{$price_data['query_total_gst_group']}}"></td>
							</tr>
							<!--Total after GST-->
							<tr class="gstTotalDisplay">
								<td class="tourPriceItem">Total with GST</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_adult" name="price[query_gsttotal_adult]" readonly value="{{$price_data['query_gsttotal_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_exadult" name="price[query_gsttotal_exadult]" readonly value="{{$price_data['query_gsttotal_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_childbed" name="price[query_gsttotal_childbed]" readonly value="{{$price_data['query_gsttotal_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_childwbed" name="price[query_gsttotal_childwbed]" readonly value="{{$price_data['query_gsttotal_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_infant" name="price[query_gsttotal_infant]" readonly value="{{$price_data['query_gsttotal_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_gsttotal_single" name="price[query_gsttotal_single]" readonly value="{{$price_data['query_gsttotal_single']}}"></td>
							</tr>
							<!--TCS Starts-->
							<tr>
								<td class="fontItalic">(+) TCS</td>
								<td class="makeflex">
									<select class="fixedValue pricetcs" name="price[query_tcs_curr]">
										<option value="0" @if($price_data['query_tcs_curr']==0) selected @endif>Select</option>
										<option value="1" @if($price_data['query_tcs_curr']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['query_tcs_curr']==2) selected @endif>Percentage</option>
									</select>
									<select class="percentageValue number_test tcs_percentage" name="price[tcs_percentage]">
										@foreach($tcs as $tcs)
										<option value="0">0</option>
										<option value="{{$tcs->value}}" @if($price_data['tcs_percentage']==$tcs->value) selected @endif>{{$tcs->value}}</option>
										@endforeach
									</select>
								</td>
								<td><input type="text" class="form-control number_test quote1_tcs_adult" name="price[query_tcs_adult]" value="{{$price_data['query_tcs_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcs_exadult exadult_disable" name="price[query_tcs_exadult]" value="{{$price_data['query_tcs_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcs_childbed childbed_disable" name="price[query_tcs_childbed]" value="{{$price_data['query_tcs_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcs_childwbed childwbed_disable" name="price[query_tcs_childwbed]" value="{{$price_data['query_tcs_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcs_infant infant_disable" name="price[query_tcs_infant]" value="{{$price_data['query_tcs_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcs_single single_disable" name="price[query_tcs_single]" value="{{$price_data['query_tcs_single']}}"></td>
							</tr>
							<!--Total TCS (Group)-->
							<tr class="tcsGroupTotalDisplay">
								<td class="tourPriceItem">TCS (Group)</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_tcs_group" name="price[query_total_tcs_group]" readonly value="{{$price_data['query_total_tcs_group']}}"></td>
							</tr>
							<!--Total after TCS-->
							<tr class="tcsTotalDisplay">
								<td class="tourPriceItem">Total with TCS</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_adult" name="price[query_tcstotal_adult]" readonly value="{{$price_data['query_tcstotal_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_exadult" name="price[query_tcstotal_exadult]" readonly value="{{$price_data['query_tcstotal_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_childbed" name="price[query_tcstotal_childbed]" readonly value="{{$price_data['query_tcstotal_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_childwbed" name="price[query_tcstotal_childwbed]" readonly value="{{$price_data['query_tcstotal_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_infant" name="price[query_tcstotal_infant]" readonly value="{{$price_data['query_tcstotal_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_tcstotal_single" name="price[query_tcstotal_single]" readonly value="{{$price_data['query_tcstotal_single']}}"></td>
							</tr>
							<!--PG Charges Starts-->
							<tr>
								<td class="fontItalic">(+) PG Charges</td>
								<td class="makeflex">
									<select class="fixedValue pricepgcharges" name="price[pg_charges]">
										<option value="0" @if($price_data['pg_charges']==0) selected @endif>Select</option>
										<option value="1" @if($price_data['pg_charges']==1) selected @endif>Fixed</option>
										<option value="2" @if($price_data['pg_charges']==2) selected @endif>Percentage</option>
									</select>
							       <select class="percentageValue number_test pgcharges_percentage" name="price[pgcharges_percentage]">
							       	<option value="0">0</option>
										
										@foreach($pg as $pg)
										<option value="{{$pg->value}}" @if($price_data['pgcharges_percentage']==$pg->value) selected @endif>{{$pg->value}}</option>
										@endforeach
									</select>
									

								</td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_adult" name="price[query_pgcharges_adult]" value="{{$price_data['query_pgcharges_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_exadult exadult_disable" name="price[query_pgcharges_exadult]" value="{{$price_data['query_pgcharges_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_childbed childbed_disable" name="price[query_pgcharges_childbed]" value="{{$price_data['query_pgcharges_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_childwbed childwbed_disable" name="price[query_pgcharges_childwbed]" value="{{$price_data['query_pgcharges_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_infant infant_disable" name="price[query_pgcharges_infant]" value="{{$price_data['query_pgcharges_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_pgcharges_single single_disable" name="price[query_pgcharges_single]" value="{{$price_data['query_pgcharges_single']}}"></td>
							</tr>
							<!--PG Charges Ends-->
							<!--Total PG (Group)-->
							<tr class="pgGrouptTotalDisplay">
								<td class="tourPriceItem">PG (Group)</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_pg_group" name="price[query_total_pg_group]" readonly value="{{$price_data['query_total_pg_group']}}"></td>
							</tr>
							<!--Grand Total-->
							<tr>
								<td class="tourPriceItem">GRAND TOTAL</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_grand_adult" name="price[query_grand_adult]" readonly value="{{$price_data['query_grand_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_exadult" name="price[query_grand_exadult]" readonly value="{{$price_data['query_grand_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_childbed" name="price[query_grand_childbed]" readonly value="{{$price_data['query_grand_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_childwbed" name="price[query_grand_childwbed]" readonly value="{{$price_data['query_grand_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_infant" name="price[query_grand_infant]" readonly value="{{$price_data['query_grand_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_single" name="price[query_grand_single]" readonly value="{{$price_data['query_grand_single']}}"></td>
							</tr>
							<!--Grand Total According to number of person-->
							<tr>
								<td class="tourPriceItem">PAY Total</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td><input type="text" class="form-control number_test quote1_grand_adult_with_person" name="price[query_paytotal_adult]" readonly value="{{$price_data['query_paytotal_adult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_exadult_with_person" name="price[query_paytotal_exadult]" readonly value="{{$price_data['query_paytotal_exadult']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_childbed_with_person" name="price[query_paytotal_childbed]" readonly value="{{$price_data['query_paytotal_childbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_childwbed_with_person " name="price[query_paytotal_childwbed]" readonly value="{{$price_data['query_paytotal_childwbed']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_infant_with_person" name="price[query_paytotal_infant]" readonly value="{{$price_data['query_paytotal_infant']}}"></td>
								<td><input type="text" class="form-control number_test quote1_grand_single_with_person" name="price[query_paytotal_single]" readonly value="{{$price_data['query_paytotal_single']}}"></td>
							</tr>
							<!--Price to Pay-->
							<tr>
								<td class="tourPriceItem">Price To PAY</td>
								<td>
									<p class="currencyBox">INR</p>
								</td>
								<td class="pricetoPay"><input type="text" class="form-control query_pricetopay quote1_pricetopay" id="option1_mandate" name="price[query_pricetopay_adult]" readonly value="{{$price_data['query_pricetopay_adult']}}"></td>
							</tr>
							<!---->
							<tr>
								<td colspan="8">
									<div class="partPayment">
										<label for="partPayment">Part Payment?</label>
										<input type="checkbox" name="partPayment" value="1" id="show_part_payment" @if($reference_data->partPayment==1) checked @endif >
									</div>
								</td>
							</tr>
							</tbody>
						</table>
						<table class="table backend_custom_height part_payment" @if($reference_data->partPayment==1) style="display:block" @else style="display:none" @endif>
                        <?php 
                         $part_payments=unserialize($reference_data->part_payments);
                      
                         ?>

							<tbody>
								<!--Advance Payment-->
								<tr>
									<td class="tourPriceItem">Advance Payment</td>
									<td class="makeflex">
										<select class="fixedValue advance_payment"  name="part_payments[adv_type]">
											<option value="1" @if($part_payments['adv_type']==1) selected @endif>Fixed</option>
											<option value="2" @if($part_payments['adv_type']==2) selected @endif>Percentage</option>
										</select>
										<input type="number" name="part_payments[adv_percentage]" class="percentageValue number_test advance_payment_percentage" value="{{$part_payments['adv_percentage']}}">
									</td>
									<td>
										<input type="text" name="part_payments[adv_amount]" class="form-control number_test quote1_advance_payment" value="{{$part_payments['adv_amount']}}">
										<span id="quote1_advance_payment_error anyError"></span>
									</td>
									<td class="payment_days_parent">
                                  
										<select name="part_payments[adv_days]" class="form-control payment_days">
											<option value="">--Select Days--</option>
                                            @for($i=1;$i<=$difference;$i++)
                                         <option value="{{$i}}" @if(array_key_exists('adv_days',$part_payments) && $part_payments["adv_days"]==$i) selected @endif>{{$i}} Days</option>
                                            @endfor
										</select>
									
									
									</td>
									<td class="payment_date_parent">
										<input type="text" name="part_payments[adv_date]" class="form-control payment_date  datepicker_new" @if($reference_data->part_payments!='' && array_key_exists('adv_date',$part_payments)) value="{{$part_payments['adv_date']}}" @endif> 
										
									</td>

								</tr>
								<!--1st Part Payment-->
								<tr class="">
									<td class="tourPriceItem">1st Part Payment</td>
									<td class="makeflex">
										<select class="fixedValue first_part_payment" name="part_payments[first_part_type]">
									<option value="1" @if($part_payments['first_part_type']==1) selected @endif>Fixed</option>
									<option value="2" @if($part_payments['first_part_type']==2) selected @endif>Percentage</option>
										</select>
										<input type="number" class="percentageValue number_test first_part_percentage" name="part_payments[first_part_percentage]" value="{{$part_payments['first_part_percentage']}}">
									</td>
									<td>
										<input type="text" class="form-control number_test quote1_first_part" name="part_payments[first_part_amount]" value="{{$part_payments['first_part_amount']}}">

										<span id="quote1_first_part_error" class="anyError"></span>
									</td>
										<td class="payment_days_parent">
                                  
										<select name="part_payments[first_part_days]" class="form-control payment_days">
											<option value="">--Select Days--</option>
                                            @for($i=1;$i<=$difference;$i++)
                                         <option value="{{$i}}" @if(array_key_exists('first_part_days',$part_payments) && $part_payments["first_part_days"]==$i) selected @endif>{{$i}} Days</option>
                                            @endfor
										</select>
									
									
									</td>
									<td class="payment_date_parent">
										<input type="text" name="part_payments[first_part_date]" class="form-control payment_date  datepicker_new" @if($reference_data->part_payments!='' && array_key_exists('first_part_date',$part_payments)) value="{{$part_payments['first_part_date']}}" @endif> 
										
									</td>
								</tr>
								<!--2nd Part Payment-->
								<tr class="">
									<td class="tourPriceItem">2nd Part Payment</td>
									<td class="makeflex">
										<select class="fixedValue second_part_payment" name="part_payments[second_part_type]" style="display: none;">
									<option value="1" @if($part_payments['second_part_type']==1) selected @endif>Fixed</option>
									<option value="2" @if($part_payments['second_part_type']==2) selected @endif>Percentage</option>
										</select>
										<input type="number" class="percentageValue number_test second_part_percentage" name="part_payments[second_part_percentage]" value="{{$part_payments['second_part_percentage']}}">
									</td>
									<td>
										<input type="text" class="percentageValue backgroundColorEEE fullWidth number_test quote1_second_part" name="part_payments[second_part_amount]" value="{{$part_payments['second_part_amount']}}">
									</td>
										<td class="payment_days_parent">
										<select name="part_payments[second_part_days]" class="form-control payment_days">
											<option value="">--Select Days--</option>
                                            @for($i=1;$i<=$difference;$i++)
                                         <option value="{{$i}}" @if(array_key_exists('second_part_days',$part_payments) && $part_payments["second_part_days"]==$i) selected @endif>{{$i}} Days</option>
                                            @endfor
										</select>
									</td>
									<td class="payment_date_parent">
										<input type="text" name="part_payments[second_part_date]" class="form-control payment_date  datepicker_new" @if($reference_data->part_payments!='' && array_key_exists('second_part_date',$part_payments)) value="{{$part_payments['second_part_date']}}" @endif> 
										
									</td>
								</tr>
								<!--Total Payment-->
								<tr class="">
									<td class="tourPriceItem">Total Payment</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td>
										<input type="text" class="form-control query_pricetopay quote1_total_payment" id="quote1_total_payment" name="part_payments[total_installment]" readonly  value="{{round($price_data['query_pricetopay_adult'])}}"  oncontextmenu="return false;"></td>
								</tr>
							</tbody>
						</table>
						<!--Direct Payment-->
						<table class="table backend_custom_height">
							<tr>
								<td>
									<div class="directPayment">
										<label for="directPayment">Direct Pay at Property (per person, not included in price)?</label>
										<input type="checkbox" name="directPayment" value="1" id="show_direct_part"  @if($reference_data->directPayment==1) checked @endif>
									</div>
								</td>
							</tr>
						</table>
						<table class="table backend_custom_height direct_part" @if($reference_data->directPayment==1) style="display:block" @else style="display:none" @endif>
							 <?php 
                         $directPayments=unserialize($reference_data->directPayments);
                         ?>
							<tbody>
								<!--1st Direct Pay-->
								<tr>
									<td>
										<select class="form-control" name="directPayments[type]">
											<option value="0">Select</option>
									<option value="Airport Transfers" @if($directPayments['type']=='Airport Transfers') selected @endif>Airport Transfers</option>
									<option value="Speed Boat Transfers" @if($directPayments['type']=='Speed Boat Transfers') selected @endif>Speed Boat Transfers</option>
									<option value="Sea Plane" @if($directPayments['type']=='Sea Plane') selected @endif>Sea Plane</option>
								<option value="Ferry Transfers" @if($directPayments['type']=='Ferry Transfers') selected @endif>Ferry Transfers</option>
									<option value="Green Tax" @if($directPayments['type']=='Green Tax') selected @endif>Green Tax</option>
									<option value="City Tax" @if($directPayments['type']=='City Tax') selected @endif>City Tax</option>
									<option value="VAT" @if($directPayments['type']=='VAT') selected @endif>VAT</option>
									<option value="Tourism Fee" @if($directPayments['type']=='Tourism Fee') selected @endif>Tourism Fee</option>
									<option value="Christmas Gala Dinner" @if($directPayments['type']=='Christmas Gala Dinner') selected @endif>Christmas Gala Dinner</option>
									<option value="New Year Gala Dinner" @if($directPayments['type']=='New Year Gala Dinner') selected @endif>New Year Gala Dinner</option>
									<option value="Tours" @if($directPayments['type']=='Tours') selected @endif>Tours</option>
									<option value="Transfers" @if($directPayments['type']=='Transfers') selected @endif>Transfers</option>
									<option value="Activity" @if($directPayments['type']=='Activity') selected @endif>Activity</option>
										</select>
									</td>
									<td><input type="text" class="form-control" name="directPayments[pricetype]" value="Fixed" readonly value="{{$directPayments['pricetype']}}"></td>

									<td><input type="text" class="form-control number_test" name="directPayments[currency]" value="INR" readonly value="{{$directPayments['currency']}}"></td>
									<td><input type="text" class="form-control number_test" name="directPayments[amount]" value="{{$directPayments['amount']}}"></td>
								</tr>
								<!--2nd Direct Pay-->
								<tr>
									<td>
										<?php 
                         $second_directPayments=unserialize($reference_data->second_directPayments);
                         ?>

										<select class="form-control" name="second_directPayments[type]">
											<option value="0">Select</option>
								<option value="Airport Transfers" @if($second_directPayments['type']=='Airport Transfers') selected @endif>Airport Transfers</option>
								<option value="Speed Boat Transfers" @if($second_directPayments['type']=='Speed Boat Transfers') selected @endif>Speed Boat Transfers</option>
								<option value="Sea Plane" @if($second_directPayments['type']=='Sea Plane') selected @endif>Sea Plane</option>
								<option value="Ferry Transfers" @if($second_directPayments['type']=='Ferry Transfers') selected @endif>Ferry Transfers</option>
									<option value="Green Tax" @if($second_directPayments['type']=='Green Tax') selected @endif>Green Tax</option>
								<option value="City Tax" @if($second_directPayments['type']=='City Tax') selected @endif>City Tax</option>
									<option value="VAT" @if($second_directPayments['type']=='VAT') selected @endif>VAT</option>
									<option value="Tourism Fee" @if($second_directPayments['type']=='Tourism Fee') selected @endif>Tourism Fee</option>
									<option value="Christmas Gala Dinner" @if($second_directPayments['type']=='Christmas Gala Dinner') selected @endif>Christmas Gala Dinner</option>
									<option value="New Year Gala Dinner" @if($second_directPayments['type']=='New Year Gala Dinner') selected @endif>New Year Gala Dinner</option>
									<option value="Tours" @if($second_directPayments['type']=='Tours') selected @endif>Tours</option>
									<option value="Transfers" @if($second_directPayments['type']=='Transfers') selected @endif>Transfers</option>
								<option value="Activity" @if($second_directPayments['type']=='Activity') selected @endif>Activity</option>
										</select>
									</td>
									<td><input type="text" class="form-control" name="second_directPayments[pricetype]" value="Fixed" readonly value="{{$second_directPayments['amount']}}"></td>
									<td><input type="text" class="form-control number_test" name="second_directPayments[currency]" value="INR" readonly value="{{$second_directPayments['currency']}}"></td>
									<td><input type="text" class="form-control number_test" name="second_directPayments[amount]" value="{{$second_directPayments['amount']}}"></td>
								</tr>
								<!--3rd Direct Pay-->
								<tr>
									<td>
										<?php 
                         $third_directPayments=unserialize($reference_data->third_directPayments);
                         ?>
										<select class="form-control" name="third_directPayments[type]">
											<option value="0">Select</option>
									<option value="Airport Transfers" @if($third_directPayments['type']=='Airport Transfers') selected @endif>Airport Transfers</option>
									<option value="Speed Boat Transfers" @if($third_directPayments['type']=='Speed Boat Transfers') selected @endif>Speed Boat Transfers</option>
									<option value="Sea Plane" @if($third_directPayments['type']=='Sea Plane') selected @endif>Sea Plane</option>
								<option value="Ferry Transfers" @if($third_directPayments['type']=='Ferry Transfers') selected @endif>Ferry Transfers</option>
									<option value="Green Tax" @if($third_directPayments['type']=='Green Tax') selected @endif>Green Tax</option>
									<option value="City Tax" @if($third_directPayments['type']=='City Tax') selected @endif>City Tax</option>
									<option value="VAT" @if($third_directPayments['type']=='VAT') selected @endif>VAT</option>
									<option value="Tourism Fee" @if($third_directPayments['type']=='Tourism Fee') selected @endif>Tourism Fee</option>
									<option value="Christmas Gala Dinner" @if($third_directPayments['type']=='Christmas Gala Dinner') selected @endif>Christmas Gala Dinner</option>
									<option value="New Year Gala Dinner" @if($third_directPayments['type']=='New Year Gala Dinner') selected @endif>New Year Gala Dinner</option>
									<option value="Tours" @if($third_directPayments['type']=='Tours') selected @endif>Tours</option>
									<option value="Transfers" @if($third_directPayments['type']=='Transfers') selected @endif>Transfers</option>
									<option value="Activity" @if($third_directPayments['type']=='Activity') selected @endif>Activity</option>
										</select>
									</td>
									<td><input type="text" class="form-control" name="third_directPayments[pricetype]" value="Fixed" readonly value="{{$third_directPayments['pricetype']}}"></td>
									<td><input type="text" class="form-control number_test" name="third_directPayments[currency]" value="INR" readonly></td>
									<td><input type="text" class="form-control number_test" name="third_directPayments[amount]" value="{{$third_directPayments['amount']}}"></td>
								</tr>
								<!---->
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<!--Tour Accommodation-->
				<?php

					$option1_accommodation=unserialize($reference_data->option1_accommodation);
					$option1_accommodation_count=count($option1_accommodation);
				?>
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-bed" aria-hidden="true"></i> Tour Accommodation <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<?php
								$days=$data->duration;
								$days=(int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
								$days=$days-1;
								$j=0;
							?>
							<div class="dynamic_acc">
								<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}" >  
								@foreach($option1_accommodation as $row=>$col)
                                @if($j>0)
                                <hr>
                                @endif
								<div class="field{{$j}}" id="{{$j}}">
									<div class="row">
										<div class="col-md-6 appendBottom10">
											<label>Select Days</label>
											<select class="form-control select_day select2" name="accommodation[{{$j}}][day][]" multiple>
												@for($i=1;$i<=$days;$i++)
												<option value="Day {{$i}}" @if(array_key_exists('day',$col) && in_array("Day $i",$col["day"])) selected @endif>Day {{$i}}</option>
												@endfor
											</select>
										</div>
										<div class="col-md-3 appendBottom10 quote_city_class">
											<label>City</label>
											<input type="text" name="accommodation[{{$j}}][city]" class="form-control text-capitalize quote_city" placeholder="Enter city name" value="{{$col['city']}}" />
										</div>
										<div class="col-md-3 propertytype_class">
											<div class="form-group">
												<label for="propertytype">Accommodation Type <span class="requiredcolor">*</span></label>
												<select class="form-control propertytype" name="accommodation[{{$j}}][propertytype]" id="propertytype">
													<option selected disabled>Select</option>
													<option value="hotel" @if(array_key_exists('propertytype',$col) && $col['propertytype']=='hotel') selected @endif>Hotel</option>
													<option value="resort" @if(array_key_exists('propertytype',$col) && $col['propertytype']=='resort') selected @endif>Resort</option>
													<option value="villa" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='villa') selected @endif>Villa</option>
													<option value="home" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='home') selected @endif>Home</option>
													<option value="camp" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='camp') selected @endif>Camp</option>
													<option value="cruise" @if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='cruise') selected @endif>Cruise</option>
												</select>
											</div>
										</div>
										<div class="col-md-4 appendBottom10 propertysource_class">
											<label>Accommodation Source</label>
											<select class="form-control propertysource" name="accommodation[{{$j}}][trip]" id="propertysource">
												<option selected disabled>Select</option>
												<option value="packagehoteldatabase" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') selected @endif>Package Hotel Database</option>
												<option value="hoteldatabase" @if(array_key_exists('trip',$col) && $col['trip']=='hoteldatabase') selected @endif>Hotel Database</option>
												<option value="tripadvisor" @if(array_key_exists('trip',$col) && $col['trip']=='tripadvisor') selected @endif>TripAdvisor</option>
												<option value="manual" @if(array_key_exists('trip',$col) && $col['trip']=='manual') selected @endif>Manual</option>
											</select>
										</div>
									<div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') style="display: block" @else style="display: none" @endif>
											<label>Property Name</label>
											@if(array_key_exists('city',$col) && array_key_exists('propertytype',$col))
											<?php $quote_hotel_data=CustomHelpers::get_quotation_hotel_new($col['city'],$col['propertytype']); ?>
											<select class="form-control text-capitalize quote_hotel" name="accommodation[{{$j}}][hotel]">
												<option value='0' selected='true' disabled='disabled'>Select</option>
												@foreach($quote_hotel_data as $single)
												<option value="{{$single->id}}" @if($col['hotel']==$single->id) selected @endif>{{$single->hotelname}}</option>
												@endforeach
											</select>
											@else
											<select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
												<option value='0' selected='true' disabled='disabled'>Select</option>
											</select>
											@endif
									</div>
									<div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" @if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase') style="display: block" @else style="display: none" @endif>
										<label>Star Rating</label>
										<select class="form-control selectpropertystar_value" name="accommodation[{{$j}}][star]">
											<option selected disabled>Select</option>
											<option value="1" @if(array_key_exists('star',$col) && $col['star']==1) selected @endif>1 star</option>
											<option value="2" @if(array_key_exists('star',$col) && $col['star']==2) selected @endif>2 star</option>
											<option value="3" @if(array_key_exists('star',$col) &&  $col['star']==3) selected @endif>3 star</option>
											<option value="4" @if(array_key_exists('star',$col) &&  $col['star']==4) selected @endif>4 star</option>
											<option value="5" @if(array_key_exists('star',$col) &&  $col['star']==5) selected @endif>5 star</option>
										</select>
									</div>
									<div class="col-md-4 appendBottom10 propertyname" id="propertyname" @if(array_key_exists('trip',$col) && $col['trip']=='manual') style="display: block" @else style="display: none" @endif>
										<label>Enter Property</label>
										<input type="text" class="form-control text-capitalize" name="accommodation[{{$j}}][other_hotel]" placeholder="Enter property name" value="{{$col['other_hotel']}}">
									</div>
									<div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" @if(array_key_exists('trip',$col) && $col['trip']=='manual') style="display: block" @else style="display: none" @endif>
										<label>Enter Star Rating</label>
										<select class="form-control" name="accommodation[{{$j}}][star_other]" id="">
											<option selected disabled>Select</option>
											<option value='1' @if(array_key_exists('star_other',$col) && $col['star_other']==1) selected @endif>1 star</option>
											<option value='2' @if(array_key_exists('star_other',$col) && $col['star_other']==2) selected @endif>2 star</option>
											<option value='3' @if(array_key_exists('star_other',$col) && $col['star_other']==3) selected @endif>3 star</option>
											<option value='4' @if(array_key_exists('star_other',$col) && $col['star_other']==4) selected @endif>4 star</option>
											<option value='5' @if(array_key_exists('star_other',$col) && $col['star_other']==5) selected @endif>5 star</option>
										</select>
									</div>
									<div class="col-md-12"></div>
										<div class="col-md-4 appendBottom10">
											<label>Room Type</label>
											<input type="text" class="form-control text-capitalize" name="accommodation[{{$j}}][category]" placeholder="Enter room type" value="{{$col['category']}}">
										</div>
										<div class="col-md-4 appendBottom10 hotel_link_class">
											<label>Hotel Website</label>
											<input type="text" class="form-control text-lowercase hotel_link" name="accommodation[{{$j}}][hotel_link]" placeholder="Enter hotel website" value="{{$col['hotel_link']}}">
										</div>
										<div class="col-md-4 appendBottom10 hotel_contact_class">
											<label>Hotel Contact No</label>
											<input type="text" class="form-control text-capitalize hotel_contact" name="accommodation[{{$j}}][contact]" placeholder="Enter hotel contact no" value="{{$col['hotel_link']}}">
										</div>
										<div class="col-md-12"></div>
										<div class="col-md-4 appendBottom10">
											<label>Meals</label>
											<select class="form-control accommodationMeals" name="accommodation[{{$j}}][meals]" id="">
												<option selected disabled>Select</option>
												<option value='Room Only' @if(array_key_exists('meals',$col) && $col['meals']=='Room Only') selected @endif>Room Only</option>
												<option value='Breakfast' @if(array_key_exists('meals',$col) && $col['meals']=='Breakfast') selected @endif>Breakfast</option>
												<option value='Half Board' @if(array_key_exists('meals',$col) && $col['meals']=='Half Board') selected @endif>Half Board</option>
												<option value='Full Board' @if(array_key_exists('meals',$col) && $col['meals']=='Full Board') selected @endif>Full Board</option>
											</select>
										</div>
										@if($j>0)
										<div class="col-md-4 appendBottom10" >
											<label>Fare Type</label>
											<select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]" id="">
												<option selected disabled>Select</option>
												<option value='Refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable') selected @endif>Refundable</option>
												<option value='Non-refundable' @if(array_key_exists('faretype',$col) &&  $col['faretype']=='Non-refundable') selected @endif>Non-refundable</option>
											</select>
										</div>
										<div class="col-md-4 appendTop20"><button type="button" name="add" id="{{$j}}" class="remove_acco btn btn-danger">x Remove</button></div>
										@else
										<div class="col-md-4 appendBottom10" >
											<label>Fare Type</label>
											<select class="form-control accommodationFareType" name="accommodation[{{$j}}][faretype]" id="">
												<option selected disabled>Select</option>
												<option value='Refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable') selected @endif>Refundable</option>
												<option value='Non-refundable' @if(array_key_exists('faretype',$col) && $col['faretype']=='Non-refundable') selected @endif>Non-refundable</option>
											</select>
										</div>
										@endif
									</div>
								</div>
                               <?php $j++; ?>
                               @endforeach
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<button type="button" name="add" id="add_acco" days="{{$days}}" class="btn btn-success">Add More Hotel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Flight-->
				<?php
				 $flight_data=unserialize($reference_data->option1_flight); 
				 ?>
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-plane" aria-hidden="true"></i> Flight <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="flightOption">
										<label for="flightOption">Flight Required?</label>
										<input type="checkbox" name="flight[flightOption]"  id="show_flight_options" value="1" @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1) checked @endif>
									</div>
								</div>
								<div class="flight"  @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1) style="display: block;" @else style="display: none;"  @endif>
									<!--Onward Flight-->
									<div class="col-md-12">
									<div class="flightOption">
										<label for="onward_required">Onward Flight Required?</label>
										<input type="checkbox"  name="flight[onward_required]"  id="onward_required" value="1" @if(array_key_exists('onward_required',$flight_data) && $flight_data['onward_required']==1) checked @endif>
									</div>
								</div>
                                   <div class="onwardflight" @if(array_key_exists('onward_required',$flight_data) && $flight_data['onward_required']==1) style="display: block;" @else style="display: none;"  @endif> 

									<div class="col-md-12 appendBottom10">
										<p class="flightBoxHeading">ONWARD FLIGHT</p>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Onward Date</label>
										<input type="text" name="flight[onwarddate]" class="form-control departure_date" placeholder="Select departure date" value="{{$flight_data['onwarddate']}}">
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Airline Name</label>
										<!--<input type="text" name="flight[name]" class="form-control flight_name">-->
										<select name="flight[name]" class="form-control flight_name">
											<option value="0">Select Airline</option>
											@foreach($airlines as $airline)
											<option value="{{$airline->airline_name}}" @if($flight_data['name']==$airline->airline_name) selected @endif>{{$airline->airline_name}} </option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Flight No.</label>
										<input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333" value="{{$flight_data['no']}}">
									</div>
									<div class="col-md-3 appendBottom20">
										<label>No. Of Stop</label>
										<select name="flight[numberstop]" class="form-control">
											<option value="0" @if($flight_data['numberstop']==0) selected @endif>Select Stops</option>
											<option value="Non-Stop" @if($flight_data['numberstop']=="Non-Stop") selected @endif>Non-Stop</option>
											@for($i=1;$i<=4;$i++)
											@if($i==1)
											<option value="{{ $i }} Stop" @if($flight_data['numberstop']=="$i Stop") selected @endif>{{ $i }} Stop</option>
											@else
											<option value="{{ $i }} Stops" @if($flight_data['numberstop']=="$i Stops") selected @endif>{{ $i }} Stops</option>
											@endif
											@endfor;
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Flight Origin</label>
										<select name="flight[origin]" class="form-control origin">
											<option value="0" @if(array_key_exists('origin',$flight_data) && $flight_data['origin']==0) selected @endif>Select Origin</option>
											@foreach($iatalist as $iata)
										<?php 
                                             $val=$iata->iata_name.' '.'('.$iata->iata_code.')';
											?>
											<option value="{{$val}}" @if(array_key_exists('origin',$flight_data) && $flight_data['origin']==$val) selected @endif>{{$val}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Departure Time</label>
										<div class="clearfix"></div>
											<select name="flight[dhours]" class="form-control dhours" style="max-width: 49%;display: inline-block;">
												<option value="0" >Hours</option>
												@for($i=1;$i<=24;$i++)
												<option value="{{ $i }}" @if(array_key_exists('dhours',$flight_data) && $flight_data['dhours']==$i) selected @endif>{{ $i }}</option>
												@endfor;
											</select>
											<select name="flight[dmins]" class="form-control dmins" style="max-width: 49%;display: inline-block;">
												<option value="0">Minutes</option>
												@for($i=1;$i<=60;$i++)
												<option value="{{ $i }}" @if(array_key_exists('dmins',$flight_data) && $flight_data['dmins']==$i) selected @endif>{{ $i }}</option>
												@endfor;
											</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Destination</label>
										<select name="flight[dest]" class="form-control dest">
											<option value="0">Select Destination</option>
											@foreach($iatalist as $iata)
											<?php 
                                            $val=$iata->iata_name.' '.'('.$iata->iata_code.')';
											?>
											<option value="{{$val}}" @if($flight_data['dest']==$val) selected @endif>{{$val}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Arrival Time</label>
										<div class="clearfix"></div>
										<select name="flight[ahours]" class="form-control ahours" style="padding: 5px;max-width: 32%;display: inline-block;">
											<option value="0">Hours</option>
											@for($i=1;$i<=72;$i++)
											<option value="{{ $i }}" @if(array_key_exists('ahours',$flight_data) && $flight_data['ahours']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
										<select name="flight[amins]" class="form-control amins" style="padding: 5px;max-width: 37%;display: inline-block;">
											<option value="0">Minutes</option>
											@for($i=1;$i<=60;$i++)
											<option value="{{ $i }}" @if(array_key_exists('amins',$flight_data) && $flight_data['amins']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
										<select name="flight[adayplus]" class="form-control adayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
											<option value="0" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==0) selected @endif>+ 0Day</option>
											<option value="1" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==1) selected @endif>+1 Day</option>
											<option value="2" @if(array_key_exists('adayplus',$flight_data) && $flight_data['adayplus']==2) selected @endif>+2 Day</option>
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Cabin Class</label>
										<select name="flight[cabin]" class="form-control">
											<option value="economyclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='economyclass') selected @endif>Economy</option>
											<option value="premiumeconomyclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='premiumeconomyclass') selected @endif>Premium Economy</option>
											<option value="businessclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='businessclass') selected @endif>Business</option>
											<option value="firstclass" @if(array_key_exists('cabin',$flight_data) && $flight_data['cabin']=='firstclass') selected @endif>First</option>
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Fare Type</label>
										<select name="flight[faretype]" class="form-control">
											<option value="">Select</option>
											<option value="refundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='refundable') selected @endif>Refundable</option>
											<option value="partialrefundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='partialrefundable') selected @endif>Partial-refundable</option>
											<option value="non-refundable" @if(array_key_exists('faretype',$flight_data) && $flight_data['faretype']=='non-refundable') selected @endif>Non-refundable</option>
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Flight Duration</label>
										<div class="clearfix"></div>
											<select name="flight[duration_hours]" class="form-control duration_hours" style="max-width: 49%;display: inline-block;">
												<option value="0">Hours</option>
												@for($i=1;$i<=24;$i++)
												<option value="{{ $i }}" @if(array_key_exists('duration_hours',$flight_data) && $flight_data['duration_hours']==$i) selected @endif>{{ $i }} hrs </option>
												@endfor;
											</select>
											<select name="flight[duration_dmins]" class="form-control duration_min" style="max-width: 49%;display: inline-block;">
												<option value="0">Minutes</option>
												@for($i=1;$i<=59;$i++)
												<option value="{{ $i }}" @if(array_key_exists('duration_dmins',$flight_data) && $flight_data['duration_dmins']==$i) selected @endif>{{ $i }} mins</option>
												@endfor;
											</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
										<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
											<option value="" selected disabled>Cabin Bag</option>
											<option value="0 Kg" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='0 Kg') selected @endif>0 Kg</option>
											<option value="5 Kgs" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='5 Kgs') selected @endif>5 Kgs</option>
											<option value="7 Kgs" @if(array_key_exists('baggage',$flight_data) && $flight_data['baggage']=='7 Kgs') selected @endif>7 Kgs</option>
										</select>
										<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
											<option selected disabled>Check-In Bag</option>
											<option value="0 Kg" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='0 Kg') selected @endif>0 Kg</option>
											<option value="10 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='10 Kgs') selected @endif>10 Kgs</option>
											<option value="15 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='15 Kgs') selected @endif>15 Kgs</option>
											<option value="20 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='20 Kgs') selected @endif>20 Kgs</option>
											<option value="23 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='23 Kgs') selected @endif>23 Kgs</option>
											<option value="25 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='25 Kgs') selected @endif>25 Kgs</option>
											<option value="30 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='30 Kgs') selected @endif>30 Kgs</option>
											<option value="35 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='35 Kgs') selected @endif>35 Kgs</option>
											<option value="40 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='40 Kgs') selected @endif>40 Kgs</option>
											<option value="45 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='45 Kgs') selected @endif>45 Kgs</option>
											<option value="50 Kgs" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='50 Kgs') selected @endif>50 Kgs</option>
											<option value="1 Piece" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='1 Piece') selected @endif>1 Piece</option>
											<option value="2 Pieces" @if(array_key_exists('cbaggage',$flight_data) && $flight_data['cbaggage']=='2 Pieces') selected @endif>2 Pieces</option>
										</select>
									</div>
									 </div>
									<!--Return Flight-->
									 <div class="col-md-12">
									<div class="flightOption">
										<label for="return_required">Return Flight Required?</label>
										<input type="checkbox"  name="flight[return_required]"  id="return_required" value="1"  @if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1) checked @endif>
									</div>
								</div>
								<div class="returnflight" @if(array_key_exists('return_required',$flight_data) && $flight_data['return_required']==1) style="display: block;" @else style="display: none;"  @endif> 
									<div class="col-md-12 appendBottom10">
										<p class="flightBoxHeading">RETURN FLIGHT</p>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Return Date</label>
										<input type="text" name="flight[downwarddate]" class="form-control return_date" placeholder="Select return date" value="{{$flight_data['downwarddate']}}">
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Airline Name</label>
										<select name="flight[dname]" class="form-control down_filght">
											<option value="0">Select Airline</option>
											@foreach($airlines as $airline)
											<option value="{{$airline->airline_name}}" @if($flight_data['dname']==$airline->airline_name) selected @endif>{{$airline->airline_name}} </option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Flight No.</label>
										<input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334" value="{{$flight_data['dno']}}">
									</div>
									<div class="col-md-3 appendBottom20">
										<label>No. Of Stop</label>
										<select name="flight[dnumberstop]" class="form-control">
											<option value="0" @if($flight_data['dnumberstop']==0) selected @endif>Select Stopover</option>
											<option value="Non-Stop" @if($flight_data['dnumberstop']=="Non-Stop") selected @endif>Non-Stop</option>
											@for($i=1;$i<=4;$i++)
											@if($i==1)
											<option value="{{ $i }} Stop" @if($flight_data['dnumberstop']=="$i Stop") selected @endif>{{ $i }} Stop</option>
											@else
											<option value="{{ $i }} Stops" @if($flight_data['dnumberstop']=="$i Stops") selected @endif>{{ $i }} Stops</option>
											@endif
											@endfor;
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Flight Origin</label>
										<select name="flight[dOrigin]" class="form-control down_origin">
											<option value="0" @if($flight_data['dOrigin']==0) selected @endif>Select Origin</option>
											@foreach($iatalist as $iata)
											<?php 
                                              $val=$iata->iata_name.' '.'('.$iata->iata_code.')';
											?>
											<option value="{{$val}}" @if($flight_data['dOrigin']==$val) selected @endif>{{$val}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Departure Time</label>
										<div class="clearfix"></div>
										<select name="flight[ddhours]" class="form-control ddhours" style="max-width: 49%;display: inline-block;">
											<option value="0">Hours</option>
											@for($i=1;$i<=24;$i++)
											<option value="{{ $i }}" @if(array_key_exists('ddhours',$flight_data) && $flight_data['ddhours']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
										<select name="flight[ddmins]" class="form-control ddmins" style="max-width: 49%;display: inline-block;">
											<option value="0">Minutes</option>
											@for($i=1;$i<=60;$i++)
											<option value="{{ $i }}" @if(array_key_exists('ddmins',$flight_data) && $flight_data['ddmins']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Destination</label>
										<select name="flight[ddest]" class="form-control down_dest">
											<option value="0">Select Destination</option>
											@foreach($iatalist as $iata)
											<?php 
                                              $val=$iata->iata_name.' '.'('.$iata->iata_code.')';
											?>
											<option value="{{$val}}" @if(array_key_exists('ddest',$flight_data) &&  $flight_data['ddest']==$val) selected @endif>{{$val}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Arrival Time</label>
										<div class="clearfix"></div>
										<select name="flight[dahours]" class="form-control dahours" style="padding: 5px;max-width: 32%;display: inline-block;">
											<option value="0">Hours</option>
											@for($i=1;$i<=24;$i++)
											<option value="{{ $i }}" @if(array_key_exists('dahours',$flight_data) && $flight_data['dahours']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
										<select name="flight[damins]" class="form-control damins" style="padding: 5px;max-width: 37%;display: inline-block;">
											<option value="0">Minutes</option>
											@for($i=1;$i<=60;$i++)
											<option value="{{ $i }}" @if(array_key_exists('damins',$flight_data) && $flight_data['damins']==$i) selected @endif>{{ $i }}</option>
											@endfor;
										</select>
										<select name="flight[dadayplus]" class="form-control dadayplus" style="padding: 0px;max-width: 28%;display: inline-block;">
											<option value="0" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==0) selected @endif>+ 0Day</option>
											<option value="1" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==1) selected @endif>+1 Day</option>
											<option value="2" @if(array_key_exists('dadayplus',$flight_data) && $flight_data['dadayplus']==2) selected @endif>+2 Day</option>
										</select>
									</div>
									<div class="col-md-3">
										<label>Cabin Class</label>
										<select name="flight[dcabin]" class="form-control">
											<option value="economyclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='economyclass') selected @endif>Economy</option>
											<option value="premiumeconomyclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='premiumeconomyclass') selected @endif>Premium Economy</option>
											<option value="businessclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='businessclass') selected @endif>Business</option>
											<option value="firstclass" @if(array_key_exists('dcabin',$flight_data) && $flight_data['dcabin']=='firstclass') selected @endif>First</option>
										</select>
									</div>
									<div class="col-md-3 appendBottom20">
										<label>Fare Type</label>
										<select name="flight[dfaretype]" class="form-control">
											<option value="">Select</option>
											<option value="refundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='refundable') selected @endif>Refundable</option>
											<option value="partialrefundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='partialrefundable') selected @endif>Partial-refundable</option>
											<option value="non-refundable" @if(array_key_exists('dfaretype',$flight_data) && $flight_data['dfaretype']=='non-refundable') selected @endif>Non-refundable</option>
										</select>
									</div>
									<div class="col-md-3">
										<label>Flight Duration</label>
										<div class="clearfix"></div>
										<select name="flight[return_duration_hours]" class="form-control return_duration_hours" style="max-width: 49%;display: inline-block;">
											<option value="0">Hours</option>
											@for($i=1;$i<=24;$i++)
												<option value="{{ $i }}" @if(array_key_exists('return_duration_hours',$flight_data) && $flight_data['return_duration_hours']==$i) selected @endif>{{ $i }} hrs </option>
												@endfor;
										</select>
										<select name="flight[return_duration_mins]" class="form-control return_duration_min" style="max-width: 49%;display: inline-block;">
											<option value="0">Minutes</option>
											@for($i=1;$i<=59;$i++)
											<option value="{{ $i }}" @if(array_key_exists('return_duration_mins',$flight_data) && $flight_data['return_duration_mins']==$i) selected @endif>{{ $i }} mins</option>
												@endfor;
										</select>
									</div>
									<div class="col-md-3">
										<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
										<select name="flight[dbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
											<option selected disabled>Cabin Bag</option>
											<option value="0 Kg" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='0 Kg') selected @endif>0 Kg</option>
											<option value="5 Kgs" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='5 Kgs') selected @endif>5 Kgs</option>
											<option value="7 Kgs" @if(array_key_exists('dbaggage',$flight_data) && $flight_data['dbaggage']=='7 Kgs') selected @endif>7 Kgs</option>
										</select>
										<select name="flight[dcbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
											<option selected disabled>Check-In Bag</option>
											<option value="0 Kg" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='0 Kg') selected @endif>0 Kg</option>
											<option value="10 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='10 Kgs') selected @endif>10 Kgs</option>
											<option value="15 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='15 Kgs') selected @endif>15 Kgs</option>
											<option value="20 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='20 Kgs') selected @endif>20 Kgs</option>
											<option value="23 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='23 Kgs') selected @endif>23 Kgs</option>
											<option value="25 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='25 Kgs') selected @endif>25 Kgs</option>
											<option value="30 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='30 Kgs') selected @endif>30 Kgs</option>
											<option value="35 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='35 Kgs') selected @endif>35 Kgs</option>
											<option value="40 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='40 Kgs') selected @endif>40 Kgs</option>
											<option value="45 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='45 Kgs') selected @endif>45 Kgs</option>
											<option value="50 Kgs" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='50 Kgs') selected @endif>50 Kgs</option>
											<option value="1 Piece" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='1 Piece') selected @endif>1 Piece</option>
											<option value="2 Pieces" @if(array_key_exists('dcbaggage',$flight_data) && $flight_data['dcbaggage']=='2 Pieces') selected @endif>2 Pieces</option>
										</select>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Transfers-->
				<?php $transfers=unserialize($reference_data->transfers); ?>
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-bus" aria-hidden="true"></i> Transfers (Car, Bus, Train) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12 transfers_input_wrapper">

									@if($reference_data->transfers!='')
									<?php $a=0; ?>
									@foreach($transfers as $row=>$col)
									<div class="row transfers_input" id="transfers_input-0" data-id="{{$a}}">
										<input type="hidden" value="">
										<div class="field-{{$a}}" id="{{$a}}">
											<div class="form-group col-sm-3">
												<label for="transfertitle">Transfer Title</label>
												<input type="text" name="transfers[{{$a}}][mode_title]" class="form-control mode_title" placeholder="Title" value="{{$col['mode_title']}}">
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="transportmode">Transport Mode</label>
													<select name="transfers[{{$a}}][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
														<option selected disabled>Select</option>
														<option value="Car" @if(array_key_exists('transport_type',$col) && $col['transport_type']=='Car') selected @endif>Car</option>
														<option value="Bus"  @if(array_key_exists('transport_type',$col) && $col['transport_type']=='Bus') selected @endif>Bus</option>
														<option value="Train"  @if(array_key_exists('transport_type',$col) && $col['transport_type']=='Train') selected @endif>Train</option>
													</select>
												</div>
											</div>
											<div class="form-group col-sm-3">
												<label for="transfertype">Transfer Type</label>
												<select name="transfers[{{$a}}][transfers_type]" id="transfers_type0" class="form-control transfers_type">
												@if(array_key_exists('transport_type',$col))
												<?php $transfers=CustomHelpers::get_transfertype_second($col['transport_type']); ?>
													<option value="0">Select</option>
													@foreach($transfers as $transfer)
													<option value="{{$transfer->title}}" @if($transfer->title==$col['transfers_type']) selected @endif>{{$transfer->title}} </option>
													@endforeach
													@else
													<option value="0">Select</option>
													@endif
												</select>
											</div>
											@if($a>0)
											<div class="col-md-2"><button type="button" name="remove_transfer" data-remove="transfers_input-{{$a}}" class="remove_transfer btn btn-danger" style="margin-top:23px">x Remove</button> </div>
											@endif
										</div>
									</div>
                                    <?php $a++; ?>
                                    @endforeach
                                    @else
                                    	<div class="row transfers_input" id="transfers_input-0" data-id="0">
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

                                    @endif
								</div>
								<div class="col-md-12">
									<button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">Add More</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Overview-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Tour Overview (Add-on Service & Highlights) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="addonservices">Add-On Services (Room upgrade, Honeymoon freebies etc.)</label>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="5">{!! $reference_data->option1_description !!}</textarea>
									</div>
									<div class="form-group">
										<label for="highlights">Add Tour Highlights</label>
										<br>
										<span class="show_hide morePlus">More+</span>
										<textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5">{!! $reference_data->option1_highlights !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Inclusions & Exclusions-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-plus-circle" aria-hidden="true"></i> Inclusions & Exclusions <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group select-container">
										<label>Inclusions</label>
										
                                        <?php $option1_quote_inc=unserialize($reference_data->quote_inc); ?>
										
										<select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
											@foreach($inclusions as $pol)
											<option value="{{$pol->id}}" @if($option1_quote_inc!="" && in_array("$pol->id",$option1_quote_inc)) selected @endif>{{$pol->name}} </option>
											@endforeach
										</select>
										<br>
										<br>
										<span class="show_hide morePlus">Less-</span>
										<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">{!! $reference_data->option1_inclusions !!}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class=" form-group ">
										<label>Exclusions</label>
										<?php $option1_quote_exc=unserialize($reference_data->quote_exc); ?>
										<select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
											@foreach($exclusions as $pol)
											<option value="{{$pol->id}}" @if($option1_quote_exc!="" && in_array("$pol->id",$option1_quote_exc)) selected @endif>{{$pol->name}} </option>
											@endforeach
										</select>
										<br>
										<br>
										<span class="show_hide morePlus">Less-</span>
										<textarea class="form-control ckeditor"  name="exclusions" id="" cols="30" rows="5">{!! $reference_data->option1_exclusions !!}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Itinerary-->
				<?php $option1_dayItinerary=unserialize($reference_data->option1_dayItinerary); ?>
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-map-marker" aria-hidden="true"></i> Tour Itinerary <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										@for($j=1;$j<=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT);$j++)
										<div class="day1">
											<div class="dayTitle">DAY {{$j}}
												<input type="text" name="dayItinerary[day{{$j}}][title]" placeholder="Day Title" @if($option1_dayItinerary!="" && array_key_exists("day$j",$option1_dayItinerary)) value="{{$option1_dayItinerary["day$j"]["title"]}}" @endif>
											</div>
												<div class="form-group">
													<label for="dayDescription" class="color4a">Add day description</label>
													<br>
													<span class="show_hide morePlus">More+</span>
													<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]">@if($option1_dayItinerary!="" && array_key_exists("day$j",$option1_dayItinerary)) {!! $option1_dayItinerary["day$j"]["desc"] !!} @endif</textarea>
												</div>
											<div class="dayPlanSeparator"></div>
										</div>
										@endfor
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Policy-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-info-circle" aria-hidden="true"></i></span> Tour Policies (Visa, Booking, Cancellation & Important Notes) <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<h4>Terms & Conditions</h4>
									<div class="visaOption">
										<label for="visa">Is Visa Required?</label>
										<input type="checkbox" name="visa" value="1" id="visa" class="visa" @if($reference_data->option1_visa=="1") checked @endif/>
									</div>
									<!--Visa Policy-->
									<div class="visa_pol" @if($reference_data->option1_visa=="1") style="display:block" @endif>
										<h5>Visa Terms & Policies</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div>
															<?php $option1_package_visa=unserialize($reference_data->option1_package_visa); ?>
															<select name="package_visa[]"  class="select2 form-control package_visa" multiple>
																@foreach($visaPolicy as $pol)
																<option value="{{$pol->id}}" @if($option1_package_visa!="" && in_array("$pol->id",$option1_package_visa)) selected @endif>{{$pol->policy}} </option>
																@endforeach
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides morePlus">More+</span>
														<br>
														<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text"> {{$reference_data->option1_visa_policies}}</textarea>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!--Payment Policy-->
									<div>
										<h5>Payment Terms & Methods</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div>
															<?php $option1_package_payment=unserialize($reference_data->option1_package_payment); ?>
															<select name="package_payment[]"  class="select2 form-control package_payment" multiple>
																@foreach($paymentPolicy as $pol)
																<option value="{{$pol->id}}" @if($option1_package_payment!="" && in_array("$pol->id",$option1_package_payment)) selected @endif>{{$pol->policy}} </option>
																@endforeach
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides morePlus">More+</span>
														<br>
														<textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text">{{$reference_data->option1_payment_policies}}</textarea>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<!--Cancellation Policy-->
									<div>
										<h5>Cancellation & Refund Policy</h5>
										<table class="table table-bordered" id="dynamic_field">
											<tbody>
												<tr>
													<td>
														<div>
															<?php $option1_package_can=unserialize($reference_data->option1_package_can); ?>
															<select name="package_can[]"  class="select2 form-control package_can" multiple>
																@foreach($cancelPolicy as $pol)
																<option value="{{$pol->id}}" @if($option1_package_can!="" && in_array("$pol->id",$option1_package_can)) selected @endif>{{$pol->policy}} </option>
																@endforeach
															</select>
														</div>
													</td>
												</tr>
											<tr>
												<td>
													<span class="show_hides morePlus">More+</span>
													<br>
													<textarea name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control hide_text">{{$reference_data->option1_cancellation}}</textarea>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
									<!--Important Notes-->
									<div>
										<h5>Important Notes</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<div>
															<?php $option1_package_impnotes=unserialize($reference_data->option1_package_impnotes); ?>
															<select name="package_impnotes[]" class="select2 form-control package_impnotes" multiple>
																@foreach($imp_notes as $pol)
																<option value="{{$pol->id}}" @if($option1_package_impnotes!="" && in_array("$pol->id",$option1_package_impnotes)) selected @endif>{{$pol->policy}} </option>
																@endforeach
															</select>
														</div>
													</td>
												</tr>
											<tr>
												<td>
													<span class="show_hides morePlus">More+</span>
													<br>
													<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control hide_text"> {{$reference_data->option1_extra_imp}}</textarea>
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
				<!--Tour Quote Validity-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Quote Validity <span class="requiredcolor">*</span></h4>
					</div>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<div class="quoteValidity">
										<label for="quoteValidity">Quote Validity</label>
										<input type="text" class="datepicker_s" name="validaty" value="{{$reference_data->option1_validaty}}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Greetings & Signature-->
				<div class="itemBox">
					<div class="accordion">
						<h4 class="panelHeading"><i class="fa fa-user" aria-hidden="true"></i></span> Greetings & Signature <span class="requiredcolor">*</span></h4>
					</div>
					<?php $loged_user=Sentinel::getUser(); ?>
					<div class="panelBox">
						<div class="panelContent">
							<div class="row">
								<div class="col-md-12">
									<h5>Header <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<div class="flexBetween">
														<label for="emailHeader" class="emailHeader">Email header <span class="requiredcolor">*</span></label>
														<i class="@if($loged_user->lock_header_email==1) fa fa-lock @else fa fa-unlock @endif lock_header_icon" aria-hidden="true"></i>
													</div>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor" @if($loged_user->lock_header_email==1) readonly @endif> {!! $reference_data->option1_quotation_header_extra !!}</textarea>
												</td>
											</tr>
											<tr>
												<td>
													<div class="flexBetween">
														<label for="webHeader" class="webHeader">Web header <span class="requiredcolor">*</span></label>
														<i class="@if($loged_user->lock_header==1) fa fa-lock @else fa fa-unlock @endif lock_header_icon" aria-hidden="true"></i>
													</div>
													<div>
														<!-- <input type="hidden" name="quotation_header" class="quotation_header" value="{{$loged_user->quotation_header}}"> -->
														<select name="quotation_header" class="select2 form-control" @if($loged_user->lock_header==1) style="cursor:not-allowed" disabled @endif>
															@foreach($quotation_header as $pol)
															<option value="{{$pol->id}}" @if($reference_data->option1_quotation_header==$pol->id) selected @endif>{{$pol->header}}</option>
															@endforeach
														</select>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<h5>Signature <span class="requiredcolor">*</span></h5>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
													<div class="flexBetween">
														<label for="emailFooter" class="emailFooter">Email footer <span class="requiredcolor">*</span></label>
														<i class="@if($loged_user->lock_footer_email==1) fa-lock @else fa-unlock @endif lock_header_icon" aria-hidden="true"></i>
													</div>
													<span class="show_hide morePlus">More+</span>
													<br>
													<textarea name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor" @if($loged_user->lock_footer_email==1) readonly @endif> {!! $reference_data->option1_quotation_footer_extra !!} </textarea>
												</td>
											</tr>
											<tr>
												<td>
													<div class="flexBetween">
														<label for="webFooter" class="webFooter">Web footer <span class="requiredcolor">*</span></label>
														<i class="fa @if($loged_user->lock_footer==1) fa-lock @else fa-unlock @endif lock_header_icon" aria-hidden="true"></i>
													</div>
													<div>
														<!-- <input type="hidden" name="quotation_footer" class="quotation_footer" value="{{$loged_user->quotation_footer}}"> -->
														<select class="select2 form-control" name="quotation_footer" @if($loged_user->lock_footer==1) style="cursor:not-allowed" disabled @endif>
															@foreach($quotation_footer as $pol)
															<option value="{{$pol->id}}" @if($reference_data->option1_quotation_footer==$pol->id) selected @endif>{{$pol->footer}} </option>
															@endforeach
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
				<!--Save Quote-->
				<div class="col-md-12 saveOptions">
					<div class="savePreview appendRight10">
						<label class="radio-inline">
						<input type="radio" value="1" name="send_option" checked>Save & Preview</label>
					</div>
					<div class="saveSend">
						<label class="radio-inline">
						<input type="radio" value="0" name="send_option">Save & Send</label>
					</div>
				</div>
				<div class="col-md-12 saveQuote">
					<button type="submit" name="add" id="remove" class="btnblue btnQuoteSave">CONTINUE</button>
				</div>
				
				<div class="quote1_room_data" style="display: none;">
					<?php 
                    $rooms=unserialize($reference_data->room);
					?>
					@if($rooms!='')
					<div class="roomGuests">
		            <label for="roomnumber fontWeight600">No of Rooms <span class="requiredcolor">*</span></label>
							<select class="form-control select_room" name="remarks">
							<option value="">Select Room</option>
							@for($i=1;$i<=10;$i++)
							<option value="{{$i}}" @if($i==$reference_data->no_of_room) selected @endif>{{$i}}</option>
							@endfor
						</select>

						<input type="text" value="2 Rooms (4 Adults,2 Child,1 Infant)" id="" readonly="">
					</div>
					<div class="modal-body modalBody custom_border" id="modal-body"><input type="hidden" name="no_of_room" value="{{ $reference_data->no_of_room  }}">
						<?php 
                         $k=0;
                         $j=1;
						?>
  @foreach($rooms as $row=>$col)
   <div class="appendBottom5">
   	<div class="border-bottom1 padding-top10">
   		<label for="room" class="pfwmt appendBottom5 font-size14" style="color: #000001 !important">Room {{$j}} <span class="requiredcolor">*</span></label>
   		<div class="makeflex" style="justify-content: space-between">
   			<div class="text-center">
   				<input type="hidden" id="travellers" name="room[{{$k}}][adult_room]" class="adult_room_value" value="{{$col['adult_room']}}">
   				<i class="glyphicon adult_room_dec glyphicon-minus font-size14" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
   				<span class="font-size20 adult_room_result" style="color: #008CFF;font-weight: 900;padding: 12px">{{$col['adult_room']}}</span>
   				<i class="glyphicon adult_room_inc glyphicon-plus font-size14" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i><p class="text-center font-size12" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;border-radius: 3px;">Adult ( + 12yrs)</p>
   			</div>
   			<div class="text-center">
   				<input type="hidden" id="travellers" name="room[{{$k}}][child_room]" class="span_value_child_with_bed child_room_value" value="{{$col['child_room']}}">
   				<i class="glyphicon glyphicon-minus font-size14 child_room_dec" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
   				<span class="font-size20 child_room_result" style="color: #008CFF;font-weight: 900;padding: 12px">{{$col['child_room']}}</span><i class="glyphicon glyphicon-plus child_room_inc font-size14" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i><p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Child (2-12yrs)</p>
   			</div>
   			<div class="text-center">
   				<input type="hidden" id="travellers" name="room[{{$k}}][infant_room]" class="infant_room_value" value="{{$col['infant_room']}}"><i class="glyphicon glyphicon-minus font-size14 infant_room_dec" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i><span class="font-size20 infant_room_result" style="color: #008CFF;font-weight: 900;padding: 12px">{{$col['infant_room']}}</span><i class="glyphicon glyphicon-plus infant_room_inc font-size14" style="color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i><p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Infant (0-2yrs)</p>
   			</div>
   		</div>
   	</div>
   </div>
   <?php
   $k++;
   $j++;
   ?>
   @endforeach
   </div>
   @endif
   </div>
   </form>