<div>
	<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 0px 0px 10px 10px;background: #ffffff;margin-bottom: 10px">
	@if($data3!="" && $data3->option3_quotation_header!="" && $data3->option3_quotation_header!="N;")
		<?php $header=unserialize($data3->option3_quotation_header); ?>
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
		<h3 class="pfwmt" style="font-size: 22px;line-height: 22px;color: #000000;margin-bottom: 10px">{{ $data3->custom_package_name }}</h3>
		<p class="pfwmt" style="font-size: 18px;line-height: 22px;color: #4a4a4a;margin-bottom: 20px">{{ $data3->duration-1 }} Nights - {{ $data3->duration }} Days</p>
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
			@if($data3->option3_transport=="Flight")
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
				<p class="pfwmt">{{ $data3->source }}</p>
			</div>
			<!--Tour Date-->
			<div class="" style="padding: 25px;border-radius: 5px;box-shadow: 0px 3px 6px #CED0D4;margin-right: 40px;width: 360px;max-height: 235px">
				<p style="font-size: 14px;font-weight: 600;margin: 0px;color: #a1a1a1">TOUR DATE</p>
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
					$datefrom_print = date("d M Y", strtotime($datefrom));
					$day_from = strtotime($datefrom);
					$day_from = date('D', $day_from);
					
					$to_days=$data3->duration-1;
					
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
			@if($data3->option3_price_type=="Per Person")
			<div>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">Total Basic Cost</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data3->option3_price,'adult')); ?></p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">Discount (-)</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data3->option3_price,'adult')); ?></p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">GST (5%)</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> 565</p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">TCS (5%)</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> 594</p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="makeflex" style="justify-content: space-between">
					<div>
					<p class="pfwmt" style="font-size: 18px;line-height: 32px">Grand Total</p>
					<p class="pfwmt" style="font-size: 11px;color: #4A4A4A;font-weight: normal;line-height: 12px">( {{ $data3->anything }} )</p>
					</div>
					<div>
					<p class="pfwmt" style="font-size: 21px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data3->option3_price,'adult')); ?></p>
					</div>
				</div>
			</div>
			@elseif($data3->option3_price_type=="Group Price")
			<div>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">Total Basic Cost</p>
					<?php
					$option3_adult=CustomHelpers::get_quotation_pricel($data3->option3_price,'adult');
					$option3_extradult=CustomHelpers::get_quotation_pricel($data3->option3_price,'exadult');
					$option3_child=CustomHelpers::get_quotation_pricel($data3->option3_price,'childbed');
					$option3_childwithoutbed=CustomHelpers::get_quotation_pricel($data3->option3_price,'childwbed');
					$option3_infant=CustomHelpers::get_quotation_pricel($data3->option3_price,'infant');
					$option3_single=CustomHelpers::get_quotation_pricel($data3->option3_price,'single');
					$option3_total=($option3_adult*2) + $option3_extradult + $option3_child + $option3_childwithoutbed + $option3_infant + $option3_single;
					?>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency($option3_total); ?></p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">Discount (-)</p>
					<?php
					$option3_adult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'adult');
					$option3_extradult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'exadult');
					$option3_child_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childbed');
					$option3_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childwbed');
					$option3_infant_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'infant');
					$option3_single_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'single');
					$option3_total_discount=($option3_adult_discount*2) + $option3_extradult_discount + $option3_child_discount + $option3_childwithoutbed_discount + $option3_infant_discount + $option3_single_discount;
					?>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency($option3_total_discount); ?></p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">GST (5%)</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> 565</p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt">TCS (5%)</p>
					<p class="pfwmt" style="font-size: 16px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> 594</p>
				</div>
				<hr style="border: 1px solid lightgray;margin: 16px 0px"></hr>
				<div class="flexcenter" style="justify-content: space-between">
					<p class="pfwmt" style="font-size: 18px">Grand Total</p>
					<p class="pfwmt" style="font-size: 21px"><span style="font-size:14px;font-weight: 400">&#x20B9; </span> <?php CustomHelpers::get_indian_currency($option3_total-$option3_total_discount); ?></p>
				</div>
			</div>
			@endif
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
		<!--Quote Validity starts-->
		@if($data3->option3_validaty!="")
			<div class="flexcenter" style="justify-content: flex-end;margin-top: 10px">
				<p class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px">QUOTE VALIDITY - </p>
				<div class="pfwmt" style="font-size: 12px;color: #9B9B9B;line-height: 12px;text-transform: uppercase">{{ date("d M Y", strtotime($data3->option3_validaty)) }}</div>
			</div>
		@endif
		<!--Quote Validity ends-->
	</div>
	<!--Departure City, Tour Date & Pricing ends-->

	<!--Flight & Other Transport Details Starts-->
	@if($data3->option3_transport=="Flight")
	<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
		<?php $flight_detail=unserialize($data3->option3_flight); ?>
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">FLIGHT DETAILS</h3>
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
						<div style="width: 120px;margin-right: 20px">
							<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
						</div>
						<div style="width: 100px">
							<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif</p>
							<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</p>
						</div>
						<div style="margin: 0px 30px">
							<p class="pfwmt" style="text-align: center;font-size: 12px;line-height: 12px;color: #4a4a4a;font-weight: 400">3h 30m</p>
							<div class="flexcenter">
								<i class="fa fa-plane" aria-hidden="true" style="font-size: 18px;color: #4A4A4A;transform: rotate(45deg)"></i>
								<div class="" style="margin: 6px 5px;border-top: 1px solid #ccc;width: 225px"></div>
								<i class="fa fa-map-marker" aria-hidden="true" style="font-size: 18px;color: #4A4A4A"></i>
								<!--<p class="pfwmt" style="text-align: center"><img height="20" src="{{url('/public/uploads/icons/planevenue.png')}}"></p>-->
								<!--<p class="pfwmt" style="text-align: center">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</p>-->
							</div>
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
						<div style="width: 120px;margin-right: 20px">
							<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="pfwmt" style="font-size: 14px;color: #4a4a4a;line-height: 17px;font-weight: 400">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
						</div>
						<div style="width: 100px">
							<p class="pfwmt" style="font-size: 18px;color: #4a4a4a;line-height: 22px;text-align: center">@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif</p>
							<p class="pfwmt" style="font-size: 14px;line-height: 17px;font-weight: 400;text-align: center">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
						</div>
						<div style="margin: 0px 30px">
							<p class="pfwmt" style="text-align: center;font-size: 12px;line-height: 12px;color: #4a4a4a;font-weight: 400">3h 30m</p>
							<div class="flexcenter">
								<i class="fa fa-plane" aria-hidden="true" style="font-size: 18px;color: #4A4A4A;transform: rotate(45deg)"></i>
								<div class="" style="margin: 6px 5px;border-top: 1px solid #ccc;width: 225px"></div>
								<i class="fa fa-map-marker" aria-hidden="true" style="font-size: 18px;color: #4A4A4A"></i>
								<!--<p class="pfwmt" style="text-align: center"><img height="20" src="{{url('/public/uploads/icons/planevenue.png')}}"></p>-->
								<!--<p class="pfwmt" style="text-align: center">@if(array_key_exists("dnumberstop", $flight_detail) && $flight_detail['dnumberstop']!="") {{$flight_detail['dnumberstop']}} @endif</p>-->
							</div>
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
		<!--Other Transport option-->
	@elseif($data3->option3_transport!="0")
	<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px;text-transform: uppercase">{{ $data3->option3_transport }}</h3>
		<div style="margin: 20px 20px 0px">
			<p class="pfwmt" style="font-size: 16px;line-height: 16px;font-weight: 500;color: #4A4A4A">{{ $data3->option3_transport_description }}</p>
		</div>
	</div>
	@endif
	<!--Flight & Other Transport Details Ends-->
	
	<!--Transfer Details Starts-->
	<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">TRANSFERS</h3>
		<div style="margin: 0px 15px">
			<div style="margin-bottom: 25px">
				<div class="" style="margin-bottom: 10px">
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">Airport to Dubai Hotel transfer</span>
				</div>
				<div style="border: 1px solid #CCCCCC;padding: 25px 25px;border-radius: 5px;background: #F9F9F9">
					<div class="makeflex">
						<!--Vehicle Image-->
						<div class="" style="padding-right: 25px">
							<img width="270" height="140" src="{{ url('/public/uploads/no-image.png') }}" style="border-radius: 5px">								
						</div>
						<div>
							<!--Private, Shared, Coach-->
							<div style="margin-bottom: 55px">
								<p class="pfwmt" style="line-height: 15px;font-weight: 500;margin-bottom: 10px">Airport to Hotel Transfer</p>
								<p class="pfwmt" style="font-size: 20px;line-height: 24px;margin-bottom: 5px;">Private Transfer</p>
							</div>
							<!--Vehicle Type,Duration & Inclusion-->
							<div class="flexcenter">
								<div style="width: 150px;margin-right: 40px">
									<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">VEHICLE TYPE</p>
									<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">Toyata Hiace</p>
								</div>
								<div style="width: 150px;margin-right: 40px">
									<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">DURATION</p>
									<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">1 hrs</p>
								</div>
								<div>
									<p class="pfwmt" style="font-size: 12px;line-height: 17px;color: #9B9B9B">INCLUDES</p>
									<p class="pfwmt" style="font-size: 14px;line-height: 17px;color: #4A4A4A">One-way Private transfer</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Transfer Details Ends-->

	<!--Hotel Details Starts-->
	<div style="border: 1px solid #CED0D4;padding: 25px;border-radius: 10px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000;margin-bottom: 20px">ACCOMMODATION</h3>
		<?php
			$acco=unserialize($data3->option3_accommodation);
			$i="1";
		?>
		@foreach($acco as $acco_data)
		<div style="margin: 0px 15px">
			<div style="margin-bottom: 25px">
				<div class="" style="margin-bottom: 10px">
					<span style="font-size: 16px;font-weight: 600;color: #4A4A4A">{{ $acco_data["city"] }}</span>
				@if($i>1)
				<br>
				@endif
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
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $i++; ?>
		@endforeach
	</div>
	<!--Hotel Details Ends-->

	<!--Tour Itinerary Starts-->
	@php
		$itinerary_data=unserialize($data3->option3_dayItinerary);
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

	<!--Tour Inclusions & Exclusions Starts-->
	<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">INCLUSIONS & EXCLUSIONS</h3>
			<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<!--Inclusions-->
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Inclusions</h3>
				<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data3->option3_inclusions!!}</p>
				<!--Exclusions-->
				<h3 class="pfwmt" style="margin-top: 25px;font-size: 16px;line-height: 19px;color: #000000">Exclusions</h3>
				<p style="margin: 10px 0px;border-bottom: 1px solid #e9e9e9">{!!$data3->option3_exclusions!!}</p>
			</div>
	</div>
	<!--Tour Inclusions & Exclusions Ends-->

	<!--Tour Visa Policy starts-->
	@if($data3->option3_visa=="1")
	@if(empty($data3->option3_package_visa) || $data3->option3_package_visa=="N;")
	@else
		<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
			<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">VISA POLICY</h3>
			<?php $v_policy=unserialize($data3->option3_package_visa); ?>
			@foreach($v_policy as $v)
				<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
					<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_visa_policy($v)!!}</p>
				</div>
				<div style="margin: 10px 20px 0px;border-top: 8px solid #f9f9f9;"></div>
			@endforeach
				<div class="pfwmt" style="margin: 20px 20px 0px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data3->option3_visa_policies }}</div>
		</div>
	@endif
	@endif
	<!--Tour Visa Policy ends-->

	<!--Tour Booking & Cancellation Policy starts-->
	<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
	<!--Tour Booking Policy starts-->
	@if(empty($data3->option3_package_payment) || $data3->option3_package_payment=="N;")
	@else
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">BOOKING & CANCELLATION</h3>
			<?php $p_policy=unserialize($data3->option3_package_payment); ?>
		@foreach($p_policy as $v)
			<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Booking Policy</h3>
				<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_payment_policy($v)!!}</p>
			</div>
		@endforeach
			<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data3->option3_payment_policies }}</div>
			<div style="margin: 20px 20px;border-top: 8px solid #f9f9f9;"></div>
	@endif
	<!--Tour Booking Policy ends-->
	<!--Tour Cancellation Policy starts-->
	@if(empty($data3->option3_package_can) || $data3->option3_package_can=="N;")
	@else
		<?php $c_policy=unserialize($data3->option3_package_can); ?>
		@foreach($c_policy as $v)
			<div class="custom_padding" style="margin: 0px 20px 0px 20px;background: #ffffff">
				<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">Cancellation Policy</h3>
				<p style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9">{!!CustomHelpers::get_cancel_policy($v)!!}</p>
			</div>
		@endforeach
			<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data3->option3_cancellation }}</div>
	@endif
	<!--Tour Cancellation Policy ends-->
	</div>
	<!--Tour Booking & Cancellation Policy ends-->

	<!--Tour Important Notes starts-->
	@if(empty($data3->option3_package_impnotes) || $data3->option3_package_impnotes=="N;")
	@else
	<div style="border: 1px solid #CED0D4;border-radius: 5px;padding: 25px;background: #ffffff;margin-bottom: 10px">
		<h3 class="pfwmt" style="font-size: 16px;line-height: 19px;color: #000000">IMPORTANT NOTES</h3>
		<?php $important_notes=unserialize($data3->option3_package_impnotes); ?>
		@foreach($important_notes as $v)
			<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<p class="pfwmt" style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9;font-size: 14px;font-weight: 400">{!!CustomHelpers::get_impnotes($v)!!}</p>
			</div>
		@endforeach
			<div class="pfwmt" style="margin: 0px 20px;padding: 5px 10px;font-size: 14px;line-height: 20px;border: 1px solid #e9e9e9;border-radius: 3px;background: #ffffff">{{ $data3->option3_extra_imp }}</div>
	</div>
	@endif
	<!--Tour Important Notes ends-->

	<!--Acceptance & Rejection button-->
	@if($data1->accept_status=="0" && $data1->send_option=="1")
	@include("query.quotation_webpage.accept")
	@endif
	<br>

	<!--Footer Signature Starts-->
	@if($data3!="" && $data3->option3_quotation_footer!="" && $data3->option3_quotation_footer!="N;")
	<div style="border: 1px solid #CED0D4;padding: 25px 25px;border-radius: 5px;background: #ffffff;margin-bottom: 25px">
	<?php $footer=unserialize($data3->option3_quotation_footer); ?>
	@foreach($footer as $footer_data)
	{!! CustomHelpers::get_quotation_footer($footer_data) !!}
	@endforeach
	</div>
	@endif
	<!--Footer Signature Ends--> 
	</table>
</div>
