<style type="text/css">
.cke_chrome {
	display: none;
    }
.appendBottom20 {
	margin-bottom: 20px;
	}
</style>
<div class="tab-pane active"  id="option1" >
	<div class="col-md-12">
		<form action="{{URL::to('/option1')}}" method="post" id="quo1" name="quo1">
		<input type="hidden" name="type" value=""/>
		<input type="hidden" name="query_id" value="{{$data->id}}"/>
		{{csrf_field()}}
			<div class="panel-group" id="accordion">
				<!--Enquiry Details-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Info"><span class="glyphicon glyphicon-file">
							</span> Enquiry Details</a>
						</h4>
					</div>
					<div id="Info" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Service Type</label>
										<input type="text" class="form-control" name="" value="{{$data->service_type}}" placeholder="Service Type" readonly />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Channel Type</label>
										<input type="text" class="form-control" name="" value="{{$data->channel_type}}" placeholder="Channel Type" readonly />
									</div>
								</div>
								<div class="col-md-4"></div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Leading Guest Name</label>
										<input type="text" class="form-control" name="" readonly="" placeholder="Mr., Ms., Mrs., Blank" value="{{$data->name}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Contact No</label>
										<input type="text" class="form-control" name="" readonly="" value="{{$data->mobile}}" placeholder="Contact No">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Email Address</label>
										<input type="text" class="form-control" name="" value="{{$data->email}}" readonly="" placeholder="Email Address">
									</div>
								</div>
								<div class="col-md-4"></div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Package Name</label>
										@if(is_numeric($data->packageId))
											<input type="text" class="form-control" name="package_name" readonly="" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name">
										@else
											<input type="text" class="form-control" name="package_name" readonly="" value="{{$data->packageId}}" placeholder="Package Name">
										@endif
										<!--<input type="text" class="form-control" name="" readonly="" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name">-->
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Destination</label>
										<input type="text" class="form-control" value="{{$data->destinations}}" name="" readonly="" placeholder="Package Destination">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Travel Duration</label>
										<?php $day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT); ?>
										<input type="hidden" name="duration" value="{{$day_night}}">
										<input type="text" class="form-control" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="duration" readonly="" placeholder="Package Destination">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>No of Adults (+12 yrs)</label>
										<input type="text" class="form-control" name="" value="{{$data->span_value_adult}}" readonly="" placeholder="No of Adults (+12 yrs)">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>No of Child (5-12 yrs)</label>
										<input type="text" class="form-control" name="" value="{{$data->span_value_child}}" readonly="" placeholder="No of Child (5-12 yrs)">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>No of Child (0-5 yrs)</label>
										<input type="text" class="form-control" name="" value="{{$data->span_value_infant}}" readonly="" placeholder="No of Child (0-5 yrs)">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Nationality</label>
										<input type="text" class="form-control" name="" value="{{$data->country_of_residence}}" readonly="" placeholder="Nationality">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Best time to Call</label>
										<input type="text" class="form-control" name="" value="{{$data->time_call}}" readonly="" placeholder="Best time to Call">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Arrival Date</label>
										<input type="text" class="form-control" name="" value="{{$data->date_arrival}}" readonly="" placeholder="Arrival Date">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Package Name-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#packagename"><span class="glyphicon glyphicon-file">
							</span> Package Name</a>
						</h4>
					</div>
					<div id="packagename" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<label>Package Name</label>
									<input type="text" class="form-control" name="custom_package_name" placeholder="Package Name" value="@if(is_numeric($data->packageId)) {{CustomHelpers::get_package_name($data->packageId)}} @endif">
								</div>
								<div class="col-md-4">
									<label>Source</label>
									<input type="text" class="form-control" name="source" placeholder="Source">
								</div>
								<div class="col-md-4">
									<label>Remarks</label>
									<input type="text" class="form-control" name="admin_remarks" placeholder="Remarks...">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Package Service Included-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#package_service"><span class="glyphicon glyphicon-th-list"></span> Services Included in this Package</a>
						</h4>
					</div>
					<div id="package_service" class="panel-collapse collapse">
						<div class="panel-body">
							<label for="package_location">Services</label>
							<div class="input-group" style="margin-bottom:5px;">
								<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
								<select name="package_service[]" id="package_service" class="form-control select2" multiple>
								@if(count($icons)>0)
								@foreach($icons as $icon)
									<option value="{{$icon->icon_title}}">{{$icon->icon_title}}  </option>
								@endforeach
								@else
									<option value="No Result Found">No Result Found</option>
								@endif
								</select>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Pricing-->
				<div class="panel panel-default">
					<!--<div class="itemBox">-->
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#TourPrcing"><i class="fa fa-money" aria-hidden="true"></i> Tour Pricing <span class="requiredcolor">*</span></a>
						</h4>
					</div>
					<div id="TourPrcing" class="panel-collapse collapse">
						<!--<div class="panelBox">-->
							<table class="table">
								<tr>
									<td>Price Type <span class="requiredcolor">*</span></td>
									<td>
										<select class="form-control backgroundColorF2 price_type" name="price_type">
											<option value="Per Person">Per Person</option>
											<option value="Group Price">Group Price</option>
										</select>
									</td>
									<td class="anything"><input type="text" name="anything" class="form-control" placeholder="Price per person (inclusive of GST)..." ></td>
									<td class="remarks"><input type="text" name="remarks" class="form-control" placeholder="Price Remarks (if any) ..." ></td>
									<!-- <td class="noofrooms">
									<select class="form-control select_room" name="remarks">
									<option value="">Select Room</option>
									@for($i=1;$i<=10;$i++)
									<option value="{{$i}}">{{$i}}</option>
									@endfor
									</select>
									</td> -->
									<td>
										<div class="addRooms">
											<input type="text" placeholder="1 Room (2 Adults,0 Child,0 Infant)" value="1 Room (2 Adults,0 Child,0 Infant)" class="quote1_pop_passenger_value" readonly>
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
											<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency }}</option>
											@endforeach
										</select>
										<input type="text" name="roe" class="quote1_rate number_test" placeholder="ROE">
									</div>
									<div class="currencyConversion">
										<input type="text" name="indian_rate" class="quote1_value number_test" placeholder="Enter">
										<input type="text" name="total_value" class="backgroundColorF2 quote1_total number_test" placeholder="Value" readonly>
									</div>
									<p class="itemBottomHeading">Conversion</p>
								</th>
								<th>
									<p class="itemTopHeading">ADULT</p>
									<p class="itemTopSubHeading">(TWIN SHARING)</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="quote1_number_of_adult" class="quote1_number_of_adult quote1_adult_room_value" value="2" />
										<span class="travellersMinus quote1_adult_room_dec">&#8722;</span>
										<span class="travellersValue quote1_adult_room_result">2</span>
										<span class="travellersPlus quote1_adult_room_inc">&#43;</span>
									</div>
									<p class="itemBottomHeading">Adult (+12yrs)</p>
								<th>
									<p class="itemTopHeading">EXTRA ADULT</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="extra_adult" class="quote1_number_of_extra_adult quote1_child_extra_adult_value" value="0" />
										<span class="travellersMinus quote1_child_extra_adult_dec">&#8722;</span>
										<span class="travellersValue quote1_child_extra_adult_result">0</span>
										<span class="travellersPlus quote1_child_extra_adult_inc">&#43;</span>
									</div>
									<p class="itemBottomHeading">Extra Adult (+12yrs)</p>
								</th>
								<th>
									<p class="itemTopHeading">CHILD</p>
									<p class="itemTopSubHeading">(WITH BED)</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="child_with_bed" class="quote1_number_of_child_with_bed quote1_child_with_bed_value" value="0" />
										<span class="travellersMinus quote1_child_with_bed_dec">&#8722;</span>
										<span class="travellersValue quote1_child_with_bed_result">0</span>
										<span class="travellersPlus quote1_child_with_bed_inc">&#43;</span>
									</div>
									<p class="itemBottomHeading">Child (2-12yrs)</p>
								</th>
								<th>
									<p class="itemTopHeading">CHILD</p>
									<p class="itemTopSubHeading">(WITHOUT BED)</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="child_without_bed" class="quote1_number_of_child_without_bed quote1_childwithoutbed_value" value="0" />
										<span class="travellersMinus quote1_childwithoutbed_dec">&#8722;</span>
										<span class="travellersValue quote1_span_value_childwithoutbed_result">0</span>
										<span class="travellersPlus quote1_childwithoutbed_inc">&#43;</span>
									</div>
									<p class="itemBottomHeading">Child (2-12yrs)</p>
								</th>
								<th>
									<p class="itemTopHeading">INFANT</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="infant" class="quote1_number_of_infant quote1_infant_value" value="0" />
										<span class="travellersMinus quote1_infant_dec">&#8722;</span>
										<span class="travellersValue quote1_infant_result">0</span>
										<span class="travellersPlus quote1_infant_inc">&#43;</span>
									</div>
									<p class="itemBottomHeading">Infant (0-2yrs)</p>
								</th>
								<th>
									<p class="itemTopHeading">SOLO<br>TRAVELLER</p>
									<div class="addTravellerValue">
										<input type="hidden" id="travellers" name="solo_traveller" class="quote1_number_solo_traveller quote1_solo_value" value="0" />
										<span class="travellersMinus quote1_solo_dec">&#8722;</span>
										<span class="travellersValue quote1_solo_result">0</span>
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
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[quote_airfare_remarks]" id="remarks_airfare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_air_adult" name="price[query_air_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_air_exadult exadult_disable" name="price[query_air_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_air_childbed childbed_disable" name="price[query_air_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_air_childwbed childwbed_disable" name="price[query_air_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_air_infant infant_disable" name="price[query_air_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_air_single single_disable" name="price[query_air_single]"></td>
								</tr>
								<!--Cruise Start-->
								<tr>
									<td>Cruise Fare</td>
									<td class="makeflex">
										<select class="form-control supplier" name="price[quote_cruise_fare]" id="cruise_fare">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden"  name="price[quote_cruise_fare_remarks]"  id="remarks_cruise_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_cruise_adult" name="price[query_cruise_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]"></td>
								</tr>
								<tr>
									<td>Port Charges </td>
									<td class="makeflex">
										<select class="form-control supplier" id="port_charge_fare" name="price[port_charge_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_adult" name="price[query_cruiseport_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_exadult exadult_disable" name="price[query_cruiseport_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_childbed childbed_disable" name="price[query_cruiseport_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_childwbed childwbed_disable" name="price[query_cruiseport_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_infant infant_disable" name="price[query_cruiseport_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_cruiseport_single single_disable" name="price[query_cruiseport_single]"></td>
								</tr>
								<tr>
									<td>Gratuity</td>
									<td class="makeflex">
										<select class="form-control supplier" id="gratuity_fare" name="price[gratuity_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[gratuity_remarks]" id="remarks_gratuity_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_adult" name="price[query_cruisegratuity_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_exadult exadult_disable" name="price[query_cruisegratuity_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_childbed childbed_disable" name="price[query_cruisegratuity_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_childwbed childwbed_disable" name="price[query_cruisegratuity_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_infant infant_disable" name="price[query_cruisegratuity_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegratuity_single single_disable" name="price[query_cruisegratuity_single]"></td>
								</tr>
								<tr>
									<td>Cruise GST </td>
									<td class="makeflex">
										<select class="form-control supplier" id="cruise_gst_fare" name="price[cruise_gst_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_adult" name="price[query_cruisegst_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_exadult exadult_disable" name="price[query_cruisegst_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_childbed childbed_disable" name="price[query_cruisegst_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_childwbed childwbed_disable" name="price[query_cruisegst_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_infant infant_disable" name="price[query_cruisegst_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_cruisegst_single single_disable" name="price[query_cruisegst_single]"></td>
								</tr>
								<!--Cruise End-->
								<tr>
									<td>Accommodation</td>
									<td class="makeflex">
										<select class="form-control supplier" id="accommodation_fare" name="price[accommodation_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_hotel_adult" name="price[query_hotel_adult]" id=""></td>
									<td><input type="text" class="form-control number_test quote1_hotel_exadult exadult_disable" name="price[query_hotel_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_hotel_childbed childbed_disable" name="price[query_hotel_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_hotel_childwbed childwbed_disable" name="price[query_hotel_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_hotel_infant infant_disable" name="price[query_hotel_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_hotel_single single_disable" name="price[query_hotel_single]"></td>
								</tr>
								<tr>
									<td>Sightseeing</td>
									<td class="makeflex">
										<select class="form-control supplier" id="sightseeing_fare" name="price[sightseeing_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_tours_adult" name="price[query_tours_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_tours_exadult exadult_disable" name="price[query_tours_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_tours_childbed childbed_disable" name="price[query_tours_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_tours_childwbed childwbed_disable" name="price[query_tours_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_tours_infant infant_disable" name="price[query_tours_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_tours_single single_disable" name="price[query_tours_single]"></td>
								</tr>
								<tr>
									<td>Transfers</td>
									<td class="makeflex">
										<select class="form-control supplier" id="transfers_fare" name="price[transfers_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[transfers_fare_remarks]" id="remarks_transfers_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_transfer_adult" name="price[query_transfer_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_transfer_exadult exadult_disable" name="price[query_transfer_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_transfer_childbed childbed_disable" name="price[query_transfer_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_transfer_childwbed childwbed_disable" name="price[query_transfer_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_transfer_infant infant_disable" name="price[query_transfer_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_transfer_single single_disable" name="price[query_transfer_single]"></td>
								</tr>
								<tr>
									<td>Visa Charges</td>
									<td class="makeflex">
										<select class="form-control supplier" id="visa_charges_fare" name="price[visa_charges_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_visa_adult" name="price[query_visa_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_visa_exadult exadult_disable" name="price[query_visa_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_visa_childbed childbed_disable" name="price[query_visa_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_visa_childwbed childwbed_disable" name="price[query_visa_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_visa_infant infant_disable" name="price[query_visa_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_visa_single single_disable" name="price[query_visa_single]"></td>
								</tr>
								<tr>
									<td> Travel Insurance</td>
									<td class="makeflex">
										<select class="form-control supplier" id="travel_insurance_fare" name="price[travel_insurance_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
										<input type="hidden" name="price[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_inc_adult" name="price[query_inc_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_inc_exadult exadult_disable" name="price[query_inc_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_inc_childbed childbed_disable" name="price[query_inc_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_inc_childwbed childwbed_disable" name="price[query_inc_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_inc_infant infant_disable" name="price[query_inc_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_inc_single single_disable" name="price[query_inc_single]"></td>
								</tr>
								<!--Meals  Start-->
								<tr>
									<td>Meals</td>
									<td class="makeflex">
										<select class="form-control supplier" id="meals_fare" name="price[meals_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
									<input type="hidden" name="price[meals_fare_remarks]" id="remarks_meals_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_meals_adult" name="price[query_meals_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_meals_exadult exadult_disable" name="price[query_meals_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_meals_childbed childbed_disable" name="price[query_meals_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_meals_childwbed childwbed_disable" name="price[query_meals_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_meals_infant infant_disable" name="price[query_meals_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_meals_single single_disable" name="price[query_meals_single]"></td>
								</tr>
								<!--Meals End-->
								<!--Additional Service-->
								<tr>
									<td>Addon Service</td>
									<td class="makeflex">
										<select class="form-control supplier" id="addon_service_fare" name="price[addon_service_fare_supplier]">
											<option value="0" select_name="0">Select</option>
											@foreach($supplier as $suppliers)
											<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
											@endforeach
										</select>
									<input type="hidden" name="price[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="">
									</td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_adult" name="price[query_additionalservice_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_exadult exadult_disable" name="price[query_additionalservice_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_childbed childbed_disable" name="price[query_additionalservice_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_childwbed childwbed_disable" name="price[query_additionalservice_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_infant infant_disable" name="price[query_additionalservice_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_additionalservice_single single_disable" name="price[query_additionalservice_single]"></td>
								</tr>
								<!--Additional Service End-->
								<!--Total before Markup-->
								<tr class="totalDisplay">
									<td>Total</td>
									<td>
									<!--<p class="currencyBox">INR</p>-->
									</td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_adult" name="price[query_tourtotal_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_exadult" name="price[query_tourtotal_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_childbed" name="price[query_tourtotal_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_childwbed" name="price[query_tourtotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_infant" name="price[query_tourtotal_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tourtotal_single" name="price[query_tourtotal_single]" readonly></td>
								</tr>
								<!--Markup  Start-->
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
											@foreach($markup_profit as $markup_pro)
											<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_markup_adult" name="price[query_markup_adult]"></td>
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
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
											<option value="3">Coupon</option>
										</select>
										<select class="percentageValue number_test discountpositive_percentage" name="price[discountpositive_percentage]">
											<option value="0">0</option>
											@foreach($discunt_positive as $markup_pro)
											<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_discount_adult_plus" name="price[query_discount_adult]"></td>
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
									<td><input type="text" class="form-control number_test quote1_gross_total_adult" name="price[query_total_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gross_total_exadult" name="price[query_total_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gross_total_childbed" name="price[query_total_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gross_total_childwbed" name="price[query_total_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gross_total_infant" name="price[query_total_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gross_total_single" name="price[query_total_single]" readonly></td>
								</tr>
								<!--Total Gross Total (Group)-->
								<tr class="grossGroupTotalDisplay">
									<td class="tourPriceItem">Gross Total (Group)</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_gross_total_group" name="price[query_total_group]" readonly></td>
								</tr>
								<!--Discount Minus-->
								<tr>
									<td>Discount (-)</td>
									<td class="makeflex">
										<select class="fixedValue pricediscountnegative" name="price[pricediscountnegative]">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
											<option value="3">Coupon</option>
										</select>
										<select class="percentageValue number_test discountnegative_percentage" name="price[discountnegative_percentage]">
											<option value="0">0</option>
											@foreach($discunt_negative as $markup_pro)
											<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_discount_adult_minus" name="price[query_discount_minus_adult]"></td>
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
									<td><input type="text" class="form-control number_test quote1_discount_group" name="price[query_total_discount_group]" readonly></td>
								</tr>
								<!--GST Starts-->
								<tr>
									<td class="fontItalic">(+) GST</td>
									<td class="makeflex">
										<select class="fixedValue pricegst" name="price[query_gst_curr]">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<select class="percentageValue number_test gst_percentage" name="price[gst_percentage]">
											@foreach($gst as $gst)
											<option value="0">--Select--</option>
											<option value="{{$gst->value}}">{{$gst->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_gst_adult" name="price[query_gst_adult]"></td>
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
									<td><input type="text" class="form-control number_test quote1_gst_group" name="price[query_total_gst_group]" readonly></td>
								</tr>
								<!--Total after GST-->
								<tr class="gstTotalDisplay">
									<td class="tourPriceItem">Total with GST</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_adult" name="price[query_gsttotal_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_exadult" name="price[query_gsttotal_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_childbed" name="price[query_gsttotal_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_childwbed" name="price[query_gsttotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_infant" name="price[query_gsttotal_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_gsttotal_single" name="price[query_gsttotal_single]" readonly></td>
								</tr>
								<!--TCS Starts-->
								<tr>
									<td class="fontItalic">(+) TCS</td>
									<td class="makeflex">
										<select class="fixedValue pricetcs" name="price[query_tcs_curr]">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<select class="percentageValue number_test tcs_percentage" name="price[tcs_percentage]">
											@foreach($tcs as $tcs)
											<option value="0">0</option>
											<option value="{{$tcs->value}}">{{$tcs->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_tcs_adult" name="price[query_tcs_adult]"></td>
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
									<td><input type="text" class="form-control number_test quote1_tcs_group" name="price[query_total_tcs_group]" readonly></td>
								</tr>
								<!--Total after TCS-->
								<tr class="tcsTotalDisplay">
									<td class="tourPriceItem">Total with TCS</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_adult" name="price[query_tcstotal_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_exadult" name="price[query_tcstotal_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_childbed" name="price[query_tcstotal_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_childwbed" name="price[query_tcstotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_infant" name="price[query_tcstotal_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_tcstotal_single" name="price[query_tcstotal_single]" readonly></td>
								</tr>
								<!--PG Charges Starts-->
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
											@foreach($pg as $pg)
											
											<option value="{{$pg->value}}">{{$pg->value}}</option>
											@endforeach
										</select>
									</td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_adult" name="price[query_pgcharges_adult]"></td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_exadult exadult_disable" name="price[query_pgcharges_exadult]"></td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_childbed childbed_disable" name="price[query_pgcharges_childbed]"></td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_childwbed childwbed_disable" name="price[query_pgcharges_childwbed]"></td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_infant infant_disable" name="price[query_pgcharges_infant]"></td>
									<td><input type="text" class="form-control number_test quote1_pgcharges_single single_disable" name="price[query_pgcharges_single]"></td>
								</tr>
								<!--PG Charges Ends-->
								<!--Total PG (Group)-->
								<tr class="pgGrouptTotalDisplay">
									<td class="tourPriceItem">PG (Group)</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_pg_group" name="price[query_total_pg_group]" readonly></td>
								</tr>
								<!--Grand Total-->
								<tr>
									<td class="tourPriceItem">GRAND TOTAL</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_grand_adult" name="price[query_grand_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_exadult" name="price[query_grand_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_childbed" name="price[query_grand_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_childwbed" name="price[query_grand_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_infant" name="price[query_grand_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_single" name="price[query_grand_single]" readonly></td>
								</tr>
								<!--Grand Total According to number of person-->
								<tr>
									<td class="tourPriceItem">PAY Total</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td><input type="text" class="form-control number_test quote1_grand_adult_with_person" name="price[query_paytotal_adult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_exadult_with_person" name="price[query_paytotal_exadult]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_childbed_with_person" name="price[query_paytotal_childbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_childwbed_with_person " name="price[query_paytotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_infant_with_person" name="price[query_paytotal_infant]" readonly></td>
									<td><input type="text" class="form-control number_test quote1_grand_single_with_person" name="price[query_paytotal_single]" readonly></td>
								</tr>
								<!--Price to Pay-->
								<tr>
									<td class="tourPriceItem">Price To PAY</td>
									<td>
										<p class="currencyBox">INR</p>
									</td>
									<td class="pricetoPay"><input type="text" class="form-control query_pricetopay quote1_pricetopay" id="option1_mandate" name="price[query_pricetopay_adult]" readonly></td>
								</tr>
								<!---->
								<tr>
									<td colspan="8">
										<div class="partPayment">
											<label for="partPayment">Part Payment?</label>
											<input type="checkbox" name="partPayment" value="1" id="show_part_payment">
										</div>
									</td>
								</tr>
								</tbody>
							</table>
							<table class="table backend_custom_height part_payment">
								<tbody>
									<!--Advance Payment-->
									<tr>
										<td class="tourPriceItem">Advance Payment</td>
										<td class="makeflex">
											<select class="fixedValue advance_payment"  name="part_payments[adv_type]">
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<input type="number" name="part_payments[adv_percentage]" class="percentageValue number_test advance_payment_percentage">
										</td>
										<td>
											<input type="text" name="part_payments[adv_amount]" class="form-control number_test quote1_advance_payment">
											<span id="quote1_advance_payment_error anyError"></span>
										</td>
										<td class="payment_days_parent">
									  
											<select name="part_payments[adv_days]" class="form-control payment_days">
												<option value="">--Select Days--</option>
												@for($i=1;$i<=$difference;$i++)
											 <option value="{{$i}}">{{$i}} Days</option>
												@endfor
											</select>
										
										
										</td>
										<td class="payment_date_parent">
											<input type="text" name="part_payments[adv_date]" class="form-control payment_date  datepicker_new">
											
										</td>
									</tr>
									<!--1st Part Payment-->
									<tr class="">
										<td class="tourPriceItem">1st Part Payment</td>
										<td class="makeflex">
											<select class="fixedValue first_part_payment" name="part_payments[first_part_type]">
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<input type="number" class="percentageValue number_test first_part_percentage" name="part_payments[first_part_percentage]">
										</td>
										<td>
											<input type="text" class="form-control number_test quote1_first_part" name="part_payments[first_part_amount]">
											<span id="quote1_first_part_error" class="anyError"></span>
										</td>
										<td class="payment_days_parent">
									  
											<select name="part_payments[first_part_days]" class="form-control payment_days">
												<option value="">--Select Days--</option>
												@for($i=1;$i<=$difference;$i++)
											 <option value="{{$i}}">{{$i}} Days</option>
												@endfor
											</select>
										
										
										</td>
										<td class="payment_date_parent">
											<input type="text" name="part_payments[first_part_date]" class="form-control payment_date  datepicker_new">
											
										</td>
									</tr>
									<!--2nd Part Payment-->
									<tr class="">
										<td class="tourPriceItem">2nd Part Payment</td>
										<td class="makeflex">
											<select class="fixedValue second_part_payment" name="part_payments[second_part_type]" style="display: none;">
												<option value="1">Fixed</option>
												<option value="2">Percentage</option>
											</select>
											<input type="number" class="percentageValue number_test second_part_percentage" name="part_payments[second_part_percentage]">
										</td>
										<td>
											<input type="text" class="percentageValue backgroundColorEEE fullWidth number_test quote1_second_part" name="part_payments[second_part_amount]">
										</td>
										<td class="payment_days_parent">
									  
											<select name="part_payments[second_part_days]" class="form-control payment_days">
												<option value="">--Select Days--</option>
												@for($i=1;$i<=$difference;$i++)
											 <option value="{{$i}}">{{$i}} Days</option>
												@endfor
											</select>
										
										
										</td>
										<td class="payment_date_parent">
											<input type="text" name="part_payments[second_part_date]" class="form-control payment_date  datepicker_new">
											
										</td>
									</tr>
									<!--Total Payment-->
									<tr class="">
										<td class="tourPriceItem">Total Payment</td>
										<td>
											<p class="currencyBox">INR</p>
										</td>
										<td>
											<input type="text" class="form-control query_pricetopay quote1_total_payment" name="part_payments[total_installment]" readonly oncontextmenu="return false;"></td>
									</tr>
								</tbody>
							</table>
							<!--Direct Payment-->
							<table class="table backend_custom_height">
								<tr>
									<td>
										<div class="directPayment">
											<label for="directPayment">Direct Pay at Property (per person, not included in price)?</label>
											<input type="checkbox" name="directPayment" value="1" id="show_direct_part">
										</div>
									</td>
								</tr>
							</table>
							<table class="table backend_custom_height direct_part">
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
										<td><input type="text" class="form-control" name="directPayments[pricetype]" value="Fixed" readonly></td>

										<td><input type="text" class="form-control number_test" name="directPayments[currency]" value="INR" readonly></td>
										<td><input type="text" class="form-control number_test" name="directPayments[amount]" value="0"></td>
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
										<td><input type="text" class="form-control" name="second_directPayments[pricetype]" value="Fixed" readonly></td>
										<td><input type="text" class="form-control number_test" name="second_directPayments[currency]" value="INR" readonly></td>
										<td><input type="text" class="form-control number_test" name="second_directPayments[amount]" value="0"></td>
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
										<td><input type="text" class="form-control" name="third_directPayments[pricetype]" value="Fixed" readonly></td>
										<td><input type="text" class="form-control number_test" name="third_directPayments[currency]" value="INR" readonly></td>
										<td><input type="text" class="form-control number_test" name="third_directPayments[amount]" value="0"></td>
									</tr>
									<!---->
								</tbody>
							</table>
					</div>
				</div>
				<!--Price_old-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Description"><span class="glyphicon glyphicon-th-list"></span> Pricing</a>
						</h4>
					</div>
					<div id="Description" class="panel-collapse collapse">
						<table class="table">
						<tr>
							<td>Price Type</td>
							<td>
								<select class="form-control price_type" name="price_type" style="">
								<option value="Per Person" selected>Per Person</option>
								<option value="Group Price">Group Price</option>
								</select>
							</td>
							<td class="anything">
								<select class="form-control" name="anything">
									<option value="pricetaxinclusive" selected>Price inclusive of all taxes</option>
								</select>
							</td>
							<td class="remarks">
							  <input type="text" name="remarks" class="form-control"
							  placeholder="Admin Remarks ..." >
							</td>
						</tr>
						</table>
						<table class="table backend_custom_height">
							<thead>
								<th></th>
								<th>Currency</th>
								<th>Adult (Twin Sharing)</th>
								<th>Extra Adult</th>
								<th>Child (with Bed)</th>
								<th>Child (without Bed)</th>
								<th>Infant</th>
								<th>Single Supplement</th>
							</thead>
							<tbody>
								<!--Airfare-->
								<tr>
									<td>Airfare</td>
									<td>
									<select class="form-control query_air_curr" name="price[query_air_curr]">
									 @foreach($rates as $rate)
										<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
									@endforeach
									</select>
									</td>
									<td>
										<input type="text" class="form-control query_air_adult" name="price[query_air_adult]">
									</td>
									<td>
										<input type="text" class="form-control query_air_exadult" name="price[query_air_exadult]">
									</td>
									<td>
										<input type="text" class="form-control query_air_childbed" name="price[query_air_childbed]">
									</td>
									<td>
										<input type="text" class="form-control query_air_childwbed" name="price[query_air_childwbed]">
									</td>
									<td>
										<input type="text" class="form-control query_air_infant" name="price[query_air_infant]">
									</td>
									<td>
										<input type="text" class="form-control query_air_single" name="price[query_air_single]">
									</td>
								</tr>
								<!--Cruise Start-->
								<tr>
									<td>Cruise </td>
									<td>
										<select class="form-control query_cruise_curr" name="price[query_cruise_curr]">
										 @foreach($rates as $rate)
											<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
										@endforeach
										</select>
									</td>
									<td>
										<input type="text" class="form-control query_cruise_adult" name="price[query_cruise_adult]">
									</td>
									<td>
										<input type="text" class="form-control query_cruise_exadult" name="price[query_cruise_exadult]">
									</td>
									<td>
										<input type="text" class="form-control query_cruise_childbed" name="price[query_cruise_childbed]">
									</td>
									<td>
										<input type="text" class="form-control query_cruise_childwbed" name="price[query_cruise_childwbed]">
									</td>
									<td>
										<input type="text" class="form-control query_cruise_infant" name="price[query_cruise_infant]">
									</td>
									<td>
										<input type="text" class="form-control query_cruise_single" name="price[query_cruise_single]">
									</td>
								</tr>
								<!--Cruise End-->
								<tr>
									<td>Hotel</td>
									<td>
										<select class="form-control query_hotel_curr" name="price[query_hotel_curr]">
										@foreach($rates as $rate)
											<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
										@endforeach
										</select>
									</td>
									<td>
										<input type="text" class="form-control query_hotel_adult" name="price[query_hotel_adult]" id="option1_mandate">
									</td>
									<td>
										<input type="text" class="form-control query_hotel_exadult" name="price[query_hotel_exadult]">
									</td>
									<td>
										<input type="text" class="form-control query_hotel_childbed" name="price[query_hotel_childbed]">
									</td>
									<td>
										<input type="text" class="form-control query_hotel_childwbed" name="price[query_hotel_childwbed]">
									</td>
									<td>
										<input type="text" class="form-control query_hotel_infant" name="price[query_hotel_infant]">
									</td>
									<td>
										<input type="text" class="form-control query_hotel_single" name="price[query_hotel_single]">
									</td>
								</tr>
								<tr>
								<td>Tours</td>
								<td>
								<select class="form-control query_tours_curr" name="price[query_tours_curr]">
								@foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_tours_adult" name="price[query_tours_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_tours_exadult" name="price[query_tours_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_tours_childbed" name="price[query_tours_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_tours_childwbed" name="price[query_tours_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_tours_infant" name="price[query_tours_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_tours_single" name="price[query_tours_single]">
								</td>
								</tr>
								<tr>
								<td>Transfers</td>
								<td>
								<select class="form-control query_transfer_curr" name="price[query_transfer_curr]">
								@foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_transfer_adult" name="price[query_transfer_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_transfer_exadult" name="price[query_transfer_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_transfer_childbed" name="price[query_transfer_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_transfer_childwbed" name="price[query_transfer_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_transfer_infant" name="price[query_transfer_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_transfer_single" name="price[query_transfer_single]">
								</td>
								</tr>
								<tr>
								<td>Visa</td>
								<td>
								<select class="form-control query_visa_curr" name="price[query_visa_curr]">
								@foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_visa_adult" name="price[query_visa_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_visa_exadult" name="price[query_visa_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_visa_childbed" name="price[query_visa_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_visa_childwbed" name="price[query_visa_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_visa_infant" name="price[query_visa_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_visa_single" name="price[query_visa_single]">
								</td>
								</tr>
								<tr>
								<td> Travel Insurance</td>
								<td>
								<select class="form-control query_inc_curr" name="price[query_inc_curr]">
								@foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_inc_adult" name="price[query_inc_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_inc_exadult" name="price[query_inc_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_inc_childbed" name="price[query_inc_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_inc_childwbed" name="price[query_inc_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_inc_infant" name="price[query_inc_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_inc_single" name="price[query_inc_single]">
								</td>
								</tr>
								<!--Meals  Start-->
								<tr>
								<td>Meals Price</td>
								<td>
								<select class="form-control query_meals_curr" name="price[query_meals_curr]">
								 @foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_meals_adult" name="price[query_meals_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_meals_exadult" name="price[query_meals_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_meals_childbed" name="price[query_meals_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_meals_childwbed" name="price[query_meals_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_meals_infant" name="price[query_meals_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_meals_single" name="price[query_meals_single]">
								</td>
								</tr>
								<!--Meals End-->
								<!--Markup  Start-->
								<tr>
								<td>Markup Price</td>
								<td>
								<select class="form-control query_markup_curr" name="price[query_markup_curr]">
								 @foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_markup_adult" name="price[query_markup_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_markup_exadult" name="price[query_markup_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_markup_childbed" name="price[query_markup_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_markup_childwbed" name="price[query_markup_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_markup_infant" name="price[query_markup_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_markup_single" name="price[query_markup_single]">
								</td>
								</tr>
								<tr>
								<td>GST / Tax</td>
								<td>
								<select class="form-control query_gst_curr" name="price[query_gst_curr]">
								@foreach($rates as $rate)
									<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
								@endforeach
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_gst_adult" name="price[query_gst_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_gst_exadult" name="price[query_gst_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_gst_childbed" name="price[query_gst_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_gst_childwbed" name="price[query_gst_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_gst_infant" name="price[query_gst_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_gst_single" name="price[query_gst_single]">
								</td>
								</tr>
								<tr>
								<td>Total</td>
								<td>
								<select class="form-control">
								<option>INR</option>
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_total_adult" readonly="" name="price[query_total_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_total_exadult" readonly="" name="price[query_total_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_total_childbed" readonly="" name="price[query_total_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_total_childwbed" readonly="" name="price[query_total_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_total_infant" readonly="" name="price[query_total_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_total_single" readonly="" name="price[query_total_single]">
								</td>
								</tr>
								<tr>
								<td>Discount</td>
								<td>
								<select class="form-control query_discount_curr">
									<option value="" >Rs</option>
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_discount_adult" name="price[query_discount_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_discount_exadult" name="price[query_discount_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_discount_childbed" name="price[query_discount_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_discount_childwbed" name="price[query_discount_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_discount_infant" name="price[query_discount_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_discount_single" name="price[query_discount_single]">
								</td>
								</tr>
								<tr>
								<td>Grand Total</td>
								<td>
								<select class="form-control">
								<option>INR</option>
								</select>
								</td>
								<td>
								<input type="text" class="form-control query_grand_adult" readonly="" name="price[query_grand_adult]">
								</td>
								<td>
								<input type="text" class="form-control query_grand_exadult" readonly="" name="price[query_grand_exadult]">
								</td>
								<td>
								<input type="text" class="form-control query_grand_childbed" readonly="" name="price[query_grand_childbed]">
								</td>
								<td>
								<input type="text" class="form-control query_grand_childwbed" readonly="" name="price[query_grand_childwbed]">
								</td>
								<td>
								<input type="text" class="form-control query_grand_infant" readonly="" name="price[query_grand_infant]">
								</td>
								<td>
								<input type="text" class="form-control query_grand_single" readonly="" name="price[query_grand_single]">
								</td>
								</tr>
						</tbody>
						</table>
					</div>
				</div>
				<!--Accommodation-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Accommodation"><span class="glyphicon glyphicon-th-list"></span> Accommodation</a>
						</h4>
					</div>
					<div id="Accommodation" class="panel-collapse collapse">
						<div class="panel-body">
							<?php $days=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT); ?>
							<div class="dynamic_acc">
								<input type="hidden" name="duration" value="{{$day_night}}" >
								<div class="field0" id="0">
									<div class="row">
										<div class="col-md-4">
											<label>Select Days</label>
											<select class="form-control select_day select2" multiple name="accommodation[0][day][]">
											@for($i=1;$i<=$days;$i++)
												<option value="Day {{$i}}">  Day {{$i}}</option>
											@endfor
											</select>
										</div>
										<div class="col-md-4">
											<label>city</label>
											<input type="text" name="accommodation[0][city]" class="form-control query_city" placeholder="City">
										</div>
										<div class="col-md-4">
											<label>Choose Hotel Manually or from TripAdvisor</label>
											<select class="form-control" name="accommodation[0][trip]">
												<option>--Select--</option>
												<option>Manually</option>
												<option>TripAdvisor</option>
											</select>
										</div>
										<div class="col-md-4">
											<label>Choose Hotel</label>
											<select class="form-control quo_hotel" name="accommodation[0][hotel]">
												<option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>
												<option value="other">Other</option>
											</select>
										</div>
										<div class="col-md-4 other_hotel" style="display: none;">
											<label>Enter Hotel</label>
											<input type="text" class="form-control" name="accommodation[0][other_hotel]" placeholder="Hotel Name">
										</div>
										<div class="col-md-4 add_star">
											<label>Choose Star Rating</label>
											<select class="form-control quo_star" name="accommodation[0][star]">
												<option>--Select--</option>
												<option value="other">Other</option>
											</select>
										</div>
										<div class="col-md-4 other_star" style="display: none;">
											<label>Enter Star Rating</label>
										  <input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Hotel Star Rating">
										</div>
										<div class="col-md-4">
											<label>Room Category</label>
											<input type="text" class="form-control" name="accommodation[0][category]" placeholder="Room Category">
										</div>
										<div class="col-md-4">
											<label>Hotel Website Link</label>
											<input type="text" class="form-control" name="accommodation[0][hotel_link]" placeholder="Hotel Website Link">
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<button type="button" name="add" id="add_acco" days="{{$days}}" class="btn btn-success">Add More</button>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
				<!--Transport-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Transport"><span class="glyphicon glyphicon-th-list"></span> Transport</a>
						</h4>
					</div>
					<div id="Transport" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Transport</label>
										<select name="transport"  class="form-control transport">
											<option value="0">Select Transport Mode</option>
										@foreach($transport as $trans)
											<option value="{{ $trans->name }}">{{$trans->name}}</option>
										@endforeach
										</select>
									</div>
									<div class="oflight">
										<textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{ old('transport_description') }}</textarea>
										<br>
									</div>
								</div>
								<div class="flight">
									<div class="col-md-12"><h4>Onward Flight</h4></div>
										<div class="col-md-3">
											<label>Flight Name</label>
											<input type="text" name="flight[name]" class="form-control flight_name">
										</div>
										<div class="col-md-3">
											<label>Flight No.</label>
											<input type="text" name="flight[no]" class="form-control flight_no">
										</div>
										<!--<div class="col-md-3">
										<label>No. Of Stop</label>
										<input type="text" name="flight[numberstop]" class="form-control">
										<br>
										</div>-->
										<div class="col-md-3 appendBottom20">
											<label>No. Of Stop</label>
											<select name="flight[numberstop]" class="form-control">
												<option value="0">Select Stops</option>
												<option value="Non-Stop">Non-Stop</option>
												@for($i=1;$i<=4;$i++)
												@if($i==1)
												<option value="{{ $i }} Stop">{{ $i }} Stop</option>
												@else
												<option value="{{ $i }} Stops">{{ $i }} Stops</option>
												@endif
												@endfor;
											</select>
										</div>
										<div class="col-md-3">
											<label>Onward Date</label>
											<input type="date" name="flight[onwarddate]" class="form-control">
											<br>
										</div>
										<div class="col-md-3">
											<label>Flight Origin</label>
											<input type="text" name="flight[Origin]" class="form-control flight_origin">
										</div>
										<div class="col-md-3">
											<label>Departure Time</label>
											<input type="time" name="flight[dtime]" class="form-control">
										</div>
										<div class="col-md-3">
											<label>Destination</label>
											<input type="text" name="flight[dest]" class="form-control flight_dest">
										</div>
										<div class="col-md-3">
											<label>Arrival Time</label>
											<input type="time" name="flight[atime]" class="form-control">
											<br>
										</div>
										<div class="col-md-3">
											<label>Cabin Class</label>
											<select name="flight[cabin]" class="form-control">
												<option value="economyclass">Economy</option>
												<option value="premiumeconomyclass">Premium Economy</option>
												<option value="businessclass">Business</option>
												<option value="firstclass">First</option>
											</select>
										</div>
										<div class="col-md-3 appendBottom20">
											<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
												<option selected disabled>Cabin Bag</option>
												<option value="0 Kg">0 Kg</option>
												<option value="5 Kgs">5 Kgs</option>
												<option value="7 Kgs">7 Kgs</option>
											</select>
											<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
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
												<option value="1 Piece">1 Piece</option>
												<option value="2 Pieces">2 Pieces</option>
											</select>
										</div>
										<!--Return Flight-->
										<div class="col-md-12" style="border-top:1px solid darkgray;margin-bottom: 14px;border-radius: 23px;"><h4>Return Flight</h4></div>
											<div class="col-md-3">
												<label>Flight Name</label>
												<input type="text" name="flight[dname]" class="form-control down_filght">
											</div>
											<div class="col-md-3">
												<label>Flight No.</label>
												<input type="text" name="flight[dno]" class="form-control down_no">
											</div>
											<!--<div class="col-md-3">
											<label>No. Of Stop</label>
											<input type="text" name="flight[dnumberstop]" class="form-control">
											<br>
											</div>-->
											<div class="col-md-3 appendBottom20">
												<label>No. Of Stop</label>
												<select name="flight[dnumberstop]" class="form-control">
													<option value="0">Select Stops</option>
													<option value="Non-Stop">Non-Stop</option>
													@for($i=1;$i<=4;$i++)
													@if($i==1)
													<option value="{{ $i }} Stop">{{ $i }} Stop</option>
													@else
													<option value="{{ $i }} Stops">{{ $i }} Stops</option>
													@endif
													@endfor;
												</select>
											</div>
											<div class="col-md-3">
												<label>Return Date</label>
												<input type="date" name="flight[downwarddate]" class="form-control">
												<br>
											</div>
											<div class="col-md-3">
												<label>Flight Origin</label>
												<input type="text" name="flight[dOrigin]" class="form-control down_origin">
											</div>
											<div class="col-md-3">
												<label>Departure Time</label>
												<input type="time" name="flight[ddtime]" class="form-control">
											</div>
											<div class="col-md-3">
												<label>Destination</label>
												<input type="text" name="flight[ddest]" class="form-control down_dest">
											</div>
											<div class="col-md-3">
												<label>Arrival Time</label>
												<input type="time" name="flight[datime]" class="form-control">
												<br>
											</div>
											<div class="col-md-3">
												<label>Cabin Class</label>
												<select name="flight[cabin]" class="form-control">
													<option value="economyclass">Economy</option>
													<option value="premiumeconomyclass">Premium Economy</option>
													<option value="businessclass">Business</option>
													<option value="firstclass">First</option>
												</select>
											</div>
											<div class="col-md-3">
												<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<!--<input type="text" name="flight[baggage]" class="form-control">-->
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option selected disabled>Cabin Bag</option>
													<option value="0 Kg">0 Kg</option>
													<option value="5 Kgs">5 Kgs</option>
													<option value="7 Kgs">7 Kgs</option>
												</select>
												<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
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
													<option value="1 Piece">1 Piece</option>
													<option value="2 Pieces">2 Pieces</option>
												</select>
											</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Package Description-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#pac_Description"><span class="glyphicon glyphicon-th-list"></span> Package Description</a>
						</h4>
					</div>
					<div id="pac_Description" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Package Description</label>
										<br>
										<span class="show_hide">More+</span>
										<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="5" >{{ old('description') }}</textarea>
									</div>
									<div class="form-group">
										<label for="">Tour Highlights</label>
										<br>
										<span class="show_hide">More+</span>
										<textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5" >{{ old('highlights') }}</textarea>
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Inclusions & Exclusions-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Inclusions"><span class="glyphicon glyphicon-th-list"></span> Inclusions & Exclusions</a>
						</h4>
					</div>
					<div id="Inclusions" class="panel-collapse collapse">
						<div class="panel-body c_body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group select-container">
										<label >What your tour price includes?</label>
										<br>
										<span class="show_hide">More+</span>
										<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">{{ old('inclusions') }}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class=" form-group ">
										<label >What your tour price does not include?</label>
										<br>
										<span class="show_hide">More+</span>
										<textarea class="form-control ckeditor"  name="exclusions" id="" cols="30" rows="5">{{ old('exclusions') }}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Itinerary-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Itinerary"><span class="glyphicon glyphicon-th-list"></span> Tour Itinerary</a>
						</h4>
					</div>
					<div id="Itinerary" class="panel-collapse collapse">
						<div class="panel-body c_body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
									<?php $days=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT); ?>
									@for($j=1;$j<=$days;$j++)
										<div class="col-md-12 dayItinerary day1" >
											<div class="form-group">Day {{$j}} :
												<input type="text" name="dayItinerary[day{{$j}}][title]" style="height: 35px;width: 95%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;" placeholder="Day Title">
											</div>
											<div class="form-group">
												<label for="">Description</label>
												<br>
												<span class="show_hide">More+</span>
												<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]"></textarea>
											</div>
										</div>
									@endfor
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Policies-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Policies"><span class="glyphicon glyphicon-th-list"></span> Policies</a>
						</h4>
					</div>
					<div id="Policies" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Terms & Conditions   </h4>
									<div class="form-group">
										<label for="">Is Visa Required?</label>
										<input type="checkbox" name="visa" value="1" id="visa" class="visa" />
									</div>
									<!--Visa Policy-->
									<div class="visa_pol">
										<h5>Visa Terms & Policies</h5>
										<table class="table table-bordered" id="">
										<tbody>
										<tr>
											<td style="width: 60%;">
												<div>
													<select name="package_visa[]"  class="select2 form-control" multiple>
													@foreach($visaPolicy as $pol)
														<option value="{{$pol->id}}">{{$pol->policy}} </option>
													@endforeach
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
											<span class="show_hides">More+</span>
											<br>
											<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text"></textarea>
											</td>
										</tr>
										</tbody>
										</table>
									</div>
									<!--Booking Policy-->
									<h5>Booking Policy</h5>
									<table class="table table-bordered" >
									<tbody>
										<tr>
											<td style="width: 60%;">
												<div>
													<select name="package_payment[]"  class="select2 form-control" multiple>
													@foreach($paymentPolicy as $pol)
														<option value="{{$pol->id}}">{{$pol->policy}} </option>
													@endforeach
													<select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<span class="show_hides">More+</span>
												<br>
												<textarea  name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text"></textarea>
											</td>
										</tr>
									</tbody>
									</table>
									<!--Cancellation Policy-->
									<h5>Cancellation & Refund Policy</h5>
									<table class="table table-bordered" id="dynamic_field">
									<tbody>
										<tr>
											<td style="width: 60%;">
												<div>
													<select name="package_can[]"  class="select2 form-control" multiple>
													@foreach($cancelPolicy as $pol)
														<option value="{{$pol->id}}">{{$pol->policy}} </option>
													@endforeach
													<select>
												</div>
											</td>
										</tr>
									<tr>
										<td>
											<span class="show_hides">More+</span>
											<br>
											<textarea  name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control hide_text"></textarea>
										</td>
									</tr>
									</tbody>
									</table>
									<!--Important Notes-->
									<h5>Important Notes</h5>
									<table class="table table-bordered" >
									<tbody>
										<tr>
											<td style="width: 60%;">
												<div>
													<select name="package_impnotes[]"  class="select2 form-control" multiple>
													@foreach($imp_notes as $pol)
														<option value="{{$pol->id}}">{{$pol->policy}} </option>
													@endforeach
													<select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<span class="show_hides">More+</span>
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
				<!--Quote Validity-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Validity"><span class="glyphicon glyphicon-th-list"></span> Quote Validity</a>
						</h4>
					</div>
					<div id="Validity" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Quote Validity</label>
										<input type="text" class="datepickers" name="validaty">
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Greetings-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#Welcome"><span class="glyphicon glyphicon-th-list"></span> Welcome Greetings </a>
						</h4>
					</div>
					<div id="Welcome" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
								<h5>Quotation Header</h5>
								<table class="table table-bordered" >
								<tbody>
									<tr>
										<td style="width: 60%;">
											<div>
												<select name="quotation_header[]"  class="select2 form-control" multiple>
												@foreach($quotation_header as $pol)
													<option value="{{$pol->id}}">{{$pol->header}} </option>
												@endforeach
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<span class="show_hide">More+</span>
											<br>
											<textarea  name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor"></textarea>
										</td>
									</tr>
								</tbody>
								</table>
								<h5>Quotation Footer</h5>
								<table class="table table-bordered" >
								<tbody>
									<tr>
										<td style="width: 60%;">
											<div>
												<select name="quotation_footer[]"  class="select2 form-control" multiple>
												@foreach($quotation_footer as $pol)
													<option value="{{$pol->id}}">{{$pol->footer}} </option>
												@endforeach
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<span class="show_hide">More+</span>
											<br>
											<textarea  name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor"></textarea>
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
			<div class="" style="text-align: center;">
				<label class="radio-inline"><input type="radio" value="1" name="send_option" checked>Save & Preview</label>
				<label class="radio-inline"><input type="radio" value="0" name="send_option" >Save & Send</label>
			</div>
			<br>
			<div style="text-align: center;">
				<button type="submit" name="add" id="remove" class="btn btn-danger btn-lg location_add">Save<i class="fa  fa-arrow-right"></i></button>
			</div>
			</form>
		</div>
</div>