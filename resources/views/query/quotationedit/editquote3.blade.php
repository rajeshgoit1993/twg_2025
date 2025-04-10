<style type="text/css">
.cke_chrome {
	display: none;
	}
</style>
<div class="tab-pane active" id="option3" >
	<div class="col-md-12">
		<form action="{{URL::to('/copy_option3')}}" method="post" id="quo1" name="quo1">
			<input type="hidden" name="custom_id" value="{{$custom_id}}"/>
			<input type="hidden" name="copy_reference" value="{{$reference_data->id}}"/>
			<input type="hidden" name="query_id" value="{{$data->id}}"/>
			{{csrf_field()}} 
			<div class="panel-group" id="accordion">
				<!--Enquiry Details-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#tourenquiry"><i class="fa fa-file-o" aria-hidden="true"></i> Enquiry Details</a></h4>
					</div>
					<div id="tourenquiry" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label for="guest_name">Primary Guest Name</label>
									<input type="text" class="form-control" name="guest_name" placeholder="Primary Guest Name" value="{{$data->name}}" style="text-transform: capitalize" readonly> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Email Address</label>
									<input type="text" class="form-control" name="guest_email" value="{{$data->email}}" placeholder="Email Address" style="text-transform: lowercase" readonly>
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Guest Contact No</label>
									<input type="text" class="form-control" name="guest_no" value="{{$data->mobile}}" placeholder="Contact No" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label>Tour Name</label>
									@if(is_numeric($data->packageId))
										<input type="text" class="form-control" name="package_name" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name" readonly>
									@else
										<input type="text" class="form-control" name="package_name" value="{{$data->packageId}}" placeholder="Package Name" style="text-transform: capitalize" readonly>
									@endif
								</div>
								<div class="col-md-4 appendBottom10">
									<label>Tour Destination</label>
									<input type="text" class="form-control" value="{{$data->destinations}}" name="destination" placeholder="Package Destination" style="text-transform: capitalize" readonly>
								</div>
								<div class="col-md-4 appendBottom10">
								<?php $day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT); ?>
									<label>Tour Duration</label>
									<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}">
									<input type="text" class="form-control" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="" placeholder="Package Destination" readonly> 
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
									<input type="text" class="form-control text-capitalize" name="" value="{{$data->country_of_residence}}" readonly="" placeholder="Nationality"> 
								</div>
								<div class="col-md-4">
									<label>Best time to Call</label>
									<input type="text" class="form-control" name="" value="{{$data->time_call}}" readonly="" placeholder="Best time to Call"> 
								</div>
								<div class="col-md-4">
									<label>Departure Date</label>
									<input type="text" class="form-control" name="" value="{{$data->date_arrival}}" readonly="" placeholder="Arrival Date">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Additional Information</label>
									<input type="text" class="form-control text-capitalize" name="" value="{{$data->remarks}}" readonly="" placeholder="Additional Information shared by Guest"> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Package Name-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#tourname"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Tour Package Name <span class="requiredcolor">*</span></a></h4>
					</div>
					<div id="tourname" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4 appendBottom10">
									<label for="custom_package_name">Tour Package Name <span class="requiredcolor">*</span></label>
										<input type="text" class="form-control" name="custom_package_name" placeholder="Enter Package Name" value="{{$reference_data->custom_package_name}}"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label for="source">Departure City <span class="requiredcolor">*</span></label>
										<input type="text" class="form-control" name="source" placeholder="Enter Departure City" value="{{$reference_data->source}}"> 
								</div>
								<div class="col-md-4 appendBottom10">
									<label for="admin_remarks">User Remarks</label>
										<input type="text" class="form-control" name="admin_remarks" placeholder="Remarks..." value="{{$reference_data->admin_remarks}}"> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Tour Pricing-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#tourprice"><i class="fa fa-money" aria-hidden="true"></i> Tour Pricing <span class="requiredcolor">*</span></a>
						</h4>
					</div>
					<div id="tourprice" class="panel-collapse collapse">
					<table class="table"> 
						<tr>
							<td>Price Type <span class="requiredcolor">*</span></td>
							<td>
								<select class="form-control price_type" name="price_type" style="background: #f2f2f2">
									<option @if($reference_data->option3_price_type=="Per Person") selected  @endif value="Per Person">Per Person</option>
									<option @if($reference_data->option3_price_type=="Group Price") selected  @endif value="Group Price">Group Price</option>
								</select>
							</td>
							@if($reference_data->anything!="")
								<td class="anything"><input type="text" name="anything" class="form-control" placeholder="Price per person (inclusive of GST) or all travelling passengers..." value="{{$reference_data->anything}}"></td>
							@else
								<td class="anything"><input type="text" name="anything" class="form-control" placeholder="Price per person (inclusive of GST) or all travelling passengers..."></td>
							@endif
							<td class="remarks"><input type="text" name="remarks" class="form-control" placeholder="Remarks ..." value="{{ $reference_data->remarks }}"></td>
							<td class="noofrooms"><input type="text" name="remarks" class="form-control" placeholder="2 Rooms - 4 Adults,2 Child,1 Infant"></td>
						</tr>
					</table>
					<table class="table backend_custom_height">
						<thead>
							<th></th>
							<th class="minwidth100">
								<p class="pfwmt text-center" style="font-size: 13px;margin-bottom: 1px">CURRENCY</p>
								<div class="makeflex">
									<select class="form-control query_air_curr" name="price[query_air_curr]" style="background: #f9f9f9;width: 50%">
									 @foreach($rates as $rate)
										<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency }}</option>
									@endforeach
									<input type="text" class="form-control" name="" placeholder="Rate" style="background: #f9f9f9;padding: 5px;color: #4a4a4a;width: 50%">
									</select>
								</div>
								<div class="makeflex" style="margin-bottom: 3px">
									<input type="text" class="form-control" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;width: 50%">
									<input type="text" class="form-control" name="" placeholder="Value" style="padding: 5px;color: #4a4a4a;width: 50%">
								</div>
								<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Conversion</p>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">ADULT</p>
								<p class="pfwmt text-center" style="font-size: 12px;">(TWIN SHARING)</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="adult_twin_sharing" class="span_value_adult" value="2" />
									<i class="glyphicon glyphicon-minus font-size14" style="border: none;color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">2</span>
									<i class="glyphicon glyphicon-plus font-size14" style="border: none;color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
								</div>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">EXTRA ADULT</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="extra_adult" class="span_value_extra_adult" value="0" />
									<i class="glyphicon glyphicon-minus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
									<i class="glyphicon glyphicon-plus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
								</div>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">CHILD</p>
								<p class="pfwmt text-center" style="font-size: 12px;">(WITH BED)</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="child_with_bed" class="span_value_child_with_bed" value="0" />
									<i class="glyphicon glyphicon-minus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
									<i class="glyphicon glyphicon-plus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Child (2-12yrs)</p>
								</div>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">CHILD</p>
								<p class="pfwmt text-center" style="font-size: 12px;">(WITHOUT BED)</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="child_without_bed" class="span_value_child_without_bed" value="0" />
									<i class="glyphicon glyphicon-minus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="span_value_childwithoutbed" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
									<i class="glyphicon glyphicon-plus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Child (2-12yrs)</p>
								</div>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">INFANT</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="infant" class="span_value_infant" value="0" />
									<i class="glyphicon glyphicon-minus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
									<i class="glyphicon glyphicon-plus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Infant (0-2yrs)</p>
								</div>
							</th>
							<th class="minwidth135">
								<p class="pfwmt text-center" style="font-size: 13px;">SOLO<br>TRAVELLER</p>
								<div class="text-center">
									<input type="hidden" id="travellers" name="solo_traveller" class="span_value_solo_traveller" value="0" />
									<i class="glyphicon glyphicon-minus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<span class="" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
									<i class="glyphicon glyphicon-plus" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
									<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
								</div>
							</th>
						</thead>
							<tbody>
								<tr>
									<td>Airfare</td>
									<?php $option3_price=unserialize($reference_data->option3_price); ?>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
										<!--<select class="form-control query_air_curr" name="price[query_air_curr]">
										@foreach($rates as $rate)
											<option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_air_curr"]) selected  @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
										@endforeach
										</select>
										<select class="form-control">
											<option>INR</option>
										</select>-->
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_air_adult" name="price[query_air_adult]" @if($option3_price["query_air_adult"]!="") value="{{$option3_price["query_air_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_air_exadult" name="price[query_air_exadult]" @if($option3_price["query_air_exadult"]!="") value="{{$option3_price["query_air_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_air_childbed" name="price[query_air_childbed]" @if($option3_price["query_air_childbed"]!="") value="{{$option3_price["query_air_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_air_childwbed" name="price[query_air_childwbed]" @if($option3_price["query_air_childwbed"]!="") value="{{$option3_price["query_air_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_air_infant" name="price[query_air_infant]" @if($option3_price["query_air_infant"]!="") value="{{$option3_price["query_air_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_air_single" name="price[query_air_single]" @if($option3_price["query_air_single"]!="") value="{{$option3_price["query_air_single"]}}" @endif></td>
								</tr>
							
								<!--Cruise Start-->
							<tbody>
								<tr>
									<td>Cruise Fare</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_cruise_adult" name="price[query_cruise_adult]" @if(array_key_exists("query_cruise_adult",$option3_price))  @if($option3_price["query_cruise_adult"]!="") value="{{$option3_price["query_cruise_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruise_exadult" name="price[query_cruise_exadult]" @if(array_key_exists("query_cruise_exadult",$option3_price))  @if($option3_price["query_cruise_exadult"]!="") value="{{$option3_price["query_cruise_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruise_childbed" name="price[query_cruise_childbed]" @if(array_key_exists("query_cruise_childbed",$option3_price))  @if($option3_price["query_cruise_childbed"]!="") value="{{$option3_price["query_cruise_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruise_childwbed" name="price[query_cruise_childwbed]" @if(array_key_exists("query_cruise_childwbed",$option3_price))  @if($option3_price["query_cruise_childwbed"]!="") value="{{$option3_price["query_cruise_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruise_infant" name="price[query_cruise_infant]" @if(array_key_exists("query_cruise_infant",$option3_price))  @if($option3_price["query_cruise_infant"]!="") value="{{$option3_price["query_cruise_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruise_single" name="price[query_cruise_single]" @if(array_key_exists("query_cruise_single",$option3_price))  @if($option3_price["query_cruise_single"]!="") value="{{$option3_price["query_cruise_single"]}}" @endif @endif></td>
								</tr>
								<tr>
									<td>Port Charges </td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_cruiseport_adult" name="price[query_cruiseport_adult]" @if(array_key_exists("query_cruiseport_adult",$option3_price))  @if($option3_price["query_cruiseport_adult"]!="") value="{{$option3_price["query_cruiseport_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruiseport_exadult" name="price[query_cruiseport_exadult]" @if(array_key_exists("query_cruiseport_exadult",$option3_price))  @if($option3_price["query_cruiseport_exadult"]!="") value="{{$option3_price["query_cruiseport_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruiseport_childbed" name="price[query_cruiseport_childbed]" @if(array_key_exists("query_cruiseport_childbed",$option3_price))  @if($option3_price["query_cruiseport_childbed"]!="") value="{{$option3_price["query_cruiseport_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruiseport_childwbed" name="price[query_cruiseport_childwbed]" @if(array_key_exists("query_cruiseport_childwbed",$option3_price))  @if($option3_price["query_cruiseport_childwbed"]!="") value="{{$option3_price["query_cruiseport_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruiseport_infant" name="price[query_cruiseport_infant]" @if(array_key_exists("query_cruiseport_infant",$option3_price))  @if($option3_price["query_cruiseport_infant"]!="") value="{{$option3_price["query_cruiseport_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruiseport_single" name="price[query_cruiseport_single]" @if(array_key_exists("query_cruiseport_single",$option3_price))  @if($option3_price["query_cruiseport_single"]!="") value="{{$option3_price["query_cruiseport_single"]}}" @endif @endif></td>
								</tr>
								<tr>
									<td>Gratuity</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_cruisegratuity_adult" name="price[query_cruisegratuity_adult]" @if(array_key_exists("query_cruisegratuity_adult",$option3_price))  @if($option3_price["query_cruisegratuity_adult"]!="") value="{{$option3_price["query_cruisegratuity_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegratuity_exadult" name="price[query_cruisegratuity_exadult]" @if(array_key_exists("query_cruisegratuity_exadult",$option3_price))  @if($option3_price["query_cruisegratuity_exadult"]!="") value="{{$option3_price["query_cruisegratuity_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegratuity_childbed" name="price[query_cruisegratuity_childbed]" @if(array_key_exists("query_cruisegratuity_childbed",$option3_price))  @if($option3_price["query_cruisegratuity_childbed"]!="") value="{{$option3_price["query_cruisegratuity_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegratuity_childwbed" name="price[query_cruisegratuity_childwbed]" @if(array_key_exists("query_cruisegratuity_childwbed",$option3_price))  @if($option3_price["query_cruisegratuity_childwbed"]!="") value="{{$option3_price["query_cruisegratuity_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegratuity_infant" name="price[query_cruisegratuity_infant]" @if(array_key_exists("query_cruisegratuity_infant",$option3_price))  @if($option3_price["query_cruisegratuity_infant"]!="") value="{{$option3_price["query_cruisegratuity_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegratuity_single" name="price[query_cruisegratuity_single]" @if(array_key_exists("query_cruisegratuity_single",$option3_price))  @if($option3_price["query_cruisegratuity_single"]!="") value="{{$option3_price["query_cruisegratuity_single"]}}" @endif @endif></td>
								</tr>
								<tr>
									<td>Cruise GST </td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_cruisegst_adult" name="price[query_cruisegst_adult]" @if(array_key_exists("query_cruisegst_adult",$option3_price))  @if($option3_price["query_cruisegst_adult"]!="") value="{{$option3_price["query_cruisegst_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegst_exadult" name="price[query_cruisegst_exadult]" @if(array_key_exists("query_cruisegst_exadult",$option3_price))  @if($option3_price["query_cruisegst_exadult"]!="") value="{{$option3_price["query_cruisegst_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegst_childbed" name="price[query_cruisegst_childbed]" @if(array_key_exists("query_cruisegst_childbed",$option3_price))  @if($option3_price["query_cruisegst_childbed"]!="") value="{{$option3_price["query_cruisegst_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegst_childwbed" name="price[query_cruisegst_childwbed]" @if(array_key_exists("query_cruisegst_childwbed",$option3_price))  @if($option3_price["query_cruisegst_childwbed"]!="") value="{{$option3_price["query_cruisegst_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegst_infant" name="price[query_cruisegst_infant]" @if(array_key_exists("query_cruisegst_infant",$option3_price))  @if($option3_price["query_cruisegst_infant"]!="") value="{{$option3_price["query_cruisegst_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_cruisegst_single" name="price[query_cruisegst_single]" @if(array_key_exists("query_cruisegst_single",$option3_price))  @if($option3_price["query_cruisegst_single"]!="") value="{{$option3_price["query_cruisegst_single"]}}" @endif @endif></td>
								</tr>
							</tbody>
								<!--Cruise End-->
							<tbody>	
								<tr>
									<td>Accommodation</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_hotel_adult" name="price[query_hotel_adult]" @if($option3_price["query_hotel_adult"]!="") value="{{$option3_price["query_hotel_adult"]}}" @endif id="option3_mandate"></td>
									<td><input type="text" class="form-control query_hotel_exadult" name="price[query_hotel_exadult]" @if($option3_price["query_hotel_exadult"]!="") value="{{$option3_price["query_hotel_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_hotel_childbed" name="price[query_hotel_childbed]" @if($option3_price["query_hotel_childbed"]!="") value="{{$option3_price["query_hotel_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_hotel_childwbed" name="price[query_hotel_childwbed]" @if($option3_price["query_hotel_childwbed"]!="") value="{{$option3_price["query_hotel_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_hotel_infant" name="price[query_hotel_infant]" @if($option3_price["query_hotel_infant"]!="") value="{{$option3_price["query_hotel_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_hotel_single" name="price[query_hotel_single]" @if($option3_price["query_hotel_single"]!="") value="{{$option3_price["query_hotel_single"]}}" @endif></td>
								</tr>
								<tr>
									<td>Sightseeing</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_tours_adult" name="price[query_tours_adult]" @if($option3_price["query_tours_adult"]!="") value="{{$option3_price["query_tours_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_tours_exadult" name="price[query_tours_exadult]" @if($option3_price["query_tours_exadult"]!="") value="{{$option3_price["query_tours_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_tours_childbed" name="price[query_tours_childbed]" @if($option3_price["query_tours_childbed"]!="") value="{{$option3_price["query_tours_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_tours_childwbed" name="price[query_tours_childwbed]" @if($option3_price["query_tours_childwbed"]!="") value="{{$option3_price["query_tours_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_tours_infant" name="price[query_tours_infant]" @if($option3_price["query_tours_infant"]!="") value="{{$option3_price["query_tours_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_tours_single" name="price[query_tours_single]" @if($option3_price["query_tours_single"]!="") value="{{$option3_price["query_tours_single"]}}" @endif></td>
								</tr>
								<tr>
									<td>Transfers</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_transfer_adult" name="price[query_transfer_adult]" @if($option3_price["query_transfer_adult"]!="") value="{{$option3_price["query_transfer_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_transfer_exadult" name="price[query_transfer_exadult]" @if($option3_price["query_transfer_exadult"]!="") value="{{$option3_price["query_transfer_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_transfer_childbed" name="price[query_transfer_childbed]" @if($option3_price["query_transfer_childbed"]!="") value="{{$option3_price["query_transfer_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_transfer_childwbed" name="price[query_transfer_childwbed]" @if($option3_price["query_transfer_childwbed"]!="") value="{{$option3_price["query_transfer_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_transfer_infant" name="price[query_transfer_infant]" @if($option3_price["query_transfer_infant"]!="") value="{{$option3_price["query_transfer_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_transfer_single" name="price[query_transfer_single]" @if($option3_price["query_transfer_single"]!="") value="{{$option3_price["query_transfer_single"]}}" @endif></td>
								</tr>
								<tr>
									<td>Visa Charges</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_visa_adult" name="price[query_visa_adult]" @if($option3_price["query_visa_adult"]!="") value="{{$option3_price["query_visa_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_visa_exadult" name="price[query_visa_exadult]" @if($option3_price["query_visa_exadult"]!="") value="{{$option3_price["query_visa_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_visa_childbed" name="price[query_visa_childbed]" @if($option3_price["query_visa_childbed"]!="") value="{{$option3_price["query_visa_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_visa_childwbed" name="price[query_visa_childwbed]" @if($option3_price["query_visa_childwbed"]!="") value="{{$option3_price["query_visa_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_visa_infant" name="price[query_visa_infant]" @if($option3_price["query_visa_infant"]!="") value="{{$option3_price["query_visa_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_visa_single" name="price[query_visa_single]" @if($option3_price["query_visa_single"]!="") value="{{$option3_price["query_visa_single"]}}" @endif></td>
								</tr>
								<tr>
									<td> Travel Insurance</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
									<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_inc_adult" name="price[query_inc_adult]" @if($option3_price["query_inc_adult"]!="") value="{{$option3_price["query_inc_adult"]}}"  @endif></td>
									<td><input type="text" class="form-control query_inc_exadult" name="price[query_inc_exadult]" @if($option3_price["query_inc_exadult"]!="") value="{{$option3_price["query_inc_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_inc_childbed" name="price[query_inc_childbed]" @if($option3_price["query_inc_childbed"]!="") value="{{$option3_price["query_inc_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_inc_childwbed" name="price[query_inc_childwbed]" @if($option3_price["query_inc_childwbed"]!="") value="{{$option3_price["query_inc_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_inc_infant" name="price[query_inc_infant]" @if($option3_price["query_inc_infant"]!="") value="{{$option3_price["query_inc_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_inc_single" name="price[query_inc_single]" @if($option3_price["query_inc_single"]!="") value="{{$option3_price["query_inc_single"]}}" @endif></td>
								</tr>
								<!--Meals  Start-->
								<tr>
									<td>Meals</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_meals_adult" name="price[query_meals_adult]" @if(array_key_exists("query_meals_adult",$option3_price))  @if($option3_price["query_meals_adult"]!="") value="{{$option3_price["query_meals_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_meals_exadult" name="price[query_meals_exadult]" @if(array_key_exists("query_meals_exadult",$option3_price))  @if($option3_price["query_meals_exadult"]!="") value="{{$option3_price["query_meals_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_meals_childbed" name="price[query_meals_childbed]" @if(array_key_exists("query_meals_childbed",$option3_price))  @if($option3_price["query_meals_childbed"]!="") value="{{$option3_price["query_meals_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_meals_childwbed" name="price[query_meals_childwbed]" @if(array_key_exists("query_meals_childwbed",$option3_price))  @if($option3_price["query_meals_childwbed"]!="") value="{{$option3_price["query_meals_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_meals_infant" name="price[query_meals_infant]" @if(array_key_exists("query_meals_infant",$option3_price))  @if($option3_price["query_meals_infant"]!="") value="{{$option3_price["query_meals_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_meals_single" name="price[query_meals_single]" @if(array_key_exists("query_meals_single",$option3_price))  @if($option3_price["query_meals_single"]!="") value="{{$option3_price["query_meals_single"]}}" @endif @endif></td>
								</tr>
								<!--Meals End-->
								<!--Additional Service-->
								<tr>
									<td>Addon Service</td>
									<td class="makeflex">
										<select class="form-control minwidth100">
											<option value="0">Select</option>
											<option value="1">A</option>
										</select>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_additionalservice_adult" name="price[query_additionalservice_adult]"></td>
									<td><input type="text" class="form-control query_additionalservice_exadult" name="price[query_additionalservice_exadult]"></td>
									<td><input type="text" class="form-control query_additionalservice_childbed" name="price[query_additionalservice_childbed]"></td>
									<td><input type="text" class="form-control query_additionalservice_childwbed" name="price[query_additionalservice_childwbed]"></td>
									<td><input type="text" class="form-control query_additionalservice_infant" name="price[query_additionalservice_infant]"></td>
									<td><input type="text" class="form-control query_additionalservice_single" name="price[query_additionalservice_single]"></td>
								</tr>
								<!--Additional Service End-->
							</tbody>
								<!--Total before Markup-->
								<tr>
									<td>Total</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_tourtotal_adult" name="price[query_tourtotal_adult]" readonly></td>
									<td><input type="text" class="form-control query_tourtotal_exadult" name="price[query_tourtotal_exadult]" readonly></td>
									<td><input type="text" class="form-control query_tourtotal_childbed" name="price[query_tourtotal_childbed]" readonly></td>
									<td><input type="text" class="form-control query_tourtotal_childwbed" name="price[query_tourtotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control query_tourtotal_infant" name="price[query_tourtotal_infant]" readonly></td>
									<td><input type="text" class="form-control query_tourtotal_single" name="price[query_tourtotal_single]" readonly></td>
								</tr>
								<!--Markup  Start-->
								<tr>
									<td style="font-style: italic">Markup (Profit)</td>
									<td class="makeflex">
										<select class="form-control" name="pricemarkup" style="">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<input type="text" class="form-control" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
									</td>
									<td><input type="text" class="form-control query_markup_adult" name="price[query_markup_adult]" @if(array_key_exists("query_markup_adult",$option3_price))  @if($option3_price["query_markup_adult"]!="") value="{{$option3_price["query_markup_adult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_markup_exadult" name="price[query_markup_exadult]" @if(array_key_exists("query_markup_exadult",$option3_price))  @if($option3_price["query_markup_exadult"]!="") value="{{$option3_price["query_markup_exadult"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_markup_childbed" name="price[query_markup_childbed]" @if(array_key_exists("query_markup_childbed",$option3_price))  @if($option3_price["query_markup_childbed"]!="") value="{{$option3_price["query_markup_childbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_markup_childwbed" name="price[query_markup_childwbed]" @if(array_key_exists("query_markup_childwbed",$option3_price))  @if($option3_price["query_markup_childwbed"]!="") value="{{$option3_price["query_markup_childwbed"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_markup_infant" name="price[query_markup_infant]" @if(array_key_exists("query_markup_infant",$option3_price))  @if($option3_price["query_markup_infant"]!="") value="{{$option3_price["query_markup_infant"]}}" @endif @endif></td>
									<td><input type="text" class="form-control query_markup_single" name="price[query_markup_single]" @if(array_key_exists("query_markup_single",$option3_price))  @if($option3_price["query_markup_single"]!="") value="{{$option3_price["query_markup_single"]}}" @endif @endif></td>
								</tr>
								<!--Total before GST-->
								<tr>
									<td style="font-weight: 600">Total</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_total_adult" readonly="" name="price[query_total_adult]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'adult')}}"></td>
									<td><input type="text" class="form-control query_total_exadult" readonly="" name="price[query_total_exadult]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'exadult')}}"></td>
									<td><input type="text" class="form-control query_total_childbed" readonly="" name="price[query_total_childbed]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'childbed')}}"></td>
									<td><input type="text" class="form-control query_total_childwbed" readonly="" name="price[query_total_childwbed]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'childwbed')}}"></td>
									<td><input type="text" class="form-control query_total_infant" readonly="" name="price[query_total_infant]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'infant')}}"></td>
									<td><input type="text" class="form-control query_total_single" readonly="" name="price[query_total_single]" value="{{CustomHelpers::get_quotation_total($reference_data->option3_price,'single')}}"></td>
								</tr>
								<!--GST Starts-->
								<tr>
									<td style="font-style: italic">(+) GST</td>
									<td class="makeflex">
										<select class="form-control" name="price[query_gst_curr]" style="">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<input type="text" class="form-control" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
									</td>
									<td><input type="text" class="form-control query_gst_adult" name="price[query_gst_adult]" @if($option3_price["query_gst_adult"]!="") value="{{$option3_price["query_gst_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_gst_exadult" name="price[query_gst_exadult]" @if($option3_price["query_gst_exadult"]!="") value="{{$option3_price["query_gst_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_gst_childbed" name="price[query_gst_childbed]" @if($option3_price["query_gst_childbed"]!="") value="{{$option3_price["query_gst_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_gst_childwbed" name="price[query_gst_childwbed]" @if($option3_price["query_gst_childwbed"]!="") value="{{$option3_price["query_gst_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_gst_infant" name="price[query_gst_infant]" @if($option3_price["query_gst_infant"]!="") value="{{$option3_price["query_gst_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_gst_single" name="price[query_gst_single]" @if($option3_price["query_gst_single"]!="") value="{{$option3_price["query_gst_single"]}}" @endif></td>
								</tr>
								<!--Total after GST-->
								<tr>
									<td style="font-weight: 600">Total with GST</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_gsttotal_adult" name="price[query_gsttotal_adult]" readonly></td>
									<td><input type="text" class="form-control query_gsttotal_exadult" name="price[query_gsttotal_exadult]" readonly></td>
									<td><input type="text" class="form-control query_gsttotal_childbed" name="price[query_gsttotal_childbed]" readonly></td>
									<td><input type="text" class="form-control query_gsttotal_childwbed" name="price[query_gsttotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control query_gsttotal_infant" name="price[query_gsttotal_infant]" readonly></td>
									<td><input type="text" class="form-control query_gsttotal_single" name="price[query_gsttotal_single]" readonly></td>
								</tr>
								<!--TCS Starts-->
								<tr>
									<td style="font-style: italic">(+) TCS</td>
									<td class="makeflex">
										<select class="form-control query_tcs_curr" name="price[query_tcs_curr]" style="">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<input type="text" class="form-control" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
									</td>
									<td><input type="text" class="form-control query_tcs_adult" name="price[query_tcs_adult]"></td>
									<td><input type="text" class="form-control query_tcs_exadult" name="price[query_tcs_exadult]"></td>
									<td><input type="text" class="form-control query_tcs_childbed" name="price[query_tcs_childbed]"></td>
									<td><input type="text" class="form-control query_tcs_childwbed" name="price[query_tcs_childwbed]"></td>
									<td><input type="text" class="form-control query_tcs_infant" name="price[query_tcs_infant]"></td>
									<td><input type="text" class="form-control query_tcs_single" name="price[query_tcs_single]"></td>
								</tr>
								<!--Total after TCS-->
								<tr>
									<td style="font-weight: 600">Total with TCS</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_tcstotal_adult" name="price[query_tcstotal_adult]" readonly></td>
									<td><input type="text" class="form-control query_tcstotal_exadult" name="price[query_tcstotal_exadult]" readonly></td>
									<td><input type="text" class="form-control query_tcstotal_childbed" name="price[query_tcstotal_childbed]" readonly></td>
									<td><input type="text" class="form-control query_tcstotal_childwbed" name="price[query_tcstotal_childwbed]" readonly></td>
									<td><input type="text" class="form-control query_tcstotal_infant" name="price[query_tcstotal_infant]" readonly></td>
									<td><input type="text" class="form-control query_tcstotal_single" name="price[query_tcstotal_single]" readonly></td>
								</tr>
								<!--PG Charges Starts-->
								<tr>
									<td style="font-style: italic">(+) PG Charges</td>
									<td class="makeflex">
										<select class="form-control" name="price[pg_charges]" style="">
											<option value="0">Select</option>
											<option value="1">Fixed</option>
											<option value="2">Percentage</option>
										</select>
										<input type="text" class="form-control" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
									</td>
									<td><input type="text" class="form-control query_pgcharges_adult" name="price[query_pgcharges_adult]"></td>
									<td><input type="text" class="form-control query_pgcharges_exadult" name="price[query_pgcharges_exadult]"></td>
									<td><input type="text" class="form-control query_pgcharges_childbed" name="price[query_pgcharges_childbed]"></td>
									<td><input type="text" class="form-control query_pgcharges_childwbed" name="price[query_pgcharges_childwbed]"></td>
									<td><input type="text" class="form-control query_pgcharges_infant" name="price[query_pgcharges_infant]"></td>
									<td><input type="text" class="form-control query_pgcharges_single" name="price[query_pgcharges_single]"></td>
								</tr>
								<!--PG Charges Ends-->
								<!--Discount Plus-->
								<tr>
									<td>Discount (+)</td>
									<td>
										<p class="pfwmt form-control text-center query_discount_curr" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_discount_adult" name="price[query_discount_adult]"></td>
									<td><input type="text" class="form-control query_discount_exadult" name="price[query_discount_exadult]"></td>
									<td><input type="text" class="form-control query_discount_childbed" name="price[query_discount_childbed]"></td>
									<td><input type="text" class="form-control query_discount_childwbed" name="price[query_discount_childwbed]"></td>
									<td><input type="text" class="form-control query_discount_infant" name="price[query_discount_infant]"></td>
									<td><input type="text" class="form-control query_discount_single" name="price[query_discount_single]"></td>
								</tr>
								<!--Discount Minus-->
								<tr>
									<td>Discount (-)</td>
									<td>
										<p class="pfwmt form-control text-center query_discount_curr" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_discount_adult" name="price[query_discount_adult]" @if($option3_price["query_discount_adult"]!="") value="{{$option3_price["query_discount_adult"]}}" @endif></td>
									<td><input type="text" class="form-control query_discount_exadult" name="price[query_discount_exadult]" @if($option3_price["query_discount_exadult"]!="") value="{{$option3_price["query_discount_exadult"]}}" @endif></td>
									<td><input type="text" class="form-control query_discount_childbed" name="price[query_discount_childbed]" @if($option3_price["query_discount_childbed"]!="") value="{{$option3_price["query_discount_childbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_discount_childwbed" name="price[query_discount_childwbed]" @if($option3_price["query_discount_childwbed"]!="") value="{{$option3_price["query_discount_childwbed"]}}" @endif></td>
									<td><input type="text" class="form-control query_discount_infant" name="price[query_discount_infant]" @if($option3_price["query_discount_infant"]!="") value="{{$option3_price["query_discount_infant"]}}" @endif></td>
									<td><input type="text" class="form-control query_discount_single" name="price[query_discount_single]" @if($option3_price["query_discount_single"]!="") value="{{$option3_price["query_discount_single"]}}" @endif></td>
								</tr>
							<tbody>
								<!--Grand Total-->
								<tr>
									<td style="font-weight: 900">GRAND TOTAL</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_grand_adult" readonly="" name="price[query_grand_adult]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'adult')}}"></td>
									<td><input type="text" class="form-control query_grand_exadult" readonly="" name="price[query_grand_exadult]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'exadult')}}"></td>
									<td><input type="text" class="form-control query_grand_childbed" readonly="" name="price[query_grand_childbed]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'childbed')}}"></td>
									<td><input type="text" class="form-control query_grand_childwbed" readonly="" name="price[query_grand_childwbed]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'childwbed')}}"></td>
									<td><input type="text" class="form-control query_grand_infant" readonly="" name="price[query_grand_infant]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'infant')}}"></td>
									<td><input type="text" class="form-control query_grand_single" readonly="" name="price[query_grand_single]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data->option3_price,'single')}}"></td>
								</tr>
								<!--Price to Pay-->
								<tr>
									<td style="font-weight: 900">PRICE TO PAY</td>
									<td>
										<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
									</td>
									<td><input type="text" class="form-control query_pricetopay" name="price[query_pricetopay_adult]" readonly></td>
								</tr>
							</tbody>
							</tbody>
						</table>
					</div>
				</div>
				<!--Tour Accommodation-->
				<?php
					$option3_accommodation=unserialize($reference_data->option3_accommodation);
					$option3_accommodation_count=count($option3_accommodation);
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#touraccommodation"><i class="fa fa-bed" aria-hidden="true"></i> Tour Accommodation <span class="requiredcolor">*</span></a>
						</h4>
					</div>
					<div id="touraccommodation" class="panel-collapse collapse">
						<div class="panel-body">
						<?php
							$days=$data->duration;
							$days=(int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
							$days=$days-1;
						?>
							<div class="dynamic_acc">
								<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}">
								@for($j=0;$j<$option3_accommodation_count;$j++)
									@if($j>0)
										<hr>
									@endif
								<div class="field{{$j}}" id="{{$j}}">
									<div class="row">
										<div class="col-md-4 appendBottom10">
											<label>Select Days</label>
											<select class="form-control select_day select2" name="accommodation[{{$j}}][day][]" multiple>
												@for($i=1;$i<=$days;$i++)
													<option value="Day {{$i}}" @if($option3_accommodation!="" && array_key_exists("day",$option3_accommodation[$j])  && in_array("Day $i",$option3_accommodation[$j]["day"])) selected @endif>  Day {{$i}}</option>
												@endfor
											</select>
										</div>  
										<div class="col-md-4 appendBottom10">
											<label>City</label>
												<input type="text" name="accommodation[{{$j}}][city]" class="form-control query_city" placeholder="Enter city name" value="{{$option3_accommodation[$j]["city"]}}" />
										</div>
										<div class="col-md-4 appendBottom10">
											<label>Accommodation Source</label>
											<select class="form-control" name="accommodation[{{$j}}][trip]">
												<option value='0' disabled='disabled'>Select Source</option>
												<option value="Manually" @if($option3_accommodation[$j]["trip"]=="Manually") selected @endif>Database</option>  
												<option value="TripAdvisor" @if($option3_accommodation[$j]["trip"]=="TripAdvisor") selected @endif>TripAdvisor</option>
											</select>
										</div>
										<div class="col-md-4 appendBottom10">
											<label>Hotel</label>
											<?php $query_data=CustomHelpers::get_quotation_hotel($option3_accommodation[$j]["city"]); ?>
											<select class="form-control quo_hotel" name="accommodation[{{$j}}][hotel]">
												<option value='0' selected='true' disabled='disabled'>Select Hotel</option>
											@foreach($query_data as $single)
												<option value='{{$single->id}}' @if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) && $single->id==$option3_accommodation[$j]["hotel"])  selected @endif>{{$single->hotelname}}</option>
											 @endforeach
												<option value="other" @if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) &&$option3_accommodation[$j]["hotel"]=="other")  selected @endif>Other</option>
											</select>
										</div>
										@if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) && $option3_accommodation[$j]["hotel"]=="other")
										<div class="col-md-4 appendBottom10" style="display: block;">
											<label>Enter Hotel</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][other_hotel]" placeholder="Enter hotel name" value="{{$option3_accommodation[$j]["other_hotel"]}}">
										</div>
										@else
										<div class="col-md-4 appendBottom10 other_hotel" style="display: none;">
											<label>Enter Hotel</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][other_hotel]" placeholder="Hotel Name">
										</div>
										@endif
										<div class="col-md-4 appendBottom10 add_star">
											<label>Star Rating</label>
											<select class="form-control quo_star" name="accommodation[{{$j}}][star]">
												<option value='0'  disabled='disabled'>Select star rating</option>
												@if($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) && $option3_accommodation[$j]["star"]!="" && $option3_accommodation[$j]["star"]!="other")
													<option value="{{$option3_accommodation[$j]["star"]}}" selected>{{$option3_accommodation[$j]["star"]}}</option>
												@elseif($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) && $option3_accommodation[$j]["star"]!="" && $option3_accommodation[$j]["star"]=="other")
													<option value="other" selected>Other</option>
												@endif
											</select>
										</div>
										@if($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) &&$option3_accommodation[$j]["star"]=="other")
										<div class="col-md-4 appendBottom10 other_star" style="display: block;">
											<label>Enter Star Rating</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" placeholder="Hotel Star Rating" value="{{$option3_accommodation[$j]["star_other"]}}">
											</div>
										@else
										<div class="col-md-4 add_star" style="display: none;">
											<label>Enter Star Rating</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" value="{{$option3_accommodation[$j]["star_other"]}}" placeholder="Enter hotel star rating">
										</div>
										@endif
										<div class="col-md-4 appendBottom10">
											<label>Room Type</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][category]" placeholder="Enter room type" value="{{$option3_accommodation[$j]["category"]}}">
										</div> 
										<div class="col-md-4">
											<label>Hotel Website</label>
												<input type="text" class="form-control" name="accommodation[{{$j}}][hotel_link]" placeholder="Enter hotel website" @if($option3_accommodation!="" && array_key_exists("hotel_link",$option3_accommodation[$j])) value="{{$option3_accommodation[$j]["hotel_link"]}}" @endif>
										</div>
										@if($j>0)
											<div class="col-md-2"><button type="button" name="add" id="{{$j}}" class="remove_acco btn btn-danger" style="margin-top:23px">x Remove</button> </div>
										@endif
									</div>
								</div>
								@endfor
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
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#tourflight"><i class="fa fa-plane" aria-hidden="true"></i> Flight</a>
						</h4>
					</div>
					<div id="tourflight" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Flight</label>
										<select name="transport" class="form-control transport" id="transport">
											<option value="0">Select</option>
											@foreach($transport as $trans)  
											<option value="{{ $trans->name }}" @if($trans->name==$reference_data->option3_transport) selected @endif>{{$trans->name}}</option>
											@endforeach
										</select>
									</div>
									@if($reference_data->option3_transport=="Flight")
										<div class="oflight" style="display: none;">
											<textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{ old('transport_description') }}</textarea>
											<br>
										</div>
									<?php $flight=unserialize($reference_data->option3_flight); ?>
									<div class="flight">
										<!--Onward Flight-->
										<div class="col-md-12 border-top1 padding-top10" style="">
											<p class="pfwmt appendBottom10">UPWARD FLIGHT</p>
										</div>
											<div class="col-md-3 appendBottom20">
												<label>Onward Date</label>
													<input type="text" name="flight[onwarddate]" class="form-control datepickers" @if(array_key_exists('onwarddate',$flight)) @if($flight['onwarddate']!="") value="{{$flight['onwarddate']}}" @endif @endif placeholder="Select departure date">
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Airline Name</label>
													<!--<input type="text" name="flight[name]" class="form-control flight_name" @if($flight['name']!="") value="{{ $flight['name'] }}" @endif>-->
													<select name="flight[name]" class="form-control flight_name">
														<option value="0">Select Airline</option>
														<option value=""> </option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight No.</label>
													<input type="text" name="flight[no]" class="form-control flight_no" @if($flight['no']!="") value="{{$flight['no']}}" @endif placeholder="e.g. 333" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>No. Of Stop</label>
													<!--<input type="text" name="flight[numberstop]" class="form-control" @if($flight['numberstop']!="") value="{{$flight['numberstop']}}" @endif>-->
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
											<div class="col-md-3 appendBottom20">
												<label>Flight Origin</label>
													<!--<input type="text" name="flight[Origin]" class="form-control flight_origin" @if($flight['Origin']!="") value="{{$flight['Origin']}}" @endif>-->
													<select name="flight[dest]" class="form-control">
														<option value="0">Select Origin</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Departure Time</label>
													<!--<input type="text" name="flight[dtime]" class="form-control" @if($flight['dtime']!="") value="{{$flight['dtime']}}" @endif>-->
													<div class="clearfix"></div>
													<select name="flight[dhours]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Hours</option>
														@for($i=1;$i<=24;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[dmins]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Minutes</option>
														@for($i=1;$i<=60;$i++)
															<option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Destination</label>
													<!--<input type="text" name="flight[dest]" class="form-control flight_dest" @if($flight['dest']!="") value="{{$flight['dest']}}" @endif>-->
													<select name="flight[dest]" class="form-control">
														<option value="0">Select Destination</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Arrival Time</label>
													<!--<input type="text" name="flight[atime]" class="form-control" @if($flight['atime']!="") value="{{$flight['atime']}}" @endif>-->
													<div class="clearfix"></div>
													<select name="flight[ahours]" class="form-control" style="padding: 5px;max-width: 32%;display: inline-block;">
														<option value="0">Hours</option>
														@for($i=1;$i<=24;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[amins]" class="form-control" style="padding: 5px;max-width: 37%;display: inline-block;">
														<option value="0">Minutes</option>
														@for($i=1;$i<=60;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[adayplus]" class="form-control" style="padding: 0px;max-width: 28%;display: inline-block;">
														<option value="0">+ Day</option>
														<option value="1">+1 Day</option>
														<option value="2">+2 Day</option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin Class</label>
												<select name="flight[cabin]" class="form-control">
													<option value="economyclass">Economy</option>
													<option value="premiumeconomyclass">Premium Economy</option>
													<option value="businessclass">Business</option>
													<option value="firstclass">First</option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Fare Type</label>
												<select name="flight[faretype]" class="form-control">
													<option value="">Select</option>
													<option value="refundable">Refundable</option>
													<option value="partialrefundable">Partial-refundable</option>
													<option value="non-refundable">Non-refundable</option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight Duration</label>
												<!--<input type="text" name="flight[duration]" class="form-control" placeholder="i.e. 3h 30m">-->
												<div class="clearfix"></div>
												<select name="flight[duration]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Hours</option>
													@for($i=1;$i<=24;$i++)
													<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[dmins]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Minutes</option>
													@for($i=1;$i<=59;$i++)
													<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<!--<input type="text" name="flight[baggage]" class="form-control">-->
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kg">0 Kg</option>
													<option value="5 Kgs">5 Kgs</option>
													<option value="7 Kgs">7 Kgs</option>
												</select>
												<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
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
													<option value="1 Pc">1 Piece</option>
													<option value="2 Pcs">2 Pieces</option>
												</select>
											</div>
											<!--Return Flight-->
											<div class="col-md-12 border-top1 padding-top10">
												<p class="pfwmt appendBottom10">RETURN FLIGHT</p>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Return Date</label>
													<input type="text" name="flight[downwarddate]" class="form-control datepickers" @if(array_key_exists('downwarddate',$flight)) @if($flight['downwarddate']!="") value="{{$flight['downwarddate']}}" @endif @endif placeholder="Select return date" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Airline Name</label>
												<!--<input type="text" name="flight[dname]" class="form-control down_filght" @if($flight['dname']!="") value="{{$flight['dname']}}" @endif>-->
												<select name="flight[dname]" class="form-control down_filght">
													<option value="0">Select Airline</option>
													<option value=""></option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight No.</label>
													<input type="text" name="flight[dno]" class="form-control down_no" @if($flight['dno']!="") value="{{$flight['dno']}}" @endif placeholder="e.g. 334" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>No. Of Stop</label>
												<!--<input type="text" name="flight[dnumberstop]" class="form-control" @if($flight['dnumberstop']!="") value="{{$flight['dnumberstop']}}" @endif>-->
												<select name="flight[dnumberstop]" class="form-control">
													<option value="0">Select Stopover</option>
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
											<div class="col-md-3 appendBottom20">
												<label>Flight Origin</label>
												<!--<input type="text" name="flight[dOrigin]" class="form-control down_origin" @if($flight['dOrigin']!="") value="{{$flight['dOrigin']}}" @endif>-->
												<select name="flight[dOrigin]" class="form-control down_origin">
													<option value="0">Select Origin</option>
													<option value=""></option>
												 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Departure Time</label>
												<!--<input type="text" name="flight[ddtime]" class="form-control" @if($flight['ddtime']!="") value="{{$flight['ddtime']}}" @endif>-->
												<div class="clearfix"></div>
												<select name="flight[ddhours]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Hours</option>
													@for($i=1;$i<=24;$i++)
													  <option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[ddmins]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Minutes</option>
													@for($i=1;$i<=60;$i++)
														<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Destination</label>
												<!--<input type="text" name="flight[ddest]" class="form-control down_dest" @if($flight['ddest']!="") value="{{$flight['ddest']}}" @endif>-->
												<select name="flight[ddest]" class="form-control down_dest">
													<option value="0">Select Destination</option>
													<option value=""></option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Arrival Time</label>
												<!--<input type="text" name="flight[datime]" class="form-control" @if($flight['datime']!="") value="{{$flight['datime']}}" @endif>-->
												<div class="clearfix"></div>
												<select name="flight[ahours]" class="form-control" style="padding: 5px;max-width: 32%;display: inline-block;">
													<option value="0">Hours</option>
													@for($i=1;$i<=24;$i++)
														<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[amins]" class="form-control" style="padding: 5px;max-width: 37%;display: inline-block;">
													<option value="0">Minutes</option>
													@for($i=1;$i<=60;$i++)
														<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[adayplus]" class="form-control" style="padding: 0px;max-width: 28%;display: inline-block;">
													<option value="0">+ Day</option>
													<option value="1">+1</option>
													<option value="2">+2</option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin Class</label>
												<select name="flight[cabin]" class="form-control">
													<option value="economyclass">Economy</option>
													<option value="premiumeconomyclass">Premium Economy</option>
													<option value="businessclass">Business</option>
													<option value="firstclass">First</option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Fare Type</label>
												<select name="flight[faretype]" class="form-control">
													<option value="">Select</option>
													<option value="refundable">Refundable</option>
													<option value="partialrefundable">Partial-refundable</option>
													<option value="non-refundable">Non-refundable</option>
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight Duration</label>
												<!--<input type="text" name="flight[duration]" class="form-control" placeholder="i.e. 3h 30m">-->
												<div class="clearfix"></div>
												<select name="flight[ddhours]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Hours</option>
													@for($i=1;$i<=24;$i++)
														<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[ddmins]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Minutes</option>
													@for($i=1;$i<=60;$i++)
														<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<!--<input type="text" name="flight[baggage]" class="form-control">-->
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kgs">0 Kgs</option>
													<option value="5 Kgs">5 Kgs</option>
													<option value="7 Kgs">7 Kgs</option>
												</select>
												<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kgs">0 Kgs</option>
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
													<option value="50 Kgs">1 Piece</option>
													<option value="50 Kgs">2 Pieces</option>
												</select>
											</div>
									</div>
								</div>
								@else
									<div class="col-md-12">
									   <div class="oflight">
										  <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{$reference_data->option3_transport_description}}</textarea>
										  <br>
									   </div>
									</div>
									<div class="flight">
										<!--Onward Flight-->
										<div class="col-md-12 border-top1 padding-top10" style="border-radius: 23px">
											<p class="pfwmt appendBottom10">UPWARD FLIGHT</p>
										</div>
											<div class="col-md-3 appendBottom20">
												<label>Onward Date</label>
													<input type="text" name="flight[onwarddate]" class="form-control datepickers" placeholder="Select departure date" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Airline Name</label>
													<!--<input type="text" name="flight[name]" class="form-control flight_name">-->
													<select name="flight[name]" class="form-control flight_name">
														<option value="0">Select Airline</option>
														<option value=""> </option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight No.</label>
													<input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>No. Of Stop</label>
													<!--<input type="text" name="flight[numberstop]" class="form-control">-->
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
											<div class="col-md-3 appendBottom20">
												<label>Flight Origin</label>
													<!--<input type="text" name="flight[Origin]" class="form-control flight_origin">-->
													<select name="flight[dest]" class="form-control">
														<option value="0">Select Origin</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Departure Time</label>
													<!--<input type="text" name="flight[dtime]" class="form-control">-->
													<div class="clearfix"></div>
													<select name="flight[dhours]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Hours</option>
														@for($i=1;$i<=24;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[dmins]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Minutes</option>
														@for($i=1;$i<=60;$i++)
															<option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Destination</label>
													<!--<input type="text" name="flight[dest]" class="form-control flight_dest">-->
													<select name="flight[dest]" class="form-control">
														<option value="0">Select Destination</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Arrival Time</label>
													<!--<input type="text" name="flight[atime]" class="form-control">-->
													<div class="clearfix"></div>
														<select name="flight[ahours]" class="form-control" style="padding: 5px;max-width: 32%;display: inline-block;">
															<option value="0">Hours</option>
															@for($i=1;$i<=24;$i++)
															  <option value="{{ $i }}">{{ $i }}</option>
															@endfor;
														</select>
														<select name="flight[amins]" class="form-control" style="padding: 5px;max-width: 37%;display: inline-block;">
															<option value="0">Minutes</option>
															@for($i=1;$i<=60;$i++)
															  <option value="{{ $i }}">{{ $i }}</option>
															@endfor;
														</select>
														<select name="flight[adayplus]" class="form-control" style="padding: 0px;max-width: 28%;display: inline-block;">
															<option value="0">+ Day</option>
															<option value="1">+1 Day</option>
															<option value="2">+2 Day</option>
														</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin Class</label>
													<select name="flight[cabin]" class="form-control">
														<option value="economyclass">Economy</option>
														<option value="premiumeconomyclass">Premium Economy</option>
														<option value="businessclass">Business</option>
														<option value="firstclass">First</option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Fare Type</label>
													<select name="flight[faretype]" class="form-control">
														<option value="">Select</option>
														<option value="refundable">Refundable</option>
														<option value="partialrefundable">Partial-refundable</option>
														<option value="non-refundable">Non-refundable</option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight Duration</label>
												<!--<input type="text" name="flight[duration]" class="form-control" placeholder="i.e. 3h 30m">-->
												<div class="clearfix"></div>
												<select name="flight[duration]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Hours</option>
													@for($i=1;$i<=24;$i++)
													<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
												<select name="flight[dmins]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0">Minutes</option>
													@for($i=1;$i<=59;$i++)
													<option value="{{ $i }}">{{ $i }}</option>
													@endfor;
												</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<!--<input type="text" name="flight[baggage]" class="form-control">-->
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kg">0 Kg</option>
													<option value="5 Kgs">5 Kgs</option>
													<option value="7 Kgs">7 Kgs</option>
												</select>
												<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
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
													<option value="1 Pc">1 Piece</option>
													<option value="2 Pcs">2 Pieces</option>
												</select>
											</div>
											<!--Return Flight-->
											<div class="col-md-12 border-top1 padding-top10" style="border-radius: 23px">
												<p class="pfwmt appendBottom10">RETURN FLIGHT</p>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Return Date</label>
													<input type="text" name="flight[downwarddate]" class="form-control datepickers" placeholder="Select return date" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Airline Name</label>
													<!--<input type="text" name="flight[dname]" class="form-control down_filght">-->
													<select name="flight[dname]" class="form-control down_filght">
														<option value="0">Select Airline</option>
														<option value=""></option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Flight No.</label>
													<input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334" />
											</div>
											<div class="col-md-3 appendBottom20">
												<label>No. Of Stop</label>
													<!--<input type="text" name="flight[dnumberstop]" class="form-control">-->
													<select name="flight[dnumberstop]" class="form-control">
														<option value="0">Select Stopover</option>
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
											<div class="col-md-3 appendBottom20">
												<label>Flight Origin</label>
													<!--<input type="text" name="flight[dOrigin]" class="form-control down_origin">-->
													<select name="flight[dOrigin]" class="form-control down_origin">
														<option value="0">Select Origin</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Departure Time</label>
													<!--<input type="text" name="flight[ddtime]" class="form-control">-->
													<div class="clearfix"></div>
													<select name="flight[ddhours]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Hours</option>
														@for($i=1;$i<=24;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[ddmins]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Minutes</option>
														@for($i=1;$i<=60;$i++)
															<option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Destination</label>
													<!--<input type="text" name="flight[ddest]" class="form-control down_dest">-->
													<select name="flight[ddest]" class="form-control down_dest">
														<option value="0">Select Destination</option>
														<option value=""></option>
													 </select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Arrival Time</label>
													<!--<input type="text" name="flight[datime]" class="form-control">-->
													<div class="clearfix"></div>
														<select name="flight[ahours]" class="form-control" style="padding: 5px;max-width: 32%;display: inline-block;">
															<option value="0">Hours</option>
															@for($i=1;$i<=24;$i++)
															  <option value="{{ $i }}">{{ $i }}</option>
															@endfor;
														</select>
														<select name="flight[amins]" class="form-control" style="padding: 5px;max-width: 37%;display: inline-block;">
															<option value="0">Minutes</option>
															@for($i=1;$i<=60;$i++)
															  <option value="{{ $i }}">{{ $i }}</option>
															@endfor;
														</select>
														<select name="flight[adayplus]" class="form-control" style="padding: 0px;max-width: 28%;display: inline-block;">
															<option value="0">+ Day</option>
															<option value="1">+1</option>
															<option value="2">+2</option>
														</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin Class</label>
													<select name="flight[cabin]" class="form-control">
														<option value="economyclass">Economy</option>
														<option value="premiumeconomyclass">Premium Economy</option>
														<option value="businessclass">Business</option>
														<option value="firstclass">First</option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Fare Type</label>
													<select name="flight[faretype]" class="form-control">
														<option value="">Select</option>
														<option value="refundable">Refundable</option>
														<option value="partialrefundable">Partial-refundable</option>
														<option value="non-refundable">Non-refundable</option>
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
											  <label>Flight Duration</label>
											  <!--<input type="text" name="flight[duration]" class="form-control" placeholder="i.e. 3h 30m">-->
											  <div class="clearfix"></div>
													<select name="flight[ddhours]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Hours</option>
														@for($i=1;$i<=24;$i++)
														  <option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
													<select name="flight[ddmins]" class="form-control" style="max-width: 49%;display: inline-block;">
														<option value="0">Minutes</option>
														@for($i=1;$i<=60;$i++)
															<option value="{{ $i }}">{{ $i }}</option>
														@endfor;
													</select>
											</div>
											<div class="col-md-3 appendBottom20">
												<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
												<!--<input type="text" name="flight[baggage]" class="form-control">-->
												<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kgs">0 Kgs</option>
													<option value="5 Kgs">5 Kgs</option>
													<option value="7 Kgs">7 Kgs</option>
												</select>
												<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
													<option value="0 Kgs">0 Kgs</option>
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
													<option value="50 Kgs">1 Piece</option>
													<option value="50 Kgs">2 Pieces</option>
												</select>
											</div>
									</div>
									@endif
							</div>
						</div>
					</div>
				</div>
				<!--Tour Transfers-->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#tourtransfers"><i class="fa fa-bus" aria-hidden="true"></i> Transfers (Car, Bus, Train)</a>
						</h4>
					</div>
					<div id="tourtransfers" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Transfers</label>
										<select name="transport"  class="form-control transport">
											<option value="0">Select Transfers</option>
											@foreach($transport as $trans)  
											<option value="{{ $trans->name }}" @if($trans->name==$reference_data->option3_transport) selected @endif>{{$trans->name}}</option>
											@endforeach
										</select>
									</div>
									@if($reference_data->option3_transport=="Flight")
										<div class="oflight">
											<textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{ old('transport_description') }}</textarea>
											<br>
										</div>
									@else
									   <div class="oflight">
										  <textarea class="form-control" placeholder="Tour Transfer Details..." name="transport_description" id="" cols="30" rows="5">{{$reference_data->option3_transport_description}}</textarea>
										  <br>
									   </div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
					<!--Tour Overview-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#touroverview"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Tour Overview (Tour Description & Highlights)</a>
							</h4>
						</div>
						<div id="touroverview" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">                          
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Add Description</label>
											<br>
											<span class="show_hide color8cff font-weight600">More+</span>
											<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="5" >{!! $reference_data->option3_description !!}</textarea>
										</div>
										<div class="form-group">
											<label for="">Add Tour Highlights</label>
											<br>
											<span class="show_hide color8cff font-weight600">More+</span>
											<textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5" >{!! $reference_data->option3_highlights !!}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>    
					<!--Tour Inclusions & Exclusions-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#tourinclusionsexclusions"><i class="fa fa-plus-circle" aria-hidden="true"></i> Inclusions & Exclusions <span class="requiredcolor">*</span></a>
							</h4>
						</div>
						<div id="tourinclusionsexclusions" class="panel-collapse collapse">
							<div class="panel-body c_body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group select-container">
											<label >What your tour price includes?</label>
											<br>
											<span class="show_hide color8cff font-weight600">More+</span>
											<textarea class="form-control ckeditor" name="inclusions" id="" cols="30" rows="5">{!! $reference_data->option3_inclusions !!}</textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group ">
											<label >What your tour price does not include?</label>
											<br>
											<span class="show_hide color8cff font-weight600">More+</span>
											<textarea class="form-control ckeditor" name="exclusions" id="" cols="30" rows="5">{!! $reference_data->option3_exclusions !!}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Tour Itinerary-->
					<?php $option3_dayItinerary=unserialize($reference_data->option3_dayItinerary); ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#touritinerary"><i class="fa fa-map-marker" aria-hidden="true"></i> Tour Itinerary</a>
							</h4>
						</div>
						<div id="touritinerary" class="panel-collapse collapse">
							<div class="panel-body c_body">
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											@for($j=1;$j<=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT);$j++)
											<div class="col-md-12 day1">
												<div class="form-group font-weight600">DAY {{$j}}
													<div class="appendTop5">
														<input type="text" name="dayItinerary[day{{$j}}][title]" class="border1 borderradius3 appendTop5" style="width: 100%;height: 30px;padding: 0 10px;" placeholder="Day Title" @if($option3_dayItinerary!="" && array_key_exists("day$j",$option3_dayItinerary)) value="{{$option3_dayItinerary["day$j"]["title"]}}" @endif>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="color4a">Add day description</label>
													<br>
													<span class="show_hide color8cff font-weight600">More+</span>
													<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]">
													@if($option3_dayItinerary!="" && array_key_exists("day$j",$option3_dayItinerary)) {!! $option3_dayItinerary["day$j"]["desc"] !!} @endif
													</textarea>
												</div>
												<div class="border-bottom1 appendtop10 appendBottom10"></div>
											</div>
											@endfor
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Tour Policy-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#tourpolicy"><i class="fa fa-info-circle" aria-hidden="true"></i></span> Tour Policies (Visa, Booking, Cancellation & Important Notes)</a>
							</h4>
						</div>
						<div id="tourpolicy" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<h4>Terms & Conditions</h4>
										<div class="form-group">
											<label for="">Is Visa Required?</label>
												<input type="checkbox" name="visa" value="1" id="visa" class="visa" "@if($reference_data->option3_visa=="1") checked @endif />
										</div>
										<div class="visa_pol" @if($reference_data->option3_visa=="1") style="display:block" @endif>
											<h5>Visa Terms & Policies</h5>
											<table class="table table-bordered" id="dynamic_field">
												<tbody>
													<tr>
														<td style="width: 60%;">
														<div>
															<?php $option3_package_visa=unserialize($reference_data->option3_package_visa); ?>
															<select name="package_visa[]" class="select2 form-control" multiple>
																@foreach($visaPolicy as $pol)
																	<option value="{{$pol->id}}" @if($option3_package_visa!="" && in_array("$pol->id",$option3_package_visa)) selected @endif>{{$pol->policy}}</option>
																@endforeach
															</select>
														</div>
														</td>
													</tr>
													<tr>
														<td>
															<span class="show_hides color8cff font-weight600">More+</span>
															<br>
															<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text">{{$reference_data->option3_visa_policies}}</textarea>
															<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<h5>Payment Terms & Methods</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td style="width: 60%;">
														<div>
															<?php $option3_package_payment=unserialize($reference_data->option3_package_payment); ?>
															<select name="package_payment[]"  class="select2 form-control" multiple>
															@foreach($paymentPolicy as $pol)
															<option value="{{$pol->id}}" @if($option3_package_payment!="" && in_array("$pol->id",$option3_package_payment)) selected @endif >{{$pol->policy}}</option>
															@endforeach
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides color8cff font-weight600">More+</span>
														<br>
														<textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text">{{$reference_data->option3_payment_policies}}</textarea>
														<!-- <input type="hidden" name="payment_policies" id="payment_policies_input" value=""/>-->
													</td>
												</tr>
											</tbody>
										</table>
										<h5>Cancellation & Refund Policy</h5>
										<table class="table table-bordered" id="dynamic_field">
											<tbody>
												<tr>
													<td style="width: 60%;">
														<div>
															<?php $option3_package_can=unserialize($reference_data->option3_package_can); ?>
															<select name="package_can[]" class="select2 form-control" multiple>
															@foreach($cancelPolicy as $pol)
															<option value="{{$pol->id}}" @if($option3_package_can!="" && in_array("$pol->id",$option3_package_can)) selected @endif >{{$pol->policy}}</option>
															@endforeach
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides color8cff font-weight600">More+</span>
														<br>
														<textarea name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control hide_text"></textarea><!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
													</td>
												</tr>
											</tbody>
										</table>
										<!---->
										<h5>Important Notes</h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td style="width: 60%;">
														<div>
															<?php $option3_package_impnotes=unserialize($reference_data->option3_package_impnotes); ?>
															<select name="package_impnotes[]" class="select2 form-control" multiple>
															@foreach($imp_notes as $pol)
															<option value="{{$pol->id}}">{{$pol->policy}} </option>
															@endforeach
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<td>
														<span class="show_hides color8cff font-weight600">More+</span>
														<br>
														<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control hide_text">{{$reference_data->option3_extra_imp}}</textarea>
														<!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Tour Quote Validity-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#tourquotevalidity"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Quote Validity</a>
							</h4>
						</div>
						<div id="tourquotevalidity" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">                               
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Quote Validity</label>
												<input type="text" class="datepickers" name="validaty" value="{{$reference_data->option3_validaty}}">>
										</div>
										<br>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Greetings & Signature-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#greetingsandsignature"><i class="fa fa-user" aria-hidden="true"></i></span>  Greetings & Signature <span class="requiredcolor">*</span></a>
							</h4>
						</div>
						<div id="greetingsandsignature" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<h5>Header <span class="requiredcolor">*</span></h5>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>
														<label for="" class="color4a">Email header <span class="requiredcolor">*</span></label>
														<br>
														<span class="show_hide color8cff font-weight600">More+</span>
														<br>
														<textarea name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor">{!! $reference_data->option3_quotation_header_extra !!}</textarea>
														<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
													</td>
												</tr>
												<tr>
													<td style="width: 60%;">
														<label for="" class="color4a">Web header <span class="requiredcolor">*</span></label>
														<br>
														<div>
															<?php $option3_quotation_header=unserialize($reference_data->option3_quotation_header); ?>
															<select name="quotation_header[]" class="select2 form-control" multiple>
															@foreach($quotation_header as $pol)
															<option value="{{$pol->id}}" @if($option3_quotation_header!="" && in_array("$pol->id",$option3_quotation_header)) selected @endif >{{$pol->header}}</option>
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
														<label for="" class="color4a">Email footer <span class="requiredcolor">*</span></label>
														<br>
														<span class="show_hide color8cff font-weight600">More+</span>
														<br>
														<textarea name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor">{!! $reference_data->option3_quotation_footer_extra !!}</textarea>
														<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
													</td>
												</tr>
												<tr>
													<td style="width: 60%;">
														<label for="" class="color4a">Web footer <span class="requiredcolor">*</span></label>
														<br>
														<div>
															<?php $option3_quotation_footer=unserialize($reference_data->option3_quotation_footer); ?>
															<select name="quotation_footer[]" class="select2 form-control" multiple>
															@foreach($quotation_footer as $pol)
															<option value="{{$pol->id}}" @if($option3_quotation_footer!="" && in_array("$pol->id",$option3_quotation_footer)) selected @endif>{{$pol->footer}}</option>
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
				</div>
				<div class="makeflex" style="justify-content: center">
					<div class="text-center borderradius3" style="padding: 10px 30px;background: #f9f9f9;display: inline-block;margin-right: 10px">
						<label class="radio-inline pfwmt"><input type="radio" value="1" name="send_option" checked>Save & Preview</label>
					</div>
					<div class="text-center" style="padding: 10px 30px;background: #f9f9f9;display: inline-block">
						<label class="radio-inline"><input type="radio" value="0" name="send_option">Save & Send</label>
					</div>
				</div>
				<br>
				<div class="text-center">
					<button type="submit" name="add" id="remove" class="btnblue font-weight600 location_add" style="width: 30%;height: 30px">SAVE</button>
				</div>
		</form>
	</div>  
</div>