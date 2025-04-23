	<!--Desktop Tour Item Starts-->
	<?php  
		$msg=""; 
	 ?>
	<section>
		<div class="dBackground">
			<div class="dPageContainer">
				<!--<div class="addClearfix tour-locations">-->
				<div class="dynamic_data">
					<?php if(count($data)!="0"): ?>
						<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							<input type="hidden" class="pack_id_list" name="pack_id_list[]"  value="<?php echo e($package->id); ?>">
							 <?php 
					            $country = is_array(unserialize($package->country)) ? unserialize($package->country) : [];
					            $city = is_array(unserialize($package->city)) ? unserialize($package->city) : [];
					            $continent = is_array(unserialize($package->continent)) ? unserialize($package->continent) : [];
					            $state = is_array(unserialize($package->state)) ? unserialize($package->state) : [];
					         ?>

					        <?php if(in_array($destination_search, $continent) 
					        	|| in_array($destination_search, $country) 
					        	|| in_array($destination_search, $state) 
					        	|| in_array($destination_search, $city)): ?>
								<!--Tour Item Starts-->
								<a href="<?php echo e(url('/holidays/'. str_slug($package->title) . '? package_id=' . CustomHelpers::custom_encrypt($package->id))); ?>" target="_blank">
									<div class="tourItmCont">
										<div class="tourItmLeftSec">
											<!-- <?php 
											    // Retrieve the first gallery ID associated with the package
											    $gallery_id = CustomHelpers::get_first_galleryid($package->id);

											    // Fetch the medium thumbnail image URL for the gallery ID
											    $image_url = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');
											 ?>

											<div class="tourImage_focusInOut pkg_search tourItmImgBox">
											    <?php if(!empty($image_url) && $image_url !== "0"): ?>
											        !-- Display the valid image --
											        <img src="<?php echo e($image_url); ?>" class="tourImage_zoom_image fade-in" alt="tourimg">
											    <?php else: ?>
											        !-- Display default image if no valid image is found --
											        <img src="<?php echo e(url('/frontend/images/default-img.webp')); ?>" class="fade-in" alt="noimage">
											    <?php endif; ?>
											</div> -->

											<?php 
											    // Retrieve the first gallery ID associated with the package
											    $gallery_id = CustomHelpers::get_first_galleryid($package->id);

											    // Fetch the medium thumbnail image URL for the gallery ID
											    $image_url = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');

											    // Convert the image URL to a relative file path for existence check
											    $relativePath = str_replace(url('public/'), '', $image_url);
											    $relativePath = str_replace(asset('/'), '', $relativePath);
											    $relativePath = ltrim($relativePath, '/');

											    // Get the full server file path
											    $imagePath = public_path($relativePath);

											    // Validate if the file exists, otherwise use the default image
											    $imageSrc = (!empty($image_url) && $image_url !== "0" && file_exists($imagePath)) 
											                ? $image_url 
											                : asset('frontend/images/default-img.webp');
											 ?>

											<div class="tourImage_focusInOut pkg_search tourItmImgBox">
											    <img src="<?php echo e($imageSrc); ?>" class="tourImage_zoom_image fade-in" alt="tourimg">
											</div>

											<div class="tourItmDescCont">
												<div class="tourItemTopSec">
												    <!-- Package Title -->
												    <div class="dTourTtlWrapper">
												        <h3><?php echo e($package->title); ?></h3>
												        
												        <!-- Star Rating -->
												        <div class="dHotel-star-rating">
												            <?php if(!empty($package->select_star_rating)): ?>
												                <?php 
												                    // Convert the star rating to a float for comparison
												                    $select_star_rating = (float)$package->select_star_rating;
												                 ?>

												                <!-- Display star icons based on the rating -->
												                <?php for($i = 1; $i <= $select_star_rating; $i++): ?>
												                    <div class="fa fa-star dStar_checked"></div>
												                <?php endfor; ?>
												            <?php endif; ?>
												        </div>
												    </div>

												    <!-- Package Duration -->
												    <h5>
												        <?php echo e($package->duration); ?> Nights / <?php echo e($package->duration + 1); ?> Days
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

												<!-- <div class="tourItemFooter">
													<h5>Included in this package</h5>
													<?php 
														$package_service=unserialize($package->package_service);
													 ?>
													<?php if(empty($package_service)): ?>
														<?php else: ?>
														<?php $count_package_service=count($package_service); ?>
														<?php
															$ico="";
															foreach ($icon_data as $icon_data1)
															{
															$ico.=$icon_data1->icon_title.",";
															}
															$ico1=array_unique(explode(",",$ico));
														?>
														<div class="makeflex">
															<?php for($i=0;$i<$count_package_service;$i++): ?>
																<?php if(in_array($package_service[$i], $ico1)): ?>
																	<?php if($i=="4"): ?>
																		<div class="dSvcIconCont">
																			<div class="dSvcIcon">
																				<img src="<?php echo e(url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))); ?>" title="<?php echo e(CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title')); ?>">
																			</div>
																			<div class="dSvcTtl"><?php echo e(CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title')); ?></div>
																		</div>
																		<?php else: ?>
																			<div class="dSvcIconCont">
																				<div class="dSvcIcon">
																					<img src="<?php echo e(url('/public/uploads/icons/'.CustomHelpers::getimagename($package_service[$i],'rt_icons','icon'))); ?>" title="<?php echo e(CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title')); ?>">
																				</div>
																				<div class="dSvcTtl"><?php echo e(CustomHelpers::getimagename($package_service[$i],'rt_icons','icon_title')); ?></div>
																			</div>
																	<?php endif; ?>
																	<?php else: ?>
																<?php endif; ?>
															<?php endfor; ?>
														</div>
													<?php endif; ?>
												</div> -->
												<div class="tourItemFooter">
												    <h5>Included in this package</h5>
												    <?php 
												        // Attempt to unserialize the package_service field to retrieve its data
												        //$package_service = @unserialize($package->package_service);
												        $package_service = is_string($package->package_service) ? unserialize($package->package_service) : [];
												     ?>

												    <!-- Check if package_service is not empty and is a valid array -->
												    <?php if(!empty($package_service) && is_array($package_service)): ?>
												        <?php 
												            // Extract unique icon titles from the icon_data array
												            $icon_titles = [];
												            foreach ($icon_data as $icon) {
												                $icon_titles[] = $icon->icon_title;
												            }
												            $unique_icons = array_unique($icon_titles);
												         ?>

												        <!-- Display the services included in the package -->
												        <div class="makeflex">
												        	<!-- Loop through each service in package_service -->
												            <?php $__currentLoopData = $package_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												            	<!-- Check if the current service is in the unique icons list -->
												                <?php if(in_array($service, $unique_icons)): ?>
												                	<!-- Display the icon for the service -->
												                    <div class="dSvcIconCont">
												                        <?php 
																		    $icon_name = CustomHelpers::getimagename($service, 'rt_icons', 'icon');
																		    $icon_title = CustomHelpers::getimagename($service, 'rt_icons', 'icon_title');
																		    $icon_path = public_path('uploads/icons/' . $icon_name);
																		    $icon_url = file_exists($icon_path) ? url('/public/uploads/icons/' . $icon_name) : url('/public/uploads/default-img.webp'); // Fallback image
																		 ?>

																		<div class="dSvcIcon">
																		    <img src="<?php echo e($icon_url); ?>" title="<?php echo e($icon_title); ?>">
																		</div>

												                        <!-- Display the title of the service -->
												                        <div class="dSvcTtl">
												                            <?php echo e(CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') ?: 'no-title'); ?>

												                        </div>
												                    </div>
												                <?php endif; ?>
												            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												        </div>
												    <?php endif; ?>
												</div>

												<!-- Guest Rating Section -->
												<!-- <?php 
												    // Retrieve the customer rating value from the package object
												    $customer_rating = $package->customer_rating;
												 ?>

												<div class="row" style="padding-top: 4px;">
												    !-- Label for Guest Rating --
												    <div class="col-md-3 col-sm-3 col-xs-4">
												        <span>Guest Rating</span>
												    </div>

												    !-- Star Rating Display --
												    <div class="col-md-9 col-sm-9 col-xs-6 customer_rating center_dt">
												        <?php 
												            $full_stars = floor($customer_rating); // Number of full stars
												            $half_star = $customer_rating - $full_stars >= 0.5; // Check for half star
												            $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0); // Remaining stars
												         ?>

												        !-- Render full stars --
												        <?php for($i = 0; $i < $full_stars; $i++): ?>
												            <img src="<?php echo e(url('/public/uploads/icons/star1.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
												        <?php endfor; ?>

												        !-- Render half star if applicable --
												        <?php if($half_star): ?>
												            <img src="<?php echo e(url('/public/uploads/icons/halfstar.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
												        <?php endif; ?>

												        !-- Render empty stars --
												        <?php for($i = 0; $i < $empty_stars; $i++): ?>
												            <img src="<?php echo e(url('/public/uploads/icons/star2.png')); ?>" title="<?php echo e($customer_rating); ?> Star">
												        <?php endfor; ?>
												    </div>
												</div> -->
											</div>
										</div>
										<div class="tourItmRightSec">
										    <!-- Holiday Type -->
										    <!-- <div class="dTourType"><?php echo e($package->tour_type); ?></div> -->
										    <div class="dTourType">
											    <?php echo e(in_array($package->tour_type, [null, 2]) ? 'Customized Tour' : 
											    	($package->tour_type == 1 ? 'Cruise Tour' : 
											    	($package->tour_type == 3 ? 'Group Tour' : $package->tour_type))); ?>

											</div>

										    <!-- Price Box Starts -->
										    <?php 
										        // Get the updated pricing data for the package
										        $new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d', strtotime($date)));
										     ?>

										    <?php if($new_price != 'na'): ?> 
										        <?php if($new_price['actual_price'] == $new_price['discount_price']): ?>
										            <!-- Price Box for No Discount -->
										            <div class="dItemPriceBoxTop">
										                <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
										                <p class="dItemPriceType">
										                    <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> 
										                    <?php echo e($package->Price_type); ?>

										                </p>
										            </div>
										        <?php else: ?>
										            <!-- Price Box with Discount -->
										            <div class="dItemPriceBoxTop">
										                <!-- Actual Price -->
										                <p class="dItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>

										                <!-- Discounted Price -->
										                <p class="dItemPriceType">
										                    <span class="dItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> 
										                    <?php echo e($package->Price_type); ?>

										                </p>

										                <!-- Price Sub-Tag -->
										                <p class="dItemPriceSubTag">*Excluding applicable taxes</p>

										                <!-- Discount Percentage -->
										                <?php 
										                    $tour_discount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
										                    $percentage = $tour_discount / $new_price['actual_price'] * 100;
										                 ?>
										                <span class="dItemOfferTag"><?php echo e(round($percentage)); ?>% Off</span>
										            </div>
										        <?php endif; ?>
										    <?php else: ?>
										        <!-- Price Box for On Request -->
										        <div class="dItemPriceBoxTop_onRequest">
										            <p class="dItemPriceType_OnRequest">On Request</p>
										        </div>
										    <?php endif; ?>
										    <!-- Price Box Ends -->

										    <!-- Button to View Details -->
										    <div class="dItemPriceBoxBottom">
										        <button type="button" class="btnViewItemDtl">View Details</button>
										    </div>
										</div>
									</div>
								</a>
								<!--Tour Item Ends-->
								<?php else: ?>
								<?php $msg=""; ?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				<!-- </div> -->
					<!--Tour Error Message-->
						<?php if($msg==""): ?>
							<!--<div class="" style="">
							<a href="#" class="button btn-large ">More Packages</a>  
							</div>-->
						<?php endif; ?>
					<?php else: ?>
						<div class="tourErrorMsgCont">
							<h3>Oops!</h3>
							<h4>No tour packages available, change your destination</h4>
							<!--<h4><?php echo e($msg); ?></h4>-->
						</div>
					<?php endif; ?>
				</div>
				<!--<div class="col-md-12 textCenter">
					<h1><?php echo e($msg); ?></h1>
				</div>-->

				<!--Tour Loader-->
				<div class="loader_scroll loaderCont">
					<!-- add more content mid_package_data in frontcontroller-->
				</div>

			</div>
		</div>
	</section>
	<!--Desktop Tour Item Ends-->