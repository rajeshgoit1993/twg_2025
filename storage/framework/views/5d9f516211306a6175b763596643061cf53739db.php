          <!--Mobile Tour Tabs-Price Calendar Starts-->
          <div class="mTourPkgDesc">
            <div class="mTourCalendr">
              <h2>Pricing Calender</h2>
            </div>
            <div class="mCalendrCont">
              <div class="mCalendrPref">
                <label for="package_type">Preference</label>
                <?php if($new_price!='na'): ?>
                <?php  
                  $overall_package_rating_without_date=$new_price['overall_package_rating_without_date'];
                  $package_rating=$new_price['package_rating'];
                ?>
                <input type="hidden" value="" id="hidden_value">
                <input type="hidden" value="<?php echo e($id); ?>" id="package_value">
                <input type="hidden" value="upcoming" name="" class="pkg_type">

                <select id="package_type">
                  <?php $__currentLoopData = $overall_package_rating_without_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <?php if(array_key_exists($col,$new_price['overall_package_rating_with_date'])): ?>
                  <?php 
                    $rate=DB::table('rt_pkg_rating_type')->where('id',$col)->first();
                    $start_d=date("Y-m-d",$new_price['overall_package_rating_with_date'][$col]);
                  ?>
                  <option value="<?php echo e($col); ?>" pkg_date="<?php echo e($start_d); ?>" <?php if($col==$package_rating): ?> selected <?php endif; ?>>
                    <?php echo e($rate->name); ?>

                  </option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </select>
                <?php endif; ?>
              </div>
              <div class="mCalendrBox" id="calendar_parrent">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        <!--Mobile Tour Tabs-Price Calendar Ends-->