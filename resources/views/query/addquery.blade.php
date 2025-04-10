@extends('layouts.master')
@section('content')
<style>
  .error{color: red}
   .bor_cen
         {
         border-top:1px solid lightgray;
         border-bottom:1px solid lightgray;
         padding: 5px 10px

         }
    .bor
         {
          border:1px solid lightgray;
          padding: 5px 10px;
          cursor: pointer;

         }
     .checkbox_spn
         {
          margin-right: 10px;
          position: relative;
          top: -1px;
          margin-left: 4px;

         }   
        
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
  <section class="content">
  <div class="row">
  <div class="col-md-12">
  <div class="box">

  <div class="box-header">
  <div class="add">
    <a href="{{URL::to('/query')}}" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"> </i> Back</a>
    </div>
  <h3 class="box-title">Add Customer Detail</h3>
  </div>
            <!-- /.box-header -->
  <div class="box-body">
  <!---->
  <form action="{{URL::to('/saveQuery1')}}" method="Post" id="enquiry_form" name="enquiry_form">
    {{csrf_field()}}
<div class="alert alert-success" id="success-contaier" style="display:none">
   <p>Thanks You! Your query has been submitted.</p>
</div>


<div class="row">
<div class="col-md-8">
  <p>Enter your contact details and we will plan the best holiday suiting all your requirements.</p>
</div>
<div class="col-md-4"></div>
</div>
<div class="row">

<div class="col-md-8">
  <div class="row">
<div class="col-md-6">
  <select class="form-control" id="change_package">
    <option value="exi">Existing Packages</option>
    <option value="manual">Customized Package</option>
  </select>
</div>
<div class="col-md-6">
<div class="form-group" id="change_packages">

<select class="form-control" name="packageId">
  @foreach($package_data as $packages )
  <option value="{{ $packages->id }}">{{ $packages->title }}</option>
  @endforeach
</select>

</div>


</div>


</div>
<!---->
<div class="row">

<div class="col-md-6">
<div class="form-group">

<input class="form-control"  type="text"  value="" name="name" id="name" placeholder="Your Name" style="border-radius: 0px;height: 33px;" />
<span class="error" id="name_error">{{ $errors->first("name")}}</span>
</div>


</div>

<div class="col-md-6">
<div class="form-group">

<input class="form-control"  type="text" value="" id="mobile" name="mobile" placeholder="Your Mobile No" style="border-radius: 0px;height: 33px"/>
<span class="error" id="mobile_error">{{ $errors->first("mobile")}}</span>
</div>


</div>
</div>
<!---->
<div class="row">
<div class="col-md-6">
<div class="form-group">

<input class="form-control" type="email"  value="" id="email" name="email" placeholder="Enter Your Email Id" style="border-radius: 0px;height: 38px" />
<span class="error" id="email_error">{{ $errors->first("email")}}</span>

</div>
</div>
<div class="col-md-6">

<div class="form-group">

<!--<input   type="text" value=""  placeholder="Best Time To Call"  />
-->
<select class="form-control" name="time_call" style="border-radius: 0px;height: 38px">
  <option value="0">Choose Best Time To Call</option>
  <option value="09 - 11 AM">Between 09 - 11 AM</option>
  <option value="11 - 01 PM">Between 11 - 01 PM</option>
  <option value="01 - 03 PM">Between 01 - 03 PM</option>
  <option value="03 - 05 PM">Between 03 - 05 PM</option>
  <option value="05 - 07 PM">Between 05 - 07 PM</option>
  <option value="07 - 09 PM">Between 07 - 09 PM</option>
</select>
</div>
</div>
</div>
<!---->
<div class="row">
<div class="col-md-6">
<div class="form-group">

<input class="form-control"  type="text" value="" id="city_of_residence" name="city_of_residence" placeholder="Enter Your Residence City" style="border-radius: 0px;height: 38px" />
<span class="error" id="city_of_residence_error">{{ $errors->first("city_of_residence")}}</span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">

<!--<input   type="text" value=""  placeholder="Enter Your Country" />-->

<select class="form-control" name="country_of_residence" 
                 style="border-radius: 0px;height: 38px" id="country_of_residence">
  
</select>

</div>
</div>
</div>
<!---->
<div class="row">
<div class="col-md-6">
<div class="form-group">

<input class="form-control"  type="text" value="" id="destinations" name="destinations" placeholder="Enter Your Destination"  style="border-radius: 0px;height: 38px"/>
<span class="error" id="destinations_error">{{ $errors->first("destinations")}}</span>
</div>
</div>
<div class="col-md-6">
<div class="bfh-datepicker date_arrival" id="date_arrival"  data-format="d/ m/ y" 
data-name="date_arrival"  data-placeholder="Choose Arrival Date" data-date="">
                  
</div>
</div>
</div>
<!---->
<div class="row">
<div class="col-md-4">
<div class="form-group">

<input class="form-control"  type="text" value="" name="duration" placeholder="Enter Duration (No. Of Days)" style="border-radius: 0px;height: 38px"/>
</div>
</div>
<div class="col-md-2">

<h3 style="margin-top: 7px;margin-left: -20px;color: lightgray">Days</h3>

</div>
<div class="col-md-6">
  
<div class="form-group">

<input class="form-control"  type="text" value="" name="exp_budget" placeholder="Expected Budget (Per Person)"  style="border-radius: 0px;height: 38px"/>
</div>

</div>
</div>


<!---->
<div class="row">
<div class="col-md-4 col-xs-4">
  <p>Hotel Preference:</p>
</div>
<div class="col-md-8 col-xs-8">
  
 
      <input type="radio" value="3" name="hotel_pre"><span class="checkbox_spn">3 Star</span>
      <input type="radio" value="4" name="hotel_pre"><span class="checkbox_spn">4 Star</span>
      <input type="radio" value="5" name="hotel_pre"><span class="checkbox_spn">5 Star</span>
     
   
</div>
</div>
<!---->
<div class="row">
<div class="col-md-12">
  <p style="font-size: 13px">No. of Traveller(s) :</p>
</div>

 <div class="col-md-3 col-xs-4">
  <input type="hidden" name="span_value_adult" class="span_value_adult1" value="1">
 <span class="bor span_des_adult">-</span><span class="bor_cen span_value_adult">1</span><span class="bor span_inc_adult">+</span>

   <p style="color: #6e6b6b;font-size: 12px;margin-top: 5px">Adult (12yrs +)</p>

</div>
<div class="col-md-3 col-xs-4 ">
   <input type="hidden" name="span_value_child" class="span_value_child1" value="0">
 <span class="bor span_des_child">-</span><span class="bor_cen span_value_child">0</span><span class="bor span_inc_child">+</span>
 
   <p style="color: #6e6b6b;font-size: 12px;margin-top: 5px">Child (2-12yrs)</p>

</div>

<div class="col-md-3 col-xs-4 ">
   <input type="hidden" name="span_value_child_without_bed" class="span_value_child1_without_bed" value="0">
 <span class="bor span_des_child_without_bed">-</span><span class="bor_cen span_value_child_without_bed">0</span><span class="bor span_inc_child_without_bed">+</span>
 
   <p style="color: #6e6b6b;font-size: 12px;margin-top: 5px">Child without bed (2-12yrs)</p>

</div>


<div class="col-md-3 col-xs-4">
  <input type="hidden" name="span_value_infant" class="span_value_infant1" value="0">
 <span class="bor span_des_infant">-</span><span class="bor_cen span_value_infant">0</span><span class="bor span_inc_infant">+</span>
 
   <p style="color: #6e6b6b;font-size: 12px;margin-top: 5px">Infant (0-2yrs)</p>

</div>

   
 


<!-- <input type="text" class="counter" value="1"/>
<button type="button" class="increment-btn">Increment</button>-->
</div>

<!---->
<div class="row">
<div class="col-md-12">
<div class="form-group">
<textarea class="form-control" type="text" name="message" style="border-radius: 0px;border: 1px solid lightgray" placeholder="Give us more details, like additional tours, multiple destinations, Age of the Children"></textarea>
</div>
</div>

</div>
<!---->
<div class="row">
<div class="col-md-12">
 <input type="checkbox" value="0" id="accept_value" name="accept_value"><span class="checkbox_spn">I here by accept the privacy policy and  authorize to contact me.</span>  
 <p class="error" id="accept_value_error">{{ $errors->first("accept_value")}}</p>

</div>
</div>

</div>

  
</div>




        
       
</div>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
     <button type="submit" name="submit" id="form_submit" class="btn btn-danger btn-lg">Save 
  <i class="fa  fa-arrow-right"></i>
                            
  </button>

  </div>
</div>

<div class="modal-footer">


</form>


  <!---->

  </div>
  <!-- /.box-body -->
  </div>
  </div>
  </div>
  </section>
  <!-- /.content -->
  </div>
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){


    var url=APP_URL+'/country_query';
          var data={_token:"{{ csrf_token() }}"};
          $.post(url,data,function(rdata){
            
            $("#country_of_residence").html("").html(rdata);
          })


   $(".span_inc_adult").click(function(){

  var span_value_adult=$(".span_value_adult").html();


$(".span_value_adult").html("").html(parseInt(span_value_adult) + 1)
$(".span_value_adult1").val("").val(parseInt(span_value_adult) + 1)
  //alert(span_value_adult)
})

$(".span_des_adult").click(function(){

  var span_value_adult=$(".span_value_adult").html();

if(span_value_adult>=2)
{
 $(".span_value_adult").html("").html(parseInt(span_value_adult) - 1) 
 $(".span_value_adult1").val("").val(parseInt(span_value_adult) - 1)
}

 
})
//
$(".span_inc_child").click(function(){

  var span_value_child=$(".span_value_child").html();


$(".span_value_child").html("").html(parseInt(span_value_child) + 1)
$(".span_value_child1").val("").val(parseInt(span_value_child) + 1)
  //alert(span_value_adult)
})

$(".span_des_child").click(function(){

  var span_value_child=$(".span_value_child").html();

if(span_value_child>=1)
{
 $(".span_value_child").html("").html(parseInt(span_value_child) - 1)
 $(".span_value_child1").val("").val(parseInt(span_value_child) - 1) 
}

 
})


$(".span_inc_child_without_bed").click(function(){

  var span_value_child_without_bed=$(".span_value_child_without_bed").html();


$(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) + 1)
$(".span_value_child1_without_bed").val("").val(parseInt(span_value_child_without_bed) + 1)
  //alert(span_value_adult)
})

$(".span_des_child_without_bed").click(function(){

  var span_value_child_without_bed=$(".span_value_child_without_bed").html();

if(span_value_child_without_bed>=1)
{
 $(".span_value_child_without_bed").html("").html(parseInt(span_value_child_without_bed) - 1)
 $(".span_value_child1_without_bed").val("").val(parseInt(span_value_child_without_bed) - 1) 
}

 
})


//
$(".span_inc_infant").click(function(){

  var span_value_infant=$(".span_value_infant").html();


$(".span_value_infant").html("").html(parseInt(span_value_infant) + 1)
$(".span_value_infant1").val("").val(parseInt(span_value_infant) + 1)
  //alert(span_value_adult)
})

$(".span_des_infant").click(function(){

  var span_value_infant=$(".span_value_infant").html();

if(span_value_infant>=1)
{
 $(".span_value_infant").html("").html(parseInt(span_value_infant) - 1) 
 $(".span_value_infant1").val("").val(parseInt(span_value_infant) - 1)
}

 
})



    })


    //

    $("#accept_value").click(function(){
 var accept_value1=$(this).val()

 if(accept_value1=="0")
 {
   $("#accept_value").val("").val(1)
 }
 else if(accept_value1=="1")
 {
 $("#accept_value").val("").val(0)
 }
})

 //

document.enquiry_form.onsubmit=function()
{
 
 var name=document.enquiry_form.name.value;
 var email=document.enquiry_form.email.value;
 var mobile=document.enquiry_form.mobile.value;
 var city_of_residence=document.enquiry_form.city_of_residence.value;
 var destinations=document.enquiry_form.destinations.value;
 var accept_value=document.enquiry_form.accept_value.value;
 var patt_name=/^[A-Za-z]{1,}[A-Za-z .]{2,}$/;
  var patt_mail=/^[A-Za-z0-9]{1}[A-Za-z0-9_.]{0,}\@[A-Za-z0-9]{1,}[A-Za-z0-9.-]{1,}\.[A-Za-z]{1,}[A-Za-z.]{1,}$/;

 if( name.trim()=="")
 {
  document.querySelector("#name_error").innerHTML="Enter Full Name";
  return false;
 }

 else if(patt_name.test(name)==false)
 {
  document.querySelector("#name_error").innerHTML="Enter valid Name";

   return false;
 }
 else if(mobile.trim()=="" || isNaN(mobile))
  {
            document.querySelector("#mobile_error").innerHTML="Enter valid Contact Number";
            document.enquiry_form.mobile.focus();
            document.querySelector("#name_error").innerHTML="";
            return false;
  }
  else if(email.trim()=="" || patt_mail.test(email)==false)
  {
            document.querySelector("#email_error").innerHTML="Enter valid  mail id";
            document.enquiry_form.email.focus();
            document.querySelector("#name_error").innerHTML="";
            document.querySelector("#mobile_error").innerHTML="";
            return false;
  }
  else if(city_of_residence.trim()=="" || patt_name.test(city_of_residence)==false)
 {
  document.querySelector("#city_of_residence_error").innerHTML="Enter Residence City";
   document.enquiry_form.city_of_residence.focus();
   document.querySelector("#name_error").innerHTML="";
   document.querySelector("#mobile_error").innerHTML="";
   document.querySelector("#email_error").innerHTML="";
   return false;
 }
 else if(destinations.trim()=="" || patt_name.test(destinations)==false)
 {
  document.querySelector("#destinations_error").innerHTML="Enter Destination City";
   document.enquiry_form.destinations.focus();
    document.querySelector("#name_error").innerHTML="";
   document.querySelector("#mobile_error").innerHTML="";
   document.querySelector("#email_error").innerHTML="";
   document.querySelector("#city_of_residence_error").innerHTML="";
   return false;
 }

 else if(accept_value=="0")
 {


  document.querySelector("#accept_value_error").innerHTML="Please Accept T&C!";
  document.enquiry_form.accept_value.focus();
  document.querySelector("#name_error").innerHTML="";
  document.querySelector("#mobile_error").innerHTML="";
  document.querySelector("#email_error").innerHTML="";
  document.querySelector("#city_of_residence_error").innerHTML="";
  document.querySelector("#destinations_error").innerHTML="";

  return false;

 }



}
  </script>
  <!-- /.content-wrapper -->
@endsection