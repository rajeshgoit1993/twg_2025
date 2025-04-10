<div class="item-container">
                          <div class="row">

                            <!-- select destination -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="destinations">Choose City</label>
                                <div class="input-group pdngBtm5">
                                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                  <select name="sp_city[]" id="sp_city" class="form-control sp_city" multiple>
                                    <?php if($packagesData->sp_city!=""): ?>
                                        <?php $__currentLoopData = $packagesData->sp_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spcity): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                       <?php 
 $matchingCityIds = DB::table('city')->where('id',$spcity)->first();
 $matching_state =  DB::table('states')->where('id',$matchingCityIds->state_id)->first();
 $matching_country =  DB::table('countries')->where('id',$matching_state->country_id)->first();
                       ?>                 
                                          <option value="<?php echo e($spcity); ?>" selected>
                                            <?php if($matching_state!='' && $matching_state->country_id=='101'): ?>
<?php echo e($matchingCityIds->name); ?> (<?php echo e($matching_state->name); ?>, <?php echo e($matching_country->name); ?> )
                                            <?php else: ?>
<?php echo e($matchingCityIds->name); ?> (<?php echo e($matching_country->name); ?> )
                                            <?php endif; ?>
                                          
                                          </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        <?php endif; ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- select similar tour -->
                            <div class="spkgs-box">
                              <div class="col-md-12">
                                <div class="form-group ">
                                  <label for="destinations">Choose Similar Package(s)</label>
                                  <div class="input-group pdngBtm5">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <select name="similar_packages[]" id="similar_packages" class="form-control select2" multiple>
                                      <?php if(!empty($packagesData->similar_packages)): ?>
    <?php 
        
        $packageIds = $packagesData->similar_packages;

        $packageDetails = DB::table('rt_packages')
            ->whereIn('id', $packageIds)
            ->get()
            ->keyBy('id');

      
        $given_city_list = is_array($packagesData->sp_city) ? $packagesData->sp_city : [];
     ?>

    <?php $__currentLoopData = $packageDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkgs => $data_check): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php 
           
            $city_list = @unserialize($data_check->city) ?: [];
            $result = array_intersect($given_city_list, $city_list);
            $output = count($result) > 0 ? count($result) : '';
         ?>

        <option value="<?php echo e($pkgs); ?>" city="<?php echo e($output); ?>" selected>
            <?php echo e($data_check->title); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<?php endif; ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>