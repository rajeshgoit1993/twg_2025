<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Box Container -->
                <div class="box">
                    <!-- Box Header -->
                    <!-- <div class="box-header"></div> -->
                    <!-- /.box-header -->

                    <!-- Box Body -->
                    <div class="box-body">

                        <!-- Back Button -->
                        <a href="<?php echo e(URL::to('/packageUploads/' . Request::segment(2))); ?>" class="btn btn-success">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>

                        <div class="box-header"></div>

                        <div class="well">
                          <!-- manage_package -> package_image_location -->
                          <div class="box-header" style="padding: 10px 0;">
                              <h3 class="box-title">Select location to add images from gallery</h3>
                              <h3 class="box-title">(<?php echo e(CustomHelpers::get_package_title(Request::segment(2))); ?>)</h3>
                          </div>

                          <div class="modal-body">
                            <!-- Form for selecting country, state, and city -->
                            <form action="<?php echo e(URL::to('/package_image_gallery/' . Request::segment(2))); ?>">
                                <?php echo e(csrf_field()); ?>

                                
                                <!-- Row for form fields -->
                                <div class="row">
                                  <!-- Country Selection -->
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="country">Country</label>
                                      <select class="form-control" name="country_name" onchange="get_states(this)">
                                        <option value="0">Select Country</option>
                                          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                      </select>
                                    </div>
                                  </div>

                                    <!-- State Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">State</label>
                                        <select class="form-control st_values" name="state_name" onchange="getcitys(this)">
                                            <option value="0">Select State</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- City Selection -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="country">City</label>
                                        <select class="form-control ct_values" name="city_name">
                                            <option value="0">Select City</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-md-12"></div>

                                    <!-- Submit Button -->
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-danger">Proceed to select</button>
                                      </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </form>
                            <!-- /.form -->
                          </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>