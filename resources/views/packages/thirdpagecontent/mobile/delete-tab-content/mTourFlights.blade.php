<div class="tab-pane fade mTourPkgDesc" id="mTourFlights">
	@if($details->flight!='')
		<?php 
 $flight_data=unserialize($details->flight); 

		?>
		
	   @if(array_key_exists('flightOption',$flight_data) && $flight_data['flightOption']==1)  
	<div class="tab-pane fade in active tourHgLhts">
	<div class="tourQuoteFlightCont">
		<?php $flight_detail=unserialize($details->flight); ?>
		<div>
			<h3 class="tourQuoteFlightHead">FLIGHT DETAILS</h3>
		</div>
		<div class="">
			<!--Upward Flight Starts-->
			<div class="tourQuoteOnwardFlightBox">
				<!--Upward Flight Origin - Destination-->
				<div class="flexCenter appendBottom5">
					<div class="appendRight20">
					@if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0) 
						<span class="flightCityName">{{ $flight_detail['origin'] }}</span>
					@endif
						<span class="flightCityName">-</span> 
					@if($flight_detail['dest']!="")
						<span class="flightCityName">{{ $flight_detail['dest'] }}</span>
					@endif
					</div>
					<div>
					@if(array_key_exists('onwarddate',$flight_detail)) @if($flight_detail['onwarddate']!="")
						<?php
							$originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
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
						<span class="flightClass">@if(array_key_exists('cabin',$flight_detail)) {{$flight_detail['cabin']}} @endif</span>
					</div>
					<div class="flexCenter appendLeft20">
						<div class="appendRight10">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>-->
							<div class="airlineLogoBox">
								<img class="airlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
							</div>
						</div>
						<div class="appendRight20 W120">
							<p class="flightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="flightNumber">@if($flight_detail['no']!="") {{$flight_detail['no']}} @endif</p>
						</div>
						<div class="W100">
							<p class="flightTiming">@if($flight_detail['dhours']!="") {{$flight_detail['dhours']}} @endif:@if($flight_detail['ddmins']!="") @if($flight_detail['ddmins']=='0')00 @else {{$flight_detail['ddmins']}} @endif @endif</p>
							<p class="flightCity">@if($flight_detail['origin']!="") {{$flight_detail['origin']}} @endif</p>
						</div>
						<div class="flightDurationCont">
							<p class="flightDuration">@if(array_key_exists('duration_hours',$flight_detail)) {{$flight_detail['duration_hours']}}h @endif
							@if(array_key_exists('duration_dmins',$flight_detail)) {{$flight_detail['duration_dmins']}}m @endif</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="flightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div class="W100">
							<p class="flightTiming">@if($flight_detail['ahours']!="") {{$flight_detail['ahours']}} @endif:@if($flight_detail['damins']!="") @if($flight_detail['damins']==0) 00 @else {{$flight_detail['damins']}} @endif @endif</p>
							<p class="flightCity" >@if($flight_detail['dest']!="") {{$flight_detail['dest']}} @endif</p>
						</div>
					</div>
					@if((array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='') || (array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!=''))

					<p class="baggageTitle">Baggage info</p>
					<div class="flexCenter">
						@if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='')
						<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="baggageSubTitle">@if(array_key_exists('baggage',$flight_detail)) {{$flight_detail['baggage']}} @endif</span>

						<div class="baggageSeparator"></div>
						@endif

						@if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!='')

						<span class="baggageSubTitle color4A">Check in:&ensp;</span>
						<span class="baggageSubTitle">@if(array_key_exists('cbaggage',$flight_detail)) {{$flight_detail['cbaggage']}} @endif</span>
						@endif
					</div>
					@endif
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
							$originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
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
						<span class="flightClass"> @if(array_key_exists('dcabin',$flight_detail)) {{$flight_detail['dcabin']}} @endif</span>
					  <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
					</div>
					<div class="flexCenter appendLeft20">
						<div class="appendRight10">
							<!--<p class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</p>-->
							<div class="airlineLogoBox">
								<img class="airlineLogo" src="{{ url('/resources/assets/frontend/images/icon/airlineIndigo.png') }}">
							</div>
						</div>
						<div class="appendRight20 W120">
							<p class="flightName">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</p>
							<p class="flightNumber">@if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="") {{ $flight_detail['dno'] }} @endif</p>
						</div>
						<div class="W100">
							<p class="flightTiming">@if($flight_detail['ddhours']!="") {{$flight_detail['ddhours']}} @endif:@if($flight_detail['ddmins']!="") @if($flight_detail['ddmins']=='0') 00 @else {{$flight_detail['ddmins']}} @endif @endif</p>
							<p class="flightCity">@if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") {{$flight_detail['dOrigin']}} @endif</p>
						</div>
						<div class="flightDurationCont">
							<p class="flightDuration">@if(array_key_exists('return_duration_hours',$flight_detail)) {{$flight_detail['return_duration_hours']}}h @endif
							@if(array_key_exists('return_duration_mins',$flight_detail)) {{$flight_detail['return_duration_mins']}}m @endif</p>
							<div class="flexCenter">
								<i class="fa-plane" aria-hidden="true"></i>
								<div class="flightPathWay"></div>
								<i class="fa-map-marker" aria-hidden="true"></i>
							</div>
						</div>
						<div class="W100">
							<p class="flightTiming">@if($flight_detail['dahours']!="") {{$flight_detail['dahours']}} @endif:@if($flight_detail['damins']!="") @if($flight_detail['damins']=='0') 00 @else {{$flight_detail['damins']}} @endif @endif</p>
							<p class="flightCity" >@if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") {{$flight_detail['ddest']}} @endif</p>
						</div>
					</div>
					@if((array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='') || (array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!='')) 
					<p class="baggageTitle">Baggage info</p>
					<div class="flexCenter">
						@if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='') 
						<span class="baggageSubTitle color4A">Cabin:&ensp;</span>
						<span class="baggageSubTitle">@if(array_key_exists('baggage',$flight_detail)) {{$flight_detail['baggage']}} @endif</span>
						<div class="baggageSeparator"></div>
						@endif
						@if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!='') 
						<span class="baggageSubTitle color4A">Check in:&ensp;</span>
						<span class="baggageSubTitle">@if(array_key_exists('cbaggage',$flight_detail)) {{$flight_detail['cbaggage']}} @endif</span>
						@endif
					</div>
					@endif
				</div>
			</div>
			<!--Return Flight Ends-->
		</div>
	</div>
		
	</div>
	@endif
	@endif
</div>