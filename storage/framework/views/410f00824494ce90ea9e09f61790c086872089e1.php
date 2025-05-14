<div class="row">
                          <div class="col-md-12 transfers_input_wrapper">
                             <?php
                        $option_transfer = unserialize($packagesData->transfers);
                        if (is_bool($option_transfer)) :
                          $option_transfer_count = "1";
                        else :
                          $option_transfer_count = count($option_transfer);
                        endif;
                      ?>
                      
                            <?php $j = 0 ?>
                            <?php if(is_array($option_transfer) || is_object($option_transfer)): ?>
                              <?php $__currentLoopData = $option_transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php $j++ ?>
                                <div class="transfers_input" id="transfers_input-<?php echo e($j); ?>" data-id="<?php echo e($j); ?>">

                                  <div class="item-container">
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="">Transfer Title</label>
                                        <input type="text" name="transfers[<?php echo e($j); ?>][mode_title]" value="<?php echo e($transfer['mode_title']); ?>" class="form-control mode_title" placeholder="Title">
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="">Select Transfer Mode</label>
                                        <select name="transfers[<?php echo e($j); ?>][transport_type]" id="transfers[<?php echo e($j); ?>][transport_type]" class="form-control transfer_mode">
                                        <option value="">--Choose Transport--</option>
                                        <option value="Car" <?php if($transfer!="" && $transfer['transport_type']=='Car' ): ?> selected <?php endif; ?>>Car</option>
                                        <option value="Bus" <?php if($transfer!="" && $transfer['transport_type']=='Bus' ): ?> selected <?php endif; ?>>Bus</option>
                                        <option value="Train" <?php if($transfer!="" && $transfer['transport_type']=='Train' ): ?> selected <?php endif; ?>>Train</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="">Select Transfers</label>
                                        <select name="transfers[<?php echo e($j); ?>][transfers_type]" id="transfers_type0" class="form-control transfers_type">
                                          <option value="0">--Select Transfers--</option>
                                          <?php /*@foreach($transfers->unique('transfer_type') as $transfer1)
                                          <option value="{{$transfer1->title}}" @if($transfer!="" && $transfer['transfers_type']==$transfer1->title) selected @endif>{{$transfer1->title}} </option>
                                          @endforeach*/ ?>
                                          <option <?php if($transfer!="" && !empty($transfer['transfers_type'])): ?> selected value="<?php echo e($transfer['transfers_type']); ?>" <?php endif; ?>><?php echo e($transfer['transfers_type']); ?> </option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php else: ?>
                              <div class="transfers_input" id="transfers_input-0" data-id="0">
                                <input type="hidden" name="" value="">
                                <div class="item-container field-0" id="0">

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="">Title</label>
                                      <input type="text" name="transfers[0][mode_title]" class="form-control mode_title" placeholder="Title">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Select Transfer Mode</label>
                                      <select name="transfers[0][transport_type]" id="transfers[0][transport_type]" class="form-control transfer_mode">
                                        <option value="">--Choose Transport--</option>
                                        <option value="Car">Car</option>
                                        <option value="Bus">Bus</option>
                                        <option value="Train">Train</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="">Select Transfers</label>
                                      <select name="transfers[0][transfers_type]" id="transfers_type0" class="form-control transfers_type">
                                        <?php /*<option value="0">--Select Transfers--</option>
                                        @foreach($transfers->unique('transfer_type') as $transfer)
                                        <option value="{{$transfer->title}}">{{$transfer->title}} </option>
                                        @endforeach*/ ?>
                                        <option value="0">--Select Transfers--</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="col-md-12">
                            <button type="button" name="add_transfers" id="add_transfers" class="btn btn-success">Add More</button>
                          </div>
                        </div>