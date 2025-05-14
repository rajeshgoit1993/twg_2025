				<!--Desktop Tour Name Starts-->
				<!--breadcrumbs starts-->
				<!--<div class="flexCenter" style="margin: 20px 0;display: none">
					<span><a href="{{ url('/') }}">Home<span class="rightArrow"></span></a></span>
					<span><a href="{{ URL::previous() }}">Holidays<span class="rightArrow"></span></a></span>
					<span class="active fontSize16 lineHeight18 fontWeight600">{{ $details->title }}</span>
				</div>-->
				<!--breadcrumbs ends-->
				<!--Tour Name-->
				<div class="dTourNameCont">
					<div class="dTourNameWrapper">
						<h3>{{ $details->title }}</h3>

						<!-- Star Rating -->
						@if(!empty($details->select_star_rating))
						<div class="dHotel-star-rating">							
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
			       	</div>
			       	
					<div class="dTourDescCont">
						<!-- duration -->
						<div class="dTourDuration">{{ $details->duration }}N / {{ $details->duration + 1 }}D</div>

						<!-- tour type -->
						<div class="dHolidayType">
						    {{ in_array($details->tour_type, [null, 2]) ? 'Customized Tour' : 
						    	($details->tour_type == 1 ? 'Cruise Tour' : 
						    	($details->tour_type == 3 ? 'Group Tour' : $details->tour_type)) }}
						</div>
					</div>

					<div class="dTourPlaceWrapper">
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
						        echo "<span class='dTourPlaceDuration'>{$dayValue}N&nbsp;</span>";
						        echo "<div class='dTourCityName'>".CustomHelpers::get_master_table_data('city', 'id', (int)$cityValue, 'name')."</div>";

						        // Add an arrow unless it's the last city
						        if ($i < ($city1_count - 1)) {
						            echo "<span>&nbsp;&rarr;&nbsp;</span>";
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
				</div>
				<!--Desktop Tour Name Ends-->