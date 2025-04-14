<div class="destop_test_exp" style="">
<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 0px 0px 10px 10px;background: #ffffff;margin-bottom: 10px">
@if($data2!="" && $data2->option2_quotation_header!="" && $data2->option2_quotation_header!="N;")
	<?php $header=unserialize($data2->option2_quotation_header); ?>
	@foreach($header as $header_data)
		{!! CustomHelpers::get_quotation_header($header_data) !!}
	@endforeach
@endif
@if($data1->accept_status=="0" && $data1->send_option=="1")
	
@endif
</div>
<!--Package Name & Services Included-->
<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
<!--<div class="package_name" style="margin-top: 10px">-->
	<h3 class="pfwmt" style="font-size: 22px;line-height: 22px;color: #000000;margin-bottom: 10px">{{ $data2->custom_package_name }}</h3>
	<p class="pfwmt" style="font-size: 18px;line-height: 22px;color: #4a4a4a;margin-bottom: 20px">{{ $data2->duration-1 }} Nights - {{ $data2->duration }} Days</p>
	<div class="makeflex" style="align-items: self-end;justify-content: space-between">
	<div>
	<p class="pfwmt" style="font-size: 12px;margin-bottom: 10px;color: #4a4a4a">Included in this package</p>
	<!--Check service icons-->
	<div id="mobscroll" style="display: flex;ms-overflow-style: none;overflow-x: auto;">
		@php
			/* $package_service=unserialize($details->package_service); */
		@endphp
		@if(empty($package_service))
		@else
		<?php $count_package_service=count($package_service); ?>  
		<?php
			$ico="";
			foreach ($icon_data as $icon_data1) {
			$ico.=$icon_data1->icon_title.",";
			}
			$ico1=array_unique(explode(",",$ico));
		?>
		@for($i=0;$i<$count_package_service;$i++)
			@if(in_array($package_service[$i], $ico1))
				<div style="margin-right: 5%;">
					<p style="text-align: center;margin-bottom: 5px;">
						<img width= "28" height="28" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}"  title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}"></p>
					<p style="font-size: 12px;margin-bottom: 0px;text-align: center;">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
				</div>
			@else
			@endif
		@endfor
		@endif
	</div>
	
	<!--Check service icons-->
	<div class="flexcenter">
		@if($data2->option2_transport=="Flight")
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/plane.png')}}" width="40px;" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Flight</p>
		</div>
		@endif
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/bed.png')}}" width="40px" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Hotel</p>
		</div>
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/eye.png')}}" width="40px;" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Sightseeing</p>
		</div>
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/ipod.png')}}" width="40px" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Meals</p>
		</div>
	</div>
	
	</div>
	<!--Accept & Reject Button starts-->
	<div>
	@include("query.quotation_webpage.accept")
	</div>
	<!--Accept & Reject Button ends-->
	</div>
</div>
<!--Departure City, Tour Date,Pricing & Quote Validity starts-->
<div class="" style="border: 1px solid #CED0D4;padding: 25px 40px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
	<div class="makeflex" style="">
		<!--Departure City-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;margin-right: 40px;width: 360px;max-height: 235px">
			<p style="font-size: 14px;font-weight: 600;margin: 0px;color: #a1a1a1">DEPARTURE CITY</p>
			<p class="pfwmt">{{ $data2->source }}</p>
		</div>
		<!--Tour Date-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;margin-right: 40px;width: 360px;max-height: 235px">
			<p style="font-size: 14px;font-weight: 600;margin: 0px;color: #a1a1a1">TOUR DATE</p>
			<?php
				$originalDate = CustomHelpers::get_query_field($data2->query_reference,'date_arrival');
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
				$datefrom_print = date("d M Y", strtotime($datefrom));
				$day_from = strtotime($datefrom);
				$day_from = date('D', $day_from);
				
				$to_days=$data2->duration-1;
				
				$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
				$stop_date_print= date("d M Y", strtotime($stop_date));
				$day_to = strtotime($stop_date);
				$day_to = date('D', $day_to);
			?>
			
			<p class="pfwmt" style="font-size: 16px"><?php echo "$day_from"; ?>, {{$datefrom_print}}</p>
			<p class="pfwmt" style="font-size: 14px;color: #CCCCCC">TO</p>
			<p class="pfwmt" style="font-size: 16px"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
		</div>
		<!--Pricing-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;width: 360px">
		@if($data2->option2_price_type=="Per Person")
		<div>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Total Basic Cost</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data2->option2_price,'adult')); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Discount (-)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data2->option2_price,'adult')); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">GST (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 565</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">TCS (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 594</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="makeflex" style="justify-content: space-between">
				<div>
				<p class="priceitemlist" style="font-size: 18px;line-height: 32px">Grand Total</p>
				<p class="pfwmt" style="font-size: 11px;color: #4A4A4A;font-weight: normal;line-height: 12px">( {{ $data2->anything }} )</p>
				</div>
				<div>
				<p class="priceitemlist" style="font-size: 21px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data2->option2_price,'adult')); ?></p>
				</div>
			</div>
		</div>
		@elseif($data2->option2_price_type=="Group Price")
		<div>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Total Basic Cost</p>
				<?php
				$option2_adult=CustomHelpers::get_quotation_pricel($data2->option2_price,'adult');
				$option2_extradult=CustomHelpers::get_quotation_pricel($data2->option2_price,'exadult');
				$option2_child=CustomHelpers::get_quotation_pricel($data2->option2_price,'childbed');
				$option2_childwithoutbed=CustomHelpers::get_quotation_pricel($data2->option2_price,'childwbed');
				$option2_infant=CustomHelpers::get_quotation_pricel($data2->option2_price,'infant');
				$option2_single=CustomHelpers::get_quotation_pricel($data2->option2_price,'single');
				$option2_total=($option2_adult*2) + $option2_extradult + $option2_child + $option2_childwithoutbed + $option2_infant + $option2_single;
				?>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Discount (-)</p>
				<?php
				$option2_adult_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'adult');
				$option2_extradult_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'exadult');
				$option2_child_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'childbed');
				$option2_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'childwbed');
				$option2_infant_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'infant');
				$option2_single_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'single');
				$option2_total_discount=($option2_adult_discount*2) + $option2_extradult_discount + $option2_child_discount + $option2_childwithoutbed_discount + $option2_infant_discount + $option2_single_discount;
				?>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total_discount); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">GST (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 565</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">TCS (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 594</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist" style="font-size: 18px">Grand Total</p>
				<p class="priceitemlist" style="font-size: 21px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total-$option2_total_discount); ?></p>
			</div>
		</div>
		@endif
		<i>
		 <?php 
		$total_traveler="0";
		$adult=CustomHelpers::get_query_field($data2->query_reference,'span_value_adult');
		$child=CustomHelpers::get_query_field($data2->query_reference,'span_value_child');
		$infant=CustomHelpers::get_query_field($data2->query_reference,'span_value_infant'); 
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
	<!--Quote Validity starts-->
	@if($data2->option2_validaty!="")
		<div class="flexcenter" style="justify-content: flex-end;margin-top: 10px">
			<p class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px">QUOTE VALIDITY - </p>
			<div class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px;text-transform: uppercase">{{ date("d M Y", strtotime($data2->option2_validaty)) }}</div>
		</div>
	@endif
	<!--Quote Validity ends-->
</div>
<!--Departure City, Tour Date & Pricing ends-->

<!--Flight & Other Transport Details Starts-->
@if($data2->option2_transport=="Flight")
<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
	<?php $flight_detail=unserialize($data2->option2_flight); ?>
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">FLIGHT DETAILS</h3>
	<!--<b style="text-align: left; margin: 0px;font-size: 15px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 4px;"></b>-->
	<div style="margin: 0px 15px">
		<!--Upward Flight Starts-->
		<div style="margin-bottom: 25px">
			<!--Upward Flight Origin - Destination-->
			<div class="flexcenter" style="margin-bottom: 5px">
				<div style="margin-right: 20px">
				@if($flight_detail['Origin']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['Origin'] }}</span>
				@endif
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">-</span> 
				@if($flight_detail['dest']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['dest'] }}</span>
				@endif
				</div>
				<div>
					@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
					<?php
						$originalDate_flight = $flight_detail['onwarddate'];
						$newDate_flight = date("d M Y", strtotime($originalDate_flight));
					?>
					<span style="font-size: 18px;font-weight: 600;font-style: italic">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>
				  @endif 
				  @endif
				</div>
			</div>
			<!--Upward Flight Details-->	
			<div style="border: 1px solid #CCCCCC;padding: 15px 25px 25px;border-radius: 5px;background: #F9F9F9">
				<div class="flexcenter" style="margin-bottom: 15px">
					@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
					<?php
						$originalDate_flight = $flight_detail['onwarddate'];
						$newDate_flight = date("d M Y", strtotime($originalDate_flight));
					?>
					<!--<span style="font-size: 18px;color: #4a4a4a;font-weight: 600">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>-->
				  @endif 
				  @endif
				  <!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
				  <span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
				  <div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>
				  <span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">Economy</span>
				</div>
				<div class="flexcenter" style="margin-left: 20px">
					<div style="margin-right: 10px">
						<!--<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
						<p class="pfwmt" style="text-align: center"><img width="42" height="42" src="{{url('/resources/assets/frontend/images/icon/airlineIndigo.png')}}" style="border-radius: 3px"></p>
					</div>
					<div style="width: 110px;margin-right: 30px">
						<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px">Indigo Airlines</p>
						<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
					</div>
					<div style="width: 100px;margin-right: 30px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</p>
					</div>
					<div style="margin-right: 30px">
						<p class="pfwmt" style="text-align: center"><img src="{{url('/public/uploads/icons/planevenue.png')}}"></p>
						<!--<p class="pfwmt" style="text-align: center">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</p>-->
					</div>
					<div style="width: 100px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</p>
					</div>
				</div>
				<div style="border-bottom: 1px solid #E7E7E7;margin: 20px 0px 15px"></div>
				<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4a4a4a;margin: 0px 0px 3px">Baggage info</p>
				<div class="flexcenter" style="">
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Cabin:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px">7 kgs</span>
				  <div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Check in:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px;">30 kgs</span>
				</div>
			</div>
		</div>
		<!--Upward Flight Ends-->
		<!--Return Flight Starts-->
		<div>
			<!--Return Flight Origin - Destination-->
			<div class="flexcenter" style="margin-bottom: 5px">
				<div style="margin-right: 20px">
				@if($flight_detail['dOrigin']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['dOrigin'] }}</span>
				@endif
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">-</span> 
				@if($flight_detail['ddest']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['ddest'] }}</span>
				@endif
				</div>
				<div>
					@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
					<?php
						$originalDate_flight_down = $flight_detail['downwarddate'];
						$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
					?>
					<span style="font-size: 18px;font-weight: 600;font-style: italic">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>
					@endif 
					@endif
				</div>
			</div>
			<!--Return Flight Details-->
			<div style="border: 1px solid #CCCCCC;padding: 15px 25px 25px;border-radius: 5px;background: #F9F9F9">
				<div class="flexcenter" style="margin-bottom: 15px">
					@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
					<?php
						$originalDate_flight_down = $flight_detail['downwarddate'];
						$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
					?>
					<!--<span style="font-size: 18px;color: #4a4a4a;font-weight: 600">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>-->
					@endif 
					@endif
					<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
					<span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
					<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>
				  <span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">Economy</span>
				  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
				</div>
				<div class="flexcenter" style="margin-left: 20px">
					<div style="margin-right: 10px">
						<!--<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
						<p class="pfwmt" style="text-align: center"><img width="42" height="42" src="{{url('/resources/assets/frontend/images/icon/airlineIndigo.png')}}" style="border-radius: 3px"></p>
					</div>
					<div style="width: 110px;margin-right: 30px">
						<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px">Indigo Airlines</p>
						<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
					</div>
					<div style="width: 100px;margin-right: 30px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
					</div>
					<div style="margin-right: 30px">
						<p class="pfwmt" style="text-align: center"><img src="{{url('/public/uploads/icons/planevenue.png')}}"></p>
						<!--<p class="pfwmt" style="text-align: center">@if(array_key_exists("dnumberstop", $flight_detail) && $flight_detail['dnumberstop']!="") {{$flight_detail['dnumberstop']}} @endif</p>-->
					</div>
					<div style="width: 100px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</p>
					</div>
				</div>
				<div style="border-bottom: 1px solid #E7E7E7;margin: 20px 0px 15px"></div>
				<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4a4a4a;margin: 0px 0px 3px">Baggage info</p>
				<div class="flexcenter" style="">
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Cabin:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px">7 kgs</span>
				  <div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Check in:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px;">30 kgs</span>
				</div>
			</div>
		</div>
		<!--Return Flight Ends-->
	</div>
</div>
<!--<div class="col-md-12">
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
</div>-->
<!--down-->
<!--
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
	@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif
</strong>
<br>
		<center>
			@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif
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
</div>-->
	<!--Other Transport option-->
@elseif($data2->option2_transport!="0")
<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="my_h3">{{ $data2->option2_transport }}</h3>
			</td>	
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">
			{{ $data2->option2_transport }}
			</td>
		</tr>
	</table>
</div>
@endif
<!--Flight & Other Transport Details Ends-->

<!--Hotel Details Starts-->
<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">ACCOMMODATION</h3>
	<div class="">
		<!--<div class="col-md-12">
			<h3 style="text-align: left; margin: 20px 0px 5px 0px;">Hotel Details</h3>	
		</div>-->
	<?php
		$acco=unserialize($data2->option2_accommodation);
		$i="1";
	?>
	@foreach($acco as $acco_data)
	<div style="margin: 0px 15px">
	<div style="margin-bottom: 25px">
		<div class="flexcenter" style="margin-bottom: 10px">
			<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $acco_data["city"] }}</span>
		@if($i>1)
		<br>
		@endif
		<!--<b style="text-align: left; margin: 0px;font-size: 13px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/bed.jpg')}}" style="position: relative; top: -4px;"></b>
			<div>
			@if(array_key_exists("hotel",$acco_data))
				@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}} </span>
				@elseif($acco_data["hotel"]=="other")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{$acco_data["other_hotel"]}}</span>
				@endif
			@endif
			</div>-->
		</div>
		<div style="border: 1px solid #CCCCCC;padding: 25px 25px;border-radius: 5px;background: #F9F9F9">
			<div class="makeflex">
			<!--Property Image-->
			<div class="" style="padding-right: 25px">
				@if(array_key_exists("hotel",$acco_data))
					@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
						<img width="220" height="180" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" style="border-radius: 5px"> 
					@elseif($acco_data["hotel"]=="other")
						<img width="220" height="180" src="{{ url('/public/uploads/no-image.png') }}" style="border-radius: 5px">
					@endif
				@endif
			</div>
			<div class="">
				<div style="margin-bottom: 8px;padding: 3px 10px;border: 1px solid #707070;border-radius: 3px;display: inline-block;background: #6A11CB;font-size: 12px;font-weight: 600;color: #ffffff">Hotel</div>
				<!--Hotel Name-->
				<div class="flexcenter">
					<h5 class="pfwmt" style="font-size: 20px;color: #000000;line-height: 24px;margin-right: 10px;margin-bottom: 5px;">
					@if(array_key_exists("hotel",$acco_data))
						@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
						@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
						@endif
					@endif
					</h5>
					<span style="">
						@if(array_key_exists("star",$acco_data))
							@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
							@elseif($acco_data["star"]=="other") 
								<span style="margin: 0px">{{CustomHelpers::get_star_rating($acco_data["star_other"])}}</span>
							@endif
						@endif
					</span>
				</div>
				<!--Destination City Name-->
				<div style="margin-bottom: 10px">
					<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["city"] }}</p>
				</div>
				<!--No of Nights & Check-in & Checkout-->
				<div class="flexcenter" style="margin-bottom: 20px">
					<div style="width: 150px;margin-right: 200px">
						<p class="pfwmt" style="margin-bottom: 1px;font-size: 12px;line-height: 17px;color: #9B9B9B">NO OF NIGHTS</p>
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
							$checkin_date_print= date("d M Y", strtotime($checkin_date));
							$day_checkin = strtotime($checkin_date);
							$day_checkin = date('D', $day_checkin);
							?>
							@if($acco_data!="" && array_key_exists("day",$acco_data)) 
							@foreach($acco_data["day"] as $accday)
							
							<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
							@endforeach
							@endif
							
							<?php
							$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
							$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
							$checkout_date_print= date("d M Y", strtotime($checkout_date));
							$day_checkout = strtotime($checkout_date);
							$day_checkout = date('D', $day_checkout);
							?>
							<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">
								<?php
								 $date1=date_create($checkin_date);
								 $date2=date_create($checkout_date);
								$diff=date_diff($date1,$date2);
								?>
								@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
							</p>
					</div>
					<!--Check-in & Checkout-->
					<div>
						<div class="flexcenter" style="margin-bottom: 1px">
							<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B;width: 70px;margin-right: 10px">CHECK-IN </p>
							<p class="pfwmt" style="font-size: 13px;line-height: 17px;color: #4a4a4a"><?php echo $day_checkin; ?>, {{ $checkin_date_print }}</p>
						</div>
						<div class="flexcenter">
							<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B;width: 70px;margin-right: 10px">CHECKOUT </p>
							<p class="pfwmt" style="font-size: 13px;line-height: 17px;color: #4a4a4a"><?php echo $day_checkin; ?>, {{ $checkout_date_print }}</p>
						</div>
					</div>
				</div>
				<!--Room Type & Hotel Website-->
				<div class="flexcenter">
					<div style="width: 150px;margin-right: 200px">
						<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">ROOM TYPE</p>
						@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["category"] }}</p>
						@endif
					</div>
					<div>
						<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">HOTEL WEBSITE</p>
						@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["category"] }}</p>
						@endif
					</div>
				</div>
			<!--Room Type, City Name, No of Nights, Check-in & Checkout--
				<div class="">
				@if($acco_data["category"]!="")
						<!--<p style="font-size: 13px">Room: {{$acco_data["category"]}}</p>-->
					@endif
					<!--<div class="check_out">
					<!--City Name & No of Nights-->
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
						
						<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
						@endforeach
						@endif
						
						<?php
						$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
						$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
						$checkout_date_print= date("d M'y", strtotime($checkout_date));
						$day_checkout = strtotime($checkout_date);
						$day_checkout = date('D', $day_checkout);
						?>
						<!--<p style="font-size: 15px; color: #696868;"><b>
							<?php
							 $date1=date_create($checkin_date);
							 $date2=date_create($checkout_date);
							$diff=date_diff($date1,$date2);
							?>
							{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b>
						</p>-->
						
						<!--Check-in & Checkout--
						<p style="font-size: 13px; color: #696868;">Check-in: <?php echo $day_checkin; ?>, {{$checkin_date_print}} </p>
						<p style="font-size: 13px; color: #696868;">Checkout: <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
					</div>
				</div>-->
			</div>
			</div>
		<!--<div class="hotel_data">-->
			<div class="">
				<!--Property Image--
				<div class="col-md-2 col-sm-2 col-xs-12">
					<div class="hotel_image">
						@if(array_key_exists("hotel",$acco_data))
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
								<img width="220" height="180" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}"> 
							@elseif($acco_data["hotel"]=="other")
								<img width="220" height="180" src="{{ url('/public/uploads/no-image.png') }}">
							@endif
						@endif
					</div>
				</div>-->
				
				<!--Property Name--
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="hotel_name" style="font-size: 15px">
						@if(array_key_exists("hotel",$acco_data))
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
							@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
							@endif
						@endif
						<p style="margin-bottom: 5px">
							@if(array_key_exists("star",$acco_data))
								@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
								@elseif($acco_data["star"]=="other") {{CustomHelpers::get_star_rating($acco_data["star_other"])}}
								@endif
							@endif
						</p>
						@if($acco_data["category"]!="")
							<p style="font-size: 13px">Room: {{$acco_data["category"]}}</p>
						@endif
					</div>
				</div>-->
				
				<!--City Name, No of Nights, Check-in & Checkout--
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="check_out">
					<!--City Name & No of Nights--
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
						
						<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
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
							{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b>
						</p>
						
						<!--Check-in & Checkout--
						<p style="font-size: 13px; color: #696868;">Check-in: <?php echo $day_checkin; ?>, {{$checkin_date_print}} </p>
						<p style="font-size: 13px; color: #696868;">Checkout: <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
					</div>	
				</div>-->
			</div>
		</div>
	</div>
	</div>
	<?php $i++; ?>
	@endforeach
	</div>
</div>
<!--Hotel Details Ends-->

<!--Tour Itinerary Starts-->
@php
	$itinerary_data=unserialize($data2->option2_dayItinerary);
	$day=1;
@endphp
@if(empty($itinerary_data) || $itinerary_data=="N;")
@else
	@if($itinerary_data["day1"]["title"]!="")
	<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">TOUR ITINERARY</h3>
		@foreach($itinerary_data as $itinerary_datas)
		<div class="makeflex" style="margin: 20px 20px 0px 20px">
			<div style="margin: 0px 10px 0px 0px;border-left: 2px solid #33D18F;height: 45px"></div>
			<div>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 3px">Day {{ $day++ }}</h3>
				<p class="pfwmt" style="font-size: 14px;font-weight: 500;line-height: 17px;color: #707070;margin-bottom: 5px">{{ $itinerary_datas['title'] }}</p>
			</div>
		</div>
		<!--<div class="flexcenter collapsible" style="justify-content: space-between;margin: 10px 20px 10px">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Details</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
		<div class="" style="margin: 10px 20px 10px 20px">
			<p style="font-size: 14px;line-height: 20px;color: #000000;border-top: 1px solid #e7e7e7;padding: 10px 0px;background: #ffffff">{!!$itinerary_datas['desc']!!}</p>
		</div>
		<!--<div style="border-top: 10px solid #F2F2F2;"></div>-->
		@endforeach
	@endif
	</div>
@endif
<!--Tour Itinerary ends-->

<!--Tour Itinerary_old design_ Starts--
@php
	$itinerary_data=unserialize($data2->option2_dayItinerary);
	$day=1;
@endphp
@if(empty($itinerary_data) || $itinerary_data=="N;")
@else
	@if($itinerary_data["day1"]["title"]!="")
	<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 10px">
		<table width="100%">
			<tr>
				<td>
					<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">TOUR ITINERARY</h3>
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" style="margin: 20px 0px 0px">
			<tr style="">
				<td style="padding: 0px 15px">
					@foreach($itinerary_data as $itinerary_datas)
						<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #4a4a4a;padding-bottom: 10px">Day {{$day++}} : {{$itinerary_datas['title']}}</h3>
						<div style="margin-bottom: 25px;font-size: 14px;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">{!!$itinerary_datas['desc']!!}</div>
					@endforeach
					
				</td>
			</tr>
		</table>
		@endif
	</div>
@endif
<!--Tour Itinerary ends-->

<!--Tour Inclusions & Exclusions Starts-->
<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">INCLUSIONS & EXCLUSIONS</h3>
		<!--<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Inclusions & Exclusions</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
		<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
			<!--Inclusions-->
			<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Inclusions</h3>
			<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data2->option2_inclusions!!}</p>
			<!--Exclusions-->
			<h3 class="pfwmt" style="margin-top: 25px;font-size: 16px;line-height: 19px;color: #000000">Exclusions</h3>
			<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data2->option2_exclusions!!}</p>
		</div>
	
</div>
<!--Tour Inclusions & Exclusions Ends-->

<!--Tour Inclusions & Exclusions_old_design starts--
<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 10px">
	<!--Tour Inclusions starts--
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">INCLUSIONS</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 20px 15px 0px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<!--<td style="margin-bottom: 25px;font-size: 14px;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">--
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">{!!$data2->option2_inclusions!!}</td>
		</tr>
	</table>
	</div>
	<!--Tour Inclusions ends-->

	<!--Tour Exclusions starts--
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-top: 25px">EXCLUSIONS</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 20px 15px 0px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">{!!$data2->option2_exclusions!!}</td>
		</tr>
	</table>
	</div>
	<!--Tour Exclusions ends--
</div>
<!--Tour Inclusions & Exclusions_old_design ends-->


<!--Tour Visa Policy starts-->
@if($data2->option2_visa=="1")
@if(empty($data2->option2_package_visa) || $data2->option2_package_visa=="N;")
@else
<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">VISA POLICY</h3>
		<!--<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
		<?php $v_policy=unserialize($data2->option2_package_visa); ?>
		@foreach($v_policy as $v)
			<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_visa_policy($v)!!}</p>
			</div>
			<div style="margin: 10px 20px 0px;border-top: 8px solid #f9f9f9;"></div>
		@endforeach
			<div class="pfwmt" style="margin: 20px 20px 0px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data2->option2_visa_policies }}</div>
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
	</div>
@endif
@endif
<!--Tour Visa Policy ends-->



<!--Tour Visa Policy_old_design starts--
@if($data2->option2_visa=="1")
<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 10px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">VISA POLICY</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 20px 15px 0px">
	<table width="100%">
		<tr>
			<!--<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">--
			<td>
			@if(empty($data2->option2_package_visa) || $data2->option2_package_visa=="N;")
			@else
				<?php $v_policy=unserialize($data2->option2_package_visa); ?>
				@foreach($v_policy as $v)
					<div class="custom_padding" style="margin-bottom: 25px;font-size: 14px;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">{!!CustomHelpers::get_visa_policy($v)!!}</div>
				@endforeach
			@endif
				<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">
				{{ $data2->option2_visa_policies }}
				</div>
			</td>
		</tr>
	</table>
	</div>
</div>
@endif
<!--Tour Visa Policy ends-->

<!--Tour Booking & Cancellation Policy starts-->
<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
<!--Tour Booking Policy starts-->
@if(empty($data2->option2_package_payment) || $data2->option2_package_payment=="N;")
@else
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">BOOKING & CANCELLATION</h3>
		<!--<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
		<?php $p_policy=unserialize($data2->option2_package_payment); ?>
	@foreach($p_policy as $v)
		<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
			<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Booking Policy</h3>
			<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_payment_policy($v)!!}</p>
		</div>
	@endforeach
		<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data2->option2_payment_policies }}</div>
		<div style="margin: 20px 20px;border-top: 8px solid #f9f9f9;"></div>
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
@endif
<!--Tour Booking Policy ends-->

<!--Tour Cancellation Policy starts-->
@if(empty($data2->option2_package_can) || $data2->option2_package_can=="N;")
@else
	<!--<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">BOOKING & CANCELLATION</h3>
		<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
		<?php $c_policy=unserialize($data2->option2_package_can); ?>
	@foreach($c_policy as $v)
		<div class="custom_padding" style="margin: 0px 20px 0px 20px;background: #ffffff">
			<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Cancellation Policy</h3>
			<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_cancel_policy($v)!!}</p>
		</div>
	@endforeach
		<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data2->option2_cancellation }}</div>
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
@endif
<!--Tour Cancellation Policy ends-->
</div>
<!--Tour Booking & Cancellation Policy ends-->


<!--Tour Important Notes starts-->
@if(empty($data2->option2_package_impnotes) || $data2->option2_package_impnotes=="N;")
@else
<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">IMPORTANT NOTES</h3>
		<!--<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>-->
	<?php $important_notes=unserialize($data2->option2_package_impnotes); ?>
	@foreach($important_notes as $v)
		<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
			<!--<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Important Notes</h3>-->
			<p class="pfwmt" style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9;font-size: 14px;font-weight: 400">{!!CustomHelpers::get_impnotes($v)!!}</p>
		</div>
	@endforeach
		<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data2->option2_extra_imp }}</div>
		
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
</div>
@endif
<!--Tour Important Notes ends-->

<!--Tour Payment Policy_old_design starts--
<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 10px">
<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">TERMS & CONDITIONS</h3>
@if(empty($data2->option2_package_payment) || $data2->option2_package_payment=="N;")
@else
<div style="margin: 20px 0px 0px 15px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Payment Conditions</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 10px 15px 25px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<!--<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">--
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">
			<?php $p_policy=unserialize($data2->option2_package_payment); ?>
			@foreach($p_policy as $v)
				{!!CustomHelpers::get_payment_policy($v)!!}
			@endforeach
			<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_payment_policies }}</div>
			</td>
		</tr>
	</table>
	</div>
</div>
@endif
<!--Tour Payment Policy_old_design ends-->
<!--Tour Cancellation Policy_old_design starts--
@if(empty($data2->option2_package_can) || $data2->option2_package_can=="N;")
@else
<div style="margin: 20px 0px 0px 15px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Cancellation Conditions</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 10px 15px 25px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">
			<?php $c_policy=unserialize($data2->option2_package_can); ?>
			@foreach($c_policy as $v)
				{!!CustomHelpers::get_cancel_policy($v)!!}
			@endforeach
			<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_cancellation }}</div>
			</td>
			<td></td>
		</tr>
	</table>
	</div>
</div>
@endif
<!--Tour Cancellation Policy_old_design ends-->

<!--Tour Important Notes_old_design starts--
@if(empty($data2->option2_package_impnotes) || $data2->option2_package_impnotes=="N;")
@else
<div style="margin: 20px 0px 0px 15px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Important Notes</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 10px 15px 0px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">
			<?php $important_notes=unserialize($data2->option2_package_impnotes); ?>
			@foreach($important_notes as $v)
				{!!CustomHelpers::get_impnotes($v)!!}
			@endforeach
				<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_extra_imp }}</div>
			</td>
			
		</tr>
	</table>
	</div>
</div>
@endif
</div>
<!--Tour Important Notes_old_design ends-->

<!--Acceptance & Rejection button-->
@if($data1->accept_status=="0" && $data1->send_option=="1")
@include("query.quotation_webpage.accept")
@endif
<br>

<!--Footer Signature Starts-->
@if($data2!="" && $data2->option2_quotation_footer!="" && $data2->option2_quotation_footer!="N;")
<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 25px">
<?php $footer=unserialize($data2->option2_quotation_footer); ?>
@foreach($footer as $footer_data)
{!! CustomHelpers::get_quotation_footer($footer_data) !!}
@endforeach
</div>
@endif
<!--Footer Signature Ends--> 
</table>
</div>

<div class="mobile_test_exp" style="">
<div style="padding: 20px;background: #ffffff;margin-bottom: 10px">
@if($data2!="" && $data2->option2_quotation_header!="" && $data2->option2_quotation_header!="N;")
	<?php $header=unserialize($data2->option2_quotation_header); ?>
	@foreach($header as $header_data)
		{!! CustomHelpers::get_quotation_header($header_data) !!}
	@endforeach
@endif
@if($data1->accept_status=="0" && $data1->send_option=="1")
	
@endif
</div>
<!--Package Name & Services Included-->
<div style="padding: 20px;background: #ffffff;margin-bottom: 10px">
<!--<div class="package_name" style="margin-top: 10px">-->
	<h3 class="pfwmt" style="font-size: 22px;line-height: 22px;color: #000000;margin-bottom: 10px">{{ $data2->custom_package_name }}</h3>
	<p class="pfwmt" style="font-size: 18px;line-height: 22px;color: #4a4a4a;margin-bottom: 20px">{{ $data2->duration-1 }} Nights - {{ $data2->duration }} Days</p>
	<p class="pfwmt" style="font-size: 12px;margin-bottom: 10px;color: #4a4a4a">Included in this package</p>
	<!--Check service icons-->
	<div id="mobscroll" style="display: flex;ms-overflow-style: none;overflow-x: auto;">
		@php
			/* $package_service=unserialize($details->package_service); */
		@endphp
		@if(empty($package_service))
		@else
		<?php $count_package_service=count($package_service); ?>  
		<?php
			$ico="";
			foreach ($icon_data as $icon_data1) {
			$ico.=$icon_data1->icon_title.",";
			}
			$ico1=array_unique(explode(",",$ico));
		?>
		@for($i=0;$i<$count_package_service;$i++)
			@if(in_array($package_service[$i], $ico1))
				<div style="margin-right: 5%;">
					<p style="text-align: center;margin-bottom: 5px;">
						<img width= "28" height="28" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon')) }}"  title="{{  CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}"></p>
					<p style="font-size: 12px;margin-bottom: 0px;text-align: center;">{{ CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title') }}</p>
				</div>
			@else
			@endif
		@endfor
		@endif
	</div>
	
	<!--Check service icons-->
	<div class="flexcenter">
		@if($data2->option2_transport=="Flight")
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/plane.png')}}" width="40px;" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Flight</p>
		</div>
		@endif
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/bed.png')}}" width="40px" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Hotel</p>
		</div>
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/eye.png')}}" width="40px;" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Sightseeing</p>
		</div>
		<div style="margin-right: 20px">
		<p style="text-align: center;margin-bottom: 5px;">
			<img src="{{url('/resources/views/query/mail/mail_img/ipod.png')}}" width="40px" height="40px"></p>
		<p style="font-size: 12px;margin-bottom: 0px;text-align: center">Meals</p>
		</div>
	</div>
</div>
<!--Departure City, Tour Date,Pricing & Quote Validity starts-->
<div class="" style="padding: 20px;background: #ffffff;margin-bottom: 10px">
	<div class="flex-column" style="">
		<!--Departure City-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;margin-bottom: 10px">
			<p style="font-size: 14px;font-weight: 600;margin: 0px;color: #a1a1a1">DEPARTURE CITY</p>
			<p class="pfwmt">{{ $data2->source }}</p>
		</div>
		<!--Tour Date-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;margin-bottom: 10px">
			<p style="font-size: 14px;font-weight: 600;margin: 0px;color: #a1a1a1">TOUR DATE</p>
			<?php
				$originalDate = CustomHelpers::get_query_field($data2->query_reference,'date_arrival');
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
				$datefrom_print = date("d M Y", strtotime($datefrom));
				$day_from = strtotime($datefrom);
				$day_from = date('D', $day_from);
				
				$to_days=$data2->duration-1;
				
				$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
				$stop_date_print= date("d M Y", strtotime($stop_date));
				$day_to = strtotime($stop_date);
				$day_to = date('D', $day_to);
			?>
			
			<p class="pfwmt" style="font-size: 16px"><?php echo "$day_from"; ?>, {{$datefrom_print}}</p>
			<p class="pfwmt" style="font-size: 14px;color: #CCCCCC">TO</p>
			<p class="pfwmt" style="font-size: 16px"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
		</div>
		<!--Pricing-->
		<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4">
		@if($data2->option2_price_type=="Per Person")
		<div>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Total Basic Cost</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data2->option2_price,'adult')); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Discount (-)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data2->option2_price,'adult')); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">GST (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 565</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">TCS (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 594</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="makeflex" style="justify-content: space-between">
				<div>
				<p class="priceitemlist" style="font-size: 18px;line-height: 32px">Grand Total</p>
				<p class="pfwmt" style="font-size: 11px;color: #4A4A4A;font-weight: normal;line-height: 12px">( {{ $data2->anything }} )</p>
				</div>
				<div>
				<p class="priceitemlist" style="font-size: 21px">&#x20B9; <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data2->option2_price,'adult')); ?></p>
				</div>
			</div>
		</div>
		@elseif($data2->option2_price_type=="Group Price")
		<div>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Total Basic Cost</p>
				<?php
				$option2_adult=CustomHelpers::get_quotation_pricel($data2->option2_price,'adult');
				$option2_extradult=CustomHelpers::get_quotation_pricel($data2->option2_price,'exadult');
				$option2_child=CustomHelpers::get_quotation_pricel($data2->option2_price,'childbed');
				$option2_childwithoutbed=CustomHelpers::get_quotation_pricel($data2->option2_price,'childwbed');
				$option2_infant=CustomHelpers::get_quotation_pricel($data2->option2_price,'infant');
				$option2_single=CustomHelpers::get_quotation_pricel($data2->option2_price,'single');
				$option2_total=($option2_adult*2) + $option2_extradult + $option2_child + $option2_childwithoutbed + $option2_infant + $option2_single;
				?>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">Discount (-)</p>
				<?php
				$option2_adult_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'adult');
				$option2_extradult_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'exadult');
				$option2_child_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'childbed');
				$option2_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'childwbed');
				$option2_infant_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'infant');
				$option2_single_discount=CustomHelpers::get_quotation_discount($data2->option2_price,'single');
				$option2_total_discount=($option2_adult_discount*2) + $option2_extradult_discount + $option2_child_discount + $option2_childwithoutbed_discount + $option2_infant_discount + $option2_single_discount;
				?>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total_discount); ?></p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">GST (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 565</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist">TCS (5%)</p>
				<p class="priceitemlist" style="font-size: 16px">&#x20B9; 594</p>
			</div>
			<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
			<div class="flexcenter" style="justify-content: space-between">
				<p class="priceitemlist" style="font-size: 18px">Grand Total</p>
				<p class="priceitemlist" style="font-size: 21px">&#x20B9; <?php CustomHelpers::get_indian_currency($option2_total-$option2_total_discount); ?></p>
			</div>
		</div>
		@endif
		<i>
		 <?php 
		$total_traveler="0";
		$adult=CustomHelpers::get_query_field($data2->query_reference,'span_value_adult');
		$child=CustomHelpers::get_query_field($data2->query_reference,'span_value_child');
		$infant=CustomHelpers::get_query_field($data2->query_reference,'span_value_infant'); 
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
	<!--Quote Validity starts-->
	@if($data2->option2_validaty!="")
		<div class="flexcenter" style="justify-content: flex-end;margin-top: 10px">
			<p class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px">QUOTE VALIDITY - </p>
			<div class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px;text-transform: uppercase">{{ date("d M Y", strtotime($data2->option2_validaty)) }}</div>
		</div>
	@endif
	<!--Quote Validity ends-->
</div>
<!--Departure City, Tour Date & Pricing ends-->

<!--Flight & Other Transport Details Starts-->
@if($data2->option2_transport=="Flight")
<div style="padding: 20px;background: #ffffff;margin-bottom: 10px">
	<?php $flight_detail=unserialize($data2->option2_flight); ?>
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">FLIGHT DETAILS</h3>
	<!--<b style="text-align: left; margin: 0px;font-size: 15px; position: relative;"> <img src="{{url('/resources/views/query/mail/mail_img/plan.jpg')}}" style="position: relative; top: 4px;"></b>-->
		<!--Upward Flight Starts-->
		<div style="margin-bottom: 25px">
			<!--Upward Flight Origin - Destination--
			<div class="flexcenter" style="margin-bottom: 10px">
				<div style="margin-right: 20px">
				@if($flight_detail['Origin']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['Origin'] }}</span>
				@endif
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">-</span> 
				@if($flight_detail['dest']!="")
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $flight_detail['dest'] }}</span>
				@endif
				</div>
				<div>
					@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
					<?php
						$originalDate_flight = $flight_detail['onwarddate'];
						$newDate_flight = date("d M Y", strtotime($originalDate_flight));
					?>
				  @endif 
				  @endif
				</div>
			</div>
			<!--Upward Flight Details-->	
			<div style="border: 1px solid #CCCCCC;padding: 15px;border-radius: 5px">
				<div class="flexcenter" style="justify-content: space-between">
					<!--Upward Flight Origin - Destination-->
					<div class="flexcenter" style="">
						<div style="">
						@if($flight_detail['Origin']!="")
							<span style="font-size: 16px;font-weight: 600;color: #000000">{{ $flight_detail['Origin'] }}</span>
						@endif
							<span style="font-size: 16px;font-weight: 600;color: #000000">-</span> 
						@if($flight_detail['dest']!="")
							<span style="font-size: 16px;font-weight: 600;color: #000000">{{ $flight_detail['dest'] }}</span>
						@endif
						</div>
					</div>
					<div>
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = $flight_detail['onwarddate'];
							$newDate_flight = date("d M Y", strtotime($originalDate_flight));
						?>
						<span style="font-size: 16px;color: #000000;font-weight: 600">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>
					  @endif 
					  @endif
					 </div>
				 </div>
				<!--Upward Flight Details-->
				<div class="flexcenter" style="margin-bottom: 25px">
				  <span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
				  <div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
					<div style="">
						<p class="pfwmt" style="font-size: 14px;font-weight: 400;color: #4a4a4a;line-height: 16px;">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif Airlines</p>
						<!--<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>-->
					</div>
				</div>
				<div class="flexcenter" style="">
					<div style="width: 60px;margin-right: 20px">
						<!--<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
						<p class="pfwmt" style="text-align: center"><img width="42" height="42" src="{{url('/resources/assets/frontend/images/icon/airlineIndigo.png')}}" style="border-radius: 3px"></p>
						<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
					</div>
					<div style="width: 80px;margin-right: 20px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</p>
					</div>
					<div class="flexcenter" style="margin-right: 20px">
						<i class="fa fa-plane" aria-hidden="true" style="font-size: 18px;color: #4A4A4A;transform: rotate(45deg)"></i>
						<div style="margin: 20px 5px;border-top: 1px solid #ccc;min-width: 110px;"></div>
						<i class="fa fa-map-marker" aria-hidden="true" style="font-size: 18px;color: #4A4A4A"></i>
						<!--<p class="pfwmt" style="text-align: center"><img height="20" src="{{url('/public/uploads/icons/planevenue.png')}}"></p>-->
						<!--<p class="pfwmt" style="text-align: center">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</p>-->
					</div>
					<div style="width: 80px">
						<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif</p>
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</p>
					</div>
				</div>
				<div style="border-bottom: 1px solid #E7E7E7;margin: 20px 0px 15px"></div>
				<div class="flexcenter" style="">
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a;margin-right: 5px">Baggage info</span>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Cabin:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px">7 kgs</span>
				  <div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Check in:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px;">30 kgs</span>
				</div>
			</div>
		</div>
		<!--Upward Flight Ends-->
		<!--Return Flight Starts-->
		<div style="border: 1px solid #CCCCCC;padding: 15px;border-radius: 5px;">
			<div class="flexcenter" style="justify-content: space-between">
				<!--Return Flight Origin - Destination-->
				<div class="flexcenter" style="">
					<div style="">
					@if($flight_detail['dOrigin']!="")
						<span style="font-size: 16px;font-weight: 600;color: #000000">{{ $flight_detail['dOrigin'] }}</span>
					@endif
						<span style="font-size: 16px;font-weight: 600;color: #000000">-</span> 
					@if($flight_detail['ddest']!="")
						<span style="font-size: 16px;font-weight: 600;color: #000000">{{ $flight_detail['ddest'] }}</span>
					@endif
					</div>
				</div>
				<div>
					@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
					<?php
						$originalDate_flight_down = $flight_detail['downwarddate'];
						$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
					?>
					<span style="font-size: 16px;color: #000000;font-weight: 600">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>
					@endif
					@endif
				</div>
			</div>
			<!--Return Flight Details-->
			<div class="flexcenter" style="margin-bottom: 25px">
				<span class="" style="font-size: 14px;font-weight: 400;color: #4a4a4a">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
				<div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
				<div style="">
					<p class="pfwmt" style="font-size: 14px;font-weight: 400;color: #4a4a4a;line-height: 16px;">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif Airlines</p>
					<!--<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>-->
				</div>
			</div>
			<div class="flexcenter" style="">
				<div style="width: 60px;margin-right: 20px">
					<!--<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
					<p class="pfwmt" style="text-align: center"><img width="42" height="42" src="{{url('/resources/assets/frontend/images/icon/airlineIndigo.png')}}" style="border-radius: 3px"></p>
					<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
				</div>
				<div style="width: 80px;margin-right: 20px">
					<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif</p>
					<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
				</div>
				<div class="flexcenter" style="margin-right: 20px">
					<i class="fa fa-plane" aria-hidden="true" style="font-size: 18px;color: #4A4A4A;transform: rotate(45deg)"></i>
					<div style="margin: 20px 5px;border-top: 1px solid #ccc;min-width: 110px;"></div>
					<i class="fa fa-map-marker" aria-hidden="true" style="font-size: 18px;color: #4A4A4A"></i>
					<!--<p class="pfwmt" style="text-align: center"><img height="20" src="{{url('/public/uploads/icons/planevenue.png')}}"></p>-->
					<!--<p class="pfwmt" style="text-align: center">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</p>-->
				</div>
				<div style="width: 80px">
					<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif</p>
					<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</p>
				</div>
			</div>
			<div style="border-bottom: 1px solid #E7E7E7;margin: 20px 0px 15px"></div>
				<div class="flexcenter" style="">
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a;margin-right: 5px">Baggage info</span>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Cabin:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px">7 kgs</span>
				  <div style="border-left: 2px solid #ccc;height: 16px;margin-left: 5px;margin-right: 5px"></div>
				  <span class="pfwmt" style="font-size: 12px;color: #4a4a4a">Check in:&ensp;</span>
				  <span class="pfwmt" style="font-size: 12px;">30 kgs</span>
				</div>
		</div>
		<!--Return Flight Ends-->
</div>
<!--Other Transport option-->
@elseif($data2->option2_transport!="0")
<div style="padding: 20px;background: #ffffff;margin-bottom: 10px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="my_h3">{{ $data2->option2_transport }}</h3>
			</td>	
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">
			{{ $data2->option2_transport }}
			</td>
		</tr>
	</table>
</div>
@endif
<!--Flight & Other Transport Details Ends-->

<!--Hotel Details Starts-->
<div style="padding: 20px 20px 5px;background: #ffffff;margin-bottom: 10px">
	<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">ACCOMMODATION</h3>
	<div class="">
	<?php
		$acco=unserialize($data2->option2_accommodation);
		$i="1";
	?>
	@foreach($acco as $acco_data)
	<div style="border: 1px solid #CCCCCC;padding: 15px;border-radius: 5px;margin-bottom: 10px">
		
			<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $acco_data["city"] }}</span>
			@if($i>1)
			<br>
			@endif
		
		<div style="margin: 5px 0px 10px 0px;border-top: 1px solid #ccc;"></div>
		<div style="margin-bottom: 15px;padding: 3px 10px;border: 1px solid #707070;border-radius: 3px;display: inline-block;background: #6A11CB;font-size: 12px;font-weight: 600;color: #ffffff">Hotel</div>
		<div class="makeflex">
			<!--Property Image-->
			<div class="" style="padding-right: 15px">
				@if(array_key_exists("hotel",$acco_data))
					@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
						<img width="120" height="100" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" style="max-width: unset;border-radius: 5px"> 
					@elseif($acco_data["hotel"]=="other")
						<img width="120" height="100" src="{{ url('/public/uploads/no-image.png') }}" style="max-width: unset;border-radius: 5px">
					@endif
				@endif
			</div>
			<div>
				<!--Hotel Name-->
				<h5 class="pfwmt" style="font-size: 16px;color: #000000;line-height: 19px;margin-bottom: 5px;white-space: normal;">
					@if(array_key_exists("hotel",$acco_data))
						@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
						@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
						@endif
					@endif
				</h5>
				<!--Star Rating-->
				<p class="pfwmt">
					@if(array_key_exists("star",$acco_data))
						@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
						@elseif($acco_data["star"]=="other") 
							<span style="">{{CustomHelpers::get_star_rating($acco_data["star_other"])}}</span>
						@endif
					@endif
				</p>
				<!--Room Type-->
				<p class="pfwmt" style="margin-top: 10px;font-size: 12px;line-height: 17px;color: #9B9B9B">ROOM TYPE</p>
					@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["category"] }}</p>
					@endif
			</div>
		</div>
		<div class="">
			<!--Destination City Name-->
			<!--<div style="margin-bottom: 10px">
				<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["city"] }}</p>
			</div>-->
			<!--Check-in, No of Nights & Checkout-->
			<div class="makeflex" style="justify-content: space-between;margin-top: 15px">
				<!--Check-in-->
					<div>
						<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B;width: 70px">CHECK-IN </p>
						<p class="pfwmt" style="font-size: 13px;line-height: 17px;color: #4a4a4a"><?php echo $day_checkin; ?>, {{ $checkin_date_print }}</p>
					</div>
					<!--No of Nights-->
					<div>
						<!--<p class="pfwmt" style="text-align: center;margin-bottom: 1px;font-size: 12px;line-height: 17px;color: #9B9B9B">NO OF NIGHTS</p>-->
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
							$checkin_date_print= date("d M Y", strtotime($checkin_date));
							$day_checkin = strtotime($checkin_date);
							$day_checkin = date('D', $day_checkin);
							?>
							@if($acco_data!="" && array_key_exists("day",$acco_data)) 
							@foreach($acco_data["day"] as $accday)
							
							<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
							@endforeach
							@endif
							
							<?php
							$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
							$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
							$checkout_date_print= date("d M' y", strtotime($checkout_date));
							$day_checkout = strtotime($checkout_date);
							$day_checkout = date('D', $day_checkout);
							?>
							<p class="pfwmt" style="border: 1px solid #d1d1d1;padding: 3px;text-align: center;font-size: 14px;line-height: 17px;color: #9B9B9B">
							<?php
								$date1=date_create($checkin_date);
								$date2=date_create($checkout_date);
								$diff=date_diff($date1,$date2);
								?>
								@if($diff->format("%a")>1) {{$diff->format("%aN") }} @else {{$diff->format("%aN") }} @endif
							</p>
					</div>
					<!--Checkout-->
					<div>
						<p class="pfwmt" style="text-align: right;font-size: 12px;line-height: 17px;color: #9B9B9B">CHECKOUT </p>
						<p class="pfwmt" style="text-align: right;font-size: 13px;line-height: 17px;color: #4a4a4a"><?php echo $day_checkin; ?>, {{ $checkout_date_print }}</p>
					</div>
				</div>
				<div style="margin: 20px 0px;border-top: 1px solid #ccc;"></div>
				<!--Room Type & Hotel Website--
				<div class="flexcenter">
					<div style="width: 150px;margin-right: 200px">
						<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">ROOM TYPE</p>
						@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["category"] }}</p>
						@endif
					</div>
					<div>
						<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">HOTEL WEBSITE</p>
						@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">{{ $acco_data["category"] }}</p>
						@endif
					</div>
				</div>-->
				<div>
					<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">HOTEL WEBSITE</p>
					@if($acco_data["category"]!="")
						<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">www.com</p>
					@endif
				</div>
			<!--Room Type, City Name, No of Nights, Check-in & Checkout--
				<div class="">
				@if($acco_data["category"]!="")
						<!--<p style="font-size: 13px">Room: {{$acco_data["category"]}}</p>-->
					@endif
					<!--<div class="check_out">
					<!--City Name & No of Nights-->
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
						
						<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
						@endforeach
						@endif
						
						<?php
						$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
						$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
						$checkout_date_print= date("d M'y", strtotime($checkout_date));
						$day_checkout = strtotime($checkout_date);
						$day_checkout = date('D', $day_checkout);
						?>
						<!--<p style="font-size: 15px; color: #696868;"><b>
							<?php
							 $date1=date_create($checkin_date);
							 $date2=date_create($checkout_date);
							$diff=date_diff($date1,$date2);
							?>
							{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b>
						</p>-->
						
						<!--Check-in & Checkout--
						<p style="font-size: 13px; color: #696868;">Check-in: <?php echo $day_checkin; ?>, {{$checkin_date_print}} </p>
						<p style="font-size: 13px; color: #696868;">Checkout: <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
					</div>
				</div>-->
			</div>
			
		<!--<div class="hotel_data">-->
			<div class="">
				<!--Property Image--
				<div class="col-md-2 col-sm-2 col-xs-12">
					<div class="hotel_image">
						@if(array_key_exists("hotel",$acco_data))
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
								<img width="220" height="180" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}"> 
							@elseif($acco_data["hotel"]=="other")
								<img width="220" height="180" src="{{ url('/public/uploads/no-image.png') }}">
							@endif
						@endif
					</div>
				</div>-->
				
				<!--Property Name--
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="hotel_name" style="font-size: 15px">
						@if(array_key_exists("hotel",$acco_data))
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
							@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
							@endif
						@endif
						<p style="margin-bottom: 5px">
							@if(array_key_exists("star",$acco_data))
								@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
								@elseif($acco_data["star"]=="other") {{CustomHelpers::get_star_rating($acco_data["star_other"])}}
								@endif
							@endif
						</p>
						@if($acco_data["category"]!="")
							<p style="font-size: 13px">Room: {{$acco_data["category"]}}</p>
						@endif
					</div>
				</div>-->
				
				<!--City Name, No of Nights, Check-in & Checkout--
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="check_out">
					<!--City Name & No of Nights--
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
						
						<?php $day=(int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
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
							{{ $acco_data["city"] }}, @if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif  </b>
						</p>
						
						<!--Check-in & Checkout--
						<p style="font-size: 13px; color: #696868;">Check-in: <?php echo $day_checkin; ?>, {{$checkin_date_print}} </p>
						<p style="font-size: 13px; color: #696868;">Checkout: <?php echo $day_checkout; ?>, {{$checkout_date_print}}</p>
					</div>	
				</div>-->
			</div>
		</div>
	
	
	<?php $i++; ?>
	@endforeach
	</div>
</div>
<!--Hotel Details Ends-->

<!--Tour Itinerary Starts-->
@php
	$itinerary_data=unserialize($data2->option2_dayItinerary);
	$day=1;
@endphp
@if(empty($itinerary_data) || $itinerary_data=="N;")
@else
	@if($itinerary_data["day1"]["title"]!="")
	<div style="padding: 0px;background: #ffffff;margin-bottom: 0px">
		<h3 class="pfwmt" style="padding: 20px 20px 0px;font-size: 16px;line-height: 19px;color: #000000">TOUR ITINERARY</h3>
		@foreach($itinerary_data as $itinerary_datas)
		<div class="makeflex" style="margin-top: 20px">
			<div style="margin: 0px 10px 0px 20px;border-left: 2px solid #33D18F;height: 60px"></div>
			<div>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 3px">Day {{ $day++ }}</h3>
				<p class="pfwmt" style="font-size: 14px;font-weight: 500;line-height: 17px;color: #707070;margin-bottom: 5px">{{ $itinerary_datas['title'] }}</p>
				<p class="pfwmt" style="font-size: 12px;line-height: 15px;color: #008cff;">View More</p>
			</div>
		</div>
		<div class="flexcenter collapsible" style="justify-content: space-between;margin: 20px 20px 10px">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Details</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>
		<div class="content" style="margin: 0px 20px">
			<p style="font-size: 14px;line-height: 20px;color: #000000;border-top: 1px solid #e7e7e7;padding: 15px 0px;background: #ffffff">{!!$itinerary_datas['desc']!!}</p>
		</div>
		<div style="border-top: 10px solid #F2F2F2;"></div>
		@endforeach
	@endif
	</div>
@endif
<!--Tour Itinerary ends-->

<!--Tour Inclusions & Exclusions Starts-->
<div style="padding: 20px 20px 10px;background: #ffffff">
	<div class="flexcenter collapsible" style="justify-content: space-between">
		<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Inclusions & Exclusions</p>
		<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
	</div>
	<div class="content" style="margin: 10px 0px 0px 0px;background: #ffffff">
		<!--Inclusions-->
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Inclusions</h3>
		<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data2->option2_inclusions!!}</p>
		<!--Exclusions-->
		<h3 class="pfwmt" style="margin-top: 25px;font-size: 16px;line-height: 19px;color: #000000">Exclusions</h3>
		<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data2->option2_exclusions!!}</p>
	</div>
	<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
</div>
<div style="border-bottom: 1px solid #CED0D4;margin: 0px 5px"></div>
<!--Tour Inclusions & Exclusions Ends-->

<!--Tour Visa Policy starts-->
@if($data2->option2_visa=="1")
@if(empty($data2->option2_package_visa) || $data2->option2_package_visa=="N;")
@else
	<div style="padding: 20px 20px 10px;background: #ffffff">
		<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>
		<?php $v_policy=unserialize($data2->option2_package_visa); ?>
		@foreach($v_policy as $v)
			<div class="content" style="margin-top: 10px;background: #ffffff">
				<p style="margin: 10px 0px;padding-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_visa_policy($v)!!}</p>
			</div>
			<div style="margin: 10px 0px 10px 0px;border-top: 8px solid #f9f9f9;"></div>
		@endforeach
			<div class="pfwmt" style="margin-bottom: 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 5px;background: #ffffff">{{ $data2->option2_visa_policies }}</div>
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
	</div>
	<div style="border-bottom: 1px solid #CED0D4;margin: 0px 5px"></div>
@endif
@endif
<!--Tour Visa Policy ends-->

<!--Tour Payment Policy starts-->
@if(empty($data2->option2_package_payment) || $data2->option2_package_payment=="N;")
@else
<div style="padding: 20px 20px 10px;background: #ffffff">
	<div class="flexcenter collapsible" style="justify-content: space-between">
		<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Payment Policy</p>
		<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
	</div>
	<?php $p_policy=unserialize($data2->option2_package_payment); ?>
	@foreach($p_policy as $v)
		<div class="content" style="margin-top: 10px;background: #ffffff">
			<p style="margin: 5px 0px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_payment_policy($v)!!}</p>
	@endforeach
			<div class="pfwmt" style="margin-bottom: 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 5px;background: #ffffff">{{ $data2->option2_payment_policies }}</div>
		</div>
	<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
</div>
	<div style="border-bottom: 1px solid #CED0D4;margin: 0px 5px"></div>
@endif
<!--Tour Payment Policy ends-->

<!--Tour Cancellation Policy starts-->
@if(empty($data2->option2_package_can) || $data2->option2_package_can=="N;")
@else
<div style="padding: 20px 20px 10px;background: #ffffff">
	<div class="flexcenter collapsible" style="justify-content: space-between">
		<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Cancellation Policy</p>
		<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
	</div>
	<?php $c_policy=unserialize($data2->option2_package_can); ?>
	@foreach($c_policy as $v)
		<div class="content" style="padding: 0px;margin: 10px 0px 0px 0px;background: #ffffff">
			<p style="margin: 5px 0px;border-bottom: 1px solid #e9e9e9;">{!!CustomHelpers::get_cancel_policy($v)!!}</p>
	@endforeach
			<div class="pfwmt" style="margin-bottom: 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 5px;background: #ffffff">{{ $data2->option2_cancellation }}</div>
		</div>
	<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
</div>
	<div style="border-bottom: 1px solid #CED0D4;margin: 0px 5px"></div>
@endif
<!--Tour Cancellation Policy ends-->

<!--Tour Important Notes Starts-->
@if(empty($data2->option2_package_can) || $data2->option2_package_can=="N;")
@else
<div style="padding: 20px 20px 10px;background: #ffffff">
		<div class="flexcenter collapsible" style="justify-content: space-between">
			<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Important Notes</p>
			<i class="fa fa-angle-down" aria-hidden="true" style="font-size: 28px;color: #008cff"></i>
		</div>
		<?php $important_notes=unserialize($data2->option2_package_impnotes); ?>
		@foreach($important_notes as $v)
			<div class="content" style="margin-top: 10px;background: #ffffff">
				<p style="margin: 10px 0px;padding-bottom: 10px;border-bottom: 1px solid #e9e9e9;font-size: 14px">{!!CustomHelpers::get_impnotes($v)!!}</p>
		@endforeach
			<div class="pfwmt" style="margin-bottom: 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 5px;background: #ffffff">{{ $data2->option2_extra_imp }}</div>
			</div>
		<!--<div style="border-bottom: 1px solid #CED0D4"></div>-->
</div>
	<div style="border-bottom: 1px solid #CED0D4;margin: 0px 5px"></div>
@endif
<!--Tour Important Notes Ends-->

<!--------------------------------------------------------------------------------------------------------------------------->
<!--Tour Itinerary Starts--
@php
	$itinerary_data=unserialize($data2->option2_dayItinerary);
	$day=1;
@endphp
@if(empty($itinerary_data) || $itinerary_data=="N;")
@else
	@if($itinerary_data["day1"]["title"]!="")
	<div style="padding: 0px;background: #ffffff;margin-bottom: 0px">
		<table width="100%">
			<tr>
				<td>
					<h3 class="pfwmt" style="padding: 20px;font-size: 16px;line-height: 19px;color: #000000">TOUR ITINERARY</h3>
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" style="margin: 0px 0px 0px">
			<tr style="">
				<td style="padding: 0px 0px">
					<!--<h3>Tour Itinerary</h3>-->
					<!--@foreach($itinerary_data as $itinerary_datas)
						<div class="makeflex">
							<div style="margin: 0px 10px 0px 20px;border-left: 2px solid #33D18F;height: 60px"></div>
							<div>
							<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 3px">Day {{ $day++ }}</h3>
							<p class="pfwmt" style="font-size: 14px;font-weight: 500;line-height: 17px;color: #707070;margin-bottom: 5px">{{ $itinerary_datas['title'] }}</p>
							<p class="pfwmt" style="font-size: 12px;line-height: 15px;color: #008cff;">View More</p>
							</div>
						</div>
						<div class="flexcenter collapsible" style="justify-content: space-between;margin-left: 20px">
							<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Details</p>
							<i class="fa fa-angle-down" aria-hidden="true" style="padding: 10px 20px;font-size: 28px;color: #008cff"></i>
						</div>
						
						<div class="content" style="margin: 0px 20px">
							<p style="font-size: 14px;line-height: 20px;color: #000000;border-top: 1px solid #e7e7e7;padding: 15px;background: #ffffff">{!!$itinerary_datas['desc']!!}</p>
						</div>
						<div style="margin: 5px 0px 20px 0px;border-top: 10px solid #F2F2F2;"></div>
					@endforeach
					
				</td>
			</tr>
		</table>
		@endif
	</div>
@endif
<!--Tour Itinerary ends-->

<!--Tour Visa Policy starts-->
@if($data2->option2_visa=="1")
<div style="padding: 15px;background: #ffffff;margin-bottom: 10px">
	<table width="100%">
		<tr>
			<td>
				<!--<div class="flexcenter collapsible" style="justify-content: space-between">
					<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
					<i class="fa fa-angle-down" aria-hidden="true" style="padding: 10px 20px;font-size: 28px;color: #008cff"></i>
				</div>
				<!--<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">VISA POLICY</h3>-->
			</td>
		</tr>
	</table>
	<div style="margin: 10px 0px">
	<table width="100%">
		<tr>
			<!--<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">-->
			<td>
			<!--<div class="flexcenter collapsible" style="justify-content: space-between">
					<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Policy</p>
					<i class="fa fa-angle-down" aria-hidden="true" style="padding: 10px 20px;font-size: 28px;color: #008cff"></i>
				</div>-->
			@if(empty($data2->option2_package_visa) || $data2->option2_package_visa=="N;")
			@else
				<div class="flexcenter collapsible" style="justify-content: space-between">
					<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Visa Conditions</p>
					<i class="fa fa-angle-down" aria-hidden="true" style="padding: 10px 20px;font-size: 28px;color: #008cff"></i>
				</div>
				<?php $v_policy=unserialize($data2->option2_package_visa); ?>
				@foreach($v_policy as $v)
					<div class="content" style="margin: 10px 20px;background: #ffffff">
						<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_visa_policy($v)!!}</p>
					</div>
					<div style="margin: 10px 0px 10px 0px;border-top: 8px solid #f9f9f9;"></div>
				@endforeach
			@endif
				<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px 5px 10px 10px;border-radius: 5px;background: #ffffff">
				{{ $data2->option2_visa_policies }}
				</div>
			</td>
		</tr>
	</table>
	</div>
</div>
@endif
<!--Tour Visa Policy ends-->

<!--Tour Inclusions & Exclusions starts--
<div style="padding: 5px 15px 15px;background: #ffffff;margin-bottom: 10px">
	<!--Tour Inclusions starts--
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">INCLUSIONS</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 15px;background: #ffffff">
	<table width="100%">
		<tr>
			<!--<td style="margin-bottom: 25px;font-size: 14px;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">--
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">{!!$data2->option2_inclusions!!}</td>
		</tr>
	</table>
	</div>
	<!--Tour Inclusions ends-->

<!--Tour Exclusions starts--
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">EXCLUSIONS</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 15px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">{!!$data2->option2_exclusions!!}</td>
		</tr>
	</table>
	</div>
</div>
<!--Tour Exclusions ends-->

<!--Tour Payment Policy starts--
<!--<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">TERMS & CONDITIONS</h3>-->
@if(empty($data2->option2_package_payment) || $data2->option2_package_payment=="N;")
@else
	<!--<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Payment Conditions</h3>
			</td>
		</tr>
	</table>--
	<div style="margin: 0px 0px 0px;padding: 15px;background: #ffffff">
	<table width="100%">
		<tr>
			<!--<td style="padding: 15px 8px;background: #fff;border: 1px solid #bdbdbd;line-height: 22px;font-size: 14px;color: #636363;" class="custom_padding">
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">--
			<div class="flexcenter collapsible" style="justify-content: space-between">
				<p class="pfwmt" style="font-size: 14px;line-height: 18px;color: #008cff;">Payment Conditions</p>
				<i class="fa fa-angle-down" aria-hidden="true" style="padding: 10px 20px;font-size: 28px;color: #008cff"></i>
			</div>
			<?php $p_policy=unserialize($data2->option2_package_payment); ?>
			@foreach($p_policy as $v)
			<div class="content custom_padding" style="padding: 0px;margin: 0px 20px;background: #ffffff">
				<p>{!!CustomHelpers::get_payment_policy($v)!!}</p>
			
			@endforeach
			<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_payment_policies }}</div></div>
			</td>
		</tr>
	</table>
	</div>
@endif
<!--Tour Payment Policy ends-->
<!--Tour Cancellation Policy starts--
@if(empty($data2->option2_package_can) || $data2->option2_package_can=="N;")
@else
<div style="padding: 15px;background: #ffffff;margin-bottom: 10px">
<div style="">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Cancellation Conditions</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 10px 15px 25px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">
			<?php $c_policy=unserialize($data2->option2_package_can); ?>
			@foreach($c_policy as $v)
				{!!CustomHelpers::get_cancel_policy($v)!!}
			@endforeach
			<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_cancellation }}</div>
			</td>
			<td></td>
		</tr>
	</table>
	</div>
</div>
</div>
@endif
<!--Tour Cancellation Policy ends-->

<!--Tour Important Notes starts--
@if(empty($data2->option2_package_impnotes) || $data2->option2_package_impnotes=="N;")
@else
<div style="padding: 15px;background: #ffffff;margin-bottom: 10px">
<div style="margin: 20px 0px 0px 15px">
	<table width="100%">
		<tr>
			<td>
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Important Notes</h3>
			</td>
		</tr>
	</table>
	<div style="margin: 10px 15px 0px;border: 1px solid #e9e9e9;padding: 15px 25px;border-radius: 5px;background: #ffffff">
	<table width="100%">
		<tr>
			<td style="background: #ffffff;font-size: 14px;line-height: 22px;color: #4a4a4a;" class="custom_padding">
			<?php $important_notes=unserialize($data2->option2_package_impnotes); ?>
			@foreach($important_notes as $v)
				{!!CustomHelpers::get_impnotes($v)!!}
			@endforeach
				<div style="margin-top: 20px;font-size: 14px;font-weight: 600;line-height: 20px;color: #4a4a4a;border: 1px solid #e9e9e9;padding: 10px;border-radius: 5px;background: #ffffff">{{ $data2->option2_extra_imp }}</div>
			</td>
			
		</tr>
	</table>
	</div>
</div>
</div>
@endif

<!--Tour Important Notes ends-->



<div class="" style="margin-bottom: 10px;padding: 20px 20px 20px;background: #ffffff">	
	<h4 class="pfwmt" style="font-size: 18px;line-height: 22px;font-weight: 500;color: #070700">Why Book with us?</h4>
	<div class="flexcenter" style="margin-top: 20px;margin-bottom: 20px">
	<!--<h5 class="why_book_heading" style="padding-top: 15px">Excellent Support<h5>-->
		<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconLetter.png')}}" style="margin-right: 10px;">
		<!--<i class="fa fa-support" style="font-size: 15px;padding: 5px;border-radius: 25px;background: #E8F1F8"></i>-->
		<div style="font-size: 14px;line-height: 18px;"><span style="font-weight: 600">Instant</span> confirmation and vouchers sent over sms, email and WhatsApp as soon as your booking is complete</div>
	</div>
	<div class="flexcenter" style="margin-bottom: 20px">
	<!--<h5 class="why_book_heading" style="padding-top: 15px">Low Rates & Savings<h5>
		<i class="fa fa-phone" style="color: #56236C;font-size: 18px;margin-right: 10px;padding: 5px;border-radius: 50%;background: #E8F1F8"></i><i class="fa fa-wifi" style="font-size: 15px;margin-right: 10px;color: #008cff"></i>-->
		<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconPhone.png')}}" style="margin-right: 10px;">
		<div style="font-size: 14px;line-height: 18px;">A <span style="font-weight: 600">dedicated</span> travel expert is assigned to help and guide you during the trip to make your vacation memorable</div>
	</div>
	<div class="flexcenter" style="margin-bottom: 0px">
	<!--<h5 class="why_book_heading" style="padding-top: 15px">Variety of Tour Itineraries<h5>
		<i class="fa fa-bars" style="font-size: 15px;margin-right: 10px;padding: 5px;border-radius: 25px;background: #E8F1F8"></i>-->
		<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconTicket.png')}}" style="margin-right: 10px;">
		<div style="font-size: 14px;line-height: 18px;">You receive the revised vouchers in case of any change/ amendments/ pending confirmation 72 hours  before trip starts</div>
	</div>	
</div>

<!--Footer Signature Starts-->
@if($data2!="" && $data2->option2_quotation_footer!="" && $data2->option2_quotation_footer!="N;")
<div style="padding: 20px;background: #ffffff;margin-bottom: 25px">
<?php $footer=unserialize($data2->option2_quotation_footer); ?>
@foreach($footer as $footer_data)
{!! CustomHelpers::get_quotation_footer($footer_data) !!}
@endforeach
</div>
@endif
<!--Footer Signature Ends--> 
</table>

<!--Mobile Pricebar starts-->
<div style="width: 100%;background-color: #000000;position: fixed;bottom: 0px;z-index:999">
	<div class="flexcenter" style="padding: 10px 20px;justify-content: space-between">
		<div class="pfwmt" style="font-size: 20px;color: #ffffff;padding: 0px">
			<span style="font-size: 18px;font-weight: 500;">&#x20B9;</span> <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data2->option2_price,'adult')); ?>
			<span style="font-size: 10px;color: #CED0D4">Per person</span>
		</div>
		<div>
			<div style="border-left: 1px solid white;height: 35px;margin-left: -5%;position: absolute;">|</div>
			<button class="button" style="padding: 0px 60px;height: 40px;border-radius: 25px;font-size: 18px;font-weight: 900;background-color: #008cff;" data-toggle="modal" data-target="#queryHandler" id="book">BOOK</button>
		</div>
		
	</div>
</div>
<!--Mobile Pricebar ends-->

</div>