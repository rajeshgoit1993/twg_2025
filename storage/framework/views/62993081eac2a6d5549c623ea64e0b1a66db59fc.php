<div class="item-container">
                          <div class="row">

                            <div class="col-md-12">

                              <div class="form-group">
                                    <label>Supplier</label>
                                    
                                    <select class="form-control" name="supplier_id" id="airfare">
                                  <option value="" >Select Supplier</option>
                                  <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suppliers): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($suppliers->id); ?>" <?php if($packagesData->supplier_id==$suppliers->id): ?> selected <?php endif; ?>><?php echo e($suppliers->suppliercompanyname); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>

                                  </div>

                            </div>

                            <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Supplier Remarks</label>
                                    <textarea class="form-control" name="supplier_remarks" placeholder="Supplier Remarks"><?php echo e($packagesData->supplier_remarks); ?></textarea>
                                  </div>
                                </div>

                            

                          </div>
                        </div>