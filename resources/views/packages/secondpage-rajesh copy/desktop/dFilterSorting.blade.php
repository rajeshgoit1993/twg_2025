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
						<div id="place_covered" onclick="myFunction()" class="dFilterHead dropbtn1">Covered Places <span class="dFilterCount">1</span></div>
					</div>
					<div id="myDropdown" class="dropdown-content dropdown1">
						<?php $package_city=""; ?>
						@foreach($data as $package)
							<?php
								$city=unserialize($package->city);
								foreach($city as $cit) {
								$package_city.=$cit.",";
								}
							?>
							@endforeach
							<?php
								$pac_city=(explode(",", $package_city));
								$pac_city=array_unique($pac_city);
							?>
							@foreach($pac_city as $package)
							@if($package!="")
							
							<div class="drop">
								<?php
									$city_data=DB::table('rt_packages')
									->where([['city', 'like', '%' . $package . '%'],['status', '=', '1'],])
									->pluck('id')->toArray();
							$city_count_data=array_intersect($data_ids,$city_data);
									
								?>
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox" name="chk_value" value="{{ $package }}">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>{{ $package }}</div>
										<span>({{ count($city_count_data) }})</span>
									</div>
								</label>
							</div>
							
							@endif
						@endforeach
					</div>
				</div>
				<!--Price Range-->
				<div class="dropDown">
					<div onclick="price()" class="dFilterHead dropbtn2">Budget <i class="dFilterSubHead">per person</i> <span class="dFilterCount">1</span></div>
					<div id="price" class="dropdown-content dropdown2" style="min-width: 190px;">
						<div id="price-ranges" class="budgetSlider"></div>
						<div class="rangeSection">
							<span class="min-price-label"></span>
							<!--<span>&#8212;</span>-->
							<span class="max-price-label"></span>
						</div>
					</div>
				</div>
				<!--Duration-->
				<div class="dropDown">
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
				</div>
				<!--Travel Type-->
				<div class="dropDown">
					<div id="package_type" onclick="travel_type()" class="dFilterHead dropbtn4">Travel Type <span class="dFilterCount">1</span></div>
					<div id="travel_type" class="dropdown-content dropdown4">
					<?php $package_transport=""; ?>
					@foreach($data as $package)
						<?php $package_transport.=$package->transport.","; ?>
					@endforeach
					<?php
						$pac_transport=(explode(",", $package_transport));
						$pac_transport=array_unique($pac_transport);
					?>
					@foreach($pac_transport as $package)
					@if($package!="0" && $package!="")
						<div class="drop">
							<label class="dDropLabel">
								<input type="checkbox" class="dropCheckBox chk_travel" name="chk_travel"  value="{{ $package }}">
								<span class="dCheckMark"></span>
								<div class="fullWidth flexBetween">
									<div>{{ $package }}</div>
									<!--<div></div>-->
								</div>
							</label>
						</div>
					@endif
					@endforeach
					</div>
				</div>
				<!--Theme-->
				<div class="dropDown">
					<div id="" onclick="more()" class="dFilterHead dropbtn5">Theme <span class="dFilterCount">1</span></div>
					<div id="more" class="dropdown-content dropdown5">
					<?php $package_theme=""; ?>
					@foreach($data as $package)
						<?php
							$theme=unserialize($package->package_category);
							if(count($theme)!="0"):
							foreach($theme as $the) {
							$package_theme.=$the.",";
							}
							endif;
						?>
					@endforeach
					<?php
						$pac_theme=(explode(",", $package_theme));
						$pac_theme=array_unique($pac_theme);
						?>
					@foreach($pac_theme as $package)
					@if($package!="")
					<?php
						$segments = request()->segments();
						$last  = end($segments);
						if(strtolower($package)==$last):
							$checked="checked";
						else:
							$checked="";
						endif;
						$theme_data=DB::table('rt_packages')
						->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $package . '%']])
						->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $package . '%']])
						->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $package . '%']])
						->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_category', 'like', '%' . $package . '%']])
						->get();
						?>
						<div class="drop">
							<label class="dDropLabel">
								<input type="checkbox" class="dropCheckBox chk_more" name="chk_more"  value="{{ $package }}">
								<span class="dCheckMark"></span>
								<div class="fullWidth flexBetween">
									<div>{{ $package }}</div>
									<div>({{ count($theme_data) }})</div>
								</div>
							</label>
						</div>
					@endif
					@endforeach
					</div>
				</div>
				<!--Service Included-->
				<div class="dropDown">
					<div onclick="service_included()" class="dFilterHead dropbtn_1">Services Included <span class="dFilterCount">1</span></div>
					<div id="service_included" class="dropdown-content dropdown_1">
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
						$inc_service_second[]="";
					?>
					@foreach($icons as $icon)
					@if(in_array($icon->icon_title,$inc_service))
					<?php
						$inc_service_second[]=$icon->icon_title; 
					?>
					@endif
					@endforeach
					@foreach($inc_service_second as $package)
					@if($package!="")
					<?php
						$segments = request()->segments();
						$last  = end($segments);
						if(strtolower($package)==$last):
							$checked="checked";
						else:
							$checked="";
						endif;
						$package_service_wise_data=DB::table('rt_packages')
						->where([['continent', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_service', 'like', '%' . $package . '%']])
						->orWhere([['country', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_service', 'like', '%' . $package . '%']])
						->orWhere([['state', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_service', 'like', '%' . $package . '%']])
						->orWhere([['city', 'like', '%' . $destination_search . '%'],['status', '=', '1'],['package_service', 'like', '%' . $package . '%']])
						->get();
						?>
					<div class="drop">
						<label class="dDropLabel">
							<input type="checkbox" class="dropCheckBox services_includes" name="services_includes" value="{{ $package }}">
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
				<!--Suitable For-->
				<div class="dropDown">
					<div onclick="sutible_for()" class="dFilterHead dropbtn_2">Suitable For <span class="dFilterCount">1</span></div>
					<div id="sutible_for" class="dropdown-content dropdown_2">
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
				</div>
				<!--General Tags-->
				<div class="dropDown">
					<div onclick="general_tags()" class="dFilterHead dropbtn_3">General Tags <span class="dFilterCount">1</span></div>
					<div id="general_tags" class="dropdown-content dropdown_3">
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
				</div>
				<!--Star Rating-->
				<div class="dropDown">
					<div id="" onclick="guest_rate()" class="dFilterHead dropbtn6">Star Rating <span class="dFilterCount">1</span></div>
					<div id="guest_rate" class="dropdown-content dropdown6">
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
				</div>
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