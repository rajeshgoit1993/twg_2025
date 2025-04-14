				@if($window_width >= 960)
					@if(count($data) > 0)
						@foreach($data as $package)
							<input type="hidden" class="pack_id_list" name="pack_id_list[]" value="{{$package->id}}">
							<?php
								$country=unserialize($package->country);
								$city=unserialize($package->city);
								$continent=unserialize($package->continent);
								$state=unserialize($package->state);
							?>
							<a href="{{ url('/holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id)) }}" target="_blank">
							<div class="tourItmCont">
								<div class="tourItmLeftSec">
									@php
										// Retrieve the first gallery ID associated with the package
										$gallery_id = CustomHelpers::get_first_galleryid($package->id);

										// Fetch the medium thumbnail image URL for the gallery ID
										$image_url = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');
									@endphp
									<div class="tourImage_focusInOut pkg_search tourItmImgBox">
										@if(!empty($image_url) && $image_url !== "0")
											<!-- Display the valid image (if not loading, can remove fade-in) -->
											<img src="{{ $image_url }}" class="tourImage_zoom_image fade-in" alt="tourimage">
										@else
											<!-- Display default image if no valid image is found -->
											<img src="{{ URL::to('/public/Uploads/default_profile_image.png') }}" class="fade-in" alt="noimage">
										@endif
									</div>

									<div class="tourItmDescCont">
										<div class="tourItemTopSec">
											<!-- Package Title -->
											<div class="dTourTtlWrapper">
												<h3>{{ $package->title }}</h3>

												<!-- Star Rating -->
												<div class="dHotel-star-rating">
													@if(!empty($package->select_star_rating))
													@php
													// Convert the star rating to a float for comparison
													$select_star_rating = (float)$package->select_star_rating;
													@endphp

													<!-- Display star icons based on the rating -->
													@for($i = 1; $i <= $select_star_rating; $i++)
													<div class="fa fa-star dStar_checked"></div>
													@endfor
													@endif
												</div>
											</div>

											<!-- Package Duration -->
											<h5>
												{{ $package->duration }} Nights / {{ $package->duration + 1 }} Days
											</h5>
										</div>
										<div class="city_nights">
											<div class="flexCenter">
												<?php
													// Attempt to unserialize the city and days data from the package object
													$city1 = @unserialize($package->city); // Suppress warnings if data is invalid
													$days = @unserialize($package->days);

													// Check if both city1 and days are valid arrays
													if (is_array($city1) && is_array($days)) {
													    $city1_count = count($city1); // Count the number of cities
													    $i = 0; // Initialize a counter for iteration

													    // Loop through the cities array
													    foreach ($city1 as $row => $col) {
													        // Display the duration (e.g., "3N") and the city name
													        echo "<span class='itemDestDuration'>" . htmlspecialchars($days[$row]) . "N&nbsp;</span>";
													        echo "<span class='itemDestName'>" . htmlspecialchars($city1[$row]) . "</span>";

													        // If it's not the last city, display a separator arrow
													        if ($i < ($city1_count - 1)) {
													            echo "<span class='itemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
													        }

													        // Every 3 items, close the span for grouping
													        if (($i + 1) % 3 === 0) {
													            echo "</span>";
													        }

													        $i++; // Increment the counter
													    }
													} else {
													    // Display an error message if the data is invalid
													    echo "duration loading...";
													}
												?>
											</div>
										</div>
										<div class="tourItemFooter">
											<h5>Included in this package</h5>
											@php
												// Attempt to unserialize the package_service field to retrieve its data
												$package_service = @unserialize($package->package_service);
											@endphp

											<!-- Check if package_service is not empty and is a valid array -->
											@if(!empty($package_service) && is_array($package_service))
											@php
												// Extract unique icon titles from the icon_data array
												$icon_titles = [];
												foreach ($icon_data as $icon) {
													$icon_titles[] = $icon->icon_title;
												}
												$unique_icons = array_unique($icon_titles);
											@endphp

											<!-- Display the services included in the package -->
											<div class="makeflex">
												<!-- Loop through each service in package_service -->
												@foreach($package_service as $service)
												<!-- Check if the current service is in the unique icons list -->
												@if(in_array($service, $unique_icons))
												<!-- Display the icon for the service -->
												<div class="dSvcIconCont">
													<div class="dSvcIcon">
														<img src="{{ url('/public/uploads/icons/' . CustomHelpers::getimagename($service, 'rt_icons', 'icon')) }}" title="{{ CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') }}">
													</div>
													<!-- Display the title of the service -->
													<div class="dSvcTtl">
														{{ CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') }}
													</div>
												</div>
												@endif
												@endforeach
											</div>
											@endif
										</div>
										<!---->
									</div>
								</div>
								<div class="tourItmRightSec">
									<!--Holiday Type-->
									<div class="dTourType">{{ $package->tour_type }}</div>
									<!--Price Box starts-->
									<?php $new_price=PackagePriceHelpers::get_new_pricing_data($package->id,date('Y-m-d', strtotime($search_date))); ?>
									@if($new_price!='na')
										@if($new_price['actual_price']==$new_price['discount_price'])
											<div class="dItemPriceBoxTop flexCenter">
												<p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
												<p class="dItemPriceType"><span id="" class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
											</div>
											@else
											<div class="dItemPriceBoxTop">
												<p class="dItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
												<p class="dItemPriceType"><span id="" class="dItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> {{ $package->Price_type }}</p>
												<p class="dItemPriceSubTag">*Excluding applicable taxes</p>
												<span class="dItemOfferTag">
												<?php
													$tourdiscount=(int)$new_price['actual_price']-(int)$new_price['discount_price'];
													$percentage=$tourdiscount/$new_price['actual_price']*100;
												?>
												{{ round($percentage) }}% Off
												</span>
											</div>
										@endif
										@else
										<div class="dItemPriceBoxTop flexCenter">
											<p class="dItemPriceType_OnRequest"><span class="defaultCurrency"></span> On Request</p>
										</div>
									@endif
									<!--Price Box ends-->
									<div  class="dItemPriceBoxBottom">
										<button type="button" class="btnViewItemDtl">View Details</button>
									</div>
								</div>
							</div>
							</a>
						@endforeach
					@endif
				@else
					@if(count($data) > 0)
						<!--Mobile View-->
						<!-- <div class="mobile_test_exp"> -->
						@foreach($data as $package)
							<input type="hidden" class="pack_id_list" name="pack_id_list[]" value="{{$package->id}}">
							<?php
								$country=unserialize($package->country);
								$city=unserialize($package->city);
								$continent=unserialize($package->continent);
								$state=unserialize($package->state);
							?>
							<a href="{{ url('/holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id)) }}" class="pkg_search">
								<div class="mTourItmCont">
									<div class="tourItmLeftSec">
										<div class="mTourItmImgBox">
											@php
												// Retrieve the first gallery ID associated with the package
												$gallery_id = CustomHelpers::get_first_galleryid($package->id);

												// Fetch the medium thumbnail image for the gallery ID
												$image_url = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');
											@endphp

											@if($image_url != "0")
												<!-- Display the valid image (if img loading issue, remove fade-in-->
												<img class="fade-in" src="{{ $image_url }}" alt="tourimage">
											@else
												<!-- Display default image if no valid image is found -->
												<img class="fade-in" src="{{ URL::to('/public/Uploads/default_profile_image.png') }}" alt="noimage">
											@endif
										</div>
									</div>
									<div class="tourItmRightSec">
										<div class="mTourItmDescCont">
											<!--<div class="mTourItmDescCont details">-->
											<div class="mDaysBadgeTop">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>

											<div class="mTourItemTopSec">
												<div class="mTourTtlWrapper">
													<h3 title="{{ $package->title }}">{{ $package->title }}</h3>
													<div class="mHotel-star-rating">
														@if(!empty($package->select_star_rating))
															@php
																// Convert star rating to float for processing
																$select_star_rating = (float)$package->select_star_rating;
															@endphp

															<!-- Display checked stars based on the rating -->
															@for($i = 1; $i <= $select_star_rating; $i++)
																<div class="fa fa-star mStart_checked"></div>
															@endfor
														@endif
													</div>
													<!--<div class="mDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>-->

													<!--Holiday Type-->
													<div class="mTourType">{{ $package->tour_type }}</div>
												</div>
											</div>

											<div class="mcity_nights">
												<p>
													<?php
														// Attempt to unserialize the city and days data from the package object
														$city1 = @unserialize($package->city); // Suppress warnings if data is invalid
														$days = @unserialize($package->days);

														// Check if both city1 and days are valid arrays
														if (is_array($city1) && is_array($days)) {
															$city1_count = count($city1); // Count the number of cities
															$i = 0; // Initialize a counter for iteration

															// Loop through the cities array
															foreach ($city1 as $row => $col) {
																// Display the duration (e.g., "3N") and the city name
																echo "<span class='itemDestDuration'>" . htmlspecialchars($days[$row]) . "N&nbsp;</span>";
																echo "<span class='itemDestName'>" . htmlspecialchars($city1[$row]) . "</span>";

																// If it's not the last city, display a separator arrow
																if ($i < ($city1_count - 1)) {
																	echo "<span class='itemDestSepr'>&nbsp;&rarr;&nbsp;</span>";
																}

																// Every 3 items, close the span for grouping
																if (($i + 1) % 3 === 0) {
																	echo "</span>";
																}

																$i++; // Increment the counter
															}
														} else {
															// Display an error message if the data is invalid
															echo "duration loading...";
														}
													?>
												</p>
											</div>

											<div class="mTourItemFooter">
												<h5 class="mServiceTitle">Included in this package</h5>
												@php
													// Attempt to unserialize the package_service field to retrieve its data
													$package_service = @unserialize($package->package_service);
												@endphp

												<!-- Check if package_service is not empty and is a valid array -->
												@if(!empty($package_service) && is_array($package_service))
													@php
														// Extract unique icon titles from the icon_data array
														$icon_titles = [];
														foreach ($icon_data as $icon) {
															$icon_titles[] = $icon->icon_title; // Collect all icon titles
														}
														$unique_icons = array_unique($icon_titles); // Remove duplicate icon titles
													@endphp
													<div class="mobscroll scrollX">
														<div class="makeflex">
															@foreach($package_service as $service)
																<!-- Check if the current service is in the unique icons list -->
																@if(in_array($service, $unique_icons))
																<div class="mSvcIconCont">
																	<!-- Display the icon for the service -->
																	<div class="mSvcIcon">
																		<img src="{{ url('/public/uploads/icons/' . CustomHelpers::getimagename($service, 'rt_icons', 'icon')) }}" title="{{ CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') }}">
																	</div>
																	<!-- Display the title of the service -->
																	<div class="mSvcTtl">
																		{{ CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') }}
																	</div>
																</div>
																@endif
															@endforeach
														</div>
													</div>
											

												<div class="mTourItemPriceBox">
													<div class="mTourPriceWrapper">
														<h4 title="{{ $package->title }}">Starting Tour Price</h4>
														<!--<div class="mDaysBadge">{{ $package->duration }}N / {{ $package->duration + 1 }}D</div>-->
													</div>
													@php
														// Fetch updated pricing data for the package
														$new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d', strtotime($date)));
													@endphp

													@if($new_price != 'na')
														@if($new_price['actual_price'] == $new_price['discount_price'])
															<!-- Price Box for No Discount -->
															<div class="mItemPriceBoxTop">
																<p class="mItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>
																<p class="mItemPriceType">
																	<span class="mItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> 
																	{{ $package->Price_type }}
																</p>
															</div>
														@else
															<!-- Price Box with Discount -->
															<div class="mItemPriceBoxTop">
																<!-- Actual Price -->
																<p class="mItemAcutalPrice defaultCurrency">{{ $new_price['actual_price'] }}</p>

																<!-- Discounted Price -->
																<p class="mItemPriceType">
																	<span class="mItemOfferPrice defaultCurrency">{{ $new_price['discount_price'] }}</span> 
																	{{ $package->Price_type }}
																</p>

																<!-- Price Sub-Tag -->
																<p class="mItemPriceSubTag">*Excluding applicable taxes</p>

																<!-- Discount Percentage -->
																@php
																	$tour_discount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
																	$percentage = ($tour_discount / $new_price['actual_price']) * 100;
																@endphp
																<span class="dItemOfferTag">{{ round($percentage) }}% Off</span>
															</div>
														@endif
													@else
														<!-- Price Box for On Request -->
														<div class="mItemPriceBoxTop_onRequest">
															<p class="mItemPriceType_OnRequest">On Request</p>
														</div>
													@endif
													<!-- Price Box Ends -->
												</div>
												@endif
												<div class="viewItemCont">
													<button type="button" class="mBtnViewDtls">View Details</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</a>
						@endforeach
						<!-- </div> -->
					@endif
				@endif