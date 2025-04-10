	<div class="tourQuoteWebHeadCont">
		<p>Dear {{ $data1->name }},</p>
		@if($data1!="" && $data1->option1_quotation_header!="")
			<?php 
				$header_id=$data1->option1_quotation_header;
				$header_data=DB::table('quotation_header')->where('id',$header_id)->first();
			?>
			@if($header_data!='')
				{!! $header_data->header_desc !!}
			@endif
		@endif
		@if($data1->accept_status=="0" && $data1->send_option=="1")
		@endif
	</div>

	<!-- Title & Services -->
	<div class="tourQuoteSummaryCont">
		<div>
			<h4 class="tourQuoteTitle">{{ $data1->custom_package_name }}</h4>
			<h5 class="tourQuoteDaysBadge">{{ $data1->duration-1 }} Nights / {{ $data1->duration }} Days</h5>
		</div>
		<div class="touQuoteBookCont">
			<div>
				<h5 class="tourQuoteServiceTitle">Included in this package</h5>
				<!--Check service icons-->
				<div id="mobscroll" class="mobscroll overflowX"></div>
				
				<!--Check service icons // Remove this-->
				<div class="flexCenter">
				<?php $package_service=unserialize($data1->package_service); ?>
				@if(empty($package_service))
				@else
					@foreach($package_service as $icon)
					<div class="tourQteSvcIcns">
						<div class="tourQteSvcIcnImg">
							<img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}" alt="img">
						</div>
						<div class="tourQteSvcTtl">{{$icon}}</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>

			<!-- Accept, Reject or Pay Button -->
			<div>
				@include("query.quotation_webpage.accept")

				<?php
					$price_data_first=CustomHelpers::get_price_part_seperate($data1->option1_price,$data1->quote1_number_of_adult,$data1->extra_adult,$data1->child_with_bed,$data1->child_without_bed,$data1->infant,$data1->solo_traveller);
				?>
			</div>
		</div>
	</div>

	<!-- Departure City, Tour Date,Pricing & Quote Validity -->
	<div class="tourQuoteDatePricingCont">
		<div class="makeflex">
			<!--Departure City-->
			<div class="tourQuoteCityBox">
				<h4 class="tourQuoteCityBoxHead">DEPARTURE CITY</h4>
				<h3 class="tourQuoteCityName">{{ $data1->sourcecity }}</h3>
			</div>

			<!--Tour Date-->
			<div class="tourQuoteDateBox">
				<h4 class="tourQuoteDateBoxHead">TOUR DATE</h4>
				<?php
					$originalDate = $data1->tour_date;
					
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

					$datefrom_print = date("d M Y", strtotime($datefrom));
					$day_from = strtotime($datefrom);
					$day_from = date('D', $day_from);
					
					$to_days=$data1->duration-1;
					
					$stop_date = date('Y-m-d', strtotime($stop_date . ' +'.$to_days.' days'));
					$stop_date_print= date("d M Y", strtotime($stop_date));

					$day_to = strtotime($stop_date);
					$day_to = date('D', $day_to);
				?>
				<!-- <h3 class="tourQuoteDepDate"><?php echo "$day_from"; ?>, {{$datefrom_print}}</h3> -->
				<h3 class="tourQuoteDepDate">{{ $datefrom_print }}</h3>
				<p class="tourQuoteDateBoxHead appendTop10">TO</p>
				<!-- <p class="tourQuoteRetDate"><?php echo "$day_to"; ?>, {{ $stop_date_print}}</p> -->
				<p class="tourQuoteRetDate">{{ $stop_date_print}}</p>
			</div>

			<!--Pricing-->
			<div class="tourQuotePriceBox">
			@if($data1->option1_price_type=="Per Person")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>

					<p class="tourQuotePriceValue defaultCurrency"> {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}
					<!-- {{$price_data_first['query_total_adult']+$price_data_first['query_total_exadult']+$price_data_first['query_total_childbed']+$price_data_first['query_total_childwbed']+$price_data_first['query_total_infant']+$price_data_first['query_total_single']}}  -->
				</p>

				<!-- <?php
					$total_people = $data1->quote1_number_of_adult + $data1->extra_adult + $data1->child_with_bed + $data1->child_without_bed + $data1->infant + $data1->solo_traveller;
					$total_people = ($total_people == 0) ? 1 : $total_people;  // Avoid division by zero
				?>
				<p class="tourQuotePriceValue defaultCurrency"> 
				    {{ CustomHelpers::get_indian_currency(round($price_data_first['query_total_group'] / $total_people)) }}
				</p> -->

				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
					<!-- {{$price_data_first['query_discount_minus_adult']+$price_data_first['query_discount_minus_exadult']+$price_data_first['query_discount_minus_childbed']+$price_data_first['query_discount_minus_childwbed']+$price_data_first['query_discount_minus_infant']+$price_data_first['query_discount_minus_single']}}  -->

					{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_discount_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}

				</p>
				</div>
				@if(round($price_data_first['query_total_gst_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)

				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">GST @if($price_data_first['query_gst_curr']==2)&nbsp;({{ $price_data_first['gst_percentage'] }}%) @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
						{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}
						<!-- {{ round($price_data_first['query_gst_adult']+$price_data_first['query_gst_exadult']+$price_data_first['query_gst_childbed']+$price_data_first['query_gst_childwbed']+$price_data_first['query_gst_infant']+$price_data_first['query_gst_single'])
					}} -->
				</p>
				</div>
				@endif
				@if(round($price_data_first['query_total_tcs_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">TCS @if($price_data_first['query_tcs_curr']==2)&nbsp;({{$price_data_first['tcs_percentage']}}%) @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
						{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}
					<!-- {{ round($price_data_first['query_tcs_adult']+$price_data_first['query_tcs_exadult']+$price_data_first['query_tcs_childbed']+$price_data_first['query_tcs_childwbed']+$price_data_first['query_tcs_infant']+$price_data_first['query_tcs_single']) }} -->
				</p>
				</div>
				@endif
				@if(round($price_data_first['query_total_pg_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">PG  
						@if($price_data_first['pg_charges']==2)&nbsp;({{$price_data_first['pgcharges_percentage']}}%) @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
						{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}
					<!-- {{ round($price_data_first['query_pgcharges_adult']+$price_data_first['query_pgcharges_exadult']+$price_data_first['query_pgcharges_childbed']+$price_data_first['query_pgcharges_childwbed']+$price_data_first['query_pgcharges_infant']+$price_data_first['query_pgcharges_single']) }} -->
				</p>
				</div>
				@endif
				<div class="tourQuotePriceSeparator"></div>
				<div class="flexBetween">
					<div>
						<p class="tourQuotePriceTotal">Grand Total</p>
						<p class="tourQuotePriceTagline">( {{ $data1->anything }} )</p>
					</div>
					<div>
						<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>
							{{CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller)))}}
						<!-- {{ round($price_data_first['query_grand_adult']+$price_data_first['query_grand_exadult']+$price_data_first['query_grand_childbed']+$price_data_first['query_grand_childwbed']+$price_data_first['query_grand_infant']+$price_data_first['query_grand_single']) }} -->
					</p>
					</div>
				</div>
			</div>
			@elseif($data1->option1_price_type=="Group Price")
			<div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> {{ CustomHelpers::get_indian_currency($price_data_first['query_total_group']) }}</p>
				</div>
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">Discount (-)</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> {{ CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group']) }}</p>
				</div>
				@if(round($price_data_first['query_total_gst_group'])>0)

				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">GST @if($price_data_first['query_gst_curr']==2)&nbsp;({{ $price_data_first['gst_percentage'] }}%) @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> {{ CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group'])) }}</p>
				</div>
				@endif
				@if(round($price_data_first['query_total_tcs_group'])>0)
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">TCS @if($price_data_first['query_tcs_curr']==2)&nbsp;({{ $price_data_first['tcs_percentage'] }}%) @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>{{ CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group'])) }}</p>
				</div>
				@endif

				@if(round($price_data_first['query_total_pg_group'])>0)

				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceBoxSubHead">PG  
						@if($price_data_first['pg_charges']==2) selected 
                  ({{$price_data_first['pgcharges_percentage']}}%)
                   @endif</p>
					<p class="tourQuotePriceValue"><span class="tourQuoteDefaultCurency">&nbsp;</span> {{CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']))}}</p>
				</div>
				@endif
				<div class="tourQuotePriceSeparator"></div>
				<div class="makeflexCenterBewtween">
					<p class="tourQuotePriceTotal">Grand Total</p>
					<p class="tourQuotePriceTotalValue"><span class="tourQuoteDefaultCurency">&nbsp;</span>{{CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']))}}</p>
				</div>
			</div>
			@endif
			<i><!--traveller(s)--></i>
			</div>
		</div>

		<!-- Quote Validity -->
		@if($data1->validity_show_on_frontend=='No')
		@if($data1->option1_validaty!="")
			<div class="tourQuoteValidity">QUOTE VALIDITY - {{ date("d M Y", strtotime(str_replace('/','-',$data1->option1_validaty))) }}
				@if($data1->validaty_time!='23:59:59')
				{{$data1->validaty_time}}
				@endif
			</div>
		@endif
		@else
			<div class="tourQuoteValidity">
				Pay Immediately
			</div>
		@endif
		<!--Quote Validity ends-->
	</div>

	<!-- Transport -->
	<?php $flight_detail=unserialize($data1->option1_flight); ?>
	@if(array_key_exists('flightOption',$flight_detail) && $flight_detail['flightOption']==1) 
		<div class="tourQuoteFlightCont">
			<?php $flight_detail=unserialize($data1->option1_flight); ?>
			<div>
				<h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
			</div>
			<div class="">
				<!--Upward Flight Starts-->
				<div class="tourQuoteOnwardFlightBox">

					<!--Upward Flight Origin - Destination-->
					<div class="flexCenter apndBtm10">
						<div class="appendRight20">
						@if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0) 
							<span class="flightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'],'previous_data') }}</span>
						@endif
							<span class="flightCityName">-</span> 
						@if($flight_detail['dest']!="")
							<span class="flightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'],'previous_data') }}</span>
						@endif
						</div>
						<div>
						@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
							<!-- <?php
								$originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
								$newDate_flight = date("d M Y", strtotime($originalDate_flight));
							?>
							<span class="flightDate">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span> -->
							<span class="flightDate">{{ date('d M Y', strtotime($originalDate_flight)) }}</span>
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
							<span class="flightStop">
								@if($flight_detail['numberstop']!="")
									{{$flight_detail['numberstop']}} 
								@endif
							</span>
							<div class="classSeparator"></div>
							<span class="flightClass">
								@if(array_key_exists('cabin',$flight_detail))
									{{ CustomHelpers::get_flight_class_name($flight_detail['cabin']) }}
								@endif
							</span>
						</div>
						<div class="flexCenter appendLeft20">
							<div class="appendRight10">
								<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
								<div class="airlineLogoBox">
									<img src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}"
										onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
								</div>
							</div>
							<div class="appendRight20 W120">
								<p class="flightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
								<p class="flightNumber">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
							</div>
							<div class="W100">
								<p class="flightTiming">
									<!-- @if($flight_detail['dhours']!="")
										{{$flight_detail['dhours']}} 
									@endif
									{{ ':' }}
									@if($flight_detail['ddmins']!="")
										@if($flight_detail['ddmins']=='0')00
										@else
											{{$flight_detail['ddmins']}} 
										@endif 
									@endif -->
									@if(!empty($flight_detail['dhours']))
										{{ str_pad($flight_detail['dhours'], 2, '0', STR_PAD_LEFT) }}
									@endif
									{{ ':' }}
									@if(isset($flight_detail['ddmins']))
										@if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0)
											00
										@else
											{{ str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) }}
										@endif
									@endif
								</p>
								
								<p class="flightCity">
									<!-- @if($flight_detail['origin']!="")
										{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'],'last_str') }} 
									@endif -->

									{{ !empty($flight_detail['origin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : '' }}
								</p>

							</div>
							<div class="flightDurationCont">
								<!-- <p class="flightDuration">@if(array_key_exists('duration_hours',$flight_detail)) {{$flight_detail['duration_hours']}}h @endif
								@if(array_key_exists('duration_dmins',$flight_detail)) {{$flight_detail['duration_dmins']}}m @endif</p> -->
								<p class="flightDuration">
							    {{ array_key_exists('duration_hours', $flight_detail) ? $flight_detail['duration_hours'] . 'h ' : '' }}
							    {{ array_key_exists('duration_dmins', $flight_detail) ? $flight_detail['duration_dmins'] . 'm' : '' }}
							</p>

								<div class="flexCenter">
									<i class="fa-plane" aria-hidden="true"></i>
									<div class="flightPathWay"></div>
									<i class="fa-map-marker" aria-hidden="true"></i>
								</div>
							</div>
							<div class="W100">
								<p class="flightTiming">
									<!-- @if($flight_detail['ahours']!="")
										{{$flight_detail['ahours']}} 
									@endif:
									@if($flight_detail['damins']!="")
										@if($flight_detail['damins']==0)
											00 
										@else
											{{$flight_detail['damins']}} 
										@endif 
									@endif -->
									@if(!empty($flight_detail['ahours']))
										{{ str_pad($flight_detail['ahours'], 2, '0', STR_PAD_LEFT) }}
									@endif
									{{ ':' }}
									@if(isset($flight_detail['damins']))
										@if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0)
											00
										@else
											{{ str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) }}
										@endif
									@endif
								</p>
								<p class="flightCity">
									<!-- @if($flight_detail['dest']!="")
										{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'],'last_str') }} 
									@endif -->
									{{ !empty($flight_detail['dest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : '' }}
								</p>
							</div>
						</div>
						<p class="baggageTitle">Baggage info</p>
						<div class="flexCenter">
							<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
							<!-- <span class="baggageSubTitle">
								@if(array_key_exists('baggage',$flight_detail))
									{{$flight_detail['baggage']}} 
								@endif
							</span> -->
							<span class="baggageSubTitle">
								{{ $flight_detail['baggage'] ?? '' }}
							</span>

							<div class="baggageSeparator"></div>
							<span class="baggageSubTitle color4A">Check in:&ensp;</span>
							<span class="baggageSubTitle">
								{{ $flight_detail['cbaggage'] ?? '' }}
							</span>
						</div>
					</div>
				</div>
				<!--Upward Flight Ends-->

				<!--Return Flight Starts-->
				<div class="tourQuoteReturnFlightBox">
					<!--Return Flight Origin - Destination-->
					<div class="flexCenter apndBtm10">
						<div class="appendRight20">
							@if($flight_detail['dOrigin']!="")
								<span class="flightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'previous_data') }}</span>
							@endif
								<span class="flightCityName">-</span> 
							@if($flight_detail['ddest']!="")
								<span class="flightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'previous_data') }}</span>
							@endif
						</div>
						<div>
							@if(array_key_exists('downwarddate',$flight_detail)) 
								@if($flight_detail['downwarddate']!="")
								<!-- <?php
									$originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
									$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
								?>
								<span class="flightDate">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span> -->
								<span class="flightDate">{{ date('d M Y', strtotime($originalDate_flight_down)) }}</span>
								@endif
							@endif
						</div>
					</div>

					<!--Return Flight Details-->
					<div class="returnFlightBox">
						<div class="flexCenter appendBottom15">
							<!-- @if(array_key_exists('downwarddate',$flight_detail)) 
								@if($flight_detail['downwarddate']!="")
								<?php
									$originalDate_flight_down = $flight_detail['downwarddate'];
									$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
								?>
								<span class="fontWeight600 font18 color4A">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span>
								@endif 
							@endif -->
							<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
							<span class="flightStop">
								@if($flight_detail['numberstop']!="")
									{{$flight_detail['numberstop']}} 
								@endif
							</span>
							<div class="classSeparator"></div>
							<span class="flightClass">
								@if(array_key_exists('dcabin',$flight_detail))
									{{CustomHelpers::get_flight_class_name($flight_detail['dcabin'])}} Class 
								@endif
							</span>
						  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
						</div>
						<div class="flexCenter appendLeft20">
							<div class="appendRight10">
								<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
								<div class="airlineLogoBox">
									<img src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}"
										onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
								</div>
							</div>
							<div class="appendRight20 W120">
								<p class="flightName">
									@if($flight_detail['name']!="")
										{{$flight_detail['name']}} 
									@endif
								</p>
								<p class="flightNumber">
									@if(array_key_exists("dno", $flight_detail)
									&& $flight_detail['dno']!="")
										{{ $flight_detail['dno'] }} 
									@endif
								</p>
							</div>
							<div class="W100">
								<p class="flightTiming">
									<!-- @if($flight_detail['ddhours']!="")
										{{$flight_detail['ddhours']}} @endif:@if($flight_detail['ddmins']!="") @if($flight_detail['ddmins']=='0') 00 
										@else
											{{$flight_detail['ddmins']}} 
										@endif 
									@endif -->

									@if(!empty($flight_detail['ddhours']))
										{{ str_pad($flight_detail['ddhours'], 2, '0', STR_PAD_LEFT) }}
									@endif
									{{ ':' }}
									@if(isset($flight_detail['ddmins']))
										@if($flight_detail['ddmins'] === '0' || $flight_detail['ddmins'] === 0)
											00
										@else
											{{ str_pad($flight_detail['ddmins'], 2, '0', STR_PAD_LEFT) }}
										@endif
									@endif
								</p>

								<p class="flightCity">
									<!-- @if(array_key_exists("dOrigin", $flight_detail)
									&& $flight_detail['dOrigin']!="")
										{{ CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'last_str') }} 
									@endif -->
								
									{{ !empty($flight_detail['dOrigin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : '' }}
								</p>

							</div>
							<div class="flightDurationCont">
								<!-- <p class="flightDuration">
									@if(array_key_exists('return_duration_hours',$flight_detail))
										{{$flight_detail['return_duration_hours']}}h 
									@endif
									@if(array_key_exists('return_duration_mins',$flight_detail))
										{{$flight_detail['return_duration_mins']}}m 
									@endif
								</p> -->
								<p class="flightDuration">
									{{ array_key_exists('return_duration_hours', $flight_detail) ? $flight_detail['return_duration_hours'] . 'h ' : '' }}
									{{ array_key_exists('return_duration_mins', $flight_detail) ? $flight_detail['return_duration_mins'] . 'm' : '' }}
								</p>

								<div class="flexCenter">
									<i class="fa-plane" aria-hidden="true"></i>
									<div class="flightPathWay"></div>
									<i class="fa-map-marker" aria-hidden="true"></i>
								</div>
							</div>
							<div class="W100">
								<p class="flightTiming">
									<!-- @if($flight_detail['dahours']!="")
										{{$flight_detail['dahours']}} @endif:
										@if($flight_detail['damins']!="") 
											@if($flight_detail['damins']=='0') 00 
										@else {{$flight_detail['damins']}}
										@endif
									@endif -->
								
									@if(!empty($flight_detail['dahours']))
										{{ str_pad($flight_detail['dahours'], 2, '0', STR_PAD_LEFT) }}
									@endif
									{{ ':' }}
									@if(isset($flight_detail['damins']))
										@if($flight_detail['damins'] === '0' || $flight_detail['damins'] === 0)
											00
										@else
											{{ str_pad($flight_detail['damins'], 2, '0', STR_PAD_LEFT) }}
										@endif
									@endif
								</p>

								<p class="flightCity">
									<!-- @if(array_key_exists("ddest", $flight_detail)
									&& $flight_detail['ddest']!="")
										{{ CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'last_str') }} 
									@endif -->

									{{ !empty($flight_detail['ddest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : '' }}
								</p>

							</div>
						</div>
						<p class="baggageTitle">Baggage info</p>
						<div class="flexCenter">
							<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
							<span class="baggageSubTitle">
								{{ $flight_detail['baggage'] ?? '' }}
							</span>
							<div class="baggageSeparator"></div>
							<span class="baggageSubTitle color4A">Check in:&ensp;</span>
							<span class="baggageSubTitle">
								{{ $flight_detail['cbaggage'] ?? '' }}
							</span>
						</div>
					</div>
				</div>
				<!--Return Flight Ends-->
			</div>
		</div>
	@endif

	<!-- Transfers -->
	@if($data1->transfers!=''
		&& unserialize($data1->transfers)!='N;' 
		&& is_array(unserialize($data1->transfers)) 
		&& unserialize($data1->transfers)[0]['mode_title']!='')	
		<div class="tourQuoteTransferCont">
			<div>
				<h3 class="tourQuoteTransferHead">TRANSFERS</h3>
			</div>
			<?php 
				$transfers=unserialize($data1->transfers); 
			?>
			<?php $a=0; ?>
			@foreach($transfers as $row=>$col)
				@if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col))
				<?php
				 $transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();
				?>	
				<div class="tourQuoteTransferBox">
					<div class="tourQuoteTransferTitle">{{$col['mode_title']}}</div>
					<div class="tourQuoteTransferDescBox">
						<div class="makeflex">
							<!--Vehicle Image-->
							<div class="transferImageBox">
								<!-- @if($transfers_data!='' && $transfers_data->transfer_image!='')
								<img src="{{ url('/public/uploads/transfer_image/'.$transfers_data->transfer_image) }}" alt="img">	
								@endif -->

								@if($transfers_data != '')
									@if($transfers_data->transfer_image != '' && file_exists(public_path('uploads/transfer_image/' . $transfers_data->transfer_image)))
										<img class="mtransferImageType" src="{{ url('/public/uploads/transfer_image/' . $transfers_data->transfer_image) }}" loading="lazy">
									@elseif($transfers_data->transfer_image != '')
										<p>Img loading.....</p>
									@else
										<p>Image not available</p>
									@endif
								@else
						    	<p>Image not available</p>
						    @endif
							</div>
							<div>
								<!--Private, Shared or Coach-->
								<div class="transferDescTopSection">
									<h4 class="transferTitle">{{$col['mode_title']}}</h4>
									<h2 class="transportType">
										@if($transfers_data!='' 
											&& $transfers_data->transfer_type!='') 
											{{$transfers_data->transfer_type}} 
										@endif
									</h2>
								</div>
								<!--Vehicle Type,Duration & Inclusion-->
								<div class="flexCenter">
									<div class="transferVehicleCont">
										<h4 class="transferHead">VEHICLE TYPE</h4>
										<h5 class="transferSubHead">
											@if($transfers_data!='' 
												&& $transfers_data->vehicle_type!='') 
												{{$transfers_data->vehicle_type}} 
											@endif
										</h5>
									</div>
									<div class="transferDurationCont">
										<h4 class="transferHead">DURATION</h4>
										<h5 class="transferSubHead">@if($transfers_data!='' 
											&& $transfers_data->duration!='') 
											{{$transfers_data->duration}} 
										@endif
									</h5>
									</div>
									<div>
										<h4 class="transferHead">INCLUDES</h4>
										<h5 class="transferSubHead">
											@if($transfers_data!='' 
											&& $transfers_data->includes!='') 
											{{$transfers_data->includes}} 
										@endif
									</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $a++; ?>
				@endif
			@endforeach
		</div>
	@endif

	<!-- Accommodation -->
	<div class="tourQuoteHotelCont">
		<h3 class="tourQuoteHotelHead">ACCOMMODATION</h3>
		<?php
			$acco=unserialize($data1->option1_accommodation);
			$i="1";
			// dd($acco);
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
						<div class="hotelImageBox">
							@if(array_key_exists("hotel",$acco_data))
							@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
								<img src="{{ url('/public/uploads/package_hotel/'.CustomHelpers::getpackagerecord($acco_data['hotel'],'package_hotel','hotel_image')) }}" alt="img">
							@elseif($acco_data["hotel"]=="other")
								<img src="{{ url('/public/uploads/no-image.png') }}" alt="img">
							@endif
							@else
								<img src="{{ url('/public/uploads/no-image.png') }}" alt="img">
							@endif
						</div>
						<div class="hotelDescBox">
							<div class="hotelTopSection">
								<div class="hotelType">Hotel</div>

								<!--Hotel Name-->
								<div class="flexCenter">
									<div class="tourHotelDtls">
									<div>
										<h5 class="hotelName">
										@if(array_key_exists("hotel",$acco_data) && $acco_data["hotel"]!="" && $acco_data["hotel"]!="other") 	{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
										{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
										@elseif(array_key_exists("other_hotel",$acco_data) && $acco_data["other_hotel"]!="")
										{{$acco_data["other_hotel"]}}
										@endif
										</h5>
									</div>
									<div class="hotelStarRating">
										@if(array_key_exists("star",$acco_data) && $acco_data["star"]!="" && $acco_data["star"]!="other") {{CustomHelpers::get_star_rating($acco_data["star"])}}
										@elseif(array_key_exists("star_other",$acco_data) && $acco_data["star_other"]!="") 	{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
										@endif
									</div>
									</div>
								</div>

								<!--Destination City Name-->
								<div class="hotelCityName">{{ $acco_data["city"] }}</div>
							</div>

							<!--No of Nights & Check-in & Checkout-->
							<div class="HotelFooter">
								<?php
											$day1 = "0";
											$day = "0";
										?>
										@if($acco_data!="" && array_key_exists("night",$acco_data))
											<?php
												$day1 = (int)filter_var($acco_data["night"]["0"], FILTER_SANITIZE_NUMBER_INT);
												$day1 = $day1-1;
											?>
										@endif
										<?php
											$datefrom_checkin = "$datefrom_year-$datefrom_day-$datefrom_month";
											$checkin_date = date('Y-m-d', strtotime($datefrom_checkin . '+' . $day1 . ' days'));
											$checkin_date_print= date("d M Y", strtotime($checkin_date));
											$day_checkin = strtotime($checkin_date);
											$day_checkin = date('D', $day_checkin);
										?>
										@if($acco_data!="" && array_key_exists("night",$acco_data))
											@foreach($acco_data["night"] as $accday)
												<?php $day = (int)filter_var($accday, FILTER_SANITIZE_NUMBER_INT); ?>
											@endforeach
										@endif
										<?php
											$datefrom_checkout = "$datefrom_year-$datefrom_day-$datefrom_month";
											$checkout_date = date('Y-m-d', strtotime($datefrom_checkout . ' +'.$day.' days'));
											$checkout_date_print = date("d M Y", strtotime($checkout_date));
											$day_checkout = strtotime($checkout_date);
											$day_checkout = date('D', $day_checkout);
										?>
								<div class="makeflex appendBottom20">
									<!-- No of Nights -->
									<div class="hotelDaysBadge">
										<h5 class="hoteDaysBadge_heading">NO OF NIGHTS</h5>										
										<h5 class="hotelDaysBadge_nightCount">
											<?php
												$date1=date_create($checkin_date);
												$date2=date_create($checkout_date);
												$diff=date_diff($date1,$date2);
											?>
											@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} 
											@else {{$diff->format("%a Night") }} 
											@endif
										</h5>
									</div>

									<!--Check-in & Checkout-->
									<div class="hotelCheckInOut">
										<div class="hotelCheckInCont">
											<p class="hotelCheckInCont_heading">CHECK-IN </p>
											<!-- <p class="hotelCheckInCont_date"><?php echo $day_checkin; ?>, {{ $checkin_date_print }}</p> -->
											<p class="hotelCheckInCont_date">{{ $checkin_date_print }}</p>
										</div>
										<div class="hotelCheckOutCont">
											<p class="hotelCheckOutCont_heading">CHECKOUT </p>
											<!-- <p class="hotelCheckOutCont_date"><?php echo $day_checkin; ?>, {{ $checkout_date_print }}</p> -->
											<p class="hotelCheckOutCont_date">{{ $checkout_date_print }}</p>
											</div>
									</div>
								</div>

								<div class="flexCenter">
									<!-- Room Type -->
									<div class="hotelRoomCont">
										<p class="hotelRoomCont_heading">ROOM TYPE</p>
										@if($acco_data["category"]!="")
										<p class="hotelRoomCont_type">{{ $acco_data["category"] }}</p>
										@endif
									</div>
									<!-- Hotel Website -->
									@if($acco_data["hotel_link"]!="")
										<div class="hotelWebCont">
											<p class="hotelWebCont_heading">HOTEL WEBSITE</p>
											<p class="hotelWebCont_name">{{ $acco_data["hotel_link"] }}</p>
										</div>
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

	<!-- Itinerary -->
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

	<!-- Inclusions -->
	@if((($data1->quote_inc!='' && $data1->quote_inc!="N;") || $data1->option1_inclusions!='') || (($data1->quote_exc!='' && $data1->quote_exc!="N;") || $data1->option1_exclusions!=''))
		<div class="tourQuoteItineraryCont">
			<div>
				<h3 class="tourQuoteItineraryHead">INCLUSIONS & EXCLUSIONS</h3>
			</div>
			<div class="tourQuoteIncBox">
				<!--Inclusions-->
				@if(($data1->quote_inc!='' && $data1->quote_inc!="N;") || $data1->option1_inclusions!='')

				<div class="tourQuoteInclusions">
					<h4 class="tourQuoteInclusionHeading">Inclusions</h4>
					<div class="paddingTop10">
					<?php $option1_quote_inc=unserialize($data1->quote_inc); ?>
					@if($option1_quote_inc!='')
					@foreach($option1_quote_inc as $v)
					<div class="tourQuoteUnlistedItem">
						<ul>
							<li>{{CustomHelpers::get_inclusions($v)}}</li>
						</ul>
					</div>	
					@endforeach
					@endif
					@if($data1->option1_inclusions!='')
					<div>
						{!!$data1->option1_inclusions!!}
					</div>
					@endif
					</div>
				</div>
				@endif
				<!--Exclusions-->
				@if(($data1->quote_exc!='' && $data1->quote_exc!="N;") || $data1->option1_exclusions!='')

				<div class="tourQuoteExclusions">
					<h4 class="tourQuoteExclusionHeading">Exclusions</h4>
					<div class="paddingTop10">
					<?php $option1_quote_exc=unserialize($data1->quote_exc); ?>
					@if($option1_quote_exc!='')
					@foreach($option1_quote_exc as $v)
					<div class="tourQuoteUnlistedItem">
						<ul>
							<li>{{CustomHelpers::get_exc($v)}}</li>
						</ul>
					</div>
					@endforeach
					@endif
					@if($data1->option1_exclusions!='')
					<div>
						{!!$data1->option1_exclusions!!}
					</div>
					@endif
					</div>
				</div>
			@endif
			</div>
		</div>
	@endif

  <!-- Overview -->
  @if($data1->option1_description!='' || $data1->option1_highlights!='')
	  <div class="tourQuoteItineraryCont">
			<div>
				<h3 class="tourQuoteItineraryHead"> Tour Overview</h3>
			</div>
			<div class="tourQuoteOverviewBox">
				<!--Add-on Services-->
				@if($data1->option1_description!='')
				<div class="tourQuoteInclusions">
					<h4 class="tourQuoteInclusionHeading">Add-On Services</h4>
					<div class="paddingTop10">
						{!!$data1->option1_description!!}
					</div>
				</div>
				@endif
				<!--Tour Highlights-->
				@if($data1->option1_highlights!='')
				<div class="tourQuoteExclusions">
					<h4 class="tourQuoteExclusionHeading">Tour Highlights</h4>
					<div class="paddingTop10">
						{!!$data1->option1_highlights!!}
					</div>
				</div>
				@endif
			</div>
		</div>
	@endif
	
	<!-- Visa Policy -->
	@if($data1->option1_visa=="1")
	@if(empty($data1->option1_package_visa) || $data1->option1_package_visa=="N;")
	@else
	<div class="tourQuoteVisaPolicyCont">
		<div>
			<h3 class="tourQuoteVisaPolicyHead">VISA POLICY</h3>
		</div>
		<div class="tourQuoteVisaPolicyBox">
			<?php $v_policy=unserialize($data1->option1_package_visa); ?>
			@foreach($v_policy as $v)
			<div class="tourQuoteVisa">
				<!--<h4 class="tourQuoteVisaHeading">Visas</h4>-->
				<div>{!!CustomHelpers::get_visa_policy($v)!!}</div>
			</div>
			<div class="tourQuoteVisaPolicySeparator"></div>
			@endforeach

			<!-- additional visa policy content -->
			@if (!empty(trim($data1->option1_visa_policies)))
				<div class="tourQuoteVisaAddPolicy">{{ $data1->option1_visa_policies }}</div>
			@endif
		</div>
	</div>
	@endif
	@endif

	<!-- Booking & Cancellation Policy -->
	@if(($data1->option1_package_payment!='' && $data1->option1_package_payment!="N;") || ($data1->option1_package_can!='' && $data1->option1_package_can!="N;"))
		<div class="tourQuoteBookPolicyCont">
			<div>
				<h3 class="tourQuoteBookPolicyHead">BOOKING AND CANCELLATION POLICY</h3>
			</div>
			<div class="tourQuoteBookPolicyBox">
				<!--Tour Booking Policy starts-->
				@if($data1->option1_package_payment!='' && $data1->option1_package_payment!="N;")
			
					<!--<h3 class="tourQuoteItineraryHead">BOOKING & CANCELLATION</h3>-->
					<?php $p_policy=unserialize($data1->option1_package_payment); ?>
					@foreach($p_policy as $v)
					<div class="tourQuoteBooking">
						<h4 class="tourQuoteBookHeading">Booking Policy</h4>
						<div>{!!CustomHelpers::get_payment_policy($v)!!}</div>
					</div>
					@endforeach

					<!-- additional booking policy content -->
					@if (!empty(trim($data1->option1_payment_policies)))
						<div class="tourQuoteBookAddPolicy">{{ $data1->option1_payment_policies }}</div>
					@endif
					<div class="tourQuoteBookPolicySeparator"></div>
				@endif
				<!--Tour Booking Policy ends-->
				<!--Tour Cancellation Policy starts-->
				@if($data1->option1_package_can!='' && $data1->option1_package_can!="N;")
		
					<?php $c_policy=unserialize($data1->option1_package_can); ?>
					@foreach($c_policy as $v)
					<div class="tourQuoteCancellation">
						<h4 class="tourQuoteCancelHeading">Cancellation Policy</h4>
						<div>{!!CustomHelpers::get_cancel_policy($v)!!}</div>
					</div>
					@endforeach

					<!-- additional booking policy content -->
					@if (!empty(trim($data1->option1_cancellation)))
						<div class="tourQuoteCancelAddPolicy">{{ $data1->option1_cancellation }}</div>
					@endif
				@endif
				<!--Tour Cancellation Policy ends-->
			</div>
		</div>
	@endif

	<!-- Important Notes -->
	@if(empty($data1->option1_package_impnotes) || $data1->option1_package_impnotes=="N;")
	@else
		<div class="tourQuoteImpCont">
			<div>
				<h3 class="tourQuoteImpHead">IMPORTANT NOTES</h3>
			</div>
			<div class="tourQuoteImpBox">
				<?php $important_notes=unserialize($data1->option1_package_impnotes); ?>
				@foreach($important_notes as $v)
				<div class="tourQuoteImp">
					<div>{!!CustomHelpers::get_impnotes($v)!!}</div>
				</div>
				@endforeach

				<!-- additional imp notes content -->
					@if (!empty(trim($data1->option1_extra_imp)))
						<div class="tourQuoteImpAddPolicy">{{ $data1->option1_extra_imp }}</div>
					@endif
			</div>
		</div>
	@endif

	<!-- Raise concern or Pay Button -->
	<div class="touQuoteBookFooterCont">
		@include("query.quotation_webpage.accept")
	</div>

	<!-- Footer -->
	@if($data1!="" && $data1->option1_quotation_footer!="")
	<?php 
		$footer_id=$data1->option1_quotation_footer;
		$footer_data=DB::table('quotation_footer')->where('id',$footer_id)->first();
	?>
	<div class="tourQuoteFooterCont">
		@if($footer_data!='')
			{!! $footer_data->footer_desc !!}
		@endif
	</div>
	@endif