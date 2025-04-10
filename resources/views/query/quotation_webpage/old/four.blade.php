@extends('layouts.front.master')
 @if(env("WEBSITENAME")==1)
 @section('keywords','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section('desc','The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section("title", 'The World Gateway')
 @elseif(env("WEBSITENAME")==0)
 @section('keywords','RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section('desc','RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances')
 @section("title", 'RapidexTravels')
 @endif
@section('content')
@include("query.quotation_webpage.commonstyle")
<div class="container">
<div class="row">
<div class="col-md-12">
<br>
<div class="quotation_red">
  <h3 style=" color: #08b2ed;">QUOTE #{{ $data1->quo_ref }}</h3>
</div>
<ul class="nav nav-tabs">
	<li style="background: #434a54;margin-left: 0px;margin-right: 2px"><a data-toggle="tab" href="#menu3">Quote 1</a></li>
	<li style="background: #434a54;margin-left: 0px;margin-right: 2px"><a data-toggle="tab" href="#menu2">Quote 2</a></li>
	<li style="background: #434a54;margin-left: 0px;margin-right: 2px"><a data-toggle="tab" href="#menu1">Quote 3</a></li>
<li class="active" style="background: #434a54;margin-left: 0px;margin-right: 2px"><a data-toggle="tab" href="#home">Quote 4</a></li>



</ul>
</div>
</div>

<div class="" style="background: #f1f1f1">
<div class="row">
<div class="col-md-12">
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
@include("query.quotation_webpage.content4")
</div>
<div id="menu1" class="tab-pane fade">
@include("query.quotation_webpage.content3")
</div>
<div id="menu2" class="tab-pane fade">
@include("query.quotation_webpage.content2")
</div>
<div id="menu3" class="tab-pane fade">
@include("query.quotation_webpage.content1")
</div>
</div>
</div>
</div>
</div>

</div>


@endsection

@section("custom_js")
<script type="text/javascript">

jQuery(document).ready(function(){
   
  jQuery(document).on("click",".user_quote_accept",function(e){
  e.preventDefault()
  var token =  jQuery('input[name="_token"]').val()
  var content_id=jQuery(this).attr("content_id");
  var content_action=jQuery(this).attr("content_action");
  var form = document.createElement("form");
form.setAttribute("method", "post");
form.setAttribute("action", content_action);

form.setAttribute("target", "");

var hiddenField = document.createElement("input"); 
hiddenField.setAttribute("type", "hidden");
hiddenField.setAttribute("name", "_token");
hiddenField.setAttribute("value", token);
form.appendChild(hiddenField);
var second_field = document.createElement("input"); 
second_field.setAttribute("type", "hidden");
second_field.setAttribute("name", "quote_id");
second_field.setAttribute("value", content_id);
form.appendChild(second_field);
document.body.appendChild(form);

//window.open('', 'view');
 //window.open('','view' );
form.submit();

  })
})
</script>
@endsection