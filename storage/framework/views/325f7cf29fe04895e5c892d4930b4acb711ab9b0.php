									<!--Desktop Tour Tabs-Accommodation Starts-->
									<div class="dTourPkgDesc">
										<?php if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc"): ?>
										<div class="dTourHtlCont">
											<h2>Tour Accommodation</h2>
												<?php if($details->acc_type == "normal_acc"): ?>
												    <?php 
												        $acco = unserialize($details->accommodation);
												        $i = "1";
												     ?>

												    <?php $__currentLoopData = $acco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acco_data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												        <?php if(array_key_exists('city', $acco_data)): ?>
												            <?php if($i == "1"): ?>
												                <div class="collapsible-container">
												                    <div class="collapsible-item dItem-box dItem-arrow active" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
												                        <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;<?php echo e($acco_data['city']); ?>

												                    </div>
												                    <div class="collapsible-item-content" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>" style="display: block; max-height: inherit;">
												                        <div class="dHtlCont">
																			<div class="dHtlBox">
																				<div class="makeflex">
																					<!--Hotel Image-->
																					<div class="dHtlImgBox">
																					    <?php if(!empty($acco_data['hotel']) && $acco_data['hotel'] !== 'other'): ?>
																					        <?php 
																					            $hotelImage = CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image');
																					         ?>

																					        <?php if($hotelImage && file_exists(public_path("uploads/package_hotel/{$hotelImage}"))): ?>
																					            <img src="<?php echo e(asset('public/uploads/package_hotel/'.$hotelImage)); ?>" alt="Hotel-Image">
																					        <?php else: ?>
																					            <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
																					        <?php endif; ?>
																					    <?php else: ?>
																					        <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
																					    <?php endif; ?>
																					</div>

																					<!--Hotel Description-->
																					<div class="dHtlDesc">
																						<div class="dhotelTopSection">
																							<div class="dHotelType">
																								<?php if(array_key_exists("propertytype", $acco_data) && !is_null($acco_data["propertytype"])): ?>
																							        <?php echo e($acco_data["propertytype"]); ?>

																							    <?php else: ?>
																							        Hotel
																							    <?php endif; ?>
																							</div>
																								<div class="flexCenter">
																									<div class="dHtlName">
																										<h4>
																											<?php if(array_key_exists("hotel",$acco_data)): ?>
																												<?php if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other"): ?>
																													<?php echo e(CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')); ?>

																												<?php elseif($acco_data["hotel"]=="other"): ?>
																													<?php echo e($acco_data["other_hotel"]); ?>

																												<?php endif; ?> 
																											<?php endif; ?>
																										</h4>
																									</div>
																									<div class="dHtlDescription">
																										<span class="dHtlStarRating" >
																											<?php if(array_key_exists("star",$acco_data)): ?>
																												<?php if($acco_data["star"]!="" && $acco_data["star"]!="other"): ?>
																													<?php echo e(CustomHelpers::get_star_rating($acco_data["star"])); ?>

																												<?php elseif($acco_data["star"]=="other"): ?>
																													<?php echo e(CustomHelpers::get_star_rating($acco_data["star_other"])); ?>

																												<?php endif; ?>
																											<?php endif; ?>
																										</span>
																									</div>
																								</div>
																								<!--City Name starts-->
																								<div class="dCityCont">
																									<?php
																										$day1="0";
																										$day="0";
																									?>
																									<?php if($acco_data!="" && array_key_exists("night",$acco_data)): ?>
																										<?php $day1=count($acco_data["night"]); ?>
																									<?php endif; ?>
																									<h4><?php echo e($acco_data["city"]); ?></h4>
																								</div>
																								<!--City Name ends-->
																								<div class="flex-column">
																								<!--No of Nights-->
																									<div class="dTourHtlDtls">
																										<h4>No of Nights</h4>
																										<h5>
																											<?php if($day1>1): ?>
																												<?php echo e($day1); ?> Nights
																											<?php else: ?>
																												<?php echo e($day1); ?> Night
																											<?php endif; ?>
																										</h5>
																									</div>
																									<!--Room Type-->
																									<?php if($acco_data["category"]!=""): ?>
																									<div class="dTourHtlDtls">
																										<h4>Room Type</h4>
																										<h5><?php echo e($acco_data["category"]); ?></h5>
																									</div>
																									<?php endif; ?>
																								</div>
																						</div>
																					</div>
																				</div>
																				<div class="dhotelFooter">
																					<!--Hotel Website-->
																					<?php if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"])): ?>
																						<div class="dHotelWebCont">
																							<div class="dHotelWebCont_heading">Hotel Website</div>
																							<div class="dHotelWebCont_name"><?php echo e($acco_data["hotel_link"]); ?></div>
																						</div>
																					<?php endif; ?>
																				</div>
																			</div>
																		</div>
												                    </div>
												                </div>
												            <?php else: ?>
												                <div class="collapsible-container">
												                    <div class="collapsible-item dItem-box dItem-arrow" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
												                        <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;<?php echo e($acco_data['city']); ?>

												                    </div>
												                    <div class="collapsible-item-content" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
												                        <div class="dHtlCont">
																			<!--City Name starts-->
																			<!--<div class="dCityCont d-none">
																			<?php
																				$day1="0";
																				$day="0";
																			?>
																			<?php if($acco_data!="" && array_key_exists("night",$acco_data)): ?>
																				<?php $day1=count($acco_data["night"]); ?>
																			<?php endif; ?>
																			<h4><?php echo e($acco_data["city"]); ?></h4>
																			</div>-->
																			<!--City Name ends-->
																			<div class="dHtlBox">
																				<div class="makeflex">
																					<!--Hotel Image-->
																					<div class="dHtlImgBox">
																					    <?php if(!empty($acco_data['hotel']) && $acco_data['hotel'] !== 'other'): ?>
																					        <?php 
																					            $hotelImage = CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image');
																					         ?>

																					        <?php if($hotelImage && file_exists(public_path("uploads/package_hotel/{$hotelImage}"))): ?>
																					            <img src="<?php echo e(asset('public/uploads/package_hotel/'.$hotelImage)); ?>" alt="Hotel-Image">
																					        <?php else: ?>
																					            <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
																					        <?php endif; ?>
																					    <?php else: ?>
																					        <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
																					    <?php endif; ?>
																					</div>

																					<!--Hotel Description-->
																					<div class="dHtlDesc">
																						<div class="dhotelTopSection">
																							<div class="dHotelType"><?php if(array_key_exists("propertytype",$acco_data)): ?><?php echo e($acco_data["propertytype"]); ?><?php endif; ?></div>
																								<div class="flexCenter">
																									<div class="dHtlName">
																										<h4><?php if(array_key_exists("hotel",$acco_data)): ?><?php if($acco_data["hotel"]!="" && $acco_data["hotel"]!="other"): ?><?php echo e(CustomHelpers::getpackagerecord($acco_data["hotel"],'package_hotel','hotelname')); ?><?php elseif($acco_data["hotel"]=="other"): ?><?php echo e($acco_data["other_hotel"]); ?><?php endif; ?> <?php endif; ?></h4>
																									</div>
																									<div class="dHtlDescription">
																										<span class="dHtlStarRating" >
																											<?php if(array_key_exists("star",$acco_data)): ?>
																												<?php if($acco_data["star"]!="" && $acco_data["star"]!="other"): ?>
																												<?php echo e(CustomHelpers::get_star_rating($acco_data["star"])); ?>

																												<?php elseif($acco_data["star"]=="other"): ?>
																												<?php echo e(CustomHelpers::get_star_rating($acco_data["star_other"])); ?>

																												<?php endif; ?>
																											<?php endif; ?>
																										</span>
																									</div>
																								</div>
																								<!--City Name starts-->
																								<div class="dCityCont">
																								<?php
																									$day1="0";
																									$day="0";
																								?>
																								<?php if($acco_data!="" && array_key_exists("night",$acco_data)): ?>
																									<?php $day1=count($acco_data["night"]); ?>
																								<?php endif; ?>
																									<h4><?php echo e($acco_data["city"]); ?></h4>
																								</div>
																								<!--City Name ends-->
																								<div class="flex-column">
																								<!--No of Nights-->
																									<div class="dTourHtlDtls">
																										<h4>No of Nights</h4>
																										<h5>
																											<?php if($day1>1): ?>
																											<div><?php echo e($day1); ?> Nights</div>
																											<?php else: ?>
																											<div><?php echo e($day1); ?> Night</div>
																											<?php endif; ?>
																										</h5>
																									</div>
																									<!--Room Type-->
																									<?php if($acco_data["category"]!=""): ?>
																									<div class="dTourHtlDtls">
																										<h4>Room Type</h4>
																										<h5><?php echo e($acco_data["category"]); ?></h5>
																									</div>
																									<?php endif; ?>
																								</div>
																						</div>
																					</div>
																				</div>
																				<div class="dhotelFooter">
																					<!--Hotel Website-->
																					<?php if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"])): ?>
																						<div class="dHotelWebCont">
																							<div class="dHotelWebCont_heading">Hotel Website</div>
																							<div class="dHotelWebCont_name"><?php echo e($acco_data["hotel_link"]); ?></div>
																						</div>
																					<?php endif; ?>
																				</div>
																			</div>
																		</div>
												                    </div>
												                </div>
												            <?php endif; ?>
												        <?php else: ?>
												            <div>City information is not available.</div>
												        <?php endif; ?>
												        <?php  $i++;  ?>
												    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
												<?php elseif($details->acc_type=="extra_acc"): ?>
													<div class="dUnlistedHotel">
														<?php echo $details->accommodation_extra; ?>

													</div>
												<?php endif; ?>
										</div>
										<?php endif; ?>
									</div>
									<!--Desktop Tour Tabs-Accommodation Ends-->
									<!--Desktop-Tour-Tab-Collapsible-item-script-pagethree.js-->