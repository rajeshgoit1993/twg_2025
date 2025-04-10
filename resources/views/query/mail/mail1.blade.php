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
			
			.logo-text {
				font-size: 16px !important;
				float: left;
				list-style: none;
				margin-left: 0px;
				font-family: Arial Rounded MT;
				font-style: normal;
				font-weight: bold;
				text-decoration: none;
			}
			
			.access_quote {
				padding: 10px 10px 10px 10px;
				border-radius: 5px;
				background-color: #E7E7E7;
				float: right;
				display: inline-block;
				font-family: lato;
				font-size: 14px;
				color: #0061E6;
				font-style: normal;
				font-weight: bold;
				text-align: center;
				text-decoration: none;
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
			}
			
			.quote_ready {
				font-size: 16px;
				font-family: Lato;
				font-style: normal;
				font-weight: bold;
				color: #d03c0f;
				margin-bottom: 20px;
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
				/*color: #0001;*/
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
					<td style="height: 40px;background-color: #fff;" >
						<div class="logo-text" >
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
						<div class="access_quote">
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
						<span>Your Quote is Ready</span>
					</div>
				</tr>
				<tr>
					<td class="text" colspan="2">
						<!-- welcome greetings -->
						<p>Dear {{$data->name}},</p>

						@if($data!="" && $data->option1_quotation_header!="" && $data->option1_quotation_header!="N;")
						<?php
							$header=$data->option1_quotation_header;
							$header_data=DB::table('quotation_header')->where('id',$header)->first();
						?>
						@if($header_data!='')
							{!! $header_data->header_desc !!}
						@endif
						@endif
						{!! $data->option1_quotation_header_extra !!}

						<!-- quote link -->
						<div class="link_below">Below is the link to the original quote in case you have lost track of it, <a href="{{url('/quotes/'.$data->unique_code)}}" target="_blank">you can review the details here</a></div>
						
						<!--Tour Date-->
						<?php
							$originalDate = $data->tour_date;

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
						<div class="mobile_font">Departure City : <b>{{ $data->sourcecity }}</b></div>
						<!--Date format: Fri,04 Oct'19-->
						<!--<div class="mobile_font">Tour Date : <b><?php echo "$day_from"; ?>,{{ $datefrom_print }} - <?php echo "$day_to"; ?>,{{ $stop_date_print }}</b></div><-->
						<!--Date format: 04 Oct'19-->
						<div class="mobile_font">Tour Date : <b>{{ $datefrom_print }} - {{ $stop_date_print }}</b></div>

						<!-- Tour Price -->
						<?php
						$price_data_first=CustomHelpers::get_price_part_seperate($data->option1_price,$data->quote1_number_of_adult,$data->extra_adult,$data->child_with_bed,$data->child_without_bed,$data->infant,$data->solo_traveller);
						?>

						<!-- per person price -->
						@if($data->option1_price_type=="Per Person")
						<!-- package price -->
						<div class="mobile_font">Package Price : <b>Rs. <?php CustomHelpers::get_indian_currency(round($price_data_first['query_total_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))); ?></b>
						</div>
						<!-- discount -->
						<div class="mobile_font">
							<i>Discount(-) : <b>Rs. <?php CustomHelpers::get_indian_currency(round($price_data_first['query_total_discount_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))); ?></b></i>
						</div>

						<!-- gst -->
						@if(round($price_data_first['query_total_gst_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))>0)
							<div class="mobile_font">
								<i>GST @if($price_data_first['query_gst_curr']==2)&nbsp;({{ $price_data_first['gst_percentage'] }}%) @endif  : <b>Rs. {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller)))}} </b></i>
							</div>
						@endif

						<!-- tcs -->
						@if(round($price_data_first['query_total_tcs_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))>0)
							<div class="mobile_font">
								<i>TCS @if($price_data_first['query_tcs_curr']==2)&nbsp;({{$price_data_first['tcs_percentage']}}%) @endif : <b>Rs. {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller)))}}</b></i>
							</div>
						@endif

						<!-- other -->
						@if(round($price_data_first['query_total_pg_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))>0)
							<div class="mobile_font">
								<i>PG @if($price_data_first['pg_charges']==2)&nbsp;({{$price_data_first['pgcharges_percentage']}}%) @endif : <b>Rs. {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller)))}}</b></i>
							</div>
						@endif

						<!-- price to pay -->
						<div class="mobile_font">Price To PAY : <b>Rs. <?php CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']/($data->quote1_number_of_adult+$data->extra_adult+$data->child_with_bed+$data->child_without_bed+$data->infant+$data->solo_traveller))); ?> (Per Person)</b>
						</div>

						<!-- group price -->
						@elseif($data->option1_price_type=="Group Price")
						<!-- package price -->
						<div class="mobile_font">Package Price : <b>Rs. <?php CustomHelpers::get_indian_currency($$price_data_first['query_total_group']); ?></b></div>
						
						<!-- discount -->
						<div class="mobile_font">
							<i>Discount(-) : <b>Rs. <?php CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']); ?></b></i>
						</div>

						<!-- gst -->
						@if(round($price_data_first['query_total_gst_group'])>0)
							<div class="mobile_font">
								<i>GST @if($price_data_first['query_gst_curr']==2)&nbsp;({{ $price_data_first['gst_percentage'] }}%) @endif : <b>Rs. {{ CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'])) }}</b></i>
							</div>
						@endif

						<!-- tcs -->
						@if(round($price_data_first['query_total_tcs_group'])>0)
							<div class="mobile_font">
								<i>TCS @if($price_data_first['query_tcs_curr']==2)&nbsp;({{ $price_data_first['tcs_percentage'] }}%) @endif : <b>Rs. {{ CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'])) }}</b></i>
							</div>
						@endif

						<!-- other -->
						@if(round($price_data_first['query_total_pg_group'])>0)
							<div class="mobile_font">
								<i>PG @if($price_data_first['pg_charges']==2) selected ({{$price_data_first['pgcharges_percentage']}}%) @endif : <b>Rs. {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']))}}</b></i>
							</div>
						@endif

						<!-- price to pay -->
						<div class="mobile_font" style="margin-bottom: 0px;">Price To PAY : <b>Rs. <?php CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult'])); ?> (Group Price)</b></div>
						@endif

						<!--click here to view quote-->
						<div style="margin-top: 20px;margin-bottom: 20px;font-family: lato;font-size: 20px;color: #0061E6;font-weight: bold;font: normal;">
							<a href="{{ url('/quotes/'.$data->unique_code) }}" target="_blank">Click Here To View Your Quote</a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="text" colspan="2">
						<!--Signature-->
						@if($data!="" && $data->option1_quotation_footer!="" && $data->option1_quotation_footer!="N;")
							<?php
							$footer_id=$data->option1_quotation_footer;
							$footer_data=DB::table('quotation_footer')->where('id',$footer_id)->first();
							?>
							@if($footer_data!='')
								{!! $footer_data->footer_desc !!}
							@endif
						@endif
						{!! $data->option1_quotation_footer_extra !!}
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>