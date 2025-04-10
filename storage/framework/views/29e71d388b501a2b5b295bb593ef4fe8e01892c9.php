<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <a href="<?php echo e(URL::to('/package_hotel')); ?>" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>

                        <!-- package_hotel -> packagehotelUpoads -->
                        <div class="box-header" style="padding: 10px 0;">
                          <h3 class="box-title">Gallery Management</h3>
                        </div>
                    
                        <!-- <div class="collapse" id="UploadPhotos">
                            <div class="well">
                                <div class="modal-body">
                                    <form action="<?php echo e(url('/packagehotelfileUploads')); ?>"   enctype="multipart/form-data" method="POST">
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
                                            <div class="col-md-6"><button class="btn btn-sm btn-danger">Proceed to upload</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> -->

                        <!-- <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From Computer</a>

                        <a href="<?php echo e(URL::to('packagehotel_image_location/'.Request::segment(2))); ?>"><button class="btn btn-success">Add Photos From Gallery</button></a> -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- Button to toggle photo upload form -->
                                    <a class="btn btn-success" data-toggle="collapse" href="#UploadPhotos" aria-expanded="false" aria-controls="UploadPhotos"><i class="fa fa-photo"></i> Add Photos From System</a>

                                    <!-- Button to add photos from the gallery -->
                                    <a href="<?php echo e(URL::to('package_image_location/'.Request::segment(2))); ?>">
                                        <button class="btn btn-success">Add Photos From Gallery</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Collapse section for uploading photos -->
                        <div class="collapse" id="UploadPhotos">
                            <div class="well">
                                <div class="modal-body">
                                    
                                    <!-- Form for uploading package images -->
                                    <form action="<?php echo e(url('/packagefile_upload')); ?>" enctype="multipart/form-data" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="package_id" value="<?php echo e(Request::segment(2)); ?>">

                                        <!-- Country selection -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <select class="form-control" name="country" id="country" onchange="get_states(this)">
                                                        <option value='0'>Select Country</option>
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cont): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                            <option value="<?php echo e($cont->name); ?>" c_id="<?php echo e($cont->id); ?>"><?php echo e($cont->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <!-- State selection -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <select class="form-control st_values" name="state" id="state" onchange="getcitys(this)">
                                                        <option value='0'>Select State</option>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <!-- City selection -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <select class="form-control ct_values" name="city" id="city">
                                                        <option value='0'>Select City</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12"></div>
                                        
                                            <!-- Image name -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Image Name </label>
                                                    <input type="text" name="name" placeholder="Image Name" class="form-control">
                                                </div>
                                            </div>
                                        
                                            <!-- File upload -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="uploadimage">Select Image</label>
                                                    <input type="file" class="form-control" name="uploadimage[]" id="uploadimage" accept=".jpg,.jpeg,.png,.webp" multiple>
                                                </div>
                                            </div>

                                            <div class="col-md-12"></div>

                                            <!-- Save button -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="100">ID</th>
                                    <th width="200">Image</th>
                                    <th width="250">Country</th>
                                    <th width="250">State</th>
                                    <th width="250">City</th>
                                    <th>Name</th>
                                    <th width="100">Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <input id="hotelid" value="52" type="hidden">
                            <?php $coun="1" ?>
                            <?php $__currentLoopData = $HotelUploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <tr id="tr_<?php echo e($image->id); ?>">
                                <td><?php echo e($coun++); ?></td>
                                <td>
                                <a href="#" rel="">
                                    <?php if($image->gallery_id!=''): ?>
                                    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'type')=='video'): ?>
                                    <div style="max-width:100%;position: relative;" class="video_icon" >
                                        <input type="hidden" name="" class="video_src" value="<?php echo e(URL::to('/').'/public/uploads/packages/video/'.CustomHelpers::get_imgpath_gallery($image->gallery_id,'image_main')); ?>">
                                        <i class="fa fa-play play_video" style="position: absolute;
                                        z-index: 1;color: white;left: 50%;top: 25px;border: 1px solid white;padding: 5px;border-radius: 20px;cursor: pointer;"></i>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')!="0"): ?>
                                        <img class="bdrRadius3" src="<?php echo e(CustomHelpers::get_image_gallery($image->gallery_id,'thum_small')); ?>" href="#" width="100" height="75" loading="lazy">
                                    <?php endif; ?>
                                    <?php else: ?>
                                        <img src="<?php echo e(URL::to('/').'/public/'.$image->image_path); ?>" href="#" class="img-responsive" loading="lazy">
                                    <?php endif; ?>
                                </a>
                                </td>
                                <td>
                                    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')!="0"): ?>
                                    <span class="" id="">
                                    <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'country')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')!="0"): ?>
                                    <span class="" id="">
                                    <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'state')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')!="0"): ?>
                                    <span class="" id="">
                                    <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'city')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')!="0"): ?>
                                    <span class="" id="">
                                    <?php echo e(CustomHelpers::get_imgpath_gallery($image->gallery_id,'name')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($image->status==1): ?>

                                    <button class="btn btn-sm btn-success">Enabled</button>
                                    <?php else: ?>
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($image->gallery_id!=''): ?>
                                    <a href="<?php echo e(URL::to('/edit_packagehotel_gallery_image/'.$image->gallery_id.'/'.$image->package_hotel_id.'/'.$image->id)); ?>">
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                    </a>
                                    <?php endif; ?>
                                    <form style="display: inline;" action="<?php echo e(URL::to('/packagehotelfiledelete/'.$image->id.'/'.$image->package_hotel_id)); ?>" onsubmit="return confirm('Are you sure you want to delete this item?');" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <button type="submit" class="btn btn-sm  btn-danger deleteImg" id="<?php echo e($image->id); ?>">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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