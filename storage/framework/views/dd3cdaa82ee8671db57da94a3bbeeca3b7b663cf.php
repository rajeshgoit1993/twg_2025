<?php $itinerary_data=$packagesData->day_itinerary; ?>
                      <div class="row">
                        <div class="col-md-12">
                                  <div >
                                    <label >Add Itinerary</label>
                                    <input type="checkbox"  name="dayItinerary[itineraryOption]" id="add_itinerary" value="1"
                                    <?php echo e(!empty($itinerary_data['itineraryOption']) && $itinerary_data['itineraryOption'] == 1 ? 'checked' : ''); ?>

                                    >
                                  </div>
                                </div>
                      </div>
<?php 

$day_count = count($packagesData->day_itinerary); ?>
                            <?php for($i=1 ; $i<= $day_count ; $i++): ?>
                            <?php if(array_key_exists('day' . $i, $packagesData->day_itinerary)): ?>
                      <div class="panel-body c_body">
                        <div class="row">
                          <div class="table-responsive">
                            
                            <div class="col-md-12 dayItinerary day1">
                              <div class="item-container">
                                <div class="row">

                                  <!-- day title -->
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="field-required">DAY <?php echo e($i); ?></label>
                                      <input type="text" class="form-control" name="dayItinerary[day<?php echo e($i); ?>][title]" value="<?php echo e($packagesData->day_itinerary["day$i"]["title"]); ?>">
                                    </div>
                                  </div>
                                
                                  <!-- tour activity -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Tour Activity</label>
                                      <select class='select2 form-control dayItineraryactivity custom_days' name="dayItinerary[day<?php echo e($i); ?>][activities][]" multiple>
                                        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                          <option value="<?php echo e($activity->activity); ?>" <?php if(!empty($packagesData->day_itinerary["day$i"]["activities"]) && in_array($activity->activity ,
                                        $packagesData->day_itinerary["day$i"]["activities"])): ?> selected='selected' <?php endif; ?>><?php echo e($activity->activity); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- meal plan -->
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Meal Plan (in hotel)</label>
                                      <select name="dayItinerary[day<?php echo e($i); ?>][meal_plan]" class="form-control">
                                        <option value="N" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="N"): ?> selected='selected' <?php endif; ?>>No Meal</option>
                                        <option value="EP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="EP"): ?> selected='selected' <?php endif; ?>>Room Only</option>
                                        <option value="CP" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="CP"): ?> selected='selected' <?php endif; ?>> Breakfast </option>
                                        <option value="lu" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="lu"): ?> selected='selected' <?php endif; ?>>Lunch </option>
                                        <option value="di" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="di"): ?> selected='selected' <?php endif; ?>>Dinner </option>
                                        <option value="bd" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bd"): ?> selected='selected' <?php endif; ?>> Breakfast & Dinner </option>
                                        <option value="bl" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bl"): ?> selected='selected' <?php endif; ?>> Breakfast & Lunch </option>
                                        <option value="ld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="ld"): ?> selected='selected' <?php endif; ?>>Lunch & Dinner </option>
                                        <option value="bld" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bld"): ?> selected='selected' <?php endif; ?>> Breakfast & Lunch/Dinner </option>
                                        <option value="bldall" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="bldall"): ?> selected='selected' <?php endif; ?>>Breakfast, Lunch & Dinner </option>
                                        <option value="apai" <?php if($packagesData->day_itinerary["day$i"]["meal_plan"]=="apai"): ?> selected='selected' <?php endif; ?>>All Inclusive </option>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- tour sightseeing -->
                                  <div class="col-md-4">
                                    <div class="form-group ">
                                    <label>Tour Sightseeing</label>
                                    <select class='select2 form-control dayItinerarytour custom_days' name="dayItinerary[day<?php echo e($i); ?>][tours][]" multiple>
                                      <?php $__currentLoopData = $PkgTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <?php if(array_key_exists("tours",$packagesData->day_itinerary["day$i"])): ?>
                                      <option value="<?php echo e($tour->id); ?>" <?php if(in_array($tour->id ,
                                      $packagesData->day_itinerary["day$i"]["tours"])): ?> selected='selected' <?php endif; ?>><?php echo e($tour->activity); ?></option>
                                      <?php else: ?>
                                      <option value="<?php echo e($tour->id); ?>"><?php echo e($tour->activity); ?></option>
                                      <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                    </div>
                                  </div>

                                  <!-- tour day plan -->
                                  <div class="col-md-12 custom_inc_exc">
                                    <div class="form-group">
                                      <label>Day Plan</label>
                                      <br>
                                      <span class="show_hide morePlus">More+</span>
                                      <textarea class="form-control ckeditor" rows="3" name="dayItinerary[day<?php echo e($i); ?>][desc]"><?php echo e($packagesData->day_itinerary["day$i"]["desc"]); ?></textarea>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>
                      <?php endfor; ?>