	
<div class="row">
<div class="col-md-12" style="overflow-x:auto;">
	

@if($data3!="" && $data3->option3_quotation_header!="" && $data3->option3_quotation_header!="N;")
<?php
$header=unserialize($data3->option3_quotation_header);


?>
@foreach($header as $header_data)
{!! CustomHelpers::get_quotation_header($header_data) !!}
@endforeach
@endif
@if($data1->accept_status=="0" && $data1->send_option=="1")
@include("query.quotation_webpage.accept")

@endif
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="package_name" style="margin-top: 10px">
<h3 style="margin-top:15px;margin-bottom:0px;color: #fff">{{$data3->custom_package_name}}</h3>

<h4 style="margin-top:10px;margin-bottom:0px;color: #fff">   {{$data3->duration-1}} Nights & {{$data3->duration}} Days</h4>
@if($data3->option3_transport=="Flight")
<img src="{{url('/resources/views/query/mail/mail_img/plane.png')}}" width="40px;" height="43px" style="margin-right:5px;margin-top:7px;margin-bottom: 10px;padding-bottom: 3px">
@endif
<img src="{{url('/resources/views/query/mail/mail_img/eye.png')}}" width="40px;" height="40px" style="margin-right:10px;margin-bottom: 10px;">

<img src="{{url('/resources/views/query/mail/mail_img/bed.png')}}" width="40px" height="40px" style="margin-right:10px;margin-bottom: 10px;">

<img src="{{url('/resources/views/query/mail/mail_img/ipod.png')}}" width="40px" height="40px" style="margin-right:10px;margin-bottom: 10px;">
</div>
<div class="col-md-12">
<div class="source_point">
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<div class="source_content">
			
<span style="font-size: 15px; color: #696868;     line-height: 2;">From</span><br>
{{$data3->source}}
		</div>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="source_content">
	<span style="font-size: 15px; color: #696868;     line-height: 2;">Date</span><br>
<?php
 
$originalDate = CustomHelpers::get_query_field($data3->query_reference,'date_arrival');

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

$to_days=$data3->duration-1;

$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
$stop_date_print= date("d M'y", strtotime($stop_date));
$day_to = strtotime($stop_date);
$day_to = date('D', $day_to);
?>

<?php echo "$day_from"; ?>, {{$datefrom_print}} - <?php echo "$day_to"; ?>, {{ $stop_date_print}}	
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
@if($data3->option3_price_type=="Per Person")
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Package Price:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
		<div style="text-align: right;font-size: 15px;font-weight: bold;">
			<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png"> 
            <?php
          CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data3->option3_price,'adult'));
            ?>   


		</div>
</div>
</div>
</div>
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Discounts:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
	<div style="text-align: right;font-size: 15px;font-weight: bold;">
		<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png"> 
     <?php
    CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data3->option3_price,'adult'));
     ?>

		
	</div>
</div>
</div>
</div>
<hr style="margin:0px">
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Price to pay:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
	<div style="text-align: right;font-size: 15px;font-weight: bold;">
		<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png">
		<?php
      CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data3->option3_price,'adult'));
		?> 
		<br>
		<span style="font-weight: bold;font-size: 8px">( {{ $data3->anything }} )</span>
	</div>
</div>
</div>
</div>

@elseif($data3->option3_price_type=="Group Price")
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Package Price:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
		
<?php
$option3_adult=CustomHelpers::get_quotation_pricel($data3->option3_price,'adult');
$option3_extradult=CustomHelpers::get_quotation_pricel($data3->option3_price,'exadult');
$option3_child=CustomHelpers::get_quotation_pricel($data3->option3_price,'childbed');
$option3_childwithoutbed=CustomHelpers::get_quotation_pricel($data3->option3_price,'childwbed');
$option3_infant=CustomHelpers::get_quotation_pricel($data3->option3_price,'infant');
$option3_single=CustomHelpers::get_quotation_pricel($data3->option3_price,'single');
$option3_total=($option3_adult*2) + $option3_extradult + $option3_child + $option3_childwithoutbed + $option3_infant + $option3_single;

?>
<div style="text-align: right;font-size: 15px;font-weight: bold;">
	<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png">
    <?php
      CustomHelpers::get_indian_currency($option3_total);
	?> 
</div>
</div>
</div>
</div>
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Discounts:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
<?php
$option3_adult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'adult');
$option3_extradult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'exadult');
$option3_child_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childbed');
$option3_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childwbed');
$option3_infant_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'infant');
$option3_single_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'single');
$option3_total_discount=($option3_adult_discount*2) + $option3_extradult_discount + $option3_child_discount + $option3_childwithoutbed_discount + $option3_infant_discount + $option3_single_discount;


?>
<div style="text-align: right;font-size: 15px;font-weight: bold;">
	<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png"> 
   <?php
      CustomHelpers::get_indian_currency($option3_total_discount);
	?>

</div>


</div>
</div>
</div>
<hr style="margin:0px">
<div class="price_data">
	<div class="row">
<div class="col-md-8 col-sm-6 col-xs-6">
	<strong>Price to pay:</strong>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
	<div style="text-align: right;font-size: 15px;font-weight: bold;">
		<img src="http://imgak.mmtcdn.com/holidays/images/quotemanager/rupee.png">

        <?php
      CustomHelpers::get_indian_currency($option3_total-$option3_total_discount);
	?>

	
		<br>
		<span style="font-weight: bold;font-size: 8px">( {{ $data3->anything }} )</span>

	</div>
	
</div>
</div>
</div>


@endif
<!---->
@if($data3->option3_validaty!="")
<div class="col-md-8 col-sm-6 col-xs-6">
	<p>Quote validity:</p>
</div>
<div class="col-md-4 col-sm-6 col-xs-6">
<div style="text-align: right;font-size: 15px;font-weight: bold;">

	{{ date("d M'y", strtotime($data3->option3_validaty)) }}
</div>
	</div>
	@endif
<!---->

<i>
 <?php 
$total_traveler="0";
$adult=CustomHelpers::get_query_field($data3->query_reference,'span_value_adult');
$child=CustomHelpers::get_query_field($data3->query_reference,'span_value_child');
$infant=CustomHelpers::get_query_field($data3->query_reference,'span_value_infant'); 
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
//echo $total_traveler;
?> <!--traveller(s)--></i>

</div>
</div>

</div>
</div>


</div>
</div>


<!--Flight Detail Start-->
@if($data3->option3_transport=="Flight")
<?php
$flight_detail=unserialize($data3->option3_flight);

?>
<div class="row">
<div class="col-md-12">
<h3 style="text-align: left; margin: 15px 0px 5px 0px;
top: 30px;">Flight Details</h3>	

<b style="text-align: left; margin: 0px;font-size: 15px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 4px;">
@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif to  @if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif

</b>
</div>
<div class="col-md-12">
<div class="package_name">
	 @if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
	 <?php
	 $originalDate_flight = $flight_detail['onwarddate'];
     $newDate_flight = date("d M'y", strtotime($originalDate_flight));
	 ?>
<h3 style="color: #fff;margin-top: 4px;margin-bottom: 0px">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</h3>
	  @endif 
	  @endif
</div>
<div class="col-md-12">
<div class="source_point">
<div class="row">
<div class="col-md-12">
<ul class="flight_details">
	<li>
		<strong>@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</strong>
		<br>
		<center>
			@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif
		</center>
	</li>
	<li>
		<strong>
			@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif
		</strong>
		<br>
		<center>
			@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif
		</center>
	</li>
	<li class="flight_image">
		<img src="{{url('/public/uploads/icons/planevenue.png')}}">
        <br>
        <center>
        	@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif
        </center>
	</li>
	<li>
		<strong>
			@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif
		</strong>
		<br>
		<center>
			@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif
		</center>
	</li>
	
</ul>	



</div>
</div>


</div>
</div>

</div>
<!--down-->
<div class="col-md-12" style="margin-top: -13px">

<br>
<b style="text-align: left; margin: 0px;font-size: 15px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 4px;transform: scaleX(-1);">
@if($flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif to @if($flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif

</b>
</div>
<div class="col-md-12">
<div class="package_name">
	 @if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
	 <?php
	 $originalDate_flight_down = $flight_detail['downwarddate'];
     $newDate_flight_down = date("d M'y", strtotime($originalDate_flight_down));
	 ?>
<h3 style="color: #fff;margin-top: 4px;margin-bottom: 0px">{{date('D', strtotime($originalDate_flight_down))}}, {{$newDate_flight_down}}</h3>
	  @endif 
	  @endif
</div>
<div class="col-md-12">
<div class="source_point">
<div class="row">
<div class="col-md-12">
<ul class="flight_details">
	<li>
<strong>
	@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{$flight_detail['dname']}} @endif
</strong>
<br>
		<center>
			@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{$flight_detail['dno']}} @endif
		</center>
		
	</li>
	<li>
		<strong>
			@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif
		</strong>
		<br>
		<center>
			@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif
		</center>
	</li>
	<li class="flight_image">
		<img src="{{url('/public/uploads/icons/planevenue.png')}}">
        <br>
        <center>
        	@if(array_key_exists("dnumberstop", $flight_detail) && $flight_detail['dnumberstop']!="") {{$flight_detail['dnumberstop']}} @endif
        </center>
	</li>
	<li>
		<strong>
			@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif
		</strong>
		<br>
		<center>
			@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif
		</center>
	</li>
	
</ul>	



</div>
</div>


</div>
</div>

</div>
</div>
@elseif($data3->option3_transport!="0")
<table width="100%">
<tr>
<td>
<h3 class="my_h3">{{$data3->option3_transport}}</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
	<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">
                                  
{{$data3->option3_transport}}

</td>

</tr>
</table>

@endif
<!--Flight Detail End-->

<!--start start-->
<div class="row">
<div class="col-md-12">
<h3 style="text-align: left; margin: 20px 0px 5px 0px;
">Hotel Details</h3>	


</div>
<?php
$acco=unserialize($data3->option3_accommodation);
$i="1";

?>

@foreach($acco as $acco_data)
<div class="col-md-12">

@if($i>1)
<br>
@endif
<b style="text-align: left; margin: 0px;font-size: 13px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/bed.jpg')}}" style="position: relative; top: -4px;">
@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")

{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}} 

@elseif($acco_data["hotel"]=="other")

{{$acco_data["other_hotel"]}}

@endif
@endif

</b>
<div class="hotel_data">
<div class="row">
<div class="col-md-2 col-sm-2 col-xs-12">
<div class="hotel_image">
@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")

<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" >
@elseif($acco_data["hotel"]=="other")

<img src="{{ url('/public/uploads/no-image.png') }}" >

@endif

@endif	
</div>
</div>
<div class="col-md-5 col-sm-5 col-xs-12">
<div class="hotel_name" style="font-size: 15px">
@if(array_key_exists("hotel",$acco_data))
@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")

{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}} 
@elseif($acco_data["hotel"]=="other")

{{$acco_data["other_hotel"]}}

@endif
@endif

<p style="margin-bottom: 5px">
	@if(array_key_exists("star",$acco_data))
	@if($acco_data["star"]!="" && $acco_data["star"]!="other")
{{CustomHelpers::get_star_rating($acco_data["star"])}}

@elseif($acco_data["star"]=="other")
{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
@endif
@endif
</p>
@if($acco_data["category"]!="")
<p style="font-size: 13px">Room: {{$acco_data["category"]}}</p>
@endif
</div>
</div>
<div class="col-md-5 col-sm-5 col-xs-12">
<div class="check_out">
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
<p style="font-size: 15px; color: #696868;"><b>
	<?php 
     $date1=date_create($checkin_date);
     $date2=date_create($checkout_date);
    $diff=date_diff($date1,$date2);
   
	
	?>
	{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b></p>
<p style="font-size: 13px; color: #696868;">





Check-in: <?php echo $day_checkin; ?>, {{$checkin_date_print}} 

</p>
<p style="font-size: 13px; color: #696868;">




Checkout: <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
</div>	
</div>
</div>
</div>
</div>
<?php
$i++;
?>
@endforeach
</div>

<!--hotel end-->

<!-- next -->



@php
$itinerary_data=unserialize($data3->option3_dayItinerary);
$day=1;
@endphp

@if(empty($itinerary_data) || $itinerary_data=="N;")
  
@else

@if($itinerary_data["day1"]["title"]!="")


<table width="100%">
<tr>
<td>
<h3 class="inclusions_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Tour Itinerary</h3>
</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #bdbdbd;">
<tr style="background: #fff;">
<td style="padding: 20px 8px;" >
<h3>Tour Itinerary</h3>
<div style="background: #fff;line-height: 22px;font-size: 14px;color: #636363;">
@foreach($itinerary_data as $itinerary_datas)

<h3 class="ite_data">Day {{$day++}} : {{$itinerary_datas['title']}}</h3>	

<span> {!!$itinerary_datas['desc']!!}</span>




@endforeach
</div>

</td>
</tr>
</table>
@endif
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
<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">

	{!!$data3->option3_inclusions!!}


</td>
</tr>
</table>
<!-- next -->
<table width="100%">
<tr>
<td>
<h3 class="my_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Exclusions</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
	<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">

	{!!$data3->option3_exclusions!!}


</td>

</tr>
</table>
<!-- next -->

@if($data3->option3_visa=="1")
<table width="100%">
<tr>
<td>
<h3 class="my_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Visa</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">

	@if(empty($data3->option3_package_visa) || $data3->option3_package_visa=="N;")

	@else

	<?php

   $v_policy=unserialize($data3->option3_package_visa);
   ?> 
@foreach($v_policy as $v)
{!!CustomHelpers::get_visa_policy($v)!!}</br>
@endforeach 

 @endif
{{ $data3->option3_visa_policies }}

</td>

</tr>
</table>
@endif
<!-- next -->
@if(empty($data3->option3_package_payment) || $data3->option3_package_payment=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Payment Conditions</h3>
</td>
</tr>
</table>
<table width="100%">
<tr>
	<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">

	<?php

$p_policy=unserialize($data3->option3_package_payment);
?> 

                                   

@foreach($p_policy as $v)
{!!CustomHelpers::get_payment_policy($v)!!}</br>
@endforeach

{{$data3->option3_payment_policies}} 

</td>

</tr>
</table>
@endif
<!-- next -->
@if(empty($data3->option3_package_can) || $data3->option3_package_can=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Cancellation Conditions</h3>
</td>
</tr>
</table>
<table  width="100%">
<tr>
	<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">

	<?php

$c_policy=unserialize($data3->option3_package_can);
?> 

                                   

@foreach($c_policy as $v)
{!!CustomHelpers::get_cancel_policy($v)!!}</br>
@endforeach
{{$data3->option3_cancellation}}    

</td>
<td>


</td>
</tr>
</table>
@endif
<!-- next -->
@if(empty($data3->option3_package_impnotes) || $data3->option3_package_impnotes=="N;")
  
@else
<table width="100%">
<tr>
<td>
<h3 class="my_h3" style="margin-left: 7px;margin-bottom: 8px;margin-top: 22px; ">Important Notes</h3>
</td>
</tr>
</table>
<table  width="100%">
<tr>
	<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">
<?php

$important_notes=unserialize($data3->option3_package_impnotes);
?> 

                                   

@foreach($important_notes as $v)
{!!CustomHelpers::get_impnotes($v)!!}</br>
@endforeach


                                          
{{$data3->option3_extra_imp}}  

</td>
<td>


</td>
</tr>
</table>
@endif
@if($data1->accept_status=="0" && $data1->send_option=="1")
@include("query.quotation_webpage.accept")

@endif
<br><br><br>

@if($data3!="" && $data3->option3_quotation_footer!="" && $data3->option3_quotation_footer!="N;")
<?php
$footer=unserialize($data3->option3_quotation_footer);


?>
@foreach($footer as $footer_data)
{!! CustomHelpers::get_quotation_footer($footer_data) !!}
@endforeach
@endif


<br><br> 
</table>
</div>


</div>