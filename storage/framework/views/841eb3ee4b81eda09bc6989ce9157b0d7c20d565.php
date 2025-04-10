              <!--Mobile Tour Tabs-Transfers Starts-->
              <div class="mTourPkgDesc">
                <?php if($details->transfers!=''): ?>
                <div class="mTourDesc">
                  <h2>Tour Transfers</h2>
                  
                  <?php 
                    $transfers=unserialize($details->transfers);
                  ?>
                  <?php $a=0; ?>
                  <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row=>$col): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <?php if(array_key_exists('transport_type',$col) && array_key_exists('transfers_type',$col)): ?>
                  <?php
                    $transfers_data=DB::table('rt_transfer_list')->where([['transport_type','=',$col['transport_type']],['title','=',$col['transfers_type']]])->first();
                   ?>
                  <div class="collapsible-container">
                    <div class="collapsible-item mItem-box mItem-arrow" id=""><span class="glyphicon glyphicon-map-marker" style="color: #da2128; display: none"></span><?php echo e($col['mode_title']); ?></div>
                    <!--Collapsible Content-->
                    <div class="collapsible-item-content" id="">
                      <div class="mTourTransBox">
                        <!--<div class="mTourTransTitle"><?php echo e($col['mode_title']); ?></div>-->
                        <div class="mTourTransDtlsBox">
                          <div class="flex-column">

                            <!--Vehicle Image-->
                            <div class="mTourTransImgBox">
                              <?php 
                                $transferImage = $transfers_data->transfer_image ?? null;
                               ?>

                              <?php if(!empty($transferImage) && file_exists(public_path("uploads/transfer_image/{$transferImage}"))): ?>
                                <img src="<?php echo e(asset('public/uploads/transfer_image/'.$transferImage)); ?>" alt="Transfer-Image">
                              <?php else: ?>
                                <img src="<?php echo e(asset('public/uploads/default-img.webp')); ?>" alt="No-Image">
                              <?php endif; ?>
                            </div>

                            <div class="mTourTransDescBox">
                              <!--Private, Shared or Coach-->
                              <div class="mTourTransDescTopSection">
                                <h4 class="mTourTransTitle"><?php echo e($col['mode_title']); ?></h4>
                                <h2 class="mTourTransTransportType">
                                  <?php if($transfers_data!='' && $transfers_data->transfer_type!=''): ?>
                                    <?php echo e($transfers_data->transfer_type); ?>

                                  <?php endif; ?>
                                </h2>
                              </div>

                              <!--Vehicle Type, Duration & Inclusion-->
                              <div class="flexBetween appendBottom20">
                                <div class="mTourTransVehicleCont">
                                  <h4 class="mTourTransHead text-left">Vehicle Type</h4>
                                  <h5 class="mTourTransSubHead text-left">
                                    <?php if($transfers_data!='' && $transfers_data->vehicle_type!=''): ?>
                                      <?php echo e($transfers_data->vehicle_type); ?>

                                    <?php endif; ?>
                                  </h5>
                                </div>

                                <div class="mtransferDurationCont">
                                  <h4 class="mTourTransHead text-right">Duration</h4>
                                  <h5 class="mTourTransSubHead text-right">
                                    <?php if($transfers_data!='' && $transfers_data->duration!=''): ?>
                                      <?php echo e($transfers_data->duration); ?>

                                    <?php endif; ?>
                                  </h5>
                                </div>
                              </div>

                              <div>
                                <h4 class="mTourTransHead text-left">Includes</h4>
                                <h5 class="mTourTransSubHead text-left">
                                  <?php if($transfers_data!='' && $transfers_data->includes!=''): ?>
                                    <?php echo e($transfers_data->includes); ?>

                                  <?php endif; ?>
                                </h5>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php $a++; ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </div>
                <?php endif; ?>
              </div>
              <!--Mobile Tour Tabs-Transfers Ends-->
              <!--Mobile-Tour-Tab-Collapsible-item-script-pagethree.js-->