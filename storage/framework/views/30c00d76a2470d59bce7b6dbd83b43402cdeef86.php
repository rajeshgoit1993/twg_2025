<div class="col-md-12 item-container">
                          <div class="row">

                            <!-- hotel star rating -->
                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="field-required">
                                    Star Rating 
                                    <span class="color74">(The highest star rating hotel featured in this tour)</span>
                                </label>
                                <select class="form-control" name="customer_rating">
                                  <?php $__currentLoopData = [1, 2, 3, 4, 5, 7]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <option value="<?php echo e($rating); ?>" <?php echo e(isset($packagesData->customer_rating) && $packagesData->customer_rating == $rating ? 'selected' : ''); ?>>
                                      <?php echo e($rating); ?> Star
                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <!-- tour sightseeing -->
                            <div class="col-md-7">                              
                              <div class="form-group select-container">
                                <label>Tour Sightseeing</label>
                                <select class="select2 form-control" name="tours[]" multiple id="tour_add">
                                    <?php $__currentLoopData = $PkgTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($tour->id); ?>" 
                                        <?php if(!empty($packagesData->tours) && in_array($tour->activity, $packagesData->tours)): ?> selected <?php endif; ?>>
                                        <?php echo e($tour->activity); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>

                            </div>

                            <!-- add new sightseeing -->
                            <div class="col-md-2">
                              <div class="form-group">
                                <div class="custom_tour_parent">
                                  <button data-toggle="modal" data-target="#packagetour_custom " type="button" class="btn-success btn-sm custom_tour appendTop20">Add new sightseeing</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>

                          <div class="row">

                            <!-- tour inclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Inclusions</label>
                                
                                <?php  

                                    $tour_inc = !empty($packagesData->tour_inc) ? $packagesData->tour_inc : []; 

                                 ?>

                                <select name="quote_inc[]" class="select2 form-control quote_inc" multiple>
                                    <?php $__currentLoopData = $inclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>" <?php echo e(in_array($pol->id, $tour_inc) ? 'selected' : ''); ?>>
                                        <?php echo e($pol->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="inclusions" cols="30" rows="5">
                                    <?php echo e(old('inclusions', $packagesData->inclusions ?? '')); ?>

                                </textarea>
                              </div>
                            </div>

                            <!-- tour exclusions -->
                            <div class="col-md-12 custom_inc_exc">
                              <div class="form-group item-container">
                                <label>Tour Exclusions</label>
                                
                                <?php  
                               
                                    $tour_exc = !empty($packagesData->tour_exc) ? $packagesData->tour_exc : []; 
                                 ?>

                                <select name="quote_exc[]" class="select2 form-control quote_exc" multiple>
                                    <?php $__currentLoopData = $exclusions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pol): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($pol->id); ?>" <?php echo e(in_array($pol->id, $tour_exc) ? 'selected' : ''); ?>>
                                        <?php echo e($pol->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                <br>
                                <span class="show_hide morePlus">More+</span>

                                <textarea class="form-control ckeditor" name="exclusions" cols="30" rows="5">
                                  <?php echo e(old('exclusions', $packagesData->exclusions ?? '')); ?>

                                </textarea>
                              </div>
                            </div>
                          </div> 