					<!--Mobile Tour Details Starts-->
					<!--Mobile Tour Details-->
					<div class="mTourDtlsCont">
						<h3>{{$details->title}}</h3>
						
						<!-- Star Rating -->
						@if(!empty($details->select_star_rating))
						<div class="hotel-star-rating">
							@php
								// Convert the star rating to a float for comparison
								$select_star_rating = (float)$details->select_star_rating;
							@endphp

							<!-- Display star icons based on the rating -->
							@for($i = 1; $i <= $select_star_rating; $i++)
								<div class="fa fa-star dStar_checked"></div>
							@endfor							
						</div>
						@endif

						<div class="mTourDuration">{{ $details->duration }}N&nbsp;/&nbsp;{{ $details->duration + 1 }}D</div>

						<!--Holiday Type-->
						<div class="holiday-type">
						    {{ in_array($details->tour_type, [null, 2]) ? 'Customized Tour' : 
						    	($details->tour_type == 1 ? 'Cruise Tour' : 
						    	($details->tour_type == 3 ? 'Group Tour' : $details->tour_type)) }}
						</div>

						<!-- city duration -->
						<div class="mTourPlaceWrapper">
						    <?php
							    // Deserialize the city and days arrays
							    $city1 = unserialize($details->city);
							    $days = unserialize($details->days);

							    // Count the number of cities
							    $city1_count = count($city1);

							    // Initialize a counter
							    $i = 0;

							    // Loop through the cities and display details
							    foreach ($city1 as $row => $col) {
							        // Ensure both $days[$row] and $city1[$row] are valid
							        $dayValue = isset($days[$row]) ? $days[$row] : '0';
							        $cityValue = isset($city1[$row]) ? $city1[$row] : 'Unknown City';

							        // Display duration and city name
							        echo "<span class='mTourPlaceDuration'>{$dayValue}N&nbsp;</span>";
							        echo "<div class='mTourCityName'>".CustomHelpers::get_master_table_data('city', 'id', (int)$cityValue, 'name')."</div>";

							        // Add an arrow unless it's the last city
							        if ($i < ($city1_count - 1)) {
							            //echo "<span>&nbsp;&rarr;&nbsp;</span>";
							            echo "<span class='mCityArrow'>&nbsp;&rarr;&nbsp;</span>";
							        }

							        // Add a break after every 3 cities (if needed)
							        $a = $i + 1;
							        if ($a % 3 === 0) {
							            echo "<br />";
							        }

							        // Increment the counter
							        $i++;
							    }
							?>
						</div>

						<!--Mobile Tour Date Edit starts-->
						<div class="mSelectDateCont">
							<div class="mSearchInput_box mobscroll">
								<div class="mSearchInput_city">{{ $details->sourcecity == null ? 'JoiningDirect' : $details->sourcecity }}</div>
								<!-- <div class="mSearchInput_guest mDot">2 Travellers</div> -->
								<div class="mSearchInput_price_type mDot">
						@if($new_price!='na')
							<?php  
								$overall_package_rating=$new_second_price['overall_package_rating'];
								$package_rating=$new_second_price['package_rating'];
							?>
							
							
									<?php $rate=DB::table('rt_pkg_rating_type')->where('id',$package_rating)->first(); ?>
									{{ $rate->name }}
								
							
						@else
							On Request
						@endif			

								</div>
								<div class="mSearchInput_date mDot"><?php 

$package_duration = $details->duration;
$first_day = $input_date;
$last_day = date('Y-m-d', strtotime("+$package_duration days", strtotime($first_day)));
$date_range = date('d M' , strtotime($first_day)).' - '.date('d M' , strtotime($last_day));
							?>
						{{$date_range}}</div>
							</div>
							<div class="mSearchInput_edit" id="btn_getModal_searchInputs">Edit</div>
						</div>
						<!--Mobile Tour Date Edit ends-->

						<!--Mobile Tour Services Inclusion-->
						<div class="mTourSvcCont">
							<div class="mTourSvcTtlBox">
								<h5>Included in this package</h5>
							</div>
							<div id="mobscroll" class="mServiceScroll mobscroll">
								@php
							        $package_service = unserialize($details->package_service);
							        $defaultIcon = asset('public/uploads/default-img.webp'); // Default icon
							    @endphp

							    @if(!empty($package_service))
							        @php
							            $count_package_service = count($package_service);
							            $ico = "";

							            foreach ($icon_data as $icon_data1) {
							                $ico .= $icon_data1->icon_title . ",";
							            }
							            $ico1 = array_unique(explode(",", $ico));
							        @endphp

							        @for($i = 0; $i < $count_package_service; $i++)
							            @if(in_array($package_service[$i], $ico1))
							                @php
							                    $iconName = CustomHelpers::getimagename($package_service[$i], 'rt_icons', 'icon');
							                    $iconTitle = CustomHelpers::getimagename($package_service[$i], 'rt_icons', 'icon_title');
							                    $iconPath = public_path('uploads/icons/' . $iconName);
							                    $iconUrl = file_exists($iconPath) && is_readable($iconPath) 
							                        ? asset('public/uploads/icons/' . $iconName) 
							                        : $defaultIcon; // Use default image if icon doesn't exist
							                @endphp

							                <div class="mTourSvcItemIconBox">
							                    <div class="mTourSvcItemImgBox">
							                        <img src="{{ $iconUrl }}" title="{{ $iconTitle }}">
							                    </div>
							                    <div class="mTourSvcItemIconName">{{ $iconTitle ?: 'no-title' }}</div>
							                </div>
							            @endif
							        @endfor
							    @endif
							</div>
						</div>
						<!--Mobile Tour Services Inclusion Ends-->
					</div>
					<!--Mobile Tour Details Ends-->
					<!--Search Inputs Modal Popup JS -->
					<!--modal-popup-search-inputs.js-->