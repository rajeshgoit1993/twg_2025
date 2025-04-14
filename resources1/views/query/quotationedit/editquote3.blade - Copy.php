<style type="text/css">
	
	.cke_chrome
	{
		display: none;
	}
</style>

<div class="tab-pane"  id="option3">
<div class="col-md-12">
<form action="{{URL::to('/option3')}}" method="post" id="quo3" name="quo3">
<input type="hidden" name="custom_id" value="{{$custom_id}}"/>
<input type="hidden" name="query_id" value="{{$data->id}}"/>
<input type="hidden" name="quotation_ref_no" value="{{$custom_id}}"/>
{{csrf_field()}} 
<div class="panel-group" id="accordion3">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Info"><span class="glyphicon glyphicon-file">
</span> Guest Info</a>
</h4>
</div>
<div id="option3_Info" class="panel-collapse collapse in">
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

</div>
<div class="row">
<div class="col-md-4">
<label>Package Name</label>
@if(is_numeric($data->packageId))
<input type="text" class="form-control" name="package_name" readonly="" value="{{CustomHelpers::get_package_name($data->packageId)}}" placeholder="Package Name">  

@else

  <input type="text" class="form-control" name="package_name" readonly="" value="{{$data->packageId}}" placeholder="Package Name">  
 @endif

</div>
<div class="col-md-4">
<label>Package Destination</label>
<input type="text" class="form-control" value="{{$data->destinations}}" name="destination" readonly="" placeholder="Package Destination"> 
</div>
<div class="col-md-4">
<label>Package Duration</label>
<?php
$day_night=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT);
?>
<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}">
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
<input type="text" class="form-control" name="custom_package_name" placeholder="Package Name" value="{{$reference_data3->custom_package_name}}"> 
</div>
<div class="col-md-4">
<label>Source</label>
<input type="text" class="form-control" name="source" placeholder="Source" value="{{$reference_data3->source}}"> 
</div>
<div class="col-md-4">
<label>Remarks</label>
<input type="text" class="form-control" name="admin_remarks" placeholder="Remarks..." value="{{$reference_data3->admin_remarks}}"> 
</div>
</div>

</div>           
</div>


</div>

<!---->
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Description"><span class="glyphicon glyphicon-th-list">
</span> Pricing</a>
</h4>
</div>
<div id="option3_Description" class="panel-collapse collapse">
<table class="table" > 
<tr>
<td>Price Type</td>
<td>
<select class="form-control price_type" name="price_type" style="background: #08b2ed;color: #fff">
<option @if($reference_data3->option3_price_type=="Per Person") selected  @endif value="Per Person">Per Person</option>
<option @if($reference_data3->option3_price_type=="Group Price") selected  @endif value="Group Price">Group Price</option>
</select>
</td>
@if($reference_data3->anything!="")
<td  class="anything">
  <input type="text" name="anything" class="form-control" placeholder=" write anything like price per person / for all travelling passengers..." value="{{$reference_data3->anything}}">  
</td>
@else
<td  class="anything">
  <input type="text" name="anything" class="form-control" placeholder=" write anything like price per person / for all travelling passengers..." >  
</td>
@endif
<td class="remarks">
  <input type="text" name="remarks" class="form-control" 
  placeholder="Remarks ..."  value="{{$reference_data3->remarks}}">  
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
<?php
$option3_price=unserialize($reference_data3->option3_price);

?>
<select class="form-control query_air_curr" name="price[query_air_curr]">
 @foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_air_curr"]) selected  @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_air_adult" name="price[query_air_adult]" @if($option3_price["query_air_adult"]!="") value="{{$option3_price["query_air_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_air_exadult" name="price[query_air_exadult]" @if($option3_price["query_air_exadult"]!="") value="{{$option3_price["query_air_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_air_childbed" name="price[query_air_childbed]" @if($option3_price["query_air_childbed"]!="") value="{{$option3_price["query_air_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_air_childwbed" name="price[query_air_childwbed]" @if($option3_price["query_air_childwbed"]!="") value="{{$option3_price["query_air_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_air_infant" name="price[query_air_infant]" @if($option3_price["query_air_infant"]!="") value="{{$option3_price["query_air_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_air_single" name="price[query_air_single]" @if($option3_price["query_air_single"]!="") value="{{$option3_price["query_air_single"]}}"  @endif>
</td>
</tr>
<!--Cruise Start-->
<tr>
<td>Cruise </td>
<td>

<select class="form-control query_cruise_curr" name="price[query_cruise_curr]">
  @foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if(is_bool($option3_price)) @else @if(array_key_exists("query_cruise_curr",$option3_price))   @if($rate->id==$option3_price["query_cruise_curr"]) selected  @endif @endif @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
 
</select>
</td>
<td>

<input type="text" class="form-control query_cruise_adult" name="price[query_cruise_adult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_adult",$option3_price))  @if($option3_price["query_cruise_adult"]!="") value="{{$option3_price["query_cruise_adult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_cruise_exadult" name="price[query_cruise_exadult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_exadult",$option3_price))  @if($option3_price["query_cruise_exadult"]!="") value="{{$option3_price["query_cruise_exadult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_cruise_childbed" name="price[query_cruise_childbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_childbed",$option3_price))  @if($option3_price["query_cruise_childbed"]!="") value="{{$option3_price["query_cruise_childbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_cruise_childwbed" name="price[query_cruise_childwbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_childwbed",$option3_price))  @if($option3_price["query_cruise_childwbed"]!="") value="{{$option3_price["query_cruise_childwbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_cruise_infant" name="price[query_cruise_infant]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_infant",$option3_price))  @if($option3_price["query_cruise_infant"]!="") value="{{$option3_price["query_cruise_infant"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_cruise_single" name="price[query_cruise_single]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_cruise_single",$option3_price))  @if($option3_price["query_cruise_single"]!="") value="{{$option3_price["query_cruise_single"]}}"  @endif @endif @endif>
</td>
</tr>
<!--Cruise End-->
<tr>
<td>Hotel</td>
<td>
<select class="form-control query_hotel_curr" name="price[query_hotel_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_hotel_curr"]) selected  @endif c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_hotel_adult" name="price[query_hotel_adult]" @if($option3_price["query_hotel_adult"]!="") value="{{$option3_price["query_hotel_adult"]}}"  @endif id="option3_mandate">
</td>
<td>
<input type="text" class="form-control query_hotel_exadult" name="price[query_hotel_exadult]" @if($option3_price["query_hotel_exadult"]!="") value="{{$option3_price["query_hotel_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_hotel_childbed" name="price[query_hotel_childbed]" @if($option3_price["query_hotel_childbed"]!="") value="{{$option3_price["query_hotel_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_hotel_childwbed" name="price[query_hotel_childwbed]" @if($option3_price["query_hotel_childwbed"]!="") value="{{$option3_price["query_hotel_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_hotel_infant" name="price[query_hotel_infant]" @if($option3_price["query_hotel_infant"]!="") value="{{$option3_price["query_hotel_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_hotel_single" name="price[query_hotel_single]" @if($option3_price["query_hotel_single"]!="") value="{{$option3_price["query_hotel_single"]}}"  @endif>
</td>
</tr>
<tr>
<td>Tours</td>
<td>
<select class="form-control query_tours_curr" name="price[query_tours_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_tours_curr"]) selected  @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_tours_adult" name="price[query_tours_adult]" @if($option3_price["query_tours_adult"]!="") value="{{$option3_price["query_tours_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_tours_exadult" name="price[query_tours_exadult]" @if($option3_price["query_tours_exadult"]!="") value="{{$option3_price["query_tours_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_tours_childbed" name="price[query_tours_childbed]" @if($option3_price["query_tours_childbed"]!="") value="{{$option3_price["query_tours_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_tours_childwbed" name="price[query_tours_childwbed]" @if($option3_price["query_tours_childwbed"]!="") value="{{$option3_price["query_tours_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_tours_infant" name="price[query_tours_infant]" @if($option3_price["query_tours_infant"]!="") value="{{$option3_price["query_tours_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_tours_single" name="price[query_tours_single]" @if($option3_price["query_tours_single"]!="") value="{{$option3_price["query_tours_single"]}}"  @endif>
</td>
</tr>
<tr>
<td>Transfers</td>
<td>
<select class="form-control query_transfer_curr" name="price[query_transfer_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_transfer_curr"]) selected  @endif c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_transfer_adult" name="price[query_transfer_adult]" @if($option3_price["query_transfer_adult"]!="") value="{{$option3_price["query_transfer_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_transfer_exadult" name="price[query_transfer_exadult]" @if($option3_price["query_transfer_exadult"]!="") value="{{$option3_price["query_transfer_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_transfer_childbed" name="price[query_transfer_childbed]" @if($option3_price["query_transfer_childbed"]!="") value="{{$option3_price["query_transfer_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_transfer_childwbed" name="price[query_transfer_childwbed]" @if($option3_price["query_transfer_childwbed"]!="") value="{{$option3_price["query_transfer_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_transfer_infant" name="price[query_transfer_infant]" @if($option3_price["query_transfer_infant"]!="") value="{{$option3_price["query_transfer_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_transfer_single" name="price[query_transfer_single]" @if($option3_price["query_transfer_single"]!="") value="{{$option3_price["query_transfer_single"]}}"  @endif>
</td>
</tr>
<tr>
<td>Visa</td>
<td>
<select class="form-control query_visa_curr" name="price[query_visa_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_visa_curr"]) selected  @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_visa_adult" name="price[query_visa_adult]" @if($option3_price["query_visa_adult"]!="") value="{{$option3_price["query_visa_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_visa_exadult" name="price[query_visa_exadult]" @if($option3_price["query_visa_exadult"]!="") value="{{$option3_price["query_visa_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_visa_childbed" name="price[query_visa_childbed]" @if($option3_price["query_visa_childbed"]!="") value="{{$option3_price["query_visa_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_visa_childwbed" name="price[query_visa_childwbed]" @if($option3_price["query_visa_childwbed"]!="") value="{{$option3_price["query_visa_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_visa_infant" name="price[query_visa_infant]" @if($option3_price["query_visa_infant"]!="") value="{{$option3_price["query_visa_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_visa_single" name="price[query_visa_single]" @if($option3_price["query_visa_single"]!="") value="{{$option3_price["query_visa_single"]}}"  @endif>
</td>
</tr>
<tr>
<td> Travel Insurance</td>
<td>
<select class="form-control query_inc_curr" name="price[query_inc_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_inc_curr"]) selected  @endif c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_inc_adult" name="price[query_inc_adult]" @if($option3_price["query_inc_adult"]!="") value="{{$option3_price["query_inc_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_inc_exadult" name="price[query_inc_exadult]" @if($option3_price["query_inc_exadult"]!="") value="{{$option3_price["query_inc_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_inc_childbed" name="price[query_inc_childbed]" @if($option3_price["query_inc_childbed"]!="") value="{{$option3_price["query_inc_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_inc_childwbed" name="price[query_inc_childwbed]" @if($option3_price["query_inc_childwbed"]!="") value="{{$option3_price["query_inc_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_inc_infant" name="price[query_inc_infant]" @if($option3_price["query_inc_infant"]!="") value="{{$option3_price["query_inc_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_inc_single" name="price[query_inc_single]" @if($option3_price["query_inc_single"]!="") value="{{$option3_price["query_inc_single"]}}"  @endif>
</td>
</tr>
<!--Meals  Start-->
<tr>
<td>Meals Price </td>
<td>

<select class="form-control query_meals_curr" name="price[query_meals_curr]">
  @foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_curr",$option3_price))   @if($rate->id==$option3_price["query_meals_curr"]) selected  @endif @endif @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
 
</select>
</td>
<td>

<input type="text" class="form-control query_meals_adult" name="price[query_meals_adult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_adult",$option3_price))  @if($option3_price["query_meals_adult"]!="") value="{{$option3_price["query_meals_adult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_meals_exadult" name="price[query_meals_exadult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_exadult",$option3_price))  @if($option3_price["query_meals_exadult"]!="") value="{{$option3_price["query_meals_exadult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_meals_childbed" name="price[query_meals_childbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_childbed",$option3_price))  @if($option3_price["query_meals_childbed"]!="") value="{{$option3_price["query_meals_childbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_meals_childwbed" name="price[query_meals_childwbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_childwbed",$option3_price))  @if($option3_price["query_meals_childwbed"]!="") value="{{$option3_price["query_meals_childwbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_meals_infant" name="price[query_meals_infant]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_infant",$option3_price))  @if($option3_price["query_meals_infant"]!="") value="{{$option3_price["query_meals_infant"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_meals_single" name="price[query_meals_single]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_meals_single",$option3_price))  @if($option3_price["query_meals_single"]!="") value="{{$option3_price["query_meals_single"]}}"  @endif @endif @endif>
</td>
</tr>
<!--Meals End-->
<!--Markup  Start-->
<tr>
<td>Markup Price </td>
<td>

<select class="form-control query_markup_curr" name="price[query_markup_curr]">
  @foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_curr",$option3_price))   @if($rate->id==$option3_price["query_markup_curr"]) selected  @endif @endif @endif c_val="{{$rate->rate}}">{{ $rate-> currency}}</option>
@endforeach
 
</select>
</td>
<td>

<input type="text" class="form-control query_markup_adult" name="price[query_markup_adult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_adult",$option3_price))  @if($option3_price["query_markup_adult"]!="") value="{{$option3_price["query_markup_adult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_markup_exadult" name="price[query_markup_exadult]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_exadult",$option3_price))  @if($option3_price["query_markup_exadult"]!="") value="{{$option3_price["query_markup_exadult"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_markup_childbed" name="price[query_markup_childbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_childbed",$option3_price))  @if($option3_price["query_markup_childbed"]!="") value="{{$option3_price["query_markup_childbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_markup_childwbed" name="price[query_markup_childwbed]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_childwbed",$option3_price))  @if($option3_price["query_markup_childwbed"]!="") value="{{$option3_price["query_markup_childwbed"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_markup_infant" name="price[query_markup_infant]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_infant",$option3_price))  @if($option3_price["query_markup_infant"]!="") value="{{$option3_price["query_markup_infant"]}}"  @endif @endif @endif>
</td>
<td>
<input type="text" class="form-control query_markup_single" name="price[query_markup_single]" @if (is_bool($option3_price)) @else @if(array_key_exists("query_markup_single",$option3_price))  @if($option3_price["query_markup_single"]!="") value="{{$option3_price["query_markup_single"]}}"  @endif @endif @endif>
</td>
</tr>
<!--Cruise End-->
<tr>
<td>GST / Tax</td>
<td>
<select class="form-control query_gst_curr" name="price[query_gst_curr]">
@foreach($rates as $rate)
    <option value="{{ $rate-> id}}" @if($rate->id==$option3_price["query_gst_curr"]) selected  @endif c_val="{{$rate->rate}}" >{{ $rate-> currency}}</option>
@endforeach
</select>
</td>
<td>
<input type="text" class="form-control query_gst_adult" name="price[query_gst_adult]" @if($option3_price["query_gst_adult"]!="") value="{{$option3_price["query_gst_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_gst_exadult" name="price[query_gst_exadult]" @if($option3_price["query_gst_exadult"]!="") value="{{$option3_price["query_gst_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_gst_childbed" name="price[query_gst_childbed]" @if($option3_price["query_gst_childbed"]!="") value="{{$option3_price["query_gst_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_gst_childwbed" name="price[query_gst_childwbed]" @if($option3_price["query_gst_childwbed"]!="") value="{{$option3_price["query_gst_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_gst_infant" name="price[query_gst_infant]" @if($option3_price["query_gst_infant"]!="") value="{{$option3_price["query_gst_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_gst_single" name="price[query_gst_single]" @if($option3_price["query_gst_single"]!="") value="{{$option3_price["query_gst_single"]}}"  @endif>
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
<input type="text" class="form-control query_total_adult" readonly="" name="price[query_total_adult]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'adult')}}">
</td>
<td>
<input type="text" class="form-control query_total_exadult" readonly="" name="price[query_total_exadult]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'exadult')}}">
</td>
<td>
<input type="text" class="form-control query_total_childbed" readonly="" name="price[query_total_childbed]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'childbed')}}">
</td>
<td>
<input type="text" class="form-control query_total_childwbed" readonly="" name="price[query_total_childwbed]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'childwbed')}}">
</td>
<td>
<input type="text" class="form-control query_total_infant" readonly="" name="price[query_total_infant]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'infant')}}">
</td>
<td>
<input type="text" class="form-control query_total_single" readonly="" name="price[query_total_single]" value="{{CustomHelpers::get_quotation_total($reference_data3->option3_price,'single')}}">
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
<input type="text" class="form-control query_discount_adult" name="price[query_discount_adult]" @if($option3_price["query_discount_adult"]!="") value="{{$option3_price["query_discount_adult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_discount_exadult" name="price[query_discount_exadult]" @if($option3_price["query_discount_exadult"]!="") value="{{$option3_price["query_discount_exadult"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_discount_childbed" name="price[query_discount_childbed]" @if($option3_price["query_discount_childbed"]!="") value="{{$option3_price["query_discount_childbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_discount_childwbed" name="price[query_discount_childwbed]" @if($option3_price["query_discount_childwbed"]!="") value="{{$option3_price["query_discount_childwbed"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_discount_infant" name="price[query_discount_infant]" @if($option3_price["query_discount_infant"]!="") value="{{$option3_price["query_discount_infant"]}}"  @endif>
</td>
<td>
<input type="text" class="form-control query_discount_single" name="price[query_discount_single]" @if($option3_price["query_discount_single"]!="") value="{{$option3_price["query_discount_single"]}}"  @endif>
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
<input type="text" class="form-control query_grand_adult" readonly="" name="price[query_grand_adult]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'adult')}}">
</td>
<td>
<input type="text" class="form-control query_grand_exadult" readonly="" name="price[query_grand_exadult]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'exadult')}}">
</td>
<td>
<input type="text" class="form-control query_grand_childbed" readonly="" name="price[query_grand_childbed]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'childbed')}}">
</td>
<td>
<input type="text" class="form-control query_grand_childwbed" readonly="" name="price[query_grand_childwbed]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'childwbed')}}">
</td>
<td>
<input type="text" class="form-control query_grand_infant" readonly="" name="price[query_grand_infant]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'infant')}}">
</td>
<td>
<input type="text" class="form-control query_grand_single" readonly="" name="price[query_grand_single]" value="{{CustomHelpers::get_quotation_grandtotal($reference_data3->option3_price,'single')}}">
</td>
</tr>
</tbody>
</table>
</div>
</div>

<!---->
<?php
$option3_accommodation=unserialize($reference_data3->option3_accommodation);
if(is_bool($option3_accommodation)):
$option3_accommodation_count="1";
else:
$option3_accommodation_count=count($option3_accommodation);

endif;


?>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Accommodation"><span class="glyphicon glyphicon-th-list">
</span> Accommodation</a>
</h4>
</div>
<div id="option3_Accommodation" class="panel-collapse collapse">
<div class="panel-body">

<?php
$days=$data->duration;
$days=(int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
$days=$days-1;

?>


<div class="option3_dynamic_acc">
	<input type="hidden" name="duration" value="{{(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT)}}">
 @for($j=0;$j<$option3_accommodation_count;$j++)
 @if($j>0)
<hr>
 @endif
<div class="field{{$j}}" id="{{$j}}">
<div class="row">
<div class="col-md-4">

<label>Select Days</label>

<select class="form-control select_day select2" multiple name="accommodation[{{$j}}][day][]">
@for($i=1;$i<=$days;$i++)
<option value="Day {{$i}}" @if($option3_accommodation!="" && array_key_exists("day",$option3_accommodation[$j])  && in_array("Day $i",$option3_accommodation[$j]["day"])) selected @endif>  Day {{$i}}</option>  
@endfor

</select>


</div>  
<div class="col-md-4">

<label>city</label>

<input type="text" name="accommodation[{{$j}}][city]" class="form-control query_city" placeholder="City" value="{{$option3_accommodation[$j]["city"]}}">






</div>  
<div class="col-md-4">

<label>Choose Hotel Manually or from TripAdvisor</label>

<select class="form-control" name="accommodation[{{$j}}][trip]">
<option value='0'  disabled='disabled'>--Select--</option>
<option value="Manually" @if($option3_accommodation[$j]["trip"]=="Manually") selected @endif>Manually</option>  
<option value="TripAdvisor" @if($option3_accommodation[$j]["trip"]=="TripAdvisor") selected @endif>TripAdvisor</option>  
</select>

</div>  
<div class="col-md-4">

<label>Choose Hotel</label>

<?php
$query_data_option3=CustomHelpers::get_quotation_hotel($option3_accommodation[$j]["city"]);
?>
<select class="form-control quo_hotel" name="accommodation[{{$j}}][hotel]">
 <option value='0' selected='true' disabled='disabled'>--Choose Hotel--</option>
 @foreach($query_data_option3 as $single)
 <option value='{{$single->id}}' @if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) && $single->id==$option3_accommodation[$j]["hotel"])  selected @endif>{{$single->hotelname}} </option>
 @endforeach                  
<option value="other" @if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) && $option3_accommodation[$j]["hotel"]=="other")  selected @endif>Other</option>
</select>


</div> 

@if($option3_accommodation!="" && array_key_exists("hotel",$option3_accommodation[$j]) && $option3_accommodation[$j]["hotel"]=="other")
<div class="col-md-4 other_hotel" style="display: block;">
<label>Enter Hotel</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][other_hotel]" placeholder="Hotel Name" value="{{$option3_accommodation[$j]["other_hotel"]}}">
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
<option>--Select--</option>
@if($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) && $option3_accommodation[$j]["star"]!="" && $option3_accommodation[$j]["star"]!="other")
<option value="{{$option3_accommodation[$j]["star"]}}" selected>{{$option3_accommodation[$j]["star"]}}</option>
@elseif($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) && $option3_accommodation[$j]["star"]!="" && $option3_accommodation[$j]["star"]=="other")
<option value="other" selected>Other</option>
@endif

</select>


</div> 
@if($option3_accommodation!="" && array_key_exists("star",$option3_accommodation[$j]) && $option3_accommodation[$j]["star"]=="other" )
<div class="col-md-4 other_star" style="display: block;">
<label>Enter Star Rating</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" placeholder="Hotel Star Rating" value="{{$option3_accommodation[$j]["star_other"]}}">
</div>
@else
<div class="col-md-4 other_star" style="display: none;">
<label>Enter Star Rating</label>
  

  <input type="text" class="form-control" name="accommodation[{{$j}}][star_other]" value="{{$option3_accommodation[$j]["star_other"]}}" placeholder="Hotel Star Rating">
</div>

@endif
<div class="col-md-4">
<label>Room Category</label>
<input type="text" class="form-control" name="accommodation[{{$j}}][category]" placeholder="Room Category" value="{{$option3_accommodation[$j]["category"]}}">




</div> 
<div class="col-md-4">
  <label>Hotel Website Link</label>
  <input type="text" class="form-control" name="accommodation[{{$j}}][hotel_link]" placeholder="Hotel Website Link" @if($option3_accommodation!="" && array_key_exists("hotel_link",$option3_accommodation[$j])) 

 value="{{$option3_accommodation[$j]["hotel_link"]}}"  @endif>

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
<button type="button" name="add" id="option3_add_acco" days="{{$days}}" class="btn btn-success">Add More
</button> 
</div>
</div>
<br>

</div>
</div>
</div>
<!---->
<div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">
    <a data-toggle="collapse" data-parent="#accordion3" href="#option3_Transport"><span class="glyphicon glyphicon-th-list">
    </span> Transport</a>
    </h4>
    </div>
    <div id="option3_Transport" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row">
                                      
   <div class="col-md-12">
    

    <div class="form-group">
    <label for="">Transport</label>
    <select name="transport"  class="form-control transport" id="transport2">
    <option value="0">--Choose Transport--</option>
            @foreach($transport as $trans)  
    <option value="{{ $trans->name }}" 
      @if($trans->name==$reference_data3->option3_transport) selected @endif>{{$trans->name}}</option>
            @endforeach     
    </select> 

    </div>
    </div>
    @if($reference_data3->option3_transport=="Flight")
    <div class="col-md-12">
   <div class="oflight2" style="display: none;">
      <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">
    {{ old('transport_description') }}</textarea>
          <br>

   </div>
    </div> 
    <?php
     $flight_option3=unserialize($reference_data3->option3_flight);

    ?>   
    <div class="flight2" style="display: block;">
      <div class="col-md-12"><h4>UP</h4></div>
      <div class="col-md-3">
      <label>Flight Name</label>
      <input type="text" name="flight[name]" class="form-control flight_name" @if($flight_option3['name']!="") value="{{$flight_option3['name']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>Flight No.</label>
         <input type="text" name="flight[no]" class="form-control flight_no" @if($flight_option3['no']!="") value="{{$flight_option3['no']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[numberstop]" class="form-control" @if($flight_option3['numberstop']!="") value="{{$flight_option3['numberstop']}}" @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Onward Date</label>
         <input type="text" name="flight[onwarddate]" class="form-control datepickers" @if(array_key_exists('onwarddate',$flight_option3)) @if($flight_option3['onwarddate']!="") value="{{$flight_option3['onwarddate']}}" @endif @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[Origin]" class="form-control flight_origin" @if($flight_option3['Origin']!="") value="{{$flight_option3['Origin']}}" @endif> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[dtime]" class="form-control" @if($flight_option3['dtime']!="") value="{{$flight_option3['dtime']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[dest]" class="form-control flight_dest" @if($flight_option3['dest']!="") value="{{$flight_option3['dest']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[atime]" class="form-control" @if($flight_option3['atime']!="") value="{{$flight_option3['atime']}}" @endif>
      <br>
      </div>
    <!---->
    <div class="col-md-12" style="border-top:1px solid darkgray;
    margin-bottom: 14px;
    border-radius: 23px;"><h4>Return Flight</h4></div>
    <div class="col-md-3">
      <label>Flight Name</label>
      <input type="text" name="flight[dname]" class="form-control down_filght" @if($flight_option3['dname']!="") value="{{$flight_option3['dname']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>Flight No.</label>
         <input type="text" name="flight[dno]" class="form-control down_no" @if($flight_option3['dno']!="") value="{{$flight_option3['dno']}}" @endif>
      </div>
      <div class="col-md-3">
        <label>No. Of Stop</label>
         <input type="text" name="flight[dnumberstop]" class="form-control" @if($flight_option3['dnumberstop']!="") value="{{$flight_option3['dnumberstop']}}" @endif>
         <br>
      </div>
       <div class="col-md-3">
       <label>Return Date</label>
         <input type="text" name="flight[downwarddate]" class="form-control datepickers" @if(array_key_exists('downwarddate',$flight_option3)) @if($flight_option3['downwarddate']!="") value="{{$flight_option3['downwarddate']}}" @endif @endif>
         <br>
      </div>
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[dOrigin]" class="form-control down_origin" @if($flight_option3['dOrigin']!="") value="{{$flight_option3['dOrigin']}}" @endif> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[ddtime]" class="form-control" @if($flight_option3['ddtime']!="") value="{{$flight_option3['ddtime']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[ddest]" class="form-control down_dest" @if($flight_option3['ddest']!="") value="{{$flight_option3['ddest']}}" @endif>
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[datime]" class="form-control" @if($flight_option3['datime']!="") value="{{$flight_option3['datime']}}" @endif>
      <br>
      </div>
    </div>
    
   @else
<div class="col-md-12">
   <div class="oflight2">
      <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">{{$reference_data3->option3_transport_description}}
    </textarea>
      <br>

   </div>
    </div>
        <div class="flight2">
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
    <a data-toggle="collapse" data-parent="#accordion3" href="#option3_pac_Description"><span class="glyphicon glyphicon-th-list">
    </span> Package Description</a>
    </h4>
    </div>
    <div id="option3_pac_Description" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row">
                                      
    <div class="col-md-12">
    <div class="form-group">
    <label for="">Package Description</label>
    <br>
    <span class="show_hide">More+</span>
    <textarea class="form-control ckeditor"  
    name="description" id="" cols="30" rows="5" >{!! $reference_data3->option3_description !!}</textarea>
    </div>
    <div class="form-group">
    <label for="">Tour Highlights</label>
    <br>
    <span class="show_hide">More+</span>
    <textarea class="form-control ckeditor"  
    name="highlights" id="" cols="30" rows="5" >{!! $reference_data3->option3_highlights !!}</textarea>
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
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Inclusions"><span class="glyphicon glyphicon-th-list">
</span> Inclusions & Exclusions</a>
</h4>
</div>
<div id="option3_Inclusions" class="panel-collapse collapse">
<div class="panel-body c_body">
<div class="row">
 <div class="col-md-12">
<div class="form-group select-container">
<label >What your tour price includes?</label>
<br>
    <span class="show_hide">More+</span>
<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">
{!! $reference_data3->option3_inclusions !!}</textarea>

</div>
</div>
<div class="col-md-12">
<div class=" form-group ">
<label >What your tour price does not include?</label>
<br>
    <span class="show_hide">More+</span>
<textarea class="form-control ckeditor"  name="exclusions" id="" cols="30" rows="5">
{!! $reference_data3->option3_exclusions !!}</textarea>

</div>
</div>                 
</div>
</div>

</div>
</div>

<!---->
<?php
$option3_dayItinerary=unserialize($reference_data3->option3_dayItinerary);
?>
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Itinerary"><span class="glyphicon glyphicon-th-list">
</span> Tour Itinerary</a>
</h4>
</div>
<div id="option3_Itinerary" class="panel-collapse collapse">
<div class="panel-body c_body">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">



@for($j=1;$j<=(int)filter_var($data->duration,FILTER_SANITIZE_NUMBER_INT);$j++)
<div class="col-md-12 dayItinerary day1" >


<div class="form-group">
Day {{$j}} : 
<input type="text" name="dayItinerary[day{{$j}}][title]" style="height: 35px;width: 95%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;" placeholder="Day Title" @if($option3_dayItinerary!="" && array_key_exists("day$j",$option3_dayItinerary)) value="{{$option3_dayItinerary["day$j"]["title"]}}" @endif>  
</div> 


<div class="form-group">
<label for="">Description</label>
<br>
    <span class="show_hide">More+</span>
<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]" >
@if($option3_dayItinerary!="" && array_key_exists("day$j",$option3_dayItinerary)) {!! $option3_dayItinerary["day$j"]["desc"] !!} @endif
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
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Policies"><span class="glyphicon glyphicon-th-list">
</span> Policies</a>
</h4>
</div>
<div id="option3_Policies" class="panel-collapse collapse">
<div class="panel-body">
<div class="row">
<div class="col-md-12">
<h4>Terms & Conditions   </h4>


<div class="form-group">
<label for="">Is Visa Required?</label>
<input type="checkbox" name="visa" value="1" id="" class="visa"@if($reference_data3->option3_visa=="1") checked @endif/>
</div>
<div class="visa_pol" @if($reference_data3->option3_visa=="1") style="display:block" @endif>

<h5>Visa Terms & Policies</h5>

<table class="table table-bordered" id="dynamic_field">
<tbody>
<tr>
<td style="width: 60%;">
<div>
<?php
$option3_package_visa=unserialize($reference_data3->option3_package_visa);
  ?>
<select name="package_visa[]"  class="select2 form-control" multiple>

@foreach($visaPolicy as $pol)
<option value="{{$pol->id}}" @if($option3_package_visa!="" && in_array("$pol->id",$option3_package_visa)) selected @endif>{{$pol->policy}} </option>

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
  {{$reference_data3->option3_visa_policies}}
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
$option3_package_payment=unserialize($reference_data3->option3_package_payment);
  ?>
<select name="package_payment[]"  class="select2 form-control" multiple>
@foreach($paymentPolicy as $pol)
<option value="{{$pol->id}}" @if($option3_package_payment!="" && in_array("$pol->id",$option3_package_payment)) selected @endif >{{$pol->policy}} </option>

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
  {{$reference_data3->option3_payment_policies}}
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
$option3_package_can=unserialize($reference_data3->option3_package_can);
  ?>
<select name="package_can[]"  class="select2 form-control" multiple>
@foreach($cancelPolicy as $pol)
<option value="{{$pol->id}}" @if($option3_package_can!="" && in_array("$pol->id",$option3_package_can)) selected @endif >{{$pol->policy}} </option>

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
  {{$reference_data3->option3_cancellation}}
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
$option3_package_impnotes=unserialize($reference_data3->option3_package_impnotes);
  ?>
<select name="package_impnotes[]"  class="select2 form-control" multiple>
@foreach($imp_notes as $pol)
<option value="{{$pol->id}}" @if($option3_package_impnotes!="" && in_array("$pol->id",$option3_package_impnotes)) selected @endif>{{$pol->policy}} </option>

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
  {{$reference_data3->option3_extra_imp}}
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
    <a data-toggle="collapse" data-parent="#accordion3" href="#option3_Validity"><span class="glyphicon glyphicon-th-list">
    </span> Quote Validity</a>
    </h4>
    </div>
    <div id="option3_Validity" class="panel-collapse collapse">
    <div class="panel-body">
    <div class="row">
                                      
    <div class="col-md-12">
    <div class="form-group">
    <label for="">Quote Validity</label>
   <input type="text" class="datepickers" name="validaty" value="{{$reference_data3->option3_validaty}}">
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
    <a data-toggle="collapse" data-parent="#accordion3" href="#option3_Welcome"><span class="glyphicon glyphicon-th-list">
    </span> Welcome Greetings </a>
    </h4>
    </div>
    <div id="option3_Welcome" class="panel-collapse collapse">
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
$option3_quotation_header=unserialize($reference_data3->option3_quotation_header);
  ?>
<select name="quotation_header[]"  class="select2 form-control" multiple>

@foreach($quotation_header as $pol)
<option value="{{$pol->id}}" @if($option3_quotation_header!="" && in_array("$pol->id",$option3_quotation_header)) selected @endif >{{$pol->header}} </option>

@endforeach


</select>







</div>
</td>
</tr>
<tr>                                         
<td>
    <span class="show_hide">More+</span>
    <br>
<textarea  name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control ckeditor">
   {!! $reference_data3->option3_quotation_header_extra !!}
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
$option3_quotation_footer=unserialize($reference_data3->option3_quotation_footer);
  ?>
<select name="quotation_footer[]"  class="select2 form-control" multiple>

@foreach($quotation_footer as $pol)
<option value="{{$pol->id}}" @if($option3_quotation_footer!="" && in_array("$pol->id",$option3_quotation_footer)) selected @endif>{{$pol->footer}} </option>

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
  {!! $reference_data3->option3_quotation_footer_extra !!}
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