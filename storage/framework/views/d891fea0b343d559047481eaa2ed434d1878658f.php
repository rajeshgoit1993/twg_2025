<div class="item-container">
                          <div class="row">

                            <!-- tour duration -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="duration">Tour Duration <span class="requiredcolor">&#42;</span></label>
                                <select name="duration" id="package_durations" class="form-control val">
                                  <?php for($i = 1; $i <= 30; $i++): ?>
                                    <option value="<?php echo e($i); ?>" 
                                    <?php echo e(isset($packagesData->duration) && $i == $packagesData->duration ? 'selected' : ''); ?>>
                                    <?php echo e($i); ?> Night / <?php echo e($i + 1); ?> Days
                                  </option>
                                  <?php endfor; ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour title -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_name" class="field-required">Tour Title</label>
                                <input type="text" placeholder="Enter tour name" value="<?php echo e($packagesData->title); ?>" name="package_name" class="form-control package_name">
                                <span class="package_availibility"> </span>
                              </div>
                            </div>

                           <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="package_code" class="field-required">Package Code</label>
                                      <input type="text" placeholder="Package Code" value="<?php echo e($packagesData->package_code); ?>" name="package_code" class="form-control package_code"    <?php if($action_type=='quote' || $action_type=='quote_edit'): ?> readonly <?php else: ?> required <?php endif; ?>>
                                      <span class="package_code_availibility"> </span>
                                    </div>
                                  </div>

                            <!-- departure city -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Departure City</label>
                                <select class="quote_city form-control" name="sourcecity">
                                <option value="<?php echo e($packagesData->sourcecity); ?>" selected>
                                  <?php echo e(CustomHelpers::get_master_table_data('city', 'id', (int)$packagesData->sourcecity, 'name')); ?>


                                 
                                </option>
                                </select>
                              </div>
                            </div>

                            <!-- tour type -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Type</label>
                                <select class="form-control" name="tour_type">
                                  <option value="">Select tour type</option>
                                  <?php $__currentLoopData = $tourtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourtype): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($tourtype->id); ?>" 
                                      <?php echo e(isset($packagesData->tour_type) && $packagesData->tour_type == $tourtype->id ? 'selected' : ''); ?>>
                                      <?php echo e($tourtype->tour_type); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                              </div>
                            </div>

                            <!-- tour category -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="sourcecity" class="field-required">Tour Category</label>
                                <select class="form-control" name="tour_category">
                                  <option value="">Select Tour Category</option>
                                  <?php $__currentLoopData = $tourcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tourcategory): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($tourcategory->id); ?>" 
                                      <?php echo e((isset($packagesData->tour_category) && $packagesData->tour_category == $tourcategory->id) || old('tour_category') == $tourcategory->id ? 'selected' : ''); ?>>
                                      <?php echo e($tourcategory->tour_category); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour star rating -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Star Rating <i>(use to display hotel rating on frontend)</i></label>
                                <select class="form-control" name="select_star_rating">
                                  <option value="">Select Star</option>
                                  <?php $__currentLoopData = [5, 4, 3, 2, 1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($star); ?> Star" 
                                    <?php echo e(old('select_star_rating', $packagesData->select_star_rating ?? '') == "$star Star" ? 'selected' : ''); ?>>
                                    <?php echo e($star); ?> Star
                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>

                            </div>

                            <!-- services included -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_location" class="field-required">Tour Services Included</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_service[]" id="package_service" class="form-control select2" multiple>
                                    <?php if(count($icons) > 0): ?>
                                      <?php 
                                        // Ensure package_service is an array
                                        $selectedServices = is_array($packagesData->package_service) 
                                        ? $packagesData->package_service 
                                        : explode(',', $packagesData->package_service);
                                       ?>
                                      <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($icon->icon_title); ?>" 
                                          <?php echo e(in_array($icon->icon_title, old('package_service', $selectedServices) ?? []) ? 'selected' : ''); ?>>
                                          <?php echo e($icon->icon_title); ?>

                                        </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- suitable for -->
                           <?php if($action_type == 'quote' || $action_type == 'quote_edit'): ?>
                           <div class="col-md-12">
                           
                       <label for="admin_remarks">Trip Remarks</label>
                  <input type="text" class="form-control" value="<?php echo e($packagesData->admin_remarks); ?>" name="admin_remarks" id="admin_remarks" placeholder="Enter Remarks (if any)..." />
                                    
                                    
                           </div>

                          <div class="col-md-12">
                  <label for="tour_date">Travel Date</label>
                  <input type="date" name="tour_date" value="<?php echo e($packagesData->tour_date); ?>" id="tour_date" class="form-control tour_date" value="" placeholder="Tour Date" />
                </div>

                           <?php else: ?>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_suitables">Suitable For</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_suitables[]" id="package_suitables" class="form-control select2" multiple    >
                                    <?php if(count($suitables)>0): ?>
                                          <?php $__currentLoopData = $suitables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suit): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($suit->icon_title); ?>" <?php if(is_array($packagesData->package_suitables) && in_array($suit->icon_title,$packagesData->package_suitables )): ?> selected <?php endif; ?>><?php echo e($suit->icon_title); ?> </option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          <?php else: ?>
                                            <option value="No Result Found">No Result Found</option>
                                          <?php endif; ?>
                                  </select>
                                </div>
                              </div>

                            </div>

                            <!-- general tag -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_tags">General Tags</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="package_tags[]" id="package_tags" class="form-control select2" multiple>
                                    <?php if(count($generals) > 0): ?>
                                     

                                      <?php $__currentLoopData = $generals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $general): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($general->icon_title); ?>"
                                        <?php if(is_array($packagesData->package_tags) && in_array($general->icon_title,$packagesData->package_tags )): ?> selected <?php endif; ?>>
                                        <?php echo e($general->icon_title); ?>

                                        </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <!-- <div class="clearfix"></div> -->

                            <!-- theme -->
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="package_category">Theme</label>
                                <select name="package_category[]" id="package_category" class="select2 form-control" multiple>
                                  <?php 
                                    // Convert package_category to an array if it is a string
                                    $selectedCategories = is_array($packagesData->package_category) 
                                      ? $packagesData->package_category 
                                      : explode(',', $packagesData->package_category);
                                   ?>
                                  
                                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typ): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($typ->name); ?>" 
                                      <?php echo e(in_array($typ->name, old('package_category', $selectedCategories) ?? []) ? 'selected' : ''); ?>>
                                      <?php echo e($typ->name); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- holiday type -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="package_holiday">Holiday Type</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                 

                                  <select name="package_holiday[]" id="package_holiday" class="form-control select2" multiple>
                                   
                                    <?php if(count($holidays) > 0): ?>
                                      <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($holiday->icon_title); ?>" 
                                          <?php if(is_array($packagesData->package_holiday) && in_array($holiday->icon_title,$packagesData->package_holiday )): ?> selected <?php endif; ?> >
                                            <?php echo e($holiday->icon_title); ?>

                                          </option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                      <option value="">No Result Found</option>
                                    <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <?php endif; ?>
                          </div>

                          <!-- city wise duration -->
                                                  
                          <label for="">Duration By City</label>

                          <div class="col-md-12">
                            <div class="row" id="dynamic_field_package">
                              <?php 
                               $a = 0; 

                              ?>
                              <?php $__currentLoopData = $packagesData->continent ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <?php
              $days_duration = $packagesData->duration ?? ''; 
                             
  if (isset($packagesData->continent[$row])) {
    $countries = DB::table('countries')->where('continent_id', $packagesData->continent[$row])->get();
  }
  else
  {
    $countries = DB::table('countries')->all();
  }

$states = DB::table('states')->where('country_id', $packagesData->country[$row])->get();
$cities = DB::table('city')->where('state_id', $packagesData->state[$row])->get();
           
 $days = $packagesData->days[$row] ?? '';          

                            ?>
                              <div class="item-container remove dfp dfp-1">

                                      <!-- continent -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="continent">Continent</label>
                                          <select name="continent[<?php echo e($a); ?>]" id="package_continent" class="form-control package_continent">
                                           <option value="">--Select Continent--</option>

                                           <?php $__currentLoopData = $continents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <option value="<?php echo e($cont->id); ?>" 
        <?php if(isset($packagesData->continent[$row]) && $packagesData->continent[$row] == $cont->id): ?> 
            selected 
        <?php endif; ?>>
        <?php echo e($cont->continent_name); ?>

    </option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- country -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="country" class="field-required">Country</label>
                                          <select name="country[<?php echo e($a); ?>]" id="package_dest_countries<?php echo e($a); ?>" class="form-control package_dest_country" >
                                            <option value='0'>Select Country</option>
                                            
                                       <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($country->id); ?>" <?php if($packagesData->country[$row]==$country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- state -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="state" class="field-required">State</label>
                                          <select name="state[<?php echo e($a); ?>]" id="package_dest_state<?php echo e($a); ?>" class="form-control package_dest_state" >
                                           <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($state->id); ?>" <?php if($packagesData->state[$row]==$state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
                                          </select>
                                        </div>
                                      </div>

                                      <!-- city -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">City</label>
                                          <select name="city[<?php echo e($a); ?>]" id="package_dest_city<?php echo e($a); ?>" class="package_dest_cities form-control city_package_dest_countries min-select" >
                                             <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                              <option value="<?php echo e($city->id); ?>" <?php if($packagesData->city[$row]==$city->id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> 
                                          </select>
                                        </div>
                                      </div>

                                      <!-- duration city wise -->
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="city" class="field-required">Duration</label>
                                          <select name="days[<?php echo e($a); ?>]" id="package_dest_days" class="form-control package_dest_days ">
                                           <?php for($day_value = 1; $day_value <= $days_duration; $day_value++): ?>
    <option value="<?php echo e($day_value); ?>" <?php echo e($day_value == $days ? 'selected' : ''); ?>>
        <?php echo e($day_value); ?> Night / <?php echo e($day_value + 1); ?> Days
    </option>

    <?php if($day_value == $days): ?>
        <?php  break;  ?>
    <?php endif; ?>
<?php endfor; ?>

                                          </select>
                                        </div>
                                      </div>
                                      <?php if($a!=0): ?>
                                <div class="col-md-2">
                                  <div class='form-group'>
                                    <button type='button' name='add-continent' id='remove-continent-row' class='btn btn-danger remove-continent-row' style='margin:18px 10px 0px 0px'>Remove</button>
                                  </div>
                                </div>
                                <?php endif; ?>
                                    </div>
                                     <?php $a++;?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                          </div>

                          <!-- add more city & duration -->
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <button type="button" name="add-continent" id="add-continent-row" class="btn btn-success">(+) Add more city
                                  <!-- more content from package.js -->
                                </button>
                              </div>
                            </div>
                          </div>

                        </div>
                        