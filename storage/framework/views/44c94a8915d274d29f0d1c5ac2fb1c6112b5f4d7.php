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
                        <a href="<?php echo e(URL::to('/packagehotelUploads/' . Request::segment(2))); ?>" class="btn btn-success">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>

                        <div class="box-header"></div>

                        <div class="well">
                          <!-- manage_package -> package_image_location -->
                          <div class="box-header" style="padding: 10px 0;">
                              <h3 class="box-title">Select location to add images from gallery</h3>
                              <h3 class="box-title">(<?php echo e(CustomHelpers::get_packagehotel_title(Request::segment(2))); ?>)</h3>
                          </div>

                          <div class="modal-body">
                            <!-- Form for selecting country, state, and city -->
                            <form action="<?php echo e(URL::to('/packagehotel_image_gallery/' . Request::segment(2))); ?>">
                                <?php echo e(csrf_field()); ?>

                                
                                <!-- Row for form fields -->
                                <div class="row">
                                  <!-- Country Selection -->


<?php echo $__env->make('manage_packages.country_state_city_insert_tour_gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                  

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