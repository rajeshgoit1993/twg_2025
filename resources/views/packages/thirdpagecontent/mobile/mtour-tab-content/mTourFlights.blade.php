              <!--Mobile Tour Tabs-Flights Starts-->
              <div class="mTourPkgDesc">
                @if($details->flight!='')
                  <?php $flight_data=unserialize($details->flight); ?>
                  @if(array_key_exists('flightOption',$flight_data) 
                    && $flight_data['flightOption']==1)
                    <div class="mTourHgLhts">
                      <div class="mTourFlightCont">
                        <?php $flight_detail=unserialize($details->flight); ?>
                        <h2>Tour Flight</h2>

                        <!--Upward Flight Starts-->
                        <div class="mTourFlightBox">
                          <!--Upward Flight Details-->
                          <div class="mOnwardFlightBox">
                          <!--Upward Flight Destination-->
                          <div class="flexCenter appendBottom5">
                            <!-- flight source city -->
                            <div class="appendRight20">
                              <!-- @if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0) 
                                <span class="mFlightCityName">{{ $flight_detail['origin'] }}</span>
                              @endif
                                <span class="mFlightCityName">-</span> 
                              @if($flight_detail['dest']!="")
                                <span class="mFlightCityName">{{ $flight_detail['dest'] }}</span>
                              @endif -->
                              @if(array_key_exists('origin',$flight_detail) && $flight_detail['origin']==0)
                                <span class="mFlightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['origin'],'previous_data') }}</span>
                              @endif
                              <span class="mFlightCityName">-</span>
                              @if($flight_detail['dest']!="")
                                <span class="mFlightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dest'],'previous_data') }}</span>
                              @endif
                            </div>

                            <!-- flight onward date -->
                            <div>
                            @if(array_key_exists('onwarddate',$flight_detail)) 
                              @if($flight_detail['onwarddate']!="")
                                <!-- <?php
                                  $originalDate_flight = str_replace('/','-',$flight_detail['onwarddate']);
                                  $newDate_flight = date("d M Y", strtotime($originalDate_flight));
                                ?>
                                <span class="mFlightDate">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span> -->
                                <span class="mflightDate">{{ date('d M Y', strtotime($originalDate_flight)) }}</span>
                                @endif 
                              @endif
                            </div>
                          </div>

                          <div class="flexCenter appendBottom15">
                            <!--Flight Date Starts-->
                            @if(array_key_exists('onwarddate',$flight_detail)) 
                              @if($flight_detail['onwarddate']!="")
                              <?php
                                $originalDate_flight = $flight_detail['onwarddate'];
                                $newDate_flight = date("d M Y", strtotime($originalDate_flight));
                              ?>
                              <!--<span class="fontWeight600 font18 color4A">{{date('D', strtotime($originalDate_flight))}}, {{$newDate_flight}}</span>-->
                              @endif
                            @endif
                            <!--Flight Date Ends-->

                            <!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->

                            <!--Flight Stops-Class-->
                            <span class="mFlightStops">
                              {{ !empty($flight_detail['numberstop'] ?? '') ? $flight_detail['numberstop'] : 'Non-stop' }}
                            </span>
                            <div class="mFlightDtlsSeparator"></div>
                            <span class="mFlightClass">
                              <!-- @if(array_key_exists('cabin',$flight_detail))
                                {{ $flight_detail['cabin'] }}
                              @endif -->
                              @if(array_key_exists('cabin',$flight_detail))
                                {{ CustomHelpers::get_flight_class_name($flight_detail['cabin']) }}
                              @endif
                            </span>
                          </div>

                          <div class="flexCenter">
                            <div class="mAirlineDtls">
                              <!--<div class="pfwmt fontSize18 lineHeight22 textCenter">@if($flight_detail['name']!="") {{$flight_detail['name']}} @endif</div>-->
                              <div class="mAirlineLogoBox">
                                <img class="airlineLogo" src="" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
                              </div>
                              <div class="mAirlineName">
                                @if(!empty($flight_detail['name']) && $flight_detail['name'] !== "0")
                                  {{ $flight_detail['name'] }}
                                @else
                                  Airline
                                @endif
                              </div>
                              <div class="mFlightNumber">
                                @if($flight_detail['no']!="") 
                                  {{$flight_detail['no']}} 
                                @endif
                              </div>
                            </div>

                            <div class="mflightDepBox">
                              <div class="mFlightTime">
                                  <!-- @if($flight_detail['dhours']!="")
                                    {{ $flight_detail['dhours'] }} 
                                  @endif:
                                  @if($flight_detail['ddmins']!="") 
                                    @if($flight_detail['ddmins']=='0')00 @else 
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
                                </div>
                              <div class="mFlightCity">
                                <!-- @if($flight_detail['origin']!="")
                                  {{ $flight_detail['origin'] }}
                                @endif -->
                                {{ !empty($flight_detail['origin'] ?? '') 
                                  ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['origin'], 'last_str')) : 'Departure' }}
                              </div>
                            </div>

                            <div class="mFlightDurationCont">
                              <div class="mFlightDuration">
                                <!-- @if(array_key_exists('duration_hours',$flight_detail)) 
                                  {{$flight_detail['duration_hours']}}h 
                                @endif
                                @if(array_key_exists('duration_dmins',$flight_detail))
                                  {{ $flight_detail['duration_dmins'] }}m 
                                @endif -->
                                {{ array_key_exists('duration_hours', $flight_detail) ? $flight_detail['duration_hours'] . 'h ' : '' }}
                                {{ array_key_exists('duration_dmins', $flight_detail) ? $flight_detail['duration_dmins'] . 'm' : '' }}
                              </div>
                              <div class="flexCenter">
                                <i class="fa-plane" aria-hidden="true"></i>
                                <div class="mFlightPath"></div>
                                <i class="fa-map-marker" aria-hidden="true"></i>
                              </div>
                            </div>

                            <div class="mflightDepBox">
                              <div class="mFlightTime">
                                <!-- @if($flight_detail['ahours']!="") 
                                  {{ $flight_detail['ahours'] }} 
                                @endif:
                                @if($flight_detail['damins']!="") 
                                  @if($flight_detail['damins']==0)00 @else 
                                    {{ $flight_detail['damins'] }}
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
                              </div>
                              <div class="mFlightCity">
                                <!-- @if($flight_detail['dest']!="") 
                                  {{$flight_detail['dest']}} 
                                @endif -->
                                {{ !empty($flight_detail['dest'] ?? '') 
                                  ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dest'], 'last_str')) : 'Arrival' }}
                              </div>
                            </div>
                          </div>

                          <!--Baggage Info-->
                          @if((array_key_exists('baggage',$flight_detail) 
                            && $flight_detail['baggage']!='') 
                            || (array_key_exists('cbaggage',$flight_detail) 
                            && $flight_detail['cbaggage']!=''))
                          <div class="mBaggageCont">
                            <div class="mFlightBaggageTitle">Baggage info</div>
                            <div class="flexCenter">
                              <!--Check-in Baggage Info-->
                              @if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='')
                                <span class="mFlightBaggageSubTitle color4A">Cabin:&ensp;</span>
                                <span class="mFlightBaggageSubTitle">
                                  @if(array_key_exists('baggage',$flight_detail))
                                    {{ $flight_detail['baggage'] }} 
                                  @endif</span>
                                <div class="mBaggageSeparator"></div>
                              @endif
                              <!--Cabin Baggage Info-->
                              @if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!='')
                                <span class="mFlightBaggageSubTitle color4A">Check in:&ensp;</span>
                                <span class="mFlightBaggageSubTitle">
                                  @if(array_key_exists('cbaggage',$flight_detail))
                                    {{ $flight_detail['cbaggage'] }} 
                                  @endif
                                </span>
                              @endif
                            </div>
                          </div>
                          @endif
                          </div>
                        </div>
                        <!--Upward Flight Ends-->

                        <!--Return Flight Starts-->
                        <div class="mTourFlightBox">
                          <!--Return Flight Details-->
                          <div class="mReturnFlightBox">
                            <!--Return Flight Destination-->
                            <div class="flexCenter appendBottom5">
                              <div class="appendRight20">
                                <!-- @if($flight_detail['dOrigin']!="")
                                  <span class="mFlightCityName">{{ $flight_detail['dOrigin'] }}</span>
                                @endif
                                  <span class="mFlightCityName">-</span> 
                                @if($flight_detail['ddest']!="")
                                  <span class="mFlightCityName">{{ $flight_detail['ddest'] }}</span>
                                @endif -->
                                @if($flight_detail['dOrigin']!="")
                                  <span class="mFlightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'],'previous_data') }}</span>
                                @endif
                                <span class="mFlightCityName">-</span>
                                @if($flight_detail['ddest']!="")
                                  <span class="mFlightCityName">{{ CustomHelpers::get_city_seperate_code($flight_detail['ddest'],'previous_data') }}</span>
                                @endif
                              </div>

                              <!-- onward/returnflight date -->
                              <div>
                                @if(array_key_exists('downwarddate',$flight_detail)) 
                                  @if($flight_detail['downwarddate']!="")
                                  <!-- <?php
                                    $originalDate_flight_down = str_replace('/','-',$flight_detail['downwarddate']);
                                    $newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
                                  ?>
                                  <span class="mFlightDate">{{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}</span> -->
                                  <span class="mflightDate">{{ date('d M Y', strtotime($originalDate_flight_down)) }}</span>
                                  @endif 
                                @endif
                              </div>
                            </div>

                            <div class="flexCenter appendBottom15">
                              @if(array_key_exists('downwarddate',$flight_detail)) 
                                @if($flight_detail['downwarddate']!="")
                                <!-- <?php
                                  $originalDate_flight_down = $flight_detail['downwarddate'];
                                  $newDate_flight_down = date("d M Y", strtotime($originalDate_flight_down));
                                ?>
                                <span class="fontWeight600 font18 color4A">
                                  {{ date('D', strtotime($originalDate_flight_down)) }}, {{ $newDate_flight_down }}
                                </span> -->
                                @endif 
                              @endif
                              <!--<div style="border-right: 2px solid #ccc;height: 18px;margin: 0px 10px"></div>-->
                              <span class="mFlightStops">
                                {{ !empty($flight_detail['numberstop'] ?? '') ? $flight_detail['numberstop'] : 'Non-stop' }}
                              </span>
                              <div class="mFlightDtlsSeparator"></div>
                              <span class="mFlightClass">
                                <!-- @if(array_key_exists('dcabin',$flight_detail))
                                  {{ $flight_detail['dcabin'] }}
                                @endif -->
                                @if(array_key_exists('dcabin',$flight_detail))
                                  {{ CustomHelpers::get_flight_class_name($flight_detail['dcabin']) }}
                                @endif
                              </span>
                              <!--<div style="border-left: 2px solid #ccc;height: 24px;margin-left: 10px;"></div>-->
                            </div>

                            <div class="flexCenter">
                              <div class="mAirlineDtls">
                                <!--<div class="pfwmt fontSize18 lineHeight22 textCenter">@if(array_key_exists("dname", $flight_detail) && $flight_detail['dname']!="") {{ $flight_detail['dname'] }} @endif</div>-->
                                <div class="mAirlineLogoBox">
                                  <img src="" alt="airline" onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '&#9992;');">
                                </div>
                                <div class="mAirlineName">
                                  @if(!empty($flight_detail['name']) && $flight_detail['name'] !== "0")
                                    {{ $flight_detail['name'] }}
                                  @else
                                    Airline
                                  @endif
                                </div>
                                <div class="mFlightNumber">
                                  @if(array_key_exists("dno", $flight_detail) && $flight_detail['dno']!="")
                                    {{ $flight_detail['dno'] }}
                                  @endif
                                </div>
                              </div>

                              <div class="mflightDepBox">
                                <div class="mFlightTime">
                                  <!-- @if($flight_detail['ddhours']!="")
                                    {{ $flight_detail['ddhours'] }} 
                                  @endif:
                                  @if($flight_detail['ddmins']!="") 
                                    @if($flight_detail['ddmins']=='0')00 
                                    @else
                                      {{ $flight_detail['ddmins'] }}
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
                                </div>
                                <div class="mFlightCity">
                                  <!-- @if(array_key_exists("dOrigin", $flight_detail) && $flight_detail['dOrigin']!="") 
                                    {{$flight_detail['dOrigin']}} 
                                  @endif -->
                                  {{ !empty($flight_detail['dOrigin'] ?? '') 
                                  ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['dOrigin'], 'last_str')) : 'Departure' }}
                                </div>
                              </div>
                              <div class="mFlightDurationCont">
                                <div class="mFlightDuration">
                                  <!-- @if(array_key_exists('return_duration_hours',$flight_detail))
                                      {{ $flight_detail['return_duration_hours'] }}h 
                                  @endif
                                  @if(array_key_exists('return_duration_mins',$flight_detail))
                                    {{ $flight_detail['return_duration_mins'] }}m 
                                  @endif -->
                                  {{ array_key_exists('return_duration_hours', $flight_detail) ? $flight_detail['return_duration_hours'] . 'h ' : '' }}
                                  {{ array_key_exists('return_duration_mins', $flight_detail) ? $flight_detail['return_duration_mins'] . 'm' : '' }}
                                </div>

                                <div class="flexCenter">
                                  <i class="fa-plane" aria-hidden="true"></i>
                                  <div class="mFlightPath"></div>
                                  <i class="fa-map-marker" aria-hidden="true"></i>
                                </div>
                              </div>
                              <div class="mflightDepBox">
                                <div class="mFlightTime">
                                  <!-- @if($flight_detail['dahours']!="")
                                    {{ $flight_detail['dahours'] }} 
                                  @endif:
                                  @if($flight_detail['damins']!="") 
                                    @if($flight_detail['damins']=='0')00 
                                    @else 
                                      {{ $flight_detail['damins'] }} 
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
                                </div>

                                <div class="mFlightCity">
                                  <!-- @if(array_key_exists("ddest", $flight_detail) && $flight_detail['ddest']!="") 
                                    {{$flight_detail['ddest']}} 
                                  @endif -->
                                  {{ !empty($flight_detail['ddest'] ?? '') 
                                  ? str_replace(['(', ')'], '', CustomHelpers::get_city_seperate_code($flight_detail['ddest'], 'last_str')) : 'Arrival' }}
                                </div>
                              </div>
                            </div>

                            <!--Baggage Info-->
                            @if((array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='') || (array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!=''))
                            <div class="mBaggageCont">
                              <div class="mFlightBaggageTitle">Baggage info</div>
                              <div class="flexCenter">
                                <!--Check-in Baggage Info-->
                                @if(array_key_exists('baggage',$flight_detail) && $flight_detail['baggage']!='') 
                                  <span class="mFlightBaggageSubTitle color4A">Cabin:&ensp;</span>
                                  <span class="mFlightBaggageSubTitle">
                                    @if(array_key_exists('baggage',$flight_detail))
                                      {{ $flight_detail['baggage'] }} 
                                    @endif
                                  </span>
                                <div class="mBaggageSeparator"></div>
                                @endif
                                
                                <!--Cabin Baggage Info-->
                                @if(array_key_exists('cbaggage',$flight_detail) && $flight_detail['cbaggage']!='') 
                                  <span class="mFlightBaggageSubTitle color4A">Check in:&ensp;</span>
                                  <span class="mFlightBaggageSubTitle">
                                    @if(array_key_exists('cbaggage',$flight_detail))
                                      {{ $flight_detail['cbaggage'] }}
                                    @endif
                                  </span>
                                @endif
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                        <!--Return Flight Ends-->
                      </div>
                    </div>
                  @endif
                @endif
              </div>
              <!--Mobile Tour Tabs-Flights Ends-->