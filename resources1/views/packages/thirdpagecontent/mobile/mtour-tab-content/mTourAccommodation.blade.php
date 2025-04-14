              <!--Mobile Tour Tabs-Accommodation Starts-->
              <div class="mTourPkgDesc">
                @if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc")
                <div class="mTourHgLhts">
                  <h2>Tour Accommodation</h2>
                    @if($details->acc_type == "normal_acc")
                      @php
                        $acco = unserialize($details->accommodation); // Deserialize the accommodation data
                        $i = 1;
                      @endphp

                      @foreach($acco as $acco_data)
                        @if(array_key_exists('city', $acco_data)) <!-- Check if 'city' key exists -->
                          @if($i == 1)
                            <div class="collapsible-container">
                              <div class="collapsible-item mItem-box mItem-arrow active" id="{{ str_slug($acco_data['city'], '-') . $i }}">
                                <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ $acco_data['city'] }}
                              </div>
                              <div class="collapsible-item-content" id="{{ str_slug($acco_data['city'], '-') . $i }}" style="display: block; max-height: inherit;">
                                <div class="mHtlCont">
                                  <!-- City Name -->
                                  <div class="mCityCont d-none">
                                    @php $day1 = 0; @endphp
                                    @if(!empty($acco_data) && array_key_exists('night', $acco_data))
                                      @php $day1 = count($acco_data['night']); @endphp
                                    @endif
                                    <h4>{{ $acco_data['city'] }}</h4>
                                  </div>
                                  <div class="mHtlBox">
                                    <!-- Hotel Image -->
                                    <div class="mHtlImgBox">
                                      @if(array_key_exists('hotel', $acco_data))
                                        @if(!empty($acco_data['hotel']) && $acco_data['hotel'] != 'other')
                                          <img src="{{ url('/public/uploads/package_hotel/' . CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image')) }}" alt="Hotel-Image">
                                        @elseif($acco_data['hotel'] == 'other')
                                          <img src="{{ url('/public/uploads/no-image.png') }}" alt="No-Image">
                                        @endif
                                      @endif
                                    </div>
                                    <!-- Hotel Description -->
                                    <div class="mHtlDesc">
                                      <div class="mhotelTopSection">
                                        <div class="mHotelType">
                                          @if(array_key_exists("propertytype", $acco_data) && !is_null($acco_data["propertytype"]))
                                            {{ $acco_data["propertytype"] }}
                                          @else
                                            Hotel
                                          @endif
                                        </div>
                                        <div>
                                          <div>
                                            <h4 class="htlTtl">
                                              @if(array_key_exists('hotel', $acco_data))
                                                @if(!empty($acco_data['hotel']) && $acco_data['hotel'] != 'other')
                                                  {{ CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotelname') }}
                                                @elseif($acco_data['hotel'] == 'other')
                                                  {{ $acco_data['other_hotel'] ?? '' }}
                                                @endif
                                              @endif
                                            </h4>
                                          </div>
                                          <div class="mHtlDescription">
                                            <span class="mHtlStarRating">
                                              @if(array_key_exists('star', $acco_data))
                                                @if(!empty($acco_data['star']) && $acco_data['star'] != 'other')
                                                  {{ CustomHelpers::get_star_rating($acco_data['star']) }}
                                                @elseif($acco_data['star'] == 'other')
                                                  {{ CustomHelpers::get_star_rating($acco_data['star_other']) }}
                                                @endif
                                              @endif
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mhotelFooter">
                                        <div class="flexBetween">
                                          <!-- Number of Nights -->
                                          <div class="mTourHtlDtls">
                                            <h4>No of Nights</h4>
                                            <h5>
                                              @if($day1 > 1)
                                                <div>{{ $day1 }} Nights</div>
                                              @else
                                                <div>{{ $day1 }} Night</div>
                                              @endif
                                            </h5>
                                          </div>
                                          <!-- Room Type -->
                                          @if(array_key_exists('category', $acco_data) && !empty($acco_data['category']))
                                            <div class="mTourHtlDtls">
                                              <h4 class="textRight">Room Type</h4>
                                              <h5 class="textRight">{{ $acco_data['category'] }}</h5>
                                            </div>
                                          @endif
                                        </div>
                                        <!-- Hotel Website -->
                                        @if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"]))
                                          <div class="mhotelWebCont">
                                            <div class="mhotelWebCont_heading">Hotel Website</div>
                                            <div class="mhotelWebCont_name">{{ $acco_data['hotel_link'] }}</div>
                                          </div>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @else
                            <!-- Repeat the same logic for non-active items -->
                            <div class="collapsible-container">
                              <div class="collapsible-item mItem-box mItem-arrow" id="{{ str_slug($acco_data['city'], '-') . $i }}">
                                <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ $acco_data['city'] }}
                              </div>
                              <div class="collapsible-item-content" id="{{ str_slug($acco_data['city'], '-') . $i }}">
                                <div class="mHtlCont">
                                    <!-- Repeat content logic here -->
                                </div>
                              </div>
                            </div>
                          @endif
                        @else
                          <div class="alert alert-warning">City information is missing in one of the accommodation</div>
                        @endif
                        @php $i++; @endphp
                      @endforeach

                    @elseif($details->acc_type=="extra_acc")
                      <div class="mUnlistedHotel">
                        {!! $details->accommodation_extra !!}
                      </div>
                    @endif
                </div>
                @endif
              </div>
              <!--Mobile Tour Tabs-Accommodation Ends-->
              <!--Mobile-Tour-Tab-Collapsible-item-script-pagethree.js-->