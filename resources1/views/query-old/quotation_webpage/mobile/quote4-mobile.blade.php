	<div class="mtourQuoteWebHeadCont">
	@if($data4!="" && $data4->option4_quotation_header!="" && $data4->option4_quotation_header!="N;")
		<?php $header=unserialize($data4->option4_quotation_header); ?>
		@foreach($header as $header_data)
			{!! CustomHelpers::get_quotation_header($header_data) !!}
		@endforeach
	@endif
	@if($data1->accept_status=="0" && $data1->send_option=="1")
		
	@endif
	</div>
	<!--Package Name & Services Included-->
	<div class="mtourQuoteSummaryCont">
		<h4 class="mtourQuoteTitle">{{ $data4->custom_package_name }}</h4>
		<h5 class="mtourQuoteDaysBadge">{{ $data4->duration-1 }} Nights / {{ $data4->duration }} Days</h5>
		<div class="mtouQuoteBookCont">
			<div>
			<h5 class="mtourQuoteServiceTitle">Included in this package</h5>
			</div>
			<!--Check service icons-->
			<div id="mobscroll" class="mobscroll overflowX">
				<?php $package_service=unserialize($data4->package_service); ?>
					@if(empty($package_service))
					@else
					<h5 class="tourQuoteServiceTitle">Included in this package</h5>
					<div class="flexCenter">
						@foreach($package_service as $icon)
						<!--<img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" width="40px;" height="40px" style="margin-right:10px;margin-bottom: 10px;margin-top: 7px;">-->
						<div class="serviceIcons">
						<div class="serviceIconsImage">
							<img class="serviceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($icon,'rt_icons','icon','icon_title') }}">
						</div>
						<!--<div class="serviceIconsTitle">{{ CustomHelpers::getimagename($icon,'rt_icons','icon','icon_title') }}</div>-->
					</div>
						@endforeach
					</div>
					@endif
			</div>
			<!--Check service icons // Remove this-->
			<!--<div class="flexCenter">
				@if($data4->option4_transport=="Flight")
				<div class="appendRight20">
					<p class="textCenter appendBottom5">
						<img src="{{url('/resources/views/query/mail/mail_img/plane.png')}}" width="40px;" height="40px"></p>
					<p class="font12 appendBottom0 textCenter">Flight</p>
				</div>
				@endif
				<div class="appendRight20">
					<p class="textCenter appendBottom5">
						<img src="{{url('/resources/views/query/mail/mail_img/bed.png')}}" width="40px" height="40px"></p>
					<p class="font12 appendBottom0 textCenter">Hotel</p>
				</div>
				<div class="appendRight20">
					<p class="textCenter appendBottom5">
						<img src="{{url('/resources/views/query/mail/mail_img/eye.png')}}" width="40px;" height="40px"></p>
					<p class="font12 appendBottom0 textCenter">Sightseeing</p>
				</div>
				<div class="appendRight20">
					<p class="textCenter appendBottom5">
						<img src="{{url('/resources/views/query/mail/mail_img/ipod.png')}}" width="40px" height="40px"></p>
					<p class="font12 appendBottom0 textCenter">Meals</p>
				</div>
			</div>-->
		</div>
	</div>
	<!--Departure City, Tour Date,Pricing & Quote Validity starts-->
	<div class="mtourQuoteDatePricingCont">
		<div class="flexColumn">
			<!--Departure City-->
			<div class="mtourQuoteCityBox">
				<h4 class="mtourQuoteCityBoxHead">DEPARTURE CITY</h4>
				<h3 class="mtourQuoteCityName">{{ $data4->source }}</h3>
			</div>	
			<!--Tour Date-->
			<div class="mtourQuoteDateBox">
				<h4 class="mtourQuoteDateBoxHead">TOUR DATE</h4>
				<?php
					$originalDate = CustomHelpers::get_query_field($data4->query_reference,'date_arrival');
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
					
					$to_days=$data4->duration-1;
					
					$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
					$stop_date_print= date("d M Y", strtotime($stop_date));
					$day_to = strtotime($stop_date);
					$day_to = date('D', $day_to);
				?>
				<h3 class="mtourQuoteDepDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</h3>
				<p class="mtourQuoteDateBoxHead appendTop10">TO</p>
				<p class="mtourQuoteRetDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
			</div>
			<!--Pricing-->
			<div class="mtourQuotePriceBox">
			@if($data4->option4_price_type=="Per Person")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">Tour Cost</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data4->option4_price,'adult')); ?></p>
				</div>
				<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data4->option4_price,'adult')); ?></p>
				</div>
				<!--<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">GST (5%)</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span>565</p>
				</div>
				<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">TCS (5%)</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span>594</p>
				</div>-->
				<div class="mtourQuotePriceSeparator"></div>
				<div class="flexBetween">
					<div>
					<p class="mtourQuotePriceTotal">Grand Total</p>
					<p class="mtourQuotePriceTagline">( {{ $data4->anything }} )</p>
					</div>
					<div>
					<p class="mtourQuotePriceTotalValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data4->option4_price,'adult')); ?></p>
					</div>
				</div>
			</div>
			@elseif($data4->option4_price_type=="Group Price")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
					<?php
					$option4_adult=CustomHelpers::get_quotation_pricel($data4->option4_price,'adult');
					$option4_extradult=CustomHelpers::get_quotation_pricel($data4->option4_price,'exadult');
					$option4_child=CustomHelpers::get_quotation_pricel($data4->option4_price,'childbed');
					$option4_childwithoutbed=CustomHelpers::get_quotation_pricel($data4->option4_price,'childwbed');
					$option4_infant=CustomHelpers::get_quotation_pricel($data4->option4_price,'infant');
					$option4_single=CustomHelpers::get_quotation_pricel($data4->option4_price,'single');
					$option4_total=($option4_adult*2) + $option4_extradult + $option4_child + $option4_childwithoutbed + $option4_infant + $option4_single;
					?>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option4_total); ?></p>
				</div>
				<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
					<?php
					$option4_adult_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'adult');
					$option4_extradult_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'exadult');
					$option4_child_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'childbed');
					$option4_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'childwbed');
					$option4_infant_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'infant');
					$option4_single_discount=CustomHelpers::get_quotation_discount($data4->option4_price,'single');
					$option4_total_discount=($option4_adult_discount*2) + $option4_extradult_discount + $option4_child_discount + $option4_childwithoutbed_discount + $option4_infant_discount + $option4_single_discount;
					?>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option4_total_discount); ?></p>
				</div>
				<!--<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">GST (5%)</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span>565</p>
				</div>
				<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceBoxSubHead">TCS (5%)</p>
					<p class="mtourQuotePriceValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span>594</p>
				</div>-->
				<div class="mtourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="mtourQuotePriceTotal">Grand Total</p>
					<p class="mtourQuotePriceTotalValue"><span class="mtourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option4_total-$option4_total_discount); ?></p>
				</div>
			</div>
			@endif
			<i>
			 <?php 
			$total_traveler="0";
			$adult=CustomHelpers::get_query_field($data4->query_reference,'span_value_adult');
			$child=CustomHelpers::get_query_field($data4->query_reference,'span_value_child');
			$infant=CustomHelpers::get_query_field($data4->query_reference,'span_value_infant'); 
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
		@if($data4->option4_validaty!="")
			<div class="mtourQuoteValidity">QUOTE VALIDITY - {{ date("d M Y", strtotime($data4->option4_validaty)) }}</div>
		@endif
		<!--Quote Validity ends-->
	</div>
	<!--Departure City, Tour Date & Pricing ends-->
	
	<!--Flight & Other Transport Details Starts-->
	@if($data4->option4_transport=="Flight")
	<div class="mtourQuoteFlightCont">
		<?php $flight_detail=unserialize($data4->option4_flight); ?>
		<h3 class="mtourQuoteFlightHead">FLIGHT DETAILS</h3>
		<div class="">
			<!--Upward Flight Starts-->
			<div class="mtourQuoteOnwardFlightBox">
				<!--Upward Flight Origin - Destination-->
				<div class="flexCenter appendBottom5">
					<div class="" style="margin-right: 5%">
					@if($flight_detail['Origin']!="")
						<span class="mflightCityName">{{ $flight_detail['Origin'] }}</span>
					@endif
						<span class="mflightCityName">-</span> 
					@if($flight_detail['dest']!="")
						<span class="mflightCityName">{{ $flight_detail['dest'] }}</span>
					@endif
					</div>
					<div>
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = $flight_detail['onwarddate'];
							$newDate_flight = date("d M Y", strtotime($originalDate_flight));
						?>
						<span class="mflightDate">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>
					  @endif 
					  @endif
					</div>
				</div>
				<!--Upward Flight Details-->	
				<div class="monwardFlightBox">
					<div class="flexCenter appendBottom15">
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = $flight_detail['onwarddate'];
							$newDate_flight = date("d M Y", strtotime($originalDate_flight));
						?>
						<!--<span class="fontWeight600 font18 color4A">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>-->
						@endif
						@endif
						<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
						<span class="mflightStop">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
						<div class="mclassSeparator"></div>
						<span class="mflightClass">Economy</span>
					</div>
					<div class="makeflex">
						<div class="mairlineLogoCont">
						<div class="mairlineLogoBox">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
							<img class="mairlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
						</div>
						<div class="mflightDtlsBox">
							<p class="mflightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="mflightNumber">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
						</div>
						</div>
						<div class="mflightDepBox">
							<p class="mflightTiming">@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif</p>
							<p class="mflightCity">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</p>
						</div>
						<div class="mflightDurationCont">
							<p class="mflightDuration">3h 30m</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="mflightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div class="mflightArrBox">
							<p class="mflightTiming">@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif</p>
							<p class="mflightCity" >@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</p>
						</div>
					</div>
					<p class="mbaggageTitle">Baggage info</p>
					<div class="flexCenter">
						<span class="mbaggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="mbaggageSubTitle">7 kgs</span>
						<div class="mbaggageSeparator"></div>
						<span class="mbaggageSubTitle color4A">Check in:&ensp;</span>
						<span class="mbaggageSubTitle">Standard</span>
					</div>
				</div>
			</div>
			<!--Upward Flight Ends-->
			<!--Return Flight Starts-->
			<div class="mtourQuoteReturnFlightBox">
				<!--Return Flight Origin - Destination-->
				<div class="flexCenter appendBottom5">
					<div class="" style="margin-right: 5%">
					@if($flight_detail['dOrigin']!="")
						<span class="mflightCityName">{{ $flight_detail['dOrigin'] }}</span>
					@endif
						<span class="mflightCityName">-</span> 
					@if($flight_detail['ddest']!="")
						<span class="mflightCityName">{{ $flight_detail['ddest'] }}</span>
					@endif
					</div>
					<div>
						@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
						<?php
							$originalDate_flight_down = $flight_detail['downwarddate'];
							$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
						?>
						<span class="mflightDate">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>
						@endif 
						@endif
					</div>
				</div>
				<!--Return Flight Details-->
				<div class="mreturnFlightBox">
					<div class="flexCenter appendBottom15">
						@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
						<?php
							$originalDate_flight_down = $flight_detail['downwarddate'];
							$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
						?>
						<!--<span class="fontWeight600 font18 color4A">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>-->
						@endif 
						@endif
						<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
						<span class="mflightStop">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
						<div class="mclassSeparator"></div>
						<span class="mflightClass">Economy</span>
					  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
					</div>
					<div class="makeflex">
						<div class="mairlineLogoCont">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
							<div class="mairlineLogoBox">
								<img class="mairlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
							</div>
							<div class="mflightDtlsBox">
								<p class="mflightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
								<p class="mflightNumber">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
							</div>
						</div>
						<div class="mflightDepBox">
							<p class="mflightTiming">@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif</p>
							<p class="mflightCity">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
						</div>
						<div class="mflightDurationCont">
							<p class="mflightDuration">3h 30m</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="mflightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div class="mflightArrBox">
							<p class="mflightTiming">@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif</p>
							<p class="mflightCity" >@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</p>
						</div>
					</div>
					<p class="mbaggageTitle">Baggage info</p>
					<div class="flexCenter">
						<span class="mbaggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="mbaggageSubTitle">7 kgs</span>
						<div class="mbaggageSeparator"></div>
						<span class="mbaggageSubTitle color4A">Check in:&ensp;</span>
						<span class="mbaggageSubTitle">Standard</span>
					</div>
				</div>
			</div>
			<!--Return Flight Ends-->
		</div>
	</div>
	<!--Other Transport option-->
	@elseif($data4->option4_transport!="0")
	<div class="mtourQuoteFlightCont">
		<h3 class="mtourQuoteFlightHead">{{ $data4->option4_transport }}</h3>
		<div class="mtourQuoteTransportBox">
			<p class="mtransportDesc">{{ $data4->option4_transport_description }}</p>
		</div>
	</div>
	@endif
	<!--Flight & Other Transport Details Ends-->
	
	<!--Hotel Details Starts-->
	<div class="mtourQuoteHotelCont">
		<h4 class="mtourQuoteHotelHead">ACCOMMODATION</h4>
		<?php
			$acco=unserialize($data4->option4_accommodation);
			$i="1";
		?>
		@foreach($acco as $acco_data)
		<div class="mtourQuoteHotelBox">
				<div class="mtourQuoteHotelTitle">{{ $acco_data["city"] }}
					@if($i>1)
					<br>
					@endif
				</div>
				<div class="mtourQuoteHotelDescBox">
					<div class="flex-column">
						<!--Property Image-->
						@if(array_key_exists("hotel",$acco_data))
						<div class="mhotelImageBox">
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
								<img class="mhotelImageType" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}"> 
							@elseif($acco_data["hotel"]=="other")
								<img class="mhotelImageType" src="{{ url('/public/uploads/no-image.png') }}">
							@endif
						</div>
						@endif
						<div class="mhotelDescBox">
						<div class="mhotelTopSection">
							<div class="mhotelType">Hotel</div>
							<!--Hotel Name-->
							<div class="mtourHotelDtls">
								<h5 class="mhotelName">
									@if(array_key_exists("hotel",$acco_data))
									@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
									@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
									@endif
									@endif
								</h5>
							</div>
							<div class="mhotelStarRating">
								@if(array_key_exists("star",$acco_data))
									@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
									@elseif($acco_data["star"]=="other")
										{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
									@endif
								@endif
							</div>
							<!--Destination City Name-->
							<div class="mhotelCityName">{{ $acco_data["city"] }}</div>
						</div>
							<!--No of Nights & Check-in & Checkout-->
						<div class="mhotelFooter">
							<div>
								<div class="mhotelDaysBadge">
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
										<!--<h5 class="hotelDaysBadge_nightCount">
											<?php
											 $date1=date_create($checkin_date);
											 $date2=date_create($checkout_date);
											$diff=date_diff($date1,$date2);
											?>
											@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
										</h5>-->
								</div>
								<!--Room Type & Hotel Website-->
							<div class="flexBetween appendBottom20">
								<div class="mhotelRoomCont">
									<p class="mhotelRoomCont_heading">ROOM TYPE</p>
									@if($acco_data["category"]!="")
									<p class="mhotelRoomCont_type">{{ $acco_data["category"] }}</p>
									@endif
								</div>
								<div>
									<h5 class="mhotelDaysBadge_heading">NO OF NIGHTS</h5>
									<h5 class="mhotelDaysBadge_nightCount">
									<!--Date Function-->
									<?php
										$date1=date_create($checkin_date);
										$date2=date_create($checkout_date);
										$diff=date_diff($date1,$date2);
									?>
										@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
									</h5>
								</div>
							</div>
								<!--Check-in & Checkout-->
								<div class="mhotelCheckInOut">
									<div class="mhotelCheckInCont">
										<p class="mhotelCheckInCont_heading">CHECK-IN </p>
										<p class="mhotelCheckInCont_date"><?php echo $day_checkin; ?>, {{ $checkin_date_print }}</p>
									</div>
									<!--<div>
										<h5 class="mhotelDaysBadge_nightCount">
											<?php
											 $date1=date_create($checkin_date);
											 $date2=date_create($checkout_date);
											$diff=date_diff($date1,$date2);
											?>
											@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
										</h5>
									</div>-->
									<div class="mhotelCheckOutCont">
										<p class="mhotelCheckOutCont_heading">CHECKOUT </p>
										<p class="mhotelCheckOutCont_date"><?php echo $day_checkin; ?>, {{ $checkout_date_print }}</p>
									</div>
								</div>
							</div>
							<!--Room Type & Hotel Website-->
							<div class="mhotelWebCont">
								<p class="mhotelWebCont_heading">HOTEL WEBSITE</p>
								@if($acco_data["category"]!="")
								<p class="mhotelWebCont_name">{{ $acco_data["category"] }}</p>
								@endif
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
		$itinerary_data=unserialize($data4->option4_dayItinerary);
		$day=1;
	@endphp
	@if(empty($itinerary_data) || $itinerary_data=="N;")
	@else
		@if($itinerary_data["day1"]["title"]!="")
		<div class="mtourQuoteItineraryCont">
			<div class="mtourQuoteItineraryHead foldable mfoldableArrow">Tour Itinerary</div>
			<div class="mfoldableContent">
			@foreach($itinerary_data as $itinerary_datas)
			<div class="mtourQuoteItineraryBox">
			<div class="makeflex" style="margin-top: 0">
				<div class="mtourQuoteLeftBorderMarker"></div>
				<div class="flex-column">
					<h3 class="mtourQuoteDayPlanHead">Day {{ $day++ }}</h3>
					<h5 class="mtourQuoteDayPlanSubHead">{{ $itinerary_datas['title'] }}</h5>
					<h5 class="mtourQuoteDayPlanSubHeadMore">View More</h5>
				</div>
			</div>
			<div class="mtourDtlsCont foldable mfoldableArrow">
				<span class="mtourQuoteItryDtls">Details</span>
			</div>
			<div class="mfoldableContent mtourQuoteDtlsDesc">
				<p>{!!$itinerary_datas['desc']!!}</p>
			</div>
			<div class="mtourQuoteDtlsDescSeparator"></div>
			</div>
			@endforeach
			</div>
		</div>
		@endif
	@endif
	<!--Tour Itinerary ends-->
	<!--Tour Inclusions & Exclusions Starts-->
	<div class="mtourQuoteIncCont">
		<div class="mtourQuoteIncHead foldable mfoldableArrow">Inclusions & Exclusions</div>
		<div class="mfoldableContent mtourQuoteIncBox">
			<!--Inclusions-->
			<div class="mtourQuoteInclusions">
				<h4 class="mtourQuoteIncSubHead">Inclusions</h4>
				<div>{!!$data4->option4_inclusions!!}</div>
			</div>
			<!--Exclusions-->
			<div class="mtourQuoteExclusions">
				<h4 class="mtourQuoteExcSubHead">Exclusions</h4>
				<div>{!!$data4->option4_exclusions!!}</div>
			</div>
		</div>
	</div>
	<!--Tour Inclusions & Exclusions Ends-->
	
	<!--Tour Visa Policy starts-->
	@if($data4->option4_visa=="1")
	@if(empty($data4->option4_package_visa) || $data4->option4_package_visa=="N;")
	@else
	<div class="mtourQuoteBookPolicyCont">
		<div class="mtourQuotePolicyHead foldable mfoldableArrow">Booking & Cancellation</div>
		<div class="mfoldableContent mtourQuotePolicyBox">
			<?php $v_policy=unserialize($data4->option4_package_visa); ?>
			@foreach($v_policy as $v)
			<div class="mtourQuotePolicy">
				<div>{!!CustomHelpers::get_visa_policy($v)!!}</div>
			</div>
			@endforeach
			<div class="mtourQuoteAddPolicy">{{ $data4->option4_visa_policies }}</div>
		</div>
	</div>
	<div class="mtourQuotePolicySeparator"></div>
	@endif
	@endif
	<!--Tour Visa Policy ends-->
	<!--Tour Booking & Cancellation Policy starts-->
	<div class="mtourQuoteBookPolicyCont">
		<div class="mtourQuotePolicyHead foldable mfoldableArrow">Booking & Cancellation</div>
		<div class="mfoldableContent mtourQuotePolicyBox">
		<!--Tour Booking Policy starts-->
		@if(empty($data4->option4_package_payment) || $data4->option4_package_payment=="N;")
		@else
			<?php $p_policy=unserialize($data4->option4_package_payment); ?>
			@foreach($p_policy as $v)
			<div class="mtourQuotePolicy">
				<h4 class="mtourQuoteBookHead">Booking Policy</h4>
				<div>{!!CustomHelpers::get_payment_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="mtourQuoteAddPolicy">{{ $data4->option4_payment_policies }}</div>
				<div class="mtourQuotePolicySeparator"></div>
		@endif
		<!--Tour Booking Policy ends-->
		<!--Tour Cancellation Policy starts-->
		@if(empty($data4->option4_package_can) || $data4->option4_package_can=="N;")
		@else
			<?php $c_policy=unserialize($data4->option4_package_can); ?>
			@foreach($c_policy as $v)
			<div class="mtourQuoteCnclPolicy">
				<h4 class="mtourQuoteCanHead">Cancellation Policy</h4>
				<div>{!!CustomHelpers::get_cancel_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="mtourQuoteCancelAddPolicy">{{ $data4->option4_cancellation }}</div>
		@endif
		<!--Tour Cancellation Policy ends-->
		</div>
	</div>
	<!--Tour Booking & Cancellation Policy ends-->
	<!--Tour Important Notes Starts-->
	@if(empty($data4->option4_package_can) || $data4->option4_package_can=="N;")
	@else
	<div class="mtourQuoteBookPolicyCont">
		<div class="mtourQuotePolicyHead foldable mfoldableArrow">Important Notes</div>
		<div class="mfoldableContent mtourQuotePolicyBox">
		<?php $important_notes=unserialize($data4->option4_package_impnotes); ?>
		@foreach($important_notes as $v)
			<div class="mtourQuotePolicy">
				<div>{!!CustomHelpers::get_impnotes($v)!!}</div>
			</div>
		@endforeach
			<div class="mtourQuoteAddPolicy">{{ $data4->option4_extra_imp }}</div>
			<!--<div class="mtourQuotePolicySeparator"></div>-->
		</div>
	</div>
	@endif
	<!--Tour Important Notes Ends-->
	<!--why Book with us-->
	<div class="mtourQuoteBookUsCont">
		<div>
			<h4 class="mtourQuoteBookUsHeading">Why Book with us?</h4>
		</div>
		<div class="flexCenter appendBottom20">
			<div class="mtourQuoteBookUsIconBox">
				<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconLetter.png')}}">
			</div>
			<div>
				<h5 class="mtourQuoteBookUsList"><b>Instant</b> confirmation and vouchers sent over sms, email and WhatsApp as soon as your booking is complete</h5>
			</div>
		</div>
		<div class="flexCenter appendBottom20">
			<div class="mtourQuoteBookUsIconBox">
				<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconPhone.png')}}">
			</div>
			<div>
				<h5 class="mtourQuoteBookUsList">A <b>dedicated</b> travel expert is assigned to help and guide you during the trip to make your vacation memorable</h5>
			</div>
		</div>
		<div class="flexCenter">
			<div class="mtourQuoteBookUsIconBox">
				<img width="30" height="30" src="{{url('/resources/assets/frontend/images/icon/iconTicket.png')}}">
			</div>
			<div>
				<h5 class="mtourQuoteBookUsList">You receive the revised vouchers in case of any change/ amendments/ pending confirmation 72 hours  before trip starts</h5>
			</div>
		</div>
	</div>
	<!--Raise concern or Pay Button starts-->
	<div class="mtouQuoteBookFooterCont">
		<div class="flexCenter">
			<button class="btnMain btnRaiseConcernMob user_quote_accept" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_reject') }}">Call Back Request</button>
			<!--<button class="btnMain btnPayBook user_quote_accept" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_accept') }}">PAY & BOOK</button>-->
		</div>
	</div>
	<!--Raise concern or Pay Button ends-->
	<!--Footer Signature Starts-->
	@if($data4!="" && $data4->option4_quotation_footer!="" && $data4->option4_quotation_footer!="N;")
	<div class="mtourQuoteFooterCont">
	<?php $footer=unserialize($data4->option4_quotation_footer); ?>
	@foreach($footer as $footer_data)
		{!! CustomHelpers::get_quotation_footer($footer_data) !!}
	@endforeach
	</div>
	@endif
	<!--Footer Signature Ends--> 
	<!--Mobile Pricebar starts-->
	<div class="mtourQuotePriceBar">
		<div class="mtourQuotePriceBarBox overflowX mobscroll">
			<div class="mtourQuotePriceBoxCont">
				<span class="mtourQuoteValue mtourQuotePriceBarCurency">
					<?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data4->option4_price,'adult')); ?>
				</span>
				<span class="mtourQuoteValueTagline">Per person</span>
			</div>
			
			<div>
				<div class="mtourQuotePriceLine"></div>
				<button class="btnMain btnBookMob" id="book">BOOK</button>
			</div>
		</div>
	</div>
	<!--Mobile Pricebar ends-->