
<div class="col-md-2">
                                    <div class="form-group">
                                      <label for="country">Country</label>
                                      <select class="form-control country" name="country" >
                                        <option value="">Select Country</option>
                                          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                    <!-- State Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">State</label>
                                        <select class="form-control states" name="state" >
                                            <option value="">Select State</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- City Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">City</label>
                                        <select class="form-control city" name="city">
                                            <option value="">Select City</option>
                                        </select>
                                      </div>
                                    </div>