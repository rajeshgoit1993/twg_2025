<style type="text/css">
	
	.cke_chrome
	{
		display: none;
	}
</style>
<div class="tab-pane active"  id="option1">
<div class="col-md-12">
<form action="{{URL::to('/copy_option1')}}" method="post" id="quo1" name="quo1">
<input type="hidden" name="custom_id" value="{{$custom_id}}"/>
<input type="hidden" name="copy_reference" value="{{$reference_data->id}}"/>
<input type="hidden" name="query_id" value="{{$data->id}}"/>
{{csrf_field()}} 
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Info"><span class="glyphicon glyphicon-file">
</span> Guest Info</a>
</h4>
</div>
<div id="Info" class="panel-collapse collapse in">
<div class="panel-body">
<!--<div class="row">
<div class="col-md-2">
<p>Quotaion Reference No.</p>
</div>
<div class="col-md-4">
<input type="text" class="form-control" name="" readonly="" placeholder="Quotaion Reference No.">  
</div>
</div>-->

<div class="row">
<div class="col-md-4">
<label>Leading Guest Name</label>
<input type="text" class="form-control" name="guest_name" readonly="" placeholder="Mr., Ms., Mrs., Blank" value="{{$data->name}}"> 
</div>


<div class="col-md-4">
<label>Contact No</label>
<input type="text" class="form-control" name="guest_no" readonly="" value="{{$data->mobile}}" placeholder="Contact No"> 
</div>
<div class="col-md-4">
<label>Email Address</label>
<input type="text" class="form-control" name="guest_email" value="{{$data->email}}" readonly="" placeholder="Email Address"> 
</div>
<div class="col-md-4">

</div>
</div>
<div class="row">
<div class="col-md-4">
<label>Package Name</label>
<input type="text" class="form-control" name="package_name" readonly="" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name"> 
</div>
<div class="col-md-4">
<label>Package Destination</label>
<input type="text" class="form-control" value="{{$data->destinations}}" name="destination" readonly="" placeholder="Package Destination"> 
</div>
<div class="col-md-4">
<label>Package Duration</label>
<?php

 $day_night=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
       

?>
<input type="hidden" name="duration" value="{{$day_night}}">
<input type="text" class="form-control" value="{{$day_night-1}} Nights & {{$day_night}} Days" name="" readonly="" placeholder="Package Destination"> 
</div>
</div>

<div class="row">
<div class="col-md-4">
<label>No of Adults (+12 yrs)</label>
<input type="text" class="form-control" name="adult" value="{{$data->span_value_adult}}" readonly="" placeholder="No of Adults (+12 yrs)"> 
</div>
<div class="col-md-4">
<label>No of Child (5-12 yrs)</label>
<input type="text" class="form-control" name="child" value="{{$data->span_value_child}}" readonly="" placeholder="No of Child (5-12 yrs)"> 
</div>
<div class="col-md-4">
<label>No of Child (0-5 yrs)</label>
<input type="text" class="form-control" name="infant" value="{{$data->span_value_infant}}" readonly="" placeholder="No of Child (0-5 yrs)"> 
</div>
</div>

<div class="row">
<div class="col-md-4">
<label>Nationality</label>
<input type="text" class="form-control" name="nationality" value="{{$data->country_of_residence}}" readonly="" placeholder="Nationality"> 
</div>
<div class="col-md-4">
<label>Best time to Call</label>
<input type="text" class="form-control" name="best_time_call" value="{{$data->time_call}}" readonly="" placeholder="Best time to Call"> 
</div>
<div class="col-md-4">
<label>Arrival Date</label>
<input type="text" class="form-control" name="" value="{{$data->date_arrival}}" readonly="" placeholder="Arrival Date">
</div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Package Name</label>
<input type="text" class="form-control" name="custom_package_name" placeholder="Package Name" value="{{$reference_data->custom_package_name}}"> 
</div>
<div class="col-md-4">
<label>Source</label>
<input type="text" class="form-control" name="source" placeholder="Source" value="{{$reference_data->source}}"> 
</div>
<div class="col-md-4">
<label>Remarks</label>
<input type="text" class="form-control" name="admin_remarks" placeholder="Remarks..." value="{{$reference_data->admin_remarks}}"> 
</div>
</div>

</div>           
</div>


</div>

<!---->
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#package_service"><span class="glyphicon glyphicon-th-list">
</span> Package Services</a>
</h4>
</div>
<div id="package_service" class="panel-collapse collapse">
<div class="panel-body">
<label for="package_location">Services</label>
<div class="input-group" style="margin-bottom:5px;">
<span class="input-group-addon">
<i class="fa fa-map-marker"></i>
</span>                                     

<select name="package_service[]" id="package_service" class="form-control select2" multiple>
@if(count($icons)>0)
<?php 
$package_service=unserialize($reference_data->package_service);
?>
@if($package_service!="")
@foreach($icons as $icon)
<option value="{{$icon->icon_title}}" @if(in_array($icon->icon_title,$package_service) ) selected="selected" @endif>{{$icon->icon_title}}  </option>
@endforeach  
@else
@foreach($icons as $icon)
<option value="{{$icon->icon_title}}">{{$icon->icon_title}}  </option>
@endforeach  

@endif  
@else
<option value="No Result Found">No Result Found</option>

@endif

</select>

</div>


</div>
</div>
</div>
<!---->
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Description"><span class="glyphicon glyphicon-th-list">
</span> Pricing</a>
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
  <input type="text" name="anything" class="form-control" placeholder=" write anything like price per person / for all travelling passengers..." >  
</td>
<td class="anything">
  <!--<input type="text" name="anything" class="form-control" placeholder=" write anything like price per person / for all travelling passengers..." >-->
	<select class="form-control" name="anything">
		<option value="pricetaxinclusive" selected>Price inclusive of all taxes</option>
	</select>
</td>

<td class="remarks">
  <input type="text" name="remarks" class="form-control" 
  placeholder="Remarks ..." >  
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
<!--Cruise End-->
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

<!---->
<?php

$option1_accommodation=unserialize($reference_data->accommodation);
if($reference_data->accommodation!='')
{

$option1_accommodation_count=count($option1_accommodation);

?>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Accommodation"><span class="glyphicon glyphicon-th-list">
</span> Accommodation</a>
</h4>
</div>
<div id="Accommodation" class="panel-collapse collapse">
<div class="panel-body">

<?php
$days=$data->duration;
$days=(int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
$days=$days-1;
?>


<div class="dynamic_acc">
<input type="hidden" name="duration" value="{{$day_night}}">
@for($j=0;$j<$option1_accommodation_count;$j++)
@if($j>0)
<hr>
 @endif
 
<div class="field{{$j}}" id="{{$j}}">
<div class="row">
<div class="col-md-4">

<label>Select Days</label>

<select class="form-control select_day select2" multiple name="accommodation[{{$j}}][day][]">
@for($i=1;$i<=$days;$i++)
<option value="Day {{$i}}" @if($option1_accommodation!="" && array_key_exists("day",$option1_accommodation[$j])  && in_array("Day $i",$option1_accommodation[$j]["day"])) selected @endif>  Day {{$i}}</option>  
@endfor

</select>


</div>  
<div class="col-md-4">

<label>city</label>

<input type="text" name="accommodation[{{$j}}][city]" class="form-control query_city" placeholder="City" value="{{$option1_accommodation[$j]["city"]}}">





</div>  
<div class="col-md-4">

<label>Choose Hotel Manually or from TripAdvisor</label>

<select class="form-control" name="accommodation[{{$j}}][trip]">
<option value='0'  disabled='disabled'>--Select--</option>
<option value="Manually" @if($option1_accommodation[$j]["trip"]=="Manually") selected @endif>Manually</option>  
<option value="TripAdvisor" @if($option1_accommodation[$j]["trip"]=="TripAdvisor") selected @endif>TripAdvisor</option>  
</select>


</div>  
<div class="col-md-4">

<label>Choose Hotel</label>
<?php
$query_data=CustomHelpers::get_quotation_hotel($option1_accommodation[$j]["city"]);

?>
<select class="form-control quo_hotel" name="accommodation[{{$j}}][hotel]">
 <option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>
 @foreach($query_data as $single)
 <option value='{{$single->id}}' @if($option1_accommodation!="" && array_key_exists("hotel",$option1_accommodation[$j]) && $single->id==$option1_accommodation[$j]["hotel"])  selected @endif>{{$single->hotelname}} </option>
 @endforeach                  
<option value="other" @if($option1_accommodation!="" && array_key_exists("hotel",$option1_accommodation[$j]) &&$option1_accommodation[$j]["hotel"]=="other")  selected @endif>Other</option>
</select>


</div> 
@if($option1_accommodation!="" && array_key_exists("hotel",$option1_accommodation[$j]) && $option1_accommodation[$j]["hotel"]=="other")
<div class="col-md-4 other_hotel" style="display: block;">
<label>Enter Hotel</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][other_hotel]" placeholder="Hotel Name" value="{{$option1_accommodation[$j]["other_hotel"]}}">
</div>

@else
<div class="col-md-4 other_hotel" style="display: none;">
<label>Enter Hotel</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][other_hotel]" placeholder="Hotel Name">
</div>

@endif

<div class="col-md-4 add_star">

<label>Choose Star Rating</label>

<select class="form-control quo_star" name="accommodation[{{$j}}][star]">
<option value='0'  disabled='disabled'>--Select--</option>
@if($option1_accommodation!="" && array_key_exists("star",$option1_accommodation[$j]) && $option1_accommodation[$j]["star"]!="" && $option1_accommodation[$j]["star"]!="other")
<option value="{{$option1_accommodation[$j]["star"]}}" selected>{{$option1_accommodation[$j]["star"]}}</option>
@elseif($option1_accommodation!="" && array_key_exists("star",$option1_accommodation[$j]) && $option1_accommodation[$j]["star"]!="" && $option1_accommodation[$j]["star"]=="other")
<option value="other" selected>Other</option>
@endif

</select>


</div> 

@if($option1_accommodation!="" && array_key_exists("star",$option1_accommodation[$j]) &&$option1_accommodation[$j]["star"]=="other")
<div class="col-md-4 other_star" style="display: block;">
<label>Enter Star Rating</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" placeholder="Hotel Star Rating" value="{{$option1_accommodation[$j]["star_other"]}}">
</div>
@else
<div class="col-md-4 other_star" style="display: none;">
<label>Enter Star Rating</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" value="{{$option1_accommodation[$j]["star_other"]}}" placeholder="Hotel Star Rating">
</div>

@endif

<div class="col-md-4">

<label>Room Category</label>
<input type="text" class="form-control" name="accommodation[{{$j}}][category]" placeholder="Room Category" value="{{$option1_accommodation[$j]["category"]}}">




</div> 

<div class="col-md-4">
  <label>Hotel Website Link</label>
  <input type="text" class="form-control" name="accommodation[{{$j}}][hotel_link]" placeholder="Hotel Website Link" @if($option1_accommodation!="" && array_key_exists("hotel_link",$option1_accommodation[$j])) 

 value="{{$option1_accommodation[$j]["hotel_link"]}}"  @endif>

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
<button type="button" name="add" id="add_acco" days="{{$days}}" class="btn btn-success">Add More
</button> 
</div>
</div>
<br>

</div>
</div>
</div>
<?php 
    
}
else
{
  ?>
  <div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Accommodation"><span class="glyphicon glyphicon-th-list">
</span> Accommodation</a>
</h4>
</div>
<div id="Accommodation" class="panel-collapse collapse">
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
<button type="button" name="add" id="add_acco" days="{{$days}}" class="btn btn-success">Add More
</button> 
</div>
</div>
<br>

</div>
</div>
</div>
  <?php  
}

?>
<!---->
<div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#Transport"><span class="glyphicon glyphicon-th-list">
    </span> Transport</a>
    </h4>
    </div>
    <div id="Transport" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row">
                                      
   <div class="col-md-12">
    

    <div class="form-group">
    <label for="">Transport</label>
    <select name="transport"  class="form-control transport" id="transport">
    <option value="0">--Choose Transport--</option>
            @foreach($transport as $trans)  
    <option value="{{ $trans->name }}" 
      @if($trans->name==$reference_data->transport) selected @endif>{{$trans->name}}</option>
            @endforeach   
    </select> 

    </div>
 </div>
   @if($reference_data->transport=="Flight")
    <div class="col-md-12">
   <div class="oflight" style="display: none;">
      <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">
    {{ old('transport_description') }}</textarea>
          <br>

   </div>
    </div> 
    <?php
     $flight=unserialize($reference_data->transport);
    
    ?>   
    <div class="flight" style="display: block;">
      <div class="col-md-12"><h4>Onward Flight</h4></div>
      <div class="col-md-3">
      <label>Flight Name</label>
      <input type="text" name="flight[name]" class="form-control flight_name" @if($flight['name']!="") value="{{ $flight['name'] }}" @endif>
      </div>
      <div class="col-md-3">
        <label>Flight No.</label>
         <input type="text" name="flight[no]" class="form-control flight_no" @if($flight['no']!="") value="{{$flight['no']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[numberstop]" class="form-control" @if($flight['numberstop']!="") value="{{$flight['numberstop']}}" @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Onward Date</label>
         <input type="text" name="flight[onwarddate]" class="form-control datepickers" @if(array_key_exists('onwarddate',$flight)) @if($flight['onwarddate']!="") value="{{$flight['onwarddate']}}" @endif @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[Origin]" class="form-control flight_origin" @if($flight['Origin']!="") value="{{$flight['Origin']}}" @endif> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[dtime]" class="form-control" @if($flight['dtime']!="") value="{{$flight['dtime']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[dest]" class="form-control flight_dest" @if($flight['dest']!="") value="{{$flight['dest']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[atime]" class="form-control" @if($flight['atime']!="") value="{{$flight['atime']}}" @endif>
      <br>
      </div>
    <!---->
    <div class="col-md-12" style="border-top:1px solid darkgray;
    margin-bottom: 14px;
    border-radius: 23px;"><h4>Return Flight</h4></div>
    <div class="col-md-3">
      <label>Flight Name</label>
      <input type="text" name="flight[dname]" class="form-control down_filght" @if($flight['dname']!="") value="{{$flight['dname']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>Flight No.</label>
         <input type="text" name="flight[dno]" class="form-control down_no" @if($flight['dno']!="") value="{{$flight['dno']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[dnumberstop]" class="form-control" @if($flight['dnumberstop']!="") value="{{$flight['dnumberstop']}}" @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Return Date</label>
         <input type="text" name="flight[downwarddate]" class="form-control datepickers" @if(array_key_exists('downwarddate',$flight)) @if($flight['downwarddate']!="") value="{{$flight['downwarddate']}}" @endif @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[dOrigin]" class="form-control down_origin" @if($flight['dOrigin']!="") value="{{$flight['dOrigin']}}" @endif> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[ddtime]" class="form-control" @if($flight['ddtime']!="") value="{{$flight['ddtime']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[ddest]" class="form-control down_dest" @if($flight['ddest']!="") value="{{$flight['ddest']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[datime]" class="form-control" @if($flight['datime']!="") value="{{$flight['datime']}}" @endif>
      <br>
      </div>
    </div>
    
   @else
<div class="col-md-12">
   <div class="oflight">
      <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{$reference_data->transport_description}}
    </textarea>
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
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[numberstop]" class="form-control">
         <br>
      </div>
       <div class="col-md-3">
        <label>Onward Date</label>
         <input type="text" name="flight[onwarddate]" class="form-control datepickers">
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[Origin]" class="form-control flight_origin"> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[dtime]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[dest]" class="form-control flight_dest">
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[atime]" class="form-control">
      <br>
      </div>
    <!---->
    <div class="col-md-12" style="border-top:1px solid darkgray;
    margin-bottom: 14px;
    border-radius: 23px;"><h4>Return Flight</h4></div>
    <div class="col-md-3">
      <label>Flight Name</label>
      <input type="text" name="flight[dname]" class="form-control down_filght">
      </div>
      <div class="col-md-3">
        <label>Flight No.</label>
         <input type="text" name="flight[dno]" class="form-control down_no">
      </div>
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[dnumberstop]" class="form-control">
         <br>
      </div>
      <div class="col-md-3">
        <label>Return Date</label>
         <input type="text" name="flight[downwarddate]" class="form-control datepickers">
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[dOrigin]" class="form-control down_origin"> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[ddtime]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[ddest]" class="form-control down_dest">
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[datime]" class="form-control">
      <br>
      </div>
    </div>
    
   @endif
      

              
    
   
    </div>
   
    </div>
    </div>
    </div>
<!---->
 <div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#pac_Description"><span class="glyphicon glyphicon-th-list">
    </span> Package Description</a>
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
    <textarea class="form-control ckeditor"  
    name="description" id="" cols="30" rows="5" >{!! $reference_data->description !!}</textarea>
    </div>
    <div class="form-group">
    <label for="">Tour Highlights</label>
        <br>
    <span class="show_hide">More+</span>
    <textarea class="form-control ckeditor"  
    name="highlights" id="" cols="30" rows="5" >{!! $reference_data->highlights !!}</textarea>
    </div>
    
    
          <br>
    </div>  
    
              
    
   
    </div>
   
    </div>
    </div>
    </div>

    
<!---->
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Inclusions"><span class="glyphicon glyphicon-th-list">
</span> Inclusions & Exclusions</a>
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
<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">
{!! $reference_data->inclusions !!}</textarea>

</div>
</div>
<div class="col-md-12">
<div class=" form-group ">
<label >What your tour price does not include?</label>
    <br>
    <span class="show_hide">More+</span>
<textarea class="form-control ckeditor"  name="exclusions" id="" cols="30" rows="5">
{!! $reference_data->exclusions !!}
</textarea>

</div>
</div>                 
</div>
</div>

</div>
</div>

<!---->
<?php

$option1_dayItinerary=unserialize($reference_data->day_itinerary);
?>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Itinerary"><span class="glyphicon glyphicon-th-list">
</span> Tour Itinerary</a>
</h4>
</div>
<div id="Itinerary" class="panel-collapse collapse">
<div class="panel-body c_body">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">

<?php

 $days=(int)filter_var($data->duration, FILTER_SANITIZE_NUMBER_INT);
      

?>

@for($j=1;$j<=$days;$j++)
<div class="col-md-12 dayItinerary day1" >


<div class="form-group">
Day {{$j}} : 
<input type="text" name="dayItinerary[day{{$j}}][title]" style="height: 35px;width: 95%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;" placeholder="Day Title" @if($option1_dayItinerary!="" && array_key_exists("day$j",$option1_dayItinerary)) value="{{$option1_dayItinerary["day$j"]["title"]}}" @endif>  
</div> 


<div class="form-group">
<label for="">Description</label>
    <br>
    <span class="show_hide">More+</span>
<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]" >
@if($option1_dayItinerary!="" && array_key_exists("day$j",$option1_dayItinerary)) {!! $option1_dayItinerary["day$j"]["desc"] !!} @endif
</textarea>
</div>
</div>


@endfor




</div>
</div>                   
</div>
</div>

</div>
</div>

<!---->

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Policies"><span class="glyphicon glyphicon-th-list">
</span> Policies</a>
</h4>
</div>
<div id="Policies" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-md-12">
<h4>Terms & Conditions   </h4>


<div class="form-group">
<label for="">Is Visa Required?</label>
<input type="checkbox" name="visa" value="1" id="" class="visa"@if($reference_data->visa=="1") checked @endif/>
</div>

<div class="visa_pol" @if($reference_data->visa=="1") style="display:block" @endif>

<h5>Visa Terms & Policies</h5>

<table class="table table-bordered" id="dynamic_field">
<tbody>
<tr>
<td style="width: 60%;">
<div>
  <?php
$option1_package_visa=unserialize($reference_data->visa_p);
  ?>
<select name="package_visa[]"  class="select2 form-control" multiple>

@foreach($visaPolicy as $pol)
<option value="{{$pol->id}}" @if($option1_package_visa!="" && in_array("$pol->id",$option1_package_visa)) selected @endif>{{$pol->policy}} </option>

@endforeach



</select>







</div>
</td>
</tr>
<tr>                                         
<td>
    <span class="show_hides">More+</span>
    <br>
<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control hide_text">
  {{$reference_data->option1_visa_policies}}
</textarea>
<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
</td>
</tr>
</tbody>
</table>
</div>

<h5>Payment Terms & Methods </h5>

<table class="table table-bordered" >
<tbody>
<tr>
<td style="width: 60%;"> <div>
<?php
$option1_package_payment=unserialize($reference_data->payment_p);
  ?>
<select name="package_payment[]"  class="select2 form-control" multiple>
@foreach($paymentPolicy as $pol)
<option value="{{$pol->id}}" @if($option1_package_payment!="" && in_array("$pol->id",$option1_package_payment)) selected @endif >{{$pol->policy}} </option>

@endforeach
<select>



</div>
</td>
</tr>
<tr>                                           
<td>
     <span class="show_hides">More+</span>
    <br>
<textarea  name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control hide_text">
  {{$reference_data->option1_payment_policies}}
</textarea>
<!-- <input type="hidden" name="payment_policies" id="payment_policies_input" value=""/>-->
</td>
</tr>
</tbody>
</table>
<h5>Cancellation & Refund Policy
</h5>
<table class="table table-bordered" id="dynamic_field">
<tbody>
<tr>
<td style="width: 60%;">
<div>
<?php
$option1_package_can=unserialize($reference_data->can_p);
  ?>
<select name="package_can[]"  class="select2 form-control" multiple>
@foreach($cancelPolicy as $pol)
<option value="{{$pol->id}}" @if($option1_package_can!="" && in_array("$pol->id",$option1_package_can)) selected @endif >{{$pol->policy}} </option>

@endforeach
<select>





</div>
</td>
</tr>
<tr> 
<td>
     <span class="show_hides">More+</span>
    <br>
<textarea  name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control hide_text">
  {{$reference_data->option1_cancellation}}
</textarea>                                             

<!--<input type="hidden" name="cancellation" id="cancellation_input_field" value=""/>-->
</td>
</tr>
</tbody>
</table>

<!---->
<h5>Important Notes
</h5>
<table class="table table-bordered" >
<tbody>
<tr>
<td style="width: 60%;">
<div>
<?php
$option1_package_impnotes=unserialize($reference_data->imp_notes);
  ?>
<select name="package_impnotes[]"  class="select2 form-control" multiple>
@foreach($imp_notes as $pol)
<option value="{{$pol->id}}" @if($option1_package_impnotes!="" && in_array("$pol->id",$option1_package_impnotes)) selected @endif>{{$pol->policy}} </option>

@endforeach
<select>





</div>
</td>
</tr>
<tr> 
<td>
     <span class="show_hides">More+</span>
    <br>
<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control hide_text">
  {{$reference_data->option1_extra_imp}}
</textarea>                                             

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

<!---->
<div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#Validity"><span class="glyphicon glyphicon-th-list">
    </span> Quote Validity</a>
    </h4>
    </div>
    <div id="Validity" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row">
                                      
    <div class="col-md-12">
    <div class="form-group">
    <label for="">Quote Validity</label>
   <input type="text" class="datepickers" name="validaty" value="{{$reference_data->option1_validaty}}">
    </div>
    
    
          <br>
    </div>  
    
              
    
   
    </div>
   
    </div>
    </div>
    </div>
    <!---->
    <div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion" href="#Welcome"><span class="glyphicon glyphicon-th-list">
    </span> Welcome Greetings </a>
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
  <?php
$option1_quotation_header=unserialize($reference_data->option1_quotation_header);
  ?>
<select name="quotation_header[]"  class="select2 form-control" multiple>

@foreach($quotation_header as $pol)
<option value="{{$pol->id}}" @if($option1_quotation_header!="" && in_array("$pol->id",$option1_quotation_header)) selected @endif >{{$pol->header}} </option>

@endforeach



</select>







</div>
</td>
</tr>
<tr>                                         
<td>
    <span class="show_hide">More+</span>
    <br>
<textarea  name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor">{!! $reference_data->option1_quotation_header_extra !!} </textarea>

<textarea  name="quotation_footer_extras" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor">
   {!! $reference_data->option1_quotation_footer_extra !!}
</textarea>


<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
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
  <?php
$option1_quotation_footer=unserialize($reference_data->option1_quotation_footer);
  ?>
<select name="quotation_footer[]"  class="select2 form-control" multiple>

@foreach($quotation_footer as $pol)
<option value="{{$pol->id}}" @if($option1_quotation_footer!="" && in_array("$pol->id",$option1_quotation_footer)) selected @endif>{{$pol->footer}} </option>

@endforeach



</select>







</div>
</td>
</tr>
<tr>                                         
<td>
    <span class="show_hide">More+</span>
    <br>
<textarea  name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control ckeditor">
   {!! $reference_data->option1_quotation_footer_extra !!}
</textarea>
<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
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

<button type="submit" name="add" id="remove" class="btn btn-danger btn-lg location_add">Save
<i class="fa  fa-arrow-right"></i>

</button>
</div>
</form>
</div>  
</div>