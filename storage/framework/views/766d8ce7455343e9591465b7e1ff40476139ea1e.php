<?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="box-title">Gallery Management</h3>
                    <div class="panel-body">
                        <div class="collapse" id="UploadPhotos">
                          <div class="well well-sm">
                              <div class="modal-body">
                                <form action="<?php echo e(url('/hotelfileUploads')); ?>"   enctype="multipart/form-data" method="POST">
            <?php echo e(csrf_field()); ?>

<input type="hidden" name="package_id" value="<?php echo e(Request::segment(2)); ?>">
<div class="row">
    <div class="col-md-1">Country: </div>
    <div class="col-md-6">

<select class="form-control" onchange="get_states(this)" name="country">
            <option value='0'>Select Country</option>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>" ><?php echo e($cont->name); ?> 
    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>   
</select>



    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1">State: </div>
    <div class="col-md-6">
        <select class="form-control st_values" id="" onchange="getcitys(this)" name="state">
                <option value='0'>Select State</option>
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1">City: </div>
    <div class="col-md-6">
        <select class="form-control ct_values"  name="city">
                <option value='0'>Select City</option>
 </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-1">Name: </div>
    <div class="col-md-6"><input type="text" name="name" placeholder="Image Name" class="form-control"></div>
</div>
<br>
<div class="row">
    <div class="col-md-1">Choose Image: </div>
    <div class="col-md-6"><input type="file" name="uploadimage[]" multiple class="form-control"></div>
</div>
<br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-6"><button class="btn btn-success">Save</button></div>
</div>

</form>
<!-- 
                                <div class="bdr_upload">
                                   <form action="<?php echo e(url('/hotelfileUploads')); ?>" class="dropzone" id="add-image" enctype="multipart/form-data">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="hotel_id" value="<?php echo e(Request::segment(2)); ?>">

                                    </form>
                                </div> -->
                              </div>
                          </div>
                        </div>
                      <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos">
<i class="fa fa-photo"></i> Add Photos From System
</a>
<a href="<?php echo e(URL::to('hotel_image_location/'.Request::segment(2))); ?>"><button class="btn btn-success">Add Photos From Gallery</button></a>
<div class="clearfix"></div>

                        <table class="table table-striped table-hover">
                         <thead>
<tr>
    <th>ID</th>
<th class="" style="width: 100px">
Image
</th>
<th class=" text-center">Country</th>
                                  
<th class=" text-center">State</th>
<th class=" text-center">City</th>
<th class=" text-center">Name</th>
<th class=" text-center">Status</th>
<th class= text-center">Action</th>
</tr>
</thead>
                            <tbody>
                              <input id="hotelid" value="52" type="hidden">
<?php
 $coun="1"
 ?>                             
<?php $__currentLoopData = $HotelUploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 

<tr id="tr_<?php echo e($image->id); ?>">
    <td><?php echo e($coun++); ?></td>
<td>
<a href="#" rel=""> 
    <?php if($image->gallery_id!=''): ?>
     <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'type')=='video'): ?>
 <div style="max-width:100%;position: relative;" class="video_icon" >
  <input type="hidden" name="" class="video_src"  value="<?php echo e(URL::to('/').'/public/uploads/packages/video/'.CustomHelpers::get_imgpath_gallery($image->gallery_id,'image_main')); ?>">
   <i class="fa fa-play play_video" style="position: absolute;
    z-index: 1;
    color: white;
    left: 50%;
    top: 25px;
    border: 1px solid white;
    padding: 5px;
    border-radius: 20px;cursor: pointer;"></i>
 </div>
 <?php endif; ?>

<?php if(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')!="0"): ?>
<img src="<?php echo e(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')); ?>" href="#" class="img-responsive" style="width:100%">
<?php endif; ?>
<?php else: ?>
 <img src="<?php echo e(URL::to('/').'/public/'.$image->image_path); ?>" href="#" class="img-responsive">
<?php endif; ?>
</a>
</td>
<td style="padding:35px">
    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')!="0"): ?>
<span class="" id="">
  <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')); ?>

 </span>
 <?php endif; ?> 
</td>
                              
<td style="padding:35px">
<?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')!="0"): ?>
<span class="" id="">
  <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')); ?>

 </span>
 <?php endif; ?> 
</td>
<td style="padding:35px">
<?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')!="0"): ?>
<span class="" id="">
  <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')); ?>

 </span>
 <?php endif; ?> 
</td>
<td style="padding:35px">
<?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')!="0"): ?>
<span class="" id="">
  <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')); ?>

 </span>
 <?php endif; ?> 
</td>
<td style="padding:35px">
 <?php if($image->status==1): ?>
 <p style="background:green;color: white;padding: 2px;text-align: center;">Enable</p>
 <?php else: ?>
 <p style="background:red;color: white;padding: 2px;text-align: center;">Disable</p>
 <?php endif; ?>
</td>

<td style="padding:35px">
<!--<a href="<?php echo e(URL::to('/edit_package_image/'.$image->id.'/'.$image->package_id)); ?>"><button class="btn btn-success " > Edit </button></a>-->
 <?php if($image->gallery_id!=''): ?>
<a href="<?php echo e(URL::to('/edit_hotel_gallery_image/'.$image->gallery_id.'/'.$image->hotel_id.'/'.$image->id)); ?>"><button class=" btn-success " > Edit </button></a>
<?php endif; ?>
<form style="display: inline;" action="<?php echo e(URL::to('/hotelfiledelete/'.$image->id.'/'.$image->hotel_id)); ?>" onsubmit="return confirm('Do you really want to delete this.?');" method="POST">
                                     <?php echo e(csrf_field()); ?>


<button type="submit" class=" btn-danger  btn-md deleteImg" id="<?php echo e($image->id); ?>" name=""> Delete </button>

</form>
</td>
</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                              
                            <!--   <?php $__currentLoopData = $HotelUploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
                              <tr id="tr_<?php echo e($image->id); ?>">
                                <td>
                                    <a href="#" rel=""> 
                                      <img src="<?php echo e(URL::to('/').'/public/'.$image->image_path); ?>" href="#" class="img-responsive">
                                    </a>
                                </td>
                                 <td style="padding:35px">
                                    <button class="btn btn-default btn-block btn-md btnthumb" id=""> No </button>
                                </td>
                              
                                <td style="padding:35px">
                                    <span class="" id=""><?php echo e($image->id); ?> </span>
                                </td>
                                <td style="padding:35px">
                                    <span class="" id=""> <?php echo e($image->hotel_id); ?> </span>
                                </td>
                                  <td style="padding:35px">
                                    <button class="btn btn-danger btn-block btn-md deleteImg" id="<?php echo e($image->id); ?>" name=""> Delete </button>
                                </td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> -->




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>