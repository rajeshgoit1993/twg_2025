<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!--[if gte mso 9]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]-->
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="date=no" />
<meta name="format-detection" content="address=no" />
<meta name="format-detection" content="telephone=no" />
<meta name="x-apple-disable-message-reformatting" />
<!--[if !mso]><!-->
<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i|Rozha+One" rel="stylesheet" />
<!--<![endif]-->
<title>Quotation</title>
<!--[if gte mso 9]>
<style type="text/css" media="all">
sup { font-size: 100% !important; }
</style>
<![endif]-->

 
<style type="text/css">
body{


}
ul{



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

@media only screen and (max-device-width: 480px)
{

	table
	{
		width: 100% !important;
	}
	.menu  li 
	{
	font-size: 12px !important;
    }
   .menu_right li a
   {
	padding: 3px 6px !important;
	font-size: 12px !important;
   }
   .mobile_font
   {
   	font-size: 12px !important;
   }



}



</style>



</head>
<body>

<div class="destop_quo">
	<table width="50%">
	<tr>
<td style="height: 40px; background: #fff;" >
<ul class="menu" style="border: none;
display: inline-block;
float: left;
margin: 0;padding: 0px">
<li style="float: left;list-style: none;margin-left: 0px;font-size: 18px">
	@if(env("WEBSITENAME")==1)
<a href="https://www.theworldgateway.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">TheWorldGateway.com</a>
@elseif(env("WEBSITENAME")==0)
<a href="http://www.rapidextravels.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Rapidex Travels</a>
@endif
</li>

</ul>
</td>
<td>
<ul class="menu menu_right" style="border: none;
display: inline-block;
float: right;
margin: 0;">
<li style="float: left;list-style: none;">
	<a href="{{url('/quotes/'.$data->unique_code)}}" target="_blank" style="text-decoration: none;font-weight: bold;color: #fff;background: #08b2ed;padding: 8px 12px;font-size: 18px ">Access Your Quote</a></li>

</ul>

</td>

</tr>
<tr>
<td colspan="2">
	<hr>
</td>	
</tr>
<tr>
	<td colspan="2">
		<h3 style="color: #d03c0f;margin-top: 0px">Your Quote(s) are Ready</h3>
	</td>
</tr>
<tr>
<td colspan="2">
@if($data!="" && $data->option4_quotation_header!="" && $data->option4_quotation_header!="N;")
<?php
$header=unserialize($data->option4_quotation_header);


?>
<!--@foreach($header as $header_data)
{!! CustomHelpers::get_quotation_header($header_data) !!}
@endforeach-->
@endif
{!! $data->option4_quotation_header_extra !!}

<p class="mobile_font" style="font-size: 17px" >Below is the link to the original quote in case you have lost track of it, <a href="{{url('/quotes/'.$data->unique_code)}}" target="_blank">you can review the details here</a></p>
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



<h3 style="margin-bottom:3px">You've Requested</h3>
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Package Name : {{$data->custom_package_name}}</p>
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Source : {{$data->source}}</p>
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Tour Date : <?php echo "$day_from "; ?>,{{$datefrom_print}} - <?php echo "$day_to "; ?>,{{ $stop_date_print}}</p>

@if($data->option4_price_type=="Per Person")
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Package Price : Rs. <?php
          CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data->option4_price,'adult'));
            ?>
            	
            </p>
 <p class="mobile_font" style="margin:2px 0px;font-size: 17px">Discounts : Rs.  <?php
    CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data->option4_price,'adult'));
     ?>
            	
            </p>
  <p class="mobile_font" style="margin:2px 0px;font-size: 17px">Total : Rs. <?php
      CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data->option4_price,'adult'));
		?> 
            	
            </p>
@elseif($data->option4_price_type=="Group Price")
<?php
$option4_adult=CustomHelpers::get_quotation_pricel($data->option4_price,'adult');
$option4_extradult=CustomHelpers::get_quotation_pricel($data->option4_price,'exadult');
$option4_child=CustomHelpers::get_quotation_pricel($data->option4_price,'childbed');
$option4_childwithoutbed=CustomHelpers::get_quotation_pricel($data->option4_price,'childwbed');
$option4_infant=CustomHelpers::get_quotation_pricel($data->option4_price,'infant');
$option4_single=CustomHelpers::get_quotation_pricel($data->option4_price,'single');
$option4_total=($option4_adult*2) + $option4_extradult + $option4_child + $option4_childwithoutbed + $option4_infant + $option4_single;

?>
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Package Price : Rs. 
	 <?php
      CustomHelpers::get_indian_currency($option4_total);
	?> 
</p>
<?php
$option4_adult_discount=CustomHelpers::get_quotation_discount($data->option4_price,'adult');
$option4_extradult_discount=CustomHelpers::get_quotation_discount($data->option4_price,'exadult');
$option4_child_discount=CustomHelpers::get_quotation_discount($data->option4_price,'childbed');
$option4_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data->option4_price,'childwbed');
$option4_infant_discount=CustomHelpers::get_quotation_discount($data->option4_price,'infant');
$option4_single_discount=CustomHelpers::get_quotation_discount($data->option4_price,'single');
$option4_total_discount=($option4_adult_discount*2) + $option4_extradult_discount + $option4_child_discount + $option4_childwithoutbed_discount + $option4_infant_discount + $option4_single_discount;


?>

<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Discounts: : Rs. <?php
      CustomHelpers::get_indian_currency($option4_total_discount);
	?>
            	
</p>
<p class="mobile_font" style="margin:2px 0px;font-size: 17px">Total : Rs.  <?php
      CustomHelpers::get_indian_currency($option4_total-$option4_total_discount);
	?>
            </p>
@endif


<h2><a href="{{url('/quotes/'.$data->unique_code)}}" target="_blank">Click Here to View Your Quote</a></h2>
</td>


</tr>
<tr>
	<td colspan="2">
		@if($data!="" && $data->option4_quotation_footer!="" && $data->option4_quotation_footer!="N;")
<?php
$footer=unserialize($data->option4_quotation_footer);


?>

@endif


{!! $data->option4_quotation_footer_extra !!}
	</td>
</tr>
</table>
</div>

</body>
</html>