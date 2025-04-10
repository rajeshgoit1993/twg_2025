<div class="tab-pane"  id="option3">
<div class="col-md-12">
<form action="{{URL::to('/option3')}}" method="post" >
<input type="hidden" name="type" value=""/>
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
<div class="col-md-4">

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

</div>
</div>
<br>
<div class="row">
<div class="col-md-4">
<label>Package Name</label>
<input type="text" class="form-control" name="custom_package_name" placeholder="Package Name"> 
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
<table class="table" style="width: 40%"> 
<tr>
<td>Price Type</td>
<td>
<select class="form-control" name="price_type">
<option>Per Person</option>
<option>Group Price</option>
</select>
</td>
<td></td>
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
<input type="text" class="form-control query_hotel_adult" name="price[query_hotel_adult]">
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
<tr>
<td>Discount (%)</td>
<td>
<select class="form-control query_discount_curr">
    <option value="" >%</option>

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


?>


<div class="option3_dynamic_acc">
  <input type="hidden" name="duration" value="{{$days}}">
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

<label>Choose Room Category</label>

<select class="form-control" name="accommodation[0][category]">
<option>--Select--</option>

</select>


</div> 
</div>
</div>
  
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
    <select name="transport"  class="form-control transport">
    <option value="0">--Choose Transport--</option>
            @foreach($transport as $trans)  
    <option value="{{ $trans->name }}">{{$trans->name}}</option>
            @endforeach   
    </select> 

    </div>
   <div class="oflight">
      <textarea class="form-control" placeholder="Package Transport Description..." name="transport_description" id="" cols="30" rows="5">
    {{ old('transport_description') }}</textarea>
          <br>

   </div>
    </div>  
    <div class="flight">
      <div class="col-md-12"><h4>UP</h4></div>
      <div class="col-md-4">
      <label>Flight Name</label>
      <input type="text" name="flight[name]" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Flight No.</label>
         <input type="text" name="flight[no]" class="form-control">
      </div>
      <div class="col-md-4">
        <label>No. Of Stop</label>
         <input type="text" name="flight[numberstop]" class="form-control">
         <br>
      </div>
      
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[Origin]" class="form-control"> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[dtime]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[dest]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[atime]" class="form-control">
      <br>
      </div>
    <!---->
    <div class="col-md-12"><h4>Down</h4></div>
    <div class="col-md-4">
      <label>Flight Name</label>
      <input type="text" name="flight[dname]" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Flight No.</label>
         <input type="text" name="flight[dno]" class="form-control">
      </div>
      <div class="col-md-4">
        <label>No. Of Stop</label>
         <input type="text" name="flight[dnumberstop]" class="form-control">
         <br>
      </div>
      
      <div class="col-md-3">
        <label>Flight Origin</label>
      <input type="text" name="flight[dOrigin]" class="form-control"> 
      </div>
      <div class="col-md-3">
         <label>Departure Time</label>
      <input type="text" name="flight[ddtime]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Destination</label>
      <input type="text" name="flight[ddest]" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Arrival Time</label>
      <input type="text" name="flight[datime]" class="form-control">
      <br>
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
    <textarea class="form-control ckeditor"  
    name="description" id="" cols="30" rows="5" >{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
    <label for="">Tour Highlights</label>
    <textarea class="form-control ckeditor"  
    name="highlights" id="" cols="30" rows="5" >{{ old('highlights') }}</textarea>
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
<textarea class="form-control ckeditor"  name="inclusions" id="" cols="30" rows="5">
{{ old('inclusions') }}</textarea>

</div>
</div>
<div class="col-md-12">
<div class=" form-group ">
<label >What your tour price does not include?</label>
<textarea class="form-control ckeditor"  name="exclusions" id="" cols="30" rows="5">
{{ old('exclusions') }}
</textarea>

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
<a data-toggle="collapse" data-parent="#accordion3" href="#option3_Itinerary"><span class="glyphicon glyphicon-th-list">
</span> Tour Itinerary</a>
</h4>
</div>
<div id="option3_Itinerary" class="panel-collapse collapse">
<div class="panel-body c_body">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">



@for($j=1;$j<=$days;$j++)
<div class="col-md-12 dayItinerary day1" >


<div class="form-group">
Day {{$j}} : 
<input type="text" name="dayItinerary[day{{$j}}][title]" style="height: 35px;width: 95%;margin-left: 1%;margin-bottom: 10px;padding: 0 10px;" placeholder="Day Title" >  
</div> 


<div class="form-group">
<label for="">Description</label>
<textarea class="form-control ckeditor" rows="3" name="dayItinerary[day{{$j}}][desc]" >

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
<input type="checkbox" name="visa" value="1" id="" checked/>
</div>
<h5>Visa Terms & Policies</h5>

<table class="table table-bordered" id="dynamic_field">
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
<textarea  name="visa_policies" placeholder="Please state your Extra visa Policies..." rows="6" class="form-control">
</textarea>
<!-- <input type="hidden" name="visa_policies" id="visa_policies_input" value=""/>-->
</td>
</tr>
</tbody>
</table>

<h5>Payment Terms & Methods </h5>

<table class="table table-bordered" >
<tbody>
<tr>
<td style="width: 60%;"> <div>

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
<textarea  name="payment_policies" placeholder="Please state your Payment Terms and Methods..." rows="6" class="form-control">
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
<textarea  name="cancellation" placeholder="Please state your Cancellation Terms & Refund Policy..." rows="6" class="form-control">
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
<textarea  name="extra_imp" placeholder="Please state your Important Notes..." rows="6" class="form-control">
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
   <input type="text" class="datepicker" name="validaty">
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
<textarea  name="quotation_header_extra" placeholder="Please state your Extra Quotation Header..." rows="6" class="form-control">
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
<textarea  name="quotation_footer_extra" placeholder="Please state your Extra Quotation Footer..." rows="6" class="form-control">
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
<div style="text-align: center;">

<button type="submit" name="add" id="remove" class="btn btn-danger btn-lg location_add">Save 
<i class="fa  fa-arrow-right"></i>

</button>
</div>
</form>
</div>  
</div>