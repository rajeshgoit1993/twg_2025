<div class="row">
	<div class="col-md-12" style="overflow-x:auto;">
	<div class="tourQuoteWebHeadCont">
	@if($data1!="" && $data1->option1_quotation_header!="" && $data1->option1_quotation_header!="N;")
	<?php $header=unserialize($data1->option1_quotation_header); ?>
	@foreach($header as $header_data)
		{!! CustomHelpers::get_quotation_header($header_data) !!}
	@endforeach
	@endif
	</div>
	<!--Package Name & Services Included-->
	<div class="tourQuoteSummaryCont">
		<div>
			<h4 class="tourQuoteTitle">{{ $data1->custom_package_name }}</h4>
			<h5 class="tourQuoteDaysBadge">{{ $data1->duration-1 }} Nights / {{ $data1->duration }} Days</h5>
		</div>
		<div class="touQuoteBookCont">
		<div>
		
		<!--Check service icons-->
		<div id="mobscroll" class="mobscroll overflowX">
			<?php $package_service=unserialize($data1->package_service); ?>
				@if(empty($package_service))
				@else
				<h5 class="tourQuoteServiceTitle">Included in this package</h5>
				<div class="flexCenter">
					@foreach($package_service as $icon)
					<div class="serviceIcons">
					<div class="serviceIconsImage">
						<img class="serviceImage" src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" title="{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}">
					</div>
					<div class="serviceIconsTitle">{{ CustomHelpers::getimagename($icon,'rt_icons','icon_title') }}</div>
				</div>
					@endforeach
				</div>
				@endif
		</div>
		</div>
		
		<!--Accept, Reject or Pay  Button starts-->
		<div>
		@include("query.quotation_webpage.accept")
		</div>
		<!--Accept, Reject or PayButton ends-->
		</div>
	</div>
	
	<!--Departure City, Tour Date,Pricing & Quote Validity starts-->
	<div class="tourQuoteDatePricingCont">
		<div class="makeflex">
			<!--Departure City-->
			<div class="tourQuoteCityBox">
				<h4 class="tourQuoteCityBoxHead">DEPARTURE CITY</h4>
				<h3 class="tourQuoteCityName">{{ $data1->source }}</h3>
			</div>
			<!--Tour Date-->
			<div class="tourQuoteDateBox">
				<h4 class="tourQuoteDateBoxHead">TOUR DATE</h4>
				<?php
					$originalDate = CustomHelpers::get_query_field($data1->query_reference,'date_arrival');

					if($originalDate=="N" || $originalDate==""):
					$originalDate=date("Y-m-d");
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
					$datefrom_print = date("d M Y", strtotime($datefrom));
					$day_from = strtotime($datefrom);
					$day_from = date('D', $day_from);
					
					$to_days=$data1->duration-1;
					
					$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
					$stop_date_print= date("d M Y", strtotime($stop_date));
					$day_to = strtotime($stop_date);
					$day_to = date('D', $day_to);
				?>
				<h3 class="tourQuoteDepDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</h3>
				<p class="tourQuoteDateBoxHead appendTop10">TO</p>
				<p class="tourQuoteRetDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
			</div>
			<!--Pricing-->
			<div class="tourQuotePriceBox">
			@if($data1->option1_price_type=="Per Person")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Tour Price</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data1->option1_price,'adult')); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data1->option1_price,'adult')); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="flexBetween">
					<div>
					<p class="tourQuotePriceTotal">Grand Total</p>
					<p class="tourQuotePriceTagline">( {{ $data1->anything }} )</p>
					</div>
					<div>
					<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data1->option1_price,'adult')); ?></p>
					</div>
				</div>
			</div>
			@elseif($data1->option1_price_type=="Group Price")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Tour Price</p>
					<?php
					$option1_adult=CustomHelpers::get_quotation_pricel($data1->option1_price,'adult');
					$option1_extradult=CustomHelpers::get_quotation_pricel($data1->option1_price,'exadult');
					$option1_child=CustomHelpers::get_quotation_pricel($data1->option1_price,'childbed');
					$option1_childwithoutbed=CustomHelpers::get_quotation_pricel($data1->option1_price,'childwbed');
					$option1_infant=CustomHelpers::get_quotation_pricel($data1->option1_price,'infant');
					$option1_single=CustomHelpers::get_quotation_pricel($data1->option1_price,'single');
					$option1_total=($option1_adult*2) + $option1_extradult + $option1_child + $option1_childwithoutbed + $option1_infant + $option1_single;
					?>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option1_total); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<?php
					$option1_adult_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'adult');
					$option1_extradult_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'exadult');
					$option1_child_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'childbed');
					$option1_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'childwbed');
					$option1_infant_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'infant');
					$option1_single_discount=CustomHelpers::get_quotation_discount($data1->option1_price,'single');
					$option1_total_discount=($option1_adult_discount*2) + $option1_extradult_discount + $option1_child_discount + $option1_childwithoutbed_discount + $option1_infant_discount + $option1_single_discount;
					?>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option1_total_discount); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">GST (5%)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>565</p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">TCS (5%)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>594</p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceTotal">Grand Total</p>
					<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option1_total-$option1_total_discount); ?></p>
				</div>
			</div>
			@endif
			<i>
			 <?php 
			$total_traveler="0";
			$adult=CustomHelpers::get_query_field($data1->query_reference,'span_value_adult');
			$child=CustomHelpers::get_query_field($data1->query_reference,'span_value_child');
			$infant=CustomHelpers::get_query_field($data1->query_reference,'span_value_infant'); 
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
		@if($data1->option1_validaty!="")
			<div class="tourQuoteValidity">QUOTE VALIDITY - {{ date("d M Y", strtotime($data1->option1_validaty)) }}</div>
		@endif
		<!--Quote Validity ends-->
	</div>
	<!--Departure City, Tour Date & Pricing ends-->
	
	<!--Flight & Other Transport Details Starts-->
	@if($data1->option1_transport=="Flight")
	<div class="tourQuoteFlightCont">
		<?php $flight_detail=unserialize($data1->option1_flight); ?>
		<h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
		<div class="">
			<!--Upward Flight Starts-->
			<div class="tourQuoteOnwardFlightBox">
				<!--Upward Flight Origin - Destination-->
				<div class="flexCenter appendBottom5">
					<div class="appendRight20">
					@if($flight_detail['Origin']!="")
						<span class="flightCityName">{{ $flight_detail['Origin'] }}</span>
					@endif
						<span class="flightCityName">-</span> 
					@if($flight_detail['dest']!="")
						<span class="flightCityName">{{ $flight_detail['dest'] }}</span>
					@endif
					</div>
					<div>
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = $flight_detail['onwarddate'];
							$newDate_flight = date("d M Y", strtotime($originalDate_flight));
						?>
						<span class="flightDate">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>
					  @endif 
					  @endif
					</div>
				</div>
				<!--Upward Flight Details-->	
				<div class="onwardFlightBox">
					<div class="flexCenter appendBottom15">
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = $flight_detail['onwarddate'];
							$newDate_flight = date("d M Y", strtotime($originalDate_flight));
						?>
						@endif
						@endif
						<span class="flightStop">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
						<div class="classSeparator"></div>
						<span class="flightClass">Economy</span>
					</div>
					<div class="flexCenter appendLeft20">
						<div class="appendRight10">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
							<div class="airlineLogoBox">
								<img class="airlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
							</div>
						</div>
						<div class="appendRight20"style="width: 120px">
							<p class="flightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="flightNumber">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
						</div>
						<div style="width: 100px">
							<p class="flightTiming">@if($flight_detail['dtime']!="") {{$flight_detail['dtime']}} @endif</p>
							<p class="flightCity">@if($flight_detail['Origin']!="") {{$flight_detail['Origin']}} @endif</p>
						</div>
						<div class="flightDurationCont">
							<p class="flightDuration">3h 30m</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="flightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div style="width: 100px">
							<p class="flightTiming">@if($flight_detail['atime']!="") {{$flight_detail['atime']}} @endif</p>
							<p class="flightCity" >@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</p>
						</div>
					</div>
					<p class="baggageTitle">Baggage info</p>
					<div class="flexCenter">
						<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="baggageSubTitle">7 kgs</span>
						<div class="baggageSeparator"></div>
						<span class="baggageSubTitle color4A">Check in:&ensp;</span>
						<span class="baggageSubTitle">30 kgs</span>
					</div>
				</div>
			</div>
			<!--Upward Flight Ends-->
			<!--Return Flight Starts-->
			<div class="tourQuoteReturnFlightBox">
				<!--Return Flight Origin - Destination-->
				<div class="flexCenter appendBottom5">
					<div class="appendRight20">
					@if($flight_detail['dOrigin']!="")
						<span class="flightCityName">{{ $flight_detail['dOrigin'] }}</span>
					@endif
						<span class="flightCityName">-</span> 
					@if($flight_detail['ddest']!="")
						<span class="flightCityName">{{ $flight_detail['ddest'] }}</span>
					@endif
					</div>
					<div>
						@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
						<?php
							$originalDate_flight_down = $flight_detail['downwarddate'];
							$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
						?>
						<span class="flightDate">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>
						@endif 
						@endif
					</div>
				</div>
				<!--Return Flight Details-->
				<div class="returnFlightBox">
					<div class="flexCenter appendBottom15">
						@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
						<?php
							$originalDate_flight_down = $flight_detail['downwarddate'];
							$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
						?>
						@endif 
						@endif
						<span class="flightStop">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
						<div class="classSeparator"></div>
						<span class="flightClass">Economy</span>
					</div>
					<div class="flexCenter appendLeft20">
						<div class="appendRight10">
							<div class="airlineLogoBox">
								<img class="airlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
							</div>
						</div>
						<div class="appendRight20"style="width: 120px">
							<p class="flightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="flightNumber">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
						</div>
						<div style="width: 100px">
							<p class="flightTiming">@if(array_key_exists("ddtime", $flight_detail) && $flight_detail['ddtime']!="") {{$flight_detail['ddtime']}} @endif</p>
							<p class="flightCity">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
						</div>
						<div class="flightDurationCont">
							<p class="flightDuration">3h 30m</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="flightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div style="width: 100px">
							<p class="flightTiming">@if(array_key_exists("datime", $flight_detail) && $flight_detail['datime']!="") {{$flight_detail['datime']}} @endif</p>
							<p class="flightCity" >@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</p>
						</div>
					</div>
					<p class="baggageTitle">Baggage info</p>
					<div class="flexCenter">
						<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="baggageSubTitle">7 kgs</span>
						<div class="baggageSeparator"></div>
						<span class="baggageSubTitle color4A">Check in:&ensp;</span>
						<span class="baggageSubTitle">30 kgs</span>
					</div>
				</div>
			</div>
			<!--Return Flight Ends-->
		</div>
	</div>
	<!--Other Transport option-->
	@elseif($data1->option1_transport!="0")
	<div class="tourQuoteFlightCont">
		<h3 class="tourQuoteFlightHead">{{ $data1->option1_transport }}</h3>
		<div class="tourQuoteTransportBox">
			<p class="transportDesc">{{ $data1->option1_transport_description }}</p>
		</div>
	</div>
	@endif
	<!--Flight & Other Transport Details Ends-->
	
	<!--Hotel Details Starts-->
	<div class="tourQuoteHotelCont">
		<h3 class="tourQuoteHotelHead">ACCOMMODATION</h3>
		<?php
			$acco=unserialize($data1->option1_accommodation);
			$i="1";
		?>
		@foreach($acco as $acco_data)
		<div class="tourQuoteHotelBox">
				<div class="tourQuoteHotelTitle">{{ $acco_data["city"] }}
					@if($i>1)
					<br>
					@endif
				</div>
				<div class="tourQuoteHotelDescBox">
					<div class="makeflex">
						<!--Property Image-->
						@if(array_key_exists("hotel",$acco_data))
						<div class="hotelImageBox">
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
								<img class="hotelImageType" src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}"> 
							@elseif($acco_data["hotel"]=="other")
								<img class="hotelImageType" src="{{ url('/public/uploads/no-image.png') }}">
							@endif
						</div>
						@endif
						<div class="hotelDescBox">
						<div class="hotelTopSection">
							<div class="hotelType">Hotel</div>
							<!--Hotel Name-->
							<div class="flexcenter">
								<div class="tourHotelDtls">
									<div>
										<h5 class="hotelName">
										@if(array_key_exists("hotel",$acco_data))
											@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other") {{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
											@elseif($acco_data["hotel"]=="other") {{$acco_data["other_hotel"]}}
											@endif
										@endif
										</h5>
									</div>
									<div class="hotelStarRating">
										@if(array_key_exists("star",$acco_data))
											@if($acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
											@elseif($acco_data["star"]=="other")
												{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
											@endif
										@endif
									</div>
								</div>
							</div>
							<!--Destination City Name-->
							<div class="hotelCityName">{{ $acco_data["city"] }}</div>
						</div>
							<!--No of Nights & Check-in & Checkout-->
						<div class="hotelFooter">
							<div class="makeflex" style="margin-bottom: 20px">
								<div class="hotelDaysBadge">
									<h5 class="hoteDaysBadge_heading">NO OF NIGHTS</h5>
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
										<h5 class="hotelDaysBadge_nightCount">
											<?php
											 $date1=date_create($checkin_date);
											 $date2=date_create($checkout_date);
											$diff=date_diff($date1,$date2);
											?>
											@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
										</h5>
								</div>
								<!--Check-in & Checkout-->
								<div class="hotelCheckInOut">
									<div class="hotelCheckInCont">
										<p class="hotelCheckInCont_heading">CHECK-IN </p>
										<p class="hotelCheckInCont_date"><?php echo $day_checkin; ?>, {{ $checkin_date_print }}</p>
									</div>
									<div class="hotelCheckOutCont">
										<p class="hotelCheckOutCont_heading">CHECKOUT </p>
										<p class="hotelCheckOutCont_date"><?php echo $day_checkout; ?>, {{ $checkout_date_print }}</p>
									</div>
								</div>
							</div>
							<!--Room Type & Hotel Website-->
							<div class="flexcenter">
								<div class="hotelRoomCont">
									<p class="hotelRoomCont_heading">ROOM TYPE</p>
									@if($acco_data["category"]!="")
									<p class="hotelRoomCont_type">{{ $acco_data["category"] }}</p>
									@endif
								</div>
								<div class="hotelWebCont">
									<p class="hotelWebCont_heading">HOTEL WEBSITE</p>
									@if($acco_data["category"]!="")
									<p class="hotelWebCont_name">{{ $acco_data["category"] }}</p>
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
		$itinerary_data=unserialize($data1->option1_dayItinerary);
		$day=1;
	@endphp
	@if(empty($itinerary_data) || $itinerary_data=="N;")
	@else
		@if($itinerary_data["day1"]["title"]!="")
		<div class="tourQuoteItineraryCont">
			<h3 class="tourQuoteItineraryHead">TOUR ITINERARY</h3>
			@foreach($itinerary_data as $itinerary_datas)
			<div class="tourQuoteItineraryBox">
				<div class="makeflex">
					<div class="tourQuoteLeftBorderMarker"></div>
					<div class="flex-column">
						<h3 class="tourQuoteDayPlanHead">Day {{ $day++ }}</h3>
						<h5 class="tourQuoteDayPlanSubHead">{{ $itinerary_datas['title'] }}</h5>
					</div>
				</div>
				<div class="dayDescription appendBottom10">
					<p>{!!$itinerary_datas['desc']!!}</p>
				</div>
			</div>
			<div class="tourQuoteItinerarySeparator"></div>
			@endforeach
		</div>
		@endif
	@endif
	<!--Tour Itinerary ends-->
	
	<!--Tour Inclusions & Exclusions Starts-->
	<div class="tourQuoteItineraryCont">
		<h3 class="tourQuoteItineraryHead">INCLUSIONS & EXCLUSIONS</h3>
		<div class="tourQuoteItineraryBox">
			<!--Inclusions-->
			<div class="tourQuoteInclusions">
				<h4 class="tourQuoteInclusionHeading">Inclusions</h4>
				<div>{!!$data1->option1_inclusions!!}</div>
			</div>
			<!--Exclusions-->
			<div class="tourQuoteExclusions">
				<h4 class="tourQuoteExclusionHeading">Exclusions</h4>
				<div>{!!$data1->option1_exclusions!!}</div>
			</div>
		</div>
	</div>
	<!--Tour Inclusions & Exclusions Ends-->
	
	<!--Tour Visa Policy starts-->
	@if($data1->option1_visa=="1")
	@if(empty($data1->option1_package_visa) || $data1->option1_package_visa=="N;")
	@else
	<div class="tourQuoteVisaPolicyCont">
		<h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
		<div class="tourQuoteVisaPolicyBox">
		<?php $v_policy=unserialize($data1->option1_package_visa); ?>
			@foreach($v_policy as $v)
			<div class="tourQuoteVisa">
				<h4 class="tourQuoteVisaHeading">Visas</h4>
				<div>{!!CustomHelpers::get_visa_policy($v)!!}</div>
			</div>
			<div class="tourQuoteVisaPolicySeparator"></div>
			@endforeach
			<div class="tourQuoteVisaAddPolicy">{{ $data1->option1_visa_policies }}</div>
		</div>
	</div>
	@endif
	@endif
	<!--Tour Visa Policy ends-->
	
	<!--Tour Booking & Cancellation Policy starts-->
	<div class="tourQuoteBookPolicyCont">
		<h3 class="tourQuoteBookPolicyHead">BOOKING AND CANCELLATION POLICY</h3>
		<div class="tourQuoteBookPolicyBox">
		<!--Tour Booking Policy starts-->
		@if(empty($data1->option1_package_payment) || $data1->option1_package_payment=="N;")
		@else
			<!--<h3 class="tourQuoteItineraryHead">BOOKING & CANCELLATION</h3>-->
				<?php $p_policy=unserialize($data1->option1_package_payment); ?>
			@foreach($p_policy as $v)
			<div class="tourQuoteBooking">
				<h4 class="tourQuoteBookHeading">Booking Policy</h4>
				<div>{!!CustomHelpers::get_payment_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="tourQuoteBookAddPolicy">{{ $data1->option1_payment_policies }}</div>
				<div class="tourQuoteBookPolicySeparator"></div>
		@endif
		<!--Tour Booking Policy ends-->
		<!--Tour Cancellation Policy starts-->
		@if(empty($data1->option1_package_can) || $data1->option1_package_can=="N;")
		@else
			<?php $c_policy=unserialize($data1->option1_package_can); ?>
			@foreach($c_policy as $v)
			<div class="tourQuoteCancellation">
				<h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
				<div>{!!CustomHelpers::get_cancel_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="tourQuoteCancelAddPolicy">{{ $data1->option1_cancellation }}</div>
		@endif
		<!--Tour Cancellation Policy ends-->
		</div>
	</div>
	<!--Tour Booking & Cancellation Policy ends-->

	<!--Tour Important Notes starts-->
	@if(empty($data1->option1_package_impnotes) || $data1->option1_package_impnotes=="N;")
	@else
	<div class="tourQuoteImpCont">
		<h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
		<div class="tourQuoteImpBox">
		<?php $important_notes=unserialize($data1->option1_package_impnotes); ?>
		@foreach($important_notes as $v)
		<div class="tourQuoteImp">
			<div>{!!CustomHelpers::get_impnotes($v)!!}</div>
		</div>
		<!--<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<p class="pfwmt" style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9;font-size: 14px;font-weight: 400">{!!CustomHelpers::get_impnotes($v)!!}</p>
			</div>-->
		@endforeach
			<div class="tourQuoteImpAddPolicy">{{ $data1->option1_extra_imp }}</div>
		</div>
	</div>
	@endif
	<!--Tour Important Notes ends-->
	
	<!--Accept, Reject or Pay  Button starts-->
	<div class="touQuoteBookFooterCont">
		@include("query.quotation_webpage.accept")
	</div>
	<!--Accept, Reject or PayButton ends-->

	<!--Footer Signature Starts-->
	@if($data1!="" && $data1->option1_quotation_footer!="" && $data1->option1_quotation_footer!="N;")
	<div class="tourQuoteFooterCont">
	<?php $footer=unserialize($data1->option1_quotation_footer); ?>
	@foreach($footer as $footer_data)
		{!! CustomHelpers::get_quotation_footer($footer_data) !!}
	@endforeach
	</div>
	@endif
	<!--Footer Signature Ends-->
	</div>
</div>