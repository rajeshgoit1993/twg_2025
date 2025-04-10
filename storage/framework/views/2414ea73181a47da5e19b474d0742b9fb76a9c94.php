              <!--Mobile Tour Tabs-Accommodation Starts-->
              <div class="mTourPkgDesc">
                <?php if($details->acc_type=="normal_acc" || $details->acc_type=="extra_acc"): ?>
                <div class="mTourHgLhts">
                  <h2>Tour Accommodation</h2>
                    <?php if($details->acc_type == "normal_acc"): ?>
                      <?php 
                        $acco = unserialize($details->accommodation); // Deserialize the accommodation data
                        $i = 1;
                       ?>

                      <?php $__currentLoopData = $acco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acco_data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <?php if(array_key_exists('city', $acco_data)): ?> <!-- Check if 'city' key exists -->
                          <?php if($i == 1): ?>
                            <div class="collapsible-container">
                              <div class="collapsible-item mItem-box mItem-arrow active" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
                                <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;<?php echo e($acco_data['city']); ?>

                              </div>
                              <div class="collapsible-item-content" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>" style="display: block; max-height: inherit;">
                                <div class="mHtlCont">
                                  <!-- City Name -->
                                  <div class="mCityCont d-none">
                                    <?php  $day1 = 0;  ?>
                                    <?php if(!empty($acco_data) && array_key_exists('night', $acco_data)): ?>
                                      <?php  $day1 = count($acco_data['night']);  ?>
                                    <?php endif; ?>
                                    <h4><?php echo e($acco_data['city']); ?></h4>
                                  </div>
                                  <div class="mHtlBox">
                                    <!-- Hotel Image -->
                                    <div class="mHtlImgBox">
                                      <?php if(array_key_exists('hotel', $acco_data)): ?>
                                        <?php if(!empty($acco_data['hotel']) && $acco_data['hotel'] != 'other'): ?>
                                          <img src="<?php echo e(url('/public/uploads/package_hotel/' . CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotel_image'))); ?>" alt="Hotel-Image">
                                        <?php elseif($acco_data['hotel'] == 'other'): ?>
                                          <img src="<?php echo e(url('/public/uploads/no-image.png')); ?>" alt="No-Image">
                                        <?php endif; ?>
                                      <?php endif; ?>
                                    </div>
                                    <!-- Hotel Description -->
                                    <div class="mHtlDesc">
                                      <div class="mhotelTopSection">
                                        <div class="mHotelType">
                                          <?php if(array_key_exists("propertytype", $acco_data) && !is_null($acco_data["propertytype"])): ?>
                                            <?php echo e($acco_data["propertytype"]); ?>

                                          <?php else: ?>
                                            Hotel
                                          <?php endif; ?>
                                        </div>
                                        <div>
                                          <div>
                                            <h4 class="htlTtl">
                                              <?php if(array_key_exists('hotel', $acco_data)): ?>
                                                <?php if(!empty($acco_data['hotel']) && $acco_data['hotel'] != 'other'): ?>
                                                  <?php echo e(CustomHelpers::getpackagerecord($acco_data['hotel'], 'package_hotel', 'hotelname')); ?>

                                                <?php elseif($acco_data['hotel'] == 'other'): ?>
                                                  <?php echo e($acco_data['other_hotel'] ?? ''); ?>

                                                <?php endif; ?>
                                              <?php endif; ?>
                                            </h4>
                                          </div>
                                          <div class="mHtlDescription">
                                            <span class="mHtlStarRating">
                                              <?php if(array_key_exists('star', $acco_data)): ?>
                                                <?php if(!empty($acco_data['star']) && $acco_data['star'] != 'other'): ?>
                                                  <?php echo e(CustomHelpers::get_star_rating($acco_data['star'])); ?>

                                                <?php elseif($acco_data['star'] == 'other'): ?>
                                                  <?php echo e(CustomHelpers::get_star_rating($acco_data['star_other'])); ?>

                                                <?php endif; ?>
                                              <?php endif; ?>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mhotelFooter">
                                        <div class="flexBetween">
                                          <!-- Number of Nights -->
                                          <div class="mTourHtlDtls">
                                            <h4>No of Nights</h4>
                                            <h5>
                                              <?php if($day1 > 1): ?>
                                                <div><?php echo e($day1); ?> Nights</div>
                                              <?php else: ?>
                                                <div><?php echo e($day1); ?> Night</div>
                                              <?php endif; ?>
                                            </h5>
                                          </div>
                                          <!-- Room Type -->
                                          <?php if(array_key_exists('category', $acco_data) && !empty($acco_data['category'])): ?>
                                            <div class="mTourHtlDtls">
                                              <h4 class="textRight">Room Type</h4>
                                              <h5 class="textRight"><?php echo e($acco_data['category']); ?></h5>
                                            </div>
                                          <?php endif; ?>
                                        </div>
                                        <!-- Hotel Website -->
                                        <?php if(array_key_exists("hotel_link", $acco_data) && !empty($acco_data["hotel_link"])): ?>
                                          <div class="mhotelWebCont">
                                            <div class="mhotelWebCont_heading">Hotel Website</div>
                                            <div class="mhotelWebCont_name"><?php echo e($acco_data['hotel_link']); ?></div>
                                          </div>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php else: ?>
                            <!-- Repeat the same logic for non-active items -->
                            <div class="collapsible-container">
                              <div class="collapsible-item mItem-box mItem-arrow" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
                                <span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;<?php echo e($acco_data['city']); ?>

                              </div>
                              <div class="collapsible-item-content" id="<?php echo e(str_slug($acco_data['city'], '-') . $i); ?>">
                                <div class="mHtlCont">
                                    <!-- Repeat content logic here -->
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php else: ?>
                          <div class="alert alert-warning">City information is missing in one of the accommodation</div>
                        <?php endif; ?>
                        <?php  $i++;  ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                    <?php elseif($details->acc_type=="extra_acc"): ?>
                      <div class="mUnlistedHotel">
                        <?php echo $details->accommodation_extra; ?>

                      </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
              </div>
              <!--Mobile Tour Tabs-Accommodation Ends-->
              <!--Mobile-Tour-Tab-Collapsible-item-script-pagethree.js-->