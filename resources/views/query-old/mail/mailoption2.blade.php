
<!DOCTYPE html>
<html lang="en">
<head>
<title>Emailer</title>
</head>
<style type="text/css">
body{
margin: 0px 115px;
}
ul{



}
ul>li {
margin-left: -16px;




}
.my_h3 {
margin-left: 7px;
margin-bottom: 8px;
margin-top: 7px; 
}
.inclusions_h3{




}
.itinerary_p {
font-size: 13px;
color: #848484;
margin: 0;
margin-top: 12px;
}



.menu>li>a:hover{
color: #01b7f2;
}
</style>
<body style="letter-spacing: 1px; font-family: arial; background: #f1f1f1;">

<table width="100%" >
<tr>
<td style="height: 80px; background: #fff;" colspan="2">
<img src="{{url('/resources/views/query/mail/mail_img/logo.png')}}" style="width: 250px; margin-left: 50px;">
<ul class="menu" style="border: none;
display: inline-block;
float: right;
margin: 0;">
<li style="float: left;margin-right: 40px;list-style: none;">
	<a href="https://www.theworldgateway.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Home</a></li>
<li style="float: left;margin-right: 40px;list-style: none;">
	<a href="https://www.theworldgateway.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Holidays</a></li>
<li style="float: left;margin-right: 40px;list-style: none;">
	<a href="https://www.theworldgateway.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Hotels</a></li>
<li style="float: left;margin-right: 40px;list-style: none;">
	<a href="https://flights.theworldgateway.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Flights</a></li>
</ul>
</td>

</tr>
<tr>
<td style="width: 50%;padding: 20px 10px">
@if($data!="" && $data->option2_quotation_header!="" && $data->option2_quotation_header!="N;")
<?php
$header=unserialize($data->option2_quotation_header);


?>
@foreach($header as $header_data)
{!! CustomHelpers::get_quotation_header($header_data) !!}
@endforeach
@endif
</td>


</tr>
<!-- next -->
<tr>
<td width="100%">
<div style="border:1px solid #bdbdbd; margin-top: 35px;">
<table width="100%;" cellpadding="0" cellspacing="0"   style=" background: #fff;">
<tr>
<td style="background: #6A6A6A;     padding: 0px 20px; color: #fff" colspan="3" >
<h3 style="margin-top:15px;margin-bottom:0px;">{{$data->custom_package_name}}</h3>
<h4 style="margin-top:10px;margin-bottom:0px;">{{$data->duration}} Nights & {{$data->duration+1}} Days</h4>
<img src="{{url('/resources/views/query/mail/mail_img/plane.png')}}" width="40px;" height="40px" style="margin-right:5px;margin-top:10px;margin-bottom: 10px;">
<img src="{{url('/resources/views/query/mail/mail_img/eye.png')}}" width="40px;" height="40px" style="margin-right:10px;margin-bottom: 10px;">

<img src="{{url('/resources/views/query/mail/mail_img/bed.png')}}" width="40px" height="40px" style="margin-right:10px;margin-bottom: 10px;">

<img src="{{url('/resources/views/query/mail/mail_img/ipod.png')}}" width="40px" height="40px" style="margin-right:10px;margin-bottom: 10px;">

</td>
</tr>
<tr>
<td style="padding: 20px 20px;  border-right: 1px solid #848383;width:25%;">
<p>
<span style="font-size: 15px; color: #696868;     line-height: 2;">From</span><br>
{{$data->source}}
</p>
</td>
<td style="padding: 20px 20px; border-right: 1px solid #848383;width:31%;">
<p>
<span style="font-size: 15px; color: #696868;     line-height: 2;">Date</span><br>
<?php
 
$originalDate = CustomHelpers::get_query_field($data->query_reference,'date_arrival');
if($originalDate=="N" || $originalDate==""):
$originalDate=date("d/m/Y");
endif;
$datefrom = str_replace(' ', '', $originalDate);
$datefrom=explode("/", $datefrom);

$datefrom_year=$datefrom["2"];
$datefrom_day=$datefrom["1"];
$datefrom_month=$datefrom["0"];
$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;

$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
$stop_date = $datefrom;
$date_to=$datefrom;
$datefrom_print = date("d M'y", strtotime($datefrom));
$day_from = strtotime($datefrom);
$day_from = date('D', $day_from);



$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$data->duration.' days'));
$stop_date_print= date("d M'y", strtotime($stop_date));
$day_to = strtotime($stop_date);
$day_to = date('D', $day_to);
?>

<?php echo "$day_from "; ?>,{{$datefrom_print}} - <?php echo "$day_to "; ?>,{{ $stop_date_print}}</p>
</td>
<td style="padding: 20px 20px;">
<p>
<span style="font-size: 15px; color: #696868;     line-height: 2;"> Total Amount</span><span style="font-size: 12px; color: #696868;">(Inclusive of all Taxes)</span><br>
<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png"> {{CustomHelpers::get_quotation_grandtotal($data->option2_price,'adult')}} <i>for <?php 
$total_traveler="0";
$adult=CustomHelpers::get_query_field($data->query_reference,'span_value_adult');
$child=CustomHelpers::get_query_field($data->query_reference,'span_value_child');
$infant=CustomHelpers::get_query_field($data->query_reference,'span_value_infant'); 
if($adult!="" && $adult!="0")
{
$total_traveler+=$adult;
} 
if($child!="")
{
$total_traveler+=$child;
} 
if($infant!="")
{
$total_traveler+=$infant;

} 
echo $total_traveler;
?> traveller(s)</i>
</p>
</td>
</tr>
</table>
</div>
</td>

</tr>

<!-- next -->
@if($data->option2_transport=="Flight")
<?php
$flight_detail=unserialize($data->option2_flight);

?>
<tr>
<td colspan="2"><h3 style="text-align: left; margin: 0px;position: relative;
top: 30px;">Flight Details</h3></td>
</tr>
<tr>
<td colspan="2"><b style="text-align: left; margin: 0px;font-size: 13px; position: relative;
top: 20px;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 17px;">
@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif to  @if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif

</b></td>
</tr>
<tr>
<td width="100%">
<div style="border:1px solid #bdbdbd; margin-top: 35px;">
<table width="100%" cellpadding="0" cellspacing="0" style="background: #fff;">
<tr>
<td style="background: #6A6A6A;     padding: 0px 20px; color: #fff" colspan="4" >
<h3><?php echo "$day_from "; ?>, {{$datefrom_print}}</h3>

</td>
</tr>
<tr>
<td style="padding: 0px 20px;">
<p style="font-size: 12px; color: #696868;     line-height: 2;">
@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif
</p>
</td>
<td style="padding: 0px 20px;">
<p>
@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif <br>
<span style="font-size: 11px; color: #696868;     line-height: 2;">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</span>
</p>
</td>
<td style="padding: 0px 49px;width: 46%;">
<img src="{{url('/public/uploads/icons/planevenue.png')}}" width="250px">
<br>
<span style="font-size: 11px; color: #696868; margin-left:21% ">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
</td>
<td style="padding: 0px 20px;">
<p>
@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif<br>
<span style="font-size: 11px; color: #696868;     line-height: 2;">@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</span>
</p>
</td>

</tr>
</table>



</div>
</td>	
</tr>

<!-- test -->

<tr>
<td colspan="2"><b style="text-align: left; margin: 0px;font-size: 13px; position: relative;
top: 20px;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 17px;">@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif to @if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</b></td>
</tr>
<tr>
<td width="100%">
<div style="border:1px solid #bdbdbd; margin-top: 35px;">
<table width="100%" cellpadding="0" cellspacing="0" style="background: #fff;">
<tr>
<td style="background: #6A6A6A;     padding: 0px 20px; color: #fff" colspan="4" >
<h3><?php echo "$day_to "; ?>, {{ $stop_date_print}}</h3>

</td>
</tr>
<tr>
<td style="padding: 0px 20px;">
<p style="font-size: 12px; color: #696868;     line-height: 2;">
@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{$flight_detail['dname']}} @endif
</p>
</td>
<td style="padding: 0px 20px;">
<p>
@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif<br>
<span style="font-size: 11px; color: #696868;     line-height: 2;">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</span>
</p>
</td>
<td style="padding: 0px 49px;width: 46%;">
<img src="{{url('/public/uploads/icons/planevenue.png')}}" width="250px">
<br>
<span style="font-size: 11px; color: #696868; margin-left:21% ">@if(array_key_exists("dnumberstop", $flight_detail) && $flight_detail['dnumberstop']!="") {{$flight_detail['dnumberstop']}} @endif</span>
</td>
<td style="padding: 0px 20px;">
<p>
@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif <br>
<span style="font-size: 11px; color: #696868;     line-height: 2;"> @if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</span>
</p>
</td>

</tr>


</table>
</div>
</td>	
</tr>

@endif
<!-- //test -->

</table>
<?php
$acco=unserialize($data->option2_accommodation);

?>

<table width="100%">
<tr>
<td>
<h3 style="text-align: left;margin-bottom:9px;margin-top:30px;">Hotel Details</h3>
</td>
</tr>

</table>
@foreach($acco as $acco_data)


<table width="100%">
<!--  -->
<table width="100%">

<tr width="100%">
<td>
<b style="text-align: left; margin: 0px;font-size: 13px;position: relative;
top: -12px;"> <img src="{{url('/resources/views/query/mail/mail_img/bed.jpg')}}" style="position: relative; top: 10px;">
@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="Other")

{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}} 
@elseif($acco_data["hotel"]=="Other")

{{$acco_data["other_hotel"]}}

@endif
@endif
</b>
</td>
</tr>
</table>
<!--  -->
<tr>
<td width="100%">
<div style="border:1px solid #bdbdbd;">
<table width="100%" style="background: #fff;">

<tr>
<td style="padding:6px 0px 4px 11px;     width: 20%;">
	@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="Other")

<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" style="width: 200px;">
@elseif($acco_data["hotel"]=="Other")



@endif

@endif


</td>
<td style="padding: 0px 20px;     width: 24%;">

<p style=" font-size: 13px;">
@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="Other")

{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}} 
@elseif($acco_data["hotel"]=="Other")

{{$acco_data["other_hotel"]}}

@endif
@endif

</p>

<!--<p style="font-size: 12px; color: #696868;">5963,Kuta Beach Road <br>Kuta, Bali<br>Indonesia<br>1 Room(s)+0 Extra Bed
</p>-->
</td>
<td valign="top">
<p>
@if($acco_data["star"]!="" && $acco_data["star"]!="Other")
{{CustomHelpers::get_star_rating($acco_data["star"])}}

@elseif($acco_data["star"]=="Other")
{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
@endif
</p>
</td>

<td colspan="2" style="padding: 5px 20px;">
<div style="border-left:1px solid gray; padding:10px 35px;">
<?php
$day1="0";
$day="0";
?>
@if($acco_data!="" && array_key_exists("day",$acco_data)) 
<?php
$day1=(int)filter_var($acco_data["day"]["0"], FILTER_SANITIZE_NUMBER_INT);
$day1=$day1-1;


?>
@endif
<?php
$datefrom_checkin = "$datefrom_year-$datefrom_day-$datefrom_month";


$checkin_date = date('Y-m-d', strtotime($datefrom_checkin . ' +'.$day1.' days'));
$checkin_date_print= date("d M'y", strtotime($checkin_date));
$day_checkin = strtotime($checkin_date);
$day_checkin = date('D', $day_checkin);

?>
@if($acco_data!="" && array_key_exists("day",$acco_data)) 
@foreach($acco_data["day"] as $accday)
<?php
$day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT);
?>

@endforeach
@endif
<?php
$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";


$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
$checkout_date_print= date("d M'y", strtotime($checkout_date));
$day_checkout = strtotime($checkout_date);
$day_checkout = date('D', $day_checkout);

?>
<p style="font-size: 14px; color: #696868;"><b>
	<?php 
     $date1=date_create($checkin_date);
     $date2=date_create($checkout_date);
    $diff=date_diff($date1,$date2);
   
	
	?>
	{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b></p>
<p style="font-size: 11px; color: #696868;">





Check In - <?php echo $day_checkin; ?>,  {{$checkin_date_print}} 

</p>
<p style="font-size: 11px; color: #696868;">




Check Out - <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
</div>
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>

@endforeach

@php
$itinerary_data=unserialize($data->option2_dayItinerary);
$day="1";
@endphp

@if(empty($itinerary_data) || $itinerary_data=="N;")
  
@else


<table width="100%">
<tr>
<td>
<h3 class="inclusions_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Tour Itinerary</h3>
</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #bdbdbd;">
<tr style="background: #fff;">
<td style="padding: 20px 20px;" >
<h3>Tour Itinerary</h3>
<div style="background: #fff;line-height: 22px;font-size: 14px;color: #636363;">
@foreach($itinerary_data as $itinerary_datas)

<h3>Day {{$day++}} : {{$itinerary_datas['title']}}</h3>	

<span> {!!$itinerary_datas['desc']!!}</span>




@endforeach
</div>

</td>
</tr>
</table>
@endif
<table width="100%">
<tr>
<td>
<h3 class="inclusions_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Inclusions</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">

	{!!$data->option2_inclusions!!}


</td>
</tr>
</table>
<!-- next -->
<table width="100%">
<tr>
<td>
<h3 class="my_h3">Exclusions</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
	<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">

	{!!$data->option2_exclusions!!}


</td>

</tr>
</table>
<!-- next -->

@if($data->option2_visa=="1")
<table width="100%">
<tr>
<td>
<h3 class="my_h3">Visa</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">

	@if(empty($data->option2_package_visa) || $data->option2_package_visa=="N;")

	@else

	<?php

   $v_policy=unserialize($data->option2_package_visa);
   ?> 
@foreach($v_policy as $v)
{!!CustomHelpers::get_visa_policy($v)!!}</br>
@endforeach 

 @endif
{{ $data->option2_visa_policies }}

</td>

</tr>
</table>
@endif
<!-- next -->
@if(empty($data->option2_package_payment) || $data->option2_package_payment=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3">Payment Conditions</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
	<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">

	<?php

$p_policy=unserialize($data->option2_package_payment);
?> 

                                   

@foreach($p_policy as $v)
{!!CustomHelpers::get_payment_policy($v)!!}</br>
@endforeach

{{$data->option2_payment_policies}} 

</td>

</tr>
</table>
@endif
<!-- next -->
@if(empty($data->option2_package_can) || $data->option2_package_can=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3">Cancellation Conditions</h3>
</td>
</tr>
</table>
<table  width="100%">
<tr>
	<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">

	<?php

$c_policy=unserialize($data->option2_package_can);
?> 

                                   

@foreach($c_policy as $v)
{!!CustomHelpers::get_cancel_policy($v)!!}</br>
@endforeach
{{$data->option2_cancellation}}    

</td>
<td>


</td>
</tr>
</table>
@endif
<!-- next -->
@if(empty($data->option2_package_impnotes) || $data->option2_package_impnotes=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3">Important Notes</h3>
</td>
</tr>
</table>
<table  width="100%">
<tr>
	<td style="padding: 15px 36px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;">
<?php

$important_notes=unserialize($data->option2_package_impnotes);
?> 

                                   

@foreach($important_notes as $v)
{!!CustomHelpers::get_impnotes($v)!!}</br>
@endforeach


                                          
{{$data->option2_extra_imp}}  

</td>
<td>


</td>
</tr>
</table>
@endif
<br><br><br>

@if($data!="" && $data->option2_quotation_footer!="" && $data->option2_quotation_footer!="N;")
<?php
$footer=unserialize($data->option2_quotation_footer);


?>
@foreach($footer as $footer_data)
{!! CustomHelpers::get_quotation_footer($footer_data) !!}
@endforeach
@endif


<br><br> 

<i><b>H.O. Address: <a href="https://www.theworldgateway.com/" target="_blank">TheWorldGateway.com</a>, 20th Floor, Building No. 25, Gurgaon - 122 002, India</b></i>





<table style="height: 60px; margin-top:20px;  background: #01B7F2;" width="100%" >
<tr>
<td style="height: 60px;    background: #01B7F2;"><p style="text-align: center; color: #fff;"><i>&copy; 2019 TheWorldGateway.com</i></p> </td>
</tr>
</table>
<br><br> 

<i><b>Click Here: <a href="{{url('/TheWorldGateway/'.$data->unique_code)}}" target="_blank">Quotation Details</a></b></i>

<br><br> 
</body>
</html>