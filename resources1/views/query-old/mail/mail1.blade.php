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
				table {
					width: 100% !important;
				}		
			#Email_Quotation {
				background-color: #0000;
			}
			
			#logo-text {
				font-size: 16px !important;
				float: left;
				list-style: none;
				margin-left: 0px;
				font-family: Arial Rounded MT;
				font-style: normal;
				font-weight: bold;
				text-decoration: none;
				float: left;
			}
			
			#access_quote {
				padding: 10px 10px 10px 10px;
				border-radius: 5px;
				background-color: #E7E7E7;
				float: right;
				display: inline;
				font-family: lato;
				font-size: 14px;
				color: #0061E6;
				font-style: normal;
				font-weight: bold;
				text-align: center;
				text-decoration: none;
				float: right;
			}
			
			.menu a:hover{
			color: #01b7f2;
			}
			
			.separator {
				fill: transparent;
				stroke: #707070;
				stroke-width: 2px;
				stroke-linejoin: miter;
				stroke-linecap: butt;
				stroke-miterlimit: 4;
				shape-rendering: auto;
				margin-top: 10px;
				margin-bottom: 10px;
				width: 100%;
			}
			
			.quote_ready {
				font-size: 16px;
				font-family: Lato;
				font-style: normal;
				font-weight: bold;
				color: #d03c0f;
				margin-bottom: 10px;
			}
			
			.requested {
				font-size: 18px;
				font-family: Lato;
				font-style: normal;
				font-weight: bold;
				margin-bottom: 20px;
				margin-top: 20px;
			}
			
			.link_below {
				font-size: 15px;
				font-family: Lato;
				font-style: normal;
				font-weight: normal;
				margin-top: 20px;
				margin-bottom: 20px;
			}
					
			.mobile_font {
				margin-bottom: 6px;
				font-size: 14px;
				font-family: Lato;
				font-style: normal;
				font-weight: normal;
			}
					  
			.text {
				font-size: 15px;
				font-family: Lato;
				font-style: normal;
				font-weight: normal;
				color: #0001;
				text-align: left;
			}
			
			@media screen and (max-width: 480px) 
			{
				table {
					width: 100% !important;
				}
				
				.menu
				{
					font-size: 12px !important;
					float: left;
					list-style: none;
					margin-left: 0px;
					font-family: Arial Rounded MT;
					font-style: normal;
					font-weight: bold;
				}
			}
		</style>
	</head>
	<body>
		<div id="Email_Quotation">
			<table width="100%">
				<tr>
					<td style="height: 40px;background-color: #ffff;" >
						<div id="logo-text" >
						<span>
							@if(env("WEBSITENAME")==1)
							<a href="https://www.theworldgateway.com/" target="_blank" style="text-decoration: none;letter-spacing: 0px;color: #676767;"><span>TheWo</span><span style="color:#DC1F3E;">rl</span><span style="color: #676767;">d</span><span style="color:#DC1F3E;">Gateway</span></a>
							@elseif(env("WEBSITENAME")==0)
							<a href="http://www.rapidextravels.com/" style="text-decoration: none;letter-spacing: 1px;font-weight: bold;color: #000;">Rapidex Travels</a>
							@endif
							</span>
						</div>
					</td>
					<td>
						<div id="access_quote">
							<a href="{{ url('/quotes/'.$data->unique_code) }}" target="_blank;">Access Your Quote</a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="separator" colspan="2">
					<hr>
					</td>
				</tr>
				<tr>
					<div class="quote_ready" colspan="2">
						<span>Your Quote(s) are Ready</span>
					</div>
				</tr>
				<tr>
					<td class="text" colspan="2">
						<!--welcome greetings-->
						@if($data!="" && $data->option1_quotation_header!="" && $data->option1_quotation_header!="N;")
						<?php
						$header=unserialize($data->option1_quotation_header);
						?>
						<!--@foreach($header as $header_data)
						{!! CustomHelpers::get_quotation_header($header_data) !!}
						@endforeach-->
						@endif
						{!! $data->option1_quotation_header_extra !!}
						<div class="link_below">Below is the link to the original quote in case you have lost track of it, <a href="{{url('/quotes/'.$data->unique_code)}}" target="_blank">you can review the details here</a></div>
						
						<!--Tour Date-->
						<?php
						$originalDate = CustomHelpers::get_query_field($data->query_reference,'date_arrival');
							if($originalDate=="N" || $originalDate==""):
							$originalDate=date("d-m-Y");
							endif;
							$datefrom = str_replace(' ', '', $originalDate);
							$datefrom=explode("-", $datefrom);
							$datefrom_year=$datefrom["2"];
							$datefrom_day=$datefrom["1"];
							$datefrom_month=$datefrom["0"];
							$datefrom=$datefrom_year."-".$datefrom_month."-".$datefrom_day;
							$datefrom = "$datefrom_year-$datefrom_day-$datefrom_month";
							
							$stop_date = $datefrom;
							$date_to=$datefrom;
							$datefrom_print = date("d M, Y", strtotime($datefrom));
							$day_from = strtotime($datefrom);
							$day_from = date('D', $day_from);

							$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$data->duration.' days'));
							$stop_date_print= date("d M, Y", strtotime($stop_date));
							$day_to = strtotime($stop_date);
							$day_to = date('D', $day_to);
						?>
						<div class="requested">You've Requested</div>
						<div class="mobile_font">Package Name : <b>{{ $data->custom_package_name }}</b></div>
						<div class="mobile_font">Departure City : <b>{{ $data->source }}</b></div>
						<!--Date format: Fri,04 Oct'19-->
						<!--<div class="mobile_font">Tour Date : <b><?php echo "$day_from"; ?>,{{ $datefrom_print }} - <?php echo "$day_to"; ?>,{{ $stop_date_print }}</b></div><-->
						<!--Date format: 04 Oct'19-->
						<div class="mobile_font">Tour Date : <b>{{ $datefrom_print }} - {{ $stop_date_print }}</b></div>
						<!--price-->
						@if($data->option1_price_type=="Per Person")
						<div class="mobile_font">Package Price : <b>Rs. <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data->option1_price,'adult')); ?></b></div>
						<div class="mobile_font"><i>Discount(-) : <b>Rs. <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data->option1_price,'adult')); ?></b></i></div>
						<div class="mobile_font">Price To PAY : <b>Rs. <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data->option1_price,'adult')); ?></b></div>
						@elseif($data->option1_price_type=="Group Price")
							<?php
							$option1_adult=CustomHelpers::get_quotation_pricel($data->option1_price,'adult');
							$option1_extradult=CustomHelpers::get_quotation_pricel($data->option1_price,'exadult');
							$option1_child=CustomHelpers::get_quotation_pricel($data->option1_price,'childbed');
							$option1_childwithoutbed=CustomHelpers::get_quotation_pricel($data->option1_price,'childwbed');
							$option1_infant=CustomHelpers::get_quotation_pricel($data->option1_price,'infant');
							$option1_single=CustomHelpers::get_quotation_pricel($data->option1_price,'single');
							$option1_total=($option1_adult*2) + $option1_extradult + $option1_child + $option1_childwithoutbed + $option1_infant + $option1_single;
							?>
						<div class="mobile_font">Package Price : <b>Rs. <?php CustomHelpers::get_indian_currency($option1_total); ?></b></div>
						<!--Discount-->
							<?php
							$option1_adult_discount=CustomHelpers::get_quotation_discount($data->option1_price,'adult');
							$option1_extradult_discount=CustomHelpers::get_quotation_discount($data->option1_price,'exadult');
							$option1_child_discount=CustomHelpers::get_quotation_discount($data->option1_price,'childbed');
							$option1_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data->option1_price,'childwbed');
							$option1_infant_discount=CustomHelpers::get_quotation_discount($data->option1_price,'infant');
							$option1_single_discount=CustomHelpers::get_quotation_discount($data->option1_price,'single');
							$option1_total_discount=($option1_adult_discount*2) + $option1_extradult_discount + $option1_child_discount + $option1_childwithoutbed_discount + $option1_infant_discount + $option1_single_discount;
							?>
						<div class="mobile_font"><i>Discount (-) : <b>Rs. <?php CustomHelpers::get_indian_currency($option1_total_discount); ?></b></i></div>
						<!--Total Price-->
						<div class="mobile_font" style="margin-bottom: 0px;">Price To PAY : <b>Rs. <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data->option1_price,'adult')); ?></b></div>
						@endif
						<!--click here to view quote-->
						<div style="margin-top: 20px;margin-bottom: 20px;font-family: lato;font-size: 20px;color: #0061E6;font-weight: bold;font: normal;"><a href="{{ url('/quotes/'.$data->unique_code) }}" target="_blank">Click Here To View Your Quote</a></div>
					</td>
				</tr>
				<tr>
					<td class="text" colspan="2">
						<!--Signature-->
						@if($data!="" && $data->option1_quotation_footer!="" && $data->option1_quotation_footer!="N;")
						<?php $footer=unserialize($data->option1_quotation_footer); ?>
						@endif
						{!! $data->option1_quotation_footer_extra !!}
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>