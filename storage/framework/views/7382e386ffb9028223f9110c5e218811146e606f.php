<div class="row">
  <div class="col-md-12 form-group">

                              <!-- listed hotel -->
                              <label for="listed_hotel" class="select-hotel-type">
                                <input type="radio" id="listed_hotel" name="acc_type" checked class="extra_acc" <?php if($packagesData->acc_type=="normal_acc"): ?> checked <?php endif; ?> value="normal_acc">Add Listed Hotel
                              </label>

                              <!-- unlisted hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="extra_acc" <?php if($packagesData->acc_type=="extra_acc"): ?> checked <?php endif; ?>>Add Unlisted Hotel
                              </label>

                              <!-- hide hotel -->
                              <label class="select-hotel-type">
                                <input type="radio" name="acc_type" class="extra_acc" class="extra_acc" value="hide_acc" <?php if($packagesData->acc_type=="hide_acc"): ?> checked <?php endif; ?>>Hide Hotel&nbsp;<i>(Not visible on the frontend)</i>
                              </label>
                            </div>

                            <!-- content -->
                            <?php
                              $option2_accommodation = unserialize($packagesData->accommodation);
                              if (is_bool($option2_accommodation)) :
                                $option2_accommodation_count = "1";
                              else :
                                $option2_accommodation_count = count($option2_accommodation);
                              endif;
                            ?>
                            <div class="col-md-12">

                              <!-- listed accommodation content -->
                              <div class="accommodation_main" <?php if($packagesData->acc_type=="normal_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
                                <?php
                                  $days = $packagesData->duration;
                                  $days = (int)filter_var($days, FILTER_SANITIZE_NUMBER_INT);
                                  $j=0;
                                ?>
                                <div class="dynamic_acc">
                                  <input type="hidden" name="" value="<?php echo e($days); ?>">
                                  <?php if($packagesData->accommodation!=''): ?>
                                  <?php $__currentLoopData = unserialize($packagesData->accommodation); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($j>0): ?>
                                    <hr>
                                    <?php endif; ?>
                                  <div class="item-container field<?php echo e($j); ?>" id="<?php echo e($j); ?>">
                                    <div class="row">

                                     
                                      <div class="col-md-6 appendBottom10">
                                        <label class="field-required">Select Duration</label>

                                        <!-- "Select all" checkbox -->
                                        <label class="label-duration">
                                            Select all
                                            <input type="checkbox" class="select_complete_duration"
                                                <?php if(!empty($col['night']) && count($col['night']) === $days): ?> checked <?php endif; ?>>
                                        </label>

                                        <!-- Multi-select dropdown -->
                                        <select class="form-control select_day select2" name="accommodation[<?php echo e($j); ?>][night][]" multiple>
                                            <?php for($i = 1; $i <= $days; $i++): ?>
                                                <?php 
                                                    $nightLabel = "Night $i";
                                                 ?>
                                                <option value="<?php echo e($nightLabel); ?>" 
                                                    <?php if(!empty($col['night']) && in_array($nightLabel, $col['night'])): ?> selected <?php endif; ?>>
                                                    <?php echo e($nightLabel); ?>

                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <!-- city -->
                                      <div class="col-md-3 appendBottom10 quote_city_class">
                                        <label class="field-required">City</label>
                                        <select class="quote_city form-control" name="accommodation[<?php echo e($j); ?>][city]" >
                                          <option <?php if(array_key_exists("city",$col)): ?> value="<?php echo e($col['city']); ?>" <?php endif; ?>><?php if(array_key_exists("city",$col)): ?> <?php echo e(CustomHelpers::get_master_table_data('city', 'id', (int)$col['city'], 'name')); ?> <?php endif; ?></option>
                                        </select>
                                      </div>

                                      <!-- hotel type -->
                                      <div class="col-md-3 propertytype_class">
                                        <div class="form-group">
                                          <label class="field-required">Hotel Type</label>
                                          <!-- <select class="form-control propertytype" name="accommodation[<?php echo e($j); ?>][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <option value="hotel" <?php if(array_key_exists('propertytype',$col) && $col['propertytype']=='hotel'): ?> selected <?php endif; ?>>Hotel</option>
                                            <option value="resort" <?php if(array_key_exists('propertytype',$col) && $col['propertytype']=='resort'): ?> selected <?php endif; ?>>Resort</option>
                                            <option value="villa" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='villa'): ?> selected <?php endif; ?>>Villa</option>
                                            <option value="home" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='home'): ?> selected <?php endif; ?>>Home</option>
                                            <option value="camp" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='camp'): ?> selected <?php endif; ?>>Camp</option>
                                            <option value="cruise" <?php if(array_key_exists('propertytype',$col) &&  $col['propertytype']=='cruise'): ?> selected <?php endif; ?>>Cruise</option>
                                          </select> -->
                                          <select class="form-control propertytype" name="accommodation[<?php echo e($j); ?>][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <?php 
                                                $propertyTypes = ['hotel', 'resort', 'villa', 'home', 'camp', 'cruise'];
                                                $selectedType = $col['propertytype'] ?? '';
                                             ?>
                                            <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($type); ?>" <?php echo e($selectedType === $type ? 'selected' : ''); ?>>
                                                <?php echo e(ucfirst($type)); ?>

                                              </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- hotel source -->
                                      <div class="col-md-4 appendBottom10 propertysource_class">
                                        <label class="field-required">Hotel Source</label>
                                        <!-- <select class="form-control propertysource" name="accommodation[<?php echo e($j); ?>][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <option value="packagehoteldatabase" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> selected <?php endif; ?>>Package Hotel Database</option>
                                          <option value="hoteldatabase" <?php if(array_key_exists('trip',$col) && $col['trip']=='hoteldatabase'): ?> selected <?php endif; ?>>Hotel Database</option>
                                          <option value="tripadvisor" <?php if(array_key_exists('trip',$col) && $col['trip']=='tripadvisor'): ?> selected <?php endif; ?>>TripAdvisor</option>
                                          <option value="manual" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> selected <?php endif; ?>>Manual</option>
                                        </select> -->
                                        <select class="form-control propertysource" name="accommodation[<?php echo e($j); ?>][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <?php 
                                            $tripSources = [
                                              'packagehoteldatabase' => 'Package Hotel Database',
                                              'hoteldatabase' => 'Hotel Database',
                                              'tripadvisor' => 'TripAdvisor',
                                              'manual' => 'Manual'
                                            ];
                                            $selectedTrip = $col['trip'] ?? '';
                                           ?>
                                          <?php $__currentLoopData = $tripSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($value); ?>" <?php echo e($selectedTrip === $value ? 'selected' : ''); ?>>
                                              <?php echo e($label); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <!-- select hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Name</label>
                                        <?php if(array_key_exists('city',$col) && array_key_exists('propertytype',$col)): ?>
                                        <?php $quote_hotel_data=CustomHelpers::get_quotation_hotel_new($col['city'],$col['propertytype']); ?>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[<?php echo e($j); ?>][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          <?php $__currentLoopData = $quote_hotel_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($single->id); ?>" <?php if(array_key_exists('hotel',$col) && $col['hotel']==$single->id): ?> selected <?php endif; ?>><?php echo e($single->hotelname); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                          <?php else: ?>
                                          <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                        </select>
                                        <?php endif; ?>
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" 
                                       style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Name</label>
                                        
                                        <?php 
                                          $quote_hotel_data = [];
                                          if(array_key_exists('city', $col) && array_key_exists('propertytype', $col)) {
                                            $quote_hotel_data = CustomHelpers::get_quotation_hotel_new($col['city'], $col['propertytype']);
                                          }
                                          $selectedHotel = $col['hotel'] ?? '';
                                         ?>

                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[<?php echo e($j); ?>][hotel]">
                                          <option value="0" selected disabled>Select</option>
                                            <?php $__currentLoopData = $quote_hotel_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($single->id); ?>" <?php echo e($selectedHotel == $single->id ? 'selected' : ''); ?>>
                                                <?php echo e($single->hotelname); ?>

                                              </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>



<div class="col-md-4 form-group similar_more" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none'); ?>;">
                                          <label >Similar/More</label>
                                          <select class="form-control text-capitalize " name="accommodation[0][similar_more]">
                                            <option value='0' selected='true' disabled='disabled'>Select</option>
                                            <option value="Similar Hotels"

                                            <?php echo e((array_key_exists('similar_more', $col) && $col['similar_more'] == 'Similar Hotels') ? 'selected' : ''); ?>

                                            >Similar Hotels</option>
                                            <option value="More Options"  <?php echo e((array_key_exists('similar_more', $col) && $col['similar_more'] == 'More Options') ? 'selected' : ''); ?>>More Options</option>
                                            <!--<option value="other">Unlisted Property</option>-->
                                          </select>
                                        </div>

                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" <?php if(array_key_exists('trip',$col) && $col['trip']=='packagehoteldatabase'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[<?php echo e($j); ?>][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1" <?php if(array_key_exists('star',$col) && $col['star']==1): ?> selected <?php endif; ?>>1 star</option>
                                          <option value="2" <?php if(array_key_exists('star',$col) && $col['star']==2): ?> selected <?php endif; ?>>2 star</option>
                                          <option value="3" <?php if(array_key_exists('star',$col) &&  $col['star']==3): ?> selected <?php endif; ?>>3 star</option>
                                          <option value="4" <?php if(array_key_exists('star',$col) &&  $col['star']==4): ?> selected <?php endif; ?>>4 star</option>
                                          <option value="5" <?php if(array_key_exists('star',$col) &&  $col['star']==5): ?> selected <?php endif; ?>>5 star</option>
                                        </select>
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'packagehoteldatabase') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[<?php echo e($j); ?>][star]">
                                          <option selected disabled>Select</option>
                                          <?php for($i = 1; $i <= 5; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e((array_key_exists('star', $col) && $col['star'] == $i) ? 'selected' : ''); ?>>
                                              <?php echo e($i); ?> star
                                            </option>
                                          <?php endfor; ?>
                                        </select>
                                      </div>


                                      <!-- enter hotel name -->
                                      <!-- <div class="col-md-4 appendBottom10 propertyname" id="propertyname" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Enter property name" value="<?php echo e($col['other_hotel']); ?>">
                                      </div> -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][other_hotel]" placeholder="Enter property name" value="<?php echo e($col['other_hotel'] ?? ''); ?>">
                                      </div>


                                      <!-- select hotel star rating -->
                                      <!-- <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" <?php if(array_key_exists('trip',$col) && $col['trip']=='manual'): ?> style="display: block" <?php else: ?> style="display: none" <?php endif; ?>>
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='1' <?php if(array_key_exists('star_other',$col) && $col['star_other']==1): ?> selected <?php endif; ?>>1 star</option>
                                          <option value='2' <?php if(array_key_exists('star_other',$col) && $col['star_other']==2): ?> selected <?php endif; ?>>2 star</option>
                                          <option value='3' <?php if(array_key_exists('star_other',$col) && $col['star_other']==3): ?> selected <?php endif; ?>>3 star</option>
                                          <option value='4' <?php if(array_key_exists('star_other',$col) && $col['star_other']==4): ?> selected <?php endif; ?>>4 star</option>
                                          <option value='5' <?php if(array_key_exists('star_other',$col) && $col['star_other']==5): ?> selected <?php endif; ?>>5 star</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: <?php echo e((array_key_exists('trip', $col) && $col['trip'] == 'manual') ? 'block' : 'none'); ?>;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control" name="accommodation[<?php echo e($j); ?>][star_other]">
                                            <option selected disabled>Select</option>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                              <option value="<?php echo e($i); ?>" <?php echo e((array_key_exists('star_other', $col) && $col['star_other'] == $i) ? 'selected' : ''); ?>>
                                                <?php echo e($i); ?> star
                                              </option>
                                            <?php endfor; ?>
                                          </select>
                                        </div>

                                      <div class="col-md-12"></div>

                                      <!-- room type -->
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[<?php echo e($j); ?>][category]" placeholder="Enter room type" value="<?php echo e($col['category']); ?>">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[<?php echo e($j); ?>][hotel_link]" placeholder="Enter hotel website" 
<?php if(array_key_exists('hotel_link',$col)): ?>
value="<?php echo e($col['hotel_link']); ?>"
<?php endif; ?>
                                        

                                        >
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" name="accommodation[<?php echo e($j); ?>][contact]" placeholder="Enter hotel contact no" 
                                        <?php if(array_key_exists('contact',$col)): ?>
                                       value="<?php echo e($col['contact']); ?>"
                                          <?php endif; ?>
                                          >
                                      </div>

                                      <!-- meals -->
                                      <!-- <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[<?php echo e($j); ?>][meals]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Room Only' <?php if(array_key_exists('meals',$col) && $col['meals']=='Room Only'): ?> selected <?php endif; ?>>Room Only</option>
                                          <option value='Breakfast' <?php if(array_key_exists('meals',$col) && $col['meals']=='Breakfast'): ?> selected <?php endif; ?>>Breakfast</option>
                                          <option value='Half Board' <?php if(array_key_exists('meals',$col) && $col['meals']=='Half Board'): ?> selected <?php endif; ?>>Half Board</option>
                                          <option value='Full Board' <?php if(array_key_exists('meals',$col) && $col['meals']=='Full Board'): ?> selected <?php endif; ?>>Full Board</option>
                                        </select>
                                      </div> -->

                                      <div class="col-md-4 appendBottom10">
                                        <label>Meals</label>
                                        <select class="form-control accommodationMeals" name="accommodation[<?php echo e($j); ?>][meals]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Room Only', 'Breakfast', 'Half Board', 'Full Board']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($meal); ?>" <?php echo e((array_key_exists('meals', $col) && $col['meals'] == $meal) ? 'selected' : ''); ?>>
                                              <?php echo e($meal); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>


                                      <!-- hotel price type -->
                                      <?php if($j>0): ?>
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                        <!-- <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                          <option value='Non-refundable' <?php if(array_key_exists('faretype',$col) &&  $col['faretype']=='Non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Refundable', 'Non-refundable']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fareType): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($fareType); ?>" <?php echo e((array_key_exists('faretype', $col) && $col['faretype'] == $fareType) ? 'selected' : ''); ?>>
                                                <?php echo e($fareType); ?>

                                              </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <div class="col-md-4 appendTop20">
                                        <button type="button" name="add" id="<?php echo e($j); ?>" class="remove_acco btn btn-danger">Remove</button>
                                      </div>

                                      <?php else: ?>
                                      <div class="col-md-4 appendBottom10" >
                                        <label>Hotel Price Type</label>
                                       <!--  <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='Refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Refundable'): ?> selected <?php endif; ?>>Refundable</option>
                                          <option value='Non-refundable' <?php if(array_key_exists('faretype',$col) && $col['faretype']=='Non-refundable'): ?> selected <?php endif; ?>>Non-refundable</option>
                                        </select> -->
                                        <select class="form-control accommodationFareType" name="accommodation[<?php echo e($j); ?>][faretype]">
                                          <option selected disabled>Select</option>
                                          <?php $__currentLoopData = ['Refundable', 'Non-refundable']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fareType): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($fareType); ?>" <?php echo e((!empty($col['faretype']) && $col['faretype'] == $fareType) ? 'selected' : ''); ?>>
                                              <?php echo e($fareType); ?>

                                            </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </select>
                                      </div>

                                      <div class="col-md-4"></div>
                                      <?php endif; ?>
                                    </div>
                                  </div>
                                  <?php $j++; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                  <?php else: ?>
                                  <div class="item-container field0" id="0">
                                    <div class="row">

                                      <!-- select nights -->
                                      <div class="col-md-6 form-group daysel">
                                        <label class="field-required">Select Duration</label>
                                        <label class="label-duration">Select all<input type="checkbox" class="all_days"></label>
                                        <select class="form-control select_day select2" multiple name="accommodation[0][night][]">
                                          <?php for($i=1; $i<=$days; $i++): ?>
                                            <option value="Night <?php echo e($i); ?>">Night <?php echo e($i); ?></option>
                                          <?php endfor; ?>
                                        </select>
                                      </div>

                                      <!-- city -->
                                      <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="field-required">City</label>
                                            <select class="quote_city form-control" name="accommodation[0][city]"></select>
                                            <!-- <input type="text" name="accommodation[0][city]" class="form-control query_city" placeholder="City"> -->
                                        </div>
                                      </div>

                                      <!-- hotel type -->
                                      <div class="col-md-3 propertytype_class">
                                        <div class="form-group">
                                          <label class="field-required">Hotel Type</label>
                                          <select class="form-control propertytype" name="accommodation[0][propertytype]" id="propertytype">
                                            <option selected disabled>Select</option>
                                            <option value="hotel">Hotel</option>
                                            <option value="resort">Resort</option>
                                            <option value="villa">Villa</option>
                                            <option value="home">Home</option>
                                            <option value="camp">Camp</option>
                                            <option value="cruise">Cruise</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-12"></div>

                                      <!-- hotel source -->
                                      <div class="col-md-4 appendBottom10 propertysource_class">
                                        <label class="field-required">Hotel Source</label>
                                        <select class="form-control propertysource" name="accommodation[0][trip]" id="propertysource">
                                          <option selected disabled>Select</option>
                                          <option value="packagehoteldatabase">Package Hotel Database</option>
                                          <option value="hoteldatabase">Hotel Database</option>
                                          <option value="tripadvisor">TripAdvisor</option>
                                          <option value="manual">Manual</option>
                                        </select>
                                      </div>

                                      <!-- select hotel name -->
                                      <div class="col-md-4 appendBottom10 selectproperty" id="selectproperty" style="display: none">
                                        <label class="field-required">Hotel Name</label>
                                        <select class="form-control text-capitalize quote_hotel" name="accommodation[0][hotel]">
                                          <option value='0' selected='true' disabled='disabled'>Select</option>
                                          <!--<option value="other">Unlisted Property</option>-->
                                        </select>
                                      </div>
<div class="col-md-4 form-group similar_more" style="display: none">
                                          <label >Similar/More</label>
                                          <select class="form-control text-capitalize " name="accommodation[0][similar_more]">
                                            <option value='0' selected='true' disabled='disabled'>Select</option>
                                            <option value="Similar Hotels">Similar Hotels</option>
                                            <option value="More Options">More Options</option>
                                            <!--<option value="other">Unlisted Property</option>-->
                                          </select>
                                        </div>
                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertystar" id="selectpropertystar" style="display: none">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <select class="form-control selectpropertystar_value" name="accommodation[0][star]">
                                          <option selected disabled>Select</option>
                                          <option value="1">1 star</option>
                                          <option value="2">2 star</option>
                                          <option value="3">3 star</option>
                                          <option value="4">4 star</option>
                                          <option value="5">5 star</option>
                                        </select>
                                      </div>

                                      <!-- enter hotel name -->
                                      <div class="col-md-4 appendBottom10 propertyname" id="propertyname" style="display: none">
                                        <label class="field-required">Enter Hotel Name</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][other_hotel]" placeholder="Enter property name">
                                      </div>

                                      <!-- select hotel star rating -->
                                      <div class="col-md-4 appendBottom10 selectpropertynamestar" id="selectpropertynamestar" style="display: none;">
                                        <label class="field-required">Hotel Star Rating</label>
                                        <!--<input type="text" class="form-control" name="accommodation[0][star_other]" placeholder="Enter hotel star rating">-->
                                        <select class="form-control" name="accommodation[0][star_other]" id="">
                                          <option selected disabled>Select</option>
                                          <option value='1'>1 star</option>
                                          <option value='2'>2 star</option>
                                          <option value='3'>3 star</option>
                                          <option value='4'>4 star</option>
                                          <option value='5'>5 star</option>
                                        </select>
                                      </div>

                                      <div class="col-md-12"></div>

                                      <!-- room type -->
                                      <div class="col-md-4 appendBottom10">
                                        <label class="field-required">Room Type</label>
                                        <input type="text" class="form-control text-capitalize" name="accommodation[0][category]" placeholder="Enter room type">
                                      </div>

                                      <!-- hotel website -->
                                      <div class="col-md-4 appendBottom10 hotel_link_class">
                                        <label>Hotel Website</label>
                                        <input type="text" class="form-control text-lowercase hotel_link" name="accommodation[0][hotel_link]" placeholder="Enter hotel website">
                                      </div>

                                      <!-- hotel contact no -->
                                      <div class="col-md-4 appendBottom10 hotel_contact_class">
                                        <label>Hotel Contact No</label>
                                        <input type="text" class="form-control text-capitalize hotel_contact" placeholder="Enter hotel contact no" name="accommodation[0][contact]">
                                      </div>

                                      <!-- meals -->
                                      <div class="col-md-4 appendBottom10">
                                        <div class="form-group">
                                          <label>Meals</label>
                                          <select class="form-control accommodationMeals" name="accommodation[0][meals]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Room Only'>Room Only</option>
                                            <option value='Breakfast'>Breakfast</option>
                                            <option value='Half Board'>Half Board</option>
                                            <option value='Full Board'>Full Board</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- hotel price type -->
                                      <div class="col-md-4 appendBottom10">
                                        <div class="form-group">
                                          <label>Hotel Price Type</label>
                                          <select class="form-control accommodationFareType" name="accommodation[0][faretype]" id="">
                                            <option selected disabled>Select</option>
                                            <option value='Refundable'>Refundable</option>
                                            <option value='Non-refundable'>Non-refundable</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="col-md-4"></div>

                                    </div>
                                  </div>
                                  <?php endif; ?>
                                </div>

                                <!-- add more hotel -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <!-- <button type="button" name="add" id="add_acco_tours" days="<?php echo e($days); ?>" class="btn btn-success">Add More</button> -->
                                    <button type="button" name="add" id="add_acco" days="<?php echo e($days); ?>" class="btn btn-success">(+) Add more hotel</button>
                                  </div>
                                </div>

                              </div>

                              <!-- unlisted accommodation content -->
                              <div class="accommodation_extra item-container" <?php if($packagesData->acc_type=="extra_acc"): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?> >
                                <label class="field-required">Unlisted Hotel details</label>
                                <textarea class="form-control ckeditor" rows="3" name="accommodation_extra"><?php echo $packagesData->accommodation_extra; ?></textarea>
                              </div>

                            </div>
</div>

