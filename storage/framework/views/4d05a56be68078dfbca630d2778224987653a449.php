          <!--Mobile Tour Tabs-Destination Starts-->
          <div class="mTourPkgDesc">
            <div class="mTourHgLhts">
              <h2>Tour Destination</h2>
              <div>
              <?php
                $destinations=$details->destinations;
                if($destinations!='' && $destinations!='N;') {
                  $city1=unserialize($details->destinations);
                  $city_data=array_unique($city1);
                  }
                else {
                  $city1=unserialize($details->city);
                  $city_data=array_unique($city1);
                  }
              ?>
              <?php $__currentLoopData = $city_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if(CustomHelpers::get_destination_data($data,'status')=="1"): ?>
                <?php
                  $best_time=CustomHelpers::get_destination_data($data,'best_time_desc');
                  $overview=CustomHelpers::get_destination_data($data,'overview');
                ?>
                <div class="collapsible-container">
                  <div class="collapsible-item mItem-box mItem-arrow"><span class="glyphicon glyphicon-map-marker" style="color: #da2128;"></span>&nbsp;<?php echo e($data); ?>,&nbsp;<?php echo e(CustomHelpers::get_destination_data($data,'country')); ?></div>
                  <!--Collapsible Content-->
                  <div class="collapsible-item-content" id="mob<?php echo e(str_slug($data, '-')); ?>">
                    <div class="collapsible-item-content-cont mDestCont">
                      <div class="collapsible-item-content-box mDestBox">
                      <?php if($overview!=""): ?>
                        <h3>About City</h3>
                        <p><?php echo $overview; ?></p>
                      <?php endif; ?>
                      <?php if($best_time!=""): ?>
                        <h3>Best Time To Visit</h3>
                        <p><?php echo $best_time; ?></p>
                      <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </div>
            </div>
          </div>
          <!--Mobile Tour Tabs-Destination Ends-->
          <!--Mobile-Tour-Tab-Collapsible-item-script-pagethree.js-->