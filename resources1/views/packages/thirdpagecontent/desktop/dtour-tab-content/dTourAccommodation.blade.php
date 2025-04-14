									<!--Desktop Tour Tabs-Accommodation Starts-->
									<div class="dTourPkgDesc">
										@if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc")
										<div class="dTourHtlCont">
											<h2>Tour Accommodation</h2>
												@if($details->acc_type == "normal_acc")
												    @php
												        $acco = unserialize($details->accommodation);
												        $i = "1";
												    @endphp

												    @foreach($acco as $acco_data)
												        @if(array_key_exists('city', $acco_data))
												            @if($i == "1")
												                <div class="collapsible-container">
												                    <div class="collapsible-item dItem-box dItem-arrow active" id="{{ str_slug($acco_data['city'], '-') . $i }}">
												                        <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ $acco_data['city'] }}
												                    </div>
												                    <div class="collapsible-item-content" id="{{ str_slug($acco_data['city'], '-') . $i }}" style="display: block; max-height: inherit;">
												                        <div class="dHtlCont">
																			<div class="dHtlBox">
																				<div class="makeflex">
																					<!--Hotel Image-->
																					<div class="dHtlImgBox">
																					    @if(!empty($acco_data['hotel']) && $acco_data['hotel'] !== 'other')
																					        @php
																					            $hotelImage = CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image');
																					        @endphp

																					        @if($hotelImage && file_exists(public_path("uploads/package_hotel/{$hotelImage}")))
																					            <img src="{{ asset('public/uploads/package_hotel/'.$hotelImage) }}" alt="Hotel-Image">
																					        @else
																					            <img src="{{ asset('public/uploads/default-img.webp') }}" alt="No-Image">
																					        @endif
																					    @else
																					        <img src="{{ asset('public/uploads/default-img.webp') }}" alt="No-Image">
																					    @endif
																					</div>

																					<!--Hotel Description-->
																					<div class="dHtlDesc">
																						<div class="dhotelTopSection">
																							<div class="dHotelType">
																								@if(array_key_exists("propertytype", $acco_data) && !is_null($acco_data["propertytype"]))
																							        {{ $acco_data["propertytype"] }}
																							    @else
																							        Hotel
																							    @endif
																							</div>
																								<div class="flexCenter">
																									<div class="dHtlName">
																										<h4>
																											@if(array_key_exists("hotel",$acco_data))
																												@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other")
																													{{ CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname') }}
																												@elseif($acco_data["hotel"]=="other")
																													{{ $acco_data["other_hotel"] }}
																												@endif 
																											@endif
																										</h4>
																									</div>
																									<div class="dHtlDescription">
																										<span class="dHtlStarRating" >
																											@if(array_key_exists("star",$acco_data))
																												@if($acco_data["star"]!="" && $acco_data["star"]!="other")
																													{{ CustomHelpers::get_star_rating($acco_data["star"]) }}
																												@elseif($acco_data["star"]=="other")
																													{{ CustomHelpers::get_star_rating($acco_data["star_other"]) }}
																												@endif
																											@endif
																										</span>
																									</div>
																								</div>
																								<!--City Name starts-->
																								<div class="dCityCont">
																									<?php
																										$day1="0";
																										$day="0";
																									?>
																									@if($acco_data!="" && array_key_exists("night",$acco_data))
																										<?php $day1=count($acco_data["night"]); ?>
																									@endif
																									<h4>{{ $acco_data["city"] }}</h4>
																								</div>
																								<!--City Name ends-->
																								<div class="flex-column">
																								<!--No of Nights-->
																									<div class="dTourHtlDtls">
																										<h4>No of Nights</h4>
																										<h5>
																											@if($day1>1)
																												{{ $day1 }} Nights
																											@else
																												{{ $day1 }} Night
																											@endif
																										</h5>
																									</div>
																									<!--Room Type-->
																									@if($acco_data["category"]!="")
																									<div class="dTourHtlDtls">
																										<h4>Room Type</h4>
																										<h5>{{ $acco_data["category"] }}</h5>
																									</div>
																									@endif
																								</div>
																						</div>
																					</div>
																				</div>
																				<div class="dhotelFooter">
																					<!--Hotel Website-->
																					@if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"]))
																						<div class="dHotelWebCont">
																							<div class="dHotelWebCont_heading">Hotel Website</div>
																							<div class="dHotelWebCont_name">{{ $acco_data["hotel_link"] }}</div>
																						</div>
																					@endif
																				</div>
																			</div>
																		</div>
												                    </div>
												                </div>
												            @else
												                <div class="collapsible-container">
												                    <div class="collapsible-item dItem-box dItem-arrow" id="{{ str_slug($acco_data['city'], '-') . $i }}">
												                        <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;{{ $acco_data['city'] }}
												                    </div>
												                    <div class="collapsible-item-content" id="{{ str_slug($acco_data['city'], '-') . $i }}">
												                        <div class="dHtlCont">
																			<!--City Name starts-->
																			<!--<div class="dCityCont d-none">
																			<?php
																				$day1="0";
																				$day="0";
																			?>
																			@if($acco_data!="" && array_key_exists("night",$acco_data))
																				<?php $day1=count($acco_data["night"]); ?>
																			@endif
																			<h4>{{ $acco_data["city"] }}</h4>
																			</div>-->
																			<!--City Name ends-->
																			<div class="dHtlBox">
																				<div class="makeflex">
																					<!--Hotel Image-->
																					<div class="dHtlImgBox">
																					    @if(!empty($acco_data['hotel']) && $acco_data['hotel'] !== 'other')
																					        @php
																					            $hotelImage = CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image');
																					        @endphp

																					        @if($hotelImage && file_exists(public_path("uploads/package_hotel/{$hotelImage}")))
																					            <img src="{{ asset('public/uploads/package_hotel/'.$hotelImage) }}" alt="Hotel-Image">
																					        @else
																					            <img src="{{ asset('public/uploads/default-img.webp') }}" alt="No-Image">
																					        @endif
																					    @else
																					        <img src="{{ asset('public/uploads/default-img.webp') }}" alt="No-Image">
																					    @endif
																					</div>

																					<!--Hotel Description-->
																					<div class="dHtlDesc">
																						<div class="dhotelTopSection">
																							<div class="dHotelType">@if(array_key_exists("propertytype",$acco_data)){{ $acco_data["propertytype"] }}@endif</div>
																								<div class="flexCenter">
																									<div class="dHtlName">
																										<h4>@if(array_key_exists("hotel",$acco_data))@if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other"){{ CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname') }}@elseif($acco_data["hotel"]=="other"){{ $acco_data["other_hotel"] }}@endif @endif</h4>
																									</div>
																									<div class="dHtlDescription">
																										<span class="dHtlStarRating" >
																											@if(array_key_exists("star",$acco_data))
																												@if($acco_data["star"]!="" && $acco_data["star"]!="other")
																												{{ CustomHelpers::get_star_rating($acco_data["star"]) }}
																												@elseif($acco_data["star"]=="other")
																												{{ CustomHelpers::get_star_rating($acco_data["star_other"]) }}
																												@endif
																											@endif
																										</span>
																									</div>
																								</div>
																								<!--City Name starts-->
																								<div class="dCityCont">
																								<?php
																									$day1="0";
																									$day="0";
																								?>
																								@if($acco_data!="" && array_key_exists("night",$acco_data))
																									<?php $day1=count($acco_data["night"]); ?>
																								@endif
																									<h4>{{ $acco_data["city"] }}</h4>
																								</div>
																								<!--City Name ends-->
																								<div class="flex-column">
																								<!--No of Nights-->
																									<div class="dTourHtlDtls">
																										<h4>No of Nights</h4>
																										<h5>
																											@if($day1>1)
																											<div>{{ $day1 }} Nights</div>
																											@else
																											<div>{{ $day1 }} Night</div>
																											@endif
																										</h5>
																									</div>
																									<!--Room Type-->
																									@if($acco_data["category"]!="")
																									<div class="dTourHtlDtls">
																										<h4>Room Type</h4>
																										<h5>{{ $acco_data["category"] }}</h5>
																									</div>
																									@endif
																								</div>
																						</div>
																					</div>
																				</div>
																				<div class="dhotelFooter">
																					<!--Hotel Website-->
																					@if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"]))
																						<div class="dHotelWebCont">
																							<div class="dHotelWebCont_heading">Hotel Website</div>
																							<div class="dHotelWebCont_name">{{ $acco_data["hotel_link"] }}</div>
																						</div>
																					@endif
																				</div>
																			</div>
																		</div>
												                    </div>
												                </div>
												            @endif
												        @else
												            <div>City information is not available.</div>
												        @endif
												        @php $i++; @endphp
												    @endforeach
												@elseif($details->acc_type=="extra_acc")
													<div class="dUnlistedHotel">
														{!! $details->accommodation_extra !!}
													</div>
												@endif
										</div>
										@endif
									</div>
									<!--Desktop Tour Tabs-Accommodation Ends-->
									<!--Desktop-Tour-Tab-Collapsible-item-script-pagethree.js-->