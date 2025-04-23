			<!--Mobile Filter Modal Starts-->
				<div id="mFilterModal" class="mFilterModalCont">
					<div class="mFilter_ModalContent">
						<div class="mFilter_Sticky">
							<div class="mFilter_Header">
								<h4>Filters</h4>
								<!--<button type="button" class="mFilter_Close" data-dismiss="modal">Close &#10006;</button>-->
								<span class="mFilter_Close" id="btn_close_mFilterModal">Close &#10006;</span>
							</div>
						</div>
						<!--Filter Modal body-->
						<div class="mFilter_ModalBody">
							<div class="mFilter_DescTag">Refine your search by cities, themes, duration or budget</div>
							<div>
								<!--Destination covered starts-->
								<!-- <div class="mFilter_ItemBox">
									<h4 id="place_covered" class="dropbtn1">Covered Places</h4>
									<div class="mFilter_ItemContent dropdown1">
										<?php $package_city=""; ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php
												$city=unserialize($package->city);
												foreach($city as $cit) {
													$package_city.=$cit.",";
													}
											?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										<?php
											$pac_city=(explode(",", $package_city));
											$pac_city=array_unique($pac_city);
										?>
										<?php $__currentLoopData = $pac_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<?php if($package!=""): ?>
												<?php
													$city_data=DB::table('rt_packages')
													->where([['city', 'like', '%' . $package . '%'],['status', '=', '1'],])
													->get();
												?>
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mdropCheckBox" name="chk_value" value="<?php echo e($package); ?>">
													<span class="mFilter_CheckMark"></span>
													<div class="fullWidth">
														<div><?php echo e($package); ?> <span class="mItemCount">(<?php echo e(count($city_data)); ?>)</span></div>
													</div>
												</label>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
								</div> -->

								<!-- covered places -->
								<div class="mFilter_ItemBox">
								    <h4 id="place_covered" class="dropbtn1">Covered Places</h4>
								    <div class="mFilter_ItemContent dropdown1">
								        <?php $package_cities = []; ?>
								        
								        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								            <?php
								                // Unserialize and merge all cities from the current package
								                $cities = unserialize($package->city);
								                $package_cities = array_merge($package_cities, $cities);
								            ?>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

								        <?php
								            // Remove duplicates from the merged cities list
								            $unique_cities = array_unique($package_cities);
								        ?>

								        <?php $__currentLoopData = $unique_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								            <?php if($city != ""): ?>
								                <?php
								                    // Fetch count of packages for each city in a single query
								                    $city_count = DB::table('rt_packages')
								                        ->where('city', 'like', '%' . $city . '%')
								                        ->where('status', '=', '1')
								                        ->count();
								                ?>
								                <label class="mFilter_DropLabel">
								                    <input type="checkbox" class="mdropCheckBox" name="chk_value" value="<?php echo e($city); ?>">
								                    <span class="mFilter_CheckMark"></span>
								                    <div class="fullWidth">
								                        <div><?php echo e($city); ?> <span class="mItemCount">(<?php echo e($city_count); ?>)</span></div>
								                    </div>
								                </label>
								            <?php endif; ?>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								    </div>
								</div>

								<!--Budget price starts-->
								<div class="mFilter_ItemBox">
									<h4>Budget <i class="mFilter_ItemSubHead">per person</i></h4>
									<div id="price" class="mFilter_ItemContent-budget dropdown2" style="display: block;">
										<div id="price-ranges_mobile" class="mbudgetSlider"></div>
										<!--<div id="price-ranges" class="drop"></div>-->
										<div class="mrangeSection">
											<span class="min-price-label"></span>
											<span class="max-price-label"></span>
										</div>
									</div>
								</div>

								<!--Duration starts-->
								<div class="mFilter_ItemBox">
									<h4 class="">Duration <span class="mFilter_ItemSubHead">in Nights</span></h4>
									<div id="duration" class="mFilter_ItemContent dropdown3">
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">Less than 7 nights
												</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="7">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>Less than 7 nights <span class="mItemCount"></span></div>
											</div>
										</label>
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel">
													<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">8 to 12 nights
												</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="8">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>8 to 12 nights <span class="mItemCount"></span></div>
											</div>
										</label>
										<!--<div class="mFilter_Drop">
											<div class="drop makeflex">
												<label class="mFilter_DropLabel"><input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">More than 12 Nights</label>
											</div>
										</div>-->
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="duration" value="12">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div>More than 12 Nights <span class="mItemCount"></span></div>
											</div>
										</label>
									</div>
								</div>

								<!--Travel Type starts-->
								<!-- <div class="mFilter_ItemBox">
									<h4 class="dropbtn4">Travel Type</h4>
									<div id="travel_type" class="mFilter_ItemContent dropdown4">
									<?php $package_transport=""; ?>
									<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php $package_transport.=$package->transport.","; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php
										$pac_transport=(explode(",", $package_transport));
										$pac_transport=array_unique($pac_transport);
									?>
									<?php $__currentLoopData = $pac_transport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
										<?php if($package!="0" && $package!=""): ?>
											<label class="mFilter_DropLabel">
												<input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="<?php echo e($package); ?>">
												<span class="mFilter_CheckMark"></span>
												<div class="fullWidth">
													<div><?php echo e($package); ?> <span class="mItemCount"></span></div>
												</div>
											</label>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
								</div> -->

								<!--Travel Type starts-->
								<div class="mFilter_ItemBox">
								    <h4 class="dropbtn4">Travel Type</h4>
								    <div id="travel_type" class="mFilter_ItemContent dropdown4">
								        <?php
								            // Collect all transport types from the packages
								            $transport_types = [];

								            // Collect transport data efficiently
								            foreach ($data as $package) {
								                $transport_types[] = $package->transport;
								            }

								            // Remove duplicates from the transport types list
								            $unique_transport_types = array_unique($transport_types);
								        ?>

								        <?php $__currentLoopData = $unique_transport_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transport): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								            <?php if($transport != "0" && $transport != ""): ?>
								                <?php
								                    // You may add logic here if you need a count of packages for each transport type.
								                    // For example:
								                    // $transport_count = DB::table('rt_packages')->where('transport', $transport)->count();
								                ?>
								                <label class="mFilter_DropLabel">
								                    <input type="checkbox" class="mFilter_DropCheckBox" name="chk_travel" value="<?php echo e($transport); ?>">
								                    <span class="mFilter_CheckMark"></span>
								                    <div class="fullWidth">
								                        <div><?php echo e($transport); ?> <span class="mItemCount"></span></div>
								                    </div>
								                </label>
								            <?php endif; ?>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								    </div>
								</div>

								<!--Theme starts-->
								<div class="mFilter_ItemBox">
								    <h4 class="dropbtn5">Theme</h4>
								    <div id="more" class="mFilter_ItemContent dropdown5">
								        <?php
								            // Collect all theme categories efficiently
								            $theme_categories = [];

								            // Collect theme categories from the packages
								            foreach ($data as $package) {
								                $themes = unserialize($package->package_category);
								                if (!empty($themes)) {
								                    $theme_categories = array_merge($theme_categories, $themes);
								                }
								            }

								            // Remove duplicates from the theme categories list
								            $unique_theme_categories = array_unique($theme_categories);
								        ?>

								        <?php $__currentLoopData = $unique_theme_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								            <?php if($theme != ""): ?>
								                <?php
								                    // Optionally, you can query the database to count the packages for each theme category:
								                    // $theme_count = DB::table('rt_packages')->where('package_category', 'like', '%'.$theme.'%')->count();
								                ?>
								                <label class="mFilter_DropLabel">
								                    <input type="checkbox" class="mFilter_DropCheckBox" name="chk_more" value="<?php echo e($theme); ?>">
								                    <span class="mFilter_CheckMark"></span>
								                    <div class="fullWidth">
								                        <div><?php echo e($theme); ?> <span class="mItemCount"></span></div>
								                    </div>
								                </label>
								            <?php endif; ?>
								        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								    </div>
								</div>


								<!--Guest Rating starts-->
								<!-- <div class="mFilter_ItemBox">
									<h4 class="dropbtn dropbtn6">Package Preferences</h4>
									<div id="guest_rate" class="mFilter_ItemContent dropdown6">
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
										<label class="mFilter_DropLabel">
											<input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="<?php echo e($package); ?>">
											<span class="mFilter_CheckMark"></span>
											<div class="fullWidth">
												<div><?php echo e($package); ?> Star<span class="mItemCount"></span></div>
											</div>
										</label>
										<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
								</div> -->

								<!--Guest Rating starts-->
								<div class="mFilter_ItemBox">
								    <h4 class="dropbtn dropbtn6">Package Preferences</h4>
								    <!--Guest Rating starts-->
									<div id="guest_rate" class="dropdown-content dropdown6">
									    <?php
									        // Ensure that $data is a collection and fetch unique customer ratings in descending order
									        $guest_ratings = collect($data)
									                        ->pluck('customer_rating')  // Extract customer ratings
									                        ->filter()                  // Remove empty values
									                        ->unique()                  // Get unique ratings
									                        ->sortByDesc(function($rating) {
									                            return $rating;  // Sorting by rating in descending order
									                        });
									    ?>

									    <?php $__currentLoopData = $guest_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
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
									                ->count();  // Get the count directly from the database
									        ?>

									        <?php if($rating != 0): ?>
									        <label class="mFilter_DropLabel">
									                    <input type="checkbox" class="mFilter_DropCheckBox" name="chk_gest" value="<?php echo e($rating); ?>">
									                    <span class="mFilter_CheckMark"></span>
									                    <div class="fullWidth">
									                        <div><?php echo e($rating); ?> Star <span class="mItemCount">(<?php echo e($guest_rating_wise_data); ?>)</span></div>
									                    </div>
									                </label>
									        <?php endif; ?>
									    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									</div>
								</div>

							</div>
						</div>
						<div class="fixedFooter">
							<div class="mFilter_Footer">
								<div class="mTourCount"><?php echo e(count($data)); ?><span class="font12">/<?php echo e(count($data)); ?></span> Tour Packages</div>
								<div>
									<!-- butoon reset -->
									<span id="refine_mobsearch"></span>
									<!-- <button type="button" class="btnFilterApply">Apply</button> -->
									<button type="button" class="btnFilterApply" data-dismiss="modal">Apply</button>
								</div>
							</div>
						</div>
					</div>
		    	</div>
		    	<!--Mobile Filter Modal Ends-->