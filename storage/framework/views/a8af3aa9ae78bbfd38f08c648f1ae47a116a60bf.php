		<!--Mobile Tour Item Card Starts-->
		<?php  
			$msg=""; 
		 ?>
		<section>
			<div class="mBG">
				<div class="mPageCont">
				<div id="main">
					<!--<div class="row add-clearfix image-box style1 tour-locations">-->
					<div class="dynamic_data">                  
						<?php if(count($data)!="0"): ?>
							<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<input type="hidden" class="pack_id_list" name="pack_id_list[]" value="<?php echo e($package->id); ?>">
								<?php 
						            $country = is_array(unserialize($package->country)) ? unserialize($package->country) : [];
						            $city = is_array(unserialize($package->city)) ? unserialize($package->city) : [];
						            $continent = is_array(unserialize($package->continent)) ? unserialize($package->continent) : [];
						            $state = is_array(unserialize($package->state)) ? unserialize($package->state) : [];
						         ?>
								

									<!--Mobile View-->
									<a href="<?php echo e(url('/holidays/'.str_slug($package->title).'?package_id='.CustomHelpers::custom_encrypt($package->id))); ?>" class="pkg_search">
										<div class="mTourItmCont">
											<div class="tourItmLeftSec">
												<div class="mTourItmImgBox">
												    <!-- <?php 
												    	// Retrieve the first gallery ID associated with the package
												    	$gallery_id = CustomHelpers::get_first_galleryid($package->id);

												    	// Fetch the medium thumbnail image for the gallery ID
												    	$image_url = CustomHelpers::get_image_gallery($gallery_id, 'thum_medium');
												     ?>

												    <?php if(!empty($image_url) && $image_url !== "0"): ?>
											        !-- Display the valid image --
											        <img src="<?php echo e($image_url); ?>" class="tourImage_zoom_image fade-in" alt="tourimg">
											    	<?php else: ?>
											        !-- Display default image if no valid image is found --
											        <img src="<?php echo e(url('/frontend/images/default-image.png')); ?>" class="fade-in" alt="noimage">
											    	<?php endif; ?> -->

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
												</div>
											</div>

											<div class="tourItmRightSec">
												<div class="mTourItmDescCont">
													<!--<div class="mTourItmDescCont details">-->
													<div class="mDaysBadgeTop">
														<?php echo e($package->duration); ?>N / <?php echo e($package->duration + 1); ?>D
													</div>

													<div class="mTourItemTopSec">
													    <!-- Package Title Section -->
													    <div class="mTourTtlWrapper">
													        <!-- Package Title with Tooltip -->
													        <h3 title="<?php echo e($package->title); ?>"><?php echo e($package->title); ?></h3>

													        <!-- Star Rating -->
													        <div class="mHotel-star-rating">
													            <?php if(!empty($package->select_star_rating)): ?>
													                <?php 
													                    // Convert star rating to float for processing
													                    $select_star_rating = (float)$package->select_star_rating;
													                 ?>

													                <!-- Display checked stars based on the rating -->
													                <?php for($i = 1; $i <= $select_star_rating; $i++): ?>
													                    <div class="fa fa-star mStart_checked"></div>
													                <?php endfor; ?>
													            <?php endif; ?>
													        </div>

													        <!-- Holiday Type -->
													        <div class="mTourType">
													        	<?php echo e(in_array($package->tour_type, [null, 2]) ? 'Customized Tour' : 
													        		($package->tour_type == 1 ? 'Cruise Tour' : 
													        		($package->tour_type == 3 ? 'Group Tour' : $package->tour_type))); ?>

													        </div>
													    </div>
													</div>

													<!-- duration city wise -->
													<div class="mcity_nights">
														<p>
															<!-- <?php
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
															?> -->

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
																        echo "<span class='itemDestName'>" . 

CustomHelpers::get_master_table_data('city', 'id', htmlspecialchars($city1[$row]), 'name')

																         . "</span>";

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
													    <?php 
													        // Attempt to unserialize the package_service field to retrieve its data
													        $package_service = @unserialize($package->package_service);
													     ?>

													    <!-- Check if package_service is not empty and is a valid array -->
													    <?php if(!empty($package_service) && is_array($package_service)): ?>
													        <?php 
													            // Extract unique icon titles from the icon_data array
													            $icon_titles = [];
													            foreach ($icon_data as $icon) {
													                $icon_titles[] = $icon->icon_title; // Collect all icon titles
													            }
													            $unique_icons = array_unique($icon_titles); // Remove duplicate icon titles
													         ?>

													        <!-- Display the services included in the package -->
													        <div class="mobscroll scrollX">
													            <div class="makeflex">
													                <!-- Loop through each service in package_service -->
													                <?php $__currentLoopData = $package_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
													                    <!-- Check if the current service is in the unique icons list -->
													                    <?php if(in_array($service, $unique_icons)): ?>
													                        <!-- <div class="mSvcIconCont">
													                            !-- Display the icon for the service --
													                            <div class="mSvcIcon">
													                                <img src="<?php echo e(url('/public/uploads/icons/' . CustomHelpers::getimagename($service, 'rt_icons', 'icon'))); ?>" 
													                                     title="<?php echo e(CustomHelpers::getimagename($service, 'rt_icons', 'icon_title')); ?>">
													                            </div>
													                            !-- Display the title of the service --
													                            <div class="mSvcTtl">
													                                <?php echo e(CustomHelpers::getimagename($service, 'rt_icons', 'icon_title')); ?>

													                            </div>
													                        </div> -->

													                        <div class="mSvcIconCont">
														                        <?php 
																				    $icon_name = CustomHelpers::getimagename($service, 'rt_icons', 'icon');
																				    $icon_title = CustomHelpers::getimagename($service, 'rt_icons', 'icon_title');
																				    $icon_path = public_path('uploads/icons/' . $icon_name);
																				    $icon_url = file_exists($icon_path) ? url('/public/uploads/icons/' . $icon_name) : url('/public/uploads/default-img.webp'); // Fallback image
																				 ?>

																				<div class="mSvcIcon">
																				    <img src="<?php echo e($icon_url); ?>" title="<?php echo e($icon_title); ?>">
																				</div>

														                        <!-- Display the title of the service -->
														                        <div class="mSvcTtl">
														                            <?php echo e(CustomHelpers::getimagename($service, 'rt_icons', 'icon_title') ?: 'no-title'); ?>

														                        </div>
														                    </div>
													                    <?php endif; ?>
													                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
													            </div>
													        </div>
													    <?php endif; ?>
														
														<div class="mTourItemPriceBox">
														    <!-- Tour Price Title -->
														    <div class="mTourPriceWrapper">
														        <h4 title="<?php echo e($package->title); ?>">Starting Tour Price</h4>
														        <!-- Uncomment below if needed for duration -->
														        <!-- <div class="mDaysBadge"><?php echo e($package->duration); ?>N / <?php echo e($package->duration + 1); ?>D</div> -->
														    </div>

														    <!-- Price Box Starts -->
														    <?php 
														        // Fetch updated pricing data for the package
														        $new_price = PackagePriceHelpers::get_new_pricing_data($package->id, date('Y-m-d', strtotime($date)));
														     ?>

														    <?php if($new_price != 'na'): ?>
														        <?php if($new_price['actual_price'] == $new_price['discount_price']): ?>
														            <!-- Price Box for No Discount -->
														            <div class="mItemPriceBoxTop">
														                <p class="mItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>
														                <p class="mItemPriceType">
														                    <span class="mItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> 
														                     
<?php echo e(PackagePriceHelpers::get_price_type($package->Price_type)); ?>

														                </p>
														            </div>
														        <?php else: ?>
														            <!-- Price Box with Discount -->
														            <div class="mItemPriceBoxTop">
														                <!-- Actual Price -->
														                <p class="mItemAcutalPrice defaultCurrency"><?php echo e($new_price['actual_price']); ?></p>

														                <!-- Discounted Price -->
														                <p class="mItemPriceType">
														                    <span class="mItemOfferPrice defaultCurrency"><?php echo e($new_price['discount_price']); ?></span> 
														                     
<?php echo e(PackagePriceHelpers::get_price_type($package->Price_type)); ?>

														                </p>

														                <!-- Price Sub-Tag -->
														                <p class="mItemPriceSubTag">*Excluding applicable taxes</p>

														                <!-- Discount Percentage -->
														                <?php 
														                    $tour_discount = (int)$new_price['actual_price'] - (int)$new_price['discount_price'];
														                    $percentage = ($tour_discount / $new_price['actual_price']) * 100;
														                 ?>
														                <span class="dItemOfferTag"><?php echo e(round($percentage)); ?>% Off</span>
														            </div>
														        <?php endif; ?>
														    <?php else: ?>
														        <!-- Price Box for On Request -->
														        <div class="mItemPriceBoxTop_onRequest">
														            <p class="mItemPriceType_OnRequest">On Request</p>
														        </div>
														    <?php endif; ?>
														    <!-- Price Box Ends -->
														</div>													
														
														<div class="viewItemCont">
															<button type="button" class="mBtnViewDtls">View Details</button>
														</div>
													</div>
												</div>
												</div>
										</div>
									</a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</div>
							<!--Tour Error Message-->
							<?php if($msg == ""): ?>
							    <!--<div class="" style="">
							    <a href="#" class="button btn-large ">More Packages</a>  
							    </div>-->
							<?php else: ?>
							    <div class="tourErrorMsgCont">
							        <h3>Oops!</h3>
							        <h4>No tour packages available, change your destination</h4>
							        <!--<h4><?php echo e($msg); ?></h4>-->
							    </div>
							<?php endif; ?>  <!-- Ensure <?php endif; ?> is present! -->
						<!--Tour Loader-->
						<div class="loader_scroll loaderCont"></div>
				</div>
				</div>
			</div>
		</section>
		<!--Mobile Tour Item Card Ends-->