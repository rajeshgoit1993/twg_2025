	<!--Desktop Filter Starts-->
	<div class="dFilterBG dPosition_Sticky" style="top: 70px">
		<div class="dPageContainer">
			<div class="dFilterCont">
				<!--Refine Search-->
				<div class="dAppldFilterWrapper">
					<div id="refine_search" class="dAppldFilter">Refine Search</div>
				</div>
				<div class="sorting_content dFilterWrapper">

					<!--Covered Places-->
					<div class="dropDown">
					    <div class="dFilterHeadBox">
					        <div id="place_covered" onclick="coverd_places()" class="dFilterHead dropbtn1">
					            Covered Places <span class="dFilterCount">1</span>
					        </div>
					    </div>
					    <div id="coverd_places" class="dropdown-content dropdown1">
					        <?php 
					        $package_city = []; // Initialize an array for package cities
					        ?>

					        @foreach($data as $package)
					            <?php
					            // Safely unserialize the city data
					            $city = is_string($package->city) ? @unserialize($package->city) : null;

					            if (is_array($city)) {
					                $package_city = array_merge($package_city, $city);
					            }
					            ?>
					        @endforeach

					        <?php
					        // Remove duplicates
					        $package_city = array_unique($package_city);
					        ?>

					        @foreach($package_city as $package)
					            @if(!empty($package))
					                <?php
					                // Fetch city-specific data from the database
					                $city_data = DB::table('rt_packages')
					                    ->where([
					                        ['city', 'like', '%' . $package . '%'],
					                        ['status', '=', '1'],
					                    ])
					                    ->get();
					                ?>
					                <div class="drop">
					                    <label class="dDropLabel">
					                        <input type="checkbox" class="dropCheckBox" name="chk_value" value="{{ $package }}">
					                        <span class="dCheckMark"></span>
					                        <div class="fullWidth flexBetween">
					                            <div>{{ $package }}</div>
					                            <span>({{ count($city_data) }})</span>
					                        </div>
					                    </label>
					                </div>
					            @endif
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--Price Range-->
					<!-- <div class="dropDown">
						<div onclick="price()" class="dFilterHead dropbtn2">Budget <i class="dFilterSubHead">per person</i> <span class="dFilterCount">1</span></div>
						<div id="price" class="dropdown-content dropdown2" style="min-width: 190px;">
							<div id="price-ranges" class="budgetSlider"></div>
							<div class="rangeSection">
								<span class="min-price-label"></span>
								!--<span>&#8212;</span>--
								<span class="max-price-label"></span>
							</div>
						</div>
					</div> -->

					<!--Price Range-->
					<div class="dropDown">
					    <div onclick="price()" class="dFilterHead dropbtn2">
					        Budget <i class="dFilterSubHead">per person</i> <span class="dFilterCount">1</span>
					    </div>
					    <div id="price" class="dropdown-content dropdown2" style="min-width: 190px;">
					        <div id="price-ranges" class="budgetSlider"></div>
					        <div class="rangeSection">
					            <span class="min-price-label">₹0</span>
					            <span> &#8212; </span>
					            <span class="max-price-label">₹0</span>
					        </div>
					    </div>
					</div>

					<!-- ----- -->

					<!--Duration-->
					<!-- <div class="dropDown">
						<div onclick="duration()" class="dFilterHead dropbtn3">Duration <span class="dFilterSubHead">in Nights</span> <span class="dFilterCount">1</span></div>
						<div id="duration" class="dropdown-content dropdown3">
							<?php
								$duration_data_less_than_7_nights=DB::table('rt_packages')
								->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '<=', 7]])
								->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '<=', 7]])
								->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '<=', 7]])
								->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '<=', 7]])
								->get();

								$duration_data_between_8_and_12=DB::table('rt_packages')
								->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1']])
								->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1']])
								->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1']])
								->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1']])
								->whereBetween('duration',[8,12])
								->get();

								$duration_data_greater_than_12=DB::table('rt_packages')
								->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '>=', 12]])
								->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '>=', 12]])
								->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '>=', 12]])
								->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['duration', '>=', 12]])
								->get();
							?>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox less_7_nights" name="duration" value="7">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>Less than 7 nights</div>
										<div>({{ count($duration_data_less_than_7_nights) }})</div>
									</div>
								</label>
							</div>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox bet_8to12" name="duration" value="8">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>8 to 12 nights</div>
										<div>({{ count($duration_data_between_8_and_12) }})</div>
									</div>
								</label>
							</div>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox more_12" name="duration" value="12">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>More than 12 nights</div>
										<div>({{ count($duration_data_greater_than_12) }})</div>
									</div>
								</label>
							</div>
						</div>
					</div> -->

					<!--Duration-->
					<div class="dropDown">
					    <div onclick="duration()" class="dFilterHead dropbtn3">
					        Duration <i class="dFilterSubHead">in Nights</i> <span class="dFilterCount">1</span>
					    </div>
					    <div id="duration" class="dropdown-content dropdown3">
					        <?php
					        $duration_data_less_than_7_nights = DB::table('rt_packages')
					            ->where(function ($query) use ($destination_search) {
					                $query->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '<=', 7]])
					                    ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '<=', 7]])
					                    ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '<=', 7]])
					                    ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '<=', 7]]);
					            })
					            ->get();

					        $duration_data_between_8_and_12 = DB::table('rt_packages')
					            ->where(function ($query) use ($destination_search) {
					                $query->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
					                    ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
					                    ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1']])
					                    ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1']]);
					            })
					            ->whereBetween('duration', [8, 12])
					            ->get();

					        $duration_data_greater_than_12 = DB::table('rt_packages')
					            ->where(function ($query) use ($destination_search) {
					                $query->where([['continent', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '>=', 12]])
					                    ->orWhere([['country', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '>=', 12]])
					                    ->orWhere([['state', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '>=', 12]])
					                    ->orWhere([['city', 'like', '%' . $destination_search . '%'], ['status', '=', '1'], ['duration', '>=', 12]]);
					            })
					            ->get();
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input 
					                    type="checkbox" 
					                    class="dropCheckBox less_7_nights" 
					                    name="duration" 
					                    value="7" 
					                    {{ $duration_data_less_than_7_nights->count() === 0 ? 'disabled' : '' }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>Less than 7 nights</div>
					                    <div>({{ $duration_data_less_than_7_nights->count() }})</div>
					                </div>
					            </label>
					        </div>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input 
					                    type="checkbox" 
					                    class="dropCheckBox bet_8to12" 
					                    name="duration" 
					                    value="8" 
					                    {{ $duration_data_between_8_and_12->count() === 0 ? 'disabled' : '' }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>8 to 12 nights</div>
					                    <div>({{ $duration_data_between_8_and_12->count() }})</div>
					                </div>
					            </label>
					        </div>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input 
					                    type="checkbox" 
					                    class="dropCheckBox more_12" 
					                    name="duration" 
					                    value="12" 
					                    {{ $duration_data_greater_than_12->count() === 0 ? 'disabled' : '' }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>More than 12 nights</div>
					                    <div>({{ $duration_data_greater_than_12->count() }})</div>
					                </div>
					            </label>
					        </div>
					    </div>
					</div>

					<!-- ----- -->

					<!--Travel Type-->
					<div class="dropDown">
					    <div id="package_type" onclick="travel_type()" class="dFilterHead dropbtn4">Travel Type <span class="dFilterCount">1</span></div>
					    <div id="travel_type" class="dropdown-content dropdown4">
					        <?php
					        // Extract unique transport types
					        $pac_transport = $data->pluck('transport')
					                              ->filter() // Removes null and empty values
					                              ->unique()
					                              ->reject(fn($transport) => $transport === "0");
					        ?>
					        @foreach($pac_transport as $package)
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_travel" name="chk_travel" value="{{ $package }}">
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>{{ $package }}</div>
					                </div>
					            </label>
					        </div>
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--Theme-->
					<div class="dropDown">
					    <div id="" onclick="theme()" class="dFilterHead dropbtn5">Theme <span class="dFilterCount">1</span></div>
					    <div id="theme" class="dropdown-content dropdown5">
					        <?php
					        // Extract unique package categories
					        $pac_theme = $data->pluck('package_category')
					                          ->map(fn($category) => unserialize($category)) // Unserialize each category
					                          ->flatten() // Flatten into a single collection
					                          ->filter() // Remove null and empty values
					                          ->unique(); // Get unique themes
					        ?>
					        @foreach($pac_theme as $package)
					        @if($package != "")
					        <?php
					        // Check if the current theme is the last URL segment
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($package) === $last) ? "checked" : "";

					        // Count the number of matching packages for the current theme
					        $theme_data = DB::table('rt_packages')
					                        ->where('package_category', 'like', '%' . $package . '%')
					                        ->where('status', 1)
					                        ->where(function ($query) use ($destination_search) {
					                            $query->where('continent', 'like', '%' . $destination_search . '%')
					                                  ->orWhere('country', 'like', '%' . $destination_search . '%')
					                                  ->orWhere('state', 'like', '%' . $destination_search . '%')
					                                  ->orWhere('city', 'like', '%' . $destination_search . '%');
					                        })
					                        ->count();
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_more" name="chk_more" value="{{ $package }}" {{ $checked }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>{{ $package }}</div>
					                    <div>({{ $theme_data }})</div>
					                </div>
					            </label>
					        </div>
					        @endif
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--Service Included-->
					<div class="dropDown">
					    <div onclick="service_included()" class="dFilterHead dropbtn6">
					        Services Included <span class="dFilterCount">1</span>
					    </div>
					    <div id="service_included" class="dropdown-content dropdown6">
					        <?php $included_services = []; ?>
					        
					        @foreach($data as $package)
					            <?php
					                // Validate and unserialize the package_service field
					                $service = is_string($package->package_service) ? @unserialize($package->package_service) : null;

					                if (is_array($service) && count($service) > 0) {
					                    $included_services = array_merge($included_services, $service);
					                }
					            ?>
					        @endforeach

					        <?php
					        // Remove duplicates
					        $included_services = array_unique($included_services);

					        // Filter icons based on included services
					        $inc_service_second = [];
					        foreach ($icons as $icon) {
					            if (in_array($icon->icon_title, $included_services)) {
					                $inc_service_second[] = $icon->icon_title;
					            }
					        }

					        // Get the last segment from the request
					        $segments = request()->segments(); // FIXED: Assign segments to a variable
					        $lastSegment = strtolower(end($segments)); // Safely call `end()` on the variable
					        ?>

					        @foreach($inc_service_second as $package)
					            @if(!empty($package))
					                <?php
					                // Check if the current package matches the URL segment
					                $checked = ($package === $lastSegment) ? "checked" : "";

					                // Fetch data for the package
					                $package_service_wise_data = DB::table('rt_packages')
					                    ->where([
					                        ['status', '=', '1'],
					                        ['package_service', 'like', '%' . $package . '%'],
					                    ])
					                    ->where(function ($query) use ($destination_search) {
					                        $query->orWhere('continent', 'like', '%' . $destination_search . '%')
					                            ->orWhere('country', 'like', '%' . $destination_search . '%')
					                            ->orWhere('state', 'like', '%' . $destination_search . '%')
					                            ->orWhere('city', 'like', '%' . $destination_search . '%');
					                    })
					                    ->get();
					                ?>
					                <div class="drop">
					                    <label class="dDropLabel">
					                        <input type="checkbox" class="dropCheckBox services_includes" name="services_includes" value="{{ $package }}" {{ $checked }}>
					                        <span class="dCheckMark"></span>
					                        <div class="fullWidth flexBetween">
					                            <div>{{ $package }}</div>
					                            <div>({{ count($package_service_wise_data) }})</div>
					                        </div>
					                    </label>
					                </div>
					            @endif
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--Suitable For-->
					<!-- <div class="dropDown">
						<div onclick="sutible_for()" class="dFilterHead dropbtn7">Suitable For <span class="dFilterCount">1</span></div>
						<div id="sutible_for" class="dropdown-content dropdown7">
							<?php $included_services=""; ?>
							@foreach($data as $package)
							<?php
								$service=unserialize($package->package_service);
								if(count($service)!="0"):
								foreach($service as $the) {
									$included_services.=$the.",";
									}
								endif;
							?>
							@endforeach
							<?php
								$inc_service=(explode(",", $included_services));
								$inc_service=array_unique($inc_service);
								$sutible_service_second[]="";
							?>
							@foreach($suitables as $icon)
							@if(in_array($icon->icon_title,$inc_service))
							<?php
								$sutible_service_second[]=$icon->icon_title;
							?>
							@endif
							@endforeach
							@foreach($sutible_service_second as $package)
							@if($package!="")
							<?php
								$segments = request()->segments();
								$last  = end($segments);
								if(strtolower($package)==$last):
									$checked="checked";
								else:
									$checked="";
								endif;
							?>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox sut_for" name="sut_for" value="{{ $package }}" {{ $checked }}>
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>{{ $package }}</div>
										<div></div>
									</div>
								</label>
							</div>
							@endif
							@endforeach
						</div>
					</div> -->

					<!--Suitable For-->
					<div class="dropDown">
					    <div onclick="sutible_for()" class="dFilterHead dropbtn7">Suitable For <span class="dFilterCount">1</span></div>
					    <div id="sutible_for" class="dropdown-content dropdown7">
					        <?php
					        // Extract and flatten all services from packages
					        $included_services = $data->pluck('package_service')
					                                  ->map(fn($service) => unserialize($service)) // Unserialize package services
					                                  ->flatten() // Flatten into a single collection
					                                  ->filter() // Remove null or empty values
					                                  ->unique(); // Get unique services

					        // Get suitable services from the icons list
					        $suitable_services = $suitables->pluck('icon_title')->intersect($included_services); // Get intersection of suitable services and included services
					        ?>
					        
					        @foreach($suitable_services as $service)
					        <?php
					        // Check if the service matches the last URL segment for checked state
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($service) === strtolower($last)) ? "checked" : "";
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox sut_for" name="sut_for" value="{{ $service }}" {{ $checked }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>{{ $service }}</div>
					                    <div></div>
					                </div>
					            </label>
					        </div>
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--General Tags-->
					<!-- <div class="dropDown">
						<div onclick="general_tags()" class="dFilterHead dropbtn8">General Tags <span class="dFilterCount">1</span></div>
						<div id="general_tags" class="dropdown-content dropdown8">
							<?php $included_services=""; ?>
							@foreach($data as $package)
							<?php
							$service=unserialize($package->package_service);

							if(count($service)!="0"):
							foreach($service as $the) {
							$included_services.=$the.",";
							}
							endif;
							?>
							@endforeach
							<?php
							$inc_service=(explode(",", $included_services));
							$inc_service=array_unique($inc_service);
							$generals_service_second[]="";
							?>
							@foreach($generals as $icon)
							@if(in_array($icon->icon_title,$inc_service))
							<?php 
							$generals_service_second[]=$icon->icon_title; 
							?>
							@endif
							@endforeach
							@foreach($generals_service_second as $package)
							@if($package!="")
							<?php 
								$segments = request()->segments();
								$last  = end($segments);
								if(strtolower($package)==$last):
								$checked="checked";
								else:
								$checked="";
								endif;
							?>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox gen_tags" name="gen_tags" value="{{ $package }}" {{$checked}}>
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>{{ $package }}</div>
										<div></div>
									</div>
								</label>
							</div>
							@endif
							@endforeach
						</div>
					</div> -->

					<!--General Tags-->
					<div class="dropDown">
					    <div onclick="general_tags()" class="dFilterHead dropbtn8">General Tags <span class="dFilterCount">1</span></div>
					    <div id="general_tags" class="dropdown-content dropdown8">
					        <?php
					        // Extract and flatten all services from packages
					        $included_services = $data->pluck('package_service')
					                                  ->map(fn($service) => unserialize($service)) // Unserialize package services
					                                  ->flatten() // Flatten into a single collection
					                                  ->filter() // Remove null or empty values
					                                  ->unique(); // Get unique services

					        // Get general services from the icons list
					        $general_services = $generals->pluck('icon_title')->intersect($included_services); // Get intersection of general services and included services
					        ?>
					        
					        @foreach($general_services as $service)
					        <?php
					        // Check if the service matches the last URL segment for checked state
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($service) === strtolower($last)) ? "checked" : "";
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox gen_tags" name="gen_tags" value="{{ $service }}" {{ $checked }}>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>{{ $service }}</div>
					                    <div></div>
					                </div>
					            </label>
					        </div>
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->

					<!--Star Rating-->
					<!-- <div class="dropDown">
						<div id="" onclick="guest_rate()" class="dFilterHead dropbtn9">Star Rating <span class="dFilterCount">1</span></div>
						<div id="guest_rate" class="dropdown-content dropdown9">
							<?php $guest_rating=""; ?>
							@foreach($data as $package)
							<?php $guest_rating.=$package->customer_rating.","; ?>
							@endforeach
							<?php
								$gue_rating=(explode(",", $guest_rating));
								rsort($gue_rating);
								$gue_rating=array_unique($gue_rating);
							?>
							@foreach($gue_rating as $package)
							@if($package!="0" && $package!="")

							<?php
							$guest_rating_wise_data=DB::table('rt_packages')
							->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['customer_rating', '=', $package ]])
							->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['customer_rating', '=', $package ]])
							->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['customer_rating', '=', $package ]])
							->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['customer_rating', '=', $package ]])
							->get();
							?>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox chk_gest" name="chk_gest" value="{{ $package }}">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>{{ $package }} &starf;</div>
										<div>({{ count($guest_rating_wise_data) }})</div>
									</div>
								</label>
							</div>
							@endif
							@endforeach
						</div>
					</div> -->

					<!--Star Rating-->
					<div class="dropDown">
					    <div id="" onclick="guest_rate()" class="dFilterHead dropbtn9">Star Rating <span class="dFilterCount">1</span></div>
					    <div id="guest_rate" class="dropdown-content dropdown9">
					        <?php
					        // Ensure that $data is a collection
					        $guest_ratings = collect($data)->pluck('customer_rating')->filter()->unique()->sortByDesc(function($rating) {
					            return $rating; // Sorting by rating in descending order
					        });
					        ?>

					        @foreach($guest_ratings as $rating)
					        <?php
					        // Get the count of packages matching the rating and destination search
					        $guest_rating_wise_data = DB::table('rt_packages')
					            ->where(function($query) use ($rating, $destination_search) {
					                $query->where('status', '=', 1)
					                      ->where('customer_rating', '=', $rating)
					                      ->where(function($q) use ($destination_search) {
					                          $q->where('continent', 'like', '%' . $destination_search . '%')
					                            ->orWhere('country', 'like', '%' . $destination_search . '%')
					                            ->orWhere('state', 'like', '%' . $destination_search . '%')
					                            ->orWhere('city', 'like', '%' . $destination_search . '%');
					                      });
					            })
					            ->count(); // Get the count directly from the database
					        ?>

					        @if($rating != 0) 
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_gest" name="chk_gest" value="{{ $rating }}">
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>{{ $rating }} &starf;</div>
					                    <div>({{ $guest_rating_wise_data }})</div>
					                </div>
					            </label>
					        </div>
					        @endif
					        @endforeach
					    </div>
					</div>

					<!-- ----- -->
				</div>
			</div>
		</div>
	</div>
	<!--Desktop Filter Ends-->

	<!--Desktop Sorting Starts-->
	<div class="dSortingCont">
		<div class="dPageContainer">
			<div class="flexBetween">
				<div class="dItemSearchBoxWrapper">
					<label for="search_item">Search by:</label>
					<input type="text" id="search_item" placeholder="Enter tour package name" />
				</div>
				<div class="dItemSortingWrapper ">
					<label for="sort_filter">Sorted by:</label>
					<div class="dSortingBox sortingArrow">
						<select id="sort_filter">
							<option value="SEL">Popular</option>
							<option value="PLH">Price - Low to High</option>
							<option value="PHL">Price - High to Low</option>
							<option value="DLH">Duration - Low to High</option>
							<option value="DHL">Duration - High to Low</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Desktop Sorting Ends-->