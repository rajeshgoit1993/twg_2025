		<div class="mtourQuoteWebHeadCont">
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
		<?php
			$price_data_first=CustomHelpers::get_price_part_seperate($data1->option1_price,$data1->quote1_number_of_adult,$data1->extra_adult,$data1->child_with_bed,$data1->child_without_bed,$data1->infant,$data1->solo_traveller);
		?>
		<div class="mtourQuoteSummaryCont">
			<h4 class="mtourQuoteTitle">{{ $data1->custom_package_name }}</h4>
			<h5 class="mtourQuoteDaysBadge">{{ $data1->duration-1 }} Nights / {{ $data1->duration }} Days</h5>
			<div class="mtouQuoteBookCont">
				<div>
					<h5 class="mtourQuoteServiceTitle">Included in this package</h5>
				</div>
				<!-- service icons -->
				<div class="flexCenter gap20 mobscroll overflowX">
					<?php $package_service = unserialize($data1->package_service); ?>
					@if(empty($package_service))
						@else
						@foreach($package_service as $icon)
							<div class="m-svc-icon-cont">
								<div class="m-svc-icon-box">
									<img src="{{ url('/public/uploads/icons/'.CustomHelpers::getimagename($icon,'rt_icons','icon')) }}">
								</div>
								<div class="font12 blacktext">{{$icon}}</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>

		<!-- Departure City, Tour Date,Pricing & Quote Validity -->
		<div class="mtourQuoteDatePricingCont">
			<div class="flex-column">

				<!--Departure City-->
				<div class="mtourQuoteCityBox">
					<h4 class="mtourQuoteCityBoxHead">Starting City</h4>
					<h3 class="mtourQuoteCityName">{{ $data1->sourcecity }}</h3>
				</div>

				<!--Tour Date-->
				<div class="mtourQuoteDateBox">
					<h4 class="mtourQuoteDateBoxHead">Tour Date</h4>
					<?php
						// $originalDate = CustomHelpers::get_query_field($data1->query_reference,'date_arrival');
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
					<h3 class="mtourQuoteDepDate">{{$datefrom_print}}</h3>
					<p class="mtourQuoteDateBoxHead appendTop10">To</p>
					<p class="mtourQuoteRetDate">{{ $stop_date_print}}</p>
				</div>

				<!--Pricing-->
				<div class="mtourQuotePriceBox">
					@if($data1->option1_price_type=="Per Person")
						<div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceBoxSubHead">Total Basic Cost</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency($price_data_first['query_total_adult']+$price_data_first['query_total_exadult']+$price_data_first['query_total_childbed']+$price_data_first['query_total_childwbed']+$price_data_first['query_total_infant']+$price_data_first['query_total_single'])}}
								</p>
							</div>
							<div class="mtourQuotePriceSeparator"></div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency($price_data_first['query_discount_minus_adult']+$price_data_first['query_discount_minus_exadult']+$price_data_first['query_discount_minus_childbed']+$price_data_first['query_discount_minus_childwbed']+$price_data_first['query_discount_minus_infant']+$price_data_first['query_discount_minus_single'])}}
								</p>
							</div>

							@if(round($price_data_first['query_total_gst_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)
								<div class="mtourQuotePriceSeparator"></div>
								<div class="makeflexCenterBewtween">
									<p class="mtourQuotePriceBoxSubHead">GST
										@if($price_data_first['query_gst_curr']==2)
											({{$price_data_first['gst_percentage']}}%)
										@endif
									</p>
									<p class="mtourQuotePriceValue">
										<span class="mtourQuoteDefaultCurency">&nbsp;</span>
										{{CustomHelpers::get_indian_currency(round($price_data_first['query_gst_adult']+$price_data_first['query_gst_exadult']+$price_data_first['query_gst_childbed']+$price_data_first['query_gst_childwbed']+$price_data_first['query_gst_infant']+$price_data_first['query_gst_single']))}}
										</p>
								</div>
							@endif

							@if(round($price_data_first['query_total_tcs_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)
							<div class="mtourQuotePriceSeparator"></div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceBoxSubHead">TCS 
									@if($price_data_first['query_tcs_curr']==2)
										({{$price_data_first['tcs_percentage']}}%) 
									@endif
								</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency(round($price_data_first['query_tcs_adult']+$price_data_first['query_tcs_exadult']+$price_data_first['query_tcs_childbed']+$price_data_first['query_tcs_childwbed']+$price_data_first['query_tcs_infant']+$price_data_first['query_tcs_single']))}}
									</p>
							</div>
							@endif

							@if(round($price_data_first['query_total_pg_group']/($data1->quote1_number_of_adult+$data1->extra_adult+$data1->child_with_bed+$data1->child_without_bed+$data1->infant+$data1->solo_traveller))>0)
							<div class="mtourQuotePriceSeparator"></div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceBoxSubHead">PG
									@if($price_data_first['pg_charges']==2)
										({{$price_data_first['pgcharges_percentage']}}%) 
									@endif
								</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency(round($price_data_first['query_pgcharges_adult']+$price_data_first['query_pgcharges_exadult']+$price_data_first['query_pgcharges_childbed']+$price_data_first['query_pgcharges_childwbed']+$price_data_first['query_pgcharges_infant']+$price_data_first['query_pgcharges_single']))}}
								</p>
							</div>
							@endif

							<div class="mtourQuotePriceSeparator"></div>
							<div class="flexBetween">
								<div>
									<p class="mtourQuotePriceTotal">Grand Total</p>
									<p class="mtourQuotePriceTagline">( {{ $data1->anything }} )</p>
								</div>
								<div>
									<p class="mtourQuotePriceTotalValue">
										<span class="mtourQuoteDefaultCurency">&nbsp;</span>
										{{ CustomHelpers::get_indian_currency(round($price_data_first['query_grand_adult']+$price_data_first['query_grand_exadult']+$price_data_first['query_grand_childbed']+$price_data_first['query_grand_childwbed']+$price_data_first['query_grand_infant']+$price_data_first['query_grand_single'])) }}
									</p>
								</div>
							</div>
						</div>
					@elseif($data1->option1_price_type=="Group Price")
						<div>
							<div class="makeflexCenterBewtween">
								<p class="tourQuotePriceBoxSubHead">Total Basic Cost</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency($price_data_first['query_total_group'])}}
								</p>
							</div>
							<div class="mtourQuotePriceSeparator"></div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceBoxSubHead">Discount (-)</p>
								<p class="mtourQuotePriceValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency($price_data_first['query_total_discount_group'])}}
								</p>
							</div>

							@if(round($price_data_first['query_total_gst_group'])>0)
								<div class="mtourQuotePriceSeparator"></div>
								<div class="makeflexCenterBewtween">
									<p class="mtourQuotePriceBoxSubHead">
										GST
										@if($price_data_first['query_gst_curr']==2)
											({{$price_data_first['gst_percentage']}}%)
										@endif
									</p>
									<p class="mtourQuotePriceValue">
										<span class="mtourQuoteDefaultCurency">&nbsp;</span>
											{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_gst_group']))}}
									</p>
								</div>
							@endif

							@if(round($price_data_first['query_total_tcs_group'])>0)
								<div class="mtourQuotePriceSeparator"></div>
								<div class="makeflexCenterBewtween">
									<p class="mtourQuotePriceBoxSubHead">
										TCS
											@if($price_data_first['query_tcs_curr']==2)
												({{$price_data_first['tcs_percentage']}}%)
											@endif
										</p>
									<p class="mtourQuotePriceValue">
										<span class="mtourQuoteDefaultCurency">&nbsp;</span>
											{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_tcs_group']))}}
										</p>
								</div>
							@endif

							@if(round($price_data_first['query_total_pg_group'])>0)
								<div class="mtourQuotePriceSeparator"></div>
								<div class="makeflexCenterBewtween">
									<p class="mtourQuotePriceBoxSubHead">PG
										@if($price_data_first['pg_charges']==2)
											({{$price_data_first['pgcharges_percentage']}}%)
										@endif
									</p>
									<p class="mtourQuotePriceValue">
										<span class="mtourQuoteDefaultCurency">&nbsp;</span>
											{{CustomHelpers::get_indian_currency(round($price_data_first['query_total_pg_group']))}}
									</p>
								</div>
							@endif

							<div class="mtourQuotePriceSeparator"></div>
							<div class="makeflexCenterBewtween">
								<p class="mtourQuotePriceTotal">Grand Total</p>
								<p class="mtourQuotePriceTotalValue">
									<span class="mtourQuoteDefaultCurency">&nbsp;</span>
									{{CustomHelpers::get_indian_currency(round($price_data_first['query_pricetopay_adult']))}}
								</p>
							</div>
						</div>
					@endif
				</div>
			</div>

			<!-- Quote Validity -->
			@if($data1->validity_show_on_frontend=='No')
				@if($data1->option1_validaty!="")
					<div class="mtourQuoteValidity">
						Quote validity - {{ date("d M Y", strtotime(str_replace('/','-',$data1->option1_validaty))) }}
					</div>
					@if($data1->validaty_time!='23:59:59')
						{{$data1->validaty_time}}
					@endif
				@endif
			@else
				<div class="mtourQuoteValidity">Pay Immediately</div>
			@endif
		</div>

		<!-- Transport -->
		<?php $flight_detail = unserialize($data1->option1_flight); ?>
		@if(array_key_exists('flightOption',$flight_detail) && $flight_detail['flightOption']==1)
			<div class="mtourQuoteFlightCont">
				<?php $flight_detail=unserialize($data1->option1_flight); ?>
				<h3 class="mtourQuoteFlightHead">FLIGHT DETAILS</h3>
				<div class="">
					<!--Upward Flight Starts-->
					<div class="mtourQuoteOnwardFlightBox">
						<!--Upward Flight Origin - Destination-->
						<div class="flexCenter apndBtm10">
							<div class="apndRt10" style="">
								@if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0)
									<span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'],'previous_data') }}</span>
								@endif

								<span class="mflightCityName">-</span>

								@if($flight_detail['dest']!="")
									<span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'],'previous_data') }}</span>
								@endif
							</div>
							<div>
								@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
								<!-- <?php
									$originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
									$newDate_flight = date("d M Y", strtotime($originalDate_flight));
								?>
								<span class="mflightDate">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span> -->
								<span class="mflightDate">{{ date('d M Y', strtotime($originalDate_flight)) }}</span>
							  @endif
							  @endif
							</div>
						</div>

						<!--Upward Flight Details-->
						<div class="monwardFlightBox">
							<div class="flexCenter appendBottom15">
								<!-- @if(array_key_exists('onwarddate',$flight_detail))
									@if($flight_detail['onwarddate']!="")
									<?php
										$originalDate_flight = $flight_detail['onwarddate'];
										$newDate_flight = date("d M Y", strtotime($originalDate_flight));
									?>
									<span class="fontWeight600 font18 color4A">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>
									@endif
								@endif -->
								<!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
								<span class="mflightStop">
									@if($flight_detail['numberstop']!="")
										{{$flight_detail['numberstop']}}
									@endif
								</span>
								<div class="mclassSeparator"></div>
								<span class="mflightClass">
									@if(array_key_exists('cabin',$flight_detail))
										{{ CustomHelpers::get_flight_class_name($flight_detail['cabin']) }}
									@endif
								</span>
							</div>
							<div class="makeflex">
								<div class="mairlineLogoCont">
								<div class="mairlineLogoBox">
									<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
									<img class="mairlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}"
										onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
								</div>
								<div class="mflightDtlsBox">
									<p class="mflightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
									<p class="mflightNumber">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
								</div>
								</div>
								<div class="mflightDepBox">
									<p class="mflightTiming">
										<!-- @if($flight_detail['dhours']!="") {{$flight_detail['dhours']}} @endif:@if($flight_detail['ddmins']!="") @if($flight_detail['ddmins']=='0')00 @else {{$flight_detail['ddmins']}} @endif @endif -->
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
									<p class="mflightCity">
										<!-- @if($flight_detail['origin']!="")
											{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'],'last_str') }}
										@endif -->
										{{ !empty($flight_detail['origin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : '' }}
									</p>
								</div>
								<div class="mflightDurationCont">
									<p class="mflightDuration">
										<!-- @if(array_key_exists('duration_hours',$flight_detail))
											{{$flight_detail['duration_hours']}}h
										@endif
										@if(array_key_exists('duration_dmins',$flight_detail))
											{{$flight_detail['duration_dmins']}}m
										@endif -->
										{{ array_key_exists('duration_hours', $flight_detail) ? $flight_detail['duration_hours'] . 'h ' : '' }}
										{{ array_key_exists('duration_dmins', $flight_detail) ? $flight_detail['duration_dmins'] . 'm' : '' }}
									</p>
									<div class="flexCenter">
										<i class="fa-plane" aria-hidden="true"></i>
										<div class="mflightPathWay"></div>
										<i class="fa-map-marker" aria-hidden="true"></i>
									</div>
								</div>
								<div class="mflightArrBox">
									<p class="mflightTiming">
										<!-- @if($flight_detail['ahours']!="")
											{{$flight_detail['ahours']}}
										@endif
										:
										@if($flight_detail['damins']!="")
											@if($flight_detail['damins']==0) 00
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
									<p class="mflightCity" >
										<!-- @if($flight_detail['dest']!="")
											{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'],'last_str') }}
										@endif -->
										{{ !empty($flight_detail['dest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : '' }}
									</p>
								</div>
							</div>
							<p class="mbaggageTitle">Baggage info</p>
							<div class="flexCenter">
								<span class="mbaggageSubTitle color4A">Cabin:&ensp;</span>
								<span class="mbaggageSubTitle">
									{{ $flight_detail['baggage'] ?? '' }}
								</span>
								<div class="mbaggageSeparator"></div>
								<span class="mbaggageSubTitle color4A">Check in:&ensp;</span>
								<span class="mbaggageSubTitle">
									{{ $flight_detail['cbaggage'] ?? '' }}
								</span>
							</div>
						</div>
					</div>

					<!--Return Flight Starts-->
					<div class="mtourQuoteReturnFlightBox">
						<!--Return Flight Origin - Destination-->
						<div class="flexCenter apndBtm10">
							<div class="apndRt10">
								@if($flight_detail['dOrigin']!="")
									<span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'previous_data') }}</span>
								@endif

									<span class="mflightCityName">-</span>

								@if($flight_detail['ddest']!="")
									<span class="mflightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'previous_data') }}</span>
								@endif
							</div>
							<div>
								@if(array_key_exists('downwarddate',$flight_detail)) @if($flight_detail['downwarddate']!="")
								<!-- <?php
									$originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
									$newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
								?>
								<span class="mflightDate">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span> -->
								<span class="mflightDate">{{ date('d M Y', strtotime($originalDate_flight_down)) }}</span>
								@endif
								@endif
							</div>
						</div>

						<!--Return Flight Details-->
						<div class="mreturnFlightBox">
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
								<span class="mflightStop">
									<!-- @if($flight_detail['numberstop']!="") {{$flight_detail['numberstop']}} @endif -->
									@if($flight_detail['numberstop']!="")
										{{$flight_detail['numberstop']}}
									@endif
								</span>
								<div class="mclassSeparator"></div>
								<span class="mflightClass">
									<!-- @if(array_key_exists('dcabin',$flight_detail)) {{CustomHelpers::get_flight_class_name($flight_detail['dcabin'])}} Class @endif -->
									@if(array_key_exists('dcabin',$flight_detail))
										{{CustomHelpers::get_flight_class_name($flight_detail['dcabin'])}} Class
									@endif
								</span>
							</div>
							<div class="makeflex">
								<div class="mairlineLogoCont">
									<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
									<div class="mairlineLogoBox">
										<img class="mairlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}"
										onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
									</div>
									<div class="mflightDtlsBox">
										<p class="mflightName">
											<!-- @if($flight_detail['name']!="") {{$flight_detail['name']}} @endif -->
											@if($flight_detail['name']!="")
												{{$flight_detail['name']}}
											@endif
										</p>
										<p class="mflightNumber">
											<!-- @if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif -->
											@if(array_key_exists("dno", $flight_detail)
											&& $flight_detail['dno']!="")
												{{ $flight_detail['dno'] }}
											@endif
										</p>
									</div>
								</div>
								<div class="mflightDepBox">
									<p class="mflightTiming">
										<!-- @if($flight_detail['ddhours']!="") {{$flight_detail['ddhours']}} @endif:@if($flight_detail['ddmins']!="") @if($flight_detail['ddmins']=='0') 00 @else {{$flight_detail['ddmins']}} @endif @endif -->
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

									<p class="mflightCity">
										<!-- @if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="")
											{{ CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'last_str') }}
									  @endif -->
									  {{ !empty($flight_detail['dOrigin']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : '' }}
									</p>
								</div>
								<div class="mflightDurationCont">
									<p class="mflightDuration">
										<!-- @if(array_key_exists('return_duration_hours',$flight_detail)) {{$flight_detail['return_duration_hours']}}h @endif @if(array_key_exists('return_duration_mins',$flight_detail)) {{$flight_detail['return_duration_mins']}}m @endif -->
										{{ array_key_exists('return_duration_hours', $flight_detail) ? $flight_detail['return_duration_hours'] . 'h ' : '' }}
										{{ array_key_exists('return_duration_mins', $flight_detail) ? $flight_detail['return_duration_mins'] . 'm' : '' }}
									</p>
									<div class="flexCenter">
										<i class="fa-plane" aria-hidden="true"></i>
										<div class="mflightPathWay"></div>
										<i class="fa-map-marker" aria-hidden="true"></i>
									</div>
								</div>
								<div class="mflightArrBox">
									<p class="mflightTiming">
										<!-- @if($flight_detail['dahours']!="") {{$flight_detail['dahours']}} @endif:@if($flight_detail['damins']!="") @if($flight_detail['damins']=='0') 00 @else {{$flight_detail['damins']}} @endif @endif -->

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
									<p class="mflightCity">
										<!-- @if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{ CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'last_str') }} @endif -->
										{{ !empty($flight_detail['ddest']) ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : '' }}
									</p>
								</div>
							</div>
							<p class="mbaggageTitle">Baggage info</p>
							<div class="flexCenter">
								<span class="mbaggageSubTitle color4A">Cabin:&ensp;</span>
								<span class="mbaggageSubTitle">
									<!-- @if(array_key_exists('baggage',$flight_detail)) {{$flight_detail['baggage']}} @endif -->
									{{ $flight_detail['baggage'] ?? '' }}
								</span>
								<div class="mbaggageSeparator"></div>
								<span class="mbaggageSubTitle color4A">Check in:&ensp;</span>
								<span class="mbaggageSubTitle">
									<!-- @if(array_key_exists('cbaggage',$flight_detail)) {{$flight_detail['cbaggage']}} @endif -->
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
			<div class="mtourQuoteTransferCont">
				<h3 class="mtourQuoteTransferHead">TRANSFERS</h3>
				<?php $transfers=unserialize($data1->transfers); ?>
				<?php $a=0; ?>
				@foreach($transfers as $row=>$col)
				@if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col))
				<?php
					$transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();
				?>
				<div class="mtourQuoteTransferBox">
					<div class="mtourQuoteTransferTitle">{{$col['mode_title']}}</div>
					<div class="mtourQuoteTransferDescBox">
						<div class="flex-column">

							<!--Vehicle Image-->
							<div class="mtransferImageBox">
									<!-- @if($transfers_data != '' && $transfers_data->transfer_image != '')
										<img class="mtransferImageType" src="{{ url('/public/uploads/transfer_image/'.$transfers_data->transfer_image) }}">
									@else
										<p>Image not available</p>
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
								<div class="mtransferDescTopSection">
									<h4 class="mtransferTitle">{{$col['mode_title']}}</h4>
									<h2 class="mtransportType">
										@if($transfers_data!=''
											&& $transfers_data->transfer_type!='')
											{{$transfers_data->transfer_type}}
										@endif
									</h2>
								</div>

								<!--Vehicle Type,Duration & Inclusion-->
								<div class="flexBetween appendBottom20">
									<div class="mtransferVehicleCont">
										<h4 class="mtransferHead">VEHICLE TYPE</h4>
										<h5 class="mtransferSubHead">
											@if($transfers_data!=''
												&& $transfers_data->vehicle_type!='')
												{{$transfers_data->vehicle_type}}
											@endif
										</h5>
									</div>
									<div class="mtransferDurationCont">
										<h4 class="mtransferHead">DURATION</h4>
										<h5 class="mtransferSubHead">
											@if($transfers_data!=''
												&& $transfers_data->duration!='')
												{{$transfers_data->duration}}
											@endif
										</h5>
									</div>
								</div>
								<div>
									<h4 class="mtransferHead">INCLUDES</h4>
									<h5 class="mtransferSubHead">
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
				<?php $a++; ?>
				@endif
				@endforeach
			</div>
		@endif

		<!-- Accommodation -->
		<div class="mtourQuoteHotelCont">
			<h4 class="mtourQuoteHotelHead">ACCOMMODATION</h4>
			<?php
				$acco=unserialize($data1->option1_accommodation);
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
							<div class="mhotelImageBox">
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
							<div class="mhotelDescBox">
								<div class="mhotelTopSection">
									<div class="mhotelType">Hotel</div>
									<!--Hotel Name-->
									<div class="mtourHotelDtls">
										<h5 class="mhotelName">
											@if(array_key_exists("hotel",$acco_data)
												&& $acco_data["hotel"]!=""
												&& $acco_data["hotel"]!="other")
												{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
												{{CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')}}
											@elseif(array_key_exists("other_hotel",$acco_data) && $acco_data["other_hotel"]!="")
												{{$acco_data["other_hotel"]}}
											@endif
										</h5>
									</div>
									<div class="mhotelStarRating">
										@if(array_key_exists("star",$acco_data) && $acco_data["star"]!="" && $acco_data["star"]!="other")
											{{CustomHelpers::get_star_rating($acco_data["star"])}}
										@elseif(array_key_exists("star_other",$acco_data) && $acco_data["star_other"]!="")
											{{CustomHelpers::get_star_rating($acco_data["star_other"])}}
										@endif
									</div>
									<!--Destination City Name-->
									<div class="mhotelCityName">{{ $acco_data["city"] }}</div>
								</div>

								<div class="mhotelFooter">
									<div>
										<?php
												$day1="0";
												$day="0";
											?>
												@if($acco_data!="" && array_key_exists("night",$acco_data))
												<?php
													$day1=(int)filter_var($acco_data["night"]["0"], FILTER_SANITIZE_NUMBER_INT);

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
												@if($acco_data!="" && array_key_exists("night",$acco_data))
												@foreach($acco_data["night"] as $accday)
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
										<!-- <div class="mhotelDaysBadge">
												<h5 class="hotelDaysBadge_nightCount">
													<?php
													 $date1=date_create($checkin_date);
													 $date2=date_create($checkout_date);
													$diff=date_diff($date1,$date2);
													?>
													@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
												</h5>
										</div> -->

										<div class="flexBetween appendBottom20">
											<!-- Room Type -->
											<div class="mhotelRoomCont">
												<p class="mhotelRoomCont_heading">ROOM TYPE</p>
												@if($acco_data["category"]!="")
												<p class="mhotelRoomCont_type">{{ $acco_data["category"] }}</p>
												@endif
											</div>

											<!-- No of Nights -->
											<div>
												<p class="mhotelDaysBadge_heading">NO OF NIGHTS</p>
												<p class="mhotelDaysBadge_nightCount">
												<?php
													 $date1=date_create($checkin_date);
													 $date2=date_create($checkout_date);
													$diff=date_diff($date1,$date2);
													?>
													@if($diff->format("%a")>1) {{$diff->format("%a Nights") }} @else {{$diff->format("%a Night") }} @endif
												</p>
											</div>
										</div>

										<!--Check-in & Checkout-->
										<div class="mhotelCheckInOut">
											<div class="mhotelCheckInCont">
												<p class="mhotelCheckInCont_heading">CHECK-IN </p>
												<p class="mhotelCheckInCont_date">{{ $checkin_date_print }}</p>
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
												<p class="mhotelCheckOutCont_date">{{ $checkout_date_print }}</p>
											</div>
										</div>
									</div>

									<!-- Hotel Website -->
									@if($acco_data["hotel_link"]!="")
									<div class="mhotelWebCont">
											<p class="mhotelWebCont_heading">HOTEL WEBSITE</p>
											<p class="mhotelWebCont_name">{{ $acco_data["hotel_link"] }}</p>
									</div>
									@endif
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
							<div class="mtourDtlsCont foldable mSubfoldableArrow">
								<span class="mtourQuoteItryDtls">Details</span>
							</div>
							<div class="mfoldableContent mtourQuoteDtlsDesc">
								<p>{!!$itinerary_datas['desc']!!}</p>
							</div>
							<!-- <div class="mtourQuoteDtlsDescSeparator"></div> -->
							</div>
						@endforeach
					</div>
				</div>
			@endif
		@endif

		<!-- Inclusions -->
		@if((($data1->quote_inc!='' && $data1->quote_inc!="N;") || $data1->option1_inclusions!='') || (($data1->quote_exc!='' && $data1->quote_exc!="N;") || $data1->option1_exclusions!=''))
			<div class="mtourQuoteIncCont">
				<div class="mtourQuoteIncHead foldable mfoldableArrow">Inclusions & Exclusions</div>
				<div class="mfoldableContent mtourQuoteIncBox">
					<!--Inclusions-->
					@if(($data1->quote_inc!='' && $data1->quote_inc!="N;") || $data1->option1_inclusions!='')

					<div class="mtourQuoteInclusions">
						<h4 class="mtourQuoteIncSubHead">Inclusions</h4>
						<div class="inc-content">
							<?php $option1_quote_inc = unserialize($data1->quote_inc); ?>
							@if($option1_quote_inc!='')
								@foreach($option1_quote_inc as $v)
									<ul>
										<li>{{ CustomHelpers::get_inclusions($v) }}</li>
								</ul>
								@endforeach
							@endif
							<div>
								{!!$data1->option1_inclusions!!}
							</div>
						</div>
					</div>
					@endif

					<!--Exclusions-->
					@if(($data1->quote_exc!='' && $data1->quote_exc!="N;") || $data1->option1_exclusions!='')
						<div class="mtourQuoteExclusions">
							<h4 class="mtourQuoteExcSubHead">Exclusions</h4>
							<div class="inc-content">
								<?php $option1_quote_exc = unserialize($data1->quote_exc); ?>
								@if($option1_quote_exc!='')
									@foreach($option1_quote_exc as $v)
										<ul>
											<li>{{CustomHelpers::get_exc($v)}}</li>
										</ul>
									@endforeach
								@endif
								<div>
									{!!$data1->option1_exclusions!!}
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		@endif

	  <!-- Overview -->
	  @if($data1->option1_description!='' || $data1->option1_highlights!='')
	   	<div class="mtourQuoteIncCont">
				<h3 class="mtourQuoteIncHead foldable mfoldableArrow"> Tour Overview</h3>
				<div class="mfoldableContent mtourQuoteIncBox">
					<!--Inclusions-->
						@if($data1->option1_description!='')
					<div class="mtourQuoteInclusions">
						<h4 class="mtourQuoteIncSubHead">Add-On Services</h4>
						<div style="padding-top:10px">
							{!!$data1->option1_description!!}</div>
					</div>
					@endif
					<!--Tour Highlights-->
					@if($data1->option1_highlights!='')
					<div class="mtourQuoteExclusions">
						<h4 class="mtourQuoteExcSubHead">Tour Highlights</h4>
						<div style="padding-top:10px">
							{!!$data1->option1_highlights!!}</div>
					</div>
						@endif
				</div>
			</div>
		@endif

		<!-- Visa Policy -->
		@if($data1->option1_visa=="1")
			@if(empty($data1->option1_package_visa) || $data1->option1_package_visa=="N;")
			@else
			<div class="mtourQuoteBookPolicyCont">
				<div class="mtourQuotePolicyHead foldable mfoldableArrow">Visa Policy</div>
				<div class="mfoldableContent mtourQuotePolicyBox">
					<?php $v_policy = unserialize($data1->option1_package_visa); ?>
					@foreach($v_policy as $v)
					<div class="mtourQuotePolicy">
						<div class="imp-note-content">
							{!!CustomHelpers::get_visa_policy($v)!!}
						</div>
					</div>
					@endforeach

					<!-- additional visa policy content -->
					@if (!empty(trim($data1->option1_visa_policies)))
				    <div class="mtourQuoteAddPolicy">{{ $data1->option1_visa_policies }}</div>
					@endif

				</div>
			</div>
			<div class="mtourQuotePolicySeparator"></div>
			@endif
		@endif

		<!-- Booking & Cancellation Policy -->
		@if(($data1->option1_package_payment!='' && $data1->option1_package_payment!="N;") || ($data1->option1_package_can!='' && $data1->option1_package_can!="N;"))
			<div class="mtourQuoteBookPolicyCont">
				<div class="mtourQuotePolicyHead foldable mfoldableArrow">Booking Policy</div>
				<div class="mfoldableContent mtourQuotePolicyBox">
				<!-- Tour Booking Policy -->
				@if($data1->option1_package_payment!='' && $data1->option1_package_payment!="N;")
					<?php $p_policy = unserialize($data1->option1_package_payment); ?>
					@foreach($p_policy as $v)
					<div class="mtourQuotePolicy">
						<h4 class="mTourQtePlcyTtl">Booking Policy</h4>
						<div class="imp-note-content">
							{!!CustomHelpers::get_payment_policy($v)!!}
						</div>
					</div>
					@endforeach

					<!-- additional booking policy content -->
					@if (!empty(trim($data1->option1_payment_policies)))
						<div class="mtourQuoteAddPolicy">{{ $data1->option1_payment_policies }}</div>
					@endif

						<div class="mtourQuotePolicySeparator"></div>
				@endif

				<!-- Tour Cancellation Policy -->
				@if($data1->option1_package_can!='' && $data1->option1_package_can!="N;")
					<?php $c_policy = unserialize($data1->option1_package_can); ?>
					@foreach($c_policy as $v)
					<div class="mtourQuotePolicy">
						<h4 class="mTourQtePlcyTtl">Cancellation Policy</h4>
						<div class="imp-note-content">
							{!!CustomHelpers::get_cancel_policy($v)!!}
						</div>
					</div>
					@endforeach

					<!-- additional cancellation policy content -->
					@if (!empty(trim($data1->option1_cancellation)))
						<div class="mtourQuoteCancelAddPolicy">{{ $data1->option1_cancellation }}</div>
					@endif

				@endif
				</div>
			</div>
		@endif

		<!-- Important Notes -->
		@if(empty($data1->option1_package_can) || $data1->option1_package_can=="N;")
		@else
			<div class="mtourQuoteBookPolicyCont">
				<div class="mtourQuotePolicyHead foldable mfoldableArrow">Important</div>
				<div class="mfoldableContent mtourQuotePolicyBox">
				<?php $important_notes = unserialize($data1->option1_package_impnotes); ?>
				@foreach($important_notes as $v)
					<div class="mtourQuotePolicy">
						<h4 class="mTourQtePlcyTtl">Notes</h4>
						<div class="imp-note-content">
							{!!CustomHelpers::get_impnotes($v)!!}
						</div>
					</div>
				@endforeach

				<!-- additional imp notes content -->
				@if (!empty(trim($data1->option1_extra_imp)))
					<div class="mtourQuoteAddPolicy">{{ $data1->option1_extra_imp }}</div>
				@endif
				</div>
			</div>
		@endif

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

		<!-- Raise concern or Pay Button -->
		<div class="mtouQuoteBookFooterCont">
			<!-- <div class="mrejectionReasonCont">
				<ul>
					<li>
						<input type="radio" id="pricehigh" class="rejectionInput" name="pricehigh" value="pricehigh">
						<label for="pricehigh" class="rejectionLabel">Price is high</label>
					</li>
					<li>
						<input type="radio" id="callback" class="rejectionInput" name="callback1" value="callback">
						<label for="callback" class="rejectionLabel">Want call back</label>
					</li>
					<li>
						<input type="radio" id="bookedwithother" class="rejectionInput" name="bookedwithother" value="bookedwithother">
						<label for="bookedwithother" class="rejectionLabel">Booked with other</label>
					</li>
					<li>
						<input type="radio" id="datechange" class="rejectionInput" name="datechange" value="datechange">
						<label for="datechange" class="rejectionLabel">Date Changed</label>
					</li>
					<li>
						<input type="radio" id="cancelled" class="rejectionInput" name="cancelled" value="cancelled">
						<label for="cancelled" class="rejectionLabel">Tour Cancelled</label>
					</li>
					<li>
						<input type="radio" id="postponned" class="rejectionInput" name="postponned" value="postponned">
						<label for="postponned" class="rejectionLabel">Tour Postponned</label>
					</li>
					<li>
						<input type="radio" id="destinationchange" class="rejectionInput" name="destinationchange" value="destinationchange">
						<label for="destinationchange" class="rejectionLabel">Destination Changed</label>
					</li>
				</ul>
			</div> -->
			<div class="flexCenter">

				<!-- raised requests-mobile -->
				@if(Sentinel::getUser()->inRole('super_admin')
	        || Sentinel::getUser()->inRole('administrator')
	        || Sentinel::getUser()->inRole('supervisor'))
					<?php $previous_raises=DB::table('quote_raise_concern')->where('quotation_ref_no',$data1->quo_ref)->get(); ?>
					<span class="btnRaiseConcern_button">
						@if(count($previous_raises)>0)
							<button type="button" class="btnRaiseConcernMob previous_raise" id="{{$data1->quo_ref}}">Request Raised</button>
			    	@endif
			    </span>
		    @endif

		    <!-- Button to raise concern with modal trigger -->
				<button type="button" class="btnRaiseConcernMob" data-toggle="modal" data-target="#myModal" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}">Request call back</button>

				<!-- <button class="btnMain btnRaiseConcernMob user_quote_accept" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_reject') }}">Raise Concern</button> -->
				<!--<button class="btnMain btnPayBook user_quote_accept" content_id="{{ CustomHelpers::custom_encrypt($data1->id) }}" content_action="{{ url('quote_accept') }}">PAY & BOOK</button>-->
			</div>
		</div>

		<!-- Footer -->
		@if($data1!="" && $data1->option1_quotation_footer!="")
			<?php
				$footer_id=$data1->option1_quotation_footer;
				$footer_data=DB::table('quotation_footer')->where('id',$footer_id)->first();
			?>
			<div class="mtourQuoteFooterCont">
				@if($footer_data!='')
					{!! $footer_data->footer_desc !!}
				@endif
			</div>
		@endif

		<!-- Mobile Pricebar -->
		<div class="mtourQuotePriceBar">
			<div class="mtourQuotePriceBarBox mobscroll overflowX">
				<div class="mtourQuotePriceBoxCont">
					<span class="mtourQuoteValue mtourQuotePriceBarCurency">
						@if($data1->option1_price_type=="Per Person")
							{{ round($price_data_first['query_grand_adult']+$price_data_first['query_grand_exadult']+$price_data_first['query_grand_childbed']+$price_data_first['query_grand_childwbed']+$price_data_first['query_grand_infant']+$price_data_first['query_grand_single']) }}
						@elseif($data1->option1_price_type=="Group Price")
							{{ round($price_data_first['query_pricetopay_adult']) }}
						@endif
					</span>
					<span class="mtourQuoteValueTagline">
						@if($data1->option1_price_type=="Per Person") Per person
						@elseif($data1->option1_price_type=="Group Price") Group Price
						@endif
					</span>
				</div>
				<div>
					<div class="mtourQuotePriceLine"></div>

					<input type="hidden" name="quote_no" class="quote_no" value="{{ CustomHelpers::custom_encrypt(1) }}">
					<input type="hidden" class="unique_code" value="{{ CustomHelpers::custom_encrypt($data1->unique_code) }}">

					@if(CustomHelpers::get_remaining_amount_second(1,$data1->unique_code)==0)
						<button class="btnMain btnBookMob" id="book">Paid</button>
					@else
						<?php
							$today = strtotime(date('Y-m-d'));
							$validity = strtotime(date("Y-m-d", strtotime(str_replace('/','-',$data1->option1_validaty))));
						?>
						@if($today <= $validity)
							@if($data1->send_option == 1)
								<button class="btnMain btnBookMob pay_now" content_action="{{ route('bookingreview') }}">BOOK</button>
							@else
								<button class="btnPayBook" style="cursor: not-allowed! important;">BOOK</button>
							@endif
						@else
							<button class="btn-quote-expired" content_action="">Quote expired</button>
						@endif
					@endif
				</div>
			</div>
		</div>