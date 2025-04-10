<div class="row">
<!-- add rooms -->
<div class="col-md-12">
<div class="add-room-wrapper">
<div class="col-md-12">
	<div class="form-group">
		<div class="title">Add Rooms</div>
	</div>
</div>
<!-- <div class="roomGuests"> -->
<div class="col-md-2">
	<div class="form-group">
		<label class="field-required">Display Price (frontend)</label>
		<select class="form-control" name="show_status"> 
			<option value="1">Show</option>
			<option value="0">Hide</option>
		</select>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="field-required">No of Rooms</label>
		<select class="form-control select_room" name="no_of_room">
			@for($i=1; $i<=10; $i++)
			<option value="{{ $i }}">{{ $i }}</option>
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


<!-- ************************************************************ -->

<!-- add guest in room -->
<div class="dynamic_four" id="dynamic_four">
	<div id="fourrow1">
		<!-- <div class="add-guest-wrapper"> -->
		<div class="col-md-12">
			<div class="room-container">
			<!-- room no -->
			<!-- <label for="room" class="pfwmt appendBottom5 font-size14" style="color: #000001 !important">Room 1 </label> --> 
			<div class="">
				<div class="title">Room 1</div>
			</div>
			<!-- guest allowed in a room -->
			<div class="makeflex align-center">
				<label class="field-required">Max. guests allowed</label>
				<select class="form-control apndLft5 max_passenger" name="room[0][max_passenger]" style="max-width: 90px;border-radius: 3px;">
					@for($i=1;$i<=10;$i++)
					<option value="{{ $i }}" @if($i==7) selected @endif>{{ $i }}</option>
					@endfor
				</select>
			</div>
			<div class="guest-in-room guest-room-wrapper mobscroll scrollX">
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][twin_adult_room]" class="twin_adult_room_value" value="2">
						<span class="travellersMinus twin_adult_room_dec">−</span>
						<span class="travellersValue twin_adult_room_result">2</span>
						<span class="travellersPlus twin_adult_room_inc">+</span>
					</div>
					<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
				</div>
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][extra_adult_room]" class="extra_adult_room_value" value="0">
						<span class="travellersMinus extra_adult_room_dec">−</span>
						<span class="travellersValue extra_adult_room_result">0</span>
						<span class="travellersPlus extra_adult_room_inc">+</span>
					</div>
					<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
				</div>
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][child_with_bed_room]" class="child_with_bed_room_value" value="0">
						<span class="travellersMinus child_with_bed_room_dec">−</span>
						<span class="travellersValue child_with_bed_room_result">0</span>
						<span class="travellersPlus child_with_bed_room_inc">+</span>
					</div>
					<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
				</div>
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][child_without_bed_room]" class="child_without_bed_room_value" value="0">
						<span class="travellersMinus child_without_bed_room_dec">−</span>
						<span class="travellersValue child_without_bed_room_result">0</span>
						<span class="travellersPlus child_without_bed_room_inc">+</span>
					</div>
					<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
				</div>
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][infant_room]" class="span_value_child_with_bed infant_room_value" value="0">
						<span class="travellersMinus infant_room_dec">−</span>
						<span class="travellersValue infant_room_result">0</span>
						<span class="travellersPlus infant_room_inc">+</span>
					</div>
					<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
				</div>
				<div>
					<div class="addTravellerValue">
						<input type="hidden" id="travellers" name="room[0][single_room]" class="single_room_value" value="0">
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
</div>
</div>
</div>

<!-- ******************** -->

<!-- pricing -->
<!-- add price -->
<div class="col-md-12">
<div class="add-room-wrapper mobscroll scrollX">
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
			<option value="Per Person">Per Person</option>
			<option value="Group Price">Group Price</option>
		</select>
	</div>
</div>

<!-- select price tag -->
<div class="col-md-3">
	<div class="form-group">
		<label class="field-required">Price Type Tag</label>
		<select class="form-control" name="priceremarks">
			<!-- <option>Select</option> -->
			<option value="Price Per Person" selected>Price Per Person (inclusive of taxes)</option>
			<option value="Price Group">Price for all Person (inclusive of taxes)</option>
		</select>
	</div>
</div>

<!-- remarks -->
<div class="col-md-3">
	<div class="form-group">
		<label>Remarks</label>
		<input type="text" name="remarks" class="form-control" placeholder="Enter price remarks (if any) ...">
	</div>
</div>

<!-- total guest count -->
<div class="col-md-3">
	<div class="form-group">
		<label>Total Rooms & Guests</label>
		<input type="text" value="1 Room (2 Adults)" class="form-control packages_pop_passenger_value" readonly>
	</div>
</div>

<!-- pricing table -->
<table class="table backend_custom_height">
	<thead>
		<tr>
			<th>
				<p class="quoteCurrency">&#8377; INR</p>
				<p class="itemBottomHeading">Quote Currency</p>
			</th>
			<th>
				<p class="itemTopHeading">CALCULATOR</p>
				<div class="currencyConversion">
					<!-- <select class="package_air_curr" name="currency">
						<option>USD</option>
						<option>EURO</option>
					</select> -->
					<select class="form-control query_air_curr" name="currency">
						@foreach($rates as $rate)
						<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency }}</option>
						@endforeach
					</select>
					<!-- <input type="text" name="roe" class="packages_rate number_test" placeholder="ROE"> -->
					<input type="text" name="roe" class="form-control quote1_rate number_test" placeholder="ROE">
				</div>
				<!-- <div class="currencyConversion">
					<input type="text" name="indian_rate" class="packages_value number_test" placeholder="Enter">
					<input type="text" name="total_value" class="backgroundColorF2 packages_total number_test" placeholder="Value" readonly="">
				</div> -->
				<div class="currencyConversion">
					<input type="text" name="indian_rate" class="form-control quote1_value number_test" placeholder="Enter">
					<input type="text" name="total_value" class="form-control backgroundColorF2 quote1_total number_test" placeholder="Value" readonly />
				</div>
				<p class="itemBottomHeading">Conversion</p>
			</th>
			<th>
				<p class="itemBottomHeading">Currency</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">ADULT</p>
				<p class="itemTopSubHeading">(TWIN SHARING)</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="packages_number_of_adult" class="packages_number_of_adult packages_adult_room_value" value="2">
					<!-- <span class="travellersMinus packages_adult_room_dec">&#8722;</span> -->
					<span class="travellersValue packages_adult_room_result">2</span>
					<!-- <span class="travellersPlus packages_adult_room_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Adult<br>(+12yrs)</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">EXTRA ADULT</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="extra_adult" class="packages_number_of_extra_adult packages_child_extra_adult_value" value="0">
					<!-- <span class="travellersMinus packages_child_extra_adult_dec">&#8722;</span> -->
					<span class="travellersValue packages_child_extra_adult_result">0</span>
					<!-- <span class="travellersPlus packages_child_extra_adult_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Extra Adult<br>(+12yrs)</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">CHILD</p>
				<p class="itemTopSubHeading">(WITH BED)</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="child_with_bed" class="packages_number_of_child_with_bed packages_child_with_bed_value" value="0">
					<!-- <span class="travellersMinus packages_child_with_bed_dec">&#8722;</span> -->
					<span class="travellersValue packages_child_with_bed_result">0</span>
					<!-- <span class="travellersPlus packages_child_with_bed_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Child (with bed)<br>(2-12yrs)</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">CHILD</p>
				<p class="itemTopSubHeading">(WITHOUT BED)</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="child_without_bed" class="packages_number_of_child_without_bed packages_childwithoutbed_value" value="0">
					<!-- <span class="travellersMinus packages_childwithoutbed_dec">&#8722;</span> -->
					<span class="travellersValue packages_span_value_childwithoutbed_result">0</span>
					<!-- <span class="travellersPlus packages_childwithoutbed_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Child (without bed)<br>(2-12yrs)</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">INFANT</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="infant" class="packages_number_of_infant packages_infant_value" value="0">
					<!-- <span class="travellersMinus packages_infant_dec">&#8722;</span> -->
					<span class="travellersValue packages_infant_result">0</span>
					<!-- <span class="travellersPlus packages_infant_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Infant<br>(0-2yrs)</p>
			</th>
			<th>
				<!-- <p class="itemTopHeading">SINGLE<br>TRAVELLER</p> -->
				<div class="addTravellerValue">
					<input type="hidden" id="travellers" name="solo_traveller" class="packages_number_solo_traveller packages_solo_value" value="0">
					<!-- <span class="travellersMinus packages_solo_dec">&#8722;</span> -->
					<span class="travellersValue packages_solo_result">0</span>
					<!-- <span class="travellersPlus packages_solo_inc">&#43;</span> -->
				</div>
				<p class="itemBottomHeading">Single<br>(+12yrs)</p>
			</th>
		</tr>
	</thead>
	<tbody>
		<!-- airfare -->
		<tr>
			<td>Airfare</td>
			<td class="makeflex">
				<select class="form-control supplier" name="newprice[package_airfare]" id="airfare">
					<option value="0" select_name="0" >Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[package_airfare_remarks]" id="remarks_airfare" value="">
			</td>
			<td>
				<select class="form-control aircurrency" name="newprice[aircurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                     @endforeach
                 </select>
			</td>
			<td><input type="text" class="form-control number_test packages_air_adult adult_disable" name="newprice[package_air_adult]"></td>
			<td><input type="text" class="form-control number_test packages_air_exadult exadult_disable" name="newprice[package_air_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_air_childbed childbed_disable" name="newprice[package_air_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_air_childwbed childwbed_disable" name="newprice[package_air_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_air_infant infant_disable" name="newprice[package_air_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_air_single single_disable" name="newprice[package_air_single]" readonly="readonly"></td>
		</tr>

		<!-- cruise fare-->
		<tr>
			<td>Cruise Fare</td>
			<td class="makeflex">
				<select class="form-control supplier" name="newprice[package_cruise_fare]" id="cruise_fare">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden"  name="newprice[package_cruise_fare_remarks]"  id="remarks_cruise_fare" value="">
			</td>
			<td>
				<select class="form-control cruisecurrency" name="newprice[cruisecurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
			</td>
			<td><input type="text" class="form-control number_test packages_cruise_adult adult_disable" name="newprice[package_cruise_adult]"></td>
			<td><input type="text" class="form-control number_test packages_cruise_exadult exadult_disable" name="newprice[package_cruise_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruise_childbed childbed_disable" name="newprice[package_cruise_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruise_childwbed childwbed_disable" name="newprice[package_cruise_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruise_infant infant_disable" name="newprice[package_cruise_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruise_single single_disable" name="newprice[package_cruise_single]" readonly="readonly"></td>
		</tr>

		<!-- cruise port charges -->
		<tr>
			<td>Port Charges </td>
			<td class="makeflex">
				<select class="form-control supplier" id="port_charge_fare" name="newprice[port_charge_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="">
			</td>
			<td>
				<select class="form-control portchargecurrency" name="newprice[portchargecurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_cruiseport_adult adult_disable" name="newprice[package_cruiseport_adult]"></td>
			<td><input type="text" class="form-control number_test packages_cruiseport_exadult exadult_disable" name="newprice[package_cruiseport_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruiseport_childbed childbed_disable" name="newprice[package_cruiseport_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruiseport_childwbed childwbed_disable" name="newprice[package_cruiseport_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruiseport_infant infant_disable" name="newprice[package_cruiseport_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruiseport_single single_disable" name="newprice[package_cruiseport_single]" readonly="readonly"></td>
		</tr>

		<!-- cruise gratuity -->
		<tr>
			<td>Cruise Gratuity</td>
				<td class="makeflex">
				<select class="form-control supplier" id="gratuity_fare" name="newprice[gratuity_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[gratuity_remarks]" id="remarks_gratuity_fare" value="">
			</td>
				<td>
				<select class="form-control gratuitycurrency" name="newprice[gratuitycurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_adult adult_disable" name="newprice[package_cruisegratuity_adult]"></td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_exadult exadult_disable" name="newprice[package_cruisegratuity_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_childbed childbed_disable" name="newprice[package_cruisegratuity_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_childwbed childwbed_disable" name="newprice[package_cruisegratuity_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_infant infant_disable" name="newprice[package_cruisegratuity_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegratuity_single single_disable" name="newprice[package_cruisegratuity_single]" readonly="readonly"></td>
		</tr>

		<!-- cruise tax -->
		<tr>
			<td>Cruise Tax </td>
				<td class="makeflex">
				<select class="form-control supplier" id="cruise_gst_fare" name="newprice[cruise_gst_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="">
			</td>
				<td>
				<select class="form-control cruise_gstcurrency" name="newprice[cruise_gstcurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                     @endforeach
                 </select>
             </td>
			<td><input type="text" class="form-control number_test packages_cruisegst_adult adult_disable" name="newprice[package_cruisegst_adult]"></td>
			<td><input type="text" class="form-control number_test packages_cruisegst_exadult exadult_disable" name="newprice[package_cruisegst_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegst_childbed childbed_disable" name="newprice[package_cruisegst_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegst_childwbed childwbed_disable" name="newprice[package_cruisegst_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegst_infant infant_disable" name="newprice[package_cruisegst_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_cruisegst_single single_disable" name="newprice[package_cruisegst_single]" readonly="readonly"></td>
		</tr>

		<!-- accommodation-->
		<tr>
			<td>Accommodation</td>
				<td class="makeflex">
				<select class="form-control supplier" id="accommodation_fare" name="newprice[accommodation_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="">
			</td>
				<td>
				<select class="form-control accommodationcurrency" name="newprice[accommodationcurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                 </select>
                    
			</td>
			<td><input type="text" class="form-control number_test packages_hotel_adult adult_disable" name="newprice[package_hotel_adult]" id=""></td>
			<td><input type="text" class="form-control number_test packages_hotel_exadult exadult_disable" name="newprice[package_hotel_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_hotel_childbed childbed_disable" name="newprice[package_hotel_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_hotel_childwbed childwbed_disable" name="newprice[package_hotel_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_hotel_infant infant_disable" name="newprice[package_hotel_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_hotel_single single_disable" name="newprice[package_hotel_single]" readonly="readonly"></td>
		</tr>

		<!-- sightseeing -->
		<tr>
			<td>Sightseeing</td>
			<td class="makeflex">
				<select class="form-control supplier" id="sightseeing_fare" name="newprice[sightseeing_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="">
			</td>
				<td>
				<select class="form-control sightseeingcurrency" name="newprice[sightseeingcurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_tours_adult adult_disable" name="newprice[package_tours_adult]"></td>
			<td><input type="text" class="form-control number_test packages_tours_exadult exadult_disable" name="newprice[package_tours_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tours_childbed childbed_disable" name="newprice[package_tours_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tours_childwbed childwbed_disable" name="newprice[package_tours_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tours_infant infant_disable" name="newprice[package_tours_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tours_single single_disable" name="newprice[package_tours_single]" readonly="readonly"></td>
		</tr>

		<!-- transfers -->
		<tr>
			<td>Transfers</td>
			<td class="makeflex">
				<select class="form-control supplier" id="transfers_fare" name="newprice[transfers_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[transfers_fare_remarks]" id="remarks_transfers_fare" value="">
			</td>
				<td>
				<select class="form-control transferscurrency" name="newprice[transferscurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_transfer_adult adult_disable" name="newprice[package_transfer_adult]"></td>
			<td><input type="text" class="form-control number_test packages_transfer_exadult exadult_disable" name="newprice[package_transfer_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_transfer_childbed childbed_disable" name="newprice[package_transfer_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_transfer_childwbed childwbed_disable" name="newprice[package_transfer_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_transfer_infant infant_disable" name="newprice[package_transfer_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_transfer_single single_disable" name="newprice[package_transfer_single]" readonly="readonly"></td>
		</tr>

		<!-- visa charges -->
		<tr>
			<td>Visa Charges</td>
			<td class="makeflex">
				<select class="form-control supplier" id="visa_charges_fare" name="newprice[visa_charges_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="">
			</td>
				<td>
				<select class="form-control visacurrency" name="newprice[visacurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_visa_adult adult_disable" name="newprice[package_visa_adult]"></td>
			<td><input type="text" class="form-control number_test packages_visa_exadult exadult_disable" name="newprice[package_visa_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_visa_childbed childbed_disable" name="newprice[package_visa_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_visa_childwbed childwbed_disable" name="newprice[package_visa_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_visa_infant infant_disable" name="newprice[package_visa_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_visa_single single_disable" name="newprice[package_visa_single]" readonly="readonly"></td>
		</tr>

		<!-- travel insurance -->
		<tr>
			<td> Travel Insurance</td>
				<td class="makeflex">
				<select class="form-control supplier" id="travel_insurance_fare" name="newprice[travel_insurance_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="">
			</td>
				<td>
				<select class="form-control travelcurrency" name="newprice[travelcurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_inc_adult adult_disable" name="newprice[package_inc_adult]"></td>
			<td><input type="text" class="form-control number_test packages_inc_exadult exadult_disable" name="newprice[package_inc_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_inc_childbed childbed_disable" name="newprice[package_inc_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_inc_childwbed childwbed_disable" name="newprice[package_inc_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_inc_infant infant_disable" name="newprice[package_inc_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_inc_single single_disable" name="newprice[package_inc_single]" readonly="readonly"></td>
		</tr>

		<!-- meals -->
		<tr>
			<td>Meals</td>
			<td class="makeflex">
				<select class="form-control supplier" id="meals_fare" name="newprice[meals_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
			<input type="hidden" name="newprice[meals_fare_remarks]" id="remarks_meals_fare" value="">
			</td>
				<td>
				<select class="form-control mealscurrency" name="newprice[mealscurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_meals_adult adult_disable" name="newprice[package_meals_adult]"></td>
			<td><input type="text" class="form-control number_test packages_meals_exadult exadult_disable" name="newprice[package_meals_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_meals_childbed childbed_disable" name="newprice[package_meals_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_meals_childwbed childwbed_disable" name="newprice[package_meals_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_meals_infant infant_disable" name="newprice[package_meals_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_meals_single single_disable" name="newprice[package_meals_single]" readonly="readonly"></td>
		</tr>

		<!-- addon services -->
		<tr>
			<td>Addon Service</td>
			<td class="makeflex">
				<select class="form-control supplier" id="addon_service_fare" name="newprice[addon_service_fare_supplier]">
					<option value="0" select_name="0">Select</option>
					@foreach($supplier as $suppliers)
					<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
					@endforeach
				</select>
				<input type="hidden" name="newprice[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="">
			</td>
			<td>
				<select class="form-control addon_servicecurrency" name="newprice[addon_servicecurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
                    
			</td>
			<td><input type="text" class="form-control number_test packages_additionalservice_adult adult_disable" name="newprice[package_additionalservice_adult]"></td>
			<td><input type="text" class="form-control number_test packages_additionalservice_exadult exadult_disable" name="newprice[package_additionalservice_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_additionalservice_childbed childbed_disable" name="newprice[package_additionalservice_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_additionalservice_childwbed childwbed_disable" name="newprice[package_additionalservice_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_additionalservice_infant infant_disable" name="newprice[package_additionalservice_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_additionalservice_single single_disable" name="newprice[package_additionalservice_single]" readonly="readonly"></td>
		</tr>

		<!--Total before Markup-->
		<tr class="totalDisplay">
			<td>Total</td>
			<td>
			<!--<p class="currencyBox">INR</p>-->
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_adult" name="newprice[package_tourtotal_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_exadult" name="newprice[package_tourtotal_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_childbed" name="newprice[package_tourtotal_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_childwbed" name="newprice[package_tourtotal_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_infant" name="newprice[package_tourtotal_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tourtotal_single" name="newprice[package_tourtotal_single]" readonly=""></td>
		</tr>

		<!--Markup  Start-->
		<tr>
			<td class="fontItalic">Markup (Profit)</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricemarkup" name="newprice[pricemarkup]">
					<option value="0" disabled="">Select</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
				</select>

				<select class="percentageValue number_test markup_percentage" name="newprice[markup_percentage]">
					<option value="0">Select</option>
					@foreach($markup_profit as $markup_pro)
					<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select class="form-control markupcurrency" name="newprice[markupcurrency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                     @endforeach
                 </select>
             </td>
			<td><input type="text" class="form-control number_test packages_markup_adult adult_disable" name="newprice[package_markup_adult]"></td>
			<td><input type="text" class="form-control number_test packages_markup_exadult exadult_disable" name="newprice[package_markup_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_markup_childbed childbed_disable" name="newprice[package_markup_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_markup_childwbed childwbed_disable" name="newprice[package_markup_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_markup_infant infant_disable" name="newprice[package_markup_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_markup_single single_disable" name="newprice[package_markup_single]" readonly="readonly"></td>
		</tr>

		<!--Discount Plus-->
		<tr>
			<td>Discount (+)</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricediscountpositive" name="newprice[pricediscountpositive]">
					<option value="0">No Discount</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
					<!-- <option value="3">Coupon</option> -->
				</select>

				<select class="percentageValue number_test discountpositive_percentage" name="newprice[discountpositive_percentage]">
					<option value="0">Select</option>
					@foreach($discunt_positive as $markup_pro)
					<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select class="form-control discount_positive_currency" name="newprice[discount_positive_currency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_discount_adult_plus adult_disable" name="newprice[package_discount_adult]"></td>
			<td><input type="text" class="form-control number_test packages_discount_exadult_plus exadult_disable" name="newprice[package_discount_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_childbed_plus childbed_disable" name="newprice[package_discount_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_childwbed_plus childwbed_disable" name="newprice[package_discount_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_infant_plus infant_disable" name="newprice[package_discount_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_single_plus single_disable" name="newprice[package_discount_single]" readonly="readonly"></td>
		</tr>

		<!--Total before GST-->
		<tr class="grossTotalDisplay">
			<td class="tourPriceItem">Gross Total</td>
			<td>
			<!--<p class="currencyBox">INR</p>-->
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_gross_total_adult" name="newprice[package_total_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gross_total_exadult" name="newprice[package_total_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gross_total_childbed" name="newprice[package_total_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gross_total_childwbed" name="newprice[package_total_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gross_total_infant" name="newprice[package_total_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gross_total_single" name="newprice[package_total_single]" readonly=""></td>
		</tr>

		<!--Total Gross Total (Group)-->
		<tr class="grossGroupTotalDisplay">
			<td class="tourPriceItem">Gross Total (Group)</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_gross_total_group" name="newprice[package_total_group]" readonly=""></td>
		</tr>

		<!--Discount Minus-->
		<tr>
			<td>Discount (-)</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricediscountnegative" name="newprice[pricediscountnegative]">
					<option value="0">No Discount</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
					<!-- <option value="3">Coupon</option> -->
				</select>

				<select class="percentageValue number_test discountnegative_percentage" name="newprice[discountnegative_percentage]" style="display: none;">
					<option value="0">Select</option>
					@foreach($discunt_negative as $markup_pro)
					<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
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
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_discount_adult_minus adult_disable" name="newprice[package_discount_minus_adult]"></td>
			<td><input type="text" class="form-control number_test packages_discount_exadult_minus exadult_disable" name="newprice[package_discount_minus_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_childbed_minus childbed_disable" name="newprice[package_discount_minus_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_childwbed_minus childwbed_disable" name="newprice[package_discount_minus_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_infant_minus infant_disable" name="newprice[package_discount_minus_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_discount_single_minus single_disable" name="newprice[package_discount_minus_single]" readonly="readonly"></td>
		</tr>

		<!--Total Gross Total (Group)-->
		<tr class="discountGroupTotalDisplay">
			<td class="tourPriceItem">Discount (-) (Group)</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_discount_group" name="newprice[package_total_discount_group]" readonly=""></td>
		</tr>

		<!--GST Starts-->
		<tr>
			<td class="fontItalic">(+) GST</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricegst" name="newprice[package_gst_curr]">
					<option value="0">Select</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
				</select>

				<select class="percentageValue number_test gst_percentage" name="newprice[gst_percentage]">
					@foreach($gst as $gst)
					<option value="0">Select</option>
					<option value="{{$gst->value}}">{{$gst->value}}</option>
					@endforeach
				</select>
			</td>
				<td>
				<select class="form-control gst_currency" name="newprice[gst_currency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_gst_adult adult_disable" name="newprice[package_gst_adult]"></td>
			<td><input type="text" class="form-control number_test packages_gst_exadult exadult_disable" name="newprice[package_gst_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_gst_childbed childbed_disable" name="newprice[package_gst_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_gst_childwbed childwbed_disable" name="newprice[package_gst_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_gst_infant infant_disable" name="newprice[package_gst_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_gst_single single_disable" name="newprice[package_gst_single]" readonly="readonly"></td>
		</tr>

		<!--Total GST (Group)-->
		<tr class="gstGroupTotalDisplay">
			<td class="tourPriceItem">GST (Group)</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_gst_group" name="newprice[package_total_gst_group]" readonly=""></td>
		</tr>

		<!--Total after GST-->
		<tr class="gstTotalDisplay">
			<td class="tourPriceItem">Total with GST</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_adult" name="newprice[package_gsttotal_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_exadult" name="newprice[package_gsttotal_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_childbed" name="newprice[package_gsttotal_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_childwbed" name="newprice[package_gsttotal_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_infant" name="newprice[package_gsttotal_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_gsttotal_single" name="newprice[package_gsttotal_single]" readonly=""></td>
		</tr>

		<!--TCS Starts-->
		<tr>
			<td class="fontItalic">(+) TCS</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricetcs" name="newprice[package_tcs_curr]">
					<option value="0">Select</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
				</select>

				<select class="percentageValue number_test tcs_percentage" name="newprice[tcs_percentage]">
					@foreach($tcs as $tcs)
					<option value="0">Select</option>
					<option value="{{$tcs->value}}">{{$tcs->value}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select class="form-control tcs_currency" name="newprice[tcs_currency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_tcs_adult adult_disable" name="newprice[package_tcs_adult]"></td>
			<td><input type="text" class="form-control number_test packages_tcs_exadult exadult_disable" name="newprice[package_tcs_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tcs_childbed childbed_disable" name="newprice[package_tcs_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tcs_childwbed childwbed_disable" name="newprice[package_tcs_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tcs_infant infant_disable" name="newprice[package_tcs_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_tcs_single single_disable" name="newprice[package_tcs_single]" readonly="readonly"></td>
		</tr>

		<!--Total TCS (Group)-->
		<tr class="tcsGroupTotalDisplay">
			<td class="tourPriceItem">TCS (Group)</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_tcs_group" name="newprice[package_total_tcs_group]" readonly=""></td>
		</tr>

		<!--Total after TCS-->
		<tr class="tcsTotalDisplay">
			<td class="tourPriceItem">Total with TCS</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_adult" name="newprice[package_tcstotal_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_exadult" name="newprice[package_tcstotal_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_childbed" name="newprice[package_tcstotal_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_childwbed" name="newprice[package_tcstotal_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_infant" name="newprice[package_tcstotal_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_tcstotal_single" name="newprice[package_tcstotal_single]" readonly=""></td>
		</tr>

		<!-- misc charges -->
		<tr>
			<td class="fontItalic">(+) Misc. Fees<br>(PG / flight)</td>
			<td class="makeflex gap5">
				<select class="fixedValue pricepgcharges" name="newprice[pg_charges]">
					<option value="0">Select</option>
					<option value="1">Fixed</option>
					<option value="2">Percentage</option>
				</select>
				
				<select class="percentageValue number_test pgcharges_percentage" name="newprice[pgcharges_percentage]">
					<option value="0">Select</option>
					@foreach($pg as $pg)
					<option value="{{$pg->value}}">{{$pg->value}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<select class="form-control pgcharges_currency" name="newprice[pgcharges_currency]">
                    @foreach($rates as $rate)
                    <option value="{{$rate->id}}" c_val="{{$rate->rate}}">{{$rate->currency}} </option>
                    @endforeach
                </select>
            </td>
			<td><input type="text" class="form-control number_test packages_pgcharges_adult adult_disable" name="newprice[package_pgcharges_adult]"></td>
			<td><input type="text" class="form-control number_test packages_pgcharges_exadult exadult_disable" name="newprice[package_pgcharges_exadult]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_pgcharges_childbed childbed_disable" name="newprice[package_pgcharges_childbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_pgcharges_childwbed childwbed_disable" name="newprice[package_pgcharges_childwbed]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_pgcharges_infant infant_disable" name="newprice[package_pgcharges_infant]" readonly="readonly"></td>
			<td><input type="text" class="form-control number_test packages_pgcharges_single single_disable" name="newprice[package_pgcharges_single]" readonly="readonly"></td>
		</tr>

		<!--Total PG (Group)-->
		<tr class="pgGrouptTotalDisplay">
			<td class="tourPriceItem">PG (Group)</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_pg_group" name="newprice[package_total_pg_group]" readonly=""></td>
		</tr>

		<!--Grand Total-->
		<tr>
			<td class="tourPriceItem">GRAND TOTAL</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_grand_adult" name="newprice[package_grand_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_exadult" name="newprice[package_grand_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_childbed" name="newprice[package_grand_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_childwbed" name="newprice[package_grand_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_infant" name="newprice[package_grand_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_single" name="newprice[package_grand_single]" readonly=""></td>
		</tr>

		<!--Grand Total According to number of person-->
		<tr>
			<td class="tourPriceItem">PAY Total</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td><input type="text" class="form-control number_test packages_grand_adult_with_person" name="newprice[package_paytotal_adult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_exadult_with_person" name="newprice[package_paytotal_exadult]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_childbed_with_person" name="newprice[package_paytotal_childbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_childwbed_with_person " name="newprice[package_paytotal_childwbed]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_infant_with_person" name="newprice[package_paytotal_infant]" readonly=""></td>
			<td><input type="text" class="form-control number_test packages_grand_single_with_person" name="newprice[package_paytotal_single]" readonly=""></td>
		</tr>

		<!--Price to Pay-->
		<tr>
			<td class="tourPriceItem">Price To PAY</td>
			<td>
				<p class="currencyBox">INR</p>
			</td>
			<td></td>
			<td class="pricetoPay"><input type="text" class="form-control package_pricetopay packages_pricetopay" id="option1_mandate" name="newprice[package_pricetopay_adult]" readonly=""></td>
		</tr>
	</tbody>
</table>
</div>
</div>

<!-- ******************** -->

<!-- Pricing Category -->
<div class="col-md-12">
<div class="add-price-table mobscroll scrollX">
<table class="table table-bordered" id="new_price_dynamic_field">
    <thead>
        <tr>
            <th class="bkgrndColorDDD">Tour Category</th>
            <th class="bkgrndColorDDD">Price Range</th>
        </tr>
    </thead>
    <tbody>
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
                                <select name="NewPrice[0][package_rating]" id="rating" class="form-control rating-field new_price_category">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($ratingType as $rtyp)
                                        <option value="{{ $rtyp->id }}">{{ $rtyp->name }}</option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                                <input name="NewPrice[0][package_rating_other]" id="otherrating" class="form-control other-rating mt-2" placeholder="Specify Other Rating">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>

            <!-- Add Price to Category -->
            <td class="dynamic_price_range_0">
                <table class="table" id="dynamic_price_range_0_0">
                    <thead>
                        <tr>
                            <th>Price starting date</th>
                            <th>Price end date</th>
                            <th>Price applicable date (cut-off point)</th>
                            <th>Discount Applicable on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input name="NewPrice[0][datefrom][0]" class="form-control datepicker_package date_start" type="text">
                                </div>
                            </td>
                            <td>
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input name="NewPrice[0][dateto][0]" class="form-control datepicker_package date_end" type="text">
                                </div>
                            </td>
                            <td>
                                <input type="number" value="0" name="NewPrice[0][cuttoffpoint][0]" class="form-control cuttoffpoint" placeholder="Cut-off Days">
                            </td>
                            <td>
                                <select class="form-control price_applicable_for" name="NewPrice[0][applicable_for][0]">
                                    <option value="all">All Days</option>
                                    <option value="day_wise">Day Wise</option>
                                </select>
                            </td>

                            <!-- <td class="price_td makeflex" style="column-gap: 10px;"> -->
                            <td class="price_td">
                            	<div class="makeflex" style="column-gap: 10px;">

								  	<select class="form-control over_all_discount_type" name="NewPrice[0][over_all_discount_type][0]">
								    	<option value="0">No Discount</option>
								    	<option value="2">Percentage</option>
								    	<option value="3">Coupon</option>
								  	</select>
								  	
								  	<!-- discount percentage -->
								  	<select class="form-control number_test normal_discount normal_discount_first" name="NewPrice[0][normal_discount][0]" style="display: none;" style="max-width: 150px;">
									    <option value="0">0</option>
									    @foreach($discunt_negative as $markup_pro)
									      <option value="{{$markup_pro->id}}">{{$markup_pro->value}}</option>
									    @endforeach
									</select>
								  
								  	<!-- select coupon -->
									<select class="coupon_discount number_test form-control coupon_discount_first" name="NewPrice[0][coupon_discount][0]" style="display: none;">
										<option coupon_id="0" value="0">Select Coupon</option>
									    @foreach($coupons as $markup_pro)
									    	<option coupon_id="{{$markup_pro->id}}" value="{{$markup_pro->id}}">{{$markup_pro->coupon_name}}</option>
									    @endforeach
									</select>

									<div class="d_price00" id="d_price00">
										<input type="hidden" name="NewPrice[0][sunday_discount_type][0]" value="0" class="sunday_discount_type">
										<input type="hidden" name="NewPrice[0][sunday_normal_discount][0]" value="0" class="sunday_normal_discount">
										<input type="hidden" name="NewPrice[0][sunday_coupon_discount][0]" value="0" class="sunday_coupon_discount">
										<!-- Similar hidden fields for other weekdays... -->
									</div>

									<button style="display:none;" type="button" class="btn btn-info price_daywise" data-toggle="modal" data-id="d_price00">Add Price</button>
								</div>
							</td>

                            <td>
                                <button type="button" name="add" id="row_id_0" class="add_new_price_range btn btn-success">Add Price Row</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<!-- add price category -->
<button type="button" name="add" id="add-new-price-row" class="btn btn-success">Add price category</button>
</div>
</div>

</div>