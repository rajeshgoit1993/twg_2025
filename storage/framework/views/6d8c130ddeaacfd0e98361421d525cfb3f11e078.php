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

					        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					            <?php
					            // Safely unserialize the city data
					            $city = is_string($package->city) ? @unserialize($package->city) : null;

					            if (is_array($city)) {
					                $package_city = array_merge($package_city, $city);
					            }
					            ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

					        <?php
					        // Remove duplicates
					        $package_city = array_unique($package_city);
					        ?>

					        <?php $__currentLoopData = $package_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					            <?php if(!empty($package)): ?>
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
					                        <input type="checkbox" class="dropCheckBox" name="chk_value" value="<?php echo e($package); ?>">
					                        <span class="dCheckMark"></span>
					                        <div class="fullWidth flexBetween">
					                            <div><?php echo e(CustomHelpers::get_master_table_data('city', 'id', $package, 'name')); ?></div>
					                            <span>(<?php echo e(count($city_data)); ?>)</span>
					                        </div>
					                    </label>
					                </div>
					            <?php endif; ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					        <div id="price-ranges" class="budgetSlider price-ranges"></div>
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
										<div>(<?php echo e(count($duration_data_less_than_7_nights)); ?>)</div>
									</div>
								</label>
							</div>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox bet_8to12" name="duration" value="8">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>8 to 12 nights</div>
										<div>(<?php echo e(count($duration_data_between_8_and_12)); ?>)</div>
									</div>
								</label>
							</div>
							<div class="drop">
								<label class="dDropLabel">
									<input type="checkbox" class="dropCheckBox more_12" name="duration" value="12">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div>More than 12 nights</div>
										<div>(<?php echo e(count($duration_data_greater_than_12)); ?>)</div>
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
					   $data_seven_nights =  DB::table('rt_packages')
					  ->where([['status', '=', '1'], ['duration', '<=', 7]])->get();
			$duration_data_less_than_7_nights = CustomHelpers::get_filtered_packages($data_seven_nights,$destination_search);	 

					       

  $data_8_and_12 =  DB::table('rt_packages')
					  ->where([['status', '=', '1']])->whereBetween('duration', [8, 12])->get();
			$duration_data_between_8_and_12 = CustomHelpers::get_filtered_packages($data_8_and_12,$destination_search);

			 $data_more_12 =  DB::table('rt_packages')
					  ->where([['status', '=', '1'],['duration', '>=', 12]])->get();
			$duration_data_greater_than_12 = CustomHelpers::get_filtered_packages($data_more_12,$destination_search);

					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input 
					                    type="checkbox" 
					                    class="dropCheckBox less_7_nights" 
					                    name="duration" 
					                    value="7" 
					                    <?php echo e($duration_data_less_than_7_nights[0]->count() === 0 ? 'disabled' : ''); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>Less than 7 nights</div>
					                    <div>(<?php echo e($duration_data_less_than_7_nights[0]->count()); ?>)</div>
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
					                    <?php echo e($duration_data_between_8_and_12[0]->count() === 0 ? 'disabled' : ''); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>8 to 12 nights</div>
					                    <div>(<?php echo e($duration_data_between_8_and_12[0]->count()); ?>)</div>
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
					                    <?php echo e($duration_data_greater_than_12[0]->count() === 0 ? 'disabled' : ''); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div>More than 12 nights</div>
					                    <div>(<?php echo e($duration_data_greater_than_12[0]->count()); ?>)</div>
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
					        <?php $__currentLoopData = $pac_transport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_travel" name="chk_travel" value="<?php echo e($package); ?>">
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div><?php echo e($package); ?></div>
					                </div>
					            </label>
					        </div>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					        <?php $__currentLoopData = $pac_theme; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					        <?php if($package != ""): ?>
					        <?php
					        // Check if the current theme is the last URL segment
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($package) === $last) ? "checked" : "";

					        

					          $data_packages =  DB::table('rt_packages')
					  ->where([['status', '=', '1'],['package_category', 'like', '%' . $package . '%']])->get();
			$theme_data = CustomHelpers::get_filtered_packages($data_packages,$destination_search)[0]->count();
			               
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_more" name="chk_more" value="<?php echo e($package); ?>" <?php echo e($checked); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div><?php echo e($package); ?></div>
					                    <div>(<?php echo e($theme_data); ?>)</div>
					                </div>
					            </label>
					        </div>
					        <?php endif; ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					        
					        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					            <?php
					                // Validate and unserialize the package_service field
					                $service = is_string($package->package_service) ? @unserialize($package->package_service) : null;

					                if (is_array($service) && count($service) > 0) {
					                    $included_services = array_merge($included_services, $service);
					                }
					            ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

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

					        <?php $__currentLoopData = $inc_service_second; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					            <?php if(!empty($package)): ?>
					                <?php
					                // Check if the current package matches the URL segment
					                $checked = ($package === $lastSegment) ? "checked" : "";

					               

					                     $data_package_service =  DB::table('rt_packages')->where([['status', '=', '1'],['package_service', 'like', '%' . $package . '%'],
					                    ])->get();
			$package_service_wise_data = CustomHelpers::get_filtered_packages($data_package_service,$destination_search)[0];
			               

					                ?>
					                <div class="drop">
					                    <label class="dDropLabel">
					                        <input type="checkbox" class="dropCheckBox services_includes" name="services_includes" value="<?php echo e($package); ?>" <?php echo e($checked); ?>>
					                        <span class="dCheckMark"></span>
					                        <div class="fullWidth flexBetween">
					                            <div><?php echo e($package); ?></div>
					                            <div>(<?php echo e(count($package_service_wise_data)); ?>)</div>
					                        </div>
					                    </label>
					                </div>
					            <?php endif; ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					    </div>
					</div>

					<!-- ----- -->

					<!--Suitable For-->
					<!-- <div class="dropDown">
						<div onclick="sutible_for()" class="dFilterHead dropbtn7">Suitable For <span class="dFilterCount">1</span></div>
						<div id="sutible_for" class="dropdown-content dropdown7">
							<?php $included_services=""; ?>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php
								$service=unserialize($package->package_service);
								if(count($service)!="0"):
								foreach($service as $the) {
									$included_services.=$the.",";
									}
								endif;
							?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php
								$inc_service=(explode(",", $included_services));
								$inc_service=array_unique($inc_service);
								$sutible_service_second[]="";
							?>
							<?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if(in_array($icon->icon_title,$inc_service)): ?>
							<?php
								$sutible_service_second[]=$icon->icon_title;
							?>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php $__currentLoopData = $sutible_service_second; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if($package!=""): ?>
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
									<input type="checkbox" class="dropCheckBox sut_for" name="sut_for" value="<?php echo e($package); ?>" <?php echo e($checked); ?>>
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div><?php echo e($package); ?></div>
										<div></div>
									</div>
								</label>
							</div>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					        
					        <?php $__currentLoopData = $suitable_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					        <?php
					        // Check if the service matches the last URL segment for checked state
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($service) === strtolower($last)) ? "checked" : "";
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox sut_for" name="sut_for" value="<?php echo e($service); ?>" <?php echo e($checked); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div><?php echo e($service); ?></div>
					                    <div></div>
					                </div>
					            </label>
					        </div>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					    </div>
					</div>

					<!-- ----- -->

					<!--General Tags-->
					<!-- <div class="dropDown">
						<div onclick="general_tags()" class="dFilterHead dropbtn8">General Tags <span class="dFilterCount">1</span></div>
						<div id="general_tags" class="dropdown-content dropdown8">
							<?php $included_services=""; ?>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php
							$service=unserialize($package->package_service);

							if(count($service)!="0"):
							foreach($service as $the) {
							$included_services.=$the.",";
							}
							endif;
							?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php
							$inc_service=(explode(",", $included_services));
							$inc_service=array_unique($inc_service);
							$generals_service_second[]="";
							?>
							<?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if(in_array($icon->icon_title,$inc_service)): ?>
							<?php 
							$generals_service_second[]=$icon->icon_title; 
							?>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php $__currentLoopData = $generals_service_second; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if($package!=""): ?>
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
									<input type="checkbox" class="dropCheckBox gen_tags" name="gen_tags" value="<?php echo e($package); ?>" <?php echo e($checked); ?>>
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div><?php echo e($package); ?></div>
										<div></div>
									</div>
								</label>
							</div>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					        
					        <?php $__currentLoopData = $general_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					        <?php
					        // Check if the service matches the last URL segment for checked state
					        $segments = request()->segments();
					        $last = end($segments);
					        $checked = (strtolower($service) === strtolower($last)) ? "checked" : "";
					        ?>
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox gen_tags" name="gen_tags" value="<?php echo e($service); ?>" <?php echo e($checked); ?>>
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div><?php echo e($service); ?></div>
					                    <div></div>
					                </div>
					            </label>
					        </div>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					    </div>
					</div>

					<!-- ----- -->

					<!--Star Rating-->
					<!-- <div class="dropDown">
						<div id="" onclick="guest_rate()" class="dFilterHead dropbtn9">Star Rating <span class="dFilterCount">1</span></div>
						<div id="guest_rate" class="dropdown-content dropdown9">
							<?php $guest_rating=""; ?>
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php $guest_rating.=$package->customer_rating.","; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php
								$gue_rating=(explode(",", $guest_rating));
								rsort($gue_rating);
								$gue_rating=array_unique($gue_rating);
							?>
							<?php $__currentLoopData = $gue_rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<?php if($package!="0" && $package!=""): ?>

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
									<input type="checkbox" class="dropCheckBox chk_gest" name="chk_gest" value="<?php echo e($package); ?>">
									<span class="dCheckMark"></span>
									<div class="fullWidth flexBetween">
										<div><?php echo e($package); ?> &starf;</div>
										<div>(<?php echo e(count($guest_rating_wise_data)); ?>)</div>
									</div>
								</label>
							</div>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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

					        <?php $__currentLoopData = $guest_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					        <?php
					        // Get the count of packages matching the rating and destination search


					 $data_guest_rating =  DB::table('rt_packages')->where([['status', '=', '1'],['customer_rating', '=', $rating],
					                    ])->get();
			$guest_rating_wise_data = CustomHelpers::get_filtered_packages($data_guest_rating,$destination_search)[0]->count(); 


					        ?>

					        <?php if($rating != 0): ?> 
					        <div class="drop">
					            <label class="dDropLabel">
					                <input type="checkbox" class="dropCheckBox chk_gest" name="chk_gest" value="<?php echo e($rating); ?>">
					                <span class="dCheckMark"></span>
					                <div class="fullWidth flexBetween">
					                    <div><?php echo e($rating); ?> &starf;</div>
					                    <div>(<?php echo e($guest_rating_wise_data); ?>)</div>
					                </div>
					            </label>
					        </div>
					        <?php endif; ?>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					    </div>
					</div>

					<!-- ----- -->
				</div>
			</div>
		</div>
	</div>
	<!--Desktop Filter Ends-->
<style type="text/css">
	.select2-selection__rendered {
     width: 300px !important; 
}
.dItemSearchBoxWrapper .select2-container--default .select2-selection--single .select2-selection__rendered 
{
color: black !important;
}
   .dItemSearchBoxWrapper .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: black !important;
    }
</style>
	<!--Desktop Sorting Starts-->
	<div class="dSortingCont">
		<div class="dPageContainer">
			<div class="flexBetween">
				<div class="dItemSearchBoxWrapper">

					<div class="dSearchModifyBox tourCityBox_update pointer" onclick="let sel = this.querySelector('select'); sel.focus(); if ($(sel).data('select2')) { $(sel).select2('open'); }">
						    <label for="search_item">Search by</label>
						    <select class="search_package" id="search_item" name="search_item" required>
						       
						    </select>
						</div>
<!-- <label for="search_item">Search by:</label>

					 <select class="search_package" id="search_item" name="destination_search" required -->
					
						       
						    </select>

					<!-- <input type="text" id="" placeholder="Enter tour package name" /> -->
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