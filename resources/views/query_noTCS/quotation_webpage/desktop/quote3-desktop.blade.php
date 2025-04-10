<div class="row">
	<div class="col-md-12" style="overflow-x:auto;">
	<div class="tourQuoteWebHeadCont">
	@if($data3!="" && $data3->option3_quotation_header!="" && $data3->option3_quotation_header!="N;")
	<?php $header=unserialize($data3->option3_quotation_header); ?>
	@foreach($header as $header_data)
		{!! CustomHelpers::get_quotation_header($header_data) !!}
	@endforeach
	@endif
	@if($data1->accept_status=="0" && $data1->send_option=="1")
		@include("query.quotation_webpage.accept")
	@endif
	</div>
	<!--Package Name & Services Included-->
	<div class="tourQuoteSummaryCont">
		<div>
			<h4 class="tourQuoteTitle">{{ $data3->custom_package_name }}</h4>
			<h5 class="tourQuoteDaysBadge">{{ $data3->duration-1 }} Nights / {{ $data3->duration }} Days</h5>
		</div>
		<div class="touQuoteBookCont">
		<div>
		<h5 class="tourQuoteServiceTitle">Included in this package</h5>
		<!--Check service icons-->
		<div id="mobscroll" class="mobscroll overflowX">
			<?php $package_service=unserialize($data3->package_service); ?>
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
				<h3 class="tourQuoteCityName">{{ $data3->source }}</h3>
			</div>
			<!--Tour Date-->
			<div class="tourQuoteDateBox">
				<h4 class="tourQuoteDateBoxHead">TOUR DATE</h4>
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
				<h3 class="tourQuoteDepDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</h3>
				<p class="tourQuoteDateBoxHead appendTop10">TO</p>
				<p class="tourQuoteRetDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p>
			</div>
			<!--Pricing-->
			<div class="tourQuotePriceBox">
			@if($data3->option3_price_type=="Per Person")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Tour Price</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_total($data3->option3_price,'adult')); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_discount($data3->option3_price,'adult')); ?></p>
				</div>
				<!--<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">GST (5%)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>565</p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">TCS (5%)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>594</p>
				</div>-->
				<div class="tourQuotePriceSeparator"></div>
				<div class="flexBetween">
					<div>
					<p class="tourQuotePriceTotal">Grand Total</p>
					<p class="tourQuotePriceTagline">( {{ $data3->anything }} )</p>
					</div>
					<div>
					<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency(CustomHelpers::get_quotation_grandtotal($data3->option3_price,'adult')); ?></p>
					</div>
				</div>
			</div>
			@elseif($data3->option3_price_type=="Group Price")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Tour Price</p>
					<?php
					$option3_adult=CustomHelpers::get_quotation_pricel($data3->option3_price,'adult');
					$option3_extradult=CustomHelpers::get_quotation_pricel($data3->option3_price,'exadult');
					$option3_child=CustomHelpers::get_quotation_pricel($data3->option3_price,'childbed');
					$option3_childwithoutbed=CustomHelpers::get_quotation_pricel($data3->option3_price,'childwbed');
					$option3_infant=CustomHelpers::get_quotation_pricel($data3->option3_price,'infant');
					$option3_single=CustomHelpers::get_quotation_pricel($data3->option3_price,'single');
					$option3_total=($option3_adult*2) + $option3_extradult + $option3_child + $option3_childwithoutbed + $option3_infant + $option3_single;
					?>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option3_total); ?></p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<?php
					$option3_adult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'adult');
					$option3_extradult_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'exadult');
					$option3_child_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childbed');
					$option3_childwithoutbed_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'childwbed');
					$option3_infant_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'infant');
					$option3_single_discount=CustomHelpers::get_quotation_discount($data3->option3_price,'single');
					$option3_total_discount=($option3_adult_discount*2) + $option3_extradult_discount + $option3_child_discount + $option3_childwithoutbed_discount + $option3_infant_discount + $option3_single_discount;
					?>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option3_total_discount); ?></p>
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
					<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span><?php CustomHelpers::get_indian_currency($option3_total-$option3_total_discount); ?></p>
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
			<div class="tourQuoteValidity">QUOTE VALIDITY - {{ date("d M Y", strtotime($data3->option3_validaty)) }}</div>
		@endif
		<!--Quote Validity ends-->
	</div>
	<!--Departure City, Tour Date & Pricing ends-->
	
	<!--Flight & Other Transport Details Starts-->
	@if($data3->option3_transport=="Flight")
	<div class="tourQuoteFlightCont">
		<?php $flight_detail=unserialize($data3->option3_flight); ?>
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
						<!--<span class="fontWeight600 font18 color4A">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>-->
						@endif
						@endif
						<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
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
						<!--<span class="fontWeight600 font18 color4A">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>-->
						@endif 
						@endif
						<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
						<span class="flightStop">@if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif</span>
						<div class="classSeparator"></div>
						<span class="flightClass">Economy</span>
					  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
					</div>
					<div class="flexCenter appendLeft20">
						<div class="appendRight10">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
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
	@elseif($data3->option3_transport!="0")
	<div class="tourQuoteFlightCont">
		<h3 class="tourQuoteFlightHead">{{ $data3->option3_transport }}</h3>
		<div class="tourQuoteTransportBox">
			<p class="transportDesc">{{ $data3->option3_transport_description }}</p>
		</div>
	</div>
	@endif
	<!--Flight & Other Transport Details Ends-->
	
	<!--Hotel Details Starts-->
	<div class="tourQuoteHotelCont">
		<h3 class="tourQuoteHotelHead">ACCOMMODATION</h3>
		<?php
			$acco=unserialize($data3->option3_accommodation);
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
										<p class="hotelCheckOutCont_date"><?php echo $day_checkin; ?>, {{ $checkout_date_print }}</p>
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
		$itinerary_data=unserialize($data3->option3_dayItinerary);
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
				<div>{!!$data3->option3_inclusions!!}</div>
			</div>
			<!--Exclusions-->
			<div class="tourQuoteExclusions">
				<h4 class="tourQuoteExclusionHeading">Exclusions</h4>
				<div>{!!$data3->option3_exclusions!!}</div>
			</div>
		</div>
	</div>
	<!--Tour Inclusions & Exclusions Ends-->
	
	<!--Tour Visa Policy starts-->
	@if($data3->option3_visa=="1")
	@if(empty($data3->option3_package_visa) || $data3->option3_package_visa=="N;")
	@else
	<div class="tourQuoteVisaPolicyCont">
		<h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
		<div class="tourQuoteVisaPolicyBox">
		<?php $v_policy=unserialize($data3->option3_package_visa); ?>
			@foreach($v_policy as $v)
			<div class="tourQuoteVisa">
				<h4 class="tourQuoteVisaHeading">Visas</h4>
				<div>{!!CustomHelpers::get_visa_policy($v)!!}</div>
			</div>
			<div class="tourQuoteVisaPolicySeparator"></div>
			@endforeach
			<div class="tourQuoteVisaAddPolicy">{{ $data3->option3_visa_policies }}</div>
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
		@if(empty($data3->option3_package_payment) || $data3->option3_package_payment=="N;")
		@else
			<!--<h3 class="tourQuoteItineraryHead">BOOKING & CANCELLATION</h3>-->
				<?php $p_policy=unserialize($data3->option3_package_payment); ?>
			@foreach($p_policy as $v)
			<div class="tourQuoteBooking">
				<h4 class="tourQuoteBookHeading">Booking Policy</h4>
				<div>{!!CustomHelpers::get_payment_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="tourQuoteBookAddPolicy">{{ $data3->option3_payment_policies }}</div>
				<div class="tourQuoteBookPolicySeparator"></div>
		@endif
		<!--Tour Booking Policy ends-->
		<!--Tour Cancellation Policy starts-->
		@if(empty($data3->option3_package_can) || $data3->option3_package_can=="N;")
		@else
			<?php $c_policy=unserialize($data3->option3_package_can); ?>
			@foreach($c_policy as $v)
			<div class="tourQuoteCancellation">
				<h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
				<div>{!!CustomHelpers::get_cancel_policy($v)!!}</div>
			</div>
			@endforeach
				<div class="tourQuoteCancelAddPolicy">{{ $data3->option3_cancellation }}</div>
		@endif
		<!--Tour Cancellation Policy ends-->
		</div>
	</div>
	<!--Tour Booking & Cancellation Policy ends-->

	<!--Tour Important Notes starts-->
	@if(empty($data3->option3_package_impnotes) || $data3->option3_package_impnotes=="N;")
	@else
	<div class="tourQuoteImpCont">
		<h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
		<div class="tourQuoteImpBox">
		<?php $important_notes=unserialize($data3->option3_package_impnotes); ?>
		@foreach($important_notes as $v)
		<div class="tourQuoteImp">
			<div>{!!CustomHelpers::get_impnotes($v)!!}</div>
		</div>
		<!--<div class="custom_padding" style="margin: 20px 20px 0px 20px;background: #ffffff">
				<p class="pfwmt" style="padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #e9e9e9;font-size: 14px;font-weight: 400">{!!CustomHelpers::get_impnotes($v)!!}</p>
			</div>-->
		@endforeach
			<div class="tourQuoteImpAddPolicy">{{ $data3->option3_extra_imp }}</div>
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
	@if($data3!="" && $data3->option3_quotation_footer!="" && $data3->option3_quotation_footer!="N;")
	<div class="tourQuoteFooterCont">
	<?php $footer=unserialize($data3->option3_quotation_footer); ?>
	@foreach($footer as $footer_data)
		{!! CustomHelpers::get_quotation_footer($footer_data) !!}
	@endforeach
	</div>
	@endif
	<!--Footer Signature Ends-->
	</div>
</div>