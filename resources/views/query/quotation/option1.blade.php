<style type="text/css">
.cke_chrome {
display: none;
}

</style>

<div class="tab-pane active" id="option1" >
<div class="col-md-12">
<form action="{{ URL::to('/option1') }}" method="post" id="quo1" name="quo1">
<input type="hidden" name="type" value=""/>
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
<input type="text" class="form-control text-capitalize" name="" value="{{$data->message}}" readonly="" placeholder="Nationality"> 
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
<input type="text" class="form-control" name="custom_package_name" placeholder="Enter Package Name" value="@if(is_numeric($data->packageId)) {{CustomHelpers::get_package_name($data->packageId)}} @endif"> 
</div>
<div class="col-md-4 appendBottom10">
<label for="source">Departure City <span class="requiredcolor">*</span></label>
<input type="text" class="form-control" name="source" placeholder="Enter Departure City"> 
</div>
<div class="col-md-4 appendBottom10">
<label for="admin_remarks">User Remarks</label>
<input type="text" class="form-control" name="admin_remarks" placeholder="Remarks..."> 
</div>
<!---->
     <div class="col-md-6 form-group">
     <label for="package_location">Services Included</label>
                               <div class="input-group" style="margin-bottom:5px;">
                                    <span class="input-group-addon">
                                      <i class="fa fa-map-marker"></i>
                                    </span>

                                    <select name="package_service[]" id="" class="form-control select2" multiple>
                                      @if(count($icons)>0)

                                      @foreach($icons as $icon)
                                      <option value="{{$icon->icon_title}}">{{$icon->icon_title}} </option>
                                      @endforeach

                                      @else
                                      <option value="No Result Found">No Result Found</option>

                                      @endif

                                    </select>

                                  </div>

                                </div>
<!---->
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
<option value="Per Person">Per Person</option>
<option value="Group Price">Group Price</option>
</select>
</td>
<td class="anything"><input type="text" name="anything" class="form-control" placeholder="Price per person (inclusive of GST) or all travelling passengers..." ></td>
<td class="remarks"><input type="text" name="remarks" class="form-control" placeholder="Remarks ..." ></td>
<!-- <td class="noofrooms">
<select class="form-control select_room" name="remarks">
<option value="">Select Room</option>
@for($i=1;$i<=10;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor

</select>
</td> -->
<td>
<span>  

<button type="button" class="btn btn-success get_room"> Add/Edit Rooms </button>
</span>

</td>
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
</select>
<input type="text" class="form-control quote1_rate number_test" name="" placeholder="Rate" style="background: #f9f9f9;padding: 5px;color: #4a4a4a;width: 50%">

</div>
<div class="makeflex" style="margin-bottom: 3px">
<input type="text" class="form-control quote1_value number_test" name="" placeholder="Enter" style="padding: 5px;color: #4a4a4a;width: 50%">
<input type="text" class="form-control quote1_total number_test" name="" placeholder="Value" style="padding: 5px;color: #4a4a4a;width: 50%">
</div>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Conversion</p>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">ADULT</p>
<p class="pfwmt text-center" style="font-size: 12px;">(TWIN SHARING)</p>
<div class="text-center">
<input type="hidden" id="travellers" name="quote1_number_of_adult" class="quote1_number_of_adult quote1_adult_room_value" value="2" />
<i class="glyphicon glyphicon-minus quote1_adult_room_dec font-size14" style="border: none;color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="quote1_adult_room_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">2</span>
<i class="glyphicon glyphicon-plus quote1_adult_room_inc  font-size14" style="border: none;color: #9B9B9B;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
</div>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">EXTRA ADULT</p>
<div class="text-center">
<input type="hidden" id="travellers" name="extra_adult" class="quote1_number_of_extra_adult quote1_child_extra_adult_value" value="0" />
<i class="glyphicon glyphicon-minus quote1_child_extra_adult_dec" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="quote1_child_extra_adult_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
<i class="glyphicon glyphicon-plus quote1_child_extra_adult_inc" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
</div>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">CHILD</p>
<p class="pfwmt text-center" style="font-size: 12px;">(WITH BED)</p>
<div class="text-center">
<input type="hidden" id="travellers" name="child_with_bed" class="quote1_number_of_child_with_bed quote1_child_with_bed_value" value="0" />
<i class="glyphicon glyphicon-minus quote1_child_with_bed_dec" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="quote1_child_with_bed_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
<i class="glyphicon glyphicon-plus quote1_child_with_bed_inc" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Child (2-12yrs)</p>
</div>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">CHILD</p>
<p class="pfwmt text-center" style="font-size: 12px;">(WITHOUT BED)</p>
<div class="text-center">
<input type="hidden" id="travellers" name="child_without_bed" class="quote1_number_of_child_without_bed quote1_childwithoutbed_value" value="0" />
<i class="glyphicon glyphicon-minus quote1_childwithoutbed_dec" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="span_value_childwithoutbed quote1_span_value_childwithoutbed_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
<i class="glyphicon glyphicon-plus quote1_childwithoutbed_inc" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Child (2-12yrs)</p>
</div>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">INFANT</p>
<div class="text-center">
<input type="hidden" id="travellers" name="infant" class="quote1_number_of_infant quote1_infant_value" value="0" />
<i class="glyphicon glyphicon-minus quote1_infant_dec" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="quote1_infant_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
<i class="glyphicon glyphicon-plus quote1_infant_inc" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Infant (0-2yrs)</p>
</div>
</th>
<th class="minwidth135">
<p class="pfwmt text-center" style="font-size: 13px;">SOLO<br>TRAVELLER</p>
<div class="text-center">
<input type="hidden" id="travellers" name="solo_traveller" class="quote1_number_solo_traveller quote1_solo_value" value="0" />
<i class="glyphicon glyphicon-minus quote1_solo_dec" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<span class="quote1_solo_result" style="border: none;color: #008CFF;font-size: 20px;font-weight: 900;padding: 12px">0</span>
<i class="glyphicon glyphicon-plus quote1_solo_inc" style="border: none;color: #9B9B9B;font-size: 14px;padding: 12px;position: unset;" aria-hidden="true"></i>
<p class="text-center" style="padding: 1px;background: #f2f2f2;color: #4a4a4a;font-size: 12px;border-radius: 3px;">Adult ( + 12yrs)</p>
</div>
</th>
</thead>
<tbody>
<tr>
<td>Airfare</td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="airfare">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="airfare_remarks" id="remarks_airfare" value="">
<!--<select class="form-control query_air_curr" name="price[query_air_curr]">
@foreach($rates as $rate)
<option value="{{ $rate-> id}}" c_val="{{$rate->rate}}">{{ $rate-> currency }}</option>
@endforeach
</select>
<select class="form-control">
<option>INR</option>
</select>-->
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_air_adult adult_disable" name="price[query_air_adult]"></td>
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
<!-- <select class="form-control minwidth100">
<option value="0">Select</option>
<option value="1">A</option>
</select> -->
<select class="form-control minwidth100 supplier" id="cruise_fare">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="cruise_fare_remarks" id="remarks_cruise_fare" value="">

<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_cruise_adult adult_disable" name="price[query_cruise_adult]"></td>
<td><input type="text" class="form-control number_test quote1_cruise_exadult exadult_disable" name="price[query_cruise_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_cruise_childbed childbed_disable" name="price[query_cruise_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruise_childwbed childwbed_disable" name="price[query_cruise_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruise_infant infant_disable" name="price[query_cruise_infant]"></td>
<td><input type="text" class="form-control number_test quote1_cruise_single single_disable" name="price[query_cruise_single]"></td>
</tr>
<tr>
<td>Port Charges </td>
<td class="makeflex">

<select class="form-control minwidth100 supplier" id="port_charge_fare" name="price[port_charge_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[port_charge_fare_remarks]" id="remarks_port_charge_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_cruiseport_adult adult_disable" name="price[query_cruiseport_adult]"></td>
<td><input type="text" class="form-control number_test quote1_cruiseport_exadult exadult_disable" name="price[query_cruiseport_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_cruiseport_childbed childbed_disable" name="price[query_cruiseport_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruiseport_childwbed childwbed_disable" name="price[query_cruiseport_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruiseport_infant infant_disable" name="price[query_cruiseport_infant]"></td>
<td><input type="text" class="form-control number_test quote1_cruiseport_single single_disable" name="price[query_cruiseport_single]"></td>
</tr>
<tr>
<td>Gratuity</td>
<td class="makeflex">

<select class="form-control minwidth100 supplier" id="gratuity_fare" name="price[gratuity_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[gratuity_remarks]" id="remarks_gratuity_fare" value="">

<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_adult adult_disable" name="price[query_cruisegratuity_adult]"></td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_exadult exadult_disable" name="price[query_cruisegratuity_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_childbed childbed_disable" name="price[query_cruisegratuity_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_childwbed childwbed_disable" name="price[query_cruisegratuity_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_infant infant_disable" name="price[query_cruisegratuity_infant]"></td>
<td><input type="text" class="form-control number_test quote1_cruisegratuity_single single_disable" name="price[query_cruisegratuity_single]"></td>
</tr>
<tr>
<td>Cruise GST </td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="cruise_gst_fare" name="price[cruise_gst_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[cruise_gst_fare_remarks]" id="remarks_cruise_gst_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_cruisegst_adult adult_disable" name="price[query_cruisegst_adult]"></td>
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
<select class="form-control minwidth100 supplier" id="accommodation_fare" name="price[accommodation_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[accommodation_fare_remarks]" id="remarks_accommodation_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_hotel_adult adult_disable" name="price[query_hotel_adult]" id=""></td>
<td><input type="text" class="form-control number_test quote1_hotel_exadult exadult_disable" name="price[query_hotel_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_hotel_childbed childbed_disable" name="price[query_hotel_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_hotel_childwbed childwbed_disable" name="price[query_hotel_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_hotel_infant infant_disable" name="price[query_hotel_infant]"></td>
<td><input type="text" class="form-control number_test quote1_hotel_single single_disable" name="price[query_hotel_single]"></td>
</tr>
<tr>
<td>Sightseeing</td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="sightseeing_fare" name="price[sightseeing_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[sightseeing_fare_remarks]" id="remarks_sightseeing_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_tours_adult adult_disable" name="price[query_tours_adult]"></td>
<td><input type="text" class="form-control number_test quote1_tours_exadult exadult_disable" name="price[query_tours_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_tours_childbed childbed_disable" name="price[query_tours_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_tours_childwbed childwbed_disable" name="price[query_tours_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_tours_infant infant_disable" name="price[query_tours_infant]"></td>
<td><input type="text" class="form-control number_test quote1_tours_single single_disable" name="price[query_tours_single]"></td>
</tr>
<tr>
<td>Transfers</td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="transfers_fare" name="price[transfers_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[transfers_fare_remarks]" id="remarks_transfers_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_transfer_adult adult_disable" name="price[query_transfer_adult]"></td>
<td><input type="text" class="form-control number_test quote1_transfer_exadult exadult_disable" name="price[query_transfer_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_transfer_childbed childbed_disable" name="price[query_transfer_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_transfer_childwbed childwbed_disable" name="price[query_transfer_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_transfer_infant infant_disable" name="price[query_transfer_infant]"></td>
<td><input type="text" class="form-control number_test quote1_transfer_single single_disable" name="price[query_transfer_single]"></td>
</tr>
<tr>
<td>Visa Charges</td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="visa_charges_fare" name="price[visa_charges_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[visa_charges_fare_remarks]" id="remarks_visa_charges_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_visa_adult adult_disable" name="price[query_visa_adult]"></td>
<td><input type="text" class="form-control number_test quote1_visa_exadult exadult_disable" name="price[query_visa_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_visa_childbed childbed_disable" name="price[query_visa_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_visa_childwbed childwbed_disable" name="price[query_visa_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_visa_infant infant_disable" name="price[query_visa_infant]"></td>
<td><input type="text" class="form-control number_test quote1_visa_single single_disable" name="price[query_visa_single]"></td>
</tr>
<tr>
<td> Travel Insurance</td>
<td class="makeflex">
<select class="form-control minwidth100 supplier" id="travel_insurance_fare" name="price[travel_insurance_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[travel_insurance_fare_remarks]" id="remarks_travel_insurance_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_inc_adult adult_disable" name="price[query_inc_adult]"></td>
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
<select class="form-control minwidth100 supplier" id="meals_fare" name="price[meals_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[meals_fare_remarks]" id="remarks_meals_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_meals_adult adult_disable" name="price[query_meals_adult]"></td>
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
<select class="form-control minwidth100 supplier" id="addon_service_fare" name="price[addon_service_fare_supplier]">
<option value="0" select_name="0">Select</option>
@foreach($supplier as $suppliers)
<option value="{{$suppliers->id}}" select_name="{{$suppliers->suppliercompanyname}}">{{$suppliers->suppliercompanyname}}</option>
@endforeach
</select>
<input type="hidden" name="price[addon_service_fare_remarks]" id="remarks_addon_service_fare" value="">
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_additionalservice_adult adult_disable" name="price[query_additionalservice_adult]"></td>
<td><input type="text" class="form-control number_test quote1_additionalservice_exadult exadult_disable" name="price[query_additionalservice_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_additionalservice_childbed childbed_disable" name="price[query_additionalservice_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_additionalservice_childwbed childwbed_disable" name="price[query_additionalservice_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_additionalservice_infant infant_disable" name="price[query_additionalservice_infant]"></td>
<td><input type="text" class="form-control number_test quote1_additionalservice_single single_disable" name="price[query_additionalservice_single]"></td>
</tr>
<!--Additional Service End-->
<!--Total before Markup-->
<tr>
<td>Total</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
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
<td style="font-style: italic">Markup (Profit)</td>
<td class="makeflex">
<select class="form-control pricemarkup" name="pricemarkup" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<select class="form-control number_test markup_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
<option value="0">--Select--</option>
@foreach($markup_profit as $markup_pro)

<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
@endforeach
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
<select class="form-control pricediscountpositive" name="pricemarkup" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
<option value="3">Coupon</option>
</select>
<select class="form-control number_test discountpositive_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
<option value="0">--Select--</option>
@foreach($discunt_positive as $markup_pro)

<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
@endforeach
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
<tr>
<td style="font-weight: 600">Gross Total</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_gross_total_adult" name="price[query_total_adult]" readonly></td>
<td><input type="text" class="form-control number_test quote1_gross_total_exadult" name="price[query_total_exadult]" readonly></td>
<td><input type="text" class="form-control number_test quote1_gross_total_childbed" name="price[query_total_childbed]" readonly></td>
<td><input type="text" class="form-control number_test quote1_gross_total_childwbed" name="price[query_total_childwbed]" readonly></td>
<td><input type="text" class="form-control number_test quote1_gross_total_infant" name="price[query_total_infant]" readonly></td>
<td><input type="text" class="form-control number_test quote1_gross_total_single" name="price[query_total_single]" readonly></td>
</tr>
<!--Total Gross Total (Group)-->
<tr>
<td style="font-weight: 600">Gross Total (Group)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_gross_total_group" name="price[query_total_adult]" readonly></td>

</tr>
<!--Discount Minus-->
<tr>
<td>Discount (-)</td>
<td class="makeflex">
<select class="form-control pricediscountnegative" name="pricemarkup" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
<option value="3">Coupon</option>
</select>
<select class="form-control number_test discountnegative_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
<option value="0">--Select--</option>
@foreach($discunt_negative as $markup_pro)

<option value="{{$markup_pro->value}}">{{$markup_pro->value}}</option>
@endforeach
</select>


</td>
<td><input type="text" class="form-control number_test quote1_discount_adult_minus adult_disable" name="price[query_discount_adult]"></td>
<td><input type="text" class="form-control number_test quote1_discount_exadult_minus exadult_disable" name="price[query_discount_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_discount_childbed_minus childbed_disable" name="price[query_discount_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_discount_childwbed_minus childwbed_disable" name="price[query_discount_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_discount_infant_minus infant_disable" name="price[query_discount_infant]"></td>
<td><input type="text" class="form-control number_test quote1_discount_single_minus single_disable" name="price[query_discount_single]"></td>
</tr>
<!--Total Gross Total (Group)-->
<tr>
<td style="font-weight: 600">Discount (-) (Group)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_discount_group" name="price[query_total_adult]" readonly></td>

</tr>
<!--GST Starts-->
<tr>
<td style="font-style: italic">(+) GST</td>
<td class="makeflex">
<select class="form-control pricegst" name="price[query_gst_curr]" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<select class="form-control number_test gst_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
@foreach($gst as $gst)
<option value="0">--Select--</option>
<option value="{{$gst->value}}">{{$gst->value}}</option>
@endforeach
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
<tr>
<td style="font-weight: 600">GST (Group)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_gst_group" name="price[query_total_adult]" readonly></td>

</tr>
<!--Total after GST-->
<tr>
<td style="font-weight: 600">Total with GST</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
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
<td style="font-style: italic">(+) TCS</td>
<td class="makeflex">
<select class="form-control pricetcs" name="price[query_tcs_curr]" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<select class="form-control number_test tcs_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
@foreach($tcs as $tcs)
<option value="0">--Select--</option>
<option value="{{$tcs->value}}">{{$tcs->value}}</option>
@endforeach
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
<tr>
<td style="font-weight: 600">TCS (Group)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_tcs_group" name="price[query_total_adult]" readonly></td>

</tr>
<!--Total after TCS-->
<tr>
<td style="font-weight: 600">Total with TCS</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
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
<td style="font-style: italic">(+) PG Charges</td>
<td class="makeflex">
<select class="form-control pricepgcharges" name="price[pg_charges]" style="">
<option value="0">Select</option>
<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<select class="form-control number_test pgcharges_percentage" name="" style="padding: 5px;color: #4a4a4a;min-width: 60px;">
@foreach($pg as $pg)
<option value="0">--Select--</option>
<option value="{{$pg->value}}">{{$pg->value}}</option>
@endforeach
</select>

</td>
<td><input type="text" class="form-control number_test quote1_pgcharges_adult adult_disable" name="price[query_pgcharges_adult]"></td>
<td><input type="text" class="form-control number_test quote1_pgcharges_exadult exadult_disable" name="price[query_pgcharges_exadult]"></td>
<td><input type="text" class="form-control number_test quote1_pgcharges_childbed childbed_disable" name="price[query_pgcharges_childbed]"></td>
<td><input type="text" class="form-control number_test quote1_pgcharges_childwbed childwbed_disable" name="price[query_pgcharges_childwbed]"></td>
<td><input type="text" class="form-control number_test quote1_pgcharges_infant infant_disable" name="price[query_pgcharges_infant]"></td>
<td><input type="text" class="form-control number_test quote1_pgcharges_single single_disable" name="price[query_pgcharges_single]"></td>
</tr>
<!--PG Charges Ends-->
<!--Total PG (Group)-->
<tr>
<td style="font-weight: 600">PG (Group)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_pg_group" name="price[query_total_adult]" readonly></td>

</tr>

<!--Grand Total-->
<tr>
<td style="font-weight: 900">GRAND TOTAL</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
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
<td style="font-weight: 900">GRAND TOTAL(A/C to person)</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control number_test quote1_grand_adult_with_person" name="price[query_grand_adult]" readonly></td>
<td><input type="text" class="form-control number_test quote1_grand_exadult_with_person" name="price[query_grand_exadult]" readonly></td>
<td><input type="text" class="form-control number_test quote1_grand_childbed_with_person" name="price[query_grand_childbed]" readonly></td>
<td><input type="text" class="form-control number_test quote1_grand_childwbed_with_person " name="price[query_grand_childwbed]" readonly></td>
<td><input type="text" class="form-control number_test quote1_grand_infant_with_person" name="price[query_grand_infant]" readonly></td>
<td><input type="text" class="form-control number_test quote1_grand_single_with_person" name="price[query_grand_single]" readonly></td>
</tr>
<!--Price to Pay-->
<tr>
<td style="font-weight: 900">PRICE TO PAY</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control query_pricetopay quote1_pricetopay" name="price[query_pricetopay_adult]" readonly></td>

</tr>
<!---->
<tr>
<td colspan="8">
<div class="form-group">
<label for="">Is Installment  Required?</label>
<input type="checkbox" name="" value="1" id="show_part_payment">
</div>

</td>

</tr>

</tbody>
</table>
 <table class="table backend_custom_height part_payment">
 <tbody>
<!---->
<tr>
<td class="" style="font-weight: 900">Advance Payment</td>
<td class="makeflex">
<select class="form-control advance_payment" name="pricemarkup" style="">

<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<input type="text" name="" class="form-control number_test advance_payment_percentage" style="padding: 5px;color: #4a4a4a;min-width: 60px;">



</td>
<td><input type="text" class="form-control number_test quote1_advance_payment" name="price[quote1_advance_payment]">
<span id="quote1_advance_payment_error" style="color: red;"></span>
</td>
</tr>
<!---->
<tr class="">
<td style="font-weight: 900">1st Part Payment</td>
<td class="makeflex">
<select class="form-control first_part_payment" name="pricemarkup" style="">

<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<input type="text" name="" class="form-control number_test first_part_percentage" style="padding: 5px;color: #4a4a4a;min-width: 60px;">



</td>
<td><input type="text" class="form-control number_test quote1_first_part" name="price[quote1_first_part]">
<span id="quote1_first_part_error" style="color: red;"></span>
</td>
</tr>
<!---->
<tr class="">
<td style="font-weight: 900">2nd Part Payment</td>
<td class="makeflex">
<select class="form-control second_part_payment" name="pricemarkup" style="display: none;">

<option value="1">Fixed</option>
<option value="2">Percentage</option>
</select>
<input type="text" name="" class="form-control number_test second_part_percentage" style="padding: 5px;color: #4a4a4a;min-width: 60px;">



</td>
<td><input type="text" class="form-control number_test quote1_second_part" name="price[quote1_advance_payment]"></td>
</tr>
<!---->
<tr class="">
<td style="font-weight: 900">Total Payment</td>
<td>
<p class="pfwmt form-control text-center" style="padding: 2px;height: 25px;color: #4a4a4a;">INR</p>
</td>
<td><input type="text" class="form-control query_pricetopay quote1_total_payment" name="price[query_pricetopay_adult]" readonly></td>

</tr>
<!---->

 </tbody>
</table>
<table class="table backend_custom_height ">
<tr>
<td>
<div class="form-group">
<label for="">Direct Pay (per person, not included in price) ?</label>
<input type="checkbox" name="" value="1" id="show_direct_part">
</div>
</td>

</tr>

</table>

<table class="table backend_custom_height direct_part">
 <tbody>
 
<tr>


<td>
<select class="form-control " name="pricemarkup" style="">
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
<td><input type="text" class="form-control" name="price[quote1_advance_payment]" value="Fixed"></td>

<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="INR"></td>
<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="2000"></td>
</tr>
<!---->
<tr>


<td>
<select class="form-control " name="pricemarkup" style="">
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
<td><input type="text" class="form-control" name="price[quote1_advance_payment]" value="Fixed"></td>

<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="INR"></td>
<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="2000"></td>
</tr>
<!---->
<tr>


<td>
<select class="form-control " name="pricemarkup" style="">
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
<td><input type="text" class="form-control" name="price[quote1_advance_payment]" value="Fixed"></td>

<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="INR"></td>
<td><input type="text" class="form-control number_test" name="price[quote1_advance_payment]" value="2000"></td>
</tr>
<!---->
 </tbody>
</table>
</div>
</div>
<!--Tour Accommodation-->
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
<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}" >
<div class="field0" id="0">
<div class="row">
<div class="col-md-6 appendBottom10">
<label>Select Days</label>
<select class="form-control select_day select2" name="accommodation[0][day][]" multiple>
@for($i=1;$i<=$days;$i++)
<option value="Day {{$i}}">Day{{$i}}</option>
@endfor
</select>
</div>  
<div class="col-md-3 appendBottom10 quote_city_class">
<label>City</label>
<input type="text" name="accommodation[0][city]" class="form-control text-capitalize quote_city" placeholder="Enter city name" />
</div>
<div class="col-md-3 propertytype_class">
<div class="form-group">
<label for="propertytype">Accommodation Type <span class="requiredcolor">*</span></label>
<select class="form-control propertytype" name="propertytype" id="propertytype">
<option selected disabled>Select</option>
<option value="hotel">Hotel</option>
<option value="resort">Resort</option>
<option value="villa">Villa</option>
<option value="home">Home</option>
<option value="camp">Camp</option>
<option value="cruise">Cruise</option>
</select>
</div>
</div>

<div class="col-md-4 appendBottom10 propertysource_class">
<label>Accommodation Source</label>
<select class="form-control propertysource" name="accommodation[0][trip]" id="propertysource">
<option selected disabled>Select</option>
<option value="packagehoteldatabase">Package Hotel Database</option>
<option value="hoteldatabase">Hotel Database</option>
<option value="tripadvisor">TripAdvisor</option>
<option value="manual">Manual</option>
</select>
</div>  
<div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" style="display: none">
<label>Property Name</label>
<select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
<option value='0' selected='true' disabled='disabled'>Select</option>
<!--<option value="other">Unlisted Property</option>-->
</select>
</div>
<!--<div class="col-md-4 appendBottom10 add_star">-->
<div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: none">
<label>Star Rating</label>
<select class="form-control selectpropertystar_value" name="accommodation[0][star]">
<option selected disabled>Select</option>
<option value="1">1 star</option>
<option value="2">2 star</option>
<option value="3">3 star</option>
<option value="4">4 star</option>
<option value="5">5 star</option>
<!--<option value="other">Other</option>-->
</select>
</div>

<div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: none">
<label>Enter Property</label>
<input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
</div>

<div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
<label>Enter Star Rating</label>
<!--<input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Enter hotel star rating">-->
<select class="form-control" name="accommodation[0][star_other]" id="">
<option selected disabled>Select</option>
<option value='1'>1 star</option>
<option value='2'>2 star</option>
<option value='3'>3 star</option>
<option value='4'>4 star</option>
<option value='5'>5 star</option>
</select>
</div>
<div class="col-md-12"></div>
<div class="col-md-4 appendBottom10">
<label>Room Type</label>
<input type="text" class="form-control text-capitalize" name="accommodation[0][category]" placeholder="Enter room type">
</div> 
<div class="col-md-4 hotel_link_class">
<label>Hotel Website</label>
<input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
</div>
<div class="col-md-4 hotel_contact_class">
<label>Hotel Contact No</label>
<input type="text" class="form-control text-capitalize hotel_contact" name="" placeholder="Enter hotel contact no">
</div>
</div>
</div>
<!---->


<!---->
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
<label for="">Is Flight Required?</label>
<input type="checkbox" name="flight[show_flight_options]" value="flight[show_flight_options]" id="show_flight_options">
</div>
<!--<div class="form-group">
<label for="">Transport</label>
<select name="transport" id="transport" class="form-control">
<option value="0">--Choose Transport--</option>
@foreach($transport as $trans)
<option value="{{ $trans->name }}">{{$trans->name}}</option>
@endforeach
</select>
</div>-->
<!--<div class="oflight">
<textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">
{{ old('transport_description') }}</textarea>
<br>
</div>-->
</div>
<div class="flight" style="display: none;">
<!--Onward Flight-->
<div class="col-md-12 border-top1 padding-top10" style="border-radius: 23px">
<p class="pfwmt appendBottom10">UPWARD FLIGHT</p>
</div>
<div class="col-md-3 appendBottom20">
	<label>Onward Date</label>
		<input type="text" name="flight[onwarddate]" class="form-control datepickers" placeholder="Select departure date">
</div>
<div class="col-md-3 appendBottom20">
	<label>Airline Name</label>
		<!--<input type="text" name="flight[name]" class="form-control flight_name">-->
		<select name="flight[name]" class="form-control flight_name">
			<option value="0">Select Airline</option>
			@foreach($airlines as $airline)
<option value="{{$airline->airline_name}}">{{$airline->airline_name}} </option>
@endforeach
		</select>
</div>
<div class="col-md-3 appendBottom20">
	<label>Flight No.</label>
		<input type="text" name="flight[no]" class="form-control flight_no" placeholder="e.g. 333">
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
			@foreach($iatalist as $iata)
<option value="{{$iata->iata_name}} ({{$iata->iata_code}})">{{$iata->iata_name}} ({{$iata->iata_code}}) </option>
@endforeach
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
			@foreach($iatalist as $iata)
<option value="{{$iata->iata_name}} ({{$iata->iata_code}})">{{$iata->iata_name}} ({{$iata->iata_code}}) </option>
@endforeach
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
<div class="col-md-12 border-top1 padding-top10" style="border-radius: 23px">
	<p class="pfwmt appendBottom10">RETURN FLIGHT</p>
</div>
<div class="col-md-3 appendBottom20">
	<label>Return Date</label>
		<input type="text" name="flight[downwarddate]" class="form-control datepickers" placeholder="Select return date">
</div>
<div class="col-md-3 appendBottom20">
	<label>Airline Name</label>
		<!--<input type="text" name="flight[dname]" class="form-control down_filght">-->
		<select name="flight[dname]" class="form-control down_filght">
			<option value="0">Select Airline</option>
			@foreach($airlines as $airline)
<option value="{{$airline->airline_name}}">{{$airline->airline_name}} </option>
@endforeach
		</select>
</div>
<div class="col-md-3 appendBottom20">
	<label>Flight No.</label>
		<input type="text" name="flight[dno]" class="form-control down_no" placeholder="e.g. 334">
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
			@foreach($iatalist as $iata)
<option value="{{$iata->iata_name}} ({{$iata->iata_code}})">{{$iata->iata_name}} ({{$iata->iata_code}}) </option>
@endforeach
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
			@foreach($iatalist as $iata)
<option value="{{$iata->iata_name}} ({{$iata->iata_code}})">{{$iata->iata_name}} ({{$iata->iata_code}}) </option>
@endforeach
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
	<label>Fare Type</label>
		<select name="flight[faretype]" class="form-control">
			<option value="">Select</option>
			<option value="refundable">Refundable</option>
			<option value="partialrefundable">Partial-refundable</option>
			<option value="non-refundable">Non-refundable</option>
		</select>
</div>
<div class="col-md-3">
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
<div class="col-md-3">
	<label>Cabin & Check-In Baggage (in kgs & pcs)</label>
	<!--<input type="text" name="flight[baggage]" class="form-control">-->
	<select name="flight[baggage]" class="form-control" style="max-width: 49%;display: inline-block;">
		<option selected disabled>Cabin Bag</option>
		<option value="0 Kgs">0 Kgs</option>
		<option value="5 Kgs">5 Kgs</option>
		<option value="7 Kgs">7 Kgs</option>
	</select>
	<select name="flight[cbaggage]" class="form-control" style="max-width: 49%;display: inline-block;">
		<option selected disabled>Check-In Bag</option>
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
		<option value="1 piece">1 Piece</option>
		<option value="2 pieces">2 Pieces</option>
	</select>
</div>





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
<div class="col-md-12 transfers_input_wrapper">
<div class="row transfers_input" id="transfers_input-0" data-id="0">
<input type="hidden" name="" value="">
<div class="field-0" id="0">
<div class="form-group col-sm-3">
<label for="">Title</label>
<input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
</div>
<div class="col-md-3">
<div class="form-group">
<label for="">Select Transfer Mode</label>
<select name="transfers[0][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
<option value="">--Choose Transport--</option>
<option value="Car">Car</option>
<option value="Bus">Bus</option>
<option value="Train">Train</option>
</select>
</div>
</div>
<div class="form-group col-sm-3">
<label for="">Select Transfers</label>
<select name="transfers[0][transfers_type]" id="transfers_type0" class="form-control transfers_type">
<?php /*<option value="0">--Select Transfers--</option>
@foreach($transfers->unique('transfer_type') as $transfer)
<option value="{{$transfer->title}}">{{$transfer->title}} </option>
@endforeach*/ ?>
<option value="0">--Select Transfers--</option>
</select>
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
<label for="addonservices">Add-On Services (Room upgrade, Honeymoon freebies etc.)</label>
<br>
<span class="show_hide color8cff font-weight600">More+</span>
<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="5">{{ old('description') }}</textarea>
</div>
<div class="form-group">
<label for="">Add Tour Highlights</label>
<br>
<span class="show_hide color8cff font-weight600">More+</span>
<textarea class="form-control ckeditor" name="highlights" id="" cols="30" rows="5">{{ old('highlights') }}</textarea>
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

<select name="package_payment[]"  class="select2 form-control" multiple>
@foreach($inclusions as $pol)
<option value="{{$pol->id}}">{{$pol->name}} </option>
@endforeach
</select>
<br>
<br>
<span class="show_hide color8cff font-weight600">More+</span>
<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">{{ old('inclusions') }}</textarea>
</div>
</div>
<div class="col-md-12">
<div class=" form-group ">
<label >What your tour price does not include?</label>
<select name="package_payment[]"  class="select2 form-control" multiple>
@foreach($exclusions as $pol)
<option value="{{$pol->id}}">{{$pol->name}} </option>
@endforeach
</select>
<br>
<br>
<span class="show_hide color8cff font-weight600">More+</span>
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
<input type="text" name="dayItinerary[day{{$j}}][title]" class="border1 borderradius3" style="width: 100%;height: 30px;padding: 0 10px;" placeholder="Day Title">
</div>
</div>
<div class="form-group">
<label for="" class="color4a">Add day description</label>
<br>
<span class="show_hide color8cff font-weight600">More+</span>
<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]"></textarea>
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
<input type="checkbox" name="visa" value="1" id="visa" class="visa" />
</div>
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
<span class="show_hides color8cff font-weight600">More+</span>
<br>
<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text"></textarea>
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
<select name="package_payment[]"  class="select2 form-control" multiple>
@foreach($paymentPolicy as $pol)
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
<textarea name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text"></textarea>
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
<select name="package_can[]"  class="select2 form-control" multiple>
@foreach($cancelPolicy as $pol)
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
<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control hide_text"></textarea>
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
<input type="text" class="datepicker_s borderradius3 border1" name="validity" style="padding: 5px 10px;margin-left: 10px">
</div>
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
<textarea name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor"></textarea>
<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
</td>
</tr>
<tr>
<td style="width: 60%;">
<label for="" class="color4a">Web header <span class="requiredcolor">*</span></label>
<br>
<div>
<select name="quotation_header[]" class="select2 form-control" multiple>
@foreach($quotation_header as $pol)
<option value="{{$pol->id}}">{{$pol->header}} </option>
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
<textarea name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor"></textarea>
<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
</td>
</tr>
<tr>
<td style="width: 60%;">
<label for="" class="color4a">Web footer <span class="requiredcolor">*</span></label>
<br>
<div>
<select name="quotation_footer[]" class="select2 form-control" multiple>
@foreach($quotation_footer as $pol)
<option value="{{$pol->id}}">{{$pol->footer}} </option>
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
<!--No of Rooms-->
<!-- Modal -->

</div>