<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hotels Management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if(Session::has('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <?php echo e(Session::get('success')); ?>

                </div>
                <?php endif; ?>
             <div class="alert alert-success success-contaier-parent-hotel" id="success-contaier-parent-hotel" style="display:none">
                 <p>Hotel Deleted Successfully.</p>
              </div>
              <div class="alert alert-danger error-contaier-parent-hotel" id="error-contaier-parent-hotel" style="display:none">
                <ul class="error-contaier-hotel" id="error-contaier-hotel"> </ul> 
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <div class="add">
                  <a href="<?php echo e(URL::to('/hotel-add')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</a>
                </div>
                <thead>
                <tr>
                  <th><input class="checkboxcls" value="3" type="checkbox"></th>
                  <!-- <th>#</th> -->
                  <th>Image</th>
                  <th>Name</th>
                  <th>Stars</th>
                  <th>Location</th>
                  <th>Gallery</th>
                  <th>Featured</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$hotel): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
                <tr>
                  <td><input class="checkboxcls" value="3" type="checkbox"></td>
                  <td style="width: 10%;"><img class="img-responsive" src="<?php echo e(url('/public'.CustomHelpers::get_first_image($hotel->id,'rt_hotel_uploads','image_path','hotel_id'))); ?>" alt=""></td>
                  <td><?php echo e($hotel->name); ?></td>
                  <td><?php echo e($hotel->stars); ?> Star</td>
                  <td><?php echo e($hotel->country); ?></td>
                  <td><a href="<?php echo e(URL::to('/hotelUploads/'.$hotel->id)); ?>">Uploads(<?php echo e(CustomHelpers::countRows($hotel->id,'rt_hotel_uploads','image_path','hotel_id')); ?>)</a></td>
                  <td>
                    <?php if($hotel->featured == 1): ?>
                        <i style="color:green" class="fa fa-check-square" aria-hidden="true"></i>
                    <?php else: ?>  
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="btn-group">
                      <a class="btn btn-default btn-xcrud btn btn-warning" href="<?php echo e(URL::to('/editHotel/'.$hotel->id)); ?>">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a class="btn btn-danger deleteHotel" hotel-id="<?php echo e($hotel->id); ?>"  hotel-name="<?php echo e($hotel->name); ?>" href="#"><i class="fa fa-times"></i></a>
                    </span>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>